function formatearMonedaHome(n) {
  var num = Math.round(parseFloat(n) || 0);
  return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}

function actualizarCarritoHeader(resp) {
  var count = resp && resp.count != null ? resp.count : 0;
  var total = resp && resp.total != null ? resp.total : 0;
  $('#_desktop_cart .header .cart-products-count').text(count);
  $('#_desktop_cart .cart-count-items').text('S/ ' + formatearMonedaHome(total));
}

function ensureRsCartModal() {
  var el = document.getElementById('rs-add-cart-modal');
  if (el) {
    return el;
  }

  el = document.createElement('div');
  el.id = 'rs-add-cart-modal';
  el.className = 'rs-add-cart-modal';
  el.setAttribute('role', 'dialog');
  el.setAttribute('aria-modal', 'true');
  el.innerHTML =
    '<div class="rs-add-cart-backdrop" data-rs-close="1"></div>' +
    '<div class="rs-add-cart-dialog" role="document">' +
      '<div class="rs-add-cart-header">' +
        '<h4><i class="fa fa-check" aria-hidden="true"></i> Producto añadido con éxito a su carrito de compras</h4>' +
        '<button type="button" class="rs-add-cart-close" data-rs-close="1" aria-label="Cerrar">&times;</button>' +
      '</div>' +
      '<div class="rs-add-cart-body">' +
        '<div class="rs-add-cart-product">' +
          '<img class="rs-add-cart-img" src="" alt="">' +
          '<div class="rs-add-cart-info">' +
            '<h6 class="rs-add-cart-name"></h6>' +
            '<p class="rs-add-cart-price"></p>' +
            '<span class="rs-add-cart-qty"></span>' +
          '</div>' +
        '</div>' +
        '<div class="rs-add-cart-summary">' +
          '<p class="rs-add-cart-count"></p>' +
          '<p class="rs-add-cart-subtotal"></p>' +
          '<p>Transporte: <b>Gratis</b></p>' +
          '<p class="rs-add-cart-total"></p>' +
          '<div class="rs-add-cart-actions">' +
            '<button type="button" class="btn btn-secondary rs-btn-continue" data-rs-close="1">CONTINUAR COMPRANDO</button> ' +
            '<a href="carrito.php" class="btn btn-primary">PASAR POR LA CAJA</a>' +
          '</div>' +
        '</div>' +
      '</div>' +
    '</div>';

  (document.body || document.documentElement).appendChild(el);
  bindRsCartModalEvents(el);
  return el;
}

function bindRsCartModalEvents(el) {
  if (el.getAttribute('data-rs-bound') === '1') {
    return;
  }
  el.setAttribute('data-rs-bound', '1');

  el.addEventListener('click', function (e) {
    var t = e.target;
    if (!t) return;
    if (t.getAttribute('data-rs-close') === '1' || (t.closest && t.closest('[data-rs-close="1"]'))) {
      e.preventDefault();
      cerrarRsCartModal();
    }
  });
}

function cerrarRsCartModal() {
  var el = document.getElementById('rs-add-cart-modal');
  if (!el) return;
  el.classList.remove('is-open');
  el.style.cssText = 'display:none !important;';
  el.setAttribute('aria-hidden', 'true');
  document.body.classList.remove('rs-modal-open');
}

function setText(el, text) {
  if (el) el.textContent = text;
}

function setHtml(el, html) {
  if (el) el.innerHTML = html;
}

