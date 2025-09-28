function relationships() {
  const listaItems = document.querySelectorAll('.lista-relationship');
  const modals = document.querySelectorAll('.box-svg-modal');
  const modalContents = document.querySelectorAll('.modal-svg');

  // Trocar aba
  listaItems.forEach((item) => {
    item.addEventListener('click', () => {
      const index = item.getAttribute('data-index');

      listaItems.forEach((i) => i.classList.remove('active'));
      modals.forEach((m) => m.classList.remove('active'));

      item.classList.add('active');
      document.querySelector(`.box-svg-modal[data-index="${index}"]`).classList.add('active');
    });
  });

  // Abrir modal com GSAP e fechar o anterior
  const boxesSvg = document.querySelectorAll('.box-svg');
  boxesSvg.forEach((box) => {
    box.addEventListener('click', () => {
      const modal = box.nextElementSibling; // .modal-svg

      // Fecha todos os modais ativos antes de abrir o novo
      modalContents.forEach((m) => {
        if (m.classList.contains('active') && m !== modal) {
          gsap.to(m, {
            scale: 0.5,
            opacity: 0,
            duration: 0.3,
            ease: 'power2.in',
            onComplete: () => {
              m.classList.remove('active');
              m.style.display = 'none';
            },
          });
        }
      });

      // Abre o novo modal
      gsap.set(modal, { scale: 0, opacity: 0, display: 'flex' });
      gsap.to(modal, {
        scale: 1,
        opacity: 1,
        duration: 0.4,
        ease: 'power2.out',
      });
      modal.classList.add('active');
    });
  });

  // Fechar se clicar fora do modal
  document.addEventListener('click', (e) => {
    modalContents.forEach((modal) => {
      if (
        modal.classList.contains('active') &&
        !modal.contains(e.target) &&
        !e.target.closest('.box-svg')
      ) {
        gsap.to(modal, {
          scale: 0.5,
          opacity: 0,
          duration: 0.3,
          ease: 'power2.in',
          onComplete: () => {
            modal.classList.remove('active');
            modal.style.display = 'none';
          },
        });
      }
    });
  });

  // Também fecha ao clicar no botão .close-modal
  document.querySelectorAll('.close-modal').forEach((closeBtn) => {
    closeBtn.addEventListener('click', (e) => {
      const modal = closeBtn.closest('.modal-svg');

      gsap.to(modal, {
        scale: 0.5,
        opacity: 0,
        duration: 0.3,
        ease: 'power2.in',
        onComplete: () => {
          modal.classList.remove('active');
          modal.style.display = 'none';
        },
      });

      e.stopPropagation(); // Evita que o clique no botão feche novamente via document click
    });
  });
}

function initPage() {
  relationships();
}

export { initPage };
