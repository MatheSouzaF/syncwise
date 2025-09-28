function textarea() {
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
function initPage() {
    textarea();
}

export {initPage};
