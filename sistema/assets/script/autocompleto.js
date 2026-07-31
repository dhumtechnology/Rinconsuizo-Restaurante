// Autocomplete y filtro en vivo de productos / clientes / ingredientes
function initAutocompleteBusquedaProducto($input) {
    if (!$input || !$input.length || typeof $.fn.autocomplete !== 'function') {
        return;
    }
    if ($input.data('ui-autocomplete')) {
        $input.autocomplete('destroy');
    }
    $input.autocomplete({
        source: "class/buscaproductos.php",
        minLength: 1,
        delay: 100,
        select: function(event, ui) {
            $('#codproducto').val(ui.item.codproducto);
            $('#codcategoria').val(ui.item.codcategoria);
            $('#precio').val(ui.item.preciocompra);
            $('#precio2').val(ui.item.precioventa);
            $('#precioconiva').val((ui.item.ivaproducto == "SI") ? ui.item.preciocompra : "0.00");
            $('#ivaproducto').val(ui.item.ivaproducto);
            $('#existencia').val(ui.item.existencia);
            $('#codingrediente').val(ui.item.codingrediente);
            $('#cantracion').val(ui.item.cantracion);
            setTimeout(function() {
                var e = jQuery.Event("keypress");
                e.which = 13;
                e.keyCode = 13;
                $input.trigger(e);
            }, 100);
        }
    });
}

function filtrarTilesProductos(texto) {
    var q = $.trim(String(texto || '')).toLowerCase();
    var $tiles = $('.rs-prod-tile, #productos-categorias .col-md-2.mb, #delivery-productos .col-md-2.mb');
    if (!$tiles.length) {
        return;
    }
    if (q === '') {
        $tiles.show();
        return;
    }
    $tiles.each(function() {
        var $t = $(this);
        var nombre = String($t.data('nombre') || $t.find('[title]').attr('title') || $t.attr('title') || $t.text() || '').toLowerCase();
        $t.toggle(nombre.indexOf(q) !== -1);
    });
}

function bindFiltroLiveBusquedaProducto(selector) {
    var $el = $(selector);
    if (!$el.length) {
        return;
    }
    $el.off('input.rsLive keyup.rsLive').on('input.rsLive keyup.rsLive', function() {
        filtrarTilesProductos(this.value);
    });
}

function initBusquedasProductoUI() {
    initAutocompleteBusquedaProducto($("#busquedaproducto"));
    bindFiltroLiveBusquedaProducto("#busquedaproducto");
    initAutocompleteBusquedaProducto($("#productoventas"));
}

$(function() {
    initBusquedasProductoUI();

    $("#producto").keyup(function() {
        var tipoentrada = $('select#tipoentrada').val();
        if (tipoentrada == "") {
            $("#tipoentrada").focus();
            $('#tipoentrada').css('border-color', '#01ba9a');
            $("#producto").val("");
            alert("Por favor seleccione primero el Tipo de Gasto");
            return false;
        } else if (tipoentrada == "PRODUCTO") {
            $("#producto").autocomplete({
                source: "class/buscaproductos.php",
                minLength: 1,
                delay: 100,
                select: function(event, ui) {
                    $('#codproducto').val(ui.item.codproducto);
                    $('#codcategoria').val(ui.item.codcategoria);
                    $('#preciocompra').val(ui.item.preciocompra);
                    $('#precioventa').val(ui.item.precioventa);
                    $('#precioconiva').val((ui.item.ivaproducto == "SI") ? ui.item.preciocompra : "0.00");
                    $('#ivaproducto').val(ui.item.ivaproducto);
                    $('#existencia').val(ui.item.existencia);
                }
            });
            return false;
        } else if (tipoentrada == "INGREDIENTE") {
            $("#producto").autocomplete({
                source: "class/buscaingredientes.php",
                minLength: 1,
                delay: 100,
                select: function(event, ui) {
                    $('#codproducto').val(ui.item.codingrediente);
                    $('#codcategoria').val(ui.item.unidadingrediente);
                    $('#preciocompra').val(ui.item.costoingrediente);
                    $('#precioventa').val("0.00");
                    $('#ivaproducto').val("NO");
                    $('#precioconiva').val("0.00");
                }
            });
        }
    });

    $("#busquedacliente").autocomplete({
        source: "class/buscacliente.php",
        minLength: 1,
        delay: 100,
        select: function(event, ui) {
            $('#codcliente').val(ui.item.codcliente);
            $('#cliente').val(ui.item.codcliente);
        }
    });

    $("#busqueda").autocomplete({
        source: "class/buscaingredientes.php",
        minLength: 1,
        delay: 100,
        select: function(event, ui) {
            $('#codingrediente').val(ui.item.codingrediente);
            $('#unidadingrediente').val(ui.item.unidadingrediente);
        }
    });

    $("#codventa").autocomplete({
        source: "class/buscacodventa.php",
        minLength: 1,
        delay: 100,
        select: function(event, ui) {
            $('#codventa').val(ui.item.codventa);
        }
    });
});

function autocompletar(contador) {
    contador = contador.replace("busqueda[]", "");
    $("#busqueda" + contador).autocomplete({
        source: "class/buscaingredientes.php",
        minLength: 1,
        delay: 100,
        select: function(event, ui) {
            $('#codingrediente' + contador).val(ui.item.codingrediente);
            $('#unidadingrediente' + contador).val(ui.item.unidadingrediente);
        }
    });
}
