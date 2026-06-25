window.codmesaActiva = '';
window.carritoQueue = [];
window.carritoProcessing = false;
window.carritoRequestSeq = 0;
window.ventasAccionSubmit = 'btn-venta';

$(document).on('click', '#btn-venta', function() {
    window.ventasAccionSubmit = 'btn-venta';
});
$(document).on('click', '#btn-agregapedidos', function() {
    window.ventasAccionSubmit = 'btn-agregapedidos';
});

function processCarritoQueue() {
    if (window.carritoProcessing || window.carritoQueue.length === 0) {
        return;
    }
    window.carritoProcessing = true;
    var job = window.carritoQueue.shift();
    var payload = job.payload;
    if (window.codmesaActiva) {
        payload.codmesa = window.codmesaActiva;
    }
    var seq = ++window.carritoRequestSeq;
    $.post('carritoventas.php', payload, function(data) {
        if (seq === window.carritoRequestSeq) {
            if (job.callback) {
                job.callback(data);
            }
        }
        window.carritoProcessing = false;
        processCarritoQueue();
    }, 'json').fail(function() {
        window.carritoProcessing = false;
        processCarritoQueue();
    });
}

function postCarrito(payload, callback) {
    window.carritoQueue.push({ payload: payload, callback: callback });
    processCarritoQueue();
}

function escHtml(str) {
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#39;');
}

