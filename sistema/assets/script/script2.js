	  
// FUNCION PARA PERMITIR CAMPOS NUMEROS
function NumberFormat(num, numDec, decSep, thousandSep){
    var arg;
    var Dec;
    Dec = Math.pow(10, numDec); 
    if (typeof(num) == 'undefined') return; 
    if (typeof(decSep) == 'undefined') decSep = ',';
    if (typeof(thousandSep) == 'undefined') thousandSep = '.';
    if (thousandSep == '.')
     arg=/./g;
    else
     if (thousandSep == ',') arg=/,/g;
    if (typeof(arg) != 'undefined') num = num.toString().replace(arg,'');
    num = num.toString().replace(/,/g, '.'); 
    if (isNaN(num)) num = "0";
    sign = (num == (num = Math.abs(num)));
    num = Math.floor(num * Dec + 0.50000000001);
    cents = num % Dec;
    num = Math.floor(num/Dec).toString(); 
    if (cents < (Dec / 10)) cents = "0" + cents; 
    for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
     num = num.substring(0, num.length - (4 * i + 3)) + thousandSep + num.substring(num.length - (4 * i + 3));
    if (Dec == 1)
     return (((sign)? '': '-') + num);
    else
     return (((sign)? '': '-') + num + decSep + cents);
   } 

   function EvaluateText(cadena, obj){
    opc = false; 
    if (cadena == "%d")
     if (event.keyCode > 47 && event.keyCode < 58)
      opc = true;
    if (cadena == "%f"){ 
     if (event.keyCode > 47 && event.keyCode < 58)
      opc = true;
     if (obj.value.search("[.*]") == -1 && obj.value.length != 0)
      if (event.keyCode == 46)
       opc = true;
    }
    if(opc == false)
     event.returnValue = false; 
   }
   
   $(document).ready(function(){ 
$(".number").keydown(function(event) {
   if(event.shiftKey)
   {
        event.preventDefault();
   }
 
   if (event.keyCode == 46 || event.keyCode == 8)    {
   }
   else {
        if (event.keyCode < 95) {
          if (event.keyCode < 48 || event.keyCode > 57) {
                event.preventDefault();
          }
        } 
        else {
              if (event.keyCode < 96 || event.keyCode > 105) {
                  event.preventDefault();
              }
        }
      }
   });
});
   
  
function getTime()
        {
            var today=new Date();
            var h=today.getHours();
            var m=today.getMinutes();
            var s=today.getSeconds();
            var num = new Array ("01","02","03","04","05","06","07","08","09","10","11","12");
      var mt = "AM";

         // Pongo el formato 12 horas
      if (h> 12) {
      mt = "PM";
      h = h - 12;
      }
      if (h == 0) h = 12;
      // Pongo minutos y segundos con dos digitos
      //if (m <= 9) m = "0" + m;
      //if (s <= 9) s = "0" + s;
      
            // add a zero in front of numbers<10
            m=checkTime(m);
            s=checkTime(s);
document.getElementById('fecharegistro').value= today.getDate() + "-" + num[today.getMonth()] + "-" + today.getFullYear() + " " + h+":"+m+":"+s;
$('#result3').html(today.getDate() + "-" + num[today.getMonth()] + "-" + today.getFullYear() + " " + h+":"+m+":"+s);
            t=setTimeout(function(){getTime()},500);
        }

        function checkTime(i)
        {
            if (i<10)
            {
                i="0" + i;
            }
            return i;
        }

function muestraReloj()
{
// Compruebo si se puede ejecutar el script en el navegador del usuario
if (!document.layers && !document.all && !document.getElementById) return;
// Obtengo la hora actual y la divido en sus partes
var num = new Array ("01","02","03","04","05","06","07","08","09","10","11","12");
var fechacompleta = new Date();
var horas = fechacompleta.getHours();
var minutos = fechacompleta.getMinutes();
var segundos = fechacompleta.getSeconds();

var day = fechacompleta.getDate();
var mes = fechacompleta.getMonth(); 
var year = fechacompleta.getFullYear();

var mt = "AM";

// Pongo el formato 12 horas
if (horas> 12) {
mt = "PM";
horas = horas - 12;
}
if (horas == 0) horas = 12;
// Pongo minutos y segundos con dos digitos
if (minutos <= 9) minutos = "0" + minutos;
if (segundos <= 9) segundos = "0" + segundos;
// En la variable 'cadenareloj' puedes cambiar los colores y el tipo de fuente
//cadenareloj = "<font size='-1' face='verdana'>" + horas + ":" + minutos + ":" + segundos + " " + mt + "</font>";
cadenareloj = "<i class='fa fa-calendar'></i> " + day + "-" + num[mes]  + "-" + year + "     " + horas + ":" + minutos + ":" + segundos + " " + mt;

// Escribo el reloj de una manera u otra, segun el navegador del usuario
if (document.layers) {
document.layers.spanreloj.document.write(cadenareloj);
document.layers.spanreloj.document.close();
}
else if (document.all) spanreloj.innerHTML = cadenareloj;
else if (document.getElementById) document.getElementById("spanreloj").innerHTML = cadenareloj;
// Ejecuto la funcion con un intervalo de un segundo
setTimeout("muestraReloj()", 1000);
}

//////// FUNCIONES PARA MOSTRAR MENSAJES DE ALERTA DE ACTUALIZAR, ELIMINAR Y PAGAR REGISTROS
function rsSistemaDirUrl(page)
{
	page = String(page || '');
	if (page === '') {
		return page;
	}
	if (/^https?:\/\//i.test(page) || page.charAt(0) === '/') {
		return page;
	}
	var path = window.location.pathname.replace(/\\/g, '/');
	var idx = path.lastIndexOf('/');
	if (idx === -1) {
		return page;
	}
	return path.substring(0, idx + 1) + page;
}

function rsNavigateConfirm(url, mensaje)
{
	if (window.event) {
		window.event.preventDefault ? window.event.preventDefault() : (window.event.returnValue = false);
	}
	var go = function () {
		window.location.href = rsSistemaDirUrl(url);
	};
	if (typeof window.rsConfirm === 'function') {
		window.rsConfirm(mensaje, 'Confirmar', { danger: /eliminar/i.test(mensaje) }).then(function (ok) {
			if (ok) {
				go();
			}
		});
		return false;
	}
	if (!confirm(mensaje)) {
		return false;
	}
	go();
	return false;
}

function rsAsk(msg, thenFn, extra)
{
	if (typeof window.rsConfirm === 'function') {
		window.rsConfirm(msg, 'Confirmar', extra || {}).then(function (ok) {
			if (ok && typeof thenFn === 'function') {
				thenFn();
			}
		});
		return;
	}
	if (confirm(msg) && typeof thenFn === 'function') {
		thenFn();
	}
}

function actualizar(url)
{
	return rsNavigateConfirm(url, 'ESTA SEGURO DE ACTUALIZAR ESTE REGISTRO ?');
}

function agregar(url)
{
	return rsNavigateConfirm(url, 'ESTA SEGURO DE AGREGAR INGREDIENTES A ESTE PRODUCTO ?');
}

function eliminar(url)
{
	return rsNavigateConfirm(url, 'ESTA SEGURO DE ELIMINAR ESTE REGISTRO ?');
}

function pagar(url)
{
	return rsNavigateConfirm(url, 'ESTA SEGURO DE REALIZAR EL PAGO DE ESTA COMPRA PENDIENTE ?');
}

