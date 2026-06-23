<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="cajero" || $_SESSION["acceso"]=="repartidor") {

$con = new Login();
$con = $con->ConfiguracionPorId();
$simbolo = $con[0]['simbolo'];

$tipo = base64_decode($_GET['tipo']);
switch($tipo)
  {

case 'USUARIOS': 

$hoy = "LISTADO_GENERAL_USUARIOS";
header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>Nit</th>
           <th>NOMBRES Y APELLIDOS</th>
           <th>Nº DE TELÉFONO</th>
           <th>CARGO</th>
           <th>EMAIL</th>
           <th>USUARIO</th>
           <th>NIVEL</th>
           <th>STATUS</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarUsuarios();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr align="center" class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['cedula']; ?></td>
           <td><?php echo $reg[$i]['nombres']; ?></td>
           <td><?php echo $reg[$i]['nrotelefono']; ?></td>
           <td><?php echo $reg[$i]['cargo']; ?></td>
           <td><?php echo $reg[$i]['email']; ?></td>
           <td><?php echo $reg[$i]['usuario']; ?></td>
           <td><?php echo $reg[$i]['nivel']; ?></td>
           <td><?php echo $reg[$i]['status']; ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;

case 'LOGS': 

$hoy = "LISTADO_GENERAL_LOGS";
header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>IP</th>
           <th>TIEMPO DE ENTRADA</th>
           <th>DETALLES DE ACCESO</th>
           <th>USUARIOS</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarLogs();

if($reg==""){
echo "";      
} else {
  
$a=1; 
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr align="center" class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['ip']; ?></td>
           <td><?php echo $reg[$i]['tiempo']; ?></td>
           <td><?php echo $reg[$i]['detalles']; ?></td>
           <td><?php echo $reg[$i]['usuario']; ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;

case 'CAJAS': 

$hoy = "CAJAS_VENTAS";
header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>Nº CAJA</th>
           <th>NOMBRE DE CAJA</th>
           <th>CÉDULA CAJERO</th>
           <th>NOMBRE CAJERO</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarCajas();

if($reg==""){
echo "";      
} else {
  
$a=1;  
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr align="center" class="even_row">
           <td><?php echo $reg[$i]['codcaja']; ?></td>
           <td><?php echo $reg[$i]['nrocaja']; ?></td>
           <td><?php echo $reg[$i]['nombrecaja']; ?></td>
           <td><?php echo $reg[$i]['cedula']; ?></td>
           <td><?php echo $reg[$i]['nombres']; ?></td>
         </tr>
        <?php } } ?>
</table>

<?php
break;

case 'CLIENTES': 

$hoy = "LISTADO_GENERAL_CLIENTES";
header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>Nit</th>
           <th>NOMBRES</th>
           <th>DIRECCIÓN</th>
           <th>N° DE TELEFONO</th>
           <th>EMAIL</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarClientes();

if($reg==""){
echo "";      
} else {
  
$a=1;   
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr align="center" class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['cedcliente']; ?></td>
           <td><?php echo $reg[$i]['nomcliente']; ?></td>
           <td><?php echo $reg[$i]['direccliente']; ?></td>
           <td><?php echo $reg[$i]['tlfcliente']; ?></td>
           <td><?php echo $reg[$i]['emailcliente']; ?></td>
         </tr>
        <?php } } ?>
</table>

<?php
break;

case 'PROVEEDORES': 

$hoy = "LISTADO_GENERAL_PROVEEDORES";
header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>Nit</th>
           <th>NOMBRE DE PROVEEDOR</th>
           <th>DIRECCIÓN DOMICILIARIA</th>
           <th>N° DE TELÉFONO</th>
           <th>EMAIL</th>
           <th>CONTACTO</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarProveedores();

if($reg==""){
echo "";      
} else {
  
$a=1;  
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr align="center" class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['ritproveedor']; ?></td>
           <td><?php echo $reg[$i]['nomproveedor']; ?></td>
           <td><?php echo $reg[$i]['direcproveedor']; ?></td>
           <td><?php echo $reg[$i]['tlfproveedor']; ?></td>
           <td><?php echo $reg[$i]['emailproveedor']; ?></td>
           <td><?php echo $reg[$i]['contactoproveedor']; ?></td>
         </tr>
        <?php } } ?>
</table>

<?php
break;

case 'PRODUCTOS': 

$tra = new Login();
$reg = $tra->ListarProductos();

$hoy = "LISTADO_GENERAL_PRODUCTOS";

header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>CÓDIGO</th>
           <th>DESCRIPCIÓN DE PRODUCTO</th>
           <th>CATEGORIA</th>
           <th>PRECIO COMPRA</th>
           <th>PRECIO VENTA</th>
           <th>EXISTENCIA</th>
           <th>STOCK MINIMO</th>
           <th>IVA</th>
           <th>DESC%</th>
           <th>PROVEEDOR</th>
           <th>CÓDIGO BARRA</th>
           <th>FAVORITO</th>
           <th>STATUS</th>
         </tr>
      <?php

