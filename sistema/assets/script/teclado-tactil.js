/**
 * Teclado virtual táctil (español latino) para el sistema POS.
 * Se muestra al enfocar o tocar inputs/textareas.
 */
(function (window, document) {
  'use strict';

  if (window.TecladoTactil && window.TecladoTactil.__ready) {
    return;
  }

  var LAYOUTS = {
    letters: [
      ['q', 'w', 'e', 'r', 't', 'y', 'u', 'i', 'o', 'p'],
      ['a', 's', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'ñ'],
      ['shift', 'z', 'x', 'c', 'v', 'b', 'n', 'm', 'back'],
      ['123', 'á', 'é', 'í', 'ó', 'ú', 'ü', '¿', '¡', 'space', 'enter']
    ],
    lettersShift: [
      ['Q', 'W', 'E', 'R', 'T', 'Y', 'U', 'I', 'O', 'P'],
      ['A', 'S', 'D', 'F', 'G', 'H', 'J', 'K', 'L', 'Ñ'],
      ['shift', 'Z', 'X', 'C', 'V', 'B', 'N', 'M', 'back'],
      ['123', 'Á', 'É', 'Í', 'Ó', 'Ú', 'Ü', '?', '!', 'space', 'enter']
    ],
    numbers: [
      ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'],
      ['-', '/', ':', ';', '(', ')', '$', '&', '@', '"'],
      ['#+=', '.', ',', '?', '!', "'", '°', '%', 'back'],
      ['ABC', '+', '=', '*', '#', 'space', 'enter']
    ],
    symbols: [
      ['[', ']', '{', '}', '#', '%', '^', '*', '+', '='],
      ['_', '\\', '|', '~', '<', '>', '€', '£', '¥', '•'],
      ['123', '.', ',', '?', '!', "'", '¿', '¡', 'back'],
      ['ABC', '@', '&', '-', 'space', 'enter']
    ]
  };

  var state = {
    target: null,
    shift: false,
    mode: 'letters',
    keepOpen: false,
    showAt: 0
  };

  var root = null;

  function isEditable(el) {
    if (!el || !el.tagName) {
      return false;
    }
    var tag = el.tagName.toLowerCase();
    if (tag === 'textarea') {
      return !el.disabled && !el.readOnly && !(el.classList && el.classList.contains('no-teclado'));
    }
    if (tag !== 'input') {
      return false;
    }
    var type = (el.getAttribute('type') || 'text').toLowerCase();
    var blocked = {
      hidden: 1, checkbox: 1, radio: 1, file: 1, submit: 1, button: 1,
      image: 1, reset: 1, color: 1, range: 1, datetime: 1, 'datetime-local': 1,
      month: 1, week: 1
    };
    if (blocked[type]) {
      return false;
    }
    if (el.disabled || el.readOnly || (el.classList && el.classList.contains('no-teclado'))) {
      return false;
    }
    return true;
  }

  function currentLayout() {
    if (state.mode === 'numbers') {
      return LAYOUTS.numbers;
    }
    if (state.mode === 'symbols') {
      return LAYOUTS.symbols;
    }
    return state.shift ? LAYOUTS.lettersShift : LAYOUTS.letters;
  }

  function keyLabel(key) {
    if (key === 'shift') return '⇧';
    if (key === 'back') return '⌫';
    if (key === 'space') return 'espacio';
    if (key === 'enter') return 'intro';
    return key;
  }

  function keyClass(key) {
    var cls = 'tt-key';
    if (key === 'shift') cls += ' tt-wide tt-shift' + (state.shift ? ' tt-on' : '');
    else if (key === 'back') cls += ' tt-wide tt-back';
    else if (key === 'space') cls += ' tt-space';
    else if (key === 'enter') cls += ' tt-wide tt-enter';
    else if (key === '123' || key === 'ABC' || key === '#+=') cls += ' tt-wide';
    return cls;
  }

  function escapeHtml(s) {
    return String(s).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
  }

  function escapeAttr(s) {
    return String(s).replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/</g, '&lt;');
  }

  function render() {
    if (!root) return;
    var layout = currentLayout();
    var html = '<div class="tt-bar"><span class="tt-title">Teclado</span><div class="tt-bar-actions">' +
      '<button type="button" class="tt-key tt-close" data-key="hide" title="Cerrar">✕</button></div></div>';
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
    if (root && document.body.contains(root)) {
      return root;
    }
    root = document.getElementById('teclado-tactil');
    if (!root) {
      root = document.createElement('div');
      root.id = 'teclado-tactil';
      root.setAttribute('aria-hidden', 'true');
      (document.body || document.documentElement).appendChild(root);
    }

    root.onmousedown = function (e) {
      e.preventDefault();
      state.keepOpen = true;
    };
    root.ontouchstart = function () {
      state.keepOpen = true;
    };

    root.onclick = function (e) {
      var t = e.target;
      while (t && t !== root && !(t.getAttribute && t.getAttribute('data-key'))) {
        t = t.parentNode;
      }
      if (!t || t === root) return;
      e.preventDefault();
      handleKey(t.getAttribute('data-key'));
    };

    return root;
  }

  function show(el) {
    if (!el || !document.body) return;
    ensureRoot();
    state.target = el;
    state.showAt = Date.now();
    render();
    root.className = 'tt-visible';
    root.style.display = 'block';
    root.setAttribute('aria-hidden', 'false');
  }

  function hide() {
    if (!root) return;
    root.className = '';
    root.style.display = 'none';
    root.setAttribute('aria-hidden', 'true');
    state.target = null;
    state.shift = false;
    state.mode = 'letters';
    state.keepOpen = false;
  }

  function dispatchInput(el) {
    try {
      el.dispatchEvent(new Event('input', { bubbles: true }));
      el.dispatchEvent(new Event('keyup', { bubbles: true }));
      el.dispatchEvent(new Event('change', { bubbles: true }));
    } catch (err) {
      if (document.createEvent) {
        var ev = document.createEvent('HTMLEvents');
        ev.initEvent('keyup', true, false);
        el.dispatchEvent(ev);
      }
    }
    if (window.jQuery) {
      try {
        window.jQuery(el).trigger('input').trigger('keyup').trigger('change');
      } catch (e2) { /* ignore */ }
    }
  }

  function insertText(text) {
    var el = state.target;
    if (!el || !isEditable(el)) return;
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
    if (!el || !isEditable(el)) return;
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

  function handleKey(key) {
    if (key === 'hide') { hide(); return; }
    if (key === 'shift') { state.shift = !state.shift; render(); return; }
    if (key === '123') { state.mode = 'numbers'; state.shift = false; render(); return; }
    if (key === '#+=') { state.mode = 'symbols'; state.shift = false; render(); return; }
    if (key === 'ABC') { state.mode = 'letters'; state.shift = false; render(); return; }
    if (key === 'back') { backspace(); return; }
    if (key === 'space') { insertText(' '); return; }
    if (key === 'enter') {
      var el = state.target;
      if (el && el.tagName && el.tagName.toLowerCase() === 'textarea') {
        insertText('\n');
      } else {
        hide();
      }
      return;
    }
    insertText(key);
    if (state.shift && state.mode === 'letters') {
      state.shift = false;
      render();
    }
  }

  function openFor(el) {
    if (isEditable(el)) {
      show(el);
    }
  }

  function onFocusIn(e) {
    openFor(e.target);
  }

  function onPointer(e) {
    openFor(e.target);
  }

  function onFocusOut() {
    setTimeout(function () {
      if (state.keepOpen) {
        state.keepOpen = false;
        if (state.target && isEditable(state.target)) {
          try { state.target.focus(); } catch (e) { /* ignore */ }
        }
        return;
      }
      // Evita cierre inmediato al abrir en pantallas táctiles
      if (Date.now() - state.showAt < 250) {
        return;
      }
      var active = document.activeElement;
      if (root && root.contains(active)) {
        return;
      }
      if (!isEditable(active)) {
        hide();
      }
    }, 200);
  }

  function init() {
    if (!document.body) {
      setTimeout(init, 50);
      return;
    }
    ensureRoot();
    render();
    root.style.display = 'none';

    document.addEventListener('focusin', onFocusIn, true);
    document.addEventListener('focusout', onFocusOut, true);
    document.addEventListener('click', onPointer, true);
    document.addEventListener('touchstart', onPointer, true);

    window.TecladoTactil = {
      __ready: true,
      init: init,
      show: show,
      hide: hide
    };
  }

  window.TecladoTactil = { __ready: false, init: init, show: show, hide: hide };

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }
})(window, document);