/* href="#" + <base href="/{slug}/sistema/"> mandaba al login/mostrador tras Editar */
if (typeof document !== 'undefined' && document.addEventListener) {
	document.addEventListener('click', function (e) {
		var el = e.target;
		while (el && el.tagName !== 'A') {
			el = el.parentNode;
			if (!el || el === document) {
				return;
			}
		}
		if (!el) {
			return;
		}
		var href = (el.getAttribute('href') || '').replace(/^\s+|\s+$/g, '');
		if (href !== '#' && href !== '' && href.toLowerCase() !== 'javascript:void(0)' && href.toLowerCase() !== 'javascript:void(0);') {
			return;
		}
		var oc = el.getAttribute('onclick') || '';
		if (/actualizar\s*\(|eliminar\s*\(|agregar\s*\(|pagar\s*\(|cerrarcaja\s*\(/i.test(oc)) {
			if (e.preventDefault) {
				e.preventDefault();
			} else {
				e.returnValue = false;
			}
		}
	}, true);
}

function cerrarcaja(url)
{
	return rsNavigateConfirm(url, 'ESTA SEGURO DE REALIZAR EL CIERRE DE ESTA CAJA ?');
}

function VerificaMovimiento()
{
  alert('ESTE MOVIMIENTO EN CAJA NO PUEDE ELIMINARSE,\nLA FECHA DE MOVIMIENTO ES DIFERENTE A LA ACTUAL ');
}


$(document).ready(function(){ 
$(".precio").keydown(function(event) {
   if(event.shiftKey)
   {
        event.preventDefault();
   }
 
   if (event.keyCode == 46 || event.keyCode == 8)    {
   }
   else {
        if (event.keyCode < 95) {
          if (event.keyCode < 48 || event.keyCode > 57) {
                event.preventDefault();
          }
        } 
        else {
              if (event.keyCode < 96 || event.keyCode > 105) {
                  event.preventDefault();
              }
        }
      }
   });
});

function load(page){
		var parametros = {"action":"ajax","page":page};
		$("#loader").fadeIn('slow');
		$.ajax({
			url:'paises_ajax.php',
			data: parametros,
			 beforeSend: function(objeto){
			$("#loader").html("<img src='loader.gif'>");
			},
			success:function(data){
				$(".outer_div").html(data).fadeIn('slow');
				$("#loader").html("");
			}
		})
	}


$(document).ready(function()
{
	$("#favoritos").click(function () {
		
var favoritos = $('input:checkbox[name=favoritos]:checked').val();							

var dataString = $("#ventas").serialize();
var url = 'funciones.php?MuestraFavoritos=si';

$.ajax({
            type: "GET",
			url: url,
            data: dataString,
            success: function(response) {            
                $('#muestrafavoritos').empty();
                $('#muestrafavoritos').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
                                        }
            });
        });
});


////FUNCION MUESTRA CAMPO PARA NUEVOS PRODUCTOS
function mostrar(){

     var botonAccion = document.getElementById('boton-observaciones') || document.getElementById('boton');
     var div = document.getElementById('panel-observaciones') || document.getElementById('observaciones');

     if (!div || !botonAccion) {
         return;
     }

     function tecladoObs() {
       return window.TecladoObservacionesPedido || window.TecladoTactil || null;
     }

     if(div.style.display==='block'){

       div.style.display = "none";
       botonAccion.textContent = "Agregar Observaciones:";
       var apiClose = tecladoObs();
       if (apiClose && typeof apiClose.closeObservaciones === 'function') {
         apiClose.closeObservaciones();
       } else if (apiClose && typeof apiClose.hide === 'function') {
         apiClose.hide();
       }

    } else {

       div.style.display = "block";
       botonAccion.textContent = "Quitar Observaciones:";
       var openKb = function () {
         var api = tecladoObs();
         if (api && typeof api.openForObservaciones === 'function') {
           api.openForObservaciones();
           return true;
         }
         if (api && typeof api.show === 'function') {
           var el = document.getElementById('observaciones-pedido');
           if (el) { api.show(el); return true; }
         }
         return false;
       };
       if (!openKb()) {
         setTimeout(openKb, 80);
         setTimeout(openKb, 250);
       }
    }
}





////////////////////////////////////////////// FUNCIONES PARA PROCESAR DATOS ///////////////////////////////////////////

// FUNCION PARA MOSTRAR USUARIOS EN VENTANA MODAL
function VerUsuario(codigo){
$('#muestrausuariomodal').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
var dataString = 'BuscaUsuarioModal=si&codigo='+codigo;
$.ajax({
            type: "GET",
			url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestrausuariomodal').empty();
                $('#muestrausuariomodal').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
            }
      });
}


// FUNCION PARA MOSTRAR SALAS EN VENTANA MODAL
function VerSala(codsala){
$('#muestrasalamodal').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
var dataString = 'BuscaSalasModal=si&codsala='+codsala;
$.ajax({
            type: "GET",
			url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestrasalamodal').empty();
                $('#muestrasalamodal').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
            }
      });
}

// FUNCION PARA MOSTRAR MESAS EN SALAS EN VENTANA MODAL
function VerMesa(codmesa){
$('#muestramesamodal').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
var dataString = 'BuscaMesasModal=si&codmesa='+codmesa;
$.ajax({
            type: "GET",
			url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestramesamodal').empty();
                $('#muestramesamodal').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
            }
      });
}




// FUNCION PARA BUSQUEDA DE CLIENTES PARA PROCESOS  
function BuscarClientes(){
                                     
$('#resultadocliente').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
var buscacliente = $("#buscacliente").val() || "";
var num = buscacliente.trim().length;
var dataString = $("#buscaclientes").serialize();
var url = 'funciones.php?BusquedaClientes=si';

if (buscacliente.trim() !== "" && num < 2) {

$("#resultadocliente").html('<br><center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> POR FAVOR INGRESE CRITERIO PARA TU B&Uacute;SQUEDA DE CLIENTES !</div></center>'); 

return false;
   
    } else {

        $.ajax({
            type: "GET",
            url: url,
            data: dataString,
            success: function(response) {            
                $('#resultadocliente').empty();
                $('#resultadocliente').append(''+response+'').fadeIn("slow");
             }
        }); 
       
    }                                                                    
}

// FUNCION PARA MOSTRAR CLIENTES EN VENTANA MODAL
function VerCliente(codcliente){

$('#muestraclientemodal').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
                
var dataString = 'BuscaClienteModal=si&codcliente='+codcliente;

$.ajax({
            type: "GET",
      url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestraclientemodal').empty();
                $('#muestraclientemodal').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
           }
      });
}

/////FUNCION PARA ELIMINAR CLIENTES 
function EliminarCliente(codcliente,tipo,busqueda) {

var dataString = 'codcliente='+codcliente+'&tipo='+tipo;
var runEliminarCliente = function () {
        $.ajax({
            type: "GET",
            url: "eliminar.php",
            data: dataString,
            success: function(response) {            
                $('#delete-ok').empty();
                $('#delete-ok').append('<center>'+response+'</center>').fadeIn("slow");
$("#resultadocliente").load("funciones.php?BusquedaClientes=si&buscacliente="+busqueda);
                setTimeout(function() { $("#delete-ok").html(""); }, 5000);
                $('#'+parent).remove();
            }
        });
};
if (typeof window.rsConfirm === 'function') {
	window.rsConfirm("ESTA SEGURO DE ELIMINAR ESTE CLIENTE?", "Confirmar", { danger: true }).then(function (ok) {
		if (ok) { runEliminarCliente(); }
	});
} else if (confirm("ESTA SEGURO DE ELIMINAR ESTE CLIENTE?")) {
	runEliminarCliente();
}
}

// FUNCION PARA CARGAR LOS DATOS DE CLIENTES
function CargaCampos (codcliente,cedcliente,nomcliente,direccliente,tlfcliente,emailcliente,busqueda) 
{
    // aqui asigno cada valor a los campos correspondientes
  $("#updateclientes #codcliente").val( codcliente );
  $("#updateclientes #cedcliente").val( cedcliente );
  $("#updateclientes #nomcliente").val( nomcliente );
  $("#updateclientes #direccliente").val( direccliente );
  $("#updateclientes #tlfcliente").val( tlfcliente );
  $("#updateclientes #emailcliente").val( emailcliente );
  $("#updateclientes #busqueda").val( busqueda );
}

// FUNCION PARA CARGAR LOS DATOS DE CLIENTES
function EditCampos (codcliente,cedcliente,nomcliente,direccliente,tlfcliente,emailcliente,busqueda) 
{
    // aqui asigno cada valor a los campos correspondientes
  $("#updateventaclientes #codcliente").val( codcliente );
  $("#updateventaclientes #cedcliente").val( cedcliente );
  $("#updateventaclientes #nomcliente").val( nomcliente );
  $("#updateventaclientes #direccliente").val( direccliente );
  $("#updateventaclientes #tlfcliente").val( tlfcliente );
  $("#updateventaclientes #emailcliente").val( emailcliente );
  $("#updateventaclientes #busqueda").val( busqueda );
}




// FUNCION PARA MOSTRAR PROVEEDOR EN VENTANA MODAL
function VerProveedor(codproveedor){

$('#muestraproveedormodal').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
								
var dataString = 'BuscaProveedorModal=si&codproveedor='+codproveedor;

$.ajax({
            type: "GET",
			url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestraproveedormodal').empty();
                $('#muestraproveedormodal').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
           }
      });
}



// FUNCION PARA MOSTRAR DIV DE CARGA MASIVA DE INGREDIENTES
function CargaDivIngrediente(){

$('#divingrediente').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
                
var dataString = 'BuscaDivIngrediente=si';

$.ajax({
            type: "GET",
      url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#divingrediente').empty();
                $('#divingrediente').append(''+response+'').fadeIn("slow");
                $('#divproducto').html("");
                $('#'+parent).remove();
           }
      });
}

// FUNCION PARA MOSTRAR INGREDIENTES EN VENTANA MODAL
function VerIngrediente(codingrediente){

$('#muestraingredientemodal').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
								
var dataString = 'BuscaIngredienteModal=si&codingrediente='+codingrediente;

$.ajax({
            type: "GET",
			url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestraingredientemodal').empty();
                $('#muestraingredientemodal').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
          }
      });
}


