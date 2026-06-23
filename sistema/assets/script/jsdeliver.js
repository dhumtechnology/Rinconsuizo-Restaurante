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
            var tip = $('input#codcategoria').val();
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

                var Carrito = new Object();
                Carrito.Codigo = $('input#codproducto').val();
                Carrito.Tipo = $('input#codcategoria').val();
                Carrito.Cantidad = $('input#cantidad').val();
                Carrito.Precio = $('input#precio').val();
                Carrito.Precio2 = $('input#precio2').val();
                Carrito.Precioconiva = $('input#precioconiva').val();
                Carrito.Ivaproducto = $('input#ivaproducto').val();
                Carrito.Descripcion = $('input#busquedaproducto').val();
                Carrito.Existencia = $('input#existencia').val();
                Carrito.opCantidad = '+=';
                var DatosJson = JSON.stringify(Carrito);
                $.post('carritodeliver.php', {
                        MiCarritoD: DatosJson
                    },
                    function(data, textStatus) {
                        $("#carrito tbody").html("");
                        var SubtotalFact = 0;
                        var BaseImpIva1 = 0;
                        var contador = 0;
                        var iva = 0;
                        var total = 0;
                        var TotalCompra = 0;

                        $.each(data, function(i, item) {
                            var cantsincero = item.cantidad;
                            //cantsincero = parseInt(cantsincero);
                            cantsincero = cantsincero;

                            if(er_num.test(cantsincero)){
                             //if (cantsincero != 0) {
                                contador = contador + 1;

var OperacionCompra = parseFloat(item.precio);
TotalCompra = parseFloat(TotalCompra) + parseFloat(OperacionCompra);

var Operacion = parseFloat(item.precio2) * parseFloat(item.cantidad);
var Subtotal = Operacion.toFixed(2);

//CALCULO DE BASE IMPONIBLE IVA CON PORCENTAJE
var Operacion3 = parseFloat(item.precioconiva) * parseFloat(item.cantidad);
var Subbaseimponiva = Operacion3.toFixed(2);

//BASE IMPONIBLE IVA CON PORCENTAJE
BaseImpIva1 = parseFloat(BaseImpIva1) + parseFloat(Subbaseimponiva);

//CALCULO GENERAL DE IVA CON BASE IVA * IVA %
var ivg = $('input#iva').val();
ivg2 = ivg / 100;
TotalIvaGeneral = parseFloat(BaseImpIva1) * parseFloat(ivg2.toFixed(2));

//SUBTOTAL GENERAL DE FACTURA
SubtotalFact = parseFloat(SubtotalFact) + parseFloat(Subtotal);
//BASE IMPONIBLE IVA SIN PORCENTAJE
BaseImpIva2 = parseFloat(SubtotalFact) - parseFloat(BaseImpIva1);

//CALCULAMOS DESCUENTO POR PRODUCTO
var desc = $('input#descuento').val();
desc2 = desc / 100;

//CALCULO DEL TOTAL DE FACTURA
Total = parseFloat(BaseImpIva1) + parseFloat(BaseImpIva2) + parseFloat(TotalIvaGeneral);
TotalDescuentoGeneral = parseFloat(Total.toFixed(2)) * parseFloat(desc2.toFixed(2));
TotalFactura = parseFloat(Total.toFixed(2)) - parseFloat(TotalDescuentoGeneral.toFixed(2));

        var nuevaFila =
                        "<tr align='center' style='font-size:13px;'>" +
                        "<td>" +
                        '<button class="btn btn-info btn-xs" style="cursor:pointer;" onclick="addItem(' +
                        "'" + item.txtCodigo + "'," +
                        "'-1'," +
                        "'" + item.descripcion + "'," +
                        "'" + item.existencia + "'," +
                        "'" + item.precio + "'," +
                        "'" + item.precio2 + "'," +
                        "'" + item.precioconiva + "'," +
                        "'" + item.ivaproducto + "'," +
                        "'" + item.tipo + "', " +
                        "'-'" +
                        ')"' +
                        " type='button'><span class='fa fa-minus'></span></button>" +
                        "<input type='text' id='"+item.cantidad+"' style='width:35px;height:22px;border:#FF0000;' value='" + item.cantidad + "'><input type='hidden' value='" + item.precio + "'>" +
                        '<button class="btn btn-info btn-xs" style="cursor:pointer;" onclick="addItem(' +
                        "'" + item.txtCodigo + "'," +
                        "'+1'," +
                        "'" + item.descripcion + "'," +
                        "'" + item.existencia + "'," +
                        "'" + item.precio + "'," +
                        "'" + item.precio2 + "'," +
                        "'" + item.precioconiva + "'," +
                        "'" + item.ivaproducto + "'," +
                        "'" + item.tipo + "', " +
                        "'+'" +
                        ')"' +
                        " type='button'><span class='fa fa-plus'></span></button></td>" +
                        "<td><input type='hidden' value='" + item.txtCodigo + "'><input type='hidden' value='" + item.existencia + "'>" + item.descripcion + "<input type='hidden' value='" + item.tipo + "'></td>" +
                        "<td>" + item.precio2 + "<input type='hidden' value='" + item.precioconiva + "'><input type='hidden' value='" + item.ivaproducto + "'><input type='hidden' value='" + OperacionCompra.toFixed(2) + "'><input type='hidden' value='" + Operacion.toFixed(2) + "'></td>" +
                        "<td>" +
                        '<button class="btn btn-info btn-xs" style="cursor:pointer;color:#fff;" ' +
                        'onclick="addItem(' +
                        "'" + item.txtCodigo + "'," +
                        "'0'," +
                        "'" + item.descripcion + "'," +
                        "'" + item.existencia + "'," +
                        "'" + item.precio + "'," +
                        "'" + item.precio2 + "'," +
                        "'" + item.precioconiva + "'," +
                        "'" + item.ivaproducto + "'," +
                        "'" + item.tipo + "', " +
                        "'='" +
                        ')"' +
                        ' type="button"><span class="fa fa-trash-o"></span></button>' +
                                    "</td>" +
                                    "</tr>";
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
                                $("#montopagado").val(TotalFactura.toFixed(2));
                            }

                        });

                        $("#busquedaproducto").focus();
                        LimpiarTexto();
                    },
                    "json"
                );
                return false;
            }
        }
    });


    $("#vaciard").click(function() {
        var Carrito = new Object();
        Carrito.Codigo = "vaciar";
        Carrito.Tipo = "vaciar";
        Carrito.Cantidad = "0";
        Carrito.Descripcion = "vaciar";
        Carrito.Existencia = "0";
        Carrito.Precio = "0";
        Carrito.Precio2 = "0";
        Carrito.Precioconiva = "0";
        Carrito.Ivaproducto = "vaciar";
        var DatosJson = JSON.stringify(Carrito);
        $.post('carritodeliver.php', {
                MiCarritoD: DatosJson
            },
            function(data, textStatus) {
                $("#carritodeliver tbody").html("");
                var nuevaFila =
"<tr>"+"<td colspan=4><center><label><h5>NO HAY PRODUCTOS AGREGADOS</h5></label></center></td>"+"</tr>";
                $(nuevaFila).appendTo("#carrito tbody");
                LimpiarTexto();
            },
            "json"
        );
        return false;
    });


