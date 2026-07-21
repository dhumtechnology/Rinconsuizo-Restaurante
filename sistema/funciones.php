<?php
require_once("class/class.php");

// Endpoints AJAX limpios (sin scripts) — deben ir primero
if (isset($_GET['MesasPanel'])) {
	$cajaMesas = new Login();
	$cajaMesas->VerificaArqueo();
	exit;
}
if (isset($_GET['MesasPanelCocinero'])) {
	echo renderMesasPanelCocinero('padding:12px;margin:11px;float:left;width:90px;');
	exit;
}

if (isset($_POST['accion']) && $_POST['accion'] === 'JuntarMesas') {
    $union = new Login();
    $union->JuntarMesas();
}
if (isset($_POST['accion']) && $_POST['accion'] === 'SepararMesasUnion') {
    $union = new Login();
    $union->SepararMesasUnion();
}
?>
<script type="text/javascript" src="assets/script/script2.js"></script>
<script type="text/javascript" src="assets/script/jscompras.js"></script>
<script type="text/javascript" src="assets/script/jsventas.js"></script>
<script src="assets/script/jscalendario.js"></script>
<script src="assets/script/autocompleto.js"></script> 
<!-- Calendario -->

<?php
$con = new Login();
$con = $con->ConfiguracionPorId(); 
$simbolo = $con[0]['simbolo'];

$tra = new Login();
?>

<?php
############################# BUSQUEDA DE USUARIOS Y MOSTRAR EN VENTANA MODAL ######################
if (isset($_GET['BuscaUsuarioModal']) && isset($_GET['codigo'])) { 

$reg = $tra->UsuariosPorId();
  ?>
  <div class="row">
  <table border="0" align="center" >
  <tr>
    <td><strong>C&eacute;dula:</strong> <?php echo $reg[0]['cedula']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombres:</strong> <?php echo $reg[0]['nombres']; ?></td>
  </tr>
  <tr>
    <td><strong>N&deg; de Tel&eacute;fono:</strong> <?php echo $reg[0]['nrotelefono']; ?></td>
  </tr>
  <tr>
    <td><strong>Cargo: </strong> <?php echo $reg[0]['cargo']; ?></td>
  </tr>
  <tr>
    <td><strong>Correo Electr&oacute;nico: </strong> <?php echo $reg[0]['email']; ?></td>
  </tr>
  <tr>
    <td><strong>Usuario: </strong> <?php echo $reg[0]['usuario']; ?></td>
  </tr>
  <tr>
    <td><strong>Nivel: </strong> <?php echo $reg[0]['nivel']; ?></td>
  </tr>
  <tr>
    <td><strong>Status: </strong> <?php echo $status = ( $reg[0]['status'] == 'ACTIVO' ? "<span class='label label-success'><i class='fa fa-check'></i> ".$reg[0]['status']."</span>" : "<span class='label label-warning'><i class='fa fa-times'></i> ".$reg[0]['status']."</span>"); ?></td>
  </tr>
</table>
</div>
  <?php
   } 
################### FIN DE BUSQUEDA DE USUARIOS Y MOSTRAR EN VENTANA MODAL #####################
?>


<?php
####################### BUSQUEDA DE SALAS Y MOSTRAR EN VENTANA MODAL ##########################
if (isset($_GET['BuscaSalasModal']) && isset($_GET['codsala'])) { 

$reg = $tra->SalasPorId();

  ?>
  
  <div class="row">
  <table border="0" align="center" >
  <tr>
    <td><strong>C&oacute;digo de Sala:</strong> <?php echo $reg[0]['codsala']; ?></td>
  </tr> 
  <tr>
    <td><strong>Nombre de Sala:</strong> <?php echo $reg[0]['nombresala']; ?></td>
  </tr>  
  <tr>
    <td><strong>Fecha Creada:</strong> <?php echo date("d-m-Y h:i:s",strtotime($reg[0]['salacreada'])); ?></td>
  </tr>
</table>
</div><br />

 <div id="div"><div class="table-responsive" data-pattern="priority-columns">
        <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
          <thead>
            <tr>
              <th>N&deg;</th>
              <th>Nombre de Mesa</th>
              <th>Fecha Creada</th>
              <th>Status Mesa</th>
            </tr>
          </thead>
          <tbody>
 <?php
$mesa = new Login();
$mesa = $mesa->ListasMesasSalas(); 
$a=1;
for($i=0;$i<sizeof($mesa);$i++){
?>
                             <tr>
              <td><?php echo $a++; ?></td>
              <td><?php echo $mesa[$i]["nombremesa"]; ?></td>
<td><?php echo $creada = ( $mesa[$i]['mesacreada'] == '' ? "" : date("d-m-Y h:i:s",strtotime($mesa[$i]['mesacreada']))); ?></td>
<td><?php echo $status = ( $mesa[$i]['statusmesa'] == '0' ? "<span class='label label-success'> DISPONIBLE</span>" : "<span class='label label-warning'> ASIGNADA</span>"); ?></td>  </tr>
                              <?php } ?>
        </tbody>
</table></div></div>
  
  <?php
   } 
###################### FIN DE BUSQUEDA DE SALAS Y MOSTRAR EN VENTANA MODAL #########################
?>





<?php
####################### BUSQUEDA DE MESAS EN SALAS Y MOSTRAR EN VENTANA MODAL ######################
if (isset($_GET['BuscaMesasModal']) && isset($_GET['codmesa'])) { 

$reg = $tra->MesasPorId();

  ?>
  
  <div class="row">
  <table border="0" align="center" >
  <tr>
    <td><strong>C&oacute;digo de Mesa:</strong> <?php echo $reg[0]['codmesa']; ?></td>
  </tr> 
  <tr>
    <td><strong>Nombre de Sala:</strong> <?php echo $reg[0]['nombresala']; ?></td>
  </tr> 
  <tr>
    <td><strong>Nombre de Mesa:</strong> <?php echo $reg[0]['nombremesa']; ?></td>
  </tr>  
  <tr>
    <td><strong>Status de Mesa:</strong> <?php echo $status = ( $reg[0]['statusmesa'] == '0' ? "<span class='label label-success'><i class='fa fa-check'></i> DISPONIBLE</span>" : "<span class='label label-warning'><i class='fa fa-times'></i> RESERVADA</span>"); ?></td>
  </tr> 
  <tr>
    <td><strong>Fecha Creada:</strong> <?php echo date("d-m-Y h:i:s",strtotime($reg[0]['mesacreada'])); ?></td>
  </tr>
</table>
</div>
  <?php
   } 
################# FIN DE BUSQUEDA DE MESAS EN SALAS Y MOSTRAR EN VENTANA MODAL ##################
?>





<?php
############################# BUSQUEDA DE CLIENTES ############################
if (isset($_GET['BusquedaClientes']) && isset($_GET['buscacliente'])) { 

  $busqueda = $_GET['buscacliente'];
  
  ?>
  
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-tasks"></i> Control de Clientes </h3></div>
<div class="panel-body">
      
<div class="row">
       <div class="col-sm-12 col-xs-12"> 
                            <div class="box-body">
                                <div class="row"> 
                                <div class="col-md-12"> 
                               
<div id="div1"><div class="table-responsive" data-pattern="priority-columns">
                  <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                                 <thead>
                         <tr role="row">
                          <th>N&deg;</th>
                          <th>Nit</th>
                          <th>Nombres</th>
                          <th>Correo</th>
                          <th>N&deg; de Tel&eacute;fono</th>
                         <th>Acciones</th>
                         </tr>
                         </thead>
                         <tbody>
<?php 
$ci = new Login();
$reg = $ci->BusquedaClientes();

if($reg==""){

    echo "";      
    
} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                         <tr role="row" class="odd">
                         <td class="sorting_1" tabindex="0"><?php echo $a++; ?></td>
                         <td><?php echo $reg[$i]['cedcliente']; ?></td>
                         <td><?php echo $reg[$i]['nomcliente']; ?></td>
                         <td><?php echo $reg[$i]['tlfcliente']; ?></td>
                         <td><?php echo $correo = ( $reg[$i]['emailcliente'] == '' ? "NINGUNO" : $reg[$i]['emailcliente']); ?></td>
                         <td>
 
 <a class="btn btn-success btn-xs" data-placement="left" title="Ver" data-original-title="" data-href="#" data-toggle="modal" data-target="#panel-modal" data-backdrop="static" data-keyboard="false" onClick="VerCliente('<?php echo base64_encode($reg[$i]["codcliente"]); ?>')"><i class="fa fa-search-plus"></i></a>

<a class="btn btn-primary btn-xs" title="Editar" data-toggle="modal" data-target="#myModal2" data-backdrop="static" data-keyboard="false" onClick="CargaCampos('<?php echo $reg[$i]["codcliente"]; ?>','<?php echo $reg[$i]["cedcliente"]; ?>','<?php echo $reg[$i]["nomcliente"]; ?>','<?php echo $reg[$i]["direccliente"]; ?>','<?php echo $reg[$i]["tlfcliente"]; ?>','<?php echo $reg[$i]["emailcliente"]; ?>','<?php echo $busqueda; ?>')"><i class="fa fa-pencil"></i></a>
                                 
<a class="btn btn-danger btn-xs" title="Eliminar" onClick="EliminarCliente('<?php echo base64_encode($reg[$i]["codcliente"]); ?>','<?php echo base64_encode("CLIENTES") ?>','<?php echo $busqueda ?>')"><i class="fa fa-trash-o"></i></a> </td>
                         </tr>
                         <?php } ?>
                         </tbody>
</table></div><br />                 
                                             </div>
                                         </div>
                                     </div>  
                                 </div>
                             </div><!-- /.box-body -->
                         </div>
                    </div>
               </div>
          </div>
  <?php 
   }
 } 
############################# BUSQUEDA DE CLIENTES ############################
?>



<?php
############################# MOSTRAR CLIENTES EN VENTANA MODAL ##########################
if (isset($_GET['BuscaClienteModal']) && isset($_GET['codcliente'])) { 

$reg = $tra->ClientesPorId();

  ?>
  
  <div class="row">
  <table border="0" align="center" >
  <tr>
    <td><strong>Nit de Cliente:</strong> <?php echo $reg[0]['cedcliente']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombre de Cliente:</strong> <?php echo $reg[0]['nomcliente']; ?></td>
  </tr>
  <tr>
    <td><strong>Direcci&oacute;n de Cliente:</strong> <?php echo $reg[0]['direccliente']; ?></td>
  </tr>
  <tr>
    <td><strong>Telefono de Cliente:</strong> <?php echo $reg[0]['tlfcliente']; ?></td>
  </tr>
  <tr>
    <td><strong>Email de Cliente:</strong> <?php echo $reg[0]['emailcliente']; ?></td>
  </tr>
</table>
</div>
  
  <?php
   } 
############################# MOSTRAR CLIENTES EN VENTANA MODAL ##########################
?>




<?php
############################# MOSTRAR PROVEEDORES EN VENTANA MODAL ##########################
if (isset($_GET['BuscaProveedorModal']) && isset($_GET['codproveedor'])) { 

$reg = $tra->ProveedoresPorId();

  ?>
  
  <div class="row">
  <table border="0" align="center" >
  <tr>
    <td><strong>Nit:</strong> <?php echo $reg[0]['ritproveedor']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombre de Proveedor:</strong> <?php echo $reg[0]['nomproveedor']; ?></td>
  </tr>
  <tr>
    <td><strong>Direcci&oacute;n de Proveedor:</strong> <?php echo $reg[0]['direcproveedor']; ?></td>
  </tr>
  <tr>
    <td><strong>Telefono de Proveedor:</strong> <?php echo $reg[0]['tlfproveedor']; ?></td>
  </tr>
  <tr>
    <td><strong>Email de Proveedor:</strong> <?php echo $reg[0]['emailproveedor']; ?></td>
  </tr>
  <tr>
    <td><strong>Persona de Contacto:</strong> <?php echo $reg[0]['contactoproveedor']; ?></td>
  </tr>
</table>
</div>
  
  <?php
   } 
############################# MOSTRAR PROVEEDORES EN VENTANA MODAL ##########################
?>





<?php 
############################# MUESTRA DIV INGREDIENTES #############################################
if (isset($_GET['BuscaDivIngrediente'])) {
  
  ?>

<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-align-justify"></i> Detalle de Campos</h3></div>
<div class="panel-body">

 <div class="row">
       <div class="col-sm-12 col-xs-12"> 
                            <div class="box-body">
                                <div class="row"> 
                                <div class="col-md-12"> 
<font color="red"><strong> Para poder realizar la Carga Masiva de Ingredientes, el archivo Excel, debe estar estructurado de 7 columnas, la cuales tendr&aacute;n las siguientes especificaciones:</strong></font><br><br>

  1. C&oacute;digo de Ingrediente (Campo numerico).<br>
  2. Nombre de Ingrediente.<br>
  3. Stock Actual. (Debe de ser solo numeros enteros).<br>
  4. Precio Compra. (Digitos con 2 decimales).<br>
  5. Unidad de Medida. (Ejem. KG o UNID. o LT).<br>
  6. Proveedor. (Debe de colocar el C&oacute;digo de Proveedor, consultarlos en el M&oacute;dulo de Proveedores).<br>
  7. Stock Minimo. (Debe de ser solo numeros enteros).<br><br>

  <font color="red"><strong> NOTA:</strong></font><br><br>
  a) No debe de tener cabecera, solo deben estar los registros a grabar.<br>
  b) Se debe de guardar como archivo .CSV  (delimitado por comas)(*.csv).<br>
  c) Al existir columnas sin datos para los Ingredientes, dejarlos en blanco o con valor a cero.<br>
  d) Todos los datos deber&aacute;n escribirse en may&uacute;scula para mejor orden y visibilidad en los reportes.<br>
  e) Deben de tener en cuenta que la carga masiva de Ingredientes, deben de ser cargados como se explica, para evitar problemas de datos del Ingrediente dentro del Sistema.<br><br>
                     
                </div>
                               </div>  
                           </div>
                        </div><!-- /.box-body -->
                    </div>
                </div>
            </div>
        </div>

<?php 
  }
############################# MUESTRA DIV INGREDIENTES #############################################
?>


<?php
########################## MOSTRAR INGREDIENTES EN VENTANA MODAL ############################
if (isset($_GET['BuscaIngredienteModal']) && isset($_GET['codingrediente'])) { 

$reg = $tra->IngredientesPorId();

  ?>
  
  <div class="row">
  <table border="0" align="center" >
  <tr>
    <td><strong>C&oacute;digo de Ingrediente:</strong> <?php echo $reg[0]['codingrediente']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombre de Ingrediente:</strong> <?php echo $reg[0]['nomingrediente']; ?></td>
  </tr>
  <tr>
    <td><strong>Costo de Ingrediente:</strong> <?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[0]['costoingrediente'], 2, '.', ','); ?></td>
  </tr>
  <tr>
    <td><strong>Cantidad de Ingrediente:</strong> <?php echo $reg[0]['cantingrediente']." ".$reg[0]['unidadingrediente']; ?></td>
  </tr>
    <tr>
      <td><strong>Proveedor: </strong> <?php echo $reg[0]['nomproveedor']; ?></td>
    </tr>
  <tr>
    <td><strong>Stock Minimo:</strong> <?php echo $reg[0]['stockminimoingrediente']; ?></td>
  </tr>
  <tr>
    <td><strong>Status de Ingrediente:</strong> <?php echo $status = ( $reg[0]['cantingrediente'] != '0' ? "<span class='label label-success'><i class='fa fa-check'></i> DISPONIBLE</span>" : "<span class='label label-warning'><i class='fa fa-times'></i> AGOTADO</span>"); ?></td>
  </tr>
</table>
<hr />
<div id="div1">
    <div class="table-responsive" data-pattern="priority-columns">
              <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                                <thead>
                                                    <tr>
   <th colspan="9" data-priority="1"><center>Movimientos del Ingrediente</center></th>
                                                    </tr>
                                                    <tr>
                              <th data-priority="2">Provedor/Cliente</th>
                              <th data-priority="3">Movimiento</th>
                              <th data-priority="4">Ent.</th>
                              <th data-priority="3">Sal.</th>
                              <th data-priority="2">Precio Costo</th>
                              <th data-priority="3">Costo Movimiento</th>
                              <th data-priority="5">Stock Actual</th>
                                                            <th data-priority="3">Fecha</th>
                                                            </tr>
                            </thead>
                                                        <tbody>
 <?php 
$tru = new Login();
$busq = $tru->VerDetallesKardexIngrediente(); 

if($busq==""){

    echo "";      
    
} else {

for($i=0;$i<sizeof($busq);$i++){
?>
                             <tr>

<td><abbr title="<?php echo $busq[$i]["documentoing"]; ?>"><?php if($busq[$i]["codresponsableing"]=="0" && $busq[$i]["movimientoing"]=="ENTRADAS") { echo "INVENTARIO INICIAL"; } elseif($busq[$i]["codresponsableing"]=="0" && $busq[$i]["movimientoing"]=="SALIDAS") { echo "CONSUMIDOR FINAL"; } elseif($busq[$i]["movimientoing"]=="ENTRADAS"){ echo $busq[$i]["proveedor"]; } elseif($busq[$i]["movimientoing"]=="SALIDAS"){ echo $busq[$i]["clientes"]; } ?></abbr></td>

<td><?php echo $busq[$i]["movimientoing"]; ?></td>
<td><?php echo $busq[$i]["entradasing"]; ?></td>
<td><?php echo $busq[$i]["salidasing"]; ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($busq[$i]['preciouniting'], 2, '.', ','); ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($busq[$i]['costototaling'], 2, '.', ','); ?></td>
<td><?php echo $busq[$i]['stockactualing']; ?></td>
<td><?php echo $busq[$i]["fechakardexing"]; ?></td>
                                                          </tr>
                              <?php } } ?>
                                                        </tbody>
                        </table>
                                        </div> 
                                             </div>
                                                     </div>
  <?php
   } 
########################## MOSTRAR INGREDIENTES EN VENTANA MODAL ############################
?>


<?php
############################# BUSQUEDA KARDEX POR INGREDIENTE ###############################
if (isset($_GET['BuscaKardexIngrediente']) && isset($_GET['codingrediente'])) { 
   
     $codingrediente = $_GET['codingrediente'];

  if($codingrediente=="") {

  echo "<center><div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<span class='fa fa-info-circle'></span> POR FAVOR REALICE LA B&Uacute;SQUEDA DEL INGREDIENTE CORRECTAMENTE</div></center>";
   exit;
   
   } else {

  $tra = new Login();
  $reg = $tra->BuscarKardexIngrediente();    

  ?>
  
 <div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-tasks"></i> Movimientos del Ingrediente <?php echo $reg[0]['nomingrediente']; ?></h3></div>
<div class="panel-body">
      
<div class="row">
       <div class="col-sm-12 col-xs-12"> 
                            <div class="box-body">
                                <div class="row"> 
                                <div class="col-md-12"> 
                               
<div id="div1"><div class="table-responsive" data-pattern="priority-columns">
                  <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                            <thead>
                              <tr role="row">
                                  <th>N&deg;</th>
                                  <th>Movimiento</th>
                                  <th>Entradas</th>
                                  <th>Salidas</th>
                                  <th>Precio Movimiento</th>
                                  <th>Costo Movimiento</th>
                                  <th>Stock Actual</th>
                                  <th>Documento</th>
                                  <th>Fecha</th>
                              </tr>
                                            </thead>
                                            <tbody>
<?php
$TotalEntradas=0;
$TotalSalidas=0;
$TotalDevolucion=0;
$a=1;
for($i=0;$i<sizeof($reg);$i++){ 
$TotalEntradas+=$reg[$i]['entradasing'];
$TotalSalidas+=$reg[$i]['salidasing'];
//$TotalDevolucion+=$reg[$i]['devolucion'];
?>
                              <tr>
                                  <td><?php echo $a++; ?></td>
                                  <td><?php echo $reg[$i]['movimientoing']; ?></td>
                                  <td><?php echo $reg[$i]['entradasing']; ?></td>
                                  <td><?php echo $reg[$i]['salidasing']; ?></td>
<td><?php echo $simbolo.number_format($reg[$i]['preciouniting'], 2, '.', ','); ?></td>
<?php if($reg[$i]['movimientoing']=="ENTRADAS"){ ?>

<td><?php echo $simbolo.number_format($reg[$i]['preciouniting']*$reg[$i]['entradasing'], 2, '.', ','); ?></td>

<?php } else if($reg[$i]['movimientoing']=="SALIDAS"){ ?>

<td><?php echo $simbolo.number_format($reg[$i]['preciouniting']*$reg[$i]['salidasing'], 2, '.', ','); ?></td>

<?php } ?>

                                  <td><?php echo $reg[$i]['stockactualing']; ?></td>
                                  <td><?php echo $reg[$i]['documentoing']; ?></td>
                                  <td><?php echo date("d-m-Y",strtotime($reg[$i]['fechakardexing'])); ?></td>
                              </tr>
                        <?php  }  ?>
                                            </tbody>
                                        </table>
<strong>Detalles de Ingrediente</strong><br>
<strong>C&oacute;digo : <?php echo $reg[0]['codingrediente']; ?></strong><br>
<strong>Producto : <?php echo $reg[0]['nomingrediente']; ?></strong><br>
<strong>Categoria : <?php echo $reg[0]['unidadingrediente']; ?></strong><br>
<strong>Total Entradas : <?php echo $TotalEntradas; ?></strong><br>
<strong>Total Salidas : <?php echo $TotalSalidas; ?></strong><br>
<!--<strong>Total Devoluci&oacute;n : <?php echo $TotalDevolucion; ?></strong><br>-->
<strong>Existencia : <?php echo $reg[0]['cantingrediente']; ?></strong><br>
<strong>Precio Compra : <?php echo $simbolo.$reg[0]['costoingrediente']; ?></strong><br><br>


<div align="center"><a href="reportepdf?codingrediente=<?php echo $codingrediente; ?>&tipo=<?php echo base64_encode("KARDEXINGREDIENTES") ?>" target="_blank" rel="noopener noreferrer"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-pdf-o"></span> Exportar Pdf</button></a>
                          
<a href="reporteexcel?codingrediente=<?php echo $codingrediente; ?>&tipo=<?php echo base64_encode("KARDEXINGREDIENTES") ?>"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-excel-o"></span> Exportar Excel</button> </a>                   
            </div><br />                 
                                             </div>
                                         </div>
                                     </div>  
                                 </div>
                             </div><!-- /.box-body -->
                         </div>
                    </div>
               </div>
          </div>
  <?php
  
   }
 } 