// FUNCION PARA BUSQUEDA DE KARDEX POR INGREDIENTES
function BuscaKardexIngredientes(){
    
$('#muestrakardexingrediente').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
var codproducto = $("#codproducto").val();
var dataString = $("#buscakardexingrediente").serialize();
var url = 'funciones.php?BuscaKardexIngrediente=si';

        $.ajax({
            type: "GET",
      url: url,
            data: dataString,
            success: function(response) {
                $('#muestrakardexingrediente').empty();
                $('#muestrakardexingrediente').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
            }
      }); 
}

// FUNCION PARA MOSTRAR DIV DE CARGA MASIVA DE PRODUCTOS
function CargaDivProductos(){

$('#divproducto').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
                
var dataString = 'BuscaDivProducto=si';

$.ajax({
            type: "GET",
      url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#divproducto').empty();
                $('#divproducto').append(''+response+'').fadeIn("slow");
                $('#divingrediente').html("");
                $('#'+parent).remove();
           }
      });
}

// FUNCION PARA MOSTRAR FOTO DE PRODUCTOS EN VENTANA MODAL
function VerImagen(codproducto){

$('#muestrafotoproductomodal').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
                
var dataString = 'BuscaFotoProductoModal=si&codproducto='+codproducto;

$.ajax({
            type: "GET",
      url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestrafotoproductomodal').empty();
                $('#muestrafotoproductomodal').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
           }
      });
}


// FUNCION PARA MOSTRAR PRODUCTOS EN VENTANA MODAL
function VerProducto(codproducto){

$('#muestraproductomodal').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
								
var dataString = 'BuscaProductoModal=si&codproducto='+codproducto;

$.ajax({
            type: "GET",
			url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestraproductomodal').empty();
                $('#muestraproductomodal').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
           }
      });
}


// FUNCION PARA BUSQUEDA DE KARDEX POR PRODUCTOS
function BuscaKardexProductos(){
    
$('#muestrakardexproducto').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
var codproducto = $("#codproducto").val();
var dataString = $("#buscakardex").serialize();
var url = 'funciones.php?BuscaKardexProducto=si';

        $.ajax({
            type: "GET",
      url: url,
            data: dataString,
            success: function(response) {
                $('#muestrakardexproducto').empty();
                $('#muestrakardexproducto').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
            }
      }); 
}

// FUNCION PARA ELIMINAR INGREDIENTES AGREGADOS
function EliminaIngrediente(codproducto,codingrediente,tipo){

rsAsk("ESTA SEGURO DE ELIMINAR ESTE INGREDIENTE EN EL PRODUCTO?", function () {
								
$('#delete-ok').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');

var dataString = 'codproducto='+codproducto+'&codingrediente='+codingrediente+'&tipo='+tipo;

$.ajax({
            type: "GET",
			url: "eliminar.php",
            data: dataString,
            success: function(response) {            
                $('#delete-ok').empty();
                $('#delete-ok').append(''+response+'').fadeIn("slow");
				$("#cargaingredientes").load("funciones.php?BuscaIngredienteProductos=si&codproducto="+codproducto);
				setTimeout(function() { $("#delete-ok").html(""); }, 5000);
                $('#'+parent).remove();
           }
      });
   }, { danger: true });
}


// FUNCION PARA ELIMINAR NUEVOS INGREDIENTES AGREGADOS
function EliminaNuevoIngrediente(codproducto,codingrediente,tipo){

rsAsk("ESTA SEGURO DE ELIMINAR ESTE INGREDIENTE EN EL PRODUCTO?", function () {

$('#delete-ok').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
								
var dataString = 'codproducto='+codproducto+'&codingrediente='+codingrediente+'&tipo='+tipo;

$.ajax({
            type: "GET",
			url: "eliminar.php",
            data: dataString,
            success: function(response) {            
                $('#delete-ok').empty();
                $('#delete-ok').append(''+response+'').fadeIn("slow");
				$("#cargaingredientes").load("funciones.php?BuscaNuevosIngredienteProductos=si&codproducto="+codproducto);
				setTimeout(function() { $("#delete-ok").html(""); }, 5000);
                $('#'+parent).remove();
           }
      });
   }, { danger: true });
}


// FUNCION PARA MOSTRAR ARQUEO DE CAJA EN VENTANA MODAL
function VerArqueo(codarqueo){

$('#muestraarqueomodal').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
								
var dataString = 'BuscaArqueoCajaModal=si&codarqueo='+codarqueo;

$.ajax({
            type: "GET",
			url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestraarqueomodal').empty();
                $('#muestraarqueomodal').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
           }
      });
} 

// FUNCION PARA MOSTRAR MOVIMIENTO DE CAJA EN VENTANA MODAL
function VerMovimientoCaja(codmovimientocaja){

$('#muestramovimientocajamodal').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
								
var dataString = 'BuscaMovimientoCajaModal=si&codmovimientocaja='+codmovimientocaja;

$.ajax({
            type: "GET",
			url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestramovimientocajamodal').empty();
                $('#muestramovimientocajamodal').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
           }
      });
}

//FUNCION PARA CALCULAR LA DIFERENCIA EN CIERRE DE CAJA
$(document).ready(function (){
	function recalcDiferencia() {
		var efectivo = parseFloat(String($('input#dineroefectivo').val()).replace(',', '.'));
		var estimado = parseFloat(String($('input#estimado').val()).replace(',', '.'));
		if (isNaN(efectivo)) efectivo = 0;
		if (isNaN(estimado)) estimado = 0;
		$("#diferencia").val((efectivo - estimado).toFixed(2));
	}
	$(document).on('keyup blur change', '.calculo, #dineroefectivo', recalcDiferencia);
});






// FUNCION PARA ELIMINAR NUEVOS INGREDIENTES AGREGADOS
function EliminaDetalleProducto(codmesa,coddetalleventa,codventa,codproducto,cantventa,ivaproducto,tipo){

rsAsk("ESTA SEGURO DE ELIMINAR ESTE PRODUCTO EN PEDIDOS?", function () {
							
var dataString = 'codmesa='+codmesa+'&coddetalleventa='+coddetalleventa+'&codventa='+codventa+'&codproducto='+codproducto+'&cantventa='+cantventa+'&ivaproducto='+ivaproducto+'&tipo='+tipo;

$.ajax({
            type: "GET",
			url: "eliminar.php",
            data: dataString,
            success: function(response) {            
                $('#error').empty();
                $('#error').append(''+response+'').fadeIn("slow");
				$("#recibemesa").load("funciones.php?BuscaMesaReservas=si&codmesa="+codmesa);
				//$("#salas-mesas").load("funciones.php?salas_mesas=si");
        //$("#salas-mesas").load("funciones.php?prod_categorias=si");
				setTimeout(function() { $("#error").html(""); }, 5000);
                $('#'+parent).remove();
           }
      });
   }, { danger: true });
}




// FUNCION PARA ENTREGAR PEDIDOS DE PRODUCTOS EN COCINA
function EntregarPedidos(codventa,nombresala,nombremesa,tipo,numerocomanda){

rsAsk("ESTA SEGURO DE REALIZAR LA ENTREGA DE ESTE PEDIDO?", function () {

$('#entrega').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');

var dataString = 'codventa='+codventa+'&nombresala='+nombresala+'&nombremesa='+nombremesa+'&tipo='+tipo;
if (typeof numerocomanda !== 'undefined' && numerocomanda !== null && numerocomanda !== '') {
    dataString += '&numerocomanda='+numerocomanda;
}

$.ajax({
            type: "GET",
      url: "eliminar.php",
            data: dataString,
            success: function(response) {            
                $('#entrega').empty();
                $('#entrega').append(''+response+'').fadeIn("slow");
        if ($("#pedidos").length) {
            $("#pedidos").load("funciones.php?PedidosMostrador=si");
        }
        if (typeof recargarMesasPanelCocinero === 'function') {
            recargarMesasPanelCocinero(function() {
                if (typeof CocineroMostrarMesas === 'function') {
                    CocineroMostrarMesas();
                }
            });
        }
        setTimeout(function() { $("#entrega").html(""); }, 5000);
           }
      });
   });
}


// FUNCION PARA PROCESAR DELIVERY DE PRODUCTOS
function refrescarListaDelivery(){
	if ($("#cargadelivery").length) {
		$("#cargadelivery").load("salas-mesas.php?Muestra_Delivery=si");
	}
	if ($("#muestradelivery").length) {
		$("#muestradelivery").load("salas-mesas.php?Muestra_Delivery=si");
	}
}

function TomarDelivery(codventa,tipo){
rsAsk("¿Desea tomar este pedido de delivery? Quedará asignado a usted.", function () {
$('#entregadelivery').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
var dataString = 'codventa='+codventa+'&tipo='+tipo;
$.ajax({
	type: "GET",
	url: "eliminar.php",
	data: dataString,
	success: function(response) {
		$('#entregadelivery').empty();
		$('#entregadelivery').append(''+response+'').fadeIn("slow");
		refrescarListaDelivery();
		setTimeout(function() { $("#entregadelivery").html(""); }, 5000);
	}
});
});
}