if($reg==""){
echo "";      
} else {
  
$a=1;   
for($i=0;$i<sizeof($reg);$i++){
?>
         <tr align="center" class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['codproducto']; ?></td>
           <td><?php echo $reg[$i]['producto']; ?></td>
           <td><?php echo $reg[$i]['nomcategoria']; ?></td>
           <td><?php echo $reg[$i]['preciocompra']; ?></td>
           <td><?php echo $simbolo.$reg[$i]['precioventa']; ?></td>
           <td><?php echo $reg[$i]['existencia']; ?></td>
           <td><?php echo $reg[$i]['stockminimo']; ?></td>
           <td><?php echo $reg[$i]['ivaproducto']; ?></td>
           <td><?php echo $reg[$i]['descproducto']; ?></td>
           <td><?php echo $reg[$i]['nomproveedor']; ?></td>
           <td><?php echo $reg[$i]['codigobarra']; ?></td>
           <td><?php echo $reg[$i]['favorito']; ?></td>
           <td><?php echo $reg[$i]['statusproducto']; ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;

case 'PRODUCTOSVENDIDOS': 

$hoy = "PRODUCTOS_VENDIDOS_DESDE_".$_GET["desde"]."_HASTA_".$_GET["hasta"];
header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls");  

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>N°</th>
           <th>CÓDIGO</th>
           <th>DESCRIPCIÓN DE PRODUCTO</th>
           <th>CATEGORIA</th>
           <th>PRECIO VENTA</th>
           <th>VENDIDO</th>
           <th>COSTO TOTAL</th>
           <th>EXISTENCIA</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarProductosVendidos();

    if($reg==""){

    echo "";      
    
    } else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){ 
?>
         <tr align="center" class="even_row">
          <td><?php echo $a++; ?></td>
          <td><?php echo $reg[$i]['codproducto']; ?></td>
          <td><?php echo $reg[$i]['producto']; ?></td>
          <td><?php echo $reg[$i]['nomcategoria']; ?></td>
          <td><?php echo $con[0]['simbolo'].number_format($reg[$i]['precioventa'], 2, '.', ','); ?></td>
          <td><?php echo $nro = ( $reg[$i]["cantidad"] == '' ? "0" : $reg[$i]["cantidad"]); ?></td>
          <td><?php echo $con[0]['simbolo'].number_format($reg[$i]["precioventa"]*$reg[$i]["cantidad"], 2, '.', '.'); ?></td>
          <td><?php echo $reg[$i]['existencia']; ?></td>
         </tr>
        <?php } } ?>
    </table>

<?php
break;

case 'KARDEXPRODUCTOS': 

$tra = new Login();
$reg = $tra->BuscarKardexProducto();

$hoy = "MOVIMIENTO_PRODUCTO_".str_replace(" ", "_", $reg[0]["producto"]);

header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>MOVIMIENTOS</th>
           <th>ENTRADAS</th>
           <th>SALIDAS</th>
           <th>DEVOLUCIÓN</th>
           <th>PRECIO MOVIMIENTO</th>
           <th>COSTO MOVIMIENTO</th>
           <th>STOCK ACTUAL</th>
           <th>DOCUMENTO</th>
           <th>FECHA MOVIMIENTO</th>
         </tr>
      <?php