############################# BUSQUEDA KARDEX POR INGREDIENTE ###############################
?>










<?php 
############################# MUESTRA DIV PRODUCTOS #############################################
if (isset($_GET['BuscaDivProducto'])) {
  
  ?>

<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-align-justify"></i> Detalle de Campos</h3></div>
<div class="panel-body">

 <div class="row">
       <div class="col-sm-12 col-xs-12"> 
                            <div class="box-body">
                                <div class="row"> 
                                <div class="col-md-12"> 
<font color="red"><strong> Para poder realizar la Carga Masiva de Productos, el archivo Excel, debe estar estructurado de 13 columnas, la cuales tendr&aacute;n las siguientes especificaciones:</strong></font><br><br>

  1. C&oacute;digo de Producto (Campo numerico).<br>
  2. Nombre de Producto.<br>
  3. Categoria (Debe de colocar el C&oacute;digo de Categoria, consultarlos en el M&oacute;dulo de Categorias).<br>
  4. Precio Compra. (Digitos con 2 decimales).<br>
  5. Precio Venta. (Digitos con 2 decimales).<br>
  6. Stock Actual. (Debe de ser solo numeros enteros).<br>
  7. Stock Minimo. (Debe de ser solo numeros enteros).<br>
  8. IGV de Producto. (Ejem. SI o NO).<br>
  9. Descuento de Producto. (Digitos con 2 decimales).<br>
  10. Proveedor. (Debe de colocar el C&oacute;digo de Proveedor, consultarlos en el M&oacute;dulo de Proveedores).<br>
  11. Codigo de Barra. (En caso de no tener colocar Cero (0)).<br>
  12. Favorito. (Ejem. SI o NO).<br>
  13. Status del Producto. (Ejem. ACTIVO o INACTIVO).<br><br>

  <font color="red"><strong> NOTA:</strong></font><br><br>
  a) No debe de tener cabecera, solo deben estar los registros a grabar.<br>
  b) Se debe de guardar como archivo .CSV  (delimitado por comas)(*.csv).<br>
  c) Al existir columnas sin datos para los Productos, dejarlos en blanco o con valor a cero.<br>
  d) Todos los datos deber&aacute;n escribirse en may&uacute;scula para mejor orden y visibilidad en los reportes.<br>
  e) Deben de tener en cuenta que la carga masiva de Productos, deben de ser cargados como se explica, para evitar problemas de datos del Producto dentro del Sistema.<br><br>
                     
                </div>
                               </div>  
                           </div>
                        </div><!-- /.box-body -->
                    </div>
                </div>
            </div>
        </div>

<?php 
  }
############################# MUESTRA DIV PRODUCTOS #############################################
?>





<?php 
############################# MUESTRA NUMERO DE PRODUCTOS ################################
if (isset($_GET['muestranroproducto'])) {
  
$tra = new Login();
  ?>
<input type="hidden" name="codproceso" id="codproceso" value="<?php echo GenerateRandomString(); ?>">
<?php 
  }
############################# MUESTRA NUMERO DE PRODUCTOS ################################
?>

<?php 
################################ MUESTRA CODIGO DE PRODUCTOS #################################
if (isset($_GET['muestracodigoproducto'])) {
  
$tra = new Login();
  ?>
<input type="text" class="form-control" name="codproducto" id="codproducto" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese C?digo de Producto" <?php if (isset($reg[0]['codproducto'])) { ?> value="<?php echo $reg[0]['codproducto']; ?>" readonly="readonly" <?php } else { ?>  value="<?php echo $reg = $tra->CodigoProducto(); ?>" <?php } ?> required="" aria-required="true">

<?php 
  }
################################ MUESTRA CODIGO DE PRODUCTOS #################################
?>

<?php
########################## MOSTRAR FOTO DE PRODUCTO EN VENTANA MODAL #########################
if (isset($_GET['BuscaFotoProductoModal']) && isset($_GET['codproducto'])) { 

$codproducto = $_GET['codproducto'];

$reg = $tra->DetalleProductosPorId();
?>
<div class="row">
  <table border="0" align="center">
    <tr>
      <td><strong>Foto del Producto</strong><div align="center"><?php
  if (isset($pregro[0]['codproducto'])) {
  if (file_exists("fotos/".$reg[0]['codproducto'].".jpg")){
    echo "<img src='fotos/".$reg[0]['codproducto'].".jpg?".date('h:i:s')."' border='0' width='100' height='120' title='".$reg[0]['producto']."' data-rel='tooltip'>"; 
}else{
    echo "<img src='fotos/producto.png' border='1' width='100' height='120' data-rel='tooltip'>"; 
} } else {
  echo "<img src='fotos/producto.png' border='1' width='100' height='120' data-rel='tooltip'>"; 
}
?><br /><strong>C&oacute;digo de Barra</strong><br /><strong><?php  //Mostramos la imagen
    echo "<img src='codigoBarras_img.php?numero=".$reg[0]['codigobarra']."' title='Codigo de Barra'>"; ?></strong></div></td>
    </tr>
  </table></div>
<?php
}
########################## MOSTRAR FOTO DE PRODUCTO EN VENTANA MODAL #########################
?>

<?php
############################### MOSTRAR PRODUCTO EN VENTANA MODAL ###############################
if (isset($_GET['BuscaProductoModal']) && isset($_GET['codproducto'])) { 

$codproducto = $_GET['codproducto'];

$reg = $tra->DetalleProductosPorId();
?>
<div class="row">
 <table border="0" align="center">
    <tr><td><strong>C&oacute;digo de Producto: </strong><?php echo $reg[0]['codproducto']; ?></td>
    </tr>
    <tr>
      <td><strong>Nombre de Producto: </strong> <?php echo $reg[0]['producto']; ?></td>
    </tr>
    <tr>
      <td><strong>Categoria: </strong> <?php echo $reg[0]['nomcategoria']; ?></td>
    </tr>
    <tr>
      <td><strong>Precio Venta: </strong> <?php echo "<strong>".$simbolo."</strong>".number_format($reg[0]['precioventa'], 2, '.', ','); ?></td>
    </tr>
    <tr>
      <td><strong>Existencia: </strong> <?php echo $reg[0]['existencia']; ?></td>
    </tr>
    <tr>
      <td><strong>Stock Minimo: </strong> <?php echo $reg[0]['stockminimo']; ?></td>
    </tr>
    <tr>
      <td><strong>Tiene IGV: </strong> <?php echo $reg[0]['ivaproducto']; ?></td>
    </tr>
    <tr>
      <td><strong>Descuento %: </strong> <?php echo $reg[0]['descproducto']; ?></td>
    </tr>
    <tr>
      <td><strong>Proveedor: </strong> <?php echo $reg[0]['nomproveedor']; ?></td>
    </tr>
    <tr>
      <td><strong>C&oacute;digo de Barra: </strong> <?php echo $reg[0]['codigobarra']; ?></td>
    </tr>
    <tr>
      <td><strong>Favorito: </strong> <?php echo $reg[0]['favorito']; ?></td>
    </tr>
    <tr>
      <td><strong>Status: </strong> <?php echo $status = ( $reg[0]['statusproducto'] == 'ACTIVO' ? "<span class='label label-success'><i class='fa fa-check'></i> ".$reg[0]['statusproducto']."</span>" : "<span class='label label-warning'><i class='fa fa-times'></i> ".$reg[0]['statusproducto']."</span>"); ?></td>
    </tr>
   </table>
</div><hr />

<div id="div1"><div class="table-responsive" data-pattern="priority-columns">
        <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                                <thead>
                                                    <tr>
        <th colspan="5" data-priority="1"><center>Ingredientes Agregados</center></th>
                                                    </tr>
                                                    <tr>
            <th>N&deg;</th>
            <th data-priority="3">Ingrediente</th>
            <th data-priority="2">Cant. Raci&oacute;n</th>
            <th data-priority="3">Existencia</th>
            <th data-priority="4">Costo</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
<?php 
$tru = new Login();
$a=1;
$busq = $tru->VerDetallesIngredientesProductos(); 

if($busq==""){

    echo "";      
    
} else {

for($i=0;$i<sizeof($busq);$i++){
?>
                                                    <tr>
                <th><?php echo $a++; ?></th>
<td><?php echo $busq[$i]["nomingrediente"]; ?></td>
<td><?php echo $busq[$i]["cantracion"]." ".$busq[$i]["unidadingrediente"]; ?></td>
<td><?php echo $busq[$i]["cantingrediente"]." ".$busq[$i]["unidadingrediente"]; ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($busq[$i]["costoingrediente"], 2, '.', ','); ?></td>
                                                    </tr> 
                              <?php } } ?>     
                                                </tbody>
                                            </table>
                                        </div>
                    
                    <br />
                    
<div class="table-responsive" data-pattern="priority-columns">
      <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                                <thead>
                                                    <tr>
    <th colspan="9" data-priority="1"><center>Movimientos del Producto</center></th>
                                                    </tr>
                                                    <tr>
                      <th data-priority="2">Provedor/Cliente</th>
                      <th data-priority="3">Movimiento</th>
                      <th data-priority="4">Entradas</th>
                      <th data-priority="3">Salidas</th>
                      <th data-priority="2">Precio Costo</th>
                      <th data-priority="3">Costo Movimiento</th>
                      <th data-priority="5">Stock Actual</th>
                                                            <th data-priority="3">Fecha</th>
                                                            </tr>
                            </thead>
                                                        <tbody>
 <?php 
$tru = new Login();
$busq = $tru->VerDetallesKardexProducto(); 

if($busq==""){

    echo "";      
    
} else {

for($i=0;$i<sizeof($busq);$i++){
?>
                             <tr>
<td><abbr title="<?php echo $busq[$i]["documento"]; ?>"><?php if($busq[$i]["codresponsable"]=="0" && $busq[$i]["movimiento"]=="ENTRADAS") { echo "INVENTARIO INICIAL"; } elseif($busq[$i]["codresponsable"]=="0" && $busq[$i]["movimiento"]=="SALIDAS") { echo "CONSUMIDOR FINAL"; } elseif($busq[$i]["movimiento"]=="ENTRADAS"){ echo $busq[$i]["proveedor"]; } elseif($busq[$i]["movimiento"]=="SALIDAS"){ echo $busq[$i]["clientes"]; } ?></abbr></td>


<td><?php echo $busq[$i]["movimiento"]; ?></td>
<td><?php echo $busq[$i]["entradas"]; ?></td>
<td><?php echo $busq[$i]["salidas"]; ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($busq[$i]['preciom'], 2, '.', ','); ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($busq[$i]['costototal'], 2, '.', ','); ?></td>
<td><?php echo $busq[$i]['stockactual']; ?></td>
<td><?php echo $busq[$i]["fechakardex"]; ?></td>
                                                          </tr>
                              <?php } } ?>
                                                        </tbody>
                        </table>
                                      </div>  </div>  
<?php
}
############################### MOSTRAR PRODUCTO EN VENTANA MODAL ###############################
?>


<?php 
########################### MUESTRA INGREDIENTES ASIGNADOS A PRODUCTOS ##########################
if (isset($_GET['BuscaIngredienteProductos']) && isset($_GET['codproducto'])) { 
  
$codproducto = $_GET['codproducto'];

$tru = new Login();
$busq = $tru->VerDetallesIngredientesProductos();
?>

<table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                                <thead>
                                                    <tr>
        <th colspan="6" data-priority="1"><center>Ingredientes Agregados</center></th>
                                                    </tr>
                                                    <tr>
                      <th>N&deg;</th>
        <th data-priority="3">Ingrediente</th>
        <th data-priority="2">Cant. Raci&oacute;n</th>
        <th data-priority="3">Existencia</th>
        <th data-priority="4">Costo</th>
        <th data-priority="1"><center>Eliminar</center></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
<?php 
$a=1;
for($i=0;$i<sizeof($busq);$i++){
?>
                                                    <tr>
                                        <td><?php echo $a++; ?></td>
<td><input type="hidden" name="codingrediente[]" id="codingrediente" value="<?php echo $busq[$i]["codingrediente"]; ?>"><?php echo $busq[$i]["nomingrediente"]; ?></td>
<td><input type="text" class="form-control" name="cantidad[]" id="cantidad" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Cantidad Porci?n" value="<?php echo $busq[$i]["cantracion"]; ?>" required="" aria-required="true"></td>
<td><?php echo $busq[$i]["cantingrediente"]." ".$busq[$i]["unidadingrediente"]; ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($busq[$i]["costoingrediente"], 2, '.', ','); ?></td>
<td data-priority="7"><center><a href="#" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="left" title="" data-original-title="Eliminar Ingrediente" onClick="EliminaIngrediente('<?php echo base64_encode($busq[$i]['codproducto']) ?>','<?php echo base64_encode($busq[$i]['codingrediente']) ?>','<?php echo base64_encode("ELIMINAINGREDIENTES") ?>')"><i class="fa fa-trash-o"></i></a></center></td>
                          </tr> 
                              <?php } ?>     
                                                </tbody>
                                            </table>

<?php 
}
########################### MUESTRA INGREDIENTES ASIGNADOS A PRODUCTOS ##########################
?>

<?php 
############################# MUESTRA INGREDIENTES NUEVOS A PRODUCTOS ############################
if (isset($_GET['BuscaNuevosIngredienteProductos']) && isset($_GET['codproducto'])) { 
  
$codproducto = $_GET['codproducto'];

?>

<table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                                <thead>
                                                    <tr>
             <th colspan="6" data-priority="1"><center>Ingredientes Agregados</center></th>
                                                    </tr>
                                                    <tr>
                               <th>N&deg;</th>
                      <th data-priority="3">Ingrediente</th>
                      <th data-priority="2">Cant. Raci&oacute;n</th>
                      <th data-priority="3">Existencia</th>
                      <th data-priority="4">Costo</th>
                                                <th data-priority="1"><center>Eliminar</center></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
<?php
$tru = new Login();
$busq = $tru->VerDetallesIngredientesProductos(); 
$a=1;
for($i=0;$i<sizeof($busq);$i++){
?>
                                                    <tr>
                                        <td><?php echo $a++; ?></td>
<td><input type="hidden" name="codingrediente[]" id="codingrediente" value="<?php echo $busq[$i]["codingrediente"]; ?>"><?php echo $busq[$i]["nomingrediente"]; ?></td>
<td><?php echo $busq[$i]["cantracion"]; ?></td>
<td><?php echo $busq[$i]["cantingrediente"]." ".$busq[$i]["unidadingrediente"]; ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($busq[$i]["costoingrediente"], 2, '.', ','); ?></td>
<td data-priority="7"><center><a href="#" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="left" title="" data-original-title="Eliminar Ingrediente" onClick="EliminaNuevoIngrediente('<?php echo base64_encode($busq[$i]['codproducto']) ?>','<?php echo base64_encode($busq[$i]['codingrediente']) ?>','<?php echo base64_encode("ELIMINAINGREDIENTES") ?>')"><i class="fa fa-trash-o"></i></a></center></td>
                          </tr> 
                              <?php } ?>     
                                                </tbody>
                                            </table>

<?php 
}
############################# MUESTRA INGREDIENTES NUEVOS A PRODUCTOS ############################
?>


<?php
############################# BUSQUEDA KARDEX POR PRODUCTOS ###############################
if (isset($_GET['BuscaKardexProducto']) && isset($_GET['codproducto'])) { 
   
     $codproducto = $_GET['codproducto'];

  if($codproducto=="") {

  echo "<center><div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<span class='fa fa-info-circle'></span> POR FAVOR REALICE LA B&Uacute;SQUEDA DEL PRODUCTO CORRECTAMENTE</div></center>";
   exit;
   
   } else {

  $tra = new Login();
  $reg = $tra->BuscarKardexProducto();    

  ?>
  
 <div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-tasks"></i> Movimientos del Producto <?php echo $reg[0]['producto']; ?></h3></div>
<div class="panel-body">
      
<div class="row">
       <div class="col-sm-12 col-xs-12"> 
                            <div class="box-body">
                                <div class="row"> 
                                <div class="col-md-12"> 
                               
<div id="div1"><div class="table-responsive" data-pattern="priority-columns">
                  <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                            <thead>
                              <tr role="row">
                                  <th>N&deg;</th>
                                  <th>Movimiento</th>
                                  <th>Entradas</th>
                                  <th>Salidas</th>
                                  <th>Devoluci&oacute;n</th>
                                  <th>Precio Movimiento</th>
                                  <th>Costo Movimiento</th>
                                  <th>Stock Actual</th>
                                  <th>Documento</th>
                                  <th>Fecha</th>
                              </tr>
                                            </thead>
                                            <tbody>
<?php
$TotalEntradas=0;
$TotalSalidas=0;
$TotalDevolucion=0;
$a=1;
for($i=0;$i<sizeof($reg);$i++){ 
$TotalEntradas+=$reg[$i]['entradas'];
$TotalSalidas+=$reg[$i]['salidas'];
$TotalDevolucion+=$reg[$i]['devolucion'];
?>
                              <tr>
                                  <td><?php echo $a++; ?></td>
                                  <td><?php echo $reg[$i]['movimiento']; ?></td>
                                  <td><?php echo $reg[$i]['entradas']; ?></td>
                                  <td><?php echo $reg[$i]['salidas']; ?></td>
                                  <td><?php echo $reg[$i]['devolucion']; ?></td>
<td><?php echo $simbolo.number_format($reg[$i]['preciom'], 2, '.', ','); ?></td>
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
                        <?php  }  ?>
                                            </tbody>
                                        </table>
<strong>Detalles de Producto</strong><br>
<strong>C&oacute;digo : <?php echo $reg[0]['codproducto']; ?></strong><br>
<strong>Producto : <?php echo $reg[0]['producto']; ?></strong><br>
<strong>Categoria : <?php echo $reg[0]['nomcategoria']; ?></strong><br>
<strong>Total Entradas : <?php echo $TotalEntradas; ?></strong><br>
<strong>Total Salidas : <?php echo $TotalSalidas; ?></strong><br>
<strong>Total Devoluci&oacute;n : <?php echo $TotalDevolucion; ?></strong><br>
<strong>Existencia : <?php echo $reg[0]['existencia']; ?></strong><br>
<strong>Precio Compra : <?php echo $simbolo.$reg[0]['preciocompra']; ?></strong><br>
<strong>Precio Venta : <?php echo $simbolo.$reg[0]['precioventa']; ?></strong><br><br>


<div align="center"><a href="reportepdf?codproducto=<?php echo $codproducto; ?>&tipo=<?php echo base64_encode("KARDEXPRODUCTOS") ?>" target="_blank" rel="noopener noreferrer"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-pdf-o"></span> Exportar Pdf</button></a>
                          
<a href="reporteexcel?codproducto=<?php echo $codproducto; ?>&tipo=<?php echo base64_encode("KARDEXPRODUCTOS") ?>"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-excel-o"></span> Exportar Excel</button> </a>                   
            </div><br />                 
                                             </div>
                                         </div>
                                     </div>  
                                 </div>
                             </div><!-- /.box-body -->
                         </div>
                    </div>
               </div>
          </div>
  <?php
  
   }
 } 
