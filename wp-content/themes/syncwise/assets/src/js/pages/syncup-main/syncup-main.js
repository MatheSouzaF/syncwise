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

    // 3) exemplo de chamada AJAX
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
function initPlyrConnectivity() {
  const player = new Plyr('#player-connectivity');
  const body = document.querySelector('body');
  // exemplo: ao clicar num slide do carrossel, ativa o mesmo índice no box-fixed
  document.addEventListener('click', (e) => {
    const boxFixed = document.querySelector('.box-fixed-connectivity');
    const slide = e.target.closest('.box-image-video ');
    if (!slide) return;
    const idx = slide.getAttribute('data-slide-index');
    document.querySelectorAll('.box-fixed-connectivity').forEach((s) => s.classList.remove('active'));
    const match = document.querySelector(`.box-fixed-connectivity .swiper-slide`);
    boxFixed.classList.add('active-fixed');
    body.classList.add('body-modal');
    if (match) match.classList.add('active');
    player.play();
    playerImage.play();
  });

  document.addEventListener('click', function (e) {
    // verifica se clicou em algum botão de fechar
    const closeBtn = e.target.closest('.close-button-about');
    if (!closeBtn) return;

    // acha o slide pai do botão
    const slide = closeBtn.closest('.swiper-slide');
    if (!slide) return;

    // remove classes que você usa para mostrar/ativar o modal
    slide.classList.remove('active', 'open'); // adicione ou remova o nome da(s) classe(s) que você realmente usa

    document.querySelector('.box-fixed-connectivity .swiper-slide')?.classList.remove('active', 'open');

    // opcional: se você adicionou uma classe na própria box-fixed-connectivity
    document.querySelector('.box-fixed-connectivity')?.classList.remove('active-fixed');
    document.querySelector('body')?.classList.remove('body-modal');
  });
}

function initPage() {
  tabs();
  initPlyr();
  initPlyrConnectivity();
}

export {initPage};