$(document).ready(function() {
    $('#vaciard').click(function() {
    $("#deliver")[0].reset();
    $("#cliente").val("");
    //$('label[id*="cedcliente"]').text('SIN ASIGNAR');
    //$('label[id*="nomcliente"]').text('SIN ASIGNAR');
    //$('label[id*="direccliente"]').text('SIN ASIGNAR');
    $("#carrito tbody").html("");
    var nuevaFila =
"<tr>"+"<td colspan=4><center><label><h5>NO HAY PRODUCTOS AGREGADOS</h5></label></center></td>"+"</tr>";    
    $(nuevaFila).appendTo("#carrito tbody");
    $("#busquedaproducto").val("");
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
    $("#montopagado").val("0.00");
   });
});


$('document').ready(function(){

  $('#nuevo-delivery').click(function(){

  $("#error").html("");
  $("#pedido").load("funciones.php?Nuevo_Pedido=si");
  //$("#recibemesa").html("");

    });
});



//FUNCION PARA ACTUALIZAR CALCULO EN FACTURA DE VENTAS CON DESCUENTO
$(document).ready(function (){
          $('.calculodescuentove').keyup(function (){
        
            var txtsubtotal = $('input#txtsubtotal').val();
            var txtsubtotal2 = $('input#txtsubtotal2').val();
            var txtIva = $('input#txtIva').val();
            var desc = $('input#descuento').val();
            descuento  = desc/100;
                        
            //REALIZO EL CALCULO CON EL DESCUENTO INDICADO
            Subtotal = parseFloat(txtsubtotal) + parseFloat(txtsubtotal2) + parseFloat(txtIva); 
            TotalDescuentoGeneral   = parseFloat(Subtotal.toFixed(2)) * parseFloat(descuento.toFixed(2));
            TotalFactura   = parseFloat(Subtotal.toFixed(2)) - parseFloat(TotalDescuentoGeneral.toFixed(2));        
        
            $("#lbldescuento").text(TotalDescuentoGeneral.toFixed(2));
            $("#lbltotal").text(TotalFactura.toFixed(2));
            $("#txtDescuento").val(TotalDescuentoGeneral.toFixed(2));
            $("#txtTotal").val(TotalFactura.toFixed(2));
            $("#montopagado").val(TotalFactura.toFixed(2));
         });
 });