############################# BUSQUEDA KARDEX POR PRODUCTOS ###############################
?>


















<?php
############################# MOSTRAR ARQUEO EN CAJA EN VENTANA MODAL ###########################
if (isset($_GET['BuscaArqueoCajaModal']) && isset($_GET['codarqueo'])) { 

$reg = $tra->ArqueoCajaPorId();

?>
  
  <div class="row">
  <table border="0" align="left" >
    <tr>
    <td><strong>N&deg; de Caja:</strong> <?php echo $reg[0]['nrocaja']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombre de Caja:</strong> <?php echo $reg[0]['nombrecaja']; ?></td>
  </tr>
  <tr>
    <td><strong>Monto Inicial:</strong> <?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[0]['montoinicial'], 2, '.', ','); ?></td>
  </tr> 
  <tr>
    <td><strong>Ingresos:</strong> <?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[0]['ingresos'], 2, '.', ','); ?></td>
  </tr>
  <tr> 
    <td><strong>Egresos:</strong> <?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[0]['egresos'], 2, '.', ','); ?></td>
  </tr>
  <tr>
    <td><strong>Dinero en Efectivo:</strong> <?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[0]['dineroefectivo'], 2, '.', ','); ?></td>
  </tr>
  <tr>
    <td><strong>Diferencia:</strong> <?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[0]['diferencia'], 2, '.', ','); ?></td>
  </tr>
  <tr>
    <td><strong>Comentario:</strong> <?php echo $reg[0]['comentarios']; ?></td>
  </tr>
  <tr>
    <td><strong>Hora Apertura:</strong> <?php echo date("d-m-Y h:i:s",strtotime($reg[0]['fechaapertura'])); ?></td>
  </tr>
  <tr>
    <td><strong>Hora Cierre:</strong> <?php echo $cierre = ( $reg[0]['statusarqueo'] == '1' ? $reg[0]['fechacierre'] : date("d-m-Y h:i:s",strtotime($reg[0]['fechacierre']))); ?></td>
  </tr>
  <tr>
    <td><strong>Responsable:</strong> <?php echo $reg[0]['nombres']; ?></td>
  </tr>


</table>
</div> 
  
<hr>
  <table border="0" align="left">
         <tr>
           <th style="width: 55% !important;">TIPO INGRESO</th>
           
           <th>TOTAL INGRESO</th>
         </tr>
      <?php 
$tra = new Login();
$reg = $tra->BuscarVentasCajasID();
$Pagototal=0;
$pagoefectivo=0;
$pagotrans=0;
$pagotarjeta=0;
$pagoyape=0;
$pagoplin=0;
$pagocheque=0;
$a=1;
  
for($i=0;$i<sizeof($reg);$i++){
  
if($reg[$i]['formapagove']=="1"){
  $pagoefectivo+=$reg[$i]['totalpago'];
}else if($reg[$i]['formapagove']=="2"){
  $pagotrans+=$reg[$i]['totalpago'];
}else if($reg[$i]['formapagove']=="3"){
  $pagotarjeta+=$reg[$i]['totalpago'];
}else if($reg[$i]['formapagove']=="4"){
  $pagoyape+=$reg[$i]['totalpago'];
}else if($reg[$i]['formapagove']=="5"){
  $pagoplin+=$reg[$i]['totalpago'];
}else{
  $pagocheque+=$reg[$i]['totalpago'];
}
$Pagototal+=$reg[$i]['totalpago']; 
?>
         
        <?php } ?>
         <tr align="left" class="even_row">
           <td>EFECTIVO: </td>
           <td><strong><?php echo $con[0]['simbolo'].number_format($pagoefectivo, 2, '.', ','); ?></strong></td>
         </tr>
         <tr align="left" class="even_row">
           <td>TRANFERENCIA: </td>
           <td><strong><?php echo $con[0]['simbolo'].number_format($pagotrans, 2, '.', ','); ?></strong></td>
         </tr>
         <tr align="left" class="even_row">
           <td>TARJETA D/C: </td>
           <td><strong><?php echo $con[0]['simbolo'].number_format($pagotarjeta, 2, '.', ','); ?></strong></td>
         </tr>
         <tr align="left" class="even_row">
           <td>YAPE: </td>
           <td><strong><?php echo $con[0]['simbolo'].number_format($pagoyape, 2, '.', ','); ?></strong></td>
         </tr>
         <tr align="left" class="even_row">
           <td>PLIN: </td>
           <td><strong><?php echo $con[0]['simbolo'].number_format($pagoplin, 2, '.', ','); ?></strong></td>
         </tr>
    </table>
    </td>
  </tr>
</table>


  <?php
   } 
############################# MOSTRAR ARQUEO EN CAJA EN VENTANA MODAL ###########################
?>


<?php 
############################# MUESTRA MOVIMIENTO DB #############################################
if (isset($_GET['muestramovimeintodb']) && isset($_GET['codmovimientocaja'])) {
  
$tra = new Login();
$reg = $tra->MovimientoCajasPorId();

  ?>
<input type="hidden" name="montomovimientocajadb" id="montomovimientocajadb" <?php if (isset($reg[0]['montomovimientocaja'])) { ?> value="<?php echo $reg[0]['montomovimientocaja']; ?>"<?php } ?>>
<?php 
  }
############################# MUESTRA MOVIMIENTO DB #############################################
?>

<?php
########################### MOSTRAR MOVIMIENTO EN CAJA EN VENTANA MODAL ###########################
if (isset($_GET['BuscaMovimientoCajaModal']) && isset($_GET['codmovimientocaja'])) { 

$reg = $tra->MovimientoCajasPorId();

  ?>
  
  <div class="row">
  <table border="0" align="center" >
  <tr>
    <td><strong>Tipo de Movimiento:</strong> <?php echo $reg[0]['tipomovimientocaja']; ?></td>
  </tr>
  <tr>
    <td><strong>Monto de Movimiento:</strong> <?php echo "<strong>".$con[0]['simbolo']."</strong>".$reg[0]['montomovimientocaja']; ?></td>
  </tr>
  <tr>
    <td><strong>Medio de Pago:</strong> <?php echo $reg[0]['mediopago']; ?></td>
  </tr>
  <tr>
    <td><strong>Nombre de Caja:</strong> <?php echo $reg[0]['nombrecaja']; ?></td>
  </tr>
  <tr>
    <td><strong>Descripcion de Movimiento:</strong> <?php echo $reg[0]['descripcionmovimientocaja']; ?></td>
  </tr>
  <tr>
    <td><strong>Persona de Contacto:</strong> <?php echo date("d-m-Y h:i:s",strtotime($reg[0]['fechamovimientocaja'])); ?></td>
  </tr>
  <tr>
    <td><strong>Persona que Registro:</strong> <?php echo $reg[0]['nombres']; ?></td>
  </tr>
</table>
</div>
  
  <?php
   } 
########################### MOSTRAR MOVIMIENTO EN CAJA EN VENTANA MODAL ###########################
?>














<?php 
############################# MUESTRA CANTIDAD COMPRA DB #############################################
if (isset($_GET['muestracantcompradb']) && isset($_GET['coddetallecompra'])) {
  
$tra = new Login();
$reg = $tra->DetallesComprasPorId();

  ?>
<input type="hidden" name="cantidadcompradb" id="cantidadcompradb" value="<?php echo $reg[0]['cantcompra']; ?>">
<?php 
  }
############################# MUESTRA CANTIDAD COMPRA DB #############################################
?>

<?php
########################### MOSTRAR COMPRAS EN VENTANA MODAL ###########################
if (isset($_GET['BuscaComprasModal']) && isset($_GET['codcompra'])) { 

$tra = new Login(); 
$co = $tra->ComprasPorId();
?>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="pull-right">
                         <address>
<abbr title="N? de Compra"><strong>N&deg; DE COMPRA: </strong> <?php echo $co[0]["codcompra"]; ?></abbr><br>
<abbr title="N? de Serie"><strong>N&deg; DE SERIE: </strong> <?php echo $co[0]["codseriec"]; ?></abbr><br>
<abbr title="<?php echo $co[0]["contactoproveedor"]; ?>"><strong><?php echo $co[0]["ritproveedor"].": ".$co[0]["nomproveedor"]; ?></strong></abbr><br>
<abbr title="Direcci&oacute;n de Proveedor"><?php echo $co[0]["direcproveedor"]; ?></abbr><br>
<abbr title="Email de Proveedor"><?php echo $co[0]["emailproveedor"]; ?></abbr> <abbr title="Telefono"><strong>TLF:</strong></abbr> <?php echo $co[0]["tlfproveedor"]; ?><br />
 <abbr title="Fecha de Compra"><strong>FECHA DE COMPRA:</strong></abbr> <?php echo date("d-m-Y h:i:s",strtotime($co[0]["fechacompra"])); ?><br />
<abbr title="Tipo de Compra"><strong>TIPO DE COMPRA:</strong></abbr> <?php echo $co[0]["tipocompra"]; ?><br />
<abbr title="Forma de Compra"><strong>MEDIO DE PAGO:</strong></abbr> <?php echo $variable = ( $co[0]['tipocompra'] == 'CONTADO' ? $co[0]['mediopago'] : $co[0]['formapago']); ?><br />
<abbr title="Fecha de Vencimiento de Cr&eacute;dito"><strong>FECHA DE VENCIMIENTO:</strong></abbr> <?php echo $vence = ( $co[0]['fechavencecredito'] == '0000-00-00' ? "0" : date("d-m-Y",strtotime($co[0]['fechavencecredito']))); ?><br />

<abbr title="Dias Vencidos de Cr?dito"><strong>DIAS VENCIDOS:</strong></abbr> <?php 
if($co[0]['fechavencecredito']== '0000-00-00') { echo "0"; } 
elseif($co[0]['fechavencecredito'] >= date("Y-m-d")) { echo "0"; } 
elseif($co[0]['fechavencecredito'] < date("Y-m-d")) { echo Dias_Transcurridos(date("Y-m-d"),$co[0]['fechavencecredito']); } ?><br />

<abbr title="Status de Compra"><strong>STATUS DE COMPRA:</strong></abbr> <?php 
if($co[0]['fechavencecredito']== '0000-00-00') { echo "<span class='label label-success'>".$co[0]["statuscompra"]."</span>"; } 
elseif($co[0]['fechavencecredito'] >= date("Y-m-d")) { echo "<span class='label label-success'>".$co[0]["statuscompra"]."</span>"; } 
elseif($co[0]['fechavencecredito'] < date("Y-m-d")) { echo "<span class='label label-danger'>VENCIDA</span>"; } ?>
                                                  </address>
                                                </div>
                                            </div>
                                        </div>                        
                       
                       
                       
<div class="table-responsive" data-pattern="priority-columns">
      <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">                        <thead>
                              <tr>
                              <th>C&oacute;digo</th>
                              <th>Descripci&oacute;n Producto</th>
                              <th>Categoria</th>
                              <th>Precio C.</th>
                              <th>Cantidad</th>
                              <th>Importe</th>
                              </tr>
                            </thead>
                                                        <tbody>
 <?php 
$tru = new Login();
$busq = $tru->VerDetallesCompras();
for($i=0;$i<sizeof($busq);$i++){
$cantidad=$busq[$i]["cantcompra"];
$importe=$busq[$i]["precio1"]*$cantidad;
?>
                             <tr>
<td><?php echo $busq[$i]["codproducto"]; ?></td>
<td><?php echo $busq[$i]["producto"]; ?></td>
<td><?php if($busq[$i]['tipoentrada']=="PRODUCTO"){ echo $busq[$i]['nomcategoria']; } else { echo $busq[$i]['categoria']; } ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($busq[$i]["precio1"], 2, '.', ','); ?></td>
<td><?php echo $busq[$i]["cantcompra"]; ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($importe, 2, '.', ','); ?></td>
                                                          </tr>
                              <?php } ?>
                                <tr>
                              <td colspan="3" rowspan="5">&nbsp;</td>
<td colspan="2"><div align="right"><strong>SubTotal IGV <?php echo $co[0]["ivac"]."(%)"; ?>:</strong></div></td>
<td><div align="right"><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($co[0]["subtotalivasic"], 2, '.', ','); ?></div></td>
                                </tr>
                               <tr>
<td colspan="2"><div align="right"><strong>SubTotal IGV 0%:</strong></div></td>
<td><div align="right"><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($co[0]["subtotalivanoc"], 2, '.', ','); ?></div></td>
                            </tr>
                              <tr>
<td colspan="2"><div align="right"><strong>IGV <?php echo $co[0]["ivac"]."(%)"; ?>:</strong></div></td>
<td><div align="right"><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($co[0]["totalivac"], 2, '.', ','); ?></div></td>
                                </tr>
                              <tr>
<td colspan="2"><div align="right"><strong>Descuento <?php echo $co[0]["descuentoc"]."(%)"; ?>:</strong></div></td>
<td><div align="right"><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($co[0]["totaldescuentoc"], 2, '.', ','); ?></div></td>
                                </tr>
                              <tr>
<td colspan="2"><div align="right"><strong>Total Pago :</strong></div></td>
<td><div align="right"><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($co[0]["totalc"], 2, '.', ','); ?></div></td>
                                </tr>
                                                        </tbody>
</table></div>
<?php
}
########################### MOSTRAR COMPRAS EN VENTANA MODAL ###########################
?>

<?php
############################ MOSTRAR DETALLE DE COMPRA EN VENTANA MODAL ##########################
if (isset($_GET['BuscaDetallesComprasModal']) && isset($_GET['coddetallecompra']) && isset($_GET['tipoentrada'])) { 

$reg = $tra->DetallesComprasPorId();

if(base64_decode($_GET['tipoentrada'])=="PRODUCTO"){
?>
<div class="row">
  <table border="0" align="center" >
    <tr>
      <td><strong>C&oacute;digo de Producto: </strong><?php echo $reg[0]['codproducto']; ?></td>
    </tr>
    <tr>
      <td><strong>Nombre de Producto: </strong> <?php echo $reg[0]['producto']; ?></td>
    </tr>
    <tr>
      <td><strong>Categoria: </strong> <?php echo $reg[0]['nomcategoria']; ?></td>
    </tr>
    <tr>
      <td><strong>Precio Compra: </strong> <?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[0]['precio1'], 2, '.', ','); ?></td>
    </tr>
    <tr>
      <td><strong>Precio Venta: </strong> <?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[0]['precio2'], 2, '.', ','); ?></td>
    </tr>
    <tr>
      <td><strong>Tiene IGV: </strong> <?php echo $reg[0]['ivaproductoc']; ?></td>
    </tr>
    <tr>
      <td><strong>Cantidad Compra: </strong> <?php echo $reg[0]['cantcompra']; ?></td>
    </tr>
    <tr>
   <td><strong>Importe: </strong> <?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[0]['cantcompra'] * $reg[0]['precio1'], 2, '.', ','); ?></td>
    </tr>
    <tr>
      <td><strong>Fecha Registro: </strong> <?php echo date("d-m-Y h:i:s",strtotime($reg[0]['fechadetallecompra'])); ?></td>
    </tr>
  </table>
</div>
<?php } else {  ?>

<div class="row">
  <table border="0" align="center" >
    <tr>
      <td><strong>C&oacute;digo de Ingrediente: </strong><?php echo $reg[0]['codingrediente']; ?></td>
    </tr>
    <tr>
      <td><strong>Nombre de Ingrediente: </strong> <?php echo $reg[0]['nomingrediente']; ?></td>
    </tr>
    <tr>
      <td><strong>Precio Compra: </strong> <?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[0]['precio1'], 2, '.', ','); ?></td>
    </tr>
    <tr>
      <td><strong>Precio Venta: </strong> <?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[0]['precio2'], 2, '.', ','); ?></td>
    </tr>
    <tr>
      <td><strong>Tiene IGV: </strong> <?php echo $reg[0]['ivaproductoc']; ?></td>
    </tr>
    <tr>
      <td><strong>Cantidad Compra: </strong> <?php echo $reg[0]['cantcompra']." ".$reg[0]['categoria']; ?></td>
    </tr>
    <tr>
   <td><strong>Importe: </strong> <?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[0]['cantcompra'] * $reg[0]['precio1'], 2, '.', ','); ?></td>
    </tr>
    <tr>
      <td><strong>Fecha Registro: </strong> <?php echo date("d-m-Y h:i:s",strtotime($reg[0]['fechadetallecompra'])); ?></td>
    </tr>
  </table>
</div>
<?php
    }
}
############################ MOSTRAR DETALLE DE COMPRA EN VENTANA MODAL ##########################

?>

<?php
############################# BUSQUEDA DE COMPRAS POR PROVEEDORES #################################
if (isset($_GET['BuscaComprasPoveedor']) && isset($_GET['codproveedor'])) { 
  
   $codproveedor = $_GET['codproveedor'];

if($codproveedor=="") {

  echo "<center><div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE EL PROVEEDOR PARA TU B&Uacute;SQUEDA</div></center>";
   exit;
    
} else {

$pro = new Login();
$pro = $pro->ProveedorPorId();

  ?>
  
 <div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-tasks"></i> Compras de Productos del Proveedor <?php echo $pro[0]['nomproveedor']; ?></h3></div>
<div class="panel-body">
      
<div class="row">
       <div class="col-sm-12 col-xs-12"> 
                            <div class="box-body">
                                <div class="row"> 
                                <div class="col-md-12"> 
                               
  <div id="div1"><div class="table-responsive" data-pattern="priority-columns">
                <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">                              
                       <thead>
                              <tr>
                                                    <th>N&deg;</th>
                          <th>N&deg; de Compra</th>
                          <th>Fecha Registro</th>
                          <th>Subtotal Con IGV</th>
                          <th>Subtotal IGV 0%</th>
                          <th>Total IGV</th>
                          <th>Total Desc</th>
                          <th>Total</th>
                          <th>Imprimir</th>
                                                </tr>
                              </thead>
                              <tbody>
<?php 
$a=1;
$SubtotalIva=0;
$SubtotalIvano=0;
$TotalIvaC=0;
$TotalDescuentoC=0;
$TotalMonto=0;
$ci = new Login();
$reg = $ci->BuscarComprasProveedor();
for($i=0;$i<sizeof($reg);$i++){  
$SubtotalIva+=$reg[$i]['subtotalivasic'];
$SubtotalIvano+=$reg[$i]['subtotalivanoc'];
$TotalIvaC+=$reg[$i]['totalivac']; 
$TotalDescuentoC+=$reg[$i]['totaldescuentoc']; 
$TotalMonto+=$reg[$i]['totalc']; 
?>
                           <tr>
                                                    <td><?php echo $a++; ?></td>
                                                    <td><?php echo $reg[$i]['codcompra']; ?></td>
<td><?php echo date("d-m-Y h:i:s",strtotime($reg[$i]['fechacompra'])); ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[$i]['subtotalivasic'], 2, '.', ','); ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[$i]['subtotalivanoc'], 2, '.', ','); ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[$i]['totalivac'], 2, '.', ','); ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[$i]['totaldescuentoc'], 2, '.', ','); ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[$i]['totalc'], 2, '.', ','); ?></td>
<td class="actions"><a href="reportepdf?codcompra=<?php echo base64_encode($reg[$i]['codcompra']); ?>&tipo=<?php echo base64_encode("FACTURACOMPRAS") ?>" target="_black" class="btn btn-info btn-xs" title="Factura de Compra" ><i class="fa fa-print"></i></a></td>
                                                </tr>
                        <?php  }  ?>
                 <tr>
                              <td>&nbsp;</td>
                <td>&nbsp;</td>
                              <td><strong>Total General</strong></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($SubtotalIva, 2, '.', ','); ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($SubtotalIvano, 2, '.', ','); ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($TotalIvaC, 2, '.', ','); ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($TotalDescuentoC, 2, '.', ','); ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($TotalMonto, 2, '.', ','); ?></td>
                      <td>&nbsp;</td>
                            </tr>
                              </tbody>
                          </table>
<div align="center"><a href="reportepdf.php?codproveedor=<?php echo $codproveedor; ?>&tipo=<?php echo base64_encode("COMPRASPROVEEDOR") ?>" title="Compras por Proveedores (Pdf)" target="_blank"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-pdf-o"></span> Exportar Pdf</button></a>
                          