$TotalEntradas=0;
$TotalSalidas=0;
$TotalDevolucion=0;
if($reg==""){
echo "";      
} else {
  
$a=1;
for($i=0;$i<sizeof($reg);$i++){ 
$TotalEntradas+=$reg[$i]['entradas'];
$TotalSalidas+=$reg[$i]['salidas'];
$TotalDevolucion+=$reg[$i]['devolucion'];
?>
         <tr align="center" class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['movimiento']; ?></td>
           <td><?php echo $reg[$i]['entradas']; ?></td>
           <td><?php echo $reg[$i]['salidas']; ?></td>
           <td><?php echo $reg[$i]['devolucion']; ?></td>
           <td><?php echo number_format($reg[$i]['preciom'], 2, '.', ','); ?></td>

<?php if($reg[$i]['movimiento']=="ENTRADAS"){ ?>

<td><?php echo $simbolo.number_format($reg[$i]['preciom']*$reg[$i]['entradas'], 2, '.', ','); ?></td>

<?php } else if($reg[$i]['movimiento']=="SALIDAS"){ ?>

<td><?php echo $simbolo.number_format($reg[$i]['preciom']*$reg[$i]['salidas'], 2, '.', ','); ?></td>

<?php } else if($reg[$i]['movimiento']=="DEVOLUCION"){ ?>

<td><?php echo $simbolo.number_format($reg[$i]['preciom']*$reg[$i]['devolucion'], 2, '.', ','); ?></td>

<?php } ?>
           <td><?php echo $reg[$i]['stockactual']; ?></td>
           <td><?php echo $reg[$i]['documento']; ?></td>
           <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechakardex'])); ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;


case 'INGREDIENTES': 

$hoy = "LISTADO_GENERAL_INGREDIENTES";
header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>N°</th>
           <th>CÓDIGO</th>
           <th>DESCRIPCIÓN DE INGREDIENTE</th>
           <th>EXISTENCIA</th> 
           <th>PRECIO</th>
           <th>STOCK MINIMO</th>

         </tr>
      <?php 
$tra = new Login();
$reg = $tra->ListarIngredientes();

    if($reg==""){

    echo "";      
    
    } else {
 
$a=1;
  
for($i=0;$i<sizeof($reg);$i++){
  
?>
         <tr align="center" nclass="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['codingrediente']; ?></td>
           <td><?php echo $reg[$i]['nomingrediente']; ?></td>
           <td><?php echo $reg[$i]['cantingrediente']." ".$reg[$i]["unidadingrediente"]; ?></td>
           <td><?php echo $con[0]['simbolo'].number_format($reg[$i]['costoingrediente'], 2, '.', ','); ?></td>
           <td><?php echo $reg[$i]["stockminimoingrediente"]; ?></td>
         </tr>
        <?php } } ?>
    </table>

<?php
break;

case 'INGREDIENTESVENDIDOS': 

$hoy = "INGREDIENTES_VENDIDOS_DESDE_".$_GET["desde"]."_HASTA_".$_GET["hasta"];
header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>N°</th>
           <th>CÓDIGO</th>
           <th>DESCRIPCIÓN DE INGREDIENTE</th>
           <th>PRECIO COMPRA</th>
           <th>VENDIDO</th>
           <th>COSTO TOTAL</th>
           <th>EXISTENCIA</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->BuscarIngredientesVendidos();

    if($reg==""){

    echo "";      
    
    } else {
 
$a=1;
  
for($i=0;$i<sizeof($reg);$i++){
  
?>
         <tr align="center" nclass="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['codingrediente']; ?></td>
           <td><?php echo $reg[$i]['nomingrediente']; ?></td>
           <td><?php echo $con[0]['simbolo'].number_format($reg[$i]['costoingrediente'], 2, '.', ','); ?></td>
           <td><?php echo $reg[$i]["cantidades"]; ?></td>
           <td><?php echo $con[0]['simbolo'].number_format($reg[$i]["costoingrediente"]*$reg[$i]["cantidades"], 2, '.', '.'); ?></td>
           <td><?php echo $reg[$i]['cantingrediente']; ?></td>
         </tr>
        <?php } } ?>
    </table>

<?php
break;

case 'KARDEXINGREDIENTES': 

$tra = new Login();
$reg = $tra->BuscarKardexIngrediente();

$hoy = "MOVIMIENTO_INGREDIENTE_".str_replace(" ", "_", $reg[0]["nomingrediente"]);

header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>MOVIMIENTOS</th>
           <th>ENTRADAS</th>
           <th>SALIDAS</th>
           <th>PRECIO MOVIMIENTO</th>
           <th>COSTO MOVIMIENTO</th>
           <th>STOCK ACTUAL</th>
           <th>DOCUMENTO</th>
           <th>FECHA MOVIMIENTO</th>
         </tr>
      <?php
$TotalEntradas=0;
$TotalSalidas=0;
$TotalDevolucion=0;
if($reg==""){
echo "";      
} else {
  
$a=1;
for($i=0;$i<sizeof($reg);$i++){ 
$TotalEntradas+=$reg[$i]['entradasing'];
$TotalSalidas+=$reg[$i]['salidasing'];
?>
         <tr align="center" class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['movimientoing']; ?></td>
           <td><?php echo $reg[$i]['entradasing']; ?></td>
           <td><?php echo $reg[$i]['salidasing']; ?></td>
           <td><?php echo number_format($reg[$i]['preciouniting'], 2, '.', ','); ?></td>

<?php if($reg[$i]['movimientoing']=="ENTRADAS"){ ?>

<td><?php echo $simbolo.number_format($reg[$i]['preciouniting']*$reg[$i]['entradasing'], 2, '.', ','); ?></td>

<?php } else if($reg[$i]['movimientoing']=="SALIDAS"){ ?>

<td><?php echo $simbolo.number_format($reg[$i]['preciouniting']*$reg[$i]['salidasing'], 2, '.', ','); ?></td>

<?php } ?>
           <td><?php echo $reg[$i]['stockactualing']; ?></td>
           <td><?php echo $reg[$i]['documentoing']; ?></td>
           <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechakardexing'])); ?></td>
         </tr>
        <?php } } ?>
</table>
<?php
break;



case 'ARQUEOSXFECHAS': 

$hoy = "ARQUEOS_CAJAS_DESDE_".$_GET["desde"]."_HASTA_".$_GET["hasta"];
header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>N°</th>
           <th>CAJA</th>
           <th>FECHA DE APERTURA</th>
           <th>FECHA DE CIERRE</th>
           <th>ESTIMADO</th>
           <th>REAL</th>
           <th>DIFERENCIA</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->BuscarArqueosCajasFechas();
$a=1;
  
for($i=0;$i<sizeof($reg);$i++){
  
?>
         <tr align="center" class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['nombrecaja']; ?></td>
           <td><?php echo $reg[$i]['fechaapertura']; ?></td>
           <td><?php echo $reg[$i]['fechacierre']; ?></td>
           <td><?php echo $con[0]['simbolo'].number_format($reg[$i]['montoinicial']+$reg[$i]['ingresos']-$reg[$i]['egresos'], 2, '.', ','); ?></td>
           <td><?php echo $con[0]['simbolo'].number_format($reg[$i]["dineroefectivo"], 2, '.', '.'); ?></td>
           <td><?php echo $con[0]['simbolo'].number_format($reg[$i]["diferencia"], 2, '.', '.'); ?></td>
         </tr>
        <?php } ?>
    </table>

<?php
break;

case 'MOVIMIENTOSXFECHAS':

$tra = new Login();
$reg = $tra->BuscarMovimientosCajasFechas(); 

$hoy = "MOVIMIENTOS_DESDE_".$_GET["desde"]."_HASTA_".$_GET["hasta"]."_CAJA_N°_".$reg[0]['nrocaja'];
header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>N°</th>
           <th>FECHA DE MOVIMIENTO</th>
           <th>TIPO</th>
           <th>DESCRIPCIÓN DE MOVIMIENTO</th>
           <th>MONTO</th>
         </tr>
      <?php 
$a=1;
$TotalIngresos=0;
$TotalEgresos=0;
for($i=0;$i<sizeof($reg);$i++){ 
$TotalIngresos+=$ingresos = ( $reg[$i]['tipomovimientocaja'] == 'INGRESO' ? $reg[$i]['montomovimientocaja'] : "0");
$TotalEgresos+=$egresos = ( $reg[$i]['tipomovimientocaja'] == 'EGRESO' ? $reg[$i]['montomovimientocaja'] : "0"); 
?>
         <tr align="center" class="even_row">
      <td><?php echo $a++; ?><</td>
      <td ><?php echo $reg[$i]['fechamovimientocaja']; ?></td>
      <td><?php echo $reg[$i]['tipomovimientocaja']; ?></td>
      <td><?php echo $reg[$i]['descripcionmovimientocaja']; ?></td>
      <td><?php echo $con[0]['simbolo'].number_format($reg[$i]['montomovimientocaja'], 2, '.', ','); ?></td>
         </tr>
        <?php } ?>
         <tr class="even_row">
           <td colspan="3" style="text-align: center">&nbsp;</td>
           <td style="text-align: center"><strong>TOTAL INGRESOS</strong></div></td>
           <td style="text-align: center"><strong><?php echo $con[0]['simbolo'].number_format($TotalIngresos, 2, '.', ','); ?></strong></td>
         </tr>
         <tr class="even_row">
           <td colspan="3" style="text-align: center">&nbsp;</td>
           <td style="text-align: center"><strong>TOTAL EGRESOS</strong></div></td>
           <td style="text-align: center"><strong><?php echo $con[0]['simbolo'].number_format($TotalEgresos, 2, '.', ','); ?></strong></td>
         </tr>
    </table>

<?php
break;

case 'COMPRASPROVEEDOR':

$tra = new Login();
$reg = $tra->BuscarComprasProveedor(); 

$hoy = "COMPRAS_PROVEEDOR_".str_replace(" ", "_", "RUC:".$reg[0]["ritproveedor"].":".$reg[0]["nomproveedor"]);

header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>N°</th>
           <th>Nº DE COMPRA</th>
           <th>STATUS</th>
           <th>FECHA DE COMPRA</th>
           <th>Nº DE ARTICULOS</th>
           <th>SUBTOTAL CON IVA</th>
           <th>SUBTOTAL IVA 0%</th>
           <th>IVA</th>
           <th>TTOTAL IVA</th>
           <th>DESCUENTO</th>
           <th>TOTAL DESC</th>
           <th>TOTAL PAGO</th>
         </tr>
      <?php 
$totalarticulos=0;
$Subtotalconiva=0;
$Subtotalsiniva=0;
$Totaliva=0;
$Totaldescuento=0;
$pagoDescuento=0;
$Pagototal=0;
$a=1;
  
for($i=0;$i<sizeof($reg);$i++){
  
$totalarticulos+=$reg[$i]['articulos'];
$Subtotalconiva+=$reg[$i]['subtotalivasic'];
$Subtotalsiniva+=$reg[$i]['subtotalivanoc'];
$Totaliva+=$reg[$i]['totalivac']; 
$Totaldescuento+=$reg[$i]['totaldescuentoc']; 
$Pagototal+=$reg[$i]['totalc']; 
?>
         <tr align="center" class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['codcompra']; ?></td>
           <td><?php 
if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "<span class='label label-success'>".$reg[$i]["statuscompra"]."</span>"; } 
elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d")) { echo "<span class='label label-success'>".$reg[$i]["statuscompra"]."</span>"; } 
elseif($reg[$i]['fechavencecredito'] < date("Y-m-d")) { echo "<span class='label label-danger'>VENCIDA</span>"; } ?></td>
           <td><?php echo date("d-m-Y h:i:s",strtotime($reg[$i]['fechacompra'])); ?></td>
           <td><?php echo $reg[$i]['articulos']; ?></td>
           <td><?php echo $con[0]['simbolo'].number_format($reg[$i]['subtotalivasic'], 2, '.', ','); ?></td>
           <td><?php echo $con[0]['simbolo'].number_format($reg[$i]['subtotalivanoc'], 2, '.', ','); ?></td>
           <td><?php echo $con[0]['simbolo'].number_format($reg[$i]['ivac'], 2, '.', ','); ?></td>
           <td><?php echo $con[0]['simbolo'].number_format($reg[$i]['totalivac'], 2, '.', ','); ?></td>
           <td><?php echo $con[0]['simbolo'].number_format($reg[$i]['descuentoc'], 2, '.', ','); ?></td>
           <td><?php echo $con[0]['simbolo'].number_format($reg[$i]['totaldescuentoc'], 2, '.', ','); ?></td>
           <td><?php echo $con[0]['simbolo'].number_format($reg[$i]['totalc'], 2, '.', ','); ?></td>
         </tr>
        <?php } ?>
         <tr align="center" class="even_row">
           <td colspan="3">&nbsp;</td>
           <td><strong>TOTAL GENERAL</strong></div></td>
           <td><strong><?php echo $totalarticulos; ?></strong></td>
           <td><strong><?php echo $con[0]['simbolo'].number_format($Subtotalconiva, 2, '.', ','); ?></strong></td>
           <td><strong><?php echo $con[0]['simbolo'].number_format($Subtotalsiniva, 2, '.', ','); ?></strong></td>
           <td></td>
           <td><strong><?php echo $con[0]['simbolo'].number_format($Totaliva, 2, '.', ','); ?></strong></td>
           <td></td>
           <td><strong><?php echo $con[0]['simbolo'].number_format($Totaldescuento, 2, '.', ','); ?></strong></td>
           <td><strong><?php echo $con[0]['simbolo'].number_format($Pagototal, 2, '.', ','); ?></strong></td>
         </tr>
    </table>

<?php
break;

case 'COMPRASFECHAS': 

$hoy = "COMPRAS_FECHAS_".$_GET["desde"]."_HASTA_".$_GET["hasta"];
header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls"); 

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>N°</th>
           <th>Nº DE COMPRA</th>
           <th>PROVEEDORES</th>
           <th>STATUS</th>
           <th>FECHA DE COMPRA</th>
           <th>Nº DE ARTICULOS</th>
           <th>SUBTOTAL CON IVA</th>
           <th>SUBTOTAL IVA 0%</th>
           <th>IVA</th>
           <th>TTOTAL IVA</th>
           <th>DESCUENTO</th>
           <th>TOTAL DESC</th>
           <th>TOTAL PAGO</th>
         </tr>
      <?php 
$totalarticulos=0;
$Subtotalconiva=0;
$Subtotalsiniva=0;
$Totaliva=0;
$Totaldescuento=0;
$pagoDescuento=0;
$Pagototal=0;
$a=1;
$tra = new Login();
$reg = $tra->BuscarComprasFechas();
  
for($i=0;$i<sizeof($reg);$i++){
  
$totalarticulos+=$reg[$i]['articulos'];
$Subtotalconiva+=$reg[$i]['subtotalivasic'];
$Subtotalsiniva+=$reg[$i]['subtotalivanoc'];
$Totaliva+=$reg[$i]['totalivac']; 
$Totaldescuento+=$reg[$i]['totaldescuentoc']; 
$Pagototal+=$reg[$i]['totalc']; 
?>
         <tr align="center" class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['codcompra']; ?></td>
           <td><?php echo $reg[$i]["ritproveedor"].": ".$reg[$i]['nomproveedor']; ?></td>
           <td><?php 
if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "<span class='label label-success'>".$reg[$i]["statuscompra"]."</span>"; } 
elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d")) { echo "<span class='label label-success'>".$reg[$i]["statuscompra"]."</span>"; } 
elseif($reg[$i]['fechavencecredito'] < date("Y-m-d")) { echo "<span class='label label-danger'>VENCIDA</span>"; } ?></td>
           <td><?php echo date("d-m-Y h:i:s",strtotime($reg[$i]['fechacompra'])); ?></span></td>
           <td><?php echo $reg[$i]['articulos']; ?></td>
           <td><?php echo $con[0]['simbolo'].number_format($reg[$i]['subtotalivasic'], 2, '.', ','); ?></td>
           <td><?php echo $con[0]['simbolo'].number_format($reg[$i]['subtotalivanoc'], 2, '.', ','); ?></td>
           <td><?php echo $con[0]['simbolo'].number_format($reg[$i]['ivac'], 2, '.', ','); ?></td>
           <td><?php echo $con[0]['simbolo'].number_format($reg[$i]['totalivac'], 2, '.', ','); ?></td>
           <td><?php echo $con[0]['simbolo'].number_format($reg[$i]['descuentoc'], 2, '.', ','); ?></td>
           <td><?php echo $con[0]['simbolo'].number_format($reg[$i]['totaldescuentoc'], 2, '.', ','); ?></td>
           <td><?php echo $con[0]['simbolo'].number_format($reg[$i]['totalc'], 2, '.', ','); ?></td>
         </tr>
        <?php } ?>
         <tr align="center" class="even_row">
           <td colspan="4">&nbsp;</td>
           <td><strong>TOTAL GENERAL</strong></div></td>
           <td><strong><?php echo $totalarticulos; ?></strong></td>
           <td><strong><?php echo $con[0]['simbolo'].number_format($Subtotalconiva, 2, '.', ','); ?></strong></td>
           <td><strong><?php echo $con[0]['simbolo'].number_format($Subtotalsiniva, 2, '.', ','); ?></strong></td>
           <td></td>
           <td><strong><?php echo $con[0]['simbolo'].number_format($Totaliva, 2, '.', ','); ?></strong></td>
           <td></td>
           <td><strong><?php echo $con[0]['simbolo'].number_format($Totaldescuento, 2, '.', ','); ?></strong></td>
           <td><strong><?php echo $con[0]['simbolo'].number_format($Pagototal, 2, '.', ','); ?></strong></td>
         </tr>
    </table>
    </td>
  </tr>
