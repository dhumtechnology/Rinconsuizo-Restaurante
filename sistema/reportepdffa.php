<?php
ob_start();
include_once('fpdf/pdf.php');
require_once("class/class.php");

//ob_start();

$casos = array (

                  'USUARIOS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarUsuarios',

                                    'output' => array('Listado de Usuarios.pdf', 'I')

                                  ),

                  'LOGS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarLogs',

                                    'output' => array('Listado Logs de Acceso.pdf', 'I')

                                  ),
				
			         	'CAJAS' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaListarCajas',

                                    'output' => array('Listado de Cajas de Ventas.pdf', 'I')

                                  ),

                  'CLIENTES' => array(

                                    'medidas' => array('L','mm','LEGAL'),

                                    'func' => 'TablaListarClientes',

                                    'output' => array('Listado General de Clientes.pdf', 'I')

                                  ),

                  'PROVEEDORES' => array(

                                    'medidas' => array('L','mm','LEGAL'),

                                    'func' => 'TablaListarProveedores',

                                    'output' => array('Listado General de Proveedores.pdf', 'I')

                                  ),


                  'INGREDIENTES' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaListarIngredientes',

                                    'output' => array('Listado General de Ingredientes.pdf', 'I')

                                  ),

                  'INGREDIENTESSTOCK' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'ListarIngredientesStockMinimo',

                                    'output' => array('Listado de Ingredientes en Stock Minimo.pdf', 'I')

                                  ),

                  'INGREDIENTESVENDIDOSFECHAS' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaListarIngredientesVendidos',

                                    'output' => array('Listado de Ingredientes Vendidos.pdf', 'I')

                                  ),
       
        'KARDEXINGREDIENTES' => array(

                                    'medidas' => array('L','mm','LEGAL'),

                                    'func' => 'TablaKardexIngredientes',

                                    'output' => array('Kardex por Ingrediente.pdf', 'I')

                                  ),


                  'PRODUCTOS' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarProductos',

                                    'output' => array('Listado de Productos en Almacen.pdf', 'I')

                                  ),

                  'PRODUCTOSSTOCK' => array(

                                    'medidas' => array('L','mm','LEGAL'),

                                    'func' => 'ListarProductosStockMinimo',

                                    'output' => array('Listado de Productos en Stock Minimo.pdf', 'I')

                                  ),
       
        'KARDEXPRODUCTOS' => array(

                                    'medidas' => array('L','mm','LEGAL'),

                                    'func' => 'TablaKardexProductos',

                                    'output' => array('Kardex por Producto.pdf', 'I')

                                  ),

                  'PRODUCTOSVENDIDOSFECHAS' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaListarProductosVendidos',

                                    'output' => array('Listado de Productos Vendidos.pdf', 'I')

                                  ),

                  'PEDIDOS' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaPedidosProductos',

                                    'output' => array('Factura de Pedidos.pdf', 'I')

                                  ),

                  'FACTURACOMPRAS' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaComprasProductos',

                                    'output' => array('Factura de Compras.pdf', 'I')

                                  ),
			 
			  'COMPRASGENERAL' => array(

                                    'medidas' => array('L','mm','LEGAL'),

                                    'func' => 'TablaComprasGeneral',

                                    'output' => array('Listado de Compras.pdf', 'I')

                                  ),
			 
			  'COMPRASPROVEEDOR' => array(

                                    'medidas' => array('L','mm','LEGAL'),

                                    'func' => 'TablaComprasProveedor',

                                    'output' => array('Compras por Proveedor.pdf', 'I')

                                  ),
			 
			  'COMPRASFECHAS' => array(

                                    'medidas' => array('L','mm','LEGAL'),

                                    'func' => 'TablaComprasFechas',

                                    'output' => array('Compras por Fechas.pdf', 'I')

                                  ),
       
        'COMPRASXPAGAR' => array(

                                    'medidas' => array('L','mm','LEGAL'),

                                    'func' => 'TablaComprasxPagar',

                                    'output' => array('Listado de Compras por Pagar.pdf', 'I')

                                  ),

                  'DELIVERY' => array(

                                    'medidas' => array('L', 'mm', 'LEGAL'),

                                    'func' => 'TablaListarDelivery',

                                    'output' => array('Listado de Delivery.pdf', 'I')

                                  ),
				
				'VENTAS' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaFacturaVentas',

                                    'output' => array('Factura de Venta.pdf', 'I')

                                  ),
        
        'TICKETCOMANDA' => array(

                                    'medidas' => array('P','mm','ticket2'),

                                    'func' => 'TablaTicketComanda',  

                                    'output' => array('Ticket de Comanda.pdf', 'I')

                                  ),
        
        'TICKETPRECUENTA' => array( 

                                    'medidas' => array('P','mm',array(58,297)),

                                    'func' => 'TablaTicketPrecuenta',

                                    'output' => array('Ticket de Precuenta.pdf', 'I')

                                  ),
				
				'TICKET' => array(

                                    'medidas' => array('P','mm',array(58,297)),

                                    'func' => 'TablaTicketVentasFa',

                                    'output' => array('Ticket de Venta.pdf', 'I')

                                  ),
        'ARQUEOCAJA' => array(

                                    'medidas' => array('P','mm',array(58,297)),

                                    'func' => 'TablaTicketArqueo',

                                    'output' => array('Ticket de Arqueo.pdf', 'I')

                                  ),
			 
			  'VENTASFECHAS' => array(

                                    'medidas' => array('L','mm','LEGAL'),

                                    'func' => 'TablaVentasFechas',

                                    'output' => array('Ventas por Fechas.pdf', 'I')

                                  ),
			 
			  'VENTASCAJAS' => array(

                                    'medidas' => array('L','mm','LEGAL'),

                                    'func' => 'TablaVentasCajas',

                                    'output' => array('Ventas por Fechas y Cajas.pdf', 'I')

                                  ),


                  'ARQUEOSXFECHAS' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaListarArqueosCajas',

                                    'output' => array('Listado de Arqueo de Cajas.pdf', 'I')

                                  ),


                  'MOVIMIENTOSXFECHAS' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaListarMovimientosCajas',

                                    'output' => array('Listado de Movimientos de Cajas.pdf', 'I')

                                  ),



                  'INFORMEVENTAS' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaListarInformeVentas',

                                    'output' => array('Informe de Ventas.pdf', 'I')

                                  ),



                  'INFORMECAJAS' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaListarInformeCajas',

                                    'output' => array('Informe de Cajas.pdf', 'I')

                                  ),
			 
			  'VENTASDIARIASADMINISTRADOR' => array(

                                    'medidas' => array('L','mm','LEGAL'),

                                    'func' => 'TablaVentasDiariasAdmin',

                                    'output' => array('Ventas Diarias General.pdf', 'I')

                                  ),
			 
			  'VENTASDIARIASVENDEDOR' => array(

                                    'medidas' => array('L','mm','LEGAL'),

                                    'func' => 'TablaVentasDiariasVendedor',

                                    'output' => array('Ventas Diarias por Caja.pdf', 'I')

                                  ),
				
				'TICKETCREDITOS' => array(

                                    'medidas' => array('P','mm','ticket'),

                                    'func' => 'TablaTicketCreditos',

                                    'output' => array('Ticket de Venta.pdf', 'I')

                                  ),
			 
			  'CREDITOSCLIENTES' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'TablaCreditosClientes',

                                    'output' => array('Creditos por Clientes.pdf', 'I')

                                  ),
			 
			  'CREDITOSFECHAS' => array(

                                    'medidas' => array('L','mm','LEGAL'),

                                    'func' => 'TablaCreditosFechas',

                                    'output' => array('Creditos por Fechas.pdf', 'I')

                                  ),
								  
				  'ESTADISTICAS' => array(

                                    'medidas' => array('P', 'mm', 'A4'),

                                    'func' => 'MuestraGrafica',

                                    'output' => array('Grafico de Ventas Anual.pdf', 'I')

                                  ),

                );

  
