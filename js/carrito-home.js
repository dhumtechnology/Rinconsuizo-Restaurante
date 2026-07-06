function formatearMonedaHome(n) {
  var num = Math.round(parseFloat(n) || 0);
  return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}

function actualizarCarritoHeader(resp) {
  $('#_desktop_cart .header .cart-products-count').text(resp.count);
  $('#_desktop_cart .cart-count-items').text('$ ' + formatearMonedaHome(resp.total));
}

function actualizarModalCarrito(modalEl, resp) {
  var $modal = $(modalEl);
  $modal.find('.cart-content .cart-products-count').text(
    'Hay ' + resp.count + ' artículos en su carrito.'
  );
  $modal.find('.js-cart-subtotal').html(
    'Subtotal: <b>$ ' + formatearMonedaHome(resp.total) + '</b>'
  );
  $modal.find('.js-cart-total').html(
    'Total: <b>$ ' + formatearMonedaHome(resp.total) + '</b>'
  );
}

function agregar(id, e) {
  if (e && e.preventDefault) {
    e.preventDefault();
  }

  var precio_venta = $('#precio_venta_' + id).val();
  var cantidad = $('#cantidad_' + id).val();

  if (isNaN(cantidad)) {
    alert('Esto no es un numero');
    document.getElementById('cantidad_' + id).focus();
    return false;
  }
  if (isNaN(precio_venta)) {
    alert('Esto no es un numero');
    document.getElementById('precio_venta_' + id).focus();
    return false;
  }

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
    success: function(resp) {
      if (!resp || !resp.ok) {
        return;
      }

      actualizarCarritoHeader(resp);

      var modalEl = document.getElementById('exampleModal' + id);
      if (modalEl) {
        actualizarModalCarrito(modalEl, resp);
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
          bootstrap.Modal.getOrCreateInstance(modalEl).show();
        }
      }
    },
    error: function() {
      alert('No se pudo agregar el producto al carrito.');
    }
  });

  return false;
}