</table>

<?php
break;

case 'COMPRASXPAGAR': 

$tra = new Login();
$reg = $tra->ListarComprasPend();

$hoy = "COMPRAS_PENDIENTES";

header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>Nº DE COMPRA</th>
           <th>PROVEEDOR</th>
           <th>DIAS VENCIDOS</th>
           <th>STATUS COMPRA</th>
           <th>FECHA COMPRA</th>
           <th>ARTICULOS</th>
           <th>SUBTOTAL CON IVA</th>
           <th>SUBTOTAL IVA 0%</th>
           <th>IVA</th>
           <th>TOTAL IVA</th>
           <th>DESCUENTO</th>
           <th>TOTAL DESC</th>
           <th>TOTAL PAGO</th>
         </tr>
      <?php 
$totalarticulos=0;
$Subtotalconiva=0;
$Subtotalsiniva=0;
$Totaliva=0;
$Totaldescuento=0;
$pagoDescuento=0;
$Pagototal=0;

if($reg==""){
echo "";      
} else {
  
$a=1; 
  
for($i=0;$i<sizeof($reg);$i++){
  
$totalarticulos+=$reg[$i]['articulos'];
$Subtotalconiva+=$reg[$i]['subtotalivasic'];
$Subtotalsiniva+=$reg[$i]['subtotalivanoc'];
$Totaliva+=$reg[$i]['totalivac']; 
$Totaldescuento+=$reg[$i]['totaldescuentoc']; 
$Pagototal+=$reg[$i]['totalc']; 
?>
         <tr align="center" class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['codcompra']; ?></td>
           <td><?php echo $reg[$i]['nomproveedor']; ?></td>
           <td><?php 
if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "0"; } 
elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d")) { echo "0"; } 
elseif($reg[$i]['fechavencecredito'] < date("Y-m-d")) { echo Dias_Transcurridos(date("Y-m-d"),$reg[$i]['fechavencecredito']); } ?></td>
           <td><?php 
if($reg[$i]['fechavencecredito']== '0000-00-00') { echo "<span class='label label-success'>".$reg[$i]["statuscompra"]."</span>"; } 
elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d")) { echo "<span class='label label-success'>".$reg[$i]["statuscompra"]."</span>"; } 
elseif($reg[$i]['fechavencecredito'] < date("Y-m-d")) { echo "<span class='label label-danger'>VENCIDA</span>"; } ?></td>
           <td><?php echo date("d-m-Y h:i:s",strtotime($reg[$i]['fechacompra'])); ?></td>
           <td><?php echo $reg[$i]['articulos']; ?></td>
           <td><?php echo number_format($reg[$i]['subtotalivasic'], 2, '.', ','); ?></td>
           <td><?php echo number_format($reg[$i]['subtotalivanoc'], 2, '.', ','); ?></td>
           <td><?php echo number_format($reg[$i]['ivac'], 2, '.', ','); ?></td>
           <td><?php echo number_format($reg[$i]['totalivac'], 2, '.', ','); ?></td>
           <td><?php echo number_format($reg[$i]['descuentoc'], 2, '.', ','); ?></td>
           <td><?php echo number_format($reg[$i]['totaldescuentoc'], 2, '.', ','); ?></td>
           <td><?php echo number_format($reg[$i]['totalc'], 2, '.', ','); ?></td>
         </tr>
        <?php } } ?>
         <tr align="center" class="even_row">
           <td colspan="5">&nbsp;</td>
           <td><strong>TOTAL GENERAL</strong></div></td>
           <td><strong><?php echo $totalarticulos; ?></strong></td>
           <td><strong><?php echo number_format($Subtotalconiva, 2, '.', ','); ?></strong></td>
           <td><strong><?php echo number_format($Subtotalsiniva, 2, '.', ','); ?></strong></td>
           <td></td>
           <td><strong><?php echo number_format($Totaliva, 2, '.', ','); ?></strong></td>
           <td></td>
           <td><strong><?php echo number_format($Totaldescuento, 2, '.', ','); ?></strong></td>
           <td><strong><?php echo number_format($Pagototal, 2, '.', ','); ?></strong></td>
         </tr>