function escJs(str) {
    return String(str).replace(/\\/g, '\\\\').replace(/'/g, "\\'");
}

function toggleAccionesPedido() {
    if ($('#recibemesa input#codventa').length && $('#recibemesa input#codventa').val() !== '') {
        $('#btn-agregapedidos').show();
        $('#btn-venta').hide();
    } else {
        $('#btn-venta').show();
        $('#btn-agregapedidos').hide();
    }
}

function cargarCarritoMesa(codmesa, callback) {
    window.codmesaActiva = codmesa;
    window.carritoQueue = [];
    window.carritoProcessing = false;
    window.carritoRequestSeq++;

    var tienePedidoActivo = $('#recibemesa input#codventa').length && $('#recibemesa input#codventa').val() !== '';

    function finalizarCarga(data) {
        pintarCarritoDesdeServidor(data);
        if (typeof toggleAccionesPedido === 'function') {
            toggleAccionesPedido();
        }
        if (callback) {
            callback(data);
        }
    }

    postCarrito({ cambiarMesa: codmesa }, function(data) {
        if (tienePedidoActivo) {
            postCarrito({ MiCarritoV: JSON.stringify({ Codigo: 'vaciar' }), codmesa: codmesa }, finalizarCarga);
        } else {
            finalizarCarga(data);
        }
    });
}

function pintarCarritoDesdeServidor(data) {
    $("#carrito tbody").html("");
    var SubtotalFact = 0;
    var BaseImpIva1 = 0;
    var contador = 0;
    var TotalCompra = 0;
    var er_num = /^([0-9])*[.]?[0-9]*$/;

    if (!data || !data.length) {
        var filaVacia = "<tr><td colspan=4><center><label><h5>NO HAY PRODUCTOS AGREGADOS</h5></label></center></td></tr>";
        $(filaVacia).appendTo("#carrito tbody");
        $("#lblsubtotal").text("0.00");
        $("#lblsubtotal2").text("0.00");
        $("#lbliva").text("0.00");
        $("#lbldescuento").text("0.00");
        $("#lbltotal").text("0.00");
        $("#txtsubtotal").val("0.00");
        $("#txtsubtotal2").val("0.00");
        $("#txtIva").val("0.00");
        $("#txtDescuento").val("0.00");
        $("#txtTotal").val("0.00");
        $("#txtTotalCompra").val("0.00");
        return;
    }

    $.each(data, function(i, item) {
        var cantsincero = item.cantidad;
        if (!er_num.test(cantsincero)) {
            return;
        }
        contador = contador + 1;
        var OperacionCompra = parseFloat(item.precio);
        TotalCompra = parseFloat(TotalCompra) + parseFloat(OperacionCompra);
        var Operacion = parseFloat(item.precio2) * parseFloat(item.cantidad);
        var Operacion3 = parseFloat(item.precioconiva) * parseFloat(item.cantidad);
        var Subbaseimponiva = Operacion3.toFixed(2);
        BaseImpIva1 = parseFloat(BaseImpIva1) + parseFloat(Subbaseimponiva);
        var ivg = $('input#iva').val();
        var ivg2 = ivg / 100;
        var TotalIvaGeneral = parseFloat(BaseImpIva1) * parseFloat(ivg2.toFixed(2));
        SubtotalFact = parseFloat(SubtotalFact) + parseFloat(Operacion.toFixed(2));
        var BaseImpIva2 = parseFloat(SubtotalFact) - parseFloat(BaseImpIva1);
        var desc = $('input#descuento').val() || 0;
        var desc2 = desc / 100;
        var Total = parseFloat(BaseImpIva1) + parseFloat(BaseImpIva2) + parseFloat(TotalIvaGeneral);
        var TotalDescuentoGeneral = parseFloat(Total.toFixed(2)) * parseFloat(desc2.toFixed(2));
        var TotalFactura = parseFloat(Total.toFixed(2)) - parseFloat(TotalDescuentoGeneral.toFixed(2));

        var codigoEsc = escHtml(item.txtCodigo);
        var descEsc = escHtml(item.descripcion);
        var codigoJs = escJs(item.txtCodigo);
        var descJs = escJs(item.descripcion);
        var nuevaFila =
            "<tr align='center' style='font-size:13px;' " +
            "data-codigo='" + codigoEsc + "' " +
            "data-descripcion='" + descEsc + "' " +
            "data-existencia='" + escHtml(item.existencia) + "' " +
            "data-precio='" + escHtml(item.precio) + "' " +
            "data-precio2='" + escHtml(item.precio2) + "' " +
            "data-precioconiva='" + escHtml(item.precioconiva) + "' " +
            "data-ivaproducto='" + escHtml(item.ivaproducto) + "' " +
            "data-tipo='" + escHtml(item.tipo) + "'>" +
            "<td>" +
            '<button class="btn btn-info btn-xs" style="cursor:pointer;" onclick="addItem(' +
            "'" + codigoJs + "'," +
            "'-1'," +
            "'" + descJs + "'," +
            "'" + item.existencia + "'," +
            "'" + item.precio + "'," +
            "'" + item.precio2 + "'," +
            "'" + item.precioconiva + "'," +
            "'" + item.ivaproducto + "'," +
            "'" + item.tipo + "', " +
            "'-'" +
            ')"' +
            " type='button'><span class='fa fa-minus'></span></button>" +
            "<input type='text' class='cart-qty-input' data-codigo='" + codigoEsc + "' style='width:35px;height:22px;border:#FF0000;' value='" + item.cantidad + "'><input type='hidden' value='" + item.precio + "'>" +
            '<button class="btn btn-info btn-xs" style="cursor:pointer;" onclick="addItem(' +
            "'" + codigoJs + "'," +
            "'+1'," +
            "'" + descJs + "'," +
            "'" + item.existencia + "'," +
            "'" + item.precio + "'," +
            "'" + item.precio2 + "'," +
            "'" + item.precioconiva + "'," +
            "'" + item.ivaproducto + "'," +
            "'" + item.tipo + "', " +
            "'+'" +
            ')"' +
            " type='button'><span class='fa fa-plus'></span></button></td>" +
            "<td><input type='hidden' value='" + codigoEsc + "'><input type='hidden' value='" + item.existencia + "'>" + descEsc + "<input type='hidden' value='" + item.tipo + "'></td>" +
            "<td>" + item.precio2 + "<input type='hidden' value='" + item.precioconiva + "'><input type='hidden' value='" + item.ivaproducto + "'><input type='hidden' value='" + OperacionCompra.toFixed(2) + "'><input type='hidden' value='" + Operacion.toFixed(2) + "'></td>" +
            "<td>" +
            '<button class="btn btn-info btn-xs" style="cursor:pointer;color:#fff;" onclick="addItem(' +
            "'" + codigoJs + "'," +
            "'0'," +
            "'" + descJs + "'," +
            "'" + item.existencia + "'," +
            "'" + item.precio + "'," +
            "'" + item.precio2 + "'," +
            "'" + item.precioconiva + "'," +
            "'" + item.ivaproducto + "'," +
            "'" + item.tipo + "', " +
            "'='" +
            ')" type="button"><span class="fa fa-trash-o"></span></button>' +
            "</td></tr>";
        $(nuevaFila).appendTo("#carrito tbody");

        $("#lblsubtotal").text(BaseImpIva1.toFixed(2));
        $("#lblsubtotal2").text(BaseImpIva2.toFixed(2));
        $("#lbliva").text(TotalIvaGeneral.toFixed(2));
        $("#lbldescuento").text(TotalDescuentoGeneral.toFixed(2));
        $("#lbltotal").text(TotalFactura.toFixed(2));
        $("#txtsubtotal").val(BaseImpIva1.toFixed(2));
        $("#txtsubtotal2").val(BaseImpIva2.toFixed(2));
        $("#txtIva").val(TotalIvaGeneral.toFixed(2));
        $("#txtDescuento").val(TotalDescuentoGeneral.toFixed(2));
        $("#txtTotal").val(TotalFactura.toFixed(2));
        $("#txtTotalCompra").val(TotalCompra.toFixed(2));
    });
}

function DoAction(codproducto, producto, codcategoria, precioconiva, preciocompra, precioventa, ivaproducto, existencia) {
    addItem(codproducto, 1, producto, existencia, preciocompra, precioventa, precioconiva, ivaproducto, codcategoria, '+=');
}

function pulsar(e, valor) {
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla == 13) comprueba(valor)
}