function ProcesarDelivery(codventa,tipo){

rsAsk("ESTA SEGURO DE REALIZAR LA ENTREGA DE DELIVERY?", function () {

$('#entregadelivery').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
                
var dataString = 'codventa='+codventa+'&tipo='+tipo;

$.ajax({
            type: "GET",
      url: "eliminar.php",
            data: dataString,
            success: function(response) {            
                $('#entregadelivery').empty();
                $('#entregadelivery').append(''+response+'').fadeIn("slow");
        refrescarListaDelivery();
        setTimeout(function() { $("#entregadelivery").html(""); }, 5000);
           }
      });
   });
}





//////////////////////////////////////////////////////////// FUNCIONES PARA PROCESAR COMPRAS DE PRODUCTOS /////////////////////////////////////////////////////////////

//FUNCIONES PARA ACTIVAR-DESACTIVAR TIPO DE PAGO EN VENTAS
$(document).ready(function() {

            $("#tipocompra").on("change", function() {
                            
               var valor = $("#tipocompra").val();

               if (valor === "" || valor === true) {

                  $("#formacompra").attr('disabled', true);
                  $("#fechavencecredito").attr('disabled', true);

               } else if (valor === "CONTADO" || valor === true) {

                  $("#formacompra").attr('disabled', false);
                  $("#fechavencecredito").attr('disabled', true);

               } else if (valor === "CREDITO" || valor === true) {

                  // deshabilitamos
                  $("#formacompra").attr('disabled', true);
                  $("#fechavencecredito").attr('disabled', false);
             }
       });
 });

// FUNCION PARA VERIRICAR TIPO DE ENTRADA
function VerificaTipoEntrada(tipoentrada){
	
var tipoentrada = $("#tipoentrada").val();
var dataString = $("#compras").serialize();
//var dataString = 'BuscaComprasModal=si&codcompra='+btoa(codcompra);

var url = 'verifcompra.php?MuestraTipoEntrada=si';

        $.ajax({
            type: "GET",
			url: url,
            data: dataString,
            success: function(response) {            
                $('#muestratipoentrada').empty();
                $('#muestratipoentrada').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
            }
      });
}

// FUNCION PARA MOSTRAR COMPRAS DE PRODUCTOS EN VENTANA MODAL
function VerCompra(codcompra){

$('#muestracomprasmodal').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
var dataString = 'BuscaComprasModal=si&codcompra='+codcompra;
$.ajax({
            type: "GET",
			url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestracomprasmodal').empty();
                $('#muestracomprasmodal').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
           }
      });
}


// FUNCION PARA MOSTRAR DETALLES DE COMPRAS DE PRODUCTOS EN VENTANA MODAL
function VerDetalleCompra(coddetallecompra,tipoentrada){
	
$('#muestradetallecompramodal').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
var dataString = 'BuscaDetallesComprasModal=si&coddetallecompra='+coddetallecompra+'&tipoentrada='+tipoentrada;
$.ajax({
            type: "GET",
			url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestradetallecompramodal').empty();
                $('#muestradetallecompramodal').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
           }
      });
}


//FUNCION PARA ACTUALIZAR IMPORTE EN DETALLE DE COMPRA DE PRODUCTOS
$(document).ready(function (){
          $('.calculo').keyup(function (){
			
			var precio = $('input#precio1').val();
		    var cantidad = $('input#cantcompra').val();
			var importe = $('input#importecompra').val();
			
			//REALIZO EL PRIMER CALCULO
			total=precio*cantidad;
			var original=parseFloat(total.toFixed(2));
			var importe1=Math.round(original*100)/100;
			$("#importecompra").val(original.toFixed(2));
          });
        });

 //FUNCION PARA BUSQUEDA DE ORDEN DE COMPRAS DE PRODUCTOS POR PROVEDORES
function BuscaComprasProveedor(){
		
$('#muestracompraproveedor').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
var codproveedor = $("#codproveedor").val();
var dataString = $("#buscacomprasproveedor").serialize();
var url = 'funciones.php?BuscaComprasPoveedor=si';

        $.ajax({
            type: "GET",
			url: url,
            data: dataString,
            success: function(response) {
                $('#muestracompraproveedor').empty();
                $('#muestracompraproveedor').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
            }
      });	
}

//FUNCION PARA BUSQUEDA DE ORDEN DE COMPRAS DE PRODUCTOS POR FECHAS
function BuscaComprasFechas(){
		
$('#muestracomprafechas').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
var desde = $("#desde").val();
var hasta = $("#hasta").val();
var dataString = $("#buscacomprasfechas").serialize();
var url = 'funciones.php?BuscaComprasFechas=si';

        $.ajax({
            type: "GET",
			url: url,
            data: dataString,
            success: function(response) {
                $('#muestracomprafechas').empty();
                $('#muestracomprafechas').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
            }
      });	
}






















































//////////////////////////////////////////////////////////// FUNCIONES PARA PROCESAR VENTAS DE PRODUCTOS ////////////////////////////////////////////////////////

// FUNCION PARA MOSTRAR VENTAS DE PRODUCTOS EN VENTANA MODAL
function RecibeMesa(codmesa){

window.mesaOperacionSeq = (window.mesaOperacionSeq || 0) + 1;
var mesaId = (typeof normalizarCodmesaRef === 'function') ? normalizarCodmesaRef(codmesa) : String(codmesa || '');
window.codmesaActiva = mesaId;
window.mesaCargando = true;
window.carritoQueue = [];
window.carritoProcessing = false;
window.carritoRequestSeq++;

var codmesaApi = (typeof codmesaRefParaApi === 'function') ? codmesaRefParaApi(codmesa) : codmesa;

$('#recibemesa').html('<div class="progress"><div class="progress-bar progress-bar-primary progress-bar-striped active" role="progressbar" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100" style="width: 100%"><span class="sr-only">100% Complete</span></div></div>');
								
var dataString = 'BuscaMesaReservas=si&codmesa='+codmesaApi;

$.ajax({
            type: "GET",
			url: "funciones.php",
            data: dataString,
            success: function(response) {
                var html = '' + response;
                // Sin arqueo: no abrir productos ni carrito
                if (html.indexOf('NO EXISTE UN ARQUEO DE CAJA') !== -1) {
                    window.mesaCargando = false;
                    window.codmesaActiva = '';
                    if (typeof mostrarVistaMesas === 'function') {
                        mostrarVistaMesas();
                    }
                    $('#salas-mesas').html(html);
                    $('#recibemesa').empty();
                    $('#productos-categorias').empty();
                    return;
                }
                if (typeof mostrarVistaProductos === 'function') {
                    mostrarVistaProductos();
                }
                $("#productos-categorias").load("salas-mesas.php?prod_categorias=si", function() {
                    if (typeof initTabsProductos === 'function') {
                        initTabsProductos();
                    }
                    if (typeof initBusquedasProductoUI === 'function') {
                        initBusquedasProductoUI();
                    }
                });
                $('#recibemesa').empty();
                $('#recibemesa').append(html).fadeIn("slow");
                if (typeof sincronizarCodmesaDesdeDom === 'function') {
                    sincronizarCodmesaDesdeDom();
                } else if (mesaId) {
                    window.codmesaActiva = mesaId;
                }
                window.mesaCargando = false;
                toggleAccionesPedido();
                var mesaCarrito = (typeof obtenerCodmesaActiva === 'function') ? obtenerCodmesaActiva() : mesaId;
                cargarCarritoMesa(mesaCarrito, function() {
                    if (typeof ActualizarVueltoDesdeMontoPagadoSimple === 'function') {
                        ActualizarVueltoDesdeMontoPagadoSimple();
                    }
                });
           },
           error: function() {
                window.mesaCargando = false;
                $('#recibemesa').html('<div class="alert alert-danger"><center>Error al cargar la mesa. Intente de nuevo.</center></div>');
           }
      });
}

// FUNCION PARA MOSTRAR PEDIDOS DE COCINA POR MESA
var cocineroMesaActual = '';

function RecibeMesaCocinero(codmesa){
cocineroMesaActual = codmesa;

$('#recibemesa-cocinero').html('<div class="progress"><div class="progress-bar progress-bar-primary progress-bar-striped active" role="progressbar" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100" style="width: 100%"><span class="sr-only">100% Complete</span></div></div>');

var dataString = 'PedidoCocina=si&codmesa='+codmesa;

$.ajax({
            type: "GET",
            url: "funciones.php",
            data: dataString,
            success: function(response) {
                $('#recibemesa-cocinero').empty();
                $('#recibemesa-cocinero').append(''+response+'').fadeIn("slow");
                if (typeof actualizarTimersMesas === 'function') {
                    actualizarTimersMesas();
                }
           }
      });
}

