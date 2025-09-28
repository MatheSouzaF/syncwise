function scrollsmooth() {
  gsap.registerPlugin(ScrollTrigger);

  const lenis = new Lenis({
    lerp: 0.07,
  });

  lenis.on('scroll', ScrollTrigger.update);

  gsap.ticker.add((time) => {
    lenis.raf(time * 1000);
  });
}
function menuSticy() {
  $('#btn-active')
    .off('click')
    .on('click', function (e) {
      e.stopPropagation();
      $('#btn-active').toggleClass('active-btn');
      $('.sidebar').toggleClass('active-sidebar');
    });

  $('.close-sidebar')
    .off('click')
    .on('click', function () {
      $('#btn-active').removeClass('active-btn');
      $('.sidebar').removeClass('active-sidebar');
    });

  window.onscroll = function () {
    var header = document.querySelector('header');
    if (window.pageYOffset > 0) {
      header.classList.add('sticky');
    } else {
      header.classList.remove('sticky');
    }
  };

  $('.link-hover').on('click', function (e) {
    e.preventDefault();
    var target = this.hash;
    var $target = $(target);
    $('html, body')
      .stop()
      .animate(
        {
          scrollTop: $target.offset().top - 150,
        },
        900,
        'swing',
        function () {
          // window.location.hash = target;
        }
      );
  });
}
function dropdown() {
  const $ = jQuery;
  const dropdowns = $('.dropdown-menu');
  const menuItems = $('.menu-item');
  let hideTimeout;

  // Oculta todos os dropdowns ao carregar
  dropdowns.each(function () {
    gsap.set(this, {
      opacity: 0,
      pointerEvents: 'none',
    });
  });

  menuItems.each(function () {
    const $menuItem = $(this);
    const $dropdown = $menuItem.find('.dropdown-menu');

    // Abrir ao passar o mouse
    $menuItem.off('mouseenter').on('mouseenter', function () {
      clearTimeout(hideTimeout);

      menuItems.removeClass('active');
      dropdowns.each(function () {
        gsap.to(this, {
          opacity: 0,
          pointerEvents: 'none',
          duration: 0.3,
          ease: 'power2.out',
          overwrite: true,
        });
      });

      $menuItem.addClass('active');
      gsap.to($dropdown[0], {
        opacity: 1,
        pointerEvents: 'auto',
        duration: 0.3,
        ease: 'power2.out',
        overwrite: true,
      });
    });

    // Fechar ao sair de .menu-item ou .dropdown-menu com delay
    $menuItem
      .add($dropdown)
      .off('mouseleave')
      .on('mouseleave', function () {
        hideTimeout = setTimeout(() => {
          $menuItem.removeClass('active');
          gsap.to($dropdown[0], {
            opacity: 0,
            pointerEvents: 'none',
            duration: 0.3,
            ease: 'power2.out',
            overwrite: true,
          });
        }, 200); // Ajuste o tempo se necessário
      });

    // Cancela o fechamento se retornar rapidamente
    $menuItem.add($dropdown).on('mouseenter', function () {
      clearTimeout(hideTimeout);
    });
  });
}
function menuMobile() {
  jQuery(document).ready(function ($) {
    // Abre o menu ao clicar no título
    $('.tab-title').click(function () {
      $('.box-links-menu-mobile').removeClass('active'); // fecha todos
      $(this).closest('.box-row-link-menu').find('.box-links-menu-mobile').addClass('active');
    });

    // Volta para o sidebar ao clicar no back-step
    $('.back-step').click(function () {
      $(this).closest('.box-links-menu-mobile').removeClass('active');
    });
  });
}
function initHeader() {
  menuSticy();
  jQuery(document).ready(function () {
    dropdown(); // deve rodar apenas 1 vez
  });
  menuMobile();
  // scrollsmooth();
}

export {initHeader};
