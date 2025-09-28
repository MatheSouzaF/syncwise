function initDynamicModules() {
  /*
  Importar arquivos JS em formato de chunks, sob-demanda

  Como usar:
  - selector: o seletor jQuery existente em qualquer página
  - modulePath: caminho relativo ao módulo (arquivo javascript) a ser incluído
  - moduleFunction: a função exportada pelo módulo

  Importante:
  - O módulo deve exportar dentro de um objeto, como `export { funcName }`
  - Cada módulo pode importar outros módulos diretamente com `import {funcName} from ../relative-path/module.js`

  TODO:
  - Limpar as chamadas não utilizadas, apenas por seletor do styleguide. Manter para quando é realmente utilizado
  */

  async function loadDynamicModule(selector, modulePath, moduleFunction) {
    const elements = $(selector);
    if (elements.length > 0) {
      try {
        const module = await import(`${modulePath}`);
        module[moduleFunction]();
      } catch (error) {
        // eslint-disable-next-line no-console
        console.error(`Erro ao carregar/executar o módulo ${selector}: `, error);
      }
    }
  }

  const dynamicModules = [
    {
      selector: '.page-template-homepage',
      modulePath: './pages/home/homepage.js',
      moduleFunction: 'initPage',
    },
    {
      selector: 'body',
      modulePath: './base/header.js',
      moduleFunction: 'initHeader',
    },
    {
      selector: '.page-template-relationships',
      modulePath: './pages/relationships/relationships.js',
      moduleFunction: 'initPage',
    },
    {
      selector: '.page-template-sync360-main',
      modulePath: './pages/sync360-main/sync360-main.js',
      moduleFunction: 'initPage',
    },
    {
      selector: '.page-template-syncIoT-main',
      modulePath: './pages/synciot-main/synciot-main.js',
      moduleFunction: 'initPage',
    },
    {
      selector: '.page-template-syncup-main',
      modulePath: './pages/syncup-main/syncup-main.js',
      moduleFunction: 'initPage',
    },
    {
      selector: '.page-template-suporte',
      modulePath: './pages/support/support.js',
      moduleFunction: 'initPage',
    },
    {
      selector: '.page-template-contact',
      modulePath: './pages/contact/contact.js',
      moduleFunction: 'initPage',
    },
    {
      selector: '.page-template-about-us',
      modulePath: './pages/about-us/about-us.js',
      moduleFunction: 'initPage',
    },
  ];

  dynamicModules.forEach(({selector, modulePath, moduleFunction}) => {
    loadDynamicModule(selector, modulePath, moduleFunction);
  });
}

export {initDynamicModules};