//FUNCION PARA ACTUALIZAR IMPORTE EN DETALLE DE VENTAS EN DELIVERY
$(document).ready(function (){
          $('.devolucion').keyup(function (){
            
            var montototal = $('input#txtTotal').val();
            var montopagado = $('input#montopagado').val();
            var montodevuelto = $('input#montodevuelto').val();
                        
            //REALIZO EL CALCULO Y MUESTRO LA DEVOLUCION
            total=montopagado - montototal;
            var original=parseFloat(total.toFixed(2));
            $("#montodevuelto").val(original.toFixed(2));/**/
            
          });
     });


    $("#carrito tbody").on('keydown', 'input', function(e) {
        var element = $(this);
        var pvalue = element.val();
        var code = e.charCode || e.keyCode;
        var avalue = String.fromCharCode(code);
        var action = element.siblings('button').first().attr('onclick');
        var params;
        if (code !== 8 && /[^\d]/ig.test(avalue)) {
            e.preventDefault();
            return;
        }
        if (element.attr('data-proc') == '1') {
            return true;
        }
        element.attr('data-proc', '1');
        params = action.match(/\'([^\']+)\'/g).map(function(v) {
            return v.replace(/\'/g, '');
        });
        setTimeout(function() {
            if (element.attr('data-proc') == '1') {
                var value = element.val() || 0;
                addItem(
                    params[0],
                    value,
                    params[2],
                    params[3],
                    params[4],
                    params[5],
                    params[6],
                    params[7],
                    params[8],
                    '='
                );
                element.attr('data-proc', '0');
            }
        }, 500);
    });
});

function TipoPedido(tipopedido){

      //var valor = $("select#tipopedido").val();
      var valor = $('input[name="tipopedido"]:checked').val(); 

      if (valor === "" || valor === true) {

      // deshabilitamos
      $("#repartidor").attr('disabled', true);

      } else if (valor === "INTERNO" || valor === true) {

      // habilitamos
      $("#repartidor").attr('disabled', true);

      } else if (valor === "EXTERNO" || valor === true) {

      // deshabilitamos
      $("#repartidor").attr('disabled', false);
    }
}


