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
  var printersListNode;
  var printButtonNode;
  var loadingNode;
  var badgeNode;
  var currentUrl = '';
  var currentType = '';
  var previewRendered = false;
  var pdfJsPromise = null;
  var printersCache = [];
  var selectedPrinterId = '';
  var printBusy = false;
  var PRINT_STORAGE_KEY = 'rs-selected-printer-id';

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

  function getPrintEndpoint() {
    return window.RS_PRINT_ENDPOINT || 'imprimir_red.php';
  }

  function escapeHtml(value) {
    return String(value == null ? '' : value)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;');
  }

  function getStoredPrinterId() {
    try {
      return window.localStorage.getItem(PRINT_STORAGE_KEY) || '';
    } catch (err) {
      return '';
    }
  }

  function getSelectedPrinterId() {
    return selectedPrinterId || 'browser';
  }

  function getSelectedPrinterLabel() {
    if (!printersListNode) {
      return 'navegador';
    }
    var selected = printersListNode.querySelector('.rs-print-printer.is-selected');
    if (!selected) {
      return 'navegador';
    }
    var name = selected.querySelector('.rs-print-printer-name');
    return name ? name.textContent : 'navegador';
  }

  function setSelectedPrinter(id) {
    selectedPrinterId = id || (printersCache.length ? printersCache[0].id : 'browser');
    try {
      window.localStorage.setItem(PRINT_STORAGE_KEY, selectedPrinterId);
    } catch (err) {
      // ignore
    }
    if (!printersListNode) {
      return;
    }
    var cards = printersListNode.querySelectorAll('.rs-print-printer');
    var i;
    for (i = 0; i < cards.length; i++) {
      if (cards[i].getAttribute('data-id') === selectedPrinterId) {
        cards[i].className = cards[i].className.replace(/\s*is-selected/g, '') + ' is-selected';
      } else {
        cards[i].className = cards[i].className.replace(/\s*is-selected/g, '');
      }
    }
  }

  function populatePrinterSelect(printers) {
    printersCache = printers || [];
    if (!printersListNode) {
      return;
    }
    var html = '';
    var i;
    if (!printersCache.length) {
      html += '<p class="rs-print-printers-empty">No hay impresoras de red en el .env. Puede usar el navegador o configure PRINTER_1_IP.</p>';
    }
    for (i = 0; i < printersCache.length; i++) {
      var p = printersCache[i];
      html += '<button type="button" class="rs-print-printer" data-id="' + escapeHtml(p.id) + '">' +
        '<span class="rs-print-printer-name">' + escapeHtml(p.name) + '</span>' +
        '<span class="rs-print-printer-ip">' + escapeHtml(p.ip) + ':' + escapeHtml(p.port) + '</span>' +
        '</button>';
    }
    html += '<button type="button" class="rs-print-printer rs-print-printer--browser" data-id="browser">' +
      '<span class="rs-print-printer-name">Navegador</span>' +
      '<span class="rs-print-printer-ip">Diálogo del sistema</span>' +
      '</button>';
    printersListNode.innerHTML = html;

    var previous = getStoredPrinterId();
    var found = previous === 'browser';
    for (i = 0; i < printersCache.length; i++) {
      if (printersCache[i].id === previous) {
        found = true;
        break;
      }
    }
    setSelectedPrinter(found && previous ? previous : (printersCache.length ? printersCache[0].id : 'browser'));
  }

  function loadPrinters() {
    if (Array.isArray(window.RS_PRINTERS) && window.RS_PRINTERS.length && !printersCache.length) {
      populatePrinterSelect(window.RS_PRINTERS);
    }
    return fetch(getPrintEndpoint(), {
      method: 'GET',
      credentials: 'same-origin',
      headers: { 'Accept': 'application/json' }
    }).then(function (res) {
      return res.json();
    }).then(function (data) {
      if (data && data.ok && Array.isArray(data.printers)) {
        window.RS_PRINTERS = data.printers;
        populatePrinterSelect(data.printers);
      } else if (!printersCache.length) {
        populatePrinterSelect(window.RS_PRINTERS || []);
      }
    }).catch(function () {
      if (!printersListNode || printersListNode.children.length === 0) {
        populatePrinterSelect(window.RS_PRINTERS || []);
      }
    });
  }

  function printToNetworkPrinter(printerId, size) {
    if (!canvasNode || typeof canvasNode.toBlob !== 'function') {
      return Promise.reject(new Error('Este navegador no puede enviar el ticket a la impresora de red.'));
    }
    return new Promise(function (resolve, reject) {
      canvasNode.toBlob(function (blob) {
        if (!blob) {
          reject(new Error('No se pudo generar la imagen del ticket.'));
          return;
        }
        var fd = new FormData();
        fd.append('printer_id', printerId);
        fd.append('paper', size);
        fd.append('image', blob, 'ticket.png');
        fetch(getPrintEndpoint(), {
          method: 'POST',
          body: fd,
          credentials: 'same-origin'
        }).then(function (res) {
          return res.json().then(function (data) {
            data = data || {};
            data.httpStatus = res.status;
            return data;
          });
        }).then(function (data) {
          if (data && data.ok) {
            resolve(data);
            return;
          }
          reject(new Error((data && data.error) || 'No se pudo imprimir en la impresora de red.'));
        }).catch(function (err) {
          reject(err);
        });
      }, 'image/png');
    });
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

  function suggestedDownloadName() {
    var map = {
      TICKETCOMANDA: 'comanda.pdf',
      TICKETPRECUENTA: 'precuenta.pdf',
      TICKETCREDITOS: 'ticket-credito.pdf',
      FACTURACOMPRAS: 'factura.pdf',
      TICKET: 'ticket.pdf'
    };
    return map[currentType] || 'documento.pdf';
  }

  function triggerBlobDownload(blob, filename) {
    var url = URL.createObjectURL(blob);
    var link = document.createElement('a');
    link.href = url;
    link.download = filename;
    link.style.display = 'none';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    setTimeout(function () {
      URL.revokeObjectURL(url);
    }, 2000);
  }

  function downloadCurrentDocument() {
    if (!currentUrl && !(previewRendered && canvasNode)) {
      return;
    }
    if (statusNode) {
      statusNode.textContent = 'Preparando descarga...';
    }

    var finishPngFallback = function () {
      if (!previewRendered || !canvasNode || typeof canvasNode.toBlob !== 'function') {
        if (statusNode) {
          statusNode.textContent = 'No se pudo descargar. Usa Nueva pestaña.';
        }
        return;
      }
      canvasNode.toBlob(function (blob) {
        if (!blob) {
          if (statusNode) {
            statusNode.textContent = 'No se pudo descargar. Usa Nueva pestaña.';
          }
          return;
        }
        triggerBlobDownload(blob, suggestedDownloadName().replace(/\.pdf$/i, '.png'));
        if (statusNode) {
          statusNode.textContent = 'Descarga iniciada.';
        }
      }, 'image/png');
    };

    if (!currentUrl) {
      finishPngFallback();
      return;
    }

    var absUrl = currentUrl;
    try {
      absUrl = new URL(currentUrl, window.location.href).toString();
    } catch (err) {
      // keep relative
    }

    fetch(absUrl, { credentials: 'same-origin' })
      .then(function (res) {
        if (!res.ok) {
          throw new Error('HTTP ' + res.status);
        }
        return res.blob();
      })
      .then(function (blob) {
        if (!blob || blob.size < 50) {
          throw new Error('Archivo vacío');
        }
        triggerBlobDownload(blob, suggestedDownloadName());
        if (statusNode) {
          statusNode.textContent = 'Descarga iniciada.';
        }
      })
      .catch(function () {
        finishPngFallback();
      });
  }

  function printDocument() {
    if (printBusy) {
      return;
    }
    var size = getSelectedPaperSize();
    applyPaperPreviewClass(size);

    var printerId = getSelectedPrinterId();
    if (printerId && printerId !== 'browser') {
      if (!previewRendered) {
        if (statusNode) {
          statusNode.textContent = 'Espera a que cargue la vista previa para enviar a la impresora de red.';
        }
        return;
      }
      printBusy = true;
      if (printButtonNode) {
        printButtonNode.disabled = true;
      }
      if (statusNode) {
        statusNode.textContent = 'Enviando a ' + getSelectedPrinterLabel() + '...';
      }
      try {
        window.localStorage.setItem(PRINT_STORAGE_KEY, printerId);
      } catch (err) {
        // ignore
      }
      printToNetworkPrinter(printerId, size)
        .then(function (data) {
          if (statusNode) {
            statusNode.textContent = (data && data.message) ? data.message : 'Ticket enviado a la impresora.';
          }
        })
        .catch(function (err) {
          if (statusNode) {
            statusNode.textContent = (err && err.message) ? err.message : 'No se pudo imprimir en red.';
          }
        })
        .then(function () {
          printBusy = false;
          if (printButtonNode) {
            printButtonNode.disabled = false;
          }
        });
      return;
    }

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
          '<aside class="rs-print-sidebar">' +
            '<div class="rs-print-sidebar-top">' +
              '<h4 class="rs-print-sidebar-title">Impresoras</h4>' +
              '<span class="rs-print-badge" id="rs-print-badge">Ticket</span>' +
            '</div>' +
            '<div class="rs-print-paper-row">' +
              '<label class="rs-print-paper-label" for="rs-print-paper">Papel</label>' +
              '<select id="rs-print-paper" class="form-control rs-print-paper-select">' +
                '<option value="58">58 mm</option>' +
                '<option value="80" selected>80 mm</option>' +
                '<option value="a4">A4</option>' +
              '</select>' +
            '</div>' +
            '<div class="rs-print-printers" id="rs-print-printers"></div>' +
            '<button type="button" class="btn btn-primary rs-print-send" data-rs-action="print"><i class="fa fa-print"></i> Enviar a imprimir</button>' +
            '<p class="rs-print-status" id="rs-print-status">Cargando documento...</p>' +
            '<div class="rs-print-sidebar-actions">' +
              '<button type="button" class="btn btn-default" data-rs-action="newtab"><i class="fa fa-external-link"></i> Nueva pestaña</button>' +
              '<button type="button" class="btn btn-default" data-rs-action="download"><i class="fa fa-download"></i> Descargar</button>' +
              '<button type="button" class="btn btn-danger" data-rs-action="close"><i class="fa fa-times"></i> Cerrar</button>' +
            '</div>' +
          '</aside>' +
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
    printersListNode = document.getElementById('rs-print-printers');
    printButtonNode = wrapper.querySelector('[data-rs-action="print"]');
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
    wrapper.querySelector('[data-rs-action="download"]').addEventListener('click', function (event) {
      event.preventDefault();
      event.stopPropagation();
      downloadCurrentDocument();
    });
    wrapper.querySelector('[data-rs-action="print"]').addEventListener('click', printDocument);

    if (printersListNode) {
      populatePrinterSelect(window.RS_PRINTERS || []);
      printersListNode.addEventListener('click', function (event) {
        var btn = event.target.closest ? event.target.closest('.rs-print-printer') : null;
        if (!btn || !printersListNode.contains(btn)) {
          return;
        }
        setSelectedPrinter(btn.getAttribute('data-id'));
        if (statusNode && previewRendered) {
          statusNode.textContent = 'Seleccionada: ' + getSelectedPrinterLabel() + '. Pulsa Enviar a imprimir.';
        }
      });
    }

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

    loadPrinters().then(function () {
      if (statusNode && previewRendered) {
        statusNode.textContent = 'Vista previa lista. Elige impresora a la derecha y envía.';
      }
    });

    renderPreviewToCanvas(url, type)
      .then(function () {
        previewRendered = true;
        if (loadingNode) {
          loadingNode.className = 'rs-print-loading is-hidden';
        }
        if (statusNode) {
          statusNode.textContent = 'Vista previa lista. Elige impresora a la derecha y envía.';
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
    if (anchor.hasAttribute('download')) {
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