</table>

<?php
break;

case 'VENTASCAJAS': 

$ca = new Login();
$ca = $ca->CajerosPorId();

$hoy = "VENTAS_DESDE_".$_GET["desde"]."_HASTA_".$_GET["hasta"]."_CAJA_N°_".$ca[0]['nrocaja'];
header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls"); 

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>N°</th>
           <th>Nº DE VENTA</th>
           <th>CLIENTES</th>
           <th>STATUS DE VENTA</th>
           <th>FECHA DE VENTA</th>
           <th>Nº DE ARTICULOS</th>
           <th>SUBTOTAL CON IVA</th>
           <th>SUBTOTAL IVA 0%</th>
           <th>IVA</th>
           <th>TOTAL IVA</th>
           <th>DESCUENTO</th>
           <th>TOTAL DESC</th>
           <th>TOTAL PAGO</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->BuscarVentasCajas();
$totalarticulos=0;
$Subtotalconiva=0;
$Subtotalsiniva=0;
$Totaliva=0;
$Totaldescuento=0;
$pagoDescuento=0;
$Pagototal=0;
$a=1;
  
for($i=0;$i<sizeof($reg);$i++){
  
$totalarticulos+=$reg[$i]['articulos'];
$Subtotalconiva+=$reg[$i]['subtotalivasive'];
$Subtotalsiniva+=$reg[$i]['subtotalivanove'];
$Totaliva+=$reg[$i]['totalivave']; 
$Totaldescuento+=$reg[$i]['totaldescuentove']; 
$Pagototal+=$reg[$i]['totalpago']; 
?>
         <tr align="center" class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['codventa']; ?></td>
           <td><?php echo $cliente = ( $reg[$i]['codcliente'] == '0' ? "SIN ASIGNACIÓN" : $reg[$i]["nomcliente"]); ?></td>
           <td><?php 
if($reg[$i]['fechavencecredito']== '0000-00-00') { echo $reg[$i]["statusventa"]; } 
elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d")) { echo $reg[$i]["statusventa"]; } 
elseif($reg[$i]['fechavencecredito'] < date("Y-m-d")) { echo "VENCIDA"; } ?></td>
           <td><?php echo $reg[$i]['fechaventa']; ?></td>
           <td><?php echo $reg[$i]['articulos']; ?></td>
           <td><?php echo $con[0]['simbolo'].number_format($reg[$i]['subtotalivasive'], 2, '.', ','); ?></td>
           <td><?php echo $con[0]['simbolo'].number_format($reg[$i]['subtotalivanove'], 2, '.', ','); ?></td>
           <td><?php echo $con[0]['simbolo'].number_format($reg[$i]['ivave'], 2, '.', '.'); ?></td>
           <td><?php echo $con[0]['simbolo'].number_format($reg[$i]['totalivave'], 2, '.', ','); ?></td>
           <td><?php echo $con[0]['simbolo'].number_format($reg[$i]['descuentove'], 2, '.', ','); ?></td>
           <td><?php echo $con[0]['simbolo'].number_format($reg[$i]['totaldescuentove'], 2, '.', ','); ?></td>
           <td><?php echo $con[0]['simbolo'].number_format($reg[$i]['totalpago'], 2, '.', ','); ?></td>
         </tr>
        <?php } ?>
         <tr align="center" class="even_row">
           <td colspan="4">&nbsp;</td>
           <td><strong>TOTAL GENERAL</strong></div></td>
           <td><strong><?php echo $totalarticulos; ?></strong></td>
      <td><strong><?php echo $con[0]['simbolo'].number_format($Subtotalconiva, 2, '.', ','); ?></strong></td>
      <td><strong><?php echo $con[0]['simbolo'].number_format($Subtotalsiniva, 2, '.', ','); ?></strong></td>
           <td></td>
      <td><strong><?php echo $con[0]['simbolo'].number_format($Totaliva, 2, '.', ','); ?></strong></td>
           <td></td>
      <td><strong><?php echo $con[0]['simbolo'].number_format($Totaldescuento, 2, '.', ','); ?></strong></td>
           <td><strong><?php echo $con[0]['simbolo'].number_format($Pagototal, 2, '.', ','); ?></strong></td>
         </tr>
    </table>
    </td>
  </tr>