function TipoPagos(tipopagove){

      var valor = $("select#tipopagove").val();

      if (valor === "" || valor === true) {

      // deshabilitamos
      $("#formapagove").attr('disabled', true);
      $('#montopagado').attr('disabled', true);
      $('#montodevuelto').attr('disabled', true);
      $("#fechavencecredito").attr('disabled', true);
      $('#montoabono').attr('disabled', true);

      } else if (valor === "CONTADO" || valor === true) {

      // habilitamos
      $("#formapagove").attr('disabled', false);
      $('#montopagado').attr('disabled', false);
      $('#montodevuelto').attr('disabled', false);
      // deshabilitamos
      $("#fechavencecredito").attr('disabled', true);
      $('#montoabono').attr('disabled', true);

      } else if (valor === "CREDITO" || valor === true) {

      // deshabilitamos
      $("#formapagove").attr('disabled', true);
      $('#montopagado').attr('disabled', true);
      $('#montodevuelto').attr('disabled', true);
      // habilitamos
      $("#fechavencecredito").attr('disabled', false);
      $('#montoabono').attr('disabled', false);
    }
}

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
}

/*function ClienteDeliver(codigocliente,cedcliente,nomcliente,direccliente) 
{
    $("#cliente").val(codigocliente);
    $('label[id*="cedcliente"]').text(cedcliente);
    $('label[id*="nomcliente"]').text(nomcliente);
    $('label[id*="direccliente"]').text(direccliente);
    setTimeout(function() {
                $("#buscacliente").val("");
                $("#resultado").html("");
            }, 100);
}*/