function CocineroMostrarMesas(){
cocineroMesaActual = '';
$('#recibemesa-cocinero').html('');
}

// FUNCION PARA MOSTRAR FORMA DE PAGO PARA VENTAS
function CargaMesas(){

 setTimeout(function() { $("#recibemesa").html(""); }, 6000);
           
}



 // FUNCION PARA MOSTRAR DELIVERY PENDIENTES EN VENTANA MODAL
function CargaDelivery(){
                  
$('#muestradelivery').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
                  
var dataString = 'Muestra_Delivery=si';

$.ajax({
            type: "GET",
      url: "salas-mesas.php",
            data: dataString,
            success: function(response) {            
                $('#muestradelivery').empty();
                $('#muestradelivery').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
           }
      });
}


// FUNCION PARA BUSQUEDA DE CLIENTES PARA DELIVERY 
function BusquedaClientesDelivery(){
                                     
$('#resultado').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
var buscacliente = $("#buscacliente").val();
var num = $("#buscacliente").val().length;
var dataString = $("#buscaclientes").serialize();
var url = 'funciones2.php?BuscaClientesDeliver=si';

if(buscacliente=="" || buscacliente==" " || num<3){ 

  $("#resultado").html('<br><center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> POR FAVOR INGRESE CRITERIO PARA TU B&Uacute;SQUEDA !</div></center>'); 

return false;
   
    } else {

        $.ajax({
            type: "GET",
            url: url,
            data: dataString,
            success: function(response) {            
                $('#resultado').empty();
                $('#resultado').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
             }
        }); 
       
    }                                                                    
}

// FUNCION PARA BUSQUEDA DE CLIENTES PARA VENTAS  
function BusquedaClientes(){
                                     
$('#resultado').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
var buscacliente = $("#buscacliente").val();
var num = $("#buscacliente").val().length;
var dataString = $("#buscaclientes").serialize();
var url = 'funciones.php?BuscaClientes=si';

if(buscacliente=="" || buscacliente==" " || num<3){ 

  $("#resultado").html('<br><center><div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><span class="fa fa-info-circle"></span> POR FAVOR INGRESE CRITERIO PARA TU B&Uacute;SQUEDA !</div></center>'); 

return false;
   
    } else {

        $.ajax({
            type: "GET",
            url: url,
            data: dataString,
            success: function(response) {            
                $('#resultado').empty();
                $('#resultado').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
             }
        }); 
       
    }                                                                    
}


// FUNCION PARA MOSTRAR FORMA DE PAGO PARA VENTAS
function BuscaFormaPagosVenta(){
	
$('#muestraformapagoventas').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
var tipopagove = $("#tipopagove").val();
var dataString = $("#ventas").serialize();
var url = 'funciones.php?BuscaFormaPagoVentas=si';

        $.ajax({
            type: "GET",
			      url: url,
            data: dataString,
            success: function(response) {            
				  $('#muestracambiospagos').html("");
				  $('#muestraformapagoventas').empty();
          $('#muestraformapagoventas').append(''+response+'').fadeIn("slow");
          $('#'+parent).remove();
            }
      });	
}

// ---- Pago mixto (varios medios, misma cuenta) ----
function $ctxMesaPago() {
	var $r = $('#recibemesa .mesa-detalle-reserva').first();
	if ($r.length) {
		return $r;
	}
	var $v = $('#ventas').first();
	return $v.length ? $v : $(document);
}

function TogglePagoMixto(el) {
	var $ctx = $ctxMesaPago();
	var activo = el && el.checked;
	if (activo) {
		$ctx.find('#pago-simple-wrap').hide();
		$ctx.find('#pago-simple-wrap').find('input,select').prop('disabled', true);
		$ctx.find('#pago-mixto-wrap').show();
		$ctx.find('#formapagove_mix_hidden,#montopagado_mix_hidden,#montodevuelto_mix_hidden').prop('disabled', false);
		$ctx.find('#pago-contado-cambio').hide();
		$ctx.find('#montopagado, #montodevuelto').prop('disabled', true);
		if ($ctx.find('#filas-pago-mixto .fila-pago-mixto').length === 0) {
			AgregarFilaPagoMixto();
			AgregarFilaPagoMixto();
			SeleccionarMedioEfectivoEnSelect($ctx.find('#filas-pago-mixto .formapagove-mix').eq(0));
			var total = parseFloat(String($ctx.find('#txtTotall').val() || $('#txtTotall').val() || '0').replace(',', '')) || 0;
			var mitad = (Math.round((total / 2) * 100) / 100).toFixed(2);
			var resto = (Math.round((total - parseFloat(mitad)) * 100) / 100).toFixed(2);
			$ctx.find('#filas-pago-mixto .montopago-mix').eq(0).val(mitad);
			$ctx.find('#filas-pago-mixto .montopago-mix').eq(1).val(resto);
		}
		ActualizarSumaPagoMixto();
	} else {
		$ctx.find('#pago-mixto-wrap').hide();
		$ctx.find('#formapagove_mix_hidden,#montopagado_mix_hidden,#montodevuelto_mix_hidden').prop('disabled', true);
		$ctx.find('#pago-simple-wrap').show().find('input,select').prop('disabled', false);
		$ctx.find('#pago-contado-cambio').show();
		$ctx.find('#montopagado, #montodevuelto').prop('disabled', false);
		if (typeof ActualizarVueltoDesdeMontoPagadoSimple === 'function') {
			ActualizarVueltoDesdeMontoPagadoSimple();
		}
		if (typeof MuestraCambiosVentas === 'function' && $ctx.find('#formapagove').length) {
			MuestraCambiosVentas();
		}
	}
}

function MedioPagoMixEsEfectivo($select) {
	var txt = $.trim(String($select.find('option:selected').text() || '')).toUpperCase();
	return txt.indexOf('EFECTIVO') !== -1;
}

function SeleccionarMedioEfectivoEnSelect($select) {
	if (!$select || !$select.length) {
		return false;
	}
	var elegido = false;
	$select.find('option').each(function() {
		if ($.trim(String($(this).text() || '')).toUpperCase().indexOf('EFECTIVO') !== -1) {
			$select.val($(this).val());
			elegido = true;
			return false;
		}
	});
	return elegido;
}

function ObtenerMontosEfectivoMixto() {
	var $ctx = $ctxMesaPago();
	var cuentaEfectivo = 0;
	var filasEfectivo = 0;
	$ctx.find('#filas-pago-mixto .fila-pago-mixto').each(function() {
		var $sel = $(this).find('.formapagove-mix');
		if (!MedioPagoMixEsEfectivo($sel)) {
			return;
		}
		filasEfectivo++;
		var monto = parseFloat(String($(this).find('.montopago-mix').val() || '0').replace(',', '')) || 0;
		cuentaEfectivo += monto;
	});
	return {
		cuenta: Math.round(cuentaEfectivo * 100) / 100,
		hayEfectivo: filasEfectivo > 0
	};
}

function AgregarFilaPagoMixto() {
	var $ctx = $ctxMesaPago();
	var opts = ($ctx.find('#html-opciones-medios-pago').length ? $ctx.find('#html-opciones-medios-pago').val() : '') || window.htmlOpcionesMediosPago || '<option value="">SELECCIONE</option>';
	var html = ''
		+ '<div class="row fila-pago-mixto" style="margin-bottom:6px;">'
		+ '  <div class="col-xs-6 col-md-6">'
		+ '    <select name="formapagove_mix[]" class="form-control formapagove-mix" onchange="ActualizarSumaPagoMixto();" required>' + opts + '</select>'
		+ '  </div>'
		+ '  <div class="col-xs-4 col-md-4">'
		+ '    <input type="text" name="montopago[]" class="form-control number montopago-mix" value="0.00" placeholder="Monto a cuenta" onKeyPress="EvaluateText(\'%f\', this);" onBlur="this.value = NumberFormat(this.value, \'2\', \'.\', \'\'); ActualizarSumaPagoMixto();" onKeyUp="ActualizarSumaPagoMixto();" required>'
		+ '  </div>'
		+ '  <div class="col-xs-2 col-md-2">'
		+ '    <button type="button" class="btn btn-danger btn-sm btn-block" onclick="QuitarFilaPagoMixto(this); return false;"><i class="fa fa-trash"></i></button>'
		+ '  </div>'
		+ '</div>';
	$ctx.find('#filas-pago-mixto').append(html);
	ActualizarSumaPagoMixto();
}

function QuitarFilaPagoMixto(btn) {
	var $filas = $ctxMesaPago().find('#filas-pago-mixto .fila-pago-mixto');
	if ($filas.length <= 2) {
		alert('El pago mixto requiere al menos 2 medios de pago.');
		return;
	}
	$(btn).closest('.fila-pago-mixto').remove();
	ActualizarSumaPagoMixto();
}

