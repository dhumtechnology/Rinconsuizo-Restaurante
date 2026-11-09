(function () {
  function $(sel, ctx) {
    return (ctx || document).querySelector(sel);
  }
  function $all(sel, ctx) {
    return Array.prototype.slice.call((ctx || document).querySelectorAll(sel));
  }

  function toast(text) {
    var el = document.getElementById('sa-toast');
    if (!el) {
      el = document.createElement('div');
      el.id = 'sa-toast';
      el.className = 'sa-toast';
      document.body.appendChild(el);
    }
    el.textContent = text;
    el.classList.add('show');
    clearTimeout(el._t);
    el._t = setTimeout(function () { el.classList.remove('show'); }, 2200);
  }

  function friendlyHtml(html) {
    if (html == null) return '';
    if (typeof html !== 'string') html = String(html);
    var t = html.replace(/^\s+|\s+$/g, '');
    if (t === '1') {
      return '<div class="alert alert-warning">Complete los campos obligatorios.</div>';
    }
    if (t === '4') {
      return '<div class="alert alert-warning">Ese usuario ya existe en este restaurante.</div>';
    }
    return html;
  }

  function showMsg(target, html) {
    var box = typeof target === 'string' ? document.querySelector(target) : target;
    if (!box) return false;
    var out = friendlyHtml(html);
    box.innerHTML = out;
    var ok = out.indexOf('alert-success') !== -1;
    box.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    return ok;
  }

  function copyText(text) {
    if (!text) return;
    if (navigator.clipboard && navigator.clipboard.writeText) {
      navigator.clipboard.writeText(text).then(function () { toast('Copiado'); }).catch(function () {
        fallbackCopy(text);
      });
    } else {
      fallbackCopy(text);
    }
  }

  function fallbackCopy(text) {
    var ta = document.createElement('textarea');
    ta.value = text;
    document.body.appendChild(ta);
    ta.select();
    try { document.execCommand('copy'); toast('Copiado'); } catch (e) {}
    document.body.removeChild(ta);
  }

  function filterList(q) {
    q = (q || '').toLowerCase();
    $all('[data-sa-row]').forEach(function (row) {
      var hay = (row.getAttribute('data-sa-row') || row.textContent || '').toLowerCase();
      var hide = q !== '' && hay.indexOf(q) === -1;
      if (row.tagName === 'TR') {
        row.classList.toggle('is-hidden', hide);
      } else {
        row.style.display = hide ? 'none' : '';
      }
    });
  }

  function randomPass() {
    var chars = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789';
    var s = '';
    for (var i = 0; i < 12; i++) s += chars.charAt(Math.floor(Math.random() * chars.length));
    return s;
  }

  document.addEventListener('click', function (e) {
    var t = e.target.closest('[data-sa-copy], [data-sa-reveal], .sa-pass-toggle, #sa-menu-btn, #sa-overlay, [data-sa-genpass]');
    if (!t) return;

    if (t.id === 'sa-menu-btn') {
      document.body.classList.toggle('sa-nav-open');
      return;
    }
    if (t.id === 'sa-overlay') {
      document.body.classList.remove('sa-nav-open');
      return;
    }
    if (t.hasAttribute('data-sa-copy')) {
      e.preventDefault();
      copyText(t.getAttribute('data-sa-copy'));
      return;
    }
    if (t.hasAttribute('data-sa-reveal')) {
      e.preventDefault();
      var wrap = t.closest('.sa-secret');
      if (!wrap) return;
      var code = wrap.querySelector('code');
      var secret = wrap.getAttribute('data-secret') || '';
      var shown = wrap.getAttribute('data-shown') === '1';
      if (code) code.textContent = shown ? '••••••••' : secret;
      wrap.setAttribute('data-shown', shown ? '0' : '1');
      t.setAttribute('title', shown ? 'Mostrar' : 'Ocultar');
      return;
    }
    if (t.classList.contains('sa-pass-toggle')) {
      e.preventDefault();
      var id = t.getAttribute('data-target');
      var input = id ? document.getElementById(id) : t.parentNode.querySelector('input');
      if (!input) return;
      var show = input.type === 'password';
      input.type = show ? 'text' : 'password';
      t.textContent = show ? 'Ocultar' : 'Mostrar';
      return;
    }
    if (t.hasAttribute('data-sa-genpass')) {
      e.preventDefault();
      var field = document.getElementById(t.getAttribute('data-sa-genpass') || 'password');
      if (!field) return;
      field.type = 'text';
      field.value = randomPass();
      var tog = document.querySelector('.sa-pass-toggle[data-target="' + field.id + '"]');
      if (tog) tog.textContent = 'Ocultar';
      toast('Contraseña generada');
    }
  });

  document.addEventListener('input', function (e) {
    if (e.target && e.target.hasAttribute('data-sa-search')) {
      filterList(e.target.value);
    }
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') document.body.classList.remove('sa-nav-open');
  });

  window.SA = {
    toast: toast,
    showMsg: showMsg,
    friendlyHtml: friendlyHtml,
    copyText: copyText,
    randomPass: randomPass
  };
})();
