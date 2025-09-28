function tabs() {
  console.warn('Tabs module loaded');

  const tabItems = document.querySelectorAll('.tab-item');
  const tabContents = document.querySelectorAll('.tabs-support');
  const tabSelect = document.querySelector('.tabs-select');

  function activateTab(tabId) {
    // Remove 'active' e oculta conteúdos da tab
    tabItems.forEach((i) => i.classList.remove('active'));
    tabContents.forEach((c) => {
      c.classList.remove('active');
      c.style.display = 'none';
    });

    // Ativa tab item
    const tabToActivate = document.querySelector(`[data-tab="${tabId}"]`);
    if (tabToActivate) tabToActivate.classList.add('active');

    // Ativa conteúdo da tab (agora com id="content-tab-1", etc)
    const contentToActivate = document.getElementById(`content-${tabId}`);
    if (contentToActivate) {
      contentToActivate.classList.add('active');
      contentToActivate.style.display = 'block';
    }

    // Atualiza select mobile
    if (tabSelect) tabSelect.value = tabId;

    // --- Banner Fade ---
    const banners = document.querySelectorAll('.banner-page');
    banners.forEach((banner) => {
      banner.classList.remove('active');
      banner.style.display = 'none';
    });

    const bannerToShow = document.querySelector(`.banner-page#${tabId}`);
    if (bannerToShow) {
      bannerToShow.style.display = 'block';
      setTimeout(() => {
        bannerToShow.classList.add('active');
      }, 10);
    }
  }

  // Evento para clique nas tabs (desktop)
  tabItems.forEach((item) => {
    item.addEventListener('click', () => {
      const tabId = item.getAttribute('data-tab');
      activateTab(tabId);
    });
  });

  // Evento para alteração no select (mobile)
  if (tabSelect) {
    tabSelect.addEventListener('change', function () {
      activateTab(this.value);
    });
  }

  // Ativar primeira tab por padrão (evita inconsistência inicial)
  const firstActive = document.querySelector('.tab-item.active');
  if (firstActive) {
    activateTab(firstActive.getAttribute('data-tab'));
  }
}
function autosizeTextareas() {
  const textareas = document.querySelectorAll('.autosize');

  textareas.forEach((textarea) => {
    textarea.setAttribute('rows', 1);
    resize(textarea);

    textarea.addEventListener('input', function () {
      resize(textarea);
    });
  });

  function resize(textarea) {
    textarea.style.height = 'auto';
    textarea.style.height = textarea.scrollHeight + 'px';
  }
}
function autosizeTextareasIOT() {
  const textareas = document.querySelectorAll('.autosizeIot');

  textareas.forEach((textarea) => {
    textarea.setAttribute('rows', 1);
    textarea.style.overflow = 'hidden';
    textarea.style.height = 'auto'; // Garante que o height comece "limpo"

    textarea.addEventListener('input', function () {
      resize(textarea);
    });
  });

  function resize(textarea) {
    textarea.style.height = 'auto';
    textarea.style.height = textarea.scrollHeight + 'px';
  }

  const selectContainer = document.querySelector('.box-select-iot');
  if (!selectContainer) return;

  const select = selectContainer.querySelector('select');
  if (select) {
    select.disabled = true;
  }
  const selectconnectivity = document.querySelector('.box-select-connectivity');
  if (!selectconnectivity) return;

  const selectC = selectconnectivity.querySelector('select');
  if (selectC) {
    selectC.disabled = true;
  }
  const selectIntegration = document.querySelector('.box-select-vertical');
  if (!selectIntegration) return;

  const selectI = selectIntegration.querySelector('select');
  if (selectI) {
    selectI.disabled = true;
  }
}

function accordionFAQ() {
  const $accordions = $('.box-repetidor-accordion .accordion-item');

  // Resetando o estado inicial
  $accordions.removeClass('open');
  $accordions.find('.accordion-content').css('max-height', '0');
  $accordions.find('.accordion-title').removeClass('active-title'); // Remove classe no início

  // Evita duplicação de eventos
  $('.box-repetidor-accordion .accordion-header')
    .off('click')
    .on('click', function (e) {
      e.preventDefault();
      e.stopPropagation();

      const $currentAcc = $(this).closest('.accordion-item');
      const $content = $currentAcc.find('.accordion-content');
      const $title = $currentAcc.find('.accordion-title');
      const isOpen = $currentAcc.hasClass('open');

      if (isOpen) {
        $currentAcc.removeClass('open');
        $content.css('max-height', '0');
        $title.removeClass('active-title');
      } else {
        // Fecha todos os outros
        $accordions.removeClass('open');
        $accordions.find('.accordion-content').css('max-height', '0');
        $accordions.find('.accordion-title').removeClass('active-title');

        // Abre o atual
        $currentAcc.addClass('open');
        const scrollHeight = $content[0].scrollHeight;
        $content.css('max-height', scrollHeight + 'px');
        $title.addClass('active-title');
      }
    });
}

function initPage() {
  tabs();
  autosizeTextareas();
  accordionFAQ();
  autosizeTextareasIOT();
}

export {initPage};
