function tabs() {
  const tabItems = document.querySelectorAll('.tab-item');
  const tabSelect = document.querySelector('.tabs-select');
  const tabContents = document.querySelectorAll('.tabs-content');

  function activateTab(tabId, slug, pushUrl = true) {
    // 1) ativa classes
    tabItems.forEach((i) => i.classList.remove('active'));
    tabContents.forEach((c) => c.classList.remove('active'));
    document.querySelector(`[data-tab="${tabId}"]`)?.classList.add('active');
    document.getElementById(tabId)?.classList.add('active');
    if (tabSelect) tabSelect.value = tabId;

    // 1.1) Ativa o primeiro slide da tab ativa, se existir
    const tabContent = document.getElementById(tabId);
    if (tabContent) {
      const thumbs = tabContent.querySelectorAll('.box-swiper-slide');
      const panels = tabContent.querySelectorAll('.box-swiper-slide-content');
      if (thumbs.length && panels.length) {
        thumbs.forEach((el, idx) => el.classList.toggle('is-active', idx === 0));
        panels.forEach((el, idx) => {
          const active = idx === 0;
          el.classList.toggle('is-active', active);
          el.setAttribute('aria-hidden', active ? 'false' : 'true');
        });
      }
    }

    // 2) atualiza URL
    if (pushUrl) {
      history.pushState({tab: slug}, '', `?tab=${slug}`);
    }

    // // 3) exemplo de chamada AJAX
    // fetch(`/meu-endpoint?tab=${slug}`)
    //   .then((r) => r.text())
    //   .then((html) => {
    //     // document.getElementById(tabId).innerHTML = html;
    //   })
    //   .catch(console.error);
  }

  // clique nas tabs
  tabItems.forEach((item) => {
    item.addEventListener('click', () => {
      const tabId = item.dataset.tab;
      const slug = item.dataset.slug;
      activateTab(tabId, slug);
    });
  });

  // select mobile
  if (tabSelect) {
    tabSelect.addEventListener('change', (e) => {
      const idx = e.target.selectedIndex;
      const opt = e.target.options[idx];
      const tabId = opt.value;
      const slug = opt.dataset.slug;
      activateTab(tabId, slug);
    });
  }

  // volta/avança do navegador
  window.addEventListener('popstate', (e) => {
    const slug = new URL(location).searchParams.get('tab');
    if (!slug) return;
    const match = document.querySelector(`.tab-item[data-slug="${slug}"]`);
    if (match) {
      activateTab(match.dataset.tab, slug, false);
    }
  });

  // ativar no carregamento
  const initialSlug = new URL(location).searchParams.get('tab');
  if (initialSlug) {
    const initTab = document.querySelector(`.tab-item[data-slug="${initialSlug}"]`);
    if (initTab) {
      activateTab(initTab.dataset.tab, initialSlug, false);
      return;
    }
  }
  // senão, primeira aba
  const first = tabItems[0];
  activateTab(first.dataset.tab, first.dataset.slug, false);
}
function initPlyr() {
  const players = new Map();

  const getOrCreatePlayer = (videoEl) => {
    if (!videoEl) return null;
    if (!players.has(videoEl)) {
      players.set(videoEl, new Plyr(videoEl));
    }
    return players.get(videoEl);
  };

  // Abrir modal SOMENTE se o slide clicado tiver .has-modal
  document.addEventListener('click', (e) => {
    const slideThumb = e.target.closest('.box-image-video .swiper-slide');
    if (!slideThumb) return;

    // 🔒 guarda: só prossegue se tiver modal
    if (!slideThumb.classList.contains('has-modal')) return;

    const idx = slideThumb.getAttribute('data-slide-index');
    const boxFixed = document.querySelector('.box-fixed');
    const body = document.body;

    document.querySelectorAll('.box-fixed .swiper-slide').forEach((s) => s.classList.remove('active'));
    const match = document.querySelector(`.box-fixed .swiper-slide[data-slide-index="${idx}"]`);
    if (!match) return;

    boxFixed.classList.add('active-fixed');
    body.classList.add('body-modal');
    match.classList.add('active');

    // pausa qualquer player já inicializado
    players.forEach((p) => {
      try {
        p.pause();
      } catch (_) {}
    });

    // inicializa/usa o Plyr apenas do slide ativo
    const videoEl = match.querySelector('video');
    const player = getOrCreatePlayer(videoEl);
    if (player) player.play().catch(() => {});
  });

  // Fechar modal
  document.addEventListener('click', (e) => {
    const closeBtn = e.target.closest('.close-button-about');
    if (!closeBtn) return;

    const slide = closeBtn.closest('.swiper-slide');
    if (!slide) return;

    slide.classList.remove('active', 'open');
    document.querySelectorAll('.box-fixed .swiper-slide').forEach((s) => s.classList.remove('active', 'open'));
    document.querySelector('.box-fixed')?.classList.remove('active-fixed');
    document.body?.classList.remove('body-modal');

    players.forEach((p) => {
      try {
        p.pause();
      } catch (_) {}
    });
  });
}
function swiperGNSS() {
  const thumbs = Array.from(document.querySelectorAll('.box-swiper-slide'));
  const panels = Array.from(document.querySelectorAll('.box-swiper-slide-content'));

  if (!thumbs.length || !panels.length) return;

  // inicial: ativa o primeiro
  function setActiveByIndex(idx) {
    thumbs.forEach((el) => el.classList.toggle('is-active', el.dataset.index === String(idx)));
    panels.forEach((el) => {
      const active = el.dataset.index === String(idx);
      el.classList.toggle('is-active', active);
      el.setAttribute('aria-hidden', active ? 'false' : 'true');
    });
  }
  setActiveByIndex(0);

  function handleActivate(evt) {
    const el = evt.currentTarget;
    const idx = el.dataset.index;
    if (typeof idx === 'undefined') return;
    setActiveByIndex(idx);
  }

  thumbs.forEach((el) => {
    el.addEventListener('click', handleActivate);
    el.addEventListener('keydown', (e) => {
      // acessível: Enter ou Espaço
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        handleActivate({currentTarget: el});
      }
    });
  });
}