<a href="reporteexcel.php?codproveedor=<?php echo $codproveedor; ?>&tipo=<?php echo base64_encode("COMPRASPROVEEDOR") ?>" title="Compras por Proveedores (Excel)"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-excel-o"></span> Exportar Excel</button> </a>                    
                  </div><br /></div>
                                   </div>  
                              </div>
                          </div><!-- /.box-body -->
                      </div>
                  </div>
              </div>
          </div>
      </div>
  <?php
  
   }
 } 
############################# BUSQUEDA DE COMPRAS POR PROVEEDORES ##############################
?>


<?php
############################## BUSQUEDA DE COMPRAS POR FECHAS ##############################
if (isset($_GET['BuscaComprasFechas']) && isset($_GET['desde']) && isset($_GET['hasta'])) {  

     $desde = $_GET['desde']; 
     $hasta = $_GET['hasta']; 

if($desde=="") {

  echo "<center><div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA DE INICIO PARA TU B&Uacute;SQUEDA</div></center>";
   exit;
    

} else if($hasta=="") {

  echo "<center><div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA FINAL PARA TU  B&Uacute;SQUEDA</div></center>";
   exit;
   
   } else {

  ?>
  
 <div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-tasks"></i> Compras por Fechas Desde <?php echo $_GET["desde"]." hasta ".$_GET["hasta"]; ?></h3></div>
<div class="panel-body">
      
<div class="row">
       <div class="col-sm-12 col-xs-12"> 
                            <div class="box-body">
                                <div class="row"> 
                                <div class="col-md-12"> 
                               
  <div id="div1"><div class="table-responsive" data-pattern="priority-columns">
                <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">                              
                       <thead>
                              <tr>
                          <th>N&deg;</th>
                          <th>N&deg; de Compra</th>
                          <th>Proveedor</th>
                          <th>Fecha Registro</th>
                          <th>Subtotal Con IGV</th>
                          <th>Subtotal IGV 0%</th>
                          <th>Total IGV</th>
                          <th>Total Desc</th>
                          <th>Total</th>
                          <th>Imprimir</th>
                                                </tr>
                              </thead>
                              <tbody>
<?php 
$a=1;
$SubtotalIva=0;
$SubtotalIvano=0;
$TotalIvaC=0;
$TotalDescuentoC=0;
$TotalMonto=0;
$ci = new Login();
$reg = $ci->BuscarComprasFechas();
for($i=0;$i<sizeof($reg);$i++){  
$SubtotalIva+=$reg[$i]['subtotalivasic'];
$SubtotalIvano+=$reg[$i]['subtotalivanoc'];
$TotalIvaC+=$reg[$i]['totalivac']; 
$TotalDescuentoC+=$reg[$i]['totaldescuentoc']; 
$TotalMonto+=$reg[$i]['totalc']; 
?>
                           <tr>
                                                    <td><?php echo $a++; ?></td>
                                                    <td><?php echo $reg[$i]['codcompra']; ?></td>
<td><?php echo $reg[$i]['nomproveedor']; ?></td>
<td><?php echo date("d-m-Y h:i:s",strtotime($reg[$i]['fechacompra'])); ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[$i]['subtotalivasic'], 2, '.', ','); ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[$i]['subtotalivanoc'], 2, '.', ','); ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[$i]['totalivac'], 2, '.', ','); ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[$i]['totaldescuentoc'], 2, '.', ','); ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[$i]['totalc'], 2, '.', ','); ?></td>
<td class="actions"><a href="reportepdf?codcompra=<?php echo base64_encode($reg[$i]['codcompra']); ?>&tipo=<?php echo base64_encode("FACTURACOMPRAS") ?>" target="_black" class="btn btn-info btn-xs" title="Factura de Compra" ><i class="fa fa-print"></i></a></td>
                                                </tr>
                        <?php  }  ?>
                 <tr>
                              <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                              <td><strong>Total General</strong></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($SubtotalIva, 2, '.', ','); ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($SubtotalIvano, 2, '.', ','); ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($TotalIvaC, 2, '.', ','); ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($TotalDescuentoC, 2, '.', ','); ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($TotalMonto, 2, '.', ','); ?></td>
                         <td>&nbsp;</td>
                            </tr>
                              </tbody>
                          </table>
<div align="center"><a href="reportepdf.php?desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo base64_encode("COMPRASFECHAS") ?>" title="Compras por Proveedores (Pdf)" target="_blank"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-pdf-o"></span> Exportar Pdf</button></a>
                          
<a href="reporteexcel.php?desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo base64_encode("COMPRASFECHAS") ?>" title="Compras por Proveedores (Excel)"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-excel-o"></span> Exportar Excel</button> </a>                   
                  </div><br /></div>
                                   </div>  
                                </div>
                            </div><!-- /.box-body -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
  <?php
  
   }
 } 
############################## BUSQUEDA DE COMPRAS POR FECHAS ##############################
?>
































<?php 
############################ RECARGA GRILLA DE MESAS CON CRONOMETRO ###########################
# (Manejado al inicio de este archivo: ?MesasPanel=si)
?>

<?php 
############################ RECARGA GRILLA DE MESAS COCINERO ###########################
# (Manejado al inicio de este archivo: ?MesasPanelCocinero=si)
?>

<?php 
############################ DETALLE DE PEDIDO COCINA POR MESA ###########################
if (isset($_GET['PedidoCocina']) && isset($_GET['codmesa'])) {
    $cocina = new Login();
    $cocina->MostrarPedidoCocina();
    exit;
}
?>

<?php 
############################ MUESTRA PEDIDOS DE PLATOS EN MOSTRADOR ###########################
if (isset($_GET['PedidosMostrador'])) { 
  
$tra = new Login(); ?>
 
<div id="div1"><div class="table-responsive" data-pattern="priority-columns">
                  <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                                 <thead>
                                                 <tr role="row">
                                  <th>N&deg;</th>
                                  <th>Sala/Mesa</th>
                                  <th>Cliente</th>
                                  <th>Platillos</th>
                                  <th>Espera</th>
                                  <th>Observaciones</th>
                                  <th>Status</th>
                                  <th>Procesar</th>
                              </tr>
                                                 </thead>
                                                 <tbody>
<?php 
$a=1;
$mostrador = new Login();
$reg = $mostrador->ListarMostrador();

if($reg==""){

    echo "";      
    
} else {

for($i=0;$i<sizeof($reg);$i++){  
$numComanda = isset($reg[$i]['numerocomanda']) ? (int) $reg[$i]['numerocomanda'] : 0;
$fechaEspera = isset($reg[$i]['fechapedido']) ? $reg[$i]['fechapedido'] : $reg[$i]['fechaventa'];
?>
                                               <tr role="row" class="odd">
                                    <td class="sorting_1" tabindex="0"><?php echo $a++; ?></td>
<td><?php echo $sala = ( $reg[$i]['codmesa'] == '0' ? "<span class='label label-warning'> SIN ASIGNAR</span>" : $reg[$i]['nombresala']."<br>".$reg[$i]['nombremesa'].($numComanda > 0 ? "<br><span class='label label-primary'>Pedido #".$numComanda."</span>" : "")); ?></td>

<td><?php echo $cliente = ( $reg[$i]['cliente'] == '0' ? "<span class='label label-warning'> SIN ASIGNAR</span>" : $reg[$i]['nomcliente']); ?></td>

<td><?php echo "<span style='font-size:12px;'><strong>".$reg[$i]['detalles']."</strong></span>"; ?></td>

<td><?php echo renderEsperaBadge($fechaEspera); ?></td>

<td><?php echo $observaciones = ( $reg[$i]['observaciones'] == '' ? " SIN OBSERVACIONES" : $reg[$i]['observaciones']); ?></td>

<td><?php if($reg[$i]['cocinero']== '0') { echo "<span class='label label-success'><i class='fa fa-check'></i> ENTREGADA</span>"; } else { echo "<span class='label label-danger'><i class='fa fa-times'></i> PENDIENTE</span>"; } ?></td>
                                               <td>
<a href="#" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="left" title="" data-original-title="Realizar Entrega" onClick="EntregarPedidos('<?php echo base64_encode($reg[$i]["codventa"]) ?>','<?php echo base64_encode($reg[$i]['nombresala']); ?>','<?php echo base64_encode($reg[$i]['nombremesa']); ?>','<?php echo base64_encode("ENTREGASPEDIDOS") ?>','<?php echo $numComanda; ?>')"><i class="fa fa-refresh"></i></a>
</td>
                                               </tr>
                                               <?php } } ?>
                                               </tbody>
</table></div></div>
 
<?php  }
############################ MUESTRA PEDIDOS DE PLATOS EN MOSTRADOR ###########################
?>
























<?php 
############################# BUSCA CLIENTES PARA VENTAS ###########################
if (isset($_GET['BuscaClientes']) && isset($_GET['buscacliente'])) {

  $busqueda = $_GET['buscacliente'];
  
  ?>

<hr><div id="div1"><div class="table-responsive" data-pattern="priority-columns">
                  <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                                 <thead>
                         <tr role="row">
                          <th>N&deg;</th>
                          <th>Nit de Cliente</th>
                          <th>Nombres de Cliente</th>
                          <th>N&deg; de Tel&eacute;fono</th>
                          <th>Direcci&oacute;n</th>
                          <th>Agregar</th>
                         </tr>
                         </thead>
                         <tbody>
<?php 
$cliente = new Login();
$reg = $cliente->BusquedaClientes();
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                                               <tr role="row" class="odd">
                         <td class="sorting_1" tabindex="0"><?php echo $a++; ?></td>
                         <td><?php echo $reg[$i]['cedcliente']; ?></td>
                         <td><?php echo $reg[$i]['nomcliente']; ?></td>
                         <td><?php echo $reg[$i]['tlfcliente']; ?></td>
                         <td><?php echo $reg[$i]['direccliente']; ?></td>
                         <td> 
<img src="assets/images/carrito.png" style="cursor: pointer;" data-dismiss="modal" width="48" height="42" title="Agregar Cliente" onClick="AgregaCliente('<?php echo $reg[$i]['codcliente']; ?>','<?php echo $reg[$i]['cedcliente']; ?>','<?php echo $reg[$i]['nomcliente']; ?>','<?php echo $reg[$i]['direccliente']; ?>');">
</td>
                         </tr>
                         <?php  }  ?>
                         </tbody>
</table></div><hr>
    <?php 
  }
############################# BUSCA CLIENTES PARA VENTAS ###########################
?>


<?php
####################### MUESTRA FORMULARIO PARA RESERVAR MESAS PARA VENTAS ####################
if (isset($_GET['BuscaMesaReservas']) && isset($_GET['codmesa'])) {

$arqueoCheck = new Login();
if (!$arqueoCheck->TieneArqueoAbiertoParaVentas()) {
	echo $arqueoCheck->MensajeSinArqueoVentas();
	exit;
}

$arqueo = new Login();
$arqueo = $arqueo->VerificaVentas(); 

$cajero = new Login();
$cajero = $cajero->CajerosSessionPorId(); 

?>

<div class="mesa-detalle-reserva" style="margin-top:12px;">

<div id="delete-detalle"></div>

<?php if($arqueo != "") { ?>
<div class="panel panel-default">
    <div class="panel-heading"><h3 class="panel-title"><i class="fa fa-check"></i> Pedido confirmado</h3></div>
    <div class="panel-body" style="padding:8px;">
    <div id="cargadetallesproductos"><table class="table table-small-font table-striped">
        <thead>
    <tr>
<th style="background:#01ba9a;color:#FFFFFF;" colspan=4><div align="center">Productos Agregados (cuenta de la mesa)</div></th>
          </tr>
        </thead>
        <tbody>
 <?php 
$ultimoPedido = null;
for($i=0;$i<sizeof($arqueo);$i++){
    $numPedido = isset($arqueo[$i]['numerocomanda']) ? (int) $arqueo[$i]['numerocomanda'] : 0;
    if ($numPedido > 0 && $numPedido !== $ultimoPedido) {
        $ultimoPedido = $numPedido;
?>
          <tr>
            <td colspan="4" style="background:#f5f5f5;"><strong>Pedido #<?php echo $numPedido; ?></strong></td>
          </tr>
<?php
    }
?>
          <tr>
            <td><?php echo $arqueo[$i]['cantventa'] ?></td>
            <td><?php echo $arqueo[$i]['producto'] ?></td>
            <td><?php echo "<strong>".$con[0]['simbolo']."</strong>".$arqueo[$i]['importe'] ?></td>
<td><button type="button" class="btn btn-danger btn-xs" style="cursor:pointer;" data-toggle="tooltip" data-placement="left" title="" data-original-title="Eliminar Detalle de Venta" onClick="EliminaDetalleProducto('<?php echo base64_encode($arqueo[$i]["codmesa"]) ?>','<?php echo base64_encode($arqueo[$i]["coddetalleventa"]) ?>','<?php echo base64_encode($arqueo[$i]["codventa"]) ?>','<?php echo base64_encode($arqueo[$i]["codproducto"]) ?>','<?php echo base64_encode($arqueo[$i]["cantventa"]) ?>','<?php echo base64_encode($arqueo[$i]["ivaproducto"]) ?>','<?php echo base64_encode("DETALLESVENTASPEDIDOS") ?>')"><i class="fa fa-trash-o"></i></button></td>
          </tr>
      <?php } ?>
        </tbody>
      </table>

<?php echo $observaciones = ( $arqueo[0]['observaciones'] == '' ? "" : "<strong>OBSERVACIONES: </strong><span style='font-size:12px;'>".$arqueo[0]['observaciones']."</span><br><br>"); ?>

      <table width="100%">
                        <tr>
<td colspan=3><span class="Estilo9"><label>Total a Pagar:</label></span></td>
<td><div align="right" class="Estilo9"><?php echo "<strong>".$con[0]['simbolo']."</strong>"; ?><label id="lbltotall" name="lbltotall"><?php echo $arqueo[0]['totalpago'] ?></label>
<input type="hidden" name="txtsubtotall" id="txtsubtotall" value="<?php echo $arqueo[0]['subtotalivasive'] ?>"/>
<input type="hidden" name="txtsubtotall2" id="txtsubtotall2" value="<?php echo $arqueo[0]['subtotalivanove'] ?>"/>
<input type="hidden" name="txtIvaa" id="txtIvaa" value="<?php echo $arqueo[0]['totalivave'] ?>"/>
<input type="hidden" name="txtDescuentoo" id="txtDescuentoo" value="<?php echo $arqueo[0]['totaldescuentove'] ?>"/>
<input type="hidden" name="txtTotall" id="txtTotall" value="<?php echo $arqueo[0]['totalpago'] ?>"/>
<input type="hidden" name="txtTotalCompraa" id="txtTotalCompraa" value="<?php echo $arqueo[0]['totalpago2'] ?>"/>
<input type="hidden" name="iva" id="iva" value="<?php echo $arqueo[0]['ivave'] ?>"/>
<input type="hidden" name="ivavemesa" id="ivavemesa" value="<?php echo $arqueo[0]['ivave'] ?>"/></div></td>
                        </tr>
                    </table></div>

<?php if($_SESSION["acceso"] == "administrador" || $_SESSION["acceso"] == "cajero") { ?>
  <div class="modal-footer" style="padding:8px 0 0;">
<a href="reportepdf?codventa=<?php echo base64_encode($arqueo[0]['codventa']); ?>&tipo=<?php echo base64_encode("TICKETPRECUENTA") ?>" target="_black" class="btn btn-info btn-block" title="Precuenta" ><span class="fa fa-print"></span> Precuenta</a>
<button type="submit" name="btn-cerrar" id="btn-cerrar" class="btn btn-success btn-block mostrar-mesa"><span class="fa fa-save"></span> Cerrar <?php echo $arqueo[0]['nombremesa'] ?></button>    
</div><?php } ?>

    </div>
</div>
<?php } ?>

                <div class="panel panel-primary">
                                    <div class="panel-heading">
               <h3 class="panel-title"><i class="fa fa-file-pdf-o"></i> Detalles de Factura</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-12 col-xs-12">
                                                <div class="box-body">


<div class="row"> 
  <div class="col-md-12"> 
    <div class="form-group has-feedback"> 
<strong style="color:#990000; font-size:17px;"><?php echo $arqueo[0]['nombresala']; ?></strong><br> 
<strong style="color:#990000; font-size:17px;"><?php echo $arqueo[0]['nombremesa']; ?></strong>

<input type="hidden" name="codventa" id="codventa" value="<?php echo $arqueo[0]['codventa'] ?>">
<input type="hidden" name="codmesa" id="codmesa" value="<?php echo $arqueo[0]['codmesa'] ?>">
<input type="hidden" name="codcaja" id="codcaja" value="<?php echo $cajero[0]['codcaja'] ?>">
<input type="hidden" name="nombremesa" id="nombremesa" value="<?php echo $arqueo[0]['nombremesa'] ?>">
<input type="hidden" name="cliente" id="cliente" value="<?php echo isset($arqueo[0]['cliente']) && $arqueo[0]['cliente'] !== '' ? $arqueo[0]['cliente'] : '0'; ?>">
<input type="hidden" name="tipo" id="tipo" value="0">
    </div> 
  </div>
</div>


<div class="row"> 
  <div class="col-md-12"> 
    <div class="form-group has-feedback"> 
<label for="field-6" class="control-label">B&uacute;squeda de Cliente: <span class="symbol required"></span></label>
      <div class="input-group">
  <input type="text" id="busquedacliente" name="busquedacliente" class="form-control" placeholder="B&uacute;squeda del Cliente" value="<?php echo $cliente = ( $arqueo[0]['cliente'] == '0' ? "" : $arqueo[0]['cedcliente'].": ".$arqueo[0]['nomcliente']); ?>">
    <span class="input-group-btn">
   <button type="button" class="btn waves-effect waves-light btn-primary" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false"><i class="fa fa-user-plus"></i></button></span>
              </div>
    </div>
  </div>
</div>

<div class="row"> 
  <div class="col-md-12"> 
    <div class="form-group has-feedback"> 
      <label class="control-label">Mesero: <span class="symbol required"></span></label><br>
      <?php echo $_SESSION["nombres"] ?> 
    </div> 
  </div>
</div>



<div class="row"> 
                           <div class="col-md-12"> 
                               <div class="form-group has-feedback"> 
          <label class="control-label">Comprobante: <span class="symbol required"></span></label>
            <i class="fa fa-bars form-control-feedback"></i>
<select name="comprobante" id="comprobante" class="form-control"  required="" aria-required="true" style="border: 2px solid #bd2f49;">
                <option value="">SELECCIONE</option>
              <option selected="selected" value="3">TICKET</option>
              <option value="1">BOLETA</option>
              <option value="2">FACTURA</option>
              </select> 
                              </div> 
                        </div>
 </div>


<div class="row"> 
                    <div class="col-md-12"> 
                               <div class="form-group has-feedback"> 
             <label class="control-label">Descuento: <span class="symbol required"></span></label>
<input class="form-control calculodescuentove" type="text" name="descuento" id="descuento" onKeyUp="this.value=this.value.toUpperCase();" onKeyPress="EvaluateText('%f', this);" onBlur="this.value = NumberFormat(this.value, '2', '.', '')" autocomplete="off" placeholder="Ingrese Descuento en Venta" value="<?php echo $arqueo[0]['descuentove']; ?>" required="required">
                        <i class="fa fa-minus-circle form-control-feedback"></i> 
                              </div> 
                        </div>
</div>

<div class="row"> 
                           <div class="col-md-12"> 
                               <div class="form-group has-feedback"> 
          <label class="control-label">Tipo de Pago: <span class="symbol required"></span></label>
            <i class="fa fa-bars form-control-feedback"></i>
<select name="tipopagove" id="tipopagove" class="form-control" onChange="BuscaFormaPagosVenta()" required="" aria-required="true">
                <option value="">SELECCIONE</option>
              <option selected="selected" value="CONTADO">CONTADO</option>
              <option value="CREDITO">CR&Eacute;DITO</option>
              </select> 
                              </div> 
                        </div>
 </div>

<div id="muestraformapagoventas"><div class="row"> 
                           <div class="col-md-12"> 
                               <div class="form-group has-feedback"> 
       <label class="control-label">Medio de Pago: <span class="symbol required"></span></label>
            <i class="fa fa-bars form-control-feedback"></i>
<select name="formapagove" id="formapagove" class="form-control" onChange="MuestraCambiosVentas()" required="" aria-required="true">
                <option value="">SELECCIONE</option>
      <?php
      $pago = new Login();
      $pago = $pago->ListarMediosPagos();
      for($i=0;$i<sizeof($pago);$i++){
                  ?>
<option value="<?php echo $pago[$i]['codmediopago'] ?>"<?php if (!(strcmp($pago[$i]['mediopago'], htmlentities("EFECTIVO")))) {echo "selected=\"selected\"";} ?>><?php echo $pago[$i]['mediopago'] ?></option>        
                      <?php } ?> </select> 
                              </div> 
                        </div>
                    </div></div>
 
 <div id="muestracambiospagos"><div class="row"> 
  <div class="col-md-12"> 
    <div class="form-group has-feedback"> 
      <label class="control-label">Monto Pagado: <span class="symbol required"></span></label>
<input class="form-control number calculodevolucion" type="text" name="montopagado" id="montopagado" onKeyPress="EvaluateText('%f', this);" onBlur="this.value = NumberFormat(this.value, '2', '.', '')" onKeyUp="this.value=this.value.toUpperCase();" value="<?php echo $arqueo[0]['totalpago'] ?>" autocomplete="off" placeholder="Ingrese Monto Pagado por Cliente" required="" aria-required="true"> 
                        <i class="fa fa-usd form-control-feedback"></i>
    </div> 
  </div>
</div>

<div class="row"> 
  <div class="col-md-12"> 
     <div class="form-group has-feedback"> 
      <label class="control-label">Cambio Devuelto: <span class="symbol required"></span></label>
<input class="form-control number" type="text" name="montodevuelto" id="montodevuelto" onKeyPress="EvaluateText('%f', this);" onBlur="this.value = NumberFormat(this.value, '2', '.', '')" onKeyUp="this.value=this.value.toUpperCase();" value="0.00" autocomplete="off" placeholder="Ingrese Cambio Devuelto a Cliente"  aria-required="true"> 
                        <i class="fa fa-usd form-control-feedback"></i>
      </div> 
  </div>
</div>

<div class="modal-footer"> 
<button type="button" id="mostrar-mesa" class="btn btn-warning btn-block"><span class="fa fa-cutlery"></span> Mostrar Mesas</button>   
          </div>

</div>
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

</div><!-- mesa-detalle-reserva -->

<?php
}
####################### MUESTRA FORMULARIO PARA RESERVAR MESAS PARA VENTAS ####################
?>