function ActualizarSumaPagoMixto() {
	var $ctx = $ctxMesaPago();
	var suma = 0;
	$ctx.find('#filas-pago-mixto .montopago-mix').each(function() {
		var v = parseFloat(String($(this).val() || '0').replace(',', '')) || 0;
		suma += v;
	});
	var total = parseFloat(String($ctx.find('#txtTotall').val() || $('#txtTotall').val() || '0').replace(',', '')) || 0;
	var diff = Math.round((suma - total) * 100) / 100;
	$ctx.find('#suma-pago-mixto').text(suma.toFixed(2));
	$ctx.find('#total-cuenta-mixto').text(total.toFixed(2));
	$ctx.find('#diff-pago-mixto').text(diff.toFixed(2));
	var accent = (window.getComputedStyle && document.documentElement)
		? (getComputedStyle(document.documentElement).getPropertyValue('--brand-accent') || '').trim()
		: '';
	if (Math.abs(diff) < 0.05) {
		$ctx.find('#diff-pago-mixto').css('color', accent || '#01ba9a');
	} else {
		$ctx.find('#diff-pago-mixto').css('color', '#e74c3c');
	}
	var primerMedio = '';
	$ctx.find('#filas-pago-mixto .formapagove-mix').each(function() {
		if (!primerMedio && $(this).val()) {
			primerMedio = $(this).val();
			return false;
		}
	});
	$ctx.find('#formapagove_mix_hidden').val(primerMedio || '');

	if (!$ctx.find('#pagomixto').is(':checked')) {
		return;
	}
	$ctx.find('#pago-contado-cambio').hide();
	$ctx.find('#montopagado, #montodevuelto').prop('disabled', true);
	$ctx.find('#montopagado_mix_hidden, #montodevuelto_mix_hidden').prop('disabled', false);

	var ef = ObtenerMontosEfectivoMixto();
	var vuelto = 0;
	if (ef.hayEfectivo && ef.cuenta > 0) {
		var $pagado = $ctx.find('#montopagado');
		if (!$pagado.data('mix-ef-synced')) {
			var actual = parseFloat(String($pagado.val() || '0').replace(',', '')) || 0;
			if (actual <= 0 || Math.abs(actual - total) < 0.001) {
				$pagado.val(ef.cuenta.toFixed(2));
			}
			$pagado.data('mix-ef-synced', true);
		}
		ActualizarVueltoPagoMixtoEfectivo();
		vuelto = parseFloat(String($ctx.find('#montodevuelto').val() || '0').replace(',', '')) || 0;
	} else {
		$ctx.find('#montodevuelto').val('0.00');
		$ctx.find('#montopagado').removeData('mix-ef-synced');
	}
	if (vuelto < 0) {
		vuelto = 0;
	}
	$ctx.find('#montopagado_mix_hidden').val((Math.round((suma + vuelto) * 100) / 100).toFixed(2));
	$ctx.find('#montodevuelto_mix_hidden').val(vuelto.toFixed(2));
}

function ActualizarVueltoPagoMixtoEfectivo() {
	var $ctx = $ctxMesaPago();
	if (!$ctx.find('#pagomixto').is(':checked')) {
		return;
	}
	var ef = ObtenerMontosEfectivoMixto();
	if (!ef.hayEfectivo) {
		return;
	}
	var recibido = parseFloat(String($ctx.find('#montopagado').val() || '0').replace(',', '')) || 0;
	var vuelto = Math.round((recibido - ef.cuenta) * 100) / 100;
	if (vuelto < 0) {
		vuelto = 0;
	}
	var $vuelto = $ctx.find('#montodevuelto');
	if ($vuelto.length && !$vuelto.data('vuelto-touched')) {
		$vuelto.val(vuelto.toFixed(2));
	} else {
		vuelto = parseFloat(String($vuelto.val() || '0').replace(',', '')) || 0;
		if (vuelto < 0) {
			vuelto = 0;
		}
	}
}
window.ActualizarVueltoPagoMixtoEfectivo = ActualizarVueltoPagoMixtoEfectivo;
window.ActualizarSumaPagoMixto = ActualizarSumaPagoMixto;

function ActualizarVueltoDesdeMontoPagadoSimple() {
	var $ctx = $ctxMesaPago();
	if ($ctx.find('#pagomixto').is(':checked')) {
		return;
	}
	var montototal = parseFloat(String($ctx.find('#txtTotall').val() || $('#txtTotall').val() || '0').replace(',', '')) || 0;
	var $pagado = $ctx.find('#montopagado:enabled').first();
	if (!$pagado.length) {
		$pagado = $ctx.find('#montopagado').first();
	}
	var montopagado = parseFloat(String($pagado.val() || '0').replace(',', '')) || 0;
	var vuelto = Math.round((montopagado - montototal) * 100) / 100;
	if (vuelto < 0) {
		vuelto = 0;
	}
	var $vuelto = $ctx.find('#montodevuelto:enabled').first();
	if (!$vuelto.length) {
		$vuelto = $ctx.find('#montodevuelto').first();
	}
	if ($vuelto.length && !$vuelto.data('vuelto-touched')) {
		$vuelto.val(vuelto.toFixed(2));
	}
}
window.ActualizarVueltoDesdeMontoPagadoSimple = ActualizarVueltoDesdeMontoPagadoSimple;

$(document).on('input keyup change blur', '#montopagado, input.calculodevolucion', function() {
	var $ctx = $ctxMesaPago();
	if ($ctx.find('#pagomixto').is(':checked')) {
		$ctx.find('#montodevuelto').removeData('vuelto-touched');
		ActualizarVueltoPagoMixtoEfectivo();
		ActualizarSumaPagoMixto();
		return;
	}
	$ctx.find('#montodevuelto').removeData('vuelto-touched');
	ActualizarVueltoDesdeMontoPagadoSimple();
});
$(document).on('input change blur', '#montodevuelto:not(:disabled)', function() {
	$(this).data('vuelto-touched', true);
});
$(document).on('change keyup input blur', '#filas-pago-mixto .formapagove-mix, #filas-pago-mixto .montopago-mix', function() {
	var $ctx = $ctxMesaPago();
	$ctx.find('#montodevuelto').removeData('vuelto-touched');
	$ctx.find('#montopagado').removeData('mix-ef-synced');
	ActualizarSumaPagoMixto();
});

function ValidarPagoMixtoAntesDeCerrar() {
	var $ctx = $ctxMesaPago();
	if (!$ctx.find('#pagomixto').is(':checked')) {
		return true;
	}
	var filasOk = 0;
	var suma = 0;
	$ctx.find('#filas-pago-mixto .fila-pago-mixto').each(function() {
		var medio = $(this).find('.formapagove-mix').val();
		var monto = parseFloat(String($(this).find('.montopago-mix').val() || '0').replace(',', '')) || 0;
		if (medio && monto > 0) {
			filasOk++;
			suma += monto;
		}
	});
	if (filasOk < 2) {
		alert('En pago mixto debe indicar al menos 2 medios con monto.');
		return false;
	}
	var total = parseFloat(String($ctx.find('#txtTotall').val() || $('#txtTotall').val() || '0').replace(',', '')) || 0;
	if (Math.abs(suma - total) > 0.05) {
		alert('La suma de los medios a cuenta (' + suma.toFixed(2) + ') debe ser igual al total de la cuenta (' + total.toFixed(2) + ').');
		return false;
	}
	var ef = ObtenerMontosEfectivoMixto();
	if (ef.hayEfectivo && ef.cuenta > 0) {
		var recibido = parseFloat(String($ctx.find('#montopagado:enabled').val() || $ctx.find('#montopagado').val() || '0').replace(',', '')) || 0;
		if (recibido + 0.001 < ef.cuenta) {
			alert('El monto recibido en efectivo (' + recibido.toFixed(2) + ') no puede ser menor a la parte en efectivo de la cuenta (' + ef.cuenta.toFixed(2) + ').');
			return false;
		}
	}
	ActualizarSumaPagoMixto();
	return true;
}
// ---- fin pago mixto ----

// FUNCION PARA MOSTRAR FORMA DE PAGO PARA VENTAS
function MuestraCambiosVentas(){
	var $ctx = (typeof $ctxMesaPago === 'function') ? $ctxMesaPago() : $('#ventas');
	if ($ctx.find('#pagomixto').is(':checked')) {
		if (typeof ActualizarSumaPagoMixto === 'function') {
			ActualizarSumaPagoMixto();
		}
		return;
	}
	var $dest = $ctx.find('#pago-contado-cambio').length ? $ctx.find('#pago-contado-cambio') : $('#muestracambiospagos');
	$dest.html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
	var tipopagove = $("#tipopagove").val();
	var formapagove = $("#formapagove").val();
	var dataString = $("#ventas").serialize();
	var url = 'funciones.php?MuestraCambiosVentas=si';

	$.ajax({
		type: "GET",
		url: url,
		data: dataString,
		success: function(response) {
			$dest.empty();
			$dest.append('' + response + '').fadeIn("slow");
			$('#' + parent).remove();
			if (typeof ActualizarVueltoDesdeMontoPagadoSimple === 'function') {
				ActualizarVueltoDesdeMontoPagadoSimple();
			}
		}
	});
}

