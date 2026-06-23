<?php
require_once("class/class.php");
$tra = new Login();
$tipo = base64_decode($_GET['tipo']);
switch($tipo)
	{
case 'USUARIOS':
$tra->EliminarUsuarios();
exit;
break;

case 'SALAS':
$tra->EliminarSalas();
exit;
break;

case 'MESAS':
$tra->EliminarMesas();
exit;
break;

case 'MEDIOPAGO':
$tra->EliminarMediosPagos();
exit;
break;

case 'CATEGORIAS':
$tra->EliminarCategorias();
exit;
break;

case 'CAJAS':
$tra->EliminarCaja();
exit;
break;

case 'CLIENTES':
$tra->EliminarClientes();
exit;
break;

case 'PROVEEDORES':
$tra->EliminarProveedores();
exit;
break;

case 'INGREDIENTES':
$tra->EliminarIngredientes();
exit;
break;

case 'PRODUCTOS':
$tra->EliminarProductos();
exit;
break;

case 'ELIMINAINGREDIENTES':
$tra->EliminarIngredientesProductos();
exit;
break;


case 'PAGARFACTURA':
$tra->PagarCompras();
exit;
break;

case 'DETALLESCOMPRAS':
$tra->EliminarDetallesCompras();
exit;
break;

case 'ARQUEOCAJA':
$tra->EliminarArqueoCaja();
exit;
break;

case 'MOVIMIENTOCAJA':
$tra->EliminarMovimientoCajas();
exit;
break;

case 'DETALLESVENTAS':
$tra->EliminarDetallesVentas();
exit;
break;

case 'DETALLESVENTASPEDIDOS':
$tra->EliminarDetallesVentasPedidosProductos();
exit;
break;

case 'ENTREGASPEDIDOS':
$tra->EntregarPedidos();
exit;
break;

case 'PROCESARENTREGA':
$tra->EntregarDelivery();
exit;
break;


}
?>