<?php 
############################# MUESTRA FORMA DE PAGO PARA VENTAS ###########################
if (isset($_GET['BuscaFormaPagoVentas']) && isset($_GET['tipopagove'])) { 
  
 if($_GET['tipopagove']==""){
 
 } elseif($_GET['tipopagove']=="CONTADO"){  ?>
 
     <div class="row"> 
                           <div class="col-md-12"> 
                               <div class="form-group has-feedback"> 
      <label class="control-label">Medio de Pago venta: <span class="symbol required"></span></label>
            <i class="fa fa-bars form-control-feedback"></i>
<select name="formapagove" id="formapagove" class="form-control" onChange="MuestraCambiosVentas()" required="" aria-required="true">
                <option value="">SELECCIONE</option>
      <?php
      $pago = new Login();
      $pago = $pago->ListarMediosPagos();
      for($i=0;$i<sizeof($pago);$i++){
                  ?>
            <option value="<?php echo $pago[$i]['codmediopago'] ?>"><?php echo $pago[$i]['mediopago'] ?></option>       
                      <?php } ?> </select> 
                              </div> 
                        </div>
                    </div>
          
 <?php   } else if($_GET['tipopagove']=="CREDITO"){  ?>
 
 <div class="row"> 
  <div class="col-md-12"> 
    <div class="form-group has-feedback"> 
      <label for="field-6" class="control-label">Fecha Vence Cr&eacute;dito: <span class="symbol required"></span></label>
   <input class="form-control calendario" type="text" name="fechavencecredito" id="fechavencecredito" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Fecha Vence Cr&eacute;dito" required="required"> 
                        <i class="fa fa-calendar form-control-feedback"></i>
    </div> 
  </div>
</div>

 <div class="row"> 
  <div class="col-md-12"> 
    <div class="form-group has-feedback"> 
      <label for="field-6" class="control-label">Monto de Abono: <span class="symbol required"></span></label>
    <input class="form-control number" type="text" name="montoabono" id="montoabono" onKeyPress="EvaluateText('%f', this);" onBlur="this.value = NumberFormat(this.value, '2', '.', '')" onKeyUp="this.value=this.value.toUpperCase();" value="0.00" autocomplete="off" placeholder="Ingrese Monto de Abono" required="" aria-required="true"> 
                        <i class="fa fa-calendar form-control-feedback"></i>
    </div> 
  </div>
</div>

<?php  }
  }
############################# MUESTRA FORMA DE PAGO PARA VENTAS ###########################
?>

<?php 
############################# MUESTRA CAMBIO DE VUELTO PARA VENTAS ###########################
if (isset($_GET['MuestraCambiosVentas']) && isset($_GET['tipopagove']) && isset($_GET['formapagove'])) { 

$reg = $tra->MediosPagosId();
  
 if($_GET['tipopagove']=="CONTADO" && $reg[0]['mediopago']=="EFECTIVO"){  ?>

<div class="row"> 
  <div class="col-md-12"> 
    <div class="form-group has-feedback"> 
      <label for="field-6" class="control-label">Monto Pagado : <span class="symbol required"></span></label>
<input class="form-control number calculodevolucion" type="text" name="montopagado" id="montopagado" onKeyPress="EvaluateText('%f', this);" onBlur="this.value = NumberFormat(this.value, '2', '.', '')" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Monto Pagado por Cliente" required="" aria-required="true"> 
                        <i class="fa fa-usd form-control-feedback"></i>
    </div> 
  </div>
</div>

<div class="row"> 
  <div class="col-md-12"> 
    <div class="form-group has-feedback"> 
      <label for="field-6" class="control-label">Cambio Devuelto: <span class="symbol required"></span></label>
<input class="form-control number" type="text" name="montodevuelto" id="montodevuelto" onKeyPress="EvaluateText('%f', this);" onBlur="this.value = NumberFormat(this.value, '2', '.', '')" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Cambio Devuelto a Cliente" value="0.00" aria-required="true"> 
                        <i class="fa fa-usd form-control-feedback"></i>
    </div> 
  </div>
</div>

<?php  
      }
 }
############################# MUESTRA CAMBIO DE VUELTO PARA VENTAS ###########################
?>

<?php
############################# MUESTRA DETALLES DE PRODUCTOS EN PEDIDOS ########################
if (isset($_GET['CargaDetallesProductos']) && isset($_GET['codmesa'])) {

$arqueo = new Login();
$arqueo = $arqueo->VerificaVentas(); ?>

<table class="table table-small-font table-striped">
        <thead>
    <tr>
<th style="background:#01ba9a;color:#FFFFFF;" colspan=4><h3 class="panel-title"><div align="center">Productos Agregados</div></th>
            </th>
          </tr>
        </thead>
        <tbody>
 <?php 
for($i=0;$i<sizeof($arqueo);$i++){
?>
          <tr>
            <td><?php echo $arqueo[$i]['cantventa'] ?></td>
            <td><?php echo $arqueo[$i]['producto'] ?></td>
            <td><?php echo "<strong>".$con[0]['simbolo']."</strong>".$arqueo[$i]['importe'] ?></td>
<td><button type="button" class="btn btn-danger btn-xs" style="cursor:pointer;" data-toggle="tooltip" data-placement="left" title="" data-original-title="Eliminar Detalle de Venta" onClick="EliminaDetalleProducto('<?php echo base64_encode($arqueo[$i]["codmesa"]) ?>','<?php echo base64_encode($arqueo[$i]["coddetalleventa"]) ?>','<?php echo base64_encode($arqueo[$i]["codventa"]) ?>','<?php echo base64_encode($arqueo[$i]["codproducto"]) ?>','<?php echo base64_encode($arqueo[$i]["cantventa"]) ?>','<?php echo base64_encode($arqueo[$i]["ivaproducto"]) ?>','<?php echo base64_encode("DETALLESVENTASPEDIDOS") ?>')"><i class="fa fa-trash-o"></i></button></td>
          </tr>
      <?php } ?>
        </tbody>
      </table> 

<?php echo $observaciones = ( $arqueo[0]['observaciones'] == '' ? "" : "<strong>OBSERVACIONES: </strong><span style='font-size:12px;'>".$arqueo[0]['observaciones']."</span><br><br>"); ?>

      <table width="250">
                        <tr>
<td colspan=3><span class="Estilo9"><label>Subtotal IGV <?php echo $con[0]['ivav'] ?>%:</label></span></td>
<td><div align="right" class="Estilo9"><?php echo "<strong>".$con[0]['simbolo']."</strong>"; ?><label><?php echo $arqueo[0]['subtotalivasive'] ?></label><input type="hidden" name="txtsubtotall" id="txtsubtotall" value="<?php echo $arqueo[0]['subtotalivasive'] ?>"/></div></td>
                        </tr>
                        <tr>
<td colspan=3><span class="Estilo9"><label>Subtotal IGV 0%:</label></span></td>
<td><div align="right" class="Estilo9"><?php echo "<strong>".$con[0]['simbolo']."</strong>"; ?><label><?php echo $arqueo[0]['subtotalivanove'] ?></label><input type="hidden" name="txtsubtotall2" id="txtsubtotall2" value="<?php echo $arqueo[0]['subtotalivanove'] ?>"/></div></td>
                        </tr>
                        <tr>
<td colspan=3><span class="Estilo9"><label>IGV <?php echo $arqueo[0]['ivave'] ?>%<input name="iva" id="iva" type="hidden" value="<?php echo $arqueo[0]['ivave'] ?>"  /></label></span></td>
<td><div align="right" class="Estilo9"><?php echo "<strong>".$con[0]['simbolo']."</strong>"; ?><label><?php echo $arqueo[0]['totalivave'] ?></label><input type="hidden" name="txtIvaa" id="txtIvaa" value="<?php echo $arqueo[0]['totalivave'] ?>"/></div></td>
                        </tr>
                        <tr>
<td colspan=3><span class="Estilo9"><label>Descuento:</label></span></td>
<td><div align="right" class="Estilo9"><?php echo "<strong>".$con[0]['simbolo']."</strong>"; ?><label id="lbldescuentoo" name="lbldescuentoo"><?php echo $arqueo[0]['totaldescuentove'] ?></label><input type="hidden" name="txtDescuentoo" id="txtDescuentoo" value="<?php echo $arqueo[0]['totaldescuentove'] ?>"/></div></td>
                        </tr>
                        <tr>
<td colspan=3><span class="Estilo9"><label>Total:</label></span></td>
<td><div align="right" class="Estilo9"><?php echo "<strong>".$con[0]['simbolo']."</strong>"; ?><label id="lbltotall" name="lbltotall"><?php echo $arqueo[0]['totalpago'] ?></label><input type="hidden" name="txtTotall" id="txtTotall" value="<?php echo $arqueo[0]['totalpago'] ?>"/>
<input type="hidden" name="txtTotalCompraa" id="txtTotalCompraa" value="<?php echo $arqueo[0]['totalpago2'] ?>"/></div></td>
                        </tr>
                    </table>

<?php
}
############################# MUESTRA DETALLES DE PRODUCTOS EN PEDIDOS ########################
?>



<?php
############################# BUSQUEDA DE VENTAS ############################
if (isset($_GET['BuscarVentas']) && isset($_GET['tipobusqueda']) && isset($_GET['codcliente']) && isset($_GET['codcaja']) && isset($_GET['fecha'])) { 

  $tipobusqueda = $_GET['tipobusqueda'];
  $codcliente = $_GET['codcliente'];
  $codcaja = $_GET['codcaja'];
  $fecha = $_GET['fecha'];


  if($tipobusqueda=="") {

   echo "<center><div class='alert alert-danger'>";
   echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
   echo "<span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE TIPO DE B&Uacute;SQUEDA</div></center>";
   exit;
    
} else if($tipobusqueda=="1" && $codcliente=="") {

   echo "<center><div class='alert alert-danger'>";
   echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
   echo "<span class='fa fa-info-circle'></span> POR FAVOR INGRESE CLIENTE PARA TU B&Uacute;SQUEDA</div></center>";
   exit;
    
} else if($tipobusqueda=="2" && $codcaja=="") {

   echo "<center><div class='alert alert-danger'>";
   echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
   echo "<span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE CAJA PARA TU B&Uacute;SQUEDA</div></center>";
   exit;
    
} else if($tipobusqueda=="3" && $fecha=="") {

   echo "<center><div class='alert alert-danger'>";
   echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
   echo "<span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA PARA TU B&Uacute;SQUEDA</div></center>";
   exit;
    
} else {

  $venta = new Login();
  $reg = $venta->BusquedaVentas();
  ?>
  
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-tasks"></i> Ventas <?php if($tipobusqueda=="1") { echo "del Cliente ".$reg[0]['nomcliente']; } 
  else if($tipobusqueda=="2") { echo "de Caja N&deg; ".$reg[0]['nrocaja']." : ".$reg[0]['nombrecaja']; } 
  else { echo "de Fecha ".$fecha; } ?> </h3></div>
<div class="panel-body">
      
<div class="row">
       <div class="col-sm-12 col-xs-12"> 
                            <div class="box-body">
                                <div class="row"> 
                                <div class="col-md-12"> 
                               
<div id="div1"><div class="table-responsive" data-pattern="priority-columns">
                <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                                 <thead>
                         <tr role="row">
                                  <th>N&deg;</th>
                                  <th>N&deg; de Venta</th>
                                  <th>N&deg; Caja</th>
                                  <th>Clientes</th>
                                  <th>Subtotal Con IGV %</th>
                                  <th>Subtotal IGV 0%</th>
                                  <th>IGV</th>
                                  <th>Total</th>
                                  <th>Acciones</th>
                              </tr>
                         </thead>
                         <tbody>
<?php 
if($reg==""){

    echo "";      
    
} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                         <tr role="row" class="odd">
                  <td class="sorting_1" tabindex="0"><?php echo $a++; ?></td>
                  <td><?php echo $reg[$i]['codventa']; ?></td>
<td><?php echo $caja = ( $reg[$i]['codcaja'] == '0' ? "<span class='label label-warning'> SIN COBRAR</span>" : $reg[$i]['nrocaja']); ?></td>
<td><?php echo $cliente = ( $reg[$i]['codcliente'] == '0' ? "CONSUMIDOR FINAL" : $reg[$i]['nomcliente']); ?></td>
                    <td><?php echo $simbolo.number_format($reg[$i]['subtotalivasive'], 2, '.', ','); ?></td>
                    <td><?php echo $simbolo.number_format($reg[$i]['subtotalivanove'], 2, '.', ','); ?></td>
                    <td><?php echo $simbolo.number_format($reg[$i]['totalivave'], 2, '.', ','); ?></td>
                    <td><?php echo $simbolo.number_format($reg[$i]['totalpago'], 2, '.', ','); ?></td>
                         <td>
<a href="#" class="btn btn-success btn-xs" onClick="VerVentas('<?php echo base64_encode($reg[$i]['codventa']) ?>')" data-href="#" data-toggle="modal" data-target=".bs-example-modal-lg" data-placement="left" data-backdrop="static" data-keyboard="false" data-id="" rel="tooltip" title="Ver Venta"><i class="fa fa-search-plus"></i></a>

<a href="reportepdf?codventa=<?php echo base64_encode($reg[$i]['codventa']); ?>&tipo=<?php echo base64_encode("TICKET") ?>" target="_black" rel="noopener noreferrer" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="left" title="" data-original-title="Ticket de Venta"><i class="fa fa-print"></i></a>
</td>
                         </tr>
                         <?php } } ?>
                         </tbody>
</table>
</div><br />                 
                                             </div>
                                         </div>
                                     </div>  
                                 </div>
                             </div><!-- /.box-body -->
                         </div>
                    </div>
               </div>
          </div>
   
  <?php
  
   }
 } 
############################# BUSQUEDA DE VENTAS ############################
?>


<?php
############################# MOSTRAR VENTAS EN VENTANA MODAL #############################
if (isset($_GET['BuscaVentasModal']) && isset($_GET['codventa'])) { 

$codventa = $_GET['codventa'];

$tra = new Login(); 
$ve = $tra->VentasPorId();
?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="pull-right">
                         <address>
<abbr title="N? de Venta"><strong>N&deg; DE VENTA: </strong> <?php echo $ve[0]["codventa"]; ?></abbr><br>
<abbr title="N&deg; de Caja"><strong>N&deg; DE CAJA: </strong> <?php echo $caja = ( $ve[0]['codcaja'] == '0' ? "<span class='label label-warning'> SIN COBRAR</span>" : $ve[0]["nrocaja"]); ?></abbr><br>
        
<?php if($ve[0]["cliente"]=='0'){ ?>
<abbr title="Nombre de Cliente"><strong> CLIENTE: </strong> CONSUMIDOR FINAL</abbr><br>
<?php }  else { ?>
<abbr title="Nombre de Cliente"><strong><?php echo $ve[0]["cedcliente"].": ".$ve[0]["nomcliente"]; ?></strong></abbr><br>
<abbr title="Direcci&oacute;n de Cliente"><?php echo $ve[0]["direccliente"]; ?></abbr><br>
<abbr title="Email de Cliente"><strong>EMAIL: </strong> <?php echo $ve[0]["emailcliente"]; ?></abbr><br>
<abbr title="Telefono"><strong>N&deg; DE TLF:</strong></abbr> <?php echo $ve[0]["tlfcliente"]; ?><br />
<?php } ?>
<abbr title="Tipo de Pago"><strong>TIPO DE PAGO:</strong></abbr> <?php echo "<span class='label label-success'>".$ve[0]["tipopagove"]."</span>"; ?><br />
        
<abbr title="Forma de Pago"><strong>MEDIO DE PAGO:</strong></abbr><?php if($ve[0]['tipopagove'] == 'CONTADO') { echo "<span class='label label-success'>".$ve[0]["mediopago"]."</span>"; } else { echo "<span class='label label-warning'>".$ve[0]["formapagove"]."</span>"; } ?><br />


<abbr title="Fecha de Vencimiento de Cr&eacute;dito"><strong>FECHA DE VENCIMIENTO:</strong></abbr> <?php echo $vence = ( $ve[0]['fechavencecredito'] == '0000-00-00' ? "0" : date("d-m-Y",strtotime($ve[0]['fechavencecredito']))); ?><br />
<abbr title="Dias Vencidos de Cr&eacute;dito"><strong>DIAS VENCIDOS:</strong></abbr> <?php 
if($ve[0]['fechavencecredito']== '0000-00-00') { echo "0"; } 
elseif($ve[0]['fechavencecredito'] >= date("Y-m-d")) { echo "0"; } 
elseif($ve[0]['fechavencecredito'] < date("Y-m-d")) { echo Dias_Transcurridos(date("Y-m-d"),$ve[0]['fechavencecredito']); } ?><br />
<abbr title="Fecha de Venta"><strong>FECHA DE VENTA:</strong></abbr> <?php echo date("d-m-Y h:i:s",strtotime($ve[0]['fechaventa'])); ?><br />
<abbr title="Status de Venta"><strong>STATUS DE VENTA:</strong></abbr> <?php 
if($ve[0]['fechavencecredito']== '0000-00-00') { echo "<span class='label label-success'>".$ve[0]["statusventa"]."</span>"; } 
elseif($ve[0]['fechavencecredito'] >= date("Y-m-d")) { echo "<span class='label label-success'>".$ve[0]["statusventa"]."</span>"; } 
elseif($ve[0]['fechavencecredito'] < date("Y-m-d")) { echo "<span class='label label-danger'>VENCIDA</span>"; } ?>
                                                  </address>
                                                </div>
                                            </div>
                                        </div>                      
                       
                       
                       
  <div class="table-responsive" data-pattern="priority-columns">
                                            <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                                        <thead>
                                                            <tr>
                                                            <th>C&oacute;digo</th>
                                                            <th>Descripci&oacute;n de Producto</th>
                              <th>Categoria</th>
                              <th>Costo</th>
                              <th>Cantidad</th>
                              <th>Importe</th>
                                                            </tr>
                            </thead>
                                                        <tbody>
 <?php 
$tru = new Login();
$busq = $tru->VerDetallesVentas();
for($i=0;$i<sizeof($busq);$i++){
$cantidad=$busq[$i]["cantventa"];
$importe=$busq[$i]["precioventa"]*$cantidad;
?>
                             <tr>
                  <td><?php echo $busq[$i]["codproducto"]; ?></td>
                  <td><?php echo $busq[$i]["producto"]; ?></td>
                  <td><?php echo $busq[$i]["nomcategoria"]; ?></td>
                  <td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($busq[$i]["precioventa"], 2, '.', ','); ?></td>
                  <td><?php echo $busq[$i]["cantventa"]; ?></td>
                  <td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($importe, 2, '.', ','); ?></td>
                                                          </tr>
                              <?php } ?>
                             <tr>
                               <td colspan="3" rowspan="5">&nbsp;</td>
<td colspan="2"><div align="right"><strong>SubTotal IGV <?php echo $ve[0]["ivave"]."(%)"; ?>:</strong></div></td>
<td><div align="right"><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($ve[0]["subtotalivasive"], 2, '.', ','); ?></div></td>
                            </tr>
                               <tr>
<td colspan="2"><div align="right"><strong>SubTotal IGV 0%:</strong></div></td>
<td><div align="right"><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($ve[0]["subtotalivanove"], 2, '.', ','); ?></div></td>
                            </tr>
                              <tr>
<td colspan="2"><div align="right"><strong>IGV <?php echo $ve[0]["ivave"]."(%)"; ?>:</strong></div></td>
<td><div align="right"><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($ve[0]["totalivave"], 2, '.', ','); ?></div></td>
                                </tr>
                              <tr>
<td colspan="2"><div align="right"><strong>Descuento <?php echo $ve[0]["descuentove"]."(%)"; ?>:</strong></div></td>
<td><div align="right"><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($ve[0]["totaldescuentove"], 2, '.', ','); ?></div></td>
                                </tr>
                              <tr>
<td colspan="2"><div align="right"><strong>Total Pago :</strong></div></td>
<td><div align="right"><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($ve[0]["totalpago"], 2, '.', ','); ?></div></td>
                                </tr>
                                                        </tbody>
</table></div>
<?php
}
############################# MOSTRAR VENTAS EN VENTANA MODAL #############################
?>