//FUNCION PARA ACTUALIZAR IMPORTE EN DETALLE DE COMPRA DE PRODUCTOS
// (delegado en input.calculodevolucion — soporta recarga AJAX de la forma de pago)


//FUNCIONES PARA LIMPIAR BUSQUEDA DE VENTAS
$(document).ready(function() {

            $("#tipobusqueda").on("change", function() {
                            
               var valor = $("#tipobusqueda").val();

               if (valor === "" || valor === true) {

                  $("#codcliente").val('');
                  $("#busquedacliente").val('');
                  $("#codcaja").val('');
                  $("#fecha").val('');

               } else if (valor === "1" || valor === true) {

                  $("#codcaja").val('');
                  $("#fecha").val('');

               } else if (valor === "2" || valor === true) {

                  // deshabilitamos
                  $("#codcliente").val('');
                  $("#busquedacliente").val('');
                  $("#fecha").val('');
             
               } else if (valor === "3" || valor === true) {

                  // deshabilitamos
                  $("#codcliente").val('');
                  $("#busquedacliente").val('');
                  $("#codcaja").val('');
                  //$("#fecha").attr('disabled', true);
             }
       });
 });


 //FUNCION PARA BUSQUEDA DE VENTAS POR CRITERIOS
function BuscarVentas(){
                  
$('#muestraventas').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');

var tipobusqueda = $("#tipobusqueda").val();
var codcliente = $("#codcliente").val();
var codcaja = $("#codcaja").val();
var fecha = $("#fecha").val();

var dataString = $("#buscarventas").serialize();
var url = 'funciones.php?BuscarVentas=si';

$.ajax({
            type: "GET",
      url: url,
            data: dataString,
            success: function(response) {            
                $('#muestraventas').empty();
                $('#muestraventas').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
              }
      }); 
} 



 // FUNCION PARA MOSTRAR VENTAS DE PRODUCTOS EN VENTANA MODAL
function VerVentas(codventa){
									
$('#muestraventasmodal').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
								  
var dataString = 'BuscaVentasModal=si&codventa='+codventa;

$.ajax({
            type: "GET",
			url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestraventasmodal').empty();
                $('#muestraventasmodal').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
           }
      });
}

//FUNCIONES PARA LIMPIAR BUSQUEDA DETALLES DE VENTAS
$(document).ready(function() {

            $("#tipobusquedad").on("change", function() {
                            
               var valor = $("#tipobusquedad").val();

               if (valor === "" || valor === true) {

                  $("#codventa").val('');
                  $("#codcaja").val('');
                  $("#fecha").val('');

               } else if (valor === "1" || valor === true) {

                  $("#codcaja").val('');
                  $("#fecha").val('');

               } else if (valor === "2" || valor === true) {

                  // deshabilitamos
                  $("#codventa").val('');
                  $("#fecha").val('');
             
               } else if (valor === "3" || valor === true) {

                  // deshabilitamos
                  $("#codventa").val('');
                  $("#codcaja").val('');
                  //$("#fecha").attr('disabled', true);
             }
       });
 });

 //FUNCION PARA BUSQUEDA DETALLES DE VENTAS POR CRITERIOS
function BuscarDetallesVentas(){
                  
$('#muestradetallesventas').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');

var tipobusqueda = $("#tipobusquedad").val();
var codventa = $("#codventa").val();
var codcaja = $("#codcaja").val();
var fecha = $("#fecha").val();

var dataString = $("#buscardetallesventas").serialize();
var url = 'funciones.php?BuscarDetallesVentas=si';

$.ajax({
            type: "GET",
      url: url,
            data: dataString,
            success: function(response) {            
                $('#muestradetallesventas').empty();
                $('#muestradetallesventas').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
              }
      }); 
} 


// FUNCION PARA MOSTRAR DETALLES DE VENTA DE PRODUCTOS EN VENTANA MODAL
function VerDetalleVentas(coddetalleventa){
									
$('#muestradetalleventamodal').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
								  
var dataString = 'BuscaDetallesVentasModal=si&coddetalleventa='+coddetalleventa;

$.ajax({
            type: "GET",
			url: "funciones.php",
            data: dataString,
            success: function(response) {            
                $('#muestradetalleventamodal').empty();
                $('#muestradetalleventamodal').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
           }
      });
}

// FUNCION PARA CARGAR LOS DATOS DE CLIENTES
function CargaDetalleVenta (coddetalleventa,idventa,ivaproducto,codigoventa,codproducto,producto,nomcategoria
  ,precioventa,preciocompra,cantventa,importe,importe2,fechadetalleventa,tipobusquedad,codcaja,fecha) 
{
    // aqui asigno cada valor a los campos correspondientes
  $("#updatedetallesventas #coddetalleventa").val( coddetalleventa );
  $("#updatedetallesventas #idventa").val( codigoventa );
  $("#updatedetallesventas #ivaproducto").val( ivaproducto );
  $("#updatedetallesventas #codigoventa").val( idventa );
  $("#updatedetallesventas #codproducto").val( codproducto );
  $("#updatedetallesventas #producto").val( producto );
  $("#updatedetallesventas #nomcategoria").val( nomcategoria );
  $("#updatedetallesventas #precioventa").val( precioventa );
  $("#updatedetallesventas #preciocompra").val( preciocompra );
  $("#updatedetallesventas #cantidadventadb").val( cantventa );
  $("#updatedetallesventas #cantventa").val( cantventa );
  $("#updatedetallesventas #importe").val( importe );
  $("#updatedetallesventas #importe2").val( importe2 );
  $("#updatedetallesventas #fechadetalleventa").val( fechadetalleventa );
  $("#updatedetallesventas #tipobusquedad2").val( tipobusquedad );
  $("#updatedetallesventas #codcaja2").val( codcaja );
  $("#updatedetallesventas #fecha2").val( fecha );
}

//FUNCION PARA ACTUALIZAR IMPORTE EN DETALLE DE VENTA DE PRODUCTOS
$(document).ready(function (){
          $('.calculoventa').keyup(function (){
			
			var precio = $('input#precioventa').val();
			var precio2 = $('input#preciocompra').val();
		    var cantidad = $('input#cantventa').val();
			var importe = $('input#importe').val();
			var importe2 = $('input#importe2').val();
			
			//REALIZO EL PRIMER CALCULO
			total=precio*cantidad;
			var original=parseFloat(total);
			//var importe1=Math.round(original*100)/100;
			$("#importe").val(original.toFixed(2));
			
			//REALIZO EL SEGUNDO CALCULO
			total2=precio2*cantidad;
			var original2=parseFloat(total2);
			//var importe3=Math.round(original2*100)/100;
			$("#importe2").val(original2.toFixed(2));
			
          });
        });


/////FUNCION PARA ELIMINAR DETALLES DE VENTAS 
function EliminarDetalleVenta(codmesa,coddetalleventa,codcaja,tipopagove,idventa,codventa,codcliente,codproducto,cantventa,precioventa,ivaproducto,tipo,tipobusquedad,fecha) {

var dataString = 'codmesa='+codmesa+'&coddetalleventa='+coddetalleventa+'&codcaja='+codcaja+'&tipopagove='+tipopagove+'&codventa='+codventa+'&codcliente='+codcliente+'&codproducto='+codproducto+'&cantventa='+cantventa+'&precioventa='+precioventa+'&ivaproducto='+ivaproducto+'&tipo='+tipo;
rsAsk("ESTA SEGURO DE ELIMINAR ESTE DETALLE DE VENTA?", function () {
        $.ajax({
            type: "GET",
            url: "eliminar.php",
            data: dataString,
            success: function(response) {            
                $('#delete-ok').empty();
                $('#delete-ok').append('<center>'+response+'</center>').fadeIn("slow");
$("#muestradetallesventas").load("funciones.php?BuscarDetallesVentas=si&tipobusquedad="+tipobusquedad+'&codventa='+codventa+'&codcaja='+codcaja+'&fecha='+fecha);
                setTimeout(function() { $("#delete-ok").html(""); }, 5000);
                $('#'+parent).remove();
            }
        });
      }, { danger: true });
}


//FUNCION PARA BUSQUEDA DE VENTAS POR FECHAS Y CAJAS DE VENTAS PARA REPORTES
function BuscaVentasCajas(){
									
$('#muestraventascajas').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');

var codcaja = $("select[name='codcaja']").val();
var desde = $("#desde").val();
var hasta = $("#hasta").val();
var dataString = $("#buscaventascajas").serialize();
var url = 'funciones.php?BuscaVentasCajas=si';

$.ajax({
            type: "GET",
			url: url,
            data: dataString,
            success: function(response) {            
                $('#muestraventascajas').empty();
                $('#muestraventascajas').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
              }
      });	
} 


