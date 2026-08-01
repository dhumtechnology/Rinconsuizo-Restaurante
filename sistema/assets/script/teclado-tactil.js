/**
 * STUB del teclado legacy.
 * Si el teclado de observaciones ya está activo, no hacer nada.
 */
(function (window, document) {
  'use strict';

  if (window.__TECLADO_OBS_LOADED || (window.TecladoTactil && window.TecladoTactil.__v === 'obs-only-1')) {
    return;
  }

  function killLegacyOnly() {
    var n = document.getElementById('teclado-tactil');
    if (n && n.parentNode) n.parentNode.removeChild(n);
  }

  killLegacyOnly();
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', killLegacyOnly);
  }
})(window, document);