<?php 
############################# MUESTRA CANTIDAD VENTA DB #############################################
if (isset($_GET['muestracantventadb']) && isset($_GET['coddetalleventa'])) {
  
$tra = new Login();
$reg = $tra->DetallesVentasPorId();

  ?>
<input type="hidden" name="cantidadventadb" id="cantidadventadb" value="<?php echo $reg[0]['cantventa']; ?>">
<?php 
  }
############################# MUESTRA CANTIDAD VENTA DB #############################################
?>

<?php
############################# BUSQUEDA DE DETALLES DE VENTAS #############################
if (isset($_GET['BuscarDetallesVentas']) && isset($_GET['tipobusquedad']) && isset($_GET['codventa']) && isset($_GET['codcaja']) && isset($_GET['fecha'])) { 

  $tipobusquedad = $_GET['tipobusquedad'];
  $codventa = $_GET['codventa'];
  $codcaja = $_GET['codcaja'];
  $fecha = $_GET['fecha'];


  if($tipobusquedad=="") {

   echo "<center><div class='alert alert-danger'>";
   echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
   echo "<span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE TIPO DE B&Uacute;SQUEDA</div></center>";
   exit;
    
} else if($tipobusquedad=="1" && $codventa=="") {

   echo "<center><div class='alert alert-danger'>";
   echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
   echo "<span class='fa fa-info-circle'></span> POR FAVOR INGRESE N? DE FACTURA PARA TU B&Uacute;SQUEDA</div></center>";
   exit;
    
} else if($tipobusquedad=="2" && $codcaja=="") {

   echo "<center><div class='alert alert-danger'>";
   echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
   echo "<span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE CAJA PARA TU B&Uacute;SQUEDA</div></center>";
   exit;
    
} else if($tipobusquedad=="3" && $fecha=="") {

   echo "<center><div class='alert alert-danger'>";
   echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
   echo "<span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA PARA TU B&Uacute;SQUEDA</div></center>";
   exit;
    
} else {

  $venta = new Login();
  $reg = $venta->BusquedaDetallesVentas();
  ?>
  
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-tasks"></i> Detalles de Ventas <?php if($tipobusquedad=="1") { echo "de Factura N&deg; ".$reg[0]['codventa']; } 
  else if($tipobusquedad=="2") { echo "de Caja N&deg; ".$reg[0]['nrocaja']." : ".$reg[0]['nombrecaja']; } 
  else { echo "de Fecha ".$fecha; } ?> </h3></div>
<div class="panel-body">
      
<div class="row">
       <div class="col-sm-12 col-xs-12"> 
                            <div class="box-body">
                                <div class="row"> 
                                <div class="col-md-12"> 
                               
<div id="div1"><div class="table-responsive" data-pattern="priority-columns">
                <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                                 <thead>
                         <tr>
                                  <th>N&deg;</th>
                                  <th>N&deg; de Venta</th>
                                  <th>Descripci&oacute;n de Producto</th>
                                  <th>Categoria</th>
                                  <th>Precio</th>
                                  <th>Cantidad</th>
                                  <th>Acciones</th>
                              </tr>
                         </thead>
                         <tbody>
<?php
if($reg==""){

    echo "";      
    
} else {
 
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                         <tr>
                    <td><?php echo $a++; ?></td>
                    <td><?php echo $reg[$i]['codventa']; ?></td>
<td><abbr title="<?php echo "N&deg; ".$reg[$i]['codproducto']; ?>"><?php echo $reg[$i]['producto']; ?></abbr></td>
                    <td><?php echo $reg[$i]['nomcategoria']; ?></td>
                    <td><?php echo $simbolo.number_format($reg[$i]['precioventa'], 2, '.', ','); ?></td>
                    <td><?php echo $reg[$i]['cantventa']; ?></td>
<td><a href="#" class="btn btn-success btn-xs" data-placement="left" title="Ver" data-original-title="" data-href="#" data-toggle="modal" data-target="#panel-modal" data-backdrop="static" data-keyboard="false" onClick="VerDetalleVentas('<?php echo base64_encode($reg[$i]["coddetalleventa"]); ?>')"><i class="fa fa-search-plus"></i></a>

<a class="btn btn-primary btn-xs" title="Editar" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false" onClick="CargaDetalleVenta('<?php echo $reg[$i]["coddetalleventa"]; ?>','<?php echo $reg[$i]["idventa"]; ?>','<?php echo $reg[$i]["ivaproducto"]; ?>','<?php echo $reg[$i]["codventa"]; ?>','<?php echo $reg[$i]["codproducto"]; ?>','<?php echo $reg[$i]["producto"]; ?>','<?php echo $reg[$i]["nomcategoria"]; ?>','<?php echo $reg[$i]["precioventa"]; ?>','<?php echo $reg[$i]["preciocompra"]; ?>','<?php echo $reg[$i]["cantventa"]; ?>','<?php echo $reg[$i]["importe"]; ?>','<?php echo $reg[$i]["importe2"]; ?>','<?php echo date("d-m-Y h:i:s",strtotime($reg[$i]['fechadetalleventa'])); ?>','<?php echo $tipobusquedad; ?>','<?php echo $reg[$i]["codcaja"]; ?>','<?php echo $fecha; ?>'
)"><i class="fa fa-pencil"></i></a>

<a class="btn btn-danger btn-xs" onClick="EliminarDetalleVenta('<?php echo base64_encode($reg[$i]["codmesa"]) ?>','<?php echo base64_encode($reg[$i]["coddetalleventa"]) ?>','<?php echo $reg[$i]["codcaja"] ?>','<?php echo base64_encode($reg[$i]["tipopagove"]) ?>','<?php echo $reg[$i]["idventa"]; ?>','<?php echo $reg[$i]["codventa"] ?>','<?php echo base64_encode($reg[$i]["codcliente"]) ?>','<?php echo base64_encode($reg[$i]["codproducto"]) ?>','<?php echo base64_encode($reg[$i]["cantventa"]) ?>','<?php echo base64_encode($reg[$i]["precioventa"]) ?>','<?php echo base64_encode($reg[$i]["ivaproducto"]) ?>','<?php echo base64_encode("DETALLESVENTAS") ?>','<?php echo $tipobusquedad; ?>','<?php echo $fecha; ?>')" title="Eliminar" ><i class="fa fa-trash-o"></i></a>

                              </tr>
                         <?php } } ?>
                   </tbody>
</table></div><br />                 
                                             </div>
                                         </div>
                                     </div>  
                                 </div>
                             </div><!-- /.box-body -->
                         </div>
                    </div>
               </div>
          </div>
  <?php
  
   }
 } 
############################# BUSQUEDA DE DETALLES DE VENTAS #############################
?>


<?php
############################# MOSTRAR DETALLE DE VENTA EN VENTANA MODAL ###########################
if (isset($_GET['BuscaDetallesVentasModal']) && isset($_GET['coddetalleventa'])) { 

$reg = $tra->DetallesVentasPorId();
?>
<div class="row">
  <table border="0" align="center" >
   
   <?php if($reg[0]['cliente']!='0'){ ?>
    <tr>
      <td><strong>C&eacute;dula de Cliente: </strong><?php echo $reg[0]['cedcliente']; ?></td>
    </tr>
    <tr>
    <td><strong>Nombre de Cliente:</strong> <?php echo $reg[0]['nomcliente']; ?></td>
  </tr>
  <?php } ?>
  
   <tr>
    <td><strong>C&oacute;digo de Producto:</strong> <?php echo $reg[0]['codproducto']; ?></td>
  </tr>
  <tr>
      <td><strong>Nombre de Producto: </strong> <?php echo $reg[0]['producto']; ?></td>
    </tr>
    <tr>
      <td><strong>Categoria: </strong> <?php echo $reg[0]['nomcategoria']; ?></td>
    </tr>
    <tr>
      <td><strong>Precio Venta: </strong> <?php echo number_format($reg[0]['precioventa'], 2, '.', ','); ?></td>
    </tr>
    <tr>
      <td><strong>Cantidad Venta: </strong> <?php echo $reg[0]['cantventa']; ?></td>
    </tr>
    <tr>
      <td><strong>Tiene IGV: </strong> <?php echo $reg[0]['ivaproducto']; ?></td>
    </tr>
    <tr>
      <td><strong>Importe: </strong> <?php echo number_format($reg[0]['cantventa'] * $reg[0]['precioventa'], 2, '.', ','); ?></td>
    </tr>
    <tr>
      <td><strong>Fecha Venta: </strong> <?php echo date("d-m-Y h:i:s",strtotime($reg[0]['fechadetalleventa'])); ?></td>
    </tr>
  </table>
</div>
<?php
}
############################# MOSTRAR DETALLE DE VENTA EN VENTANA MODAL ###########################
?>


<?php
######################### BUSQUEDA DE VENTAS POR FECHAS Y CAJAS DE VENTAS #########################
if (isset($_GET['BuscaVentasCajas']) && isset($_GET['codcaja']) && isset($_GET['desde']) && isset($_GET['hasta'])) { 
  
     $codcaja = $_GET['codcaja'];
   $desde = $_GET['desde']; 
     $hasta = $_GET['hasta'];  

 if($codcaja=="") {

  echo "<center><div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE CAJA PARA TU B&Uacute;SQUEDA</div></center>";
   exit;
   
  } else if($desde=="") {

  echo "<center><div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA DE INICIO PARA TU B&Uacute;SQUEDA</div></center>";
   exit;
    

} else if($hasta=="") {

  echo "<center><div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA FINAL PARA TU B&Uacute;SQUEDA</div></center>";
   exit;
    
} else {

$ca = new Login();
$ca = $tra->CajerosPorId();
  ?>
              
 <div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-tasks"></i> Venta de Caja <?php echo "N&deg; ".$ca[0]['nrocaja']; ?> y Desde <?php echo $_GET["desde"]." hasta ".$_GET["hasta"]; ?></h3></div>
<div class="panel-body">
      
<div class="row">
       <div class="col-sm-12 col-xs-12"> 
                            <div class="box-body">
                                <div class="row"> 
                                <div class="col-md-12"> 
                               
  <div id="div1"><div class="table-responsive" data-pattern="priority-columns">
               <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                            <thead>
                                                <tr>
                          <th>N&deg;</th>
                          <th>N&deg; de Venta</th>
                          <th>Clientes</th>
                          <th>Fecha Venta</th>
                          <th>Subtotal Con IGV</th>
                          <th>Subtotal IGV 0%</th>
                          <th>Total IGV</th>
                          <th>Total Desc</th>
                          <th>Total</th>
                          <th>Articulos</th>
                          <th>Ticket</th>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php 
$ve = new Login();
$reg = $ve->BuscarVentasCajas();

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
                                                <tr>
                                                    <td><?php echo $a++; ?></td>
                                                       <td><?php echo $reg[$i]['codventa']; ?></td>
<td><?php if($reg[$i]['nomcliente']=="") { echo "SIN ASIGNAR"; } else { echo $reg[$i]['nomcliente']; } ?></td>
                             <td><?php echo date("d-m-Y h:i:s",strtotime($reg[$i]['fechaventa'])); ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[$i]['subtotalivasive'], 2, '.', ','); ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[$i]['subtotalivanove'], 2, '.', ','); ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[$i]['totalivave'], 2, '.', ','); ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[$i]['totaldescuentove'], 2, '.', ','); ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[$i]['totalpago'], 2, '.', ','); ?></td>
<td><?php echo $reg[$i]['articulos']; ?></td>
<td class="actions"><div align="center"><a href="reportepdf?codventa=<?php echo base64_encode($reg[$i]['codventa']); ?>&tipo=<?php echo base64_encode("TICKET") ?>" target="_black" class="btn btn-info btn-xs" title="Ticket de Venta" ><i class="fa fa-print"></i></a></div>                                            </td>
                                                </tr>
                        <?php  }  ?>
                                                <tr>
                                                  <td></td>
                                                  <td>&nbsp;</td>
                                                  <td>&nbsp;</td>
                                                  <td><strong>Total General</strong></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($Subtotalconiva, 2, '.', ','); ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($Subtotalsiniva, 2, '.', ','); ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($Totaliva, 2, '.', ','); ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($Totaldescuento, 2, '.', ','); ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($Pagototal, 2, '.', ','); ?></td>
                                                  <td><?php echo $totalarticulos; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
<div align="center"><a href="reportepdf?codcaja=<?php echo $codcaja; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo base64_encode("VENTASCAJAS") ?>" target="_blank"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-pdf-o"></span> Exportar Pdf</button></a>
                          
<a href="reporteexcel?codcaja=<?php echo $codcaja; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo base64_encode("VENTASCAJAS") ?>"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-excel-o"></span> Exportar Excel</button> </a>                   
            </div><br /></div>
                        </div>  
                    </div>
                                    </div><!-- /.box-body -->
                </div>
                          </div>
                     </div>
                </div></div>
   
  <?php
   } 
 } 
######################### BUSQUEDA DE VENTAS POR FECHAS Y CAJAS DE VENTAS #########################
?>

<?php
############################# BUSQUEDA DE VENTAS DE PRODUCTOS POR FECHAS ########################
if (isset($_GET['BuscaVentasFechas']) && isset($_GET['desde']) && isset($_GET['hasta'])) {  

     $desde = $_GET['desde']; 
     $hasta = $_GET['hasta']; 

if($desde=="") {

  echo "<center><div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA DE INICIO PARA TU B&Uacute;SQUEDA</div></center>";
   exit;
    

} else if($hasta=="") {

  echo "<center><div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA FINAL PARA TU B&Uacute;SQUEDA</div></center>";
   exit;
   
   } else {

  ?>
  
 <div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-tasks"></i> Ventas por Fechas Desde <?php echo $_GET["desde"]." hasta ".$_GET["hasta"]; ?></h3></div>
<div class="panel-body">
      
<div class="row">
       <div class="col-sm-12 col-xs-12"> 
                            <div class="box-body">
                                <div class="row"> 
                                <div class="col-md-12"> 
                               
  <div id="div1"><div class="table-responsive" data-pattern="priority-columns">
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                          <th>N&deg;</th>
                          <th>N&deg; de Venta</th>
                          <th>N&deg; de Caja</th>
                          <th>Fecha Venta</th>
                          <th>Subtotal Con IGV</th>
                          <th>Subtotal IGV 0%</th>
                          <th>Total IGV</th>
                          <th>Total Desc</th>
                          <th>Total</th>
                          <th>Articulos</th>
                          <th>Ticket</th>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php 
$ve = new Login();
$reg = $ve->BuscarVentasFechas();

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
                                                <tr>
<td><div align="center"><?php echo $a++; ?></div></td>
<td><div align="center"><?php echo $reg[$i]['codventa']; ?></div></td>
<td><div align="center"><?php echo $reg[$i]['nrocaja']; ?></div></td>
<td><div align="center"><?php echo date("d-m-Y h:i:s",strtotime($reg[$i]['fechaventa'])); ?></div></td>
<td><div align="center"><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[$i]['subtotalivasive'], 2, '.', ','); ?></div></td>
<td><div align="center"><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[$i]['subtotalivanove'], 2, '.', ','); ?></div></td>
<td><div align="center"><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[$i]['totalivave'], 2, '.', ','); ?></div></td>
<td><div align="center"><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[$i]['totaldescuentove'], 2, '.', ','); ?></div></td>
<td><div align="center"><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[$i]['totalpago'], 2, '.', ','); ?></div></td>
<td><div align="center"><?php echo $reg[$i]['articulos']; ?></div></td>
<td class="actions"><div align="center">
       <a href="reportepdf?codventa=<?php echo base64_encode($reg[$i]['codventa']); ?>&tipo=<?php echo base64_encode("TICKET") ?>" target="_black" class="btn btn-info btn-xs" title="Ticket de Venta" ><i class="fa fa-print"></i></a></div>                                            </td>
                                                </tr>
                        <?php  }  ?>
                                                <tr>
                                                  <td></td>
                                                  <td>&nbsp;</td>
                                                  <td>&nbsp;</td>
<td><div align="center"><strong>Total General</strong></div></td>
<td><div align="center"><strong><?php echo "<strong>".$con[0]['simbolo'].number_format($Subtotalconiva, 2, '.', ','); ?></strong></div></td>
<td><div align="center"><strong><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($Subtotalsiniva, 2, '.', ','); ?></strong></div></td>
<td><div align="center"><strong><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($Totaliva, 2, '.', ','); ?></strong></div></td>
<td><div align="center"><strong><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($Totaldescuento, 2, '.', ','); ?></strong></div></td>
<td><div align="center"><strong><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($Pagototal, 2, '.', ','); ?></strong></div></td>
<td><div align="center"><strong><?php echo $totalarticulos; ?></strong></div></td>
                                                </tr>
                                            </tbody>
                                        </table>
<div align="center"><a href="reportepdf?desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo base64_encode("VENTASFECHAS") ?>" target="_blank"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-pdf-o"></span> Exportar Pdf</button></a>
                          
<a href="reporteexcel?desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo base64_encode("VENTASFECHAS") ?>"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-excel-o"></span> Exportar Excel</button> </a>                    
            </div><br /></div>
                        </div>  
                    </div>
                                    </div><!-- /.box-body -->
                </div>
                          </div>
                     </div>
                </div></div>
   
  <?php
  
   }
 } 
############################# BUSQUEDA DE VENTAS DE PRODUCTOS POR FECHAS ########################
?>

<?php
############################# BUSQUEDA DE PRODUCTOS VENDIDOS POR FECHAS ##########################
if (isset($_GET['BuscaProductosVendidosFechas']) && isset($_GET['desde']) && isset($_GET['hasta'])) {  

     $desde = $_GET['desde']; 
     $hasta = $_GET['hasta']; 

if($desde=="") {

  echo "<center><div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA DE INICIO PARA TU B&Uacute;SQUEDA</div></center>";
   exit;
    

} else if($hasta=="") {

  echo "<center><div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA FINAL PARA TU B&Uacute;SQUEDA</div></center>";
   exit;
   
   } else {

  ?>
  
 <div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-tasks"></i> Productos Vendidos desde <?php echo $_GET["desde"]." hasta ".$_GET["hasta"]; ?></h3></div>
<div class="panel-body">
      
<div class="row">
       <div class="col-sm-12 col-xs-12"> 
                            <div class="box-body">
                                <div class="row"> 
                                <div class="col-md-12"> 
                               
  <div id="div1"><div class="table-responsive" data-pattern="priority-columns">
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                          <th>N&deg;</th>
                          <th>C&oacute;digo</th>
                          <th>Descripcion de Producto</th>
                          <th>Categoria</th>
                          <th>Precio</th>
                          <th>Vendido</th>
                          <th>Costo Total</th>
                          <th>Existencia</th>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php 
$ve = new Login();
$reg = $ve->ListarProductosVendidos();
$a=1;
for($i=0;$i<sizeof($reg);$i++){ 
?>
                                                <tr>
<td><div align="center"><?php echo $a++; ?></div></td>
<td><div align="center"><?php echo $reg[$i]['codproducto']; ?></div></td>
<td><div align="center"><?php echo $reg[$i]['producto']; ?></div></td>
<td><div align="center"><?php echo $reg[$i]['nomcategoria']; ?></div></td>
<td><div align="center"><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[$i]['precioventa'], 2, '.', ','); ?></div></td>
<td><div align="center"><?php echo $reg[$i]['cantidad']; ?></div></td>
<td><div align="center"><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[$i]["precioventa"]*$reg[$i]["cantidad"], 2, '.', ','); ?></div></td>
<td><div align="center"><?php echo $reg[$i]['existencia']; ?></div></td>
                          
                                                </tr>
                        <?php  }  ?>
                                            </tbody>
                                        </table>