//FUNCION PARA LISTAR VENTAS CON TOTAL Y POR CAJA
function BuscarVentasCajasID(){
                  
$('#muestraventascajas').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');

var codcaja = $("select[name='codcaja']").val();
var desde = $("#desde").val();
var hasta = $("#hasta").val();
var dataString = $("#buscaventascajas").serialize();
var url = 'funciones.php?BuscarVentasCajasID=si';

$.ajax({
            type: "GET",
      url: url,
            data: dataString,
            success: function(response) {            
                $('#muestraventascajas').empty();
                $('#muestraventascajas').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
              }
      }); 
} 

//FUNCION PARA BUSQUEDA DE VENTAS POR FECHAS PARA REPORTES
function BuscaVentasFechas(){
									
$('#muestraventasfechas').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');

var desde = $("#desde").val();
var hasta = $("#hasta").val();
var dataString = $("#buscaventasfechas").serialize();
var url = 'funciones.php?BuscaVentasFechas=si';

$.ajax({
            type: "GET",
			url: url,
            data: dataString,
            success: function(response) {            
                $('#muestraventasfechas').empty();
                $('#muestraventasfechas').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
               }
      });	
} 


//FUNCION PARA BUSQUEDA DE PRODUCTOS VENDIDOS POR FECHAS PARA REPORTES
function BuscaProductoVendidosFechas(){
                  
$('#muestraproductosfechas').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');

var desde = $("#desde").val();
var hasta = $("#hasta").val();
var dataString = $("#buscaproductosfechas").serialize();
var url = 'funciones.php?BuscaProductosVendidosFechas=si';

$.ajax({
            type: "GET",
      url: url,
            data: dataString,
            success: function(response) {            
                $('#muestraproductosfechas').empty();
                $('#muestraproductosfechas').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
               }
      }); 
}


//FUNCION PARA BUSQUEDA DE INGREDIENTES VENDIDOS POR FECHAS PARA REPORTES
function BuscaIngredientesVendidosFechas(){
                  
$('#muestraingredientesfechas').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');

var desde = $("#desde").val();
var hasta = $("#hasta").val();
var dataString = $("#buscaingredientesfechas").serialize();
var url = 'funciones.php?BuscaIngredientesVendidosFechas=si';

$.ajax({
            type: "GET",
      url: url,
            data: dataString,
            success: function(response) {            
                $('#muestraingredientesfechas').empty();
                $('#muestraingredientesfechas').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
               }
      }); 
}  



// FUNCION PARA BUSQUEDA DE KARDEX POR PRODUCTOS
function BuscaKardexProductos(){
		
$('#muestrakardexproducto').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
var codproducto = $("#codproducto").val();
var dataString = $("#buscakardex").serialize();
var url = 'funciones.php?BuscaKardexProducto=si';

        $.ajax({
            type: "GET",
			url: url,
            data: dataString,
            success: function(response) {
                $('#muestrakardexproducto').empty();
                $('#muestrakardexproducto').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
            }
      });	
}


//FUNCION PARA BUSQUEDA DE ARQUEOS DE CAJAS POR FECHAS PARA REPORTES
function BuscaArqueosCajasFechas(){
                  
$('#muestraarqueosfechas').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');

var desde = $("#desde").val();
var hasta = $("#hasta").val();
var dataString = $("#buscaarqueosfechas").serialize();
var url = 'funciones.php?BuscaArqueosFechas=si';

$.ajax({
            type: "GET",
      url: url,
            data: dataString,
            success: function(response) {            
                $('#muestraarqueosfechas').empty();
                $('#muestraarqueosfechas').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
               }
      }); 
}

//FUNCION PARA BUSQUEDA DE MOVIMIENTOS DE CAJAS POR FECHAS PARA REPORTES
function BuscaMovimientosCajasFechas(){
                  
$('#muestramovimientosfechas').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');

var codcaja = $("select[name='codcaja']").val();
var desde = $("#desde").val();
var hasta = $("#hasta").val();
var dataString = $("#buscamovimientosfechas").serialize();
var url = 'funciones.php?BuscaMovimientosFechas=si';

$.ajax({
            type: "GET",
      url: url,
            data: dataString,
            success: function(response) {            
                $('#muestramovimientosfechas').empty();
                $('#muestramovimientosfechas').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
               }
      }); 
}


//FUNCION PARA BUSQUEDA DE INFORMES DE VENTAS POR FECHAS PARA REPORTES
function BuscaInformeVentasFechas(){
                  
$('#muestrainformeventasfechas').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');

var desde = $("#desde").val();
var hasta = $("#hasta").val();
var dataString = $("#buscainformeventasfechas").serialize();
var url = 'funciones.php?BuscaInformeVentasFechas=si';

$.ajax({
            type: "GET",
      url: url,
            data: dataString,
            success: function(response) {            
                $('#muestrainformeventasfechas').empty();
                $('#muestrainformeventasfechas').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
               }
      }); 
}


//FUNCION PARA BUSQUEDA DE INFORMES GENERAL DE CAJAS POR FECHAS PARA REPORTES
function BuscaInformesCajasFechas(){
                  
$('#muestrainformescajasfechas').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');

var codcaja = $("select[name='codcaja']").val();
var desde = $("#desde").val();
var hasta = $("#hasta").val();
var dataString = $("#buscainformescajasfechas").serialize();
var url = 'funciones.php?BuscaInformeCajasFechas=si';

$.ajax({
            type: "GET",
      url: url,
            data: dataString,
            success: function(response) {            
                $('#muestrainformescajasfechas').empty();
                $('#muestrainformescajasfechas').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
               }
      }); 
}






















///////////////////////////////////////////////// FUNCIONES PARA PROCESAR ABONOS A CREDITOS DE PRODUCTOS /////////////////////////////////////////////////////

// FUNCION PARA BUSQUEDA DE ABONOS DE CLIENTES
function BuscaClientesAbonos(){
		
$('#muestraclientesabonos').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
var codcliente = $("#codcliente").val();
var dataString = $("#abonoscreditos").serialize();
var url = 'funciones.php?BuscaAbonosClientes=si';

        $.ajax({
            type: "GET",
			url: url,
            data: dataString,
            success: function(response) {
                $('#muestraformularioabonos').html("");            
                $('#muestraclientesabonos').empty();
                $('#muestraclientesabonos').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
            }
      });	
}

// FUNCION PARA MOSTRAR FOMRULARIO DE NUEVOS ABONOS
function NuevoAbono(cedcliente,codventa){
	
$('#muestraformularioabonos').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
var dataString = 'MuestraFormularioAbonos=si&cedcliente='+btoa(cedcliente)+'&codventa='+btoa(codventa);

 $.ajax({
            type: "GET",
			url: "funciones.php",
            data: dataString,
            success: function(response) {            
				$('#muestraformularioabonos').empty();
                $('#muestraformularioabonos').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
            }
      });
}

// FUNCION PARA MOSTRAR CREDITOS DE VENTAS DE PRODUCTOS EN VENTANA MODAL
function VerCreditos(codventa){
		
$('#muestracreditosmodal').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
var dataString = 'BuscaCreditosModal=si&codventa='+codventa;

 $.ajax({
            type: "GET",
			url: "funciones.php",
            data: dataString,
            success: function(response) {            
				$('#muestracreditosmodal').empty();
                $('#muestracreditosmodal').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
            }
      });
}

// FUNCION PARA BUSQUEDA DE ABONOS DE CLIENTES PARA REPORTES
function BuscaCreditosClientes(){
		
$('#muestracreditosclientes').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
var codcliente = $("#codcliente").val();
var dataString = $("#creditosclientes").serialize();
var url = 'funciones.php?BuscaCreditosClientes=si';

        $.ajax({
            type: "GET",
			url: url,
            data: dataString,
            success: function(response) {
                $('#muestracreditosclientes').empty();
                $('#muestracreditosclientes').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
            }
      });	
}


// FUNCION PARA BUSQUEDA DE ABONOS DE CLIENTES PARA REPORTES
function BuscaCreditosFechas(){
		
$('#muestracreditosfechas').html('<center><img src="assets/images/loading.gif" width="30" height="30"/></center>');
var desde = $("#desde").val();
var hasta = $("#hasta").val();
var dataString = $("#creditosfechas").serialize();
var url = 'funciones.php?BuscaCreditosFechas=si';

        $.ajax({
            type: "GET",
			url: url,
            data: dataString,
            success: function(response) {
                $('#muestracreditosfechas').empty();
                $('#muestracreditosfechas').append(''+response+'').fadeIn("slow");
                $('#'+parent).remove();
            }
      });	
}