</table>

<?php
break;

case 'VENTASFECHAS': 

$hoy = "VENTAS_DESDE_".$_GET["desde"]."_HASTA_".$_GET["hasta"];
header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls"); 

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>N°</th>
           <th>Nº DE VENTA</th>
           <th>Nº DE CAJA</th>
           <th>STATUS DE VENTA</th>
           <th>FECHA DE VENTA</th>
           <th>Nº DE ARTICULOS</th>
           <th>SUBTOTAL CON IVA</th>
           <th>SUBTOTAL IVA 0%</th>
           <th>IVA</th>
           <th>TOTAL IVA</th>
           <th>DESCUENTO</th>
           <th>TOTAL DESC</th>
           <th>TOTAL PAGO</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->BuscarVentasFechas();
$totalarticulos=0;
$Subtotalconiva=0;
$Subtotalsiniva=0;
$Totaliva=0;
$Totaldescuento=0;
$pagoDescuento=0;
$Pagototal=0;
$a=1;
  
for($i=0;$i<sizeof($reg);$i++){
  
$totalarticulos+=$reg[$i]['articulos'];
$Subtotalconiva+=$reg[$i]['subtotalivasive'];
$Subtotalsiniva+=$reg[$i]['subtotalivanove'];
$Totaliva+=$reg[$i]['totalivave']; 
$Totaldescuento+=$reg[$i]['totaldescuentove']; 
$Pagototal+=$reg[$i]['totalpago']; 
?>
         <tr align="center" class="even_row">
           <td><?php echo $a++; ?></td>
           <td><?php echo $reg[$i]['codventa']; ?></td>
           <td><?php echo $caja = ( $reg[$i]['codcaja'] == '0' ? "SIN COBRAR" : $reg[$i]["nrocaja"]); ?></td>
           <td><?php 
if($reg[$i]['fechavencecredito']== '0000-00-00') { echo $reg[$i]["statusventa"]; } 
elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d")) { echo $reg[$i]["statusventa"]; } 
elseif($reg[$i]['fechavencecredito'] < date("Y-m-d")) { echo "VENCIDA"; } ?></span></td>
           <td><?php echo $reg[$i]['fechaventa']; ?></td>
           <td><?php echo $reg[$i]['articulos']; ?></td>
           <td><?php echo $con[0]['simbolo'].number_format($reg[$i]['subtotalivasive'], 2, '.', ','); ?></td>
           <td><?php echo $con[0]['simbolo'].number_format($reg[$i]['subtotalivanove'], 2, '.', ','); ?></td>
           <td><?php echo $con[0]['simbolo'].number_format($reg[$i]['ivave'], 2, '.', '.'); ?></td>
           <td><?php echo $con[0]['simbolo'].number_format($reg[$i]['totalivave'], 2, '.', ','); ?></td>
           <td><?php echo $con[0]['simbolo'].number_format($reg[$i]['descuentove'], 2, '.', ','); ?></td>
           <td><?php echo $con[0]['simbolo'].number_format($reg[$i]['totaldescuentove'], 2, '.', ','); ?></td>
           <td><?php echo $con[0]['simbolo'].number_format($reg[$i]['totalpago'], 2, '.', ','); ?></td>
         </tr>
        <?php } ?>
         <tr align="center" class="even_row">
           <td colspan="4">&nbsp;</td>
           <td><strong>TOTAL GENERAL</strong></div></td>
           <td><strong><?php echo $totalarticulos; ?></strong></td>
    <td><strong><?php echo $con[0]['simbolo'].number_format($Subtotalconiva, 2, '.', ','); ?></strong></td>
    <td><strong><?php echo $con[0]['simbolo'].number_format($Subtotalsiniva, 2, '.', ','); ?></strong></td>
    <td></td>
    <td><strong><?php echo $con[0]['simbolo'].number_format($Totaliva, 2, '.', ','); ?></strong></td>
    <td></td>
    <td><strong><?php echo $con[0]['simbolo'].number_format($Totaldescuento, 2, '.', ','); ?></strong></td>
    <td><strong><?php echo $con[0]['simbolo'].number_format($Pagototal, 2, '.', ','); ?></strong></td>
         </tr>
    </table>

