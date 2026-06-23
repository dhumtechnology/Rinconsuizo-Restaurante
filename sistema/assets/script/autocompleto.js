// FUNCION AUTOCOMPLETE PARA PRODUCTOS, SERVICIOS Y CLIENTES
$(function() {
    $("#busquedaproducto").autocomplete({
        source: "class/buscaproductos.php",
        minLength: 1,
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
                $("#busquedaproducto").trigger(e);
            }, 100);
        }
    });
});


$(function() {

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
});


$(function() {
    $("#productoventas").autocomplete({
        source: "class/buscaproductos.php",
        minLength: 1,
        select: function(event, ui) {
            $('#codproducto').val(ui.item.codproducto);
            $('#codcategoria').val(ui.item.codcategoria);
            $('#precio').val(ui.item.preciocompra);
            $('#precio2').val(ui.item.precioventa);
            $('#precioconiva').val((ui.item.ivaproducto == "SI") ? ui.item.precioventa : "0.00");
            $('#ivaproducto').val(ui.item.ivaproducto);
            $('#existencia').val(ui.item.existencia);
        }
    });
});

$(function() {
    $("#busquedacliente").autocomplete({
        source: "class/buscacliente.php",
        minLength: 1,
        select: function(event, ui) {
            $('#codcliente').val(ui.item.codcliente);
            $('#cliente').val(ui.item.codcliente);
        }
    });
});


$(function autocompletar() {
    $("#busqueda").autocomplete({
        source: "class/buscaingredientes.php",
        minLength: 1,
        select: function(event, ui) {
            $('#codingrediente').val(ui.item.codingrediente);
            //$('#nomingrediente').val(ui.item.nomingrediente);
            $('#unidadingrediente').val(ui.item.unidadingrediente);
            //$('#existencia1').val(ui.item.cantidad);
        }
    });

});

function autocompletar(contador) {
    contador = contador.replace("busqueda[]", "");
    $("#busqueda" + contador).autocomplete({
        source: "class/buscaingredientes.php",
        minLength: 1,
        select: function(event, ui) {
            $('#codingrediente' + contador).val(ui.item.codingrediente);
            //$('#nomingrediente'+contador).val(ui.item.nomingrediente);
            $('#unidadingrediente' + contador).val(ui.item.unidadingrediente);
            //$('#existencia1'+contador).val(ui.item.cantidad);
        }
    });
}


$(function() {
    $("#codventa").autocomplete({
        source: "class/buscacodventa.php",
        minLength: 1,
        select: function(event, ui) {
            $('#codventa').val(ui.item.codventa);
        }
    });
});