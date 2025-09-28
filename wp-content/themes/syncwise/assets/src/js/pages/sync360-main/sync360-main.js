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

function accordion() {
  $('.accordion .row-accordion .acc')
    .off('click')
    .on('click', function () {
      const $current = $(this).closest('.row-accordion');
      const index = $current.data('number');

      // Se já está ativo, desativa tudo e ativa imagem default
      if ($current.hasClass('active')) {
        $current.removeClass('active');
        $('.accordion-image .row-image').removeClass('active');

        // Ativa a última imagem como fallback
        $('.accordion-image .row-image').last().addClass('active');
      } else {
        // Ativa apenas o atual
        $('.accordion .row-accordion').removeClass('active');
        $current.addClass('active');

        // Ativa a imagem correspondente
        $('.accordion-image .row-image').removeClass('active');
        $(`.accordion-image .row-image[data-number="${index}"]`).addClass('active');
      }
    });

  // Ao iniciar, define o primeiro accordion como ativo
  $('.accordion .row-accordion').first().addClass('active');
  $('.accordion-image .row-image').removeClass('active');
  $('.accordion-image .row-image').first().addClass('active');
}

function accordionSaas() {
  $('.accordion-saas .row-accordion-saas .acc-saas')
    .off('click')
    .on('click', function () {
      const $current = $(this).closest('.row-accordion-saas');
      const index = $current.data('number');

      // Se já está ativo, desativa tudo e ativa imagem default
      if ($current.hasClass('active-saas')) {
        $current.removeClass('active-saas');
        $('.accordion-image-saas .row-image-saas').removeClass('active-saas');

        // Ativa a última imagem como fallback
        $('.accordion-image-saas .row-image-saas').last().addClass('active-saas');
      } else {
        // Ativa apenas o atual
        $('.accordion-saas .row-accordion-saas').removeClass('active-saas');
        $current.addClass('active-saas');

        // Ativa a imagem correspondente
        $('.accordion-image-saas .row-image-saas').removeClass('active-saas');
        $(`.accordion-image-saas .row-image-saas[data-number="${index}"]`).addClass('active-saas');
      }
    });
  // Ao iniciar, define o primeiro accordion como ativo
  $('.accordion-saas .row-accordion-saas').first().addClass('active-saas');
  $('.accordion-image-saas .row-image-saas').removeClass('active-saas');
  $('.accordion-image-saas .row-image-saas').first().addClass('active-saas');
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
function initPage() {
  tabs();
  accordion();
  accordionSaas();
  initPlyr();
}

export {initPage};
