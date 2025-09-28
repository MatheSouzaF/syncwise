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
  initPlyrConnectivity();
}

export {initPage};
