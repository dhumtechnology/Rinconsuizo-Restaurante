<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="cocinero" || $_SESSION["acceso"]=="mesero") {

$con = new Login();
$con = $con->ContarRegistros();

$config = new Login();
$config = $config->ConfiguracionPorId();

$tra = new Login();
$ses = $tra->ExpiraSession();

$reg = $tra->ProductosPorId();

if(isset($_POST['btn-submit']))
{
$reg = $tra->AgregarIngredientes();
exit;
}

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link href="assets/images/favicon.png" rel="icon" type="image">
<link href="assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="assets/css/icons.css" rel="stylesheet" type="text/css">
<link href="assets/css/style.css" rel="stylesheet" type="text/css"> 

<!-- script jquery -->
<script src="assets/js/jquery.min.js"></script> 
<!-- Custom file upload -->
<script src="assets/plugins/fileupload/bootstrap-fileupload.min.js"></script>
<script type="text/javascript" src="assets/script/titulos.js"></script>
<script type="text/javascript" src="assets/script/script2.js"></script>
<script type="text/javascript" src="assets/script/validation.min.js"></script>
<script type="text/javascript" src="assets/script/script.js"></script>
<!-- script jquery -->

<!-- Calendario -->
	<link rel="stylesheet" href="assets/calendario/jquery-ui.css" />
    <script src="assets/calendario/jquery-ui.js"></script>
    <script src="assets/script/autocompleto.js"></script>	
<!-- Calendario -->	

</head>
<body onLoad="muestraReloj()" class="fixed-left">
 <div id="wrapper">
 <div class="topbar">
 <div class="topbar-left">
 <div class="text-center"> 
 <a href="panel" class="logo"><img src="assets/images/logo_white_2.png" height="50"></a> 
 <a href="panel" class="logo-sm"><img src="assets/images/logo_sm.png" height="50"></a>
 </div>
 </div>
 <div class="navbar navbar-default" role="navigation">
 <div class="container">
 <div class="">
 <div class="pull-left"> 
 <button type="button" class="button-menu-mobile open-left waves-effect waves-light"><i class="ion-navicon"></i> </button> 
 <span class="clearfix"></span></div>
 <form class="navbar-form pull-left" role="search">
 <div class="form-group"> 
 <input class="form-control search-bar" placeholder="Búsqueda..." type="text">
 </div> 
 <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
 </form>
 <ul class="nav navbar-nav navbar-right pull-right">
 
<!--- MEJORAR DE AQUI ---->
  <!-- Reloj start-->
  <li id="header_inbox_bar" class="dropdown hidden-xs">
    <a data-toggle="dropdown" class="hour" href="#">
      <span id="spanreloj"></span>
    </a>
  </li>
  <!-- Reloj end -->
  
  <li class="dropdown hidden-xs"> 
   <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" title="Notificaciones de Pedidos" aria-expanded="true"> 
    <i class="fa fa-bell"></i> 
    <span class="badge badge-xs badge-danger"><?php echo $con[0]['stockproductos']+$con[0]['stockingredientes']+$con[0]['creditosventasvencidos']+$con[0]['creditoscomprasvencidos']; ?></span> 
  </a> 
  
  <ul class="dropdown-menu dropdown-menu-lg">
    <li class="text-center notifi-title">Notificaciones</li>
    <li class="list-group">
     <!-- list item-->
     <a href="javascript:void(0);" class="dropdown-toggle waves-effect list-group-item">
      <div class="media">
       <div class="pull-left">
        <em class="fa fa-cart-plus fa-2x text-info"></em>                                                 
      </div>
      <div class="media-body clearfix">
        <div class="media-heading">Productos en Stock Minimo</div>
        <p class="m-0">
          <small>Existen <span class="text-primary"><?php echo $con[0]['stockproductos']; ?></span> Productos en Stock</small>
        </p>
      </div>
    </div>
  </a>
  <!-- list item-->
  <a href="javascript:void(0);" class="list-group-item">
    <div class="media">
     <div class="pull-left">
      <em class="fa fa-cart-arrow-down fa-2x text-primary"></em>                                                 
    </div>
    <div class="media-body clearfix">
      <div class="media-heading">Ingredientes en Stock Minimo</div>
      <p class="m-0">
        <small>Existen <span class="text-primary"><?php echo $con[0]['stockingredientes']; ?></span> Ingredientes en Stock</small> 
      </p>
    </div>
  </div>
</a>
<!-- list item-->
<a href="javascript:void(0);" class="list-group-item">
  <div class="media">
   <div class="pull-left">
    <em class="fa fa-truck fa-2x text-info"></em>                                                 
  </div>
  <div class="media-body clearfix">
    <div class="media-heading">Créditos de Compras</div>
    <p class="m-0">
     <small>Existen <span class="text-primary"><?php echo $con[0]['creditoscomprasvencidos']; ?></span> Créditos Vencidos</small>                                                    </p>
   </div>
 </div>
</a>
<!-- last list item -->
<!-- list item-->
<a href="javascript:void(0);" class="list-group-item">
  <div class="media">
   <div class="pull-left">
    <em class="fa fa-diamond fa-2x text-danger"></em>                                                 
  </div>
  <div class="media-body clearfix">
    <div class="media-heading">Créditos de Ventas</div>
    <p class="m-0">
     <small>Existen <span class="text-primary"><?php echo $con[0]['creditosventasvencidos']; ?></span> Créditos Vencidos</small>                                                    </p>
   </div>
 </div>
</a>
<!-- last list item -->                                       
</li>
</ul>

</li>
<!--- MEJORAR DE AQUI ---->
<li class="hidden-xs"> 
  <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="fa fa-crosshairs"></i></a>   
</li>
<li class="dropdown">
  <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
    
    <span class="dropdown hidden-xs"><abbr title="<?php echo estado($_SESSION['acceso']); ?>"><?php echo $_SESSION['nombres']; ?></abbr></span>
    <?php
    if (isset($_SESSION['cedula'])) {
      if (file_exists("fotos/" . $_SESSION['cedula'] . ".jpg")) {
        echo "<img src='fotos/" . $_SESSION['cedula'] . ".jpg?' class='img-circle'>";
      } else {
        echo "<img src='fotos/avatar.jpg' class='img-circle'>";
      }
    } else {
      echo "<img src='fotos/avatar.jpg' class='img-circle'>";
    }
    ?> </a>
   <ul class="dropdown-menu">
   <li><a href="perfil"><i class="fa fa-user"></i> Mi Perfil</a></li>
   <li><a href="password"><i class="fa fa-edit"></i> Actualizar Password </a></li>
   <li><a href="bloqueo"><i class="fa fa-clock-o"></i> Bloquear Sesión</a></li>
   <li class="divider"></li>
   <li><a href="logout"><i class="fa fa-power-off"></i> Cerrar Sesión</a></li>
   </ul>
   </li>
   </ul>
   </div>
   </div>
   </div>
   </div>
   <div class="left side-menu">
   <div class="sidebar-inner slimscrollleft" style="overflow: hidden; width: auto; height: 566px;">
   
   <div class="user-details">
   <div class="text-center"> <?php
	if (isset($_SESSION['cedula'])) {
	if (file_exists("fotos/".$_SESSION['cedula'].".jpg")){
    echo "<img src='fotos/".$_SESSION['cedula'].".jpg?' class='img-circle'>"; 
}else{
    echo "<img src='fotos/avatar.jpg' class='img-circle'>"; 
} } else {
	echo "<img src='fotos/avatar.jpg' class='img-circle'>"; 
}
?></div>
   <div class="user-info">
   <div class="dropdown"> 
   <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><?php echo estado($_SESSION['acceso']); ?></a>
   <ul class="dropdown-menu">
  <li><a href="perfil"><i class="fa fa-user"></i> Mi Perfil</a></li>
   <li><a href="password"><i class="fa fa-edit"></i> Actualizar Password </a></li>
   <li><a href="bloqueo"><i class="fa fa-clock-o"></i> Bloquear Sesión</a></li>
   <li class="divider"></li>
   <li><a href="logout"><i class="fa fa-power-off"></i> Cerrar Sesión</a></li>
   </ul>
   </div>
   <p class="text-muted m-0"><i class="fa fa-dot-circle-o text-success"></i> Online</p>
   </div>
   </div>
  
   <!----- INICIO DE MENU ----->
   <?php include('menu.php'); ?>
   <!----- FIN DE MENU ----->

<div class="clearfix"></div>
                </div>
       </div>
</div>

<div class="content-page">
<div class="content">
<div class="container">
<div class="row">
<div class="col-sm-12">
<div class="page-header-title"><h4 class="pull-left page-title"><i class="fa fa-tasks"></i> Agrega Ingredientes</h4>
<ol class="breadcrumb pull-right"><li><a href="panel">Inicio</a></li>
<li><a href="productos">Control</a></li>
<li class="active">Productos</li>
</ol>

<div class="clearfix"></div>

</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-edit"></i> Detalles del Producto</h3></div>
<div class="panel-body">
<div class="row">
<div class="col-sm-12 col-xs-12"> 
            <div class="box-body">
							
<form class="form" method="post"  action="#" name="agregaingrediente" id="agregaingrediente" data-id="<?php echo $reg[0]["codproducto"] ?>" onSubmit="asigna()">
			
<input type="hidden" name="codproducto" id="codproducto" value="<?php echo $reg[0]['codproducto']; ?>">	

<div class="row"> 
                            <div class="col-md-2"> 
                              <div class="form-group has-feedback"> 
                              <label for="field-2" class="control-label">Código:</label> 
                      <br /><abbr title="Código de Producto"><?php echo $reg[0]['codproducto']; ?></abbr>
                          
                              </div> 
                          </div>
						  
						  <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
                              <label for="field-4" class="control-label">Nombre de Producto:</label> 
                      <br /><abbr title="Nombre de Producto"><?php echo $reg[0]['producto']; ?></abbr>
                          
                              </div> 
                          </div>
															
							<div class="col-md-2"> 
                               <div class="form-group has-feedback"> 
                               <label for="field-2" class="control-label">Existencia:</label> 
					<br /><abbr title="Existencia de Producto"><?php echo $reg[0]['existencia']; ?></abbr>
                              </div> 
                          </div> 	
                            <div class="col-md-2"> 
                               <div class="form-group has-feedback"> 
                               <label for="field-2" class="control-label">Categoria:</label> 
							   <br /><abbr title="Categoria de Producto"><?php echo $reg[0]['nomcategoria']; ?></abbr>
                              </div>
							  </div>
							  
							  <div class="col-md-2"> 
                               <div class="form-group has-feedback"> 
                               <label for="field-2" class="control-label">Precio Compra:</label> 
                               <br /><abbr title="Precio Compra"><?php echo $reg[0]['preciocompra']." <strong>".$config[0]['simbolo']."</strong>"; ?></abbr>  
                              </div> 
                                </div>
							 
                    </div>
					
					
					<div class="row"> 
                            <div class="col-md-2"> 
                              <div class="form-group has-feedback"> 
                              <label for="field-2" class="control-label">Precio Venta:</label> 
                      <br /><abbr title="Precio Venta"><?php echo $reg[0]['precioventa']." <strong>".$config[0]['simbolo']."</strong>"; ?></abbr>
                          
                              </div> 
                          </div>
															
							<div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
                               <label for="field-4" class="control-label">Código de Barra:</label> 
					<br /><abbr title="Código de Barra"><?php echo $reg[0]['codigobarra']; ?></abbr>
                              </div> 
                          </div> 
						  
						  <div class="col-md-2"> 
                              <div class="form-group has-feedback"> 
                              <label for="field-2" class="control-label">Stock Minimo:</label> 
                      <br /><abbr title="Stock Minimo"><?php echo $reg[0]['stockminimo']; ?></abbr>
                          
                              </div> 
                          </div>	
                            <div class="col-md-2"> 
                               <div class="form-group has-feedback"> 
                               <label for="field-2" class="control-label">Iva:</label> 
							   <br /><abbr title="Iva Producto"><?php echo $reg[0]['ivaproducto']; ?></abbr>
                              </div>
							  </div>
							  
							  <div class="col-md-2"> 
                               <div class="form-group has-feedback"> 
                               <label for="field-2" class="control-label">Status:</label> 
                               <br /><abbr title="Status de Producto"><?php echo $reg[0]['statusproducto']; ?></abbr>  
                              </div> 
                                </div>
							 

                    </div>
					
	                <hr>														
<div align="left"><button type="button" onClick="addRowX()" class="btn btn-primary waves-light"><span class="fa fa-plus"></span> Agregar</button> 
<button type="button" onClick="borrar()" class="btn btn-danger waves-light" ><i class="fa fa-minus"></i> Quitar</button> </div>
			        <hr>

                           <div id="error"></div>
<div class="table-responsive" data-pattern="priority-columns">
             <table id="datatable-responsive" class="table table-small-font table-bordered table-striped">
                  <thead>
				  <tr role="row">
				  <th colspan="3" data-priority="1"><center><h4>Agregar Ingredientes</h4></center></th>
				  </tr>
                  </thead>
                  <tbody>
                    <tr>
<td data-priority="3"><input type="hidden" name="codingrediente[]" id="codingrediente"><input type="text" class="form-control" name="busqueda[]" id="busqueda" onKeyUp="this.value=this.value.toUpperCase(); autocompletar(this.name);" title="Realice la busqueda de Ingrediente" autocomplete="off" placeholder="Porción de Ingrediente" required="" aria-required="true"></td>
<td data-priority="2"><input type="text" class="form-control" name="cantidad[]" id="cantidad1" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Cantidad Porción" title="Ingrese Cantidad de Porcion" required="" aria-required="true"></td>
<td data-priority="3"><input type="text" class="form-control" name="unidadingrediente[]" id="unidadingrediente" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Medida" readonly="readonly"></td>
                    </tr><input type="hidden" name="var_cont">
                  </tbody>
            </table>
		</div>
	
            <div class="modal-footer"> 
<button type="submit" name="btn-submit" id="btn-submit" class="btn btn-primary"><span class="fa fa-cart-arrow-down"></span> Agregar</button>			
<button class="btn btn-danger" type="reset"><i class="fa fa-times-circle"></i> Cancelar</button>  
                      </div>
                    </form>
					
<hr>					
				
<div id="delete-ok" style="display:none;">&nbsp;</div>
<div class="table-responsive" data-pattern="priority-columns">
             <div id="cargaingredientes"><table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                  <thead>
				  <tr role="row">
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
$a=1;
$busq = $tru->VerDetallesIngredientesProductos(); 

if($busq==""){

    echo "";      
    
} else {

for($i=0;$i<sizeof($busq);$i++){
?>
                    <tr>
					<td data-priority="1"><?php echo $a++; ?></td>
					<td data-priority="2"><input type="hidden" name="codingrediente[]" id="codingrediente" value="<?php echo $busq[$i]["codingrediente"]; ?>"><?php echo $busq[$i]["nomingrediente"]; ?></td>
					<td data-priority="3"><?php echo $busq[$i]["cantracion"]; ?></td>
					<td data-priority="5"><?php echo $busq[$i]["cantingrediente"]." ".$busq[$i]["unidadingrediente"]; ?></td>
<td data-priority="6"><?php echo "<strong>".$config[0]['simbolo']."</strong>".number_format($busq[$i]["costoingrediente"], 2, '.', ','); ?></td>
					<td data-priority="7"><center><a href="#" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="left" title="" data-original-title="Eliminar Ingrediente" onClick="EliminaNuevoIngrediente('<?php echo base64_encode($busq[$i]['codproducto']) ?>','<?php echo base64_encode($busq[$i]['codingrediente']) ?>','<?php echo base64_encode("ELIMINAINGREDIENTES") ?>')"><i class="fa fa-trash-o"></i></a></center></td>
                    </tr><?php } } ?>
                  </tbody>
            </table></div>
		</div>				
					
                                    </div><!-- /.box-body -->
								</div>
                          </div>
                     </div>
                </div>
           </div>
       </div>
</div>


<footer class="footer"> <i class="fa fa-copyright"></i> <span class="current-year"></span>. </footer>
</div>
</div> 

        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="assets/js/jquery.app.js"></script>
        
        <!-- jQuery  -->
        <script src="assets/pages/jquery.dashboard.js"></script>
        <script src="assets/plugins/noty/packaged/jquery.noty.packaged.min.js"></script>

<script language='JavaScript'>
var cont=1;

function addRowX()  //Esta la funcion que agrega las filas segunda parte :
{
cont++;

var indiceFila=1;
myNewRow = document.getElementById('datatable-responsive').insertRow(-1);
myNewRow.id=indiceFila;
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<input type="hidden" name="codingrediente[]'+cont+'" id="codingrediente'+cont+'"><input type="text" class="form-control" name="busqueda[]'+cont+'" id="busqueda'+cont+'" onKeyUp="this.value=this.value.toUpperCase(); autocompletar(this.name);" title="Realice la busqueda de Ingrediente" autocomplete="off" placeholder="Porción de Ingrediente" required="" aria-required="true">';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<input type="text" class="form-control" name="cantidad[]'+cont+'" id="cantidad'+cont+'" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Cantidad Porción" title="Ingrese Cantidad de Porcion" required="" aria-required="true">';
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<input type="text" class="form-control" name="unidadingrediente[]'+cont+'" id="unidadingrediente'+cont+'" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Medida" readonly="readonly">';
indiceFila++;
}

//////// FUNCION BORRAR FILA ///////////
function borrar() {
var table = document.getElementById('datatable-responsive');
if(table.rows.length > 2)
    {
    table.deleteRow(table.rows.length -1);
cont--;
    }
}

//////// FUNCION ASIGNA VALOR DE CONT ////////
function asigna()
{
valor=document.form.var_cont.value=cont;
}
</script>

   </body>
   </html>
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