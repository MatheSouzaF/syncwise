function flexAnimation() {
  const expertiseBoxes = document.querySelectorAll('.box-our-expertise .box-expertise');
  const container = document.querySelector('.box-our-expertise');
  const totalBoxes = expertiseBoxes.length;

  if (totalBoxes === 0) return;

  if (totalBoxes === 1) {
    gsap.set(expertiseBoxes[0], {flexGrow: 1});
    const singleBox = expertiseBoxes[0];
    const titleElement = singleBox.querySelector('.title-our-expertise');
    const otherElements = [
      singleBox.querySelector('.label-our-expertise'),
      singleBox.querySelector('.description-our-expertise'),
      singleBox.querySelector('.box-subtopic'),
    ].filter(Boolean);

    gsap.set(titleElement, {opacity: 1});
    gsap.set(otherElements, {opacity: 0});
    gsap.to(otherElements, {
      opacity: 1,
      duration: 0.8,
      stagger: 0.2,
      delay: 0.2,
      ease: 'power2.out',
    });
    return;
  }


  function setBoxFlex(activeIndex) {
    expertiseBoxes.forEach((box, index) => {
      const title = box.querySelector('.title-our-expertise');
      const content = [
        box.querySelector('.label-our-expertise'),
        box.querySelector('.description-our-expertise'),
        box.querySelector('.box-subtopic'),
      ].filter(Boolean);

      box.classList.toggle('ativo', index === activeIndex);

      gsap.killTweensOf([box, ...content, title]);

      gsap.to(box, {
        flex: index === activeIndex ? '3 1 0%' : '1 1 0%',
        duration: 0.2,
        ease: 'expo.inOut',
      });

      gsap.to(content, {
        opacity: index === activeIndex ? 1 : 0,
        duration: 0.2,
        ease: 'power2.out',
        stagger: index === activeIndex ? 0.2 : 0,
      });
    });
  }

  // inicial
  setBoxFlex(0);

  let timeout = null;

  expertiseBoxes.forEach((box, index) => {
    box.addEventListener('mouseenter', () => {
      if (timeout) clearTimeout(timeout);
      setBoxFlex(index);
    });
  });

  if (container) {
    container.addEventListener('mouseleave', () => {
      if (timeout) clearTimeout(timeout);
      timeout = setTimeout(() => {
        setBoxFlex(0);
      }, 50);
    });
  }
}

function initSwiperExpertise() {
  new Swiper('.our-expertise-swiper', {
    slidesPerView: 1.1,
    spaceBetween: 16,

    navigation: {
      nextEl: '.swiper-btn-next',
      prevEl: '.swiper-btn-prev',
    },
  });
}

function svgsAnimations() {
  // jQuery Animation for Infinite SVG Marquee Effect
  $(document).ready(function () {
    function startMarquee() {
      const $container = $('.box-relationships');
      const containerWidth = $container.width();
      const $elements = $container.find('.box-svg');
      let totalWidth = 0;

      // Clonar os elementos para criar a ilusão de loop infinito
      $elements.each(function () {
        const $element = $(this);
        totalWidth += $element.outerWidth(true);
      });

      $container.append($container.html());

      function animateMarquee() {
        $container.css({left: 0});
        $container.stop().animate({left: -totalWidth}, 50000, 'linear', function () {
          animateMarquee();
        });
      }

      animateMarquee();
    }

    startMarquee();
  });
}
function swiperBase() {
  // new Swiper('.swiper-banner', {
  //   slidesPerView: 1,
  //   spaceBetween: 16,
  //   pagination: {
  //     el: '.swiper-pagination',
  //   },
  //   navigation: {
  //     nextEl: '.swiper-btn-next',
  //     prevEl: '.swiper-btn-prev',
  //   },
  // });
}
function initPage() {
  flexAnimation();
  initSwiperExpertise();
  svgsAnimations();
  swiperBase();
}

export {initPage};