<?php
break;

case 'DELIVERY': 

$tra = new Login();
$reg = $tra->ListarDelivery();

$hoy = "LISTADO_DELIVERY_REPARTIDOR_".str_replace(" ", "_", $reg[0]["nombres"]);
header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls");

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
         <tr>
           <th>Nº</th>
           <th>NOMBRES DE CLIENTES</th>
           <th>DIRECCIÓN DE CLIENTES</th>
           <th>PLATILLOS</th>
<?php if($_SESSION["acceso"] != 'repartidor') { ?><th>REPARTIDOR</th><?php } ?>
           <th>TOTAL FACTURA</th>
         </tr>
      <?php 

if($reg==""){
echo "";      
} else {
  
$a=1; 
$TotalFactura=0;
for($i=0;$i<sizeof($reg);$i++){ 
$TotalFactura+=$reg[$i]["totalpago"];
?>
         <tr align="center" class="even_row">
        <td><?php echo $a++; ?></td>
        <td><?php echo $cliente = ( $reg[$i]['cliente'] == '0' ? "<span class='label label-warning'> SIN ASIGNAR</span>" : $reg[$i]['nomcliente']); ?></td>
        <td><?php echo $reg[$i]['direccliente']; ?></td>
        <td><?php echo $reg[$i]['detalles']; ?></td>
<?php if($_SESSION["acceso"] != 'repartidor') { ?><td><?php echo $reg[$i]['repartidor']; ?></td><?php } ?>
           <td><?php echo $con[0]['simbolo'].number_format($reg[$i]["totalpago"], 2, '.', ','); ?></td>
         </tr>
        <?php } } ?>
      <tr align="center" class="even_row">
<?php if($_SESSION["acceso"] != 'repartidor') { ?><td colspan="4">&nbsp;</td><?php } else { ?><td colspan="3">&nbsp;</td><?php } ?>
      <td><strong>TOTAL GENERAL</strong></td>
      <td><strong><?php echo $con[0]['simbolo'].number_format($TotalFactura, 2, '.', '.'); ?></strong></td>
                            </tr>
</table>
<?php
break;

case 'CREDITOSCLIENTES': 

$hoy = "CREDITOS_CLIENTES";
header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls");

$bon = new Login();
$bon = $bon->BuscarClientesAbonos(); 

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
        <tr>
         <th colspan="10">Datos del Cliente: <?php echo "<strong><font color='red'>".$bon[0]['cedcliente']." - ".$bon[0]['nomcliente']."</font color></strong>"; ?></th>
        </tr>
        <tr>
          <th>Nº</th>
          <th>Nº DE CAJA</th>
          <th>Nº DE VENTA</th>
          <th>STATUS DE CRÉDITO</th>
          <th>DIAS VENCIDOS</th>
          <th>FECHA DE VENTA</th>
          <th>TOTAL VENTA</th>
          <th>TOTAL ABONO</th>
          <th>TOTAL DEBE</th>
        </tr>
      <?php 