function mostrarRsCartModal(data) {
  data = data || {};
  var el = ensureRsCartModal();
  if (!el) return;

  var img = el.querySelector('.rs-add-cart-img');
  if (img) {
    img.src = data.image || 'sistema/fotos/producto.png';
    img.alt = data.name || 'Producto';
  }

  setText(el.querySelector('.rs-add-cart-name'), data.name || 'Producto');
  setText(el.querySelector('.rs-add-cart-price'), 'S/ ' + formatearMonedaHome(data.price));
  setHtml(el.querySelector('.rs-add-cart-qty'), 'Cantidad: <b>' + (data.qty || 1) + '</b>');
  setText(
    el.querySelector('.rs-add-cart-count'),
    'Hay ' + (data.count != null ? data.count : 0) + ' artículos en su carrito.'
  );
  setHtml(
    el.querySelector('.rs-add-cart-subtotal'),
    'Subtotal: <b>S/ ' + formatearMonedaHome(data.total) + '</b>'
  );
  setHtml(
    el.querySelector('.rs-add-cart-total'),
    'Total: <b>S/ ' + formatearMonedaHome(data.total) + '</b>'
  );

  el.classList.add('is-open');
  el.setAttribute('aria-hidden', 'false');
  // Inline !important: evita que CSS cacheado o del tema deje el modal invisible
  el.style.cssText =
    'display:flex !important; position:fixed !important; inset:0 !important; z-index:2147483646 !important;' +
    'align-items:center !important; justify-content:center !important; padding:16px !important;';
  document.body.classList.add('rs-modal-open');
}

function leerDatosProducto(id) {
  var precio = parseFloat($('#precio_venta_' + id).val()) || 0;
  var cantidad = parseInt($('#cantidad_' + id).val(), 10) || 1;
  var name = 'Producto';
  var image = '';

  var oldModal = document.getElementById('exampleModal' + id);
  if (oldModal) {
    var omName = oldModal.querySelector('.product-name');
    var omImg = oldModal.querySelector('img.product-image, img');
    if (omName) name = (omName.textContent || '').trim() || name;
    if (omImg) image = omImg.getAttribute('src') || '';
  }

  if (!image || name === 'Producto') {
    var card = document.getElementById('precio_venta_' + id);
    var root = card && card.closest ? card.closest('article') : null;
    if (root) {
      var nameEl = root.querySelector('.product-title a, .product-title, h3 a, h3');
      var imgEl = root.querySelector('img');
      if (nameEl && name === 'Producto') name = (nameEl.textContent || '').trim() || name;
      if (imgEl && !image) image = imgEl.getAttribute('src') || '';
    }
  }

  return { name: name, image: image, price: precio, qty: cantidad };
}

var _agregarBusy = false;

function agregar(id, e) {
  if (e) {
    if (e.preventDefault) e.preventDefault();
    if (e.stopPropagation) e.stopPropagation();
  }

  if (_agregarBusy) {
    return false;
  }

  var precio_venta = $('#precio_venta_' + id).val();
  var cantidad = $('#cantidad_' + id).val();

  if (cantidad === '' || isNaN(cantidad)) {
    alert('Esto no es un numero');
    return false;
  }
  if (precio_venta === '' || isNaN(precio_venta)) {
    alert('Esto no es un numero');
    return false;
  }

  var producto = leerDatosProducto(id);
  _agregarBusy = true;

  $.ajax({
    type: 'POST',
    url: 'agregar_tmp.php',
    dataType: 'json',
    xhrFields: { withCredentials: true },
    data: {
      id: id,
      precio_venta: precio_venta,
      cantidad: cantidad
    },
    success: function (resp) {
      if (!resp || resp.ok === false || resp.ok === 'false') {
        alert('No se pudo agregar el producto al carrito.');
        return;
      }

      actualizarCarritoHeader(resp);
      try {
        mostrarRsCartModal({
          name: producto.name,
          image: producto.image,
          price: producto.price,
          qty: producto.qty,
          count: resp.count,
          total: resp.total
        });
      } catch (err) {
        // Si falla el modal, al menos confirmar
        alert('Producto añadido al carrito.');
      }
    },
    error: function (xhr) {
      // A veces PHP manda HTML/aviso y jQuery no parsea JSON
      var resp = null;
      try {
        resp = JSON.parse(xhr.responseText);
      } catch (ignore) {}
      if (resp && resp.ok) {
        actualizarCarritoHeader(resp);
        mostrarRsCartModal({
          name: producto.name,
          image: producto.image,
          price: producto.price,
          qty: producto.qty,
          count: resp.count,
          total: resp.total
        });
        return;
      }
      alert('No se pudo agregar el producto al carrito.');
    },
    complete: function () {
      _agregarBusy = false;
    }
  });

  return false;
}

// Preparar modal al cargar
$(function () {
  ensureRsCartModal();
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      cerrarRsCartModal();
    }
  });
});