<div align="center"><a href="reportepdf?desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo base64_encode("PRODUCTOSVENDIDOSFECHAS") ?>" target="_blank"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-pdf-o"></span> Exportar Pdf</button></a>
                          
<a href="reporteexcel?desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo base64_encode("PRODUCTOSVENDIDOS") ?>"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-excel-o"></span> Exportar Excel</button> </a>                   
            </div><br /></div>
                        </div>  
                    </div>
                                    </div><!-- /.box-body -->
                </div>
                          </div>
                     </div>
                </div></div>
  <?php
  
   }
 } 
############################# BUSQUEDA DE PRODUCTOS VENDIDOS POR FECHAS ##########################
?>


<?php
######################## BUSQUEDA DE INGREDIENTES VENDIDOS POR FECHAS ##########################
if (isset($_GET['BuscaIngredientesVendidosFechas']) && isset($_GET['desde']) && isset($_GET['hasta'])) {  

     $desde = $_GET['desde']; 
     $hasta = $_GET['hasta']; 

if($desde=="") {

  echo "<center><div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA DE INICIO PARA TU B&Uacute;SQUEDA</div></center>";
   exit;
    

} else if($hasta=="") {

  echo "<center><div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<span class='fa fa-info-circle'></span> POR FAVOR INGRESE FINAL PARA TU B&Uacute;SQUEDA</div></center>";
   exit;
   
   } else {

  ?>
  
 <div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-tasks"></i> Ingredientes Vendidos desde <?php echo $_GET["desde"]." hasta ".$_GET["hasta"]; ?></h3></div>
<div class="panel-body">
      
<div class="row">
       <div class="col-sm-12 col-xs-12"> 
                            <div class="box-body">
                                <div class="row"> 
                                <div class="col-md-12"> 
                               
  <div id="div1"><div class="table-responsive" data-pattern="priority-columns">
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                          <th>N&deg;</th>
                          <th>C&oacute;digo</th>
                          <th>Ingredientes</th>
                          <th>Precio</th>
                          <th>Vendido</th>
                          <th>Costo Total</th>
                          <th>Existencia</th>
                                                </tr>
                                            </thead>
                                            <tbody>
<?php 
$ve = new Login();
$reg = $ve->BuscarIngredientesVendidos();
$a=1;
for($i=0;$i<sizeof($reg);$i++){ 
?>
                                                <tr>
<td><div align="center"><?php echo $a++; ?></div></td>
<td><div align="center"><?php echo $reg[$i]['codingrediente']; ?></div></td>
<td><div align="center"><?php echo $reg[$i]['nomingrediente']; ?></div></td>
<td><div align="center"><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[$i]['costoingrediente'], 2, '.', ','); ?></div></td>
<td><div align="center"><?php echo rount($reg[$i]['cantidades'], 2); ?></div></td>
<td><div align="center"><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[$i]['cantidades']*$reg[$i]["costoingrediente"], 2, '.', '.'); ?></div></td>
<td><div align="center"><?php echo $reg[$i]['cantingrediente']; ?></div></td>
                          
                                                </tr>
                        <?php  }  ?>
                                            </tbody>
                                        </table>
<div align="center"><a href="reportepdf?desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo base64_encode("INGREDIENTESVENDIDOSFECHAS") ?>" target="_blank"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-pdf-o"></span> Exportar Pdf</button></a>
                          
<a href="reporteexcel?desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo base64_encode("INGREDIENTESVENDIDOS") ?>"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-excel-o"></span> Exportar Excel</button> </a>                    
            </div><br /></div>
                        </div>  
                    </div>
                                    </div><!-- /.box-body -->
                </div>
                          </div>
                     </div>
                </div></div>
   
  <?php
  
   }
 } 
######################## BUSQUEDA DE INGREDIENTES VENDIDOS POR FECHAS ##########################
?>


<?php
############################# BUSQUEDA DE ARQUEOS DE CAJAS POR FECHAS ##########################
if (isset($_GET['BuscaArqueosFechas']) && isset($_GET['desde']) && isset($_GET['hasta'])) {  

     $desde = $_GET['desde']; 
     $hasta = $_GET['hasta']; 

if($desde=="") {

  echo "<center><div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA DE INCIO PARA TU B&Uacute;SQUEDA</div></center>";
   exit;
    

} else if($hasta=="") {

  echo "<center><div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA FINAL PARA TU B&Uacute;SQUEDA</div></center>";
   exit;
   
   } else {

  ?>
  
 <div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-tasks"></i> Arqueos de Cajas desde <?php echo $_GET["desde"]." hasta ".$_GET["hasta"]; ?></h3></div>
<div class="panel-body">
      
<div class="row">
       <div class="col-sm-12 col-xs-12"> 
                            <div class="box-body">
                                <div class="row"> 
                                <div class="col-md-12"> 
                               
  <div id="div1"><div class="table-responsive" data-pattern="priority-columns">
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                          <th>N&deg;</th>
                          <th>Caja</th>
                          <th>Hora de Apertura</th>
                          <th>Hora de Cierre</th>
                          <th>Estimado</th>
                          <th>Real</th>
                          <th>Diferencia</th>
                         </tr>
                         </thead>
                         <tbody>
<?php 
$arqueo = new Login();
$reg = $arqueo->BuscarArqueosCajasFechas();
$a=1;
for($i=0;$i<sizeof($reg);$i++){  
?>
                                               <tr role="row" class="odd">
                        <td class="sorting_1" tabindex="0"><?php echo $a++; ?></td>
                        <td><?php echo $reg[$i]['nombrecaja']; ?></td>
                        <td><?php echo $reg[$i]['fechaapertura']; ?></td>
                        <td><?php echo $reg[$i]['fechacierre']; ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[$i]['montoinicial']+$reg[$i]['ingresos']-$reg[$i]['egresos'], 2, '.', ','); ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[$i]['dineroefectivo'], 2, '.', ','); ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[$i]['diferencia'], 2, '.', ','); ?></td>
                          
                                                </tr>
                        <?php  }  ?>
                                            </tbody>
                                        </table>
<div align="center"><a href="reportepdf?desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo base64_encode("ARQUEOSXFECHAS") ?>" target="_blank"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-pdf-o"></span> Exportar Pdf</button></a>
                          
<a href="reporteexcel?desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo base64_encode("ARQUEOSXFECHAS") ?>"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-excel-o"></span> Exportar Excel</button> </a>                    
            </div><br /></div>
                        </div>  
                    </div>
                                    </div><!-- /.box-body -->
                </div>
                          </div>
                     </div>
                </div></div>
   
  <?php
  
   }
 } 
############################# BUSQUEDA DE ARQUEOS DE CAJAS POR FECHAS ##########################
?>

<?php
########################## BUSQUEDA DE MOVIMIENTOS DE CAJAS POR FECHAS ##########################
if (isset($_GET['BuscaMovimientosFechas']) && isset($_GET['codcaja']) && isset($_GET['desde']) && isset($_GET['hasta'])) { 
  
  $codcaja = $_GET['codcaja'];
  $desde = $_GET['desde']; 
  $hasta = $_GET['hasta'];  

 if($codcaja=="") {

  echo "<center><div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE CAJA PARA TU B&Uacute;SQUEDA</div></center>";
   exit;
   
  } else if($desde=="") {

  echo "<center><div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA DE INICIO PARA TU B&Uacute;SQUEDA</div></center>";
   exit;
    

} else if($hasta=="") {

  echo "<center><div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA DE FIN PARA TU B&Uacute;SQUEDA</div></center>";
   exit;
   
   } else {

$movim = new Login();
$reg = $movim->BuscarMovimientosCajasFechas();

  ?>
  
 <div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-tasks"></i> Movimientos de <?php echo $reg[0]['nombrecaja']; ?> desde <?php echo $_GET["desde"]." hasta ".$_GET["hasta"]; ?></h3></div>
<div class="panel-body">
      
<div class="row">
       <div class="col-sm-12 col-xs-12"> 
                            <div class="box-body">
                                <div class="row"> 
                                <div class="col-md-12"> 
                               
  <div id="div1"><div class="table-responsive" data-pattern="priority-columns">
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                          <th>N&deg;</th>
                          <th>Fecha Movimiento</th>
                          <th>Tipo Movimiento</th>
                          <th>Descripci&oacute;n</th>
                          <th>Monto</th>
                         </tr>
                         </thead>
                         <tbody>
<?php 
$a=1;
$TotalIngresos=0;
$TotalEgresos=0;
for($i=0;$i<sizeof($reg);$i++){ 
$TotalIngresos+=$ingresos = ( $reg[$i]['tipomovimientocaja'] == 'INGRESO' ? $reg[$i]['montomovimientocaja'] : "0");
$TotalEgresos+=$egresos = ( $reg[$i]['tipomovimientocaja'] == 'EGRESO' ? $reg[$i]['montomovimientocaja'] : "0"); 
?>
                                               <tr role="row" class="odd">
                         <td class="sorting_1" tabindex="0"><?php echo $a++; ?></td>
                <td><?php echo $reg[$i]['fechamovimientocaja']; ?></td>
                <td><?php echo $reg[$i]['tipomovimientocaja']; ?></td>
                <td><?php echo $reg[$i]['descripcionmovimientocaja']; ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($reg[$i]['montomovimientocaja'], 2, '.', ','); ?></td>
                          
                                                </tr>
                        <?php  }  ?>
                                            </tbody>
                                        </table>
<strong>Total Ingresos</strong> <?php echo number_format($TotalIngresos, 2, '.', ','); ?>
        <br><strong>Total Egresos: </strong> <?php echo number_format($TotalEgresos, 2, '.', ','); ?><br>


<div align="center"><a href="reportepdf?codcaja=<?php echo $codcaja; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo base64_encode("MOVIMIENTOSXFECHAS") ?>" target="_blank"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-pdf-o"></span> Exportar Pdf</button></a>
                          
<a href="reporteexcel?codcaja=<?php echo $codcaja; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo base64_encode("MOVIMIENTOSXFECHAS") ?>"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-excel-o"></span> Exportar Excel</button> </a>                    
            </div><br /></div>
                        </div>  
                    </div>
                                    </div><!-- /.box-body -->
                </div>
                          </div>
                     </div>
                </div></div>
   
  <?php
  
   }
 } 
########################## BUSQUEDA DE MOVIMIENTOS DE CAJAS POR FECHAS ##########################
?>


<?php
######################## BUSQUEDA DE INFORME GENERAL DE VENTAS POR FECHAS ##########################
if (isset($_GET['BuscaInformeVentasFechas']) && isset($_GET['desde']) && isset($_GET['hasta'])) { 
  
  $desde = $_GET['desde']; 
  $hasta = $_GET['hasta'];  

 if($desde=="") {

  echo "<center><div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA DE INICIO PARA TU B&Uacute;SQUEDA</div></center>";
   exit;

} else if($hasta=="") {

  echo "<center><div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA FINAL PARA TU B&Uacute;SQUEDA</div></center>";
   exit;
   
   } else {

$venta = new Login();
$venta = $venta->SumarVentas();

$compra = new Login();
$compra = $compra->SumarCompras();

$ing = new Login();
$ing = $ing->SumarIngresos();

$egr = new Login();
$egr = $egr->SumarEgresos();

$abo = new Login();
$abo = $abo->SumarAbonos();

$car = new Login();
$car = $car->SumarCarteraCreditos();

$balance = $venta[0]['totalventa'] - $venta[0]['totaliva'] + $ing[0]['totalingresos']+$abo[0]['totalabonos'];
$balance2 = $compra[0]['totalcomprageneral'] + $egr[0]['totalegresos'];
$balancegeneral = $balance - $balance2;

  ?>
  
 <div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-tasks"></i> Informe de Ventas desde <?php echo $_GET["desde"]." hasta ".$_GET["hasta"]; ?></h3></div>
<div class="panel-body">
      
<div class="row">
       <div class="col-sm-12 col-xs-12"> 
                            <div class="box-body">
                                <div class="row"> 
                                <div class="col-md-12"> 
                               
  <div class="table-responsive" data-pattern="priority-columns">
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                            <thead>
                          <tr role="row" class="odd">
                          <th>Total de Ventas</th>
      <th><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($venta[0]['totalventa'], 2, '.', ','); ?></th>
                         </tr>
                         <tr role="row" class="odd">
                          <th>Total de Ingresos</th>
      <th><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($ing[0]['totalingresos'], 2, '.', ','); ?></th> 
                         </tr>
                         <tr role="row" class="odd">
                          <th>Abonos a Cr&eacute;ditos</th>
      <th><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($abo[0]['totalabonos'], 2, '.', ','); ?></th> 
                         </tr>
                         <tr role="row" class="odd">
                          <th>Total de Compras</th>
       <th><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($compra[0]['totalcomprageneral'], 2, '.', ','); ?></th>
                         </tr>
                         <tr role="row" class="odd">
                          <th>Total de Gastos (Egresos)</th>
        <th><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($egr[0]['totalegresos'], 2, '.', ','); ?></th>
                         </tr>

                         <tr role="row" class="odd">
                          <th>Cartera de Clientes</th>
        <th><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($car[0]['totaldebe']-$car[0]['totalabono'], 2, '.', ','); ?></th>
                         </tr>
                         <tr role="row" class="odd">
                          <th>Total de Impuestos de Ventas IGV <?php echo $con[0]['ivav'] ; ?>%</th>
        <th><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($venta[0]['totaliva'], 2, '.', ','); ?></th>
                         </tr>
                         <tr role="row" class="odd">
                          <th>Balance General</th>
         <th><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($balancegeneral, 2, '.', ','); ?></th>
                         </tr>

                         <tr role="row" class="odd">
                          <th>Utilidad Neta</th>
         <th><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($venta[0]['totalventa']-$venta[0]['totalcompra']-$venta[0]['totaliva'], 2, '.', ','); ?></th>
                         </tr>
                         </thead>
                         <tbody>
                    </tbody>
                  </table>


        <div align="center"><a href="reportepdf?desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo base64_encode("INFORMEVENTAS") ?>" target="_blank"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-pdf-o"></span> Exportar Pdf</button></a>                   
            </div><br /></div>
                        </div>  
                    </div>
                                    </div><!-- /.box-body -->
                </div>
                          </div>
                     </div>
                </div>
   
  <?php
  
   }
 } 
######################## BUSQUEDA DE INFORME GENERAL DE VENTAS POR FECHAS ##########################
?>




<?php
######################## BUSQUEDA DE INFORME GENERAL DE CAJAS POR FECHAS ##########################
if (isset($_GET['BuscaInformeCajasFechas']) && isset($_GET['codcaja']) && isset($_GET['desde']) && isset($_GET['hasta'])) { 
  
  $codcaja = $_GET['codcaja'];
  $desde = $_GET['desde']; 
  $hasta = $_GET['hasta'];  

 if($codcaja=="") {

  echo "<center><div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<span class='fa fa-info-circle'></span> POR FAVOR SELECCIONE CAJA PARA TU B&Uacute;SQUEDA</div></center>";
   exit;
   
  } else if($desde=="") {

  echo "<center><div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA DE INICIO PARA TU B&Uacute;SQUEDA</div></center>";
   exit; 

} else if($hasta=="") {

  echo "<center><div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA FINAL PARA TU B&Uacute;SQUEDA</div></center>";
   exit;
   
   } else {

$venta = new Login();
$venta = $venta->SumarVentasCajas();

$ing = new Login();
$ing = $ing->SumarIngresosCajas();

$egr = new Login();
$egr = $egr->SumarEgresosCajas();

$abo = new Login();
$abo = $abo->SumarAbonosCajas();

$reg = new Login();
$reg = $reg->CajerosPorId();

$balance = $venta[0]['totalventa']-$venta[0]['totaliva']+$ing[0]['totalingresos']+$abo[0]['totalabonos'];
$ganancias = $balance-$egr[0]['totalegresos'];

  ?>
  
 <div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-tasks"></i> Informe de <?php echo $reg[0]['nombrecaja']; ?> desde <?php echo $_GET["desde"]." hasta ".$_GET["hasta"]; ?></h3></div>
<div class="panel-body">
      
<div class="row">
       <div class="col-sm-12 col-xs-12"> 
                            <div class="box-body">
                                <div class="row"> 
                                <div class="col-md-12"> 
                               
  <div class="table-responsive" data-pattern="priority-columns">
        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                            <thead>
                          <tr role="row" class="odd">
                          <th>Total de Ventas</th>
      <th><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($venta[0]['totalventa'], 2, '.', ','); ?></th>
                         </tr>
                         <tr role="row" class="odd">
                          <th>Total de Ingresos</th>
      <th><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($ing[0]['totalingresos'], 2, '.', ','); ?></th> 
                         </tr>
                         <tr role="row" class="odd">
                          <th>Abonos a Cr&eacute;ditos</th>
      <th><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($abo[0]['totalabonos'], 2, '.', ','); ?></th> 
                         </tr>
                         <tr role="row" class="odd">
                          <th>Total de Gastos (Egresos)</th>
        <th><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($egr[0]['totalegresos'], 2, '.', ','); ?></th>
                         </tr>
                         <tr role="row" class="odd">
                          <th>Total de Impuestos de Ventas IGV <?php echo $con[0]['ivav'] ; ?>%</th>
        <th><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($venta[0]['totaliva'], 2, '.', ','); ?></th>
                         </tr>
                         <tr role="row" class="odd">
                          <th>Efectivo en Caja sin IGV</th>
         <th><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($ganancias, 2, '.', ','); ?></th>
                         </tr>
                         </thead>
                         <tbody>
                    </tbody>
                  </table>


        <div align="center"><a href="reportepdf?codcaja=<?php echo $codcaja; ?>&desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo base64_encode("INFORMECAJAS") ?>" target="_blank"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-pdf-o"></span> Exportar Pdf</button></a>                   
            </div><br /></div>
                        </div>  
                    </div>
                                    </div><!-- /.box-body -->
                </div>
                          </div>
                     </div>
                </div>
   
  <?php
  
   }
 } 
######################## BUSQUEDA DE INFORME GENERAL DE CAJAS POR FECHAS ##########################
?>





























<?php 
################################ BUSQUEDA DE ABONOS DE CREDITOS ##################################
if (isset($_GET['BuscaAbonosClientes']) && isset($_GET['codcliente'])) { 

$codcliente = $_GET['codcliente']; 

if($codcliente=="") {

  echo "<center><div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<span class='fa fa-info-circle'></span> POR FAVOR REALICE LA B&Uacute;SQUEDA DEL CLIENTE CORRECTAMENTE</div></center>";
   exit;
   
   } else {
  
$bon = new Login();
$bon = $bon->BuscarClientesAbonos();  
 ?>
 
  <div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-tasks"></i> Cr&eacute;ditos de Ventas del Cliente <?php echo $bon[0]['nomcliente']; ?></h3></div>
<div class="panel-body">
      
<div class="row">
       <div class="col-sm-12 col-xs-12"> 
                            <div class="box-body">
                                <div class="row"> 
                                <div class="col-md-12"> 
                               
      <div id="div"><div class="table-responsive" data-pattern="priority-columns">
                <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">                              
                       <thead>
                              <tr>
                                  <th data-priority="1">N&deg;</th>
                                  <th data-priority="2">N&deg; de Venta</th>
                                  <th data-priority="4">Total Factura</th>
                                  <th data-priority="5">Monto Abono</th>
                                  <th data-priority="6">Total Debe</th>
                                  <th data-priority="7">Status Cr&eacute;dito</th>
                                  <th data-priority="8">Dias Vencidos</th>
                                  <th data-priority="9">Acciones</th>
                              </tr>
                              </thead>
                              <tbody>
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
                            <tr>
                           <td><?php echo $a++; ?></td>
  <td><abbr title="Fecha Venta: <?php echo date("d-m-Y h:i:s",strtotime($bon[$i]['fechaventa'])); ?>"><?php echo $bon[$i]['codventa']; ?></abbr></td>
  <td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($bon[$i]['totalpago'], 2, '.', ','); ?></td>
  <td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($bon[$i]['abonototal'], 2, '.', ','); ?></td>
  <td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($bon[$i]['totalpago']-$bon[$i]['abonototal'], 2, '.', ','); ?></td>
                           <td><?php 
if($bon[$i]['fechavencecredito']== '0000-00-00') { echo "<span class='label label-success'>".$bon[$i]["statusventa"]."</span>"; } 
elseif($bon[$i]['fechavencecredito'] >= date("Y-m-d")) { echo "<span class='label label-success'>".$bon[$i]["statusventa"]."</span>"; } 
elseif($bon[$i]['fechavencecredito'] < date("Y-m-d")) { echo "<span class='label label-danger'>VENCIDA</span>"; } ?></td>
                          <td><?php 
if($bon[$i]['fechavencecredito']== '0000-00-00') { echo "0"; } 
elseif($bon[$i]['fechavencecredito'] >= date("Y-m-d")) { echo "0"; } 
elseif($bon[$i]['fechavencecredito'] < date("Y-m-d")) { echo Dias_Transcurridos(date("Y-m-d"),$bon[$i]['fechavencecredito']); } ?></td>
                           <td>
<a href="reportepdf?codventa=<?php echo base64_encode($bon[$i]['codventa']); ?>&tipo=<?php echo base64_encode("TICKETCREDITOS") ?>" target="_black" class="btn btn-info" title="Ticket de Abono" ><i class="fa fa-print"></i></a>
               
<?php if($bon[$i]['statusventa'] == 'PAGADA') { echo "<span class='label label-success'> CR&Eacute;DITO PAGADO</span>"; } else { ?><button type="button" onclick="NuevoAbono('<?php echo $bon[$i]['cedcliente'] ?>','<?php echo $bon[$i]['codventa'] ?>')" class="btn btn-primary"><span class="fa fa-save"></span> Abonar</button><?php } ?>                </td>
                              </tr>
                        <?php  }  ?>
                            <tr>
                              <td>&nbsp;</td>
                              <td><strong>Total General</strong></td>
    <td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($TotalFactura, 2, '.', ','); ?></td>
    <td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($TotalCredito, 2, '.', ','); ?></td>
    <td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($TotalDebe, 2, '.', ','); ?></td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                              </tbody>
                          </table></div>
                               </div>  
                            </div>
                        </div><!-- /.box-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    } 
  }
