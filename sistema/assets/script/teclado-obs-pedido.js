/**
 * Teclado táctil — ÚNICAMENTE para #observaciones-pedido al crear una orden.
 * API pública: window.TecladoObservacionesPedido (no la pisan stubs legacy).
 */
(function (window, document) {
  'use strict';

  var ALLOWED_ID = 'observaciones-pedido';
  var ROOT_ID = 'teclado-obs-pedido';
  var VERSION = 'obs-only-1';

  var LAYOUTS = {
    letters: [
      ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'],
      ['q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'o', 'p'],
      ['a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'ñ'],
      ['shift', 'z', 'x', 'c', 'v', 'b', 'n', 'm', 'back'],
      ['sym', 'á', 'é', 'í', 'ó', 'ú', 'ü', '¿', '¡', 'space', 'enter']
    ],
    lettersShift: [
      ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'],
      ['Q', 'W', 'E', 'R', 'T', 'Y', 'U', 'I', 'O', 'P'],
      ['A', 'S', 'D', 'F', 'G', 'H', 'J', 'K', 'L', 'Ñ'],
      ['shift', 'Z', 'X', 'C', 'V', 'B', 'N', 'M', 'back'],
      ['sym', 'Á', 'É', 'Í', 'Ó', 'Ú', 'Ü', '?', '!', 'space', 'enter']
    ],
    numbers: [
      ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'],
      ['-', '/', ':', ';', '(', ')', '$', '&', '@', '"'],
      ['.', ',', '?', '!', "'", '°', '%', '+', '=', 'back'],
      ['abc', 'sym', '*', '#', 'space', 'enter']
    ],
    symbols: [
      ['[', ']', '{', '}', '#', '%', '^', '*', '+', '='],
      ['_', '\\', '|', '~', '<', '>', '€', '£', '¥', '•'],
      ['¿', '¡', '«', '»', '°', '±', '×', '÷', 'back'],
      ['abc', '123', '@', '&', '-', 'space', 'enter']
    ]
  };

  var state = {
    target: null,
    shift: false,
    mode: 'letters',
    ignoreOutsideUntil: 0
  };

  var root = null;

  function currentLayout() {
    if (state.mode === 'numbers') return LAYOUTS.numbers;
    if (state.mode === 'symbols') return LAYOUTS.symbols;
    return state.shift ? LAYOUTS.lettersShift : LAYOUTS.letters;
  }

  function keyLabel(key) {
    if (key === 'shift') return '⇧';
    if (key === 'back') return '⌫';
    if (key === 'space') return 'espacio';
    if (key === 'enter') return 'intro';
    if (key === '123') return '123';
    if (key === 'abc') return 'ABC';
    if (key === 'sym') return '#@';
    return key;
  }

  function keyClass(key) {
    var cls = 'tt-key';
    if (key === 'shift') cls += ' tt-wide tt-shift' + (state.shift ? ' tt-on' : '');
    else if (key === 'back') cls += ' tt-wide tt-back';
    else if (key === 'space') cls += ' tt-space';
    else if (key === 'enter') cls += ' tt-wide tt-enter';
    else if (key === '123' || key === 'abc' || key === 'sym') cls += ' tt-wide tt-mode';
    return cls;
  }

  function escapeHtml(s) {
    return String(s).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
  }

  function escapeAttr(s) {
    return String(s).replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/</g, '&lt;');
  }

  function modeTab(id, label) {
    var active = state.mode === id ? ' tt-tab-on' : '';
    return '<button type="button" class="tt-tab' + active + '" data-key="mode:' + id + '">' + label + '</button>';
  }

  function render() {
    if (!root) return;
    var layout = currentLayout();
    var html = '';
    html += '<div class="tt-bar"><div class="tt-tabs">';
    html += modeTab('letters', 'ABC') + modeTab('numbers', '123') + modeTab('symbols', '#@');
    html += '</div><button type="button" class="tt-key tt-close" data-key="hide" title="Cerrar">✕</button></div>';
    for (var r = 0; r < layout.length; r++) {
      html += '<div class="tt-row">';
      for (var c = 0; c < layout[r].length; c++) {
        var key = layout[r][c];
        html += '<button type="button" class="' + keyClass(key) + '" data-key="' + escapeAttr(key) + '">' +
          escapeHtml(keyLabel(key)) + '</button>';
      }
      html += '</div>';
    }
    root.innerHTML = html;
  }

  function ensureRoot() {
    var slot = document.getElementById('teclado-obs-slot');
    if (root && document.body && document.body.contains(root)) {
      // Si existe el slot del pedido y el teclado no está ahí, moverlo
      if (slot && root.parentNode !== slot) {
        slot.appendChild(root);
      }
      return root;
    }
    root = document.getElementById(ROOT_ID);
    if (!root) {
      root = document.createElement('div');
      root.id = ROOT_ID;
      root.style.display = 'none';
    }
    if (slot) {
      slot.appendChild(root);
    } else {
      (document.body || document.documentElement).appendChild(root);
    }
    root.onmousedown = function (e) {
      e.preventDefault();
      state.ignoreOutsideUntil = Date.now() + 400;
    };
    root.ontouchstart = function () {
      state.ignoreOutsideUntil = Date.now() + 400;
    };
    root.onclick = function (e) {
      var t = e.target;
      while (t && t !== root && !(t.getAttribute && t.getAttribute('data-key'))) {
        t = t.parentNode;
      }
      if (!t || t === root) return;
      e.preventDefault();
      e.stopPropagation();
      handleKey(t.getAttribute('data-key'));
    };
    return root;
  }

  function getObsField() {
    return document.getElementById(ALLOWED_ID);
  }

  function dispatchInput(el) {
    try {
      el.dispatchEvent(new Event('input', { bubbles: true }));
      el.dispatchEvent(new Event('keyup', { bubbles: true }));
    } catch (err) { /* ignore */ }
    if (window.jQuery) {
      try { window.jQuery(el).trigger('input').trigger('keyup'); } catch (e2) { /* ignore */ }
    }
  }

  function insertText(text) {
    var el = state.target;
    if (!el || el.id !== ALLOWED_ID) return;
    try { el.focus(); } catch (e) { /* ignore */ }
    var start = typeof el.selectionStart === 'number' ? el.selectionStart : (el.value || '').length;
    var end = typeof el.selectionEnd === 'number' ? el.selectionEnd : (el.value || '').length;
    var value = el.value || '';
    el.value = value.slice(0, start) + text + value.slice(end);
    var pos = start + text.length;
    try { el.setSelectionRange(pos, pos); } catch (e2) { /* ignore */ }
    dispatchInput(el);
  }

  function backspace() {
    var el = state.target;
    if (!el || el.id !== ALLOWED_ID) return;
    try { el.focus(); } catch (e) { /* ignore */ }
    var start = typeof el.selectionStart === 'number' ? el.selectionStart : (el.value || '').length;
    var end = typeof el.selectionEnd === 'number' ? el.selectionEnd : (el.value || '').length;
    var value = el.value || '';
    if (start === end && start > 0) {
      el.value = value.slice(0, start - 1) + value.slice(end);
      try { el.setSelectionRange(start - 1, start - 1); } catch (e2) { /* ignore */ }
    } else if (start !== end) {
      el.value = value.slice(0, start) + value.slice(end);
      try { el.setSelectionRange(start, start); } catch (e3) { /* ignore */ }
    }
    dispatchInput(el);
  }

  function setMode(mode) {
    state.mode = mode;
    state.shift = false;
    state.ignoreOutsideUntil = Date.now() + 400;
    render();
    if (state.target) {
      try { state.target.focus(); } catch (e) { /* ignore */ }
    }
  }

  function handleKey(key) {
    if (!key) return;
    if (key === 'hide') { hide(); return; }
    if (key.indexOf('mode:') === 0) { setMode(key.split(':')[1]); return; }
    if (key === 'shift') { state.shift = !state.shift; state.ignoreOutsideUntil = Date.now() + 400; render(); return; }
    if (key === '123') { setMode('numbers'); return; }
    if (key === 'sym') { setMode('symbols'); return; }
    if (key === 'abc') { setMode('letters'); return; }
    if (key === 'back') { backspace(); return; }
    if (key === 'space') { insertText(' '); return; }
    if (key === 'enter') { insertText('\n'); return; }
    insertText(key);
    if (state.shift && state.mode === 'letters') {
      state.shift = false;
      render();
    }
  }

  function show(el) {
    el = el || getObsField();
    if (!el || el.id !== ALLOWED_ID) return false;
    if (!document.body) return false;
    ensureRoot();
    state.target = el;
    state.ignoreOutsideUntil = Date.now() + 600;
    render();
    root.className = 'tt-visible';
    root.style.display = 'block';
    root.style.visibility = 'visible';
    root.style.opacity = '1';
    root.style.position = '';
    root.style.left = '';
    root.style.bottom = '';
    root.style.zIndex = '';
    // Llevar el área de productos/teclado a la vista
    try {
      var slot = document.getElementById('teclado-obs-slot');
      if (slot && typeof slot.scrollIntoView === 'function') {
        slot.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      }
    } catch (eScroll) { /* ignore */ }
    try { el.focus(); } catch (e) { /* ignore */ }
    return true;
  }

  function hide() {
    if (!root) return;
    root.className = '';
    root.style.display = 'none';
    state.target = null;
    state.shift = false;
    state.mode = 'letters';
  }

  function openForObservaciones() {
    var el = getObsField();
    if (!el) {
      // El panel puede acabar de mostrarse: reintentar breve
      setTimeout(function () {
        var again = getObsField();
        if (again) show(again);
      }, 50);
      return;
    }
    show(el);
  }

  function closeObservaciones() {
    hide();
  }

  // Cerrar solo con clic fuera, no al abrir
  document.addEventListener('mousedown', function (e) {
    if (!root || root.style.display === 'none') return;
    if (Date.now() < state.ignoreOutsideUntil) return;
    if (root.contains(e.target)) return;
    if (state.target && (e.target === state.target || (state.target.contains && state.target.contains(e.target)))) return;
    var btn = document.getElementById('boton-observaciones') || document.getElementById('boton');
    if (btn && (e.target === btn || (btn.contains && btn.contains(e.target)))) return;
    hide();
  }, true);

  var api = {
    __ready: true,
    __v: VERSION,
    show: show,
    hide: hide,
    openForObservaciones: openForObservaciones,
    closeObservaciones: closeObservaciones
  };

  window.__TECLADO_OBS_LOADED = true;
  window.TecladoObservacionesPedido = api;
  // Alias compatible (si un stub lo pisa, seguir usando TecladoObservacionesPedido)
  window.TecladoTactil = api;
})(window, document);