function accordionGNSS() {
  const $accordions = $('.box-accordion .acc');

  // Resetando estado inicial
  $accordions.removeClass('open');
  $accordions.find('.description-acc').css('max-height', '0');
  $accordions.find('.svg-close').show();
  $accordions.find('.svg-open').hide();

  // Garantindo que o evento não seja duplicado
  $('.box-accordion .box-title')
    .off('click')
    .on('click', function (e) {
      e.stopPropagation(); // <- Impede que o clique "suba" até o swiper
      e.preventDefault(); // <- Impede cliques extras indevidos

      const $currentAcc = $(this).closest('.acc');
      const $desc = $currentAcc.find('.description-acc');
      const $svgClose = $currentAcc.find('.svg-close');
      const $svgOpen = $currentAcc.find('.svg-open');

      const isOpen = $currentAcc.hasClass('open');

      if (isOpen) {
        $currentAcc.removeClass('open');
        $desc.css('max-height', '0');
        $svgClose.show();
        $svgOpen.hide();
      } else {
        $currentAcc.addClass('open');
        const scrollHeight = $desc[0].scrollHeight;
        $desc.css('max-height', scrollHeight + 'px');
        $svgClose.hide();
        $svgOpen.show();
      }
    });
}
function accordionGNSSMobile() {
  const $accordions = $('.box-accordion-mobile .acc-mobile');

  // Resetando estado inicial
  $accordions.removeClass('open');
  $accordions.find('.description-acc-mobile').css('max-height', '0');
  $accordions.find('.svg-close').show();
  $accordions.find('.svg-open').hide();

  // Garantindo que o evento não seja duplicado
  $('.box-accordion-mobile .box-title')
    .off('click')
    .on('click', function (e) {
      e.stopPropagation(); // <- Impede que o clique "suba" até o swiper
      e.preventDefault(); // <- Impede cliques extras indevidos

      const $currentAcc = $(this).closest('.acc-mobile');
      const $desc = $currentAcc.find('.description-acc-mobile');
      const $svgClose = $currentAcc.find('.svg-close');
      const $svgOpen = $currentAcc.find('.svg-open');

      const isOpen = $currentAcc.hasClass('open');

      if (isOpen) {
        $currentAcc.removeClass('open');
        $desc.css('max-height', '0');
        $svgClose.show();
        $svgOpen.hide();
      } else {
        $currentAcc.addClass('open');
        const scrollHeight = $desc[0].scrollHeight;
        $desc.css('max-height', scrollHeight + 'px');
        $svgClose.hide();
        $svgOpen.show();
      }
    });
}
function gnssMobile() {
  $(document).ready(function () {
    const thumbs = $('.row-slide');
    const contents = $('.row-slide-conteudo');

    // Mostra o primeiro por padrão
    thumbs.first().addClass('ativo');
    contents.hide().first().show();

    // Ao clicar em uma thumb
    thumbs.on('click', function () {
      const index = $(this).index();

      // Remove classe ativo das outras e adiciona na clicada
      thumbs.removeClass('ativo');
      $(this).addClass('ativo');

      // Esconde todos e mostra o correspondente
      contents.hide().eq(index).fadeIn(200);
    });
  });
}
function smartMobile() {
  $(document).ready(function () {
    const thumbs = $('.row-slide-smart');
    const contents = $('.row-slide-conteudo-smart');

    // Mostra o primeiro por padrão
    thumbs.first().addClass('ativo');
    contents.hide().first().show();

    // Ao clicar em uma thumb
    thumbs.on('click', function () {
      const index = $(this).index();

      // Remove classe ativo das outras e adiciona na clicada
      thumbs.removeClass('ativo');
      $(this).addClass('ativo');

      // Esconde todos e mostra o correspondente
      contents.hide().eq(index).fadeIn(200);
    });
  });
}
function bluetoothMobile() {
  $(document).ready(function () {
    const thumbs = $('.row-slide-bluetooth');
    const contents = $('.row-slide-conteudo-bluetooth');

    // Mostra o primeiro por padrão
    thumbs.first().addClass('ativo');
    contents.hide().first().show();

    // Ao clicar em uma thumb
    thumbs.on('click', function () {
      const index = $(this).index();

      // Remove classe ativo das outras e adiciona na clicada
      thumbs.removeClass('ativo');
      $(this).addClass('ativo');

      // Esconde todos e mostra o correspondente
      contents.hide().eq(index).fadeIn(200);
    });
  });
}
function antennasMobile() {
  $(document).ready(function () {
    const thumbs = $('.row-slide-antennas');
    const contents = $('.row-slide-conteudo-antennas');

    // Mostra o primeiro por padrão
    thumbs.first().addClass('ativo');
    contents.hide().first().show();

    // Ao clicar em uma thumb
    thumbs.on('click', function () {
      const index = $(this).index();

      // Remove classe ativo das outras e adiciona na clicada
      thumbs.removeClass('ativo');
      $(this).addClass('ativo');

      // Esconde todos e mostra o correspondente
      contents.hide().eq(index).fadeIn(200);
    });
  });
}

function sendTitleForm() {

}

function initPage() {
  tabs();
  swiperGNSS();
  accordionGNSS();
  accordionGNSSMobile();
  gnssMobile();
  smartMobile();
  bluetoothMobile();
  antennasMobile();
  initPlyr();
  sendTitleForm();
}

export {initPage};