################################ BUSQUEDA DE ABONOS DE CREDITOS ##################################
?>


<?php 
######################## MUESTRA FORMULARIO PARA PAGOS DE ABONOS DE CREDITOS #####################
if (isset($_GET['MuestraFormularioAbonos']) && isset($_GET['cedcliente']) && isset($_GET['codventa'])) { 

$cedcliente = $_GET['cedcliente']; 
$codventa = $_GET['codventa'];
  
$forbon = new Login();
$forbon = $forbon->BuscaAbonosCreditos();  
 ?>
 
 <div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-tasks"></i> Gesti&oacute;n de Pagos a Cr&eacute;ditos de Factura N&deg; <?php echo base64_decode($codventa); ?></h3></div>
<div class="panel-body">
      
<div class="row">
<div class="col-sm-12 col-xs-12"> 
            <div class="box-body">
        
        <div class="row"> 
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
            <label class="control-label">Nit de Cliente: <span class="symbol required"></span></label>
<input type="text" class="form-control" name="cedcliente" id="cedcliente" value="<?php echo $forbon[0]['cedcliente']; ?>" readonly="readonly">
<input type="hidden" name="codventa" id="codventa" value="<?php echo $forbon[0]['codventa']; ?>" readonly="readonly">
                             <i class="fa fa-pencil form-control-feedback"></i>  
                              </div> 
                        </div> 
            
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
                        <label class="control-label">Nombre de Cliente: <span class="symbol required"></span></label>
  <input type="text" class="form-control" name="nomcliente" id="nomcliente" value="<?php echo $forbon[0]['nomcliente']; ?>" readonly="readonly">
                        <i class="fa fa-pencil form-control-feedback"></i> 
                              </div> 
                        </div> 

              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
          <label class="control-label">Total Factura Cr&eacute;dito: <span class="symbol required"></span></label>
  <input type="text" class="form-control" name="totalpago" id="totalpago" value="<?php echo $forbon[0]['totalpago']; ?>" readonly="readonly">
                        <i class="fa fa-money form-control-feedback"></i>  
                              </div> 
                        </div>  
                    </div>
          
          <div class="row"> 
            
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Total Factura Abono: <span class="symbol required"></span></label>
  <input type="text" class="form-control" name="abonado" id="abonado" value="<?php echo $total = ( $forbon[0]['abonototal'] == '' ? "0.00" : $forbon[0]['abonototal']); ?>" readonly="readonly">
                        <i class="fa fa-money form-control-feedback"></i>
                              </div> 
                        </div> 

              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
          <label class="control-label">Total Debe: <span class="symbol required"></span></label>
 <input type="text" class="form-control" name="totaldebe" id="totaldebe" value="<?php echo number_format($forbon[0]['totalpago']-$forbon[0]['abonototal'], 2, '.', ''); ?>" readonly="readonly">
                        <i class="fa fa-money form-control-feedback"></i>  
                              </div> 
                        </div> 
            
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
      <label class="control-label">Monto a Pagar: <span class="symbol required"></span></label>
  <input class="form-control" type="text" name="montoabono" id="montoabono" onKeyPress="EvaluateText('%f', this);" onBlur="this.value = NumberFormat(this.value, '2', '.', '')" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Monto a Abonar" required="" aria-required="true">
                        <i class="fa fa-money form-control-feedback"></i>
                              </div> 
                        </div>  
                    </div><br>
          
          
             <div class="modal-footer"> 
<button type="submit" name="btn-submit" id="btn-submit" class="btn btn-primary"><span class="fa fa-save"></span> Registrar Pago</button>
<button class="btn btn-danger" type="button" onclick="document.getElementById('montoabono').value = ''"><span class="fa fa-trash-o"></span> Cancelar</button>    
                          </div>
                                    </div><!-- /.box-body -->
                </div>
                          </div>
                     </div>
                </div>
    <?php
  }
######################## MUESTRA FORMULARIO PARA PAGOS DE ABONOS DE CREDITOS #####################
?>


<?php
################### MOSTRAR DETALLES DE PAGOS DE CREDITOS EN VENTANA MODAL #######################
if (isset($_GET['BuscaCreditosModal']) && isset($_GET['codventa'])) { 

$codventa = $_GET['codventa'];

$tra = new Login(); 
$ve = $tra->CreditosPorId();
?>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="pull-right">
                         <address>
        <abbr title="N? de Venta"><strong>N&deg; DE VENTA: </strong> <?php echo $ve[0]["codventa"]; ?></abbr><br>
        <abbr title="N&deg; de Caja"><strong>N&deg; DE CAJA: </strong> <?php echo $caja = ( $ve[0]['codcaja'] == '0' ? "<span class='label label-warning'> SIN COBRAR</span>" : $ve[0]["nrocaja"]); ?></abbr><br>
        
        <?php if($ve[0]["codcliente"]=='0'){ ?>
        <abbr title="Nombre de Cliente"><strong> CLIENTE: </strong> SIN ASIGNAR</abbr><br>
        <?php }  else { ?>
        <abbr title="Nombre de Cliente"><strong><?php echo $ve[0]["cedcliente"].": ".$ve[0]["nomcliente"]; ?></strong></abbr><br>
        <abbr title="Direcci&oacute;n de Cliente"><?php echo $ve[0]["direccliente"]; ?></abbr><br>
                <abbr title="Email de Cliente"><strong>EMAIL: </strong> <?php echo $ve[0]["emailcliente"]; ?></abbr><br>
                <abbr title="Telefono"><strong>N&deg; DE TLF:</strong></abbr> <?php echo $ve[0]["tlfcliente"]; ?><br />
        <?php } ?>
        <abbr title="Tipo de Pago"><strong>TIPO DE PAGO:</strong></abbr> <?php echo "<span class='label label-success'>".$ve[0]["tipopagove"]."</span>"; ?><br />
        
        <abbr title="Forma de Pago"><strong>FORMA DE PAGO:</strong></abbr><?php if($ve[0]['tipopagove'] == 'CONTADO') { echo "<span class='label label-success'>".$ve[0]["mediopago"]."</span>"; } else { echo "<span class='label label-warning'>".$ve[0]["formapagove"]."</span>"; } ?><br />
        
        <abbr title="Fecha de Vencimiento de Cr&eacute;dito"><strong>FECHA DE VENCIMIENTO:</strong></abbr> <?php echo $vence = ( $ve[0]['fechavencecredito'] == '0000-00-00' ? "0" : date("d-m-Y",strtotime($ve[0]['fechavencecredito']))); ?><br />
<abbr title="Dias Vencidos de Cr&eacute;dito"><strong>DIAS VENCIDOS:</strong></abbr> <?php 
if($ve[0]['fechavencecredito']== '0000-00-00') { echo "0"; } 
elseif($ve[0]['fechavencecredito'] >= date("Y-m-d")) { echo "0"; } 
elseif($ve[0]['fechavencecredito'] < date("Y-m-d")) { echo Dias_Transcurridos(date("Y-m-d"),$ve[0]['fechavencecredito']); } ?><br />
        <abbr title="Fecha de Venta"><strong>FECHA DE VENTA:</strong></abbr> <?php echo date("d-m-Y h:i:s",strtotime($ve[0]['fechaventa'])); ?><br />
        <abbr title="Status de Venta"><strong>STATUS DE VENTA:</strong></abbr> <?php 
if($ve[0]['fechavencecredito']== '0000-00-00') { echo "<span class='label label-success'>".$ve[0]["statusventa"]."</span>"; } 
elseif($ve[0]['fechavencecredito'] >= date("Y-m-d")) { echo "<span class='label label-success'>".$ve[0]["statusventa"]."</span>"; } 
elseif($ve[0]['fechavencecredito'] < date("Y-m-d")) { echo "<span class='label label-danger'>VENCIDA</span>"; } ?><br />
      <abbr title="Total Factura"><strong>TOTAL FACTURA:</strong></abbr> <?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($ve[0]["totalpago"], 2, '.', ','); ?><br />
      <abbr title="Total Abono"><strong>TOTAL ABONO:</strong></abbr> <?php echo "<strong>".$con[0]['simbolo']."</strong>".$total = ( $ve[0]['abonototal'] == '' ? "0.00" : $ve[0]['abonototal']); ?><br />                <abbr title="Total Debe"><strong>TOTAL DEBE:</strong></abbr> <?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($ve[0]['totalpago']-$ve[0]['abonototal'], 2, '.', ','); ?>
                                                  </address>
                                                </div>
                                            </div>
                                        </div>                      
                       
                       
                       
<div class="table-responsive" data-pattern="priority-columns">
                                            <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">                                                        <thead>
                                                            <tr>
                                                              <th colspan="3">Detalles de Abonos</th>
                                                            </tr>
                                                            <tr>
                                                            <th>C&oacute;digo</th>
                                                            <th>Monto de Abono</th>
                              <th>Fecha de Abono</th>
                                                            </tr>
                            </thead>
                                                        <tbody>
 <?php 
$tru = new Login();
$busq = $tru->VerDetallesCreditos();
$a=1;
for($i=0;$i<sizeof($busq);$i++){
?>
                             <tr>
                                                                <td><?php echo $a++; ?></td>
                           <td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($busq[$i]["montoabono"], 2, '.', ','); ?></td>
                                                                <td><?php echo $busq[$i]["fechaabono"]; ?></td>
                                                          </tr>
                              <?php } ?>
                                                        </tbody>
  </table>
</div>
<?php
}
################### MOSTRAR DETALLES DE PAGOS DE CREDITOS EN VENTANA MODAL #######################
?>


<?php 
####################### BUSQUEDA DE CREDITOS POR CLIENTES PARA REPORTES ##########################
if (isset($_GET['BuscaCreditosClientes']) && isset($_GET['codcliente'])) { 

$codcliente = $_GET['codcliente']; 

if($codcliente=="") {

  echo "<center><div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<span class='fa fa-info-circle'></span> POR FAVOR REALICE LA B&Uacute;SQUEDA DEL CLIENTE CORRECTAMENTE</div></center>";
   exit;
   
   } else {
  
$bon = new Login();
$bon = $bon->BuscarClientesAbonos();  
 ?>
 
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-tasks"></i> Creditos de Ventas del Cliente <?php echo $bon[0]['nomcliente']; ?></h3></div>
<div class="panel-body">
      
<div class="row">
       <div class="col-sm-12 col-xs-12"> 
                            <div class="box-body">
                                <div class="row"> 
                                <div class="col-md-12"> 
                               
  <div id="div1"><div class="table-responsive" data-pattern="priority-columns">
                <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">                              
                       <thead>
                              <tr>
                                  <th>N&deg;</th>
                                  <th>N&deg; de Venta</th>
                                  <th>N&deg; de Caja</th>
                                  <th>Status Cr&eacute;dito</th>
                                  <th>Dias Vencidos</th>
                                  <th>Total Factura</th>
                                  <th>Total Abono</th>
                                  <th>Total Debe</th>
                                  <th>Ticket</th>
                              </tr>
                              </thead>
                              <tbody>
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
                           <tr>
                           <td><?php echo $a++; ?></td>
                           <td><?php echo $bon[$i]['codventa']; ?></td>
                           <td><?php echo $bon[$i]['nrocaja']; ?></td>
                           <td><?php 
if($bon[$i]['fechavencecredito']== '0000-00-00') { echo "<span class='label label-success'>".$bon[$i]["statusventa"]."</span>"; } 
elseif($bon[$i]['fechavencecredito'] >= date("Y-m-d")) { echo "<span class='label label-success'>".$bon[$i]["statusventa"]."</span>"; } 
elseif($bon[$i]['fechavencecredito'] < date("Y-m-d")) { echo "<span class='label label-danger'>VENCIDA</span>"; } ?></td>
                            <td><?php 
if($bon[$i]['fechavencecredito']== '0000-00-00') { echo "0"; } 
elseif($bon[$i]['fechavencecredito'] >= date("Y-m-d")) { echo "0"; } 
elseif($bon[$i]['fechavencecredito'] < date("Y-m-d")) { echo Dias_Transcurridos(date("Y-m-d"),$bon[$i]['fechavencecredito']); } ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($bon[$i]['totalpago'], 2, '.', ','); ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($bon[$i]['abonototal'], 2, '.', ','); ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($bon[$i]['totalpago']-$bon[$i]['abonototal'], 2, '.', ','); ?></td>
                           <td>
<a href="reportepdf?codventa=<?php echo base64_encode($bon[$i]['codventa']); ?>&tipo=<?php echo base64_encode("TICKETCREDITOS") ?>" target="_black" class="btn btn-info btn-xs" title="Ticket de Abono" ><i class="fa fa-print"></i></a>                </td>
                              </tr>
                        <?php  }  ?>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td><strong>Total General</strong></td>
<td><strong><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($TotalFactura, 2, '.', ','); ?></strong></td>
<td><strong><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($TotalCredito, 2, '.', ','); ?></strong></td>
<td><strong><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($TotalDebe, 2, '.', ','); ?></strong></td>
                              <td>&nbsp;</td>
                            </tr>
                              </tbody>
                          </table>
<div align="center"><a href="reportepdf?codcliente=<?php echo $codcliente; ?>&tipo=<?php echo base64_encode("CREDITOSCLIENTES") ?>" target="_blank"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-pdf-o"></span> Exportar Pdf</button></a>
                          
<a href="reporteexcel?codcliente=<?php echo $codcliente; ?>&tipo=<?php echo base64_encode("CREDITOSCLIENTES") ?>"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-excel-o"></span> Exportar Excel</button> </a>                    
                          </div><br /></div>
                                 </div>  
                              </div>
                          </div><!-- /.box-body -->
                      </div>
                  </div>
              </div>
          </div>
      </div>
    <?php
    } 
  }
####################### BUSQUEDA DE CREDITOS POR CLIENTES PARA REPORTES ##########################
?>


<?php 
######################## BUSQUEDA DE CREDITOS POR FECHAS PARA REPORTES #########################
if (isset($_GET['BuscaCreditosFechas']) && isset($_GET['desde']) && isset($_GET['hasta'])) {  

     $desde = $_GET['desde']; 
     $hasta = $_GET['hasta']; 

if($desde=="") {

  echo "<center><div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA DE INICIO PARA TU B&Uacute;SQUEDA</div></center>";
   exit;
    

} else if($hasta=="") {

  echo "<center><div class='alert alert-danger'>";
  echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
  echo "<span class='fa fa-info-circle'></span> POR FAVOR INGRESE FECHA FINAL PARA TU BUacute;SQUEDA</div></center>";
  exit;
   
   } else {
  
$bon = new Login();
$bon = $bon->BuscarCreditosFechas();  
 ?>
 
 
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-tasks"></i> Creditos por Fechas Desde <?php echo $_GET["desde"]." hasta ".$_GET["hasta"]; ?></h3></div>
<div class="panel-body">
      
<div class="row">
       <div class="col-sm-12 col-xs-12"> 
                            <div class="box-body">
                                <div class="row"> 
                                <div class="col-md-12"> 
                               
  <div id="div1"><div class="table-responsive" data-pattern="priority-columns">
                <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">                              
                       <thead>
                              <tr>
                                  <th>N&deg;</th>
                                  <th>Nit Cliente</th>
                                  <th>Nombre Cliente</th>
                                  <th>Status Cr&eacute;dito</th>
                                  <th>Dias Vencidos</th>
                                  <th>N&deg; de Venta</th>
                                  <th>Total Factura</th>
                                  <th>Total Abono</th>
                                  <th>Total Debe</th>
                                  <th>Ticket</th>
                              </tr>
                              </thead>
                              <tbody>
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
                           <tr>
                           <td><?php echo $a++; ?></td>
<td><?php if($bon[$i]['cedcliente']== '') { echo "SIN ASIGNAR"; } else { echo $bon[$i]['cedcliente']; } ?></td>
<td><?php if($bon[$i]['nomcliente']== '') { echo "SIN ASIGNAR"; } else { echo $bon[$i]['nomcliente']; } ?></td>
                           <td><?php 
if($bon[$i]['fechavencecredito']== '0000-00-00') { echo "<span class='label label-success'>".$bon[$i]["statusventa"]."</span>"; } 
elseif($bon[$i]['fechavencecredito'] >= date("Y-m-d")) { echo "<span class='label label-success'>".$bon[$i]["statusventa"]."</span>"; } 
elseif($bon[$i]['fechavencecredito'] < date("Y-m-d")) { echo "<span class='label label-danger'>VENCIDA</span>"; } ?></td>
                            <td><?php 
if($bon[$i]['fechavencecredito']== '0000-00-00') { echo "0"; } 
elseif($bon[$i]['fechavencecredito'] >= date("Y-m-d")) { echo "0"; } 
elseif($bon[$i]['fechavencecredito'] < date("Y-m-d")) { echo Dias_Transcurridos(date("Y-m-d"),$bon[$i]['fechavencecredito']); } ?></td>
<td><?php echo $bon[$i]['codventa']; ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($bon[$i]['totalpago'], 2, '.', ','); ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($bon[$i]['abonototal'], 2, '.', ','); ?></td>
<td><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($bon[$i]['totalpago']-$bon[$i]['abonototal'], 2, '.', ','); ?></td>
                           <td>
<a href="reportepdf?codventa=<?php echo base64_encode($bon[$i]['codventa']); ?>&tipo=<?php echo base64_encode("TICKETCREDITOS") ?>" target="_black" class="btn btn-info btn-xs" title="Ticket de Abono" ><i class="fa fa-print"></i></a>                </td>
                           
                              </tr>
                        <?php  }  ?>
                             <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                              <td><strong>Total General</strong></td>
<td><strong><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($TotalFactura, 2, '.', ','); ?></strong></td>
<td><strong><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($TotalCredito, 2, '.', ','); ?></strong></td>
<td><strong><?php echo "<strong>".$con[0]['simbolo']."</strong>".number_format($TotalDebe, 2, '.', ','); ?></strong></td>
                              <td>&nbsp;</td>
                            </tr>
                              </tbody>
                          </table>
<div align="center"><a href="reportepdf?desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo base64_encode("CREDITOSFECHAS") ?>" target="_blank"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-pdf-o"></span> Exportar Pdf</button></a>
                          
<a href="reporteexcel?desde=<?php echo $desde; ?>&hasta=<?php echo $hasta; ?>&tipo=<?php echo base64_encode("CREDITOSFECHAS") ?>"><button class="btn btn-success btn-lg" type="button"><span class="fa fa-file-excel-o"></span> Exportar Excel</button> </a>                    
                           </div><br />
                                    </div>
                                </div>  
                             </div>
                          </div><!-- /.box-body -->
                      </div>
                  </div>
              </div>
          </div>
      </div>
    <?php
    } 
  }
######################## BUSQUEDA DE CREDITOS POR FECHAS PARA REPORTES #########################
?>