$(document).ready(function() {

    $("#busquedaproducto").keypress(function(e) {
        if (e.charCode == 13 || e.keyCode == 13) { //ENTER
            //if(e.which == 13) {
            var codcliente = $('input#codcliente').val();
            var code = $('input#codproducto').val();
            var prod = $('input#busquedaproducto').val();
            var prec = $('input#precio2').val();
            var cantp = $('input#cantidad').val();
            var exist = $('input#existencia').val();
            var tip = $('select#codcategoria').val();
            var ivgprod = $('input#ivaproducto').val();
            var er_num = /^([0-9])*[.]?[0-9]*$/;
            //cantp = parseInt(cantp);
            //exist = parseInt(exist);
            exist = exist;
            cantp = cantp;

            if (code == "") {
                $("#codproducto").focus();
                $("#codproducto").css('border-color', '#01ba9a');
                alert("Ingrese Codigo de Producto");
                return false;

            } else if (prod == "") {
                $("#busquedaproducto").focus();
                $("#busquedaproducto").css('border-color', '#01ba9a');
                alert("Ingrese Descripcion de Producto");
                return false;

            } else if (prec == "") {
                $("#precio2").focus();
                $("#precio2").css('border-color', '#01ba9a');
                alert("Ingrese Precio de Venta de Producto");
                return false;

            } else if ($('#cantidad').val() == "") {
                $("#cantidad").focus();
                $("#cantidad").css('border-color', '#01ba9a');
                alert("Ingrese Cantidad de Producto");
                return false;

            } else if (isNaN($('#cantidad').val())) {
                $("#cantidad").focus();
                $("#cantidad").css('border-color', '#01ba9a');
                alert("Ingrese solo Numeros en Cantidad");
                return false;

            } else if (cantp > exist) {
                $("#cantidad").focus();
                $("#cantidad").css('border-color', '#01ba9a');
                alert("Actualmente existen " + exist + " Productos en Almacen y Usted Solicito " + cantp + " Productos de: " + prod);
                return false;

            } else {

                var CarritoV = new Object();
                CarritoV.Codigo = $('input#codproducto').val();
                CarritoV.Tipo = $('input#codcategoria').val();
                CarritoV.Cantidad = $('input#cantidad').val();
                CarritoV.Precio = $('input#precio').val();
                CarritoV.Precio2 = $('input#precio2').val();
                CarritoV.Precioconiva = $('input#precioconiva').val();
                CarritoV.Ivaproducto = $('input#ivaproducto').val();
                CarritoV.Descripcion = $('input#busquedaproducto').val();
                CarritoV.Existencia = $('input#existencia').val();
                CarritoV.opCantidad = '+=';
                var DatosJson = JSON.stringify(CarritoV);
                postCarrito({ MiCarritoV: DatosJson }, function(data) {
                    pintarCarritoDesdeServidor(data);
                    var busqueda = document.getElementById('busquedaproducto');
                    if (busqueda) {
                        busqueda.focus({ preventScroll: true });
                    }
                    LimpiarTexto();
                });
                return false;
            }
        }
    });


    $("#vaciarv").click(function() {
        var CarritoV = new Object();
        CarritoV.Codigo = "vaciar";
        CarritoV.Tipo = "vaciar";
        CarritoV.Cantidad = "0";
        CarritoV.Descripcion = "vaciar";
        CarritoV.Existencia = "0";
        CarritoV.Precio = "0";
        CarritoV.Precio2 = "0";
        CarritoV.Precioconiva = "0";
        CarritoV.Ivaproducto = "vaciar";
        var DatosJson = JSON.stringify(CarritoV);
        postCarrito({ MiCarritoV: DatosJson }, function(data) {
            pintarCarritoDesdeServidor(data);
            LimpiarTexto();
        });
        return false;
    });


$(document).ready(function() {
    $('#vaciarv').click(function() {
    $("#busquedaproducto").val("");
   });
});


$('document').ready(function(){

  $('#mostrar-mesa').click(function(){

  $("#error").html("");
  window.codmesaActiva = '';
  window.carritoQueue = [];
  window.carritoProcessing = false;
  window.carritoRequestSeq++;
  if (typeof mostrarVistaMesas === 'function') {
      mostrarVistaMesas();
  }
  $("#salas-mesas").load("funciones.php?MesasPanel=si", function() {
      if (typeof actualizarTimersMesas === 'function') {
          actualizarTimersMesas();
      }
      if (typeof window.restaurarModoJuntarMesas === 'function') {
          window.restaurarModoJuntarMesas();
      }
  });
  $("#recibemesa").html("");
  pintarCarritoDesdeServidor([]);
        return false;

    });
});



//FUNCION PARA ACTUALIZAR CALCULO EN FACTURA DE VENTAS CON DESCUENTO
$(document).ready(function (){
          $('.calculodescuentove').keyup(function (){
        
            var txtsubtotal = $('input#txtsubtotall').val();
            var txtsubtotal2 = $('input#txtsubtotall2').val();
            var txtIva = $('input#txtIvaa').val();
            var desc = $('input#descuento').val();
            descuento  = desc/100;
                        
            //REALIZO EL CALCULO CON EL DESCUENTO INDICADO
            Subtotal = parseFloat(txtsubtotal) + parseFloat(txtsubtotal2) + parseFloat(txtIva); 
            TotalDescuentoGeneral   = parseFloat(Subtotal.toFixed(2)) * parseFloat(descuento.toFixed(2));
            TotalFactura   = parseFloat(Subtotal.toFixed(2)) - parseFloat(TotalDescuentoGeneral.toFixed(2));        
        
            $("#lbldescuentoo").text(TotalDescuentoGeneral.toFixed(2));
            $("#lbltotall").text(TotalFactura.toFixed(2));
            $("#txtDescuentoo").val(TotalDescuentoGeneral.toFixed(2));
            $("#txtTotall").val(TotalFactura.toFixed(2));
         });
 });


    $("#carrito tbody").on('keydown', '.cart-qty-input', function(e) {
        var element = $(this);
        var code = e.charCode || e.keyCode;
        var avalue = String.fromCharCode(code);
        if (code !== 8 && /[^\d]/ig.test(avalue)) {
            e.preventDefault();
            return;
        }
        if (element.attr('data-proc') == '1') {
            return true;
        }
        element.attr('data-proc', '1');
        var row = element.closest('tr');
        setTimeout(function() {
            if (element.attr('data-proc') == '1') {
                var value = element.val() || 0;
                addItem(
                    row.attr('data-codigo'),
                    value,
                    row.attr('data-descripcion'),
                    row.attr('data-existencia'),
                    row.attr('data-precio'),
                    row.attr('data-precio2'),
                    row.attr('data-precioconiva'),
                    row.attr('data-ivaproducto'),
                    row.attr('data-tipo'),
                    '=',
                    false
                );
                element.attr('data-proc', '0');
            }
        }, 500);
    });
});

