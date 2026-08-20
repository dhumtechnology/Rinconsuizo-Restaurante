(function (window, document) {
  'use strict';

  var modal;
  var titleNode;
  var subtitleNode;
  var statusNode;
  var frameNode;
  var canvasNode;
  var canvasWrapNode;
  var paperSelectNode;
  var loadingNode;
  var badgeNode;
  var currentUrl = '';
  var currentType = '';
  var previewRendered = false;
  var pdfJsPromise = null;

  function decodeBase64Safe(value) {
    if (!value) {
      return '';
    }
    value = String(value).replace(/ /g, '+').replace(/-/g, '+').replace(/_/g, '/');
    try {
      return window.atob(value).replace(/\0/g, '');
    } catch (err) {
      return '';
    }
  }

  function inferType(url) {
    try {
      var absolute = new URL(url, window.location.href);
      var rawType = absolute.searchParams.get('tipo') || '';
      var decodedType = decodeBase64Safe(rawType).toUpperCase();
      return decodedType || rawType.toUpperCase();
    } catch (err) {
      return '';
    }
  }

  function getMetaByType(type) {
    switch (type) {
      case 'TICKETCOMANDA':
        return {
          title: 'Impresion de comanda',
          subtitle: 'Vista previa lista para cocina o barra.',
          badge: 'Comanda',
          defaultPaper: '80'
        };
      case 'TICKETPRECUENTA':
        return {
          title: 'Impresion de precuenta',
          subtitle: 'Revisa la precuenta antes de imprimir.',
          badge: 'Precuenta',
          defaultPaper: '80'
        };
      case 'TICKETCREDITOS':
        return {
          title: 'Impresion de ticket de credito',
          subtitle: 'Comprobante rapido para abonos o creditos.',
          badge: 'Credito',
          defaultPaper: '80'
        };
      case 'FACTURACOMPRAS':
        return {
          title: 'Impresion de factura',
          subtitle: 'Documento listo para imprimir o descargar.',
          badge: 'Factura',
          defaultPaper: 'a4'
        };
      case 'TICKET':
      default:
        return {
          title: 'Impresion de ticket',
          subtitle: 'Vista previa del ticket antes de enviarlo a la impresora.',
          badge: 'Ticket',
          defaultPaper: '80'
        };
    }
  }

  function shouldIntercept(url) {
    if (!url) {
      return false;
    }
    if (url.indexOf('reportepdf') === -1 && url.indexOf('reportepdffa') === -1) {
      return false;
    }
    var type = inferType(url);
    return [
      'TICKET',
      'TICKETCOMANDA',
      'TICKETPRECUENTA',
      'TICKETCREDITOS',
      'FACTURACOMPRAS'
    ].indexOf(type) !== -1;
  }

  function getSelectedPaperSize() {
    if (paperSelectNode) {
      return paperSelectNode.value || '80';
    }
    return '80';
  }

  function applyPaperPreviewClass(size) {
    if (!canvasWrapNode) {
      return;
    }
    canvasWrapNode.className = 'rs-print-canvas-wrap rs-paper-' + size;
  }

  function getPrintPageCss(size) {
    var pageSize = '80mm auto';
    if (size === '58') {
      pageSize = '58mm auto';
    } else if (size === 'a4') {
      pageSize = 'A4 portrait';
    }
    return (
      '@page { size: ' + pageSize + '; margin: 2mm; }' +
      '@media print { html, body { margin: 0; padding: 0; background: #fff; } ' +
      'img { width: 100%; height: auto; display: block; margin: 0 auto; } }'
    );
  }

  function injectPrintStylesIntoFrame(frame, size) {
    if (!frame || !frame.contentWindow) {
      return false;
    }
    try {
      var doc = frame.contentWindow.document;
      if (!doc || !doc.head) {
        return false;
      }
      var existing = doc.getElementById('rs-print-page-style');
      if (existing && existing.parentNode) {
        existing.parentNode.removeChild(existing);
      }
      var style = doc.createElement('style');
      style.id = 'rs-print-page-style';
      style.type = 'text/css';
      style.appendChild(doc.createTextNode(getPrintPageCss(size)));
      doc.head.appendChild(style);
      return true;
    } catch (err) {
      return false;
    }
  }

  function printCanvasWithPaperSize(size) {
    if (!canvasNode || !canvasNode.width) {
      return false;
    }
    var dataUrl = canvasNode.toDataURL('image/png');
    var pageCss = getPrintPageCss(size);
    var printFrame = document.createElement('iframe');
    printFrame.setAttribute('title', 'Imprimir documento');
    printFrame.style.cssText = 'position:fixed;left:-9999px;top:0;width:0;height:0;border:0;opacity:0;';
    document.body.appendChild(printFrame);

    var doc = printFrame.contentWindow.document;
    doc.open();
    doc.write(
      '<!DOCTYPE html><html><head><meta charset="utf-8"><title>Imprimir</title>' +
      '<style>' + pageCss + '</style></head>' +
      '<body><img id="rs-print-img" src="' + dataUrl + '" alt="Documento" /></body></html>'
    );
    doc.close();

    var img = printFrame.contentWindow.document.getElementById('rs-print-img');
    var cleanup = function () {
      setTimeout(function () {
        if (printFrame.parentNode) {
          printFrame.parentNode.removeChild(printFrame);
        }
      }, 1200);
    };
    var doPrint = function () {
      try {
        printFrame.contentWindow.focus();
        printFrame.contentWindow.print();
      } finally {
        cleanup();
      }
    };

    if (!img) {
      doPrint();
      return true;
    }
    if (img.complete) {
      doPrint();
    } else {
      img.onload = doPrint;
      img.onerror = doPrint;
    }
    return true;
  }

  function printDocument() {
    var size = getSelectedPaperSize();
    applyPaperPreviewClass(size);

    if (previewRendered && printCanvasWithPaperSize(size)) {
      if (statusNode) {
        statusNode.textContent = 'Enviando a impresora con papel ' + paperSelectNode.options[paperSelectNode.selectedIndex].text + '...';
      }
      return;
    }

    injectPrintStylesIntoFrame(frameNode, size);
    try {
      if (frameNode && frameNode.contentWindow) {
        frameNode.contentWindow.focus();
        frameNode.contentWindow.print();
        if (statusNode) {
          statusNode.textContent = 'Impresion iniciada. Revisa el dialogo del navegador.';
        }
        return;
      }
    } catch (err) {
      // fallback below
    }
    if (currentUrl) {
      window.open(currentUrl, '_blank');
    }
  }

  function ensurePdfJsLoaded() {
    if (pdfJsPromise) {
      return pdfJsPromise;
    }
    pdfJsPromise = new Promise(function (resolve, reject) {
      if (window.pdfjsLib && typeof window.pdfjsLib.getDocument === 'function') {
        resolve();
        return;
      }

      var pdfCdn = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js';
      var workerCdn = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.worker.min.js';
      var script = document.createElement('script');
      script.src = pdfCdn;
      script.async = true;
      script.onload = function () {
        if (window.pdfjsLib && window.pdfjsLib.GlobalWorkerOptions) {
          window.pdfjsLib.GlobalWorkerOptions.workerSrc = workerCdn;
        }
        resolve();
      };
      script.onerror = function () {
        reject(new Error('No se pudo cargar pdf.js'));
      };
      document.head.appendChild(script);
    });
    return pdfJsPromise;
  }

  function renderPreviewToCanvas(url, type) {
    return ensurePdfJsLoaded().then(function () {
      if (!canvasNode) {
        throw new Error('Canvas no disponible');
      }
      var absUrl = url;
      try {
        absUrl = new URL(url, window.location.href).toString();
      } catch (e) {
        // keep
      }

      var scale = 2.25;
      if (type === 'FACTURACOMPRAS') {
        scale = 1.25;
      } else if (type === 'TICKETPRECUENTA') {
        scale = 2.0;
      }

      return window.pdfjsLib.getDocument(absUrl).promise.then(function (pdf) {
        return pdf.getPage(1).then(function (page) {
          var viewport = page.getViewport({ scale: scale });
          canvasNode.width = Math.floor(viewport.width);
          canvasNode.height = Math.floor(viewport.height);
          var ctx = canvasNode.getContext('2d');
          ctx.clearRect(0, 0, canvasNode.width, canvasNode.height);
          return page.render({
            canvasContext: ctx,
            viewport: viewport
          }).promise;
        });
      });
    });
  }

  function ensureModal() {
    if (modal) {
      return;
    }

    var wrapper = document.createElement('div');
    wrapper.className = 'rs-print-modal';
    wrapper.id = 'rs-print-modal';
    wrapper.innerHTML =
      '<div class="rs-print-card" role="dialog" aria-modal="true" aria-labelledby="rs-print-title">' +
        '<div class="rs-print-header">' +
          '<div>' +
            '<h3 class="rs-print-title" id="rs-print-title">Impresion</h3>' +
            '<p class="rs-print-subtitle" id="rs-print-subtitle">Preparando vista previa...</p>' +
          '</div>' +
          '<button type="button" class="rs-print-close" aria-label="Cerrar">&times;</button>' +
        '</div>' +
        '<div class="rs-print-body">' +
          '<div class="rs-print-toolbar">' +
            '<button type="button" class="btn btn-primary" data-rs-action="print"><i class="fa fa-print"></i> Imprimir</button>' +
            '<label class="rs-print-paper-label" for="rs-print-paper">Papel</label>' +
            '<select id="rs-print-paper" class="form-control rs-print-paper-select">' +
              '<option value="58">Ticket 58 mm</option>' +
              '<option value="80" selected>Ticket 80 mm</option>' +
              '<option value="a4">A4</option>' +
            '</select>' +
            '<button type="button" class="btn btn-default" data-rs-action="newtab"><i class="fa fa-external-link"></i> Nueva pestaña</button>' +
            '<button type="button" class="btn btn-default" data-rs-action="download"><i class="fa fa-download"></i> Descargar</button>' +
            '<button type="button" class="btn btn-danger" data-rs-action="close"><i class="fa fa-times"></i> Cerrar</button>' +
            '<span class="rs-print-badge" id="rs-print-badge">Ticket</span>' +
            '<p class="rs-print-status" id="rs-print-status">Cargando documento...</p>' +
          '</div>' +
          '<div class="rs-print-preview">' +
            '<div class="rs-print-loading" id="rs-print-loading">' +
              '<div class="rs-print-spinner"></div>' +
              '<div>Cargando vista previa...</div>' +
            '</div>' +
            '<div class="rs-print-canvas-wrap rs-paper-80" id="rs-print-canvas-wrap">' +
              '<canvas id="rs-print-canvas" class="rs-print-canvas"></canvas>' +
            '</div>' +
            '<iframe class="rs-print-frame" id="rs-print-frame" title="Documento para imprimir" style="position:absolute;left:-99999px;top:-99999px;width:1px;height:1px;opacity:0;pointer-events:none;"></iframe>' +
          '</div>' +
        '</div>' +
      '</div>';

    document.body.appendChild(wrapper);
    modal = wrapper;
    titleNode = document.getElementById('rs-print-title');
    subtitleNode = document.getElementById('rs-print-subtitle');
    statusNode = document.getElementById('rs-print-status');
    badgeNode = document.getElementById('rs-print-badge');
    frameNode = document.getElementById('rs-print-frame');
    canvasNode = document.getElementById('rs-print-canvas');
    canvasWrapNode = document.getElementById('rs-print-canvas-wrap');
    paperSelectNode = document.getElementById('rs-print-paper');
    loadingNode = document.getElementById('rs-print-loading');

    wrapper.addEventListener('click', function (event) {
      if (event.target === wrapper) {
        closeModal();
      }
    });

    wrapper.querySelector('.rs-print-close').addEventListener('click', closeModal);
    wrapper.querySelector('[data-rs-action="close"]').addEventListener('click', closeModal);
    wrapper.querySelector('[data-rs-action="newtab"]').addEventListener('click', function () {
      if (currentUrl) {
        window.open(currentUrl, '_blank');
      }
    });
    wrapper.querySelector('[data-rs-action="download"]').addEventListener('click', function () {
      if (!currentUrl) {
        return;
      }
      var link = document.createElement('a');
      link.href = currentUrl;
      link.target = '_blank';
      link.rel = 'noopener noreferrer';
      link.download = '';
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
    });
    wrapper.querySelector('[data-rs-action="print"]').addEventListener('click', printDocument);

    if (paperSelectNode) {
      paperSelectNode.addEventListener('change', function () {
        applyPaperPreviewClass(getSelectedPaperSize());
      });
    }

    frameNode.addEventListener('load', function () {
      if (loadingNode && !previewRendered) {
        loadingNode.className = 'rs-print-loading is-hidden';
      }
      if (statusNode && !previewRendered) {
        statusNode.textContent = 'Documento listo. Puedes imprimir o descargar.';
      }
    });

    document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape' && modal && modal.className.indexOf('is-open') !== -1) {
        closeModal();
      }
    });
  }

  function closeModal() {
    ensureModal();
    modal.className = 'rs-print-modal';
    document.body.style.overflow = '';
  }

  function openModal(url, options) {
    if (!url) {
      return false;
    }
    ensureModal();

    var type = inferType(url);
    var meta = getMetaByType(type);
    currentUrl = url;
    currentType = type;
    previewRendered = false;

    titleNode.textContent = (options && options.title) || meta.title;
    subtitleNode.textContent = meta.subtitle;
    statusNode.textContent = 'Cargando documento...';
    badgeNode.textContent = meta.badge;
    loadingNode.className = 'rs-print-loading';

    if (paperSelectNode && meta.defaultPaper) {
      paperSelectNode.value = meta.defaultPaper;
      applyPaperPreviewClass(meta.defaultPaper);
    }

    frameNode.src = url;
    modal.className = 'rs-print-modal is-open';
    document.body.style.overflow = 'hidden';

    renderPreviewToCanvas(url, type)
      .then(function () {
        previewRendered = true;
        if (loadingNode) {
          loadingNode.className = 'rs-print-loading is-hidden';
        }
        if (statusNode) {
          statusNode.textContent = 'Vista previa lista. Elige papel e imprime.';
        }
      })
      .catch(function () {
        if (statusNode) {
          statusNode.textContent = 'Vista previa limitada. Usa "Nueva pestaña" si hace falta.';
        }
        if (loadingNode) {
          loadingNode.className = 'rs-print-loading is-hidden';
        }
      });

    return true;
  }

  document.addEventListener('click', function (event) {
    var anchor = event.target.closest ? event.target.closest('a[href]') : null;
    if (!anchor) {
      return;
    }
    var href = anchor.getAttribute('href');
    if (!shouldIntercept(href)) {
      return;
    }
    event.preventDefault();
    openModal(href, {
      title: anchor.getAttribute('data-original-title') || anchor.getAttribute('title') || ''
    });
  });

  window.RSPrintDialog = {
    openFromUrl: openModal,
    close: closeModal,
    shouldIntercept: shouldIntercept,
    print: printDocument
  };
})(window, document);