$a=1;
$TotalFactura=0;
$TotalCredito=0;
$TotalDebe=0;
for($i=0;$i<sizeof($bon);$i++){  
$TotalFactura+=$bon[$i]['totalpago'];
$TotalCredito+=$bon[$i]['abonototal'];
$TotalDebe+=$bon[$i]['totalpago']-$bon[$i]['abonototal'];
?>
        <tr align="center" class="even_row">
                           <td><?php echo $a++; ?></td>
                           <td><?php echo $bon[$i]['nrocaja']; ?></td>
                           <td><?php echo $bon[$i]['codventa']; ?></td>
                          <td><?php 
if($bon[$i]['fechavencecredito']== '0000-00-00') { echo "<span class='label label-success'>".$bon[$i]["statusventa"]."</span>"; } 
elseif($bon[$i]['fechavencecredito'] >= date("Y-m-d")) { echo "<span class='label label-success'>".$bon[$i]["statusventa"]."</span>"; } 
elseif($bon[$i]['fechavencecredito'] < date("Y-m-d")) { echo "<span class='label label-danger'>VENCIDA</span>"; } ?></td>
                          <td><?php 
if($bon[$i]['fechavencecredito']== '0000-00-00') { echo "0"; } 
elseif($bon[$i]['fechavencecredito'] >= date("Y-m-d")) { echo "0"; } 
elseif($bon[$i]['fechavencecredito'] < date("Y-m-d")) { echo Dias_Transcurridos(date("Y-m-d"),$bon[$i]['fechavencecredito']); } ?></span></td>
                           <td><?php echo $bon[$i]['fechaventa']; ?></td>
<td><?php echo $con[0]['simbolo'].number_format($bon[$i]['totalpago'], 2, '.', '.'); ?></td>
<td><?php echo $con[0]['simbolo'].number_format($bon[$i]['abonototal'], 2, '.', '.'); ?></td>
<td><?php echo $con[0]['simbolo'].number_format($bon[$i]['totalpago']-$bon[$i]['abonototal'], 2, '.', '.'); ?></td>
                              </tr>
        <?php } ?>
      <tr align="center" class="even_row">
      <td colspan="5">&nbsp;</td>
      <td><strong>TOTAL GENERAL</strong></td>
      <td><strong><?php echo $con[0]['simbolo'].number_format($TotalFactura, 2, '.', '.'); ?></strong></td>
      <td><strong><?php echo $con[0]['simbolo'].number_format($TotalCredito, 2, '.', '.'); ?></strong></td>
      <td><strong><?php echo $con[0]['simbolo'].number_format($TotalDebe, 2, '.', '.'); ?></strong></td>
                            </tr>
    </table>

<?php
break;

case 'CREDITOSFECHAS': 

$hoy = "CREDITOS_FECHAS_".$_GET["desde"]."_HASTA_".$_GET["hasta"];
header("Content-Type: application/vnd.ms-excel"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("content-disposition: attachment;filename=".$hoy.".xls");

$bon = new Login();
$bon = $bon->BuscarCreditosFechas(); 

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
        <tr>
<th colspan="11">Creditos por Fechas Desde <?php echo "<strong><font color='red'>".$_GET["desde"]." hasta ".$_GET["hasta"]."</font color></strong>"; ?></th>
        </tr>
        <tr>
          <th>Nº</th>
          <th>Nit DE CLIENTE</th>
          <th>NOMBRE DE CLIENTE</th>
          <th>Nº DE CAJA</th>
          <th>Nº DE VENTA</th>
          <th>STATUS DE CRÉDITO</th>
          <th>DIAS VENCIDOS</th>
          <th>FECHA DE VENTA</th>
          <th>TOTAL VENTA</th>
          <th>TOTAL ABONO</th>
          <th>TOTAL DEBE</th>
           </tr>
      <?php 
$a=1;
$TotalFactura=0;
$TotalCredito=0;
$TotalDebe=0;
for($i=0;$i<sizeof($bon);$i++){  
$TotalFactura+=$bon[$i]['totalpago'];
$TotalCredito+=$bon[$i]['abonototal'];
$TotalDebe+=$bon[$i]['totalpago']-$bon[$i]['abonototal'];
?>
        <tr align="center" class="even_row">
                          <td><?php echo $a++; ?></td>
<td><?php if($bon[$i]['cedcliente']== '') { echo "SIN ASIGNAR"; } else { echo $bon[$i]['cedcliente']; } ?></td>
<td><?php if($bon[$i]['nomcliente']== '') { echo "SIN ASIGNAR"; } else { echo $bon[$i]['nomcliente']; } ?></td>
                          <td><?php echo $bon[$i]['nrocaja']; ?></td>
                          <td><?php echo $bon[$i]['codventa']; ?></td>
                          <td><?php 
if($bon[$i]['fechavencecredito']== '0000-00-00') { echo "<span class='label label-success'>".$bon[$i]["statusventa"]."</span>"; } 
elseif($bon[$i]['fechavencecredito'] >= date("Y-m-d")) { echo "<span class='label label-success'>".$bon[$i]["statusventa"]."</span>"; } 
elseif($bon[$i]['fechavencecredito'] < date("Y-m-d")) { echo "<span class='label label-danger'>VENCIDA</span>"; } ?></td>
                          <td><?php 
if($bon[$i]['fechavencecredito']== '0000-00-00') { echo "0"; } 
elseif($bon[$i]['fechavencecredito'] >= date("Y-m-d")) { echo "0"; } 
elseif($bon[$i]['fechavencecredito'] < date("Y-m-d")) { echo Dias_Transcurridos(date("Y-m-d"),$bon[$i]['fechavencecredito']); } ?></td>
                           <td><?php echo $bon[$i]['fechaventa']; ?></td>
<td><?php echo $con[0]['simbolo'].number_format($bon[$i]['totalpago'], 2, '.', ','); ?></td>
<td><?php echo $con[0]['simbolo'].number_format($bon[$i]['abonototal'], 2, '.', ','); ?></td>
<td><?php echo $con[0]['simbolo'].number_format($bon[$i]['totalpago']-$bon[$i]['abonototal'], 2, '.', ','); ?></td>
                              </tr>
        <?php } ?>
        <tr align="center" class="even_row">
          <td colspan="7">&nbsp;</td>
          <td><strong>TOTAL GENERAL</strong></td>
          <td><strong><?php echo $con[0]['simbolo'].number_format($TotalFactura, 2, '.', ','); ?></strong></td>
          <td><strong><?php echo $con[0]['simbolo'].number_format($TotalCredito, 2, '.', ','); ?></strong></td>
          <td><strong><?php echo $con[0]['simbolo'].number_format($TotalDebe, 2, '.', ','); ?></strong></td>
                            </tr>
    </table>

<?php
break;
}
 
?>


<?php } else { ?>   
        <script type='text/javascript' language='javascript'>
        alert('NO TIENES PERMISO PARA ACCEDER A ESTA PAGINA.\nCONSULTA CON EL ADMINISTRADOR PARA QUE TE DE ACCESO')  
        document.location.href='panel'   
        </script> 
<?php } } else { ?>
        <script type='text/javascript' language='javascript'>
        alert('NO TIENES PERMISO PARA ACCEDER AL SISTEMA.\nDEBERA DE INICIAR SESION')  
        document.location.href='logout'  
        </script> 
<?php } ?> 