function LimpiarTexto() {
    $("#buscacliente").val("");
    $("#resultado").html("");
    $("#codproducto").val("");
    $("#busquedaproducto").val("");
    $("#precio").val("");
    $("#precio2").val("");
    $("#precioconiva").val("");
    $("#ivaproducto").val("");
    $("#codcategoria").val("");
    $("#existencia").val("");
    $("#cantidad").val("1");
}

/*function AgregaCliente(codigocliente,cedcliente,nomcliente,direccliente) 
{
    $("#ventas #cliente").val( codigocliente );
    $("#ventas #cedcliente").text( cedcliente );
    $("#ventas #nomcliente").text( nomcliente );
    $("#ventas #direccliente").text( direccliente );
    //$("#ventas #tlfcliente").text( tlfcliente );
    setTimeout(function() {
                $("#buscacliente").val("");
                $("#resultado").html("");
            }, 100);
}*/

function addItem(codigo, cantidad, descripcion, existencia, precio, precio2, precioconiva, ivaproducto, tipo, opCantidad, limpiarBusqueda) {
    if (limpiarBusqueda === undefined) {
        limpiarBusqueda = (opCantidad === '+=');
    }
    var CarritoV = new Object();
    CarritoV.Codigo = codigo;
    CarritoV.Precio = precio;
    CarritoV.Precio2 = precio2;
    CarritoV.Precioconiva = precioconiva;
    CarritoV.Ivaproducto = ivaproducto;
    CarritoV.Tipo = tipo;
    CarritoV.Cantidad = cantidad;
    CarritoV.Descripcion = descripcion;
    CarritoV.Existencia = existencia;
    CarritoV.opCantidad = opCantidad;
    var DatosJson = JSON.stringify(CarritoV);
    postCarrito({ MiCarritoV: DatosJson }, function(data) {
        pintarCarritoDesdeServidor(data);
        if (limpiarBusqueda) {
            LimpiarTexto();
        }
    });
    return false;
}