function addItem(codigo, cantidad, descripcion, existencia, precio, precio2, precioconiva, ivaproducto, tipo, opCantidad) {
    var Carrito = new Object();
    Carrito.Codigo = codigo;
    Carrito.Precio = precio;
    Carrito.Precio2 = precio2;
    Carrito.Precioconiva = precioconiva;
    Carrito.Ivaproducto = ivaproducto;
    Carrito.Tipo = tipo;
    Carrito.Cantidad = cantidad;
    Carrito.Descripcion = descripcion;
    Carrito.Existencia = existencia;
    Carrito.opCantidad = opCantidad;
    var DatosJson = JSON.stringify(Carrito);
    $.post('carritodeliver.php', {
            MiCarritoD: DatosJson
        },
        function(data, textStatus) {
            $("#carrito tbody").html("");
            var SubtotalFact = 0;
            var BaseImpIva1 = 0;
            var contador = 0;
            var iva = 0;
            var total = 0;
            var TotalCompra = 0;

            $.each(data, function(i, item) {
                var cantsincero = item.cantidad;
                   //cantsincero = parseInt(cantsincero);
                   cantsincero = cantsincero;

                if (cantsincero != 0) {
                    contador = contador + 1;

var OperacionCompra = parseFloat(item.precio);
TotalCompra = parseFloat(TotalCompra) + parseFloat(OperacionCompra);

var Operacion = parseFloat(item.precio2) * parseFloat(item.cantidad);
var Subtotal = Operacion.toFixed(2);

//CALCULO DE BASE IMPONIBLE IVA CON PORCENTAJE
var Operacion3 = parseFloat(item.precioconiva) * parseFloat(item.cantidad);
var Subbaseimponiva = Operacion3.toFixed(2);

//BASE IMPONIBLE IVA CON PORCENTAJE
BaseImpIva1 = parseFloat(BaseImpIva1) + parseFloat(Subbaseimponiva);

//CALCULO GENERAL DE IVA CON BASE IVA * IVA %
var ivg = $('input#iva').val();
ivg2 = ivg / 100;
TotalIvaGeneral = parseFloat(BaseImpIva1) * parseFloat(ivg2.toFixed(2));

//SUBTOTAL GENERAL DE FACTURA
SubtotalFact = parseFloat(SubtotalFact) + parseFloat(Subtotal);
//BASE IMPONIBLE IVA SIN PORCENTAJE
BaseImpIva2 = parseFloat(SubtotalFact) - parseFloat(BaseImpIva1);

//CALCULAMOS DESCUENTO POR PRODUCTO
var desc = $('input#descuento').val();
desc2 = desc / 100;

//CALCULO DEL TOTAL DE FACTURA
Total = parseFloat(BaseImpIva1) + parseFloat(BaseImpIva2) + parseFloat(TotalIvaGeneral);
TotalDescuentoGeneral = parseFloat(Total.toFixed(2)) * parseFloat(desc2.toFixed(2));
TotalFactura = parseFloat(Total.toFixed(2)) - parseFloat(TotalDescuentoGeneral.toFixed(2));

                    var nuevaFila =
                        "<tr align='center' style='font-size:13px;'>" +
                        "<td>" +
                        '<button class="btn btn-info btn-xs" style="cursor:pointer;" onclick="addItem(' +
                        "'" + item.txtCodigo + "'," +
                        "'-1'," +
                        "'" + item.descripcion + "'," +
                        "'" + item.existencia + "'," +
                        "'" + item.precio + "'," +
                        "'" + item.precio2 + "'," +
                        "'" + item.precioconiva + "'," +
                        "'" + item.ivaproducto + "'," +
                        "'" + item.tipo + "', " +
                        "'-'" +
                        ')"' +
                        " type='button'><span class='fa fa-minus'></span></button>" +
                        "<input type='text' id='" + item.cantidad + "' style='width:35px;height:22px;border:#FF0000;' value='" + item.cantidad + "'><input type='hidden' value='" + item.precio + "'>" +
                        '<button class="btn btn-info btn-xs" style="cursor:pointer;" onclick="addItem(' +
                        "'" + item.txtCodigo + "'," +
                        "'+1'," +
                        "'" + item.descripcion + "'," +
                        "'" + item.existencia + "'," +
                        "'" + item.precio + "'," +
                        "'" + item.precio2 + "'," +
                        "'" + item.precioconiva + "'," +
                        "'" + item.ivaproducto + "'," +
                        "'" + item.tipo + "', " +
                        "'+'" +
                        ')"' +
                        " type='button'><span class='fa fa-plus'></span></button></td>" +
                        "<td><input type='hidden' value='" + item.txtCodigo + "'><input type='hidden' value='" + item.existencia + "'>" + item.descripcion + "<input type='hidden' value='" + item.tipo + "'></td>" +
                        "<td>" + Operacion.toFixed(2) + "<input type='hidden' value='" + item.precioconiva + "'><input type='hidden' value='" + item.ivaproducto + "'><input type='hidden' value='" + OperacionCompra.toFixed(2) + "'><input type='hidden' value='" + item.precio2 + "'></td>" +
                        "<td>" +
                        '<button class="btn btn-info btn-xs" style="cursor:pointer;color:#fff;" ' +
                        'onclick="addItem(' +
                        "'" + item.txtCodigo + "'," +
                        "'0'," +
                        "'" + item.descripcion + "'," +
                        "'" + item.existencia + "'," +
                        "'" + item.precio + "'," +
                        "'" + item.precio2 + "'," +
                        "'" + item.precioconiva + "'," +
                        "'" + item.ivaproducto + "'," +
                        "'" + item.tipo + "', " +
                        "'='" +
                        ')"' +
                        ' type="button"><span class="fa fa-trash-o"></span></button>' +
                        "</td>" +
                        "</tr>";

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
                    $("#montopagado").val(TotalFactura.toFixed(2));
                    $("#txtTotalCompra").val(TotalCompra.toFixed(2));
                }

            });
            if (contador == 0) {

                $("#carrito tbody").html("");

                var nuevaFila =
"<tr>"+"<td colspan=4><center><label><h5>NO HAY PRODUCTOS AGREGADOS</h5></label></center></td>"+"</tr>";
                $(nuevaFila).appendTo("#carrito tbody");
                //alert("ELIMINAMOS TODOS LOS SUBTOTAL Y TOTALES");
                $("#deliver")[0].reset();
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
                $("#montopagado").val("0.00");
            }
            $("#busquedaproducto").focus();
            LimpiarTexto();
        },
        "json"
    );
    return false;
}