$tipo = $_GET['tipo'];
$caso_data = $casos[$tipo];
$pdf = new PDF($caso_data['medidas'][0], $caso_data['medidas'][1], $caso_data['medidas'][2]);
$pdf->AddPage();
$pdf->SetAuthor("NelsonStudio");
$pdf->SetCreator("FPDF Y PHP");
$pdf->{$caso_data['func']}(); 
$pdf->Output($caso_data['output'][0], $caso_data['output'][1]);
ob_end_flush();


/*if ($tipo == 'TICKET' || $tipo == 'TICKETPRECUENTA') {
  $caso_data = $casos[$tipo];
  $pdf = new PDF($caso_data['medidas'][0], $caso_data['medidas'][1], $caso_data['medidas'][2]);
  $pdf->AddPage();
  $pdf->{$caso_data['func']}();
  $pdf->AutoPrint(false);
  $pdf->Output($caso_data['output'][0], $caso_data['output'][1]);
  ob_end_flush();
  
}elseif ($tipo == 'TICKETCOMANDA') {
  $caso_data = $casos[$tipo];
  $pdf = new PDF($caso_data['medidas'][0], $caso_data['medidas'][1], $caso_data['medidas'][2]);
  $pdf->AddPage();
  $pdf->{$caso_data['func']}();
  $pdf->AutoPrint(false);
  $pdf->Output($caso_data['output'][0], $caso_data['output'][1]);
  ob_end_flush();
}else{
  $caso_data = $casos[$tipo];
  $pdf = new PDF($caso_data['medidas'][0], $caso_data['medidas'][1], $caso_data['medidas'][2]);
  $pdf->AddPage();
  $pdf->{$caso_data['func']}();
  $pdf->Output($caso_data['output'][0], $caso_data['output'][1]);
  ob_end_flush();
}*/

?>