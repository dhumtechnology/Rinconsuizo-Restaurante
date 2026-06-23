<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
if ($_SESSION['acceso'] == "administrador") {

$con = new Login();
$con = $con->ContarRegistros();

$config = new Login();
$config = $config->ConfiguracionPorId();

$tra = new Login();
$ses = $tra->ExpiraSession();

if(isset($_POST['btn-submit']))
{
$reg = $tra->RegistrarProductos();
exit;
}
elseif(isset($_POST['btn-update']))
{
$reg = $tra->ActualizarProductos();
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
<div class="page-header-title"><h4 class="pull-left page-title"><i class="fa fa-tasks"></i> Gestión de Productos</h4>
<ol class="breadcrumb pull-right"><li><a href="panel">Inicio</a></li>
<li><a href="productos">Control</a></li>
<li class="active">Productos</li>
</ol>

<div class="clearfix"></div>

</div>
</div>
</div>
      
<?php  if (isset($_GET['codproducto'])) {
      
      $reg = $tra->ProductosPorId(); ?>
      
<form class="form" method="post"  action="#" name="updateproducto" id="updateproducto" data-id="<?php echo $reg[0]["codalmacen"] ?>" enctype="multipart/form-data" onSubmit="asigna()">       
    <?php } else { ?>
        
    <form class="form" method="post"  action="#" name="productos" id="productos" enctype="multipart/form-data" onSubmit="asigna()">
      
    <?php } ?>

<div class="row">
<div class="col-sm-12">
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-edit"></i> Gestión de Productos</h3></div>
<div class="panel-body">
<div class="row">
<div class="col-sm-12 col-xs-12"> 
            <div class="box-body">
                                                  <div id="error">
                                                 <!-- error will be shown here ! -->
                                                 </div>
												
				<div class="row"> 
                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
      <label class="control-label">Código Producto: <span class="symbol required"></span></label>
                 <div id="nroproducto"><input type="hidden" name="codproceso" id="codproceso" <?php if (isset($reg[0]['codalmacen'])) { ?> value="" <?php } else { ?>  value="<?php echo GenerateRandomString(); ?>" <?php } ?>></div>
<input type="hidden" name="codalmacen" id="codalmacen" <?php if (isset($reg[0]['codalmacen'])) { ?> value="<?php echo $reg[0]['codalmacen']; ?>"<?php } ?>>

<div id="codigoproducto"><input type="text" class="form-control" name="codproducto" id="codproducto" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Código de Producto" <?php if (isset($reg[0]['codproducto'])) { ?> value="<?php echo $reg[0]['codproducto']; ?>" readonly="readonly" <?php } else { ?>  value="<?php echo $reg = $tra->CodigoProducto(); ?>" <?php } ?> required="" aria-required="true"></div>
                              </div> 
                        </div>
															
							<div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Nombre de Producto: <span class="symbol required"></span></label>
                                  <input type="text" class="form-control" name="producto" id="producto" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Nombre de Producto" <?php if (isset($reg[0]['producto'])) { ?> value="<?php echo $reg[0]['producto']; ?>"<?php } ?> required="" aria-required="true">
                        <i class="fa fa-pencil form-control-feedback"></i> 
                              </div> 
                        </div> 

                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
    <label class="control-label">Categoria: <span class="symbol required"></span></label>
            <i class="fa fa-bars form-control-feedback"></i>
                              <?php if (isset($reg[0]['codcategoria'])) { ?>
							   <select name="codcategoria" id="codcategoria" class="form-control" required="" aria-required="true">
												<option value="">SELECCIONE</option>
			<?php
			$cat = new Login();
			$cat = $cat->ListarCategorias();
			for($i=0;$i<sizeof($cat);$i++){
		              ?>
	<option value="<?php echo $cat[$i]['codcategoria']; ?>"<?php if (!(strcmp($reg[0]['codcategoria'], htmlentities($cat[$i]['codcategoria'])))) {echo "selected=\"selected\"";} ?>><?php echo $cat[$i]['nomcategoria']; ?></option>			  
                      <?php } ?>
						      </select>
                             <?php } else { ?>  
							 <select name="codcategoria" id="codcategoria" class="form-control" required="" aria-required="true">
												<option value="">SELECCIONE</option>
			<?php
			$cat = new Login();
			$cat = $cat->ListarCategorias();
			for($i=0;$i<sizeof($cat);$i++){
		              ?>
<option value="<?php echo $cat[$i]['codcategoria'] ?>"><?php echo $cat[$i]['nomcategoria'] ?></option>			  
                      <?php } ?>
						      </select> 
                              <?php } ?>
                              </div> 
                        </div>	
                    </div>
					
					
					<div class="row">              
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
        <label class="control-label">Precio de Compra: <span class="symbol required"></span></label>
<input class="form-control " type="text" name="preciocompra" id="preciocompra" onKeyPress="EvaluateText('%f', this);" onBlur="this.value = NumberFormat(this.value, '2', '.', '')" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Precio de Compra" <?php if (isset($reg[0]['preciocompra'])) { ?> value="<?php echo $reg[0]['preciocompra']; ?>"<?php } ?>>
                        <i class="fa fa-money form-control-feedback"></i> 
                              </div> 
                        </div> 

                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
<label class="control-label">Precio de Venta: <span class="symbol required"></span></label>
<input class="form-control " type="text" name="precioventa" id="precioventa"  placeholder="Ingrese Precio de Venta" <?php if (isset($reg[0]['precioventa'])) { ?> value="<?php echo $reg[0]['precioventa']; ?>"<?php } ?> required="" aria-required="true">
                        <i class="fa fa-money form-control-feedback"></i> 
                              </div> 
                        </div>
															
							<div class="col-md-4"> 
                  <div class="form-group has-feedback"> 
<label class="control-label">Cantidad o Existencia: <span class="symbol required"></span></label>
<input class="form-control " type="text" name="existencia" id="existencia" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Cantidad o Existencia de Producto" <?php if (isset($reg[0]['existencia'])) { ?> value="<?php echo $reg[0]['existencia']; ?>"<?php } ?> required="" aria-required="true">
                        <i class="fa fa-pencil form-control-feedback"></i>
                              </div> 
                        </div> 	
                    </div>
					
					<div class="row"> 

                        <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
                          <label class="control-label">Stock Minimo: </label>
<input type="text" class="form-control" name="stockminimo" id="stockminimo" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Stock Minimo de Producto" <?php if (isset($reg[0]['stockminimo'])) { ?> value="<?php echo $reg[0]['stockminimo']; ?>"<?php } ?> required="" aria-required="true">
                        <i class="fa fa-map-marker form-control-feedback"></i>
                              </div> 
                        </div>
                              
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
  <label class="control-label">Iva de Producto: <span class="symbol required"></span></label>
            <i class="fa fa-bars form-control-feedback"></i>
                                <?php if (isset($reg[0]['ivaproducto'])) { ?>
<select name="ivaproducto" id="ivaproducto" class="form-control" required="" aria-required="true">
                        <option value="">SELECCIONE</option>
                        <option value="SI"<?php if (!(strcmp('SI', $reg[0]['ivaproducto']))) {echo "selected=\"selected\"";} ?>>SI</option>
                        <option value="NO"<?php if (!(strcmp('NO', $reg[0]['ivaproducto']))) {echo "selected=\"selected\"";} ?>>NO</option>
                  </select> 
                <?php } else { ?>
                <select name="ivaproducto" id="ivaproducto" class="form-control" required="" aria-required="true">
                        <option value="">SELECCIONE</option>
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                  </select> 
                              <?php } ?>  
                              </div> 
                        </div>

              <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
            <label class="control-label">Descuento %: <span class="symbol required"></span></label>
  <input class="form-control" type="text" name="descproducto" id="descproducto" onKeyPress="EvaluateText('%f', this);" onBlur="this.value = NumberFormat(this.value, '2', '.', '')" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Dscuento de Producto" <?php if (isset($reg[0]['descproducto'])) { ?> value="<?php echo $reg[0]['descproducto']; ?>" <?php } else { ?> value="0.00" <?php } ?> tabindex="13" required="" aria-required="true">
                        <i class="fa fa-money form-control-feedback"></i> 
                              </div> 
                        </div>
                    </div>
					
					<div class="row">

                        <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
          <label class="control-label">Código de Barra: </label>
<input type="text" class="form-control" name="codigobarra" id="codigobarra" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Código de Barra" <?php if (isset($reg[0]['codigobarra'])) { ?> value="<?php echo $reg[0]['codigobarra']; ?>"<?php } ?> tabindex="10" required="" aria-required="true">
                        <i class="fa fa-barcode form-control-feedback"></i> 
                              </div> 
                        </div>

            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
          <label class="control-label">Proveedor: <span class="symbol required"></span></label>
            <i class="fa fa-bars form-control-feedback"></i>
                              <?php if (isset($reg[0]['codproveedor'])) { ?>
<select name="codproveedor" id="codproveedor" tabindex="14" class="form-control" required="" aria-required="true">
                        <option value="">SELECCIONE</option>
      <?php
      $proveedor = new Login();
      $proveedor = $proveedor->ListarProveedores();
      for($i=0;$i<sizeof($proveedor);$i++){
                  ?>
<option value="<?php echo $proveedor[$i]['codproveedor']; ?>"<?php if (!(strcmp($proveedor[0]['codproveedor'], htmlentities($proveedor[$i]['codproveedor'])))) {echo "selected=\"selected\"";} ?>><?php echo $proveedor[$i]['nomproveedor']; ?></option>        
                      <?php } ?>
                  </select>
                             <?php } else { ?>  
<select name="codproveedor" id="codproveedor" tabindex="14" class="form-control" required="" aria-required="true">
                        <option value="">SELECCIONE</option>
      <?php
      $proveedor = new Login();
      $proveedor = $proveedor->ListarProveedores();
      for($i=0;$i<sizeof($proveedor);$i++){
                  ?>
<option value="<?php echo $proveedor[$i]['codproveedor'] ?>"><?php echo $proveedor[$i]['nomproveedor'] ?></option>        
                      <?php } ?>
                  </select> 
                              <?php } ?>
                              </div> 
                        </div> 

                          <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
            <label class="control-label">Status de Producto: <span class="symbol required"></span></label>
            <i class="fa fa-bars form-control-feedback"></i>
                                  <?php if (isset($reg[0]['statusproducto'])) { ?>
<select name="statusproducto" id="statusproducto" class="form-control" required="" aria-required="true">
                        <option value="">SELECCIONE</option>
<option value="ACTIVO" <?php if (!(strcmp('ACTIVO', $reg[0]['statusproducto']))) {echo "selected=\"selected\"";} ?>>ACTIVO</option>
<option value="INACTIVO" <?php if (!(strcmp('INACTIVO', $reg[0]['statusproducto']))) {echo "selected=\"selected\"";} ?>>INACTIVO</option>
                  </select>  
                <?php } else { ?>
                <select name="statusproducto" id="statusproducto" class="form-control" required="" aria-required="true">
                        <option value="">SELECCIONE</option>
                        <option value="ACTIVO">ACTIVO</option>
                        <option value="INACTIVO">INACTIVO</option>
                  </select> 
                              <?php } ?>  
                              </div> 
                        </div>
                    </div>
          
          <div class="row">

                        <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
<label class="control-label">Mostrar Favorito: <span class="symbol required"></span></label>
            <i class="fa fa-bars form-control-feedback"></i>
                                  <?php if (isset($reg[0]['favorito'])) { ?>
<select name="favorito" id="favorito" class="form-control" required="" aria-required="true">
                        <option value="">SELECCIONE</option>
<option value="SI" <?php if (!(strcmp('SI', $reg[0]['favorito']))) {echo "selected=\"selected\"";} ?>>SI</option>
<option value="NO" <?php if (!(strcmp('NO', $reg[0]['favorito']))) {echo "selected=\"selected\"";} ?>>NO</option>
                  </select>  
                <?php } else { ?>
                <select name="favorito" id="statusproducto" class="form-control" required="" aria-required="true">
                        <option value="">SELECCIONE</option>
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                  </select> 
                              <?php } ?>  
                              </div> 
                        </div>

							<div class="col-sm-6">
													<div class="fileinput fileinput-new" data-provides="fileinput">
					<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 90px; height: 100px;">
<?php if (isset($reg[0]['codproducto'])) {
	if (file_exists("fotos/".$reg[0]['codproducto'].".jpg")){
    echo "<img src='fotos/".$reg[0]['codproducto'].".jpg?".date('h:i:s')."' class='img-rounded' border='0' width='100' height='110' title='Foto del Usuario' data-rel='tooltip'>"; 
}else{
    echo "<img src='fotos/producto.png' class='img-rounded' border='1' width='90' height='100' title='SIN FOTO' data-rel='tooltip'>"; 
} } else {
	echo "<img src='fotos/producto.png' class='img-rounded' border='1' width='90' height='100' title='SIN FOTO' data-rel='tooltip'>"; 
}
?>
													  </div>
														<div>
															<span class="btn btn-default btn-file">
							<span class="fileinput-new"><i class="fa fa-file-image-o"></i> Imagen</span>
							 <span class="fileinput-exists"><i class="fa fa-paint-brush"></i> Imagen</span>
				<input type="file" size="10" data-original-title="Subir Fotografia" data-rel="tooltip" placeholder="Suba su Fotografia" name="imagen" id="imagen"/>
															</span>
 <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times-circle"></i> Remover</a><small><p>Para Subir la Foto del Producto debe tener en cuenta lo siguiente:<br> * La Imagen debe ser extension.jpg<br> * La imagen no debe ser mayor de 50 KB</p></small>															</div>
													</div>
						</div>
                    </div>
					
<?php if (isset($_GET['codproducto'])) { ?>

                          <div id="delete-ok" style="display:none;">&nbsp;</div>
<div class="table-responsive" data-pattern="priority-columns">
             <div id="cargaingredientes"><table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                  <thead>
				  <tr role="row">
				  <th colspan="6" data-priority="1"><center><h4>Ingredientes Agregados</h4></center></th>
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
<td data-priority="3"><input type="text" class="form-control" name="cantidad[]" id="cantidad" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Cantidad Porción" value="<?php echo $busq[$i]["cantracion"]; ?>" title="Ingrese Cantidad" required="" aria-required="true"></td>
<td data-priority="5"><?php echo $busq[$i]["cantingrediente"]." ".$busq[$i]["unidadingrediente"]; ?></td>
<td data-priority="6"><?php echo "<strong>".$config[0]['simbolo']."</strong>".number_format($busq[$i]["costoingrediente"], 2, '.', ','); ?></td>
<td data-priority="7"><center><a href="#" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="left" title="" data-original-title="Eliminar Ingrediente" onClick="EliminaIngrediente('<?php echo base64_encode($busq[$i]['codproducto']) ?>','<?php echo base64_encode($busq[$i]['codingrediente']) ?>','<?php echo base64_encode("ELIMINAINGREDIENTES") ?>')"><i class="fa fa-trash-o"></i></a></center></td>
                    </tr><?php } } ?>
                  </tbody>
            </table></div>
		</div>
		
<?php } ?>
</div><!-- /.box-body --><br>
        
       <div class="modal-footer"> 
<?php  if (isset($_GET['codproducto'])) { ?>
<button type="submit" name="btn-update" id="btn-update" class="btn btn-primary"><span class="fa fa-edit"></span> Actualizar</button>
<button class="btn btn-danger" type="reset"><i class="fa fa-trash-o"></i> Cancelar</button> 
<?php } ?>   
            </div> 


                               </div>
                          </div>
                     </div>
                </div>
           </div>
       </div>
     

<?php  if (!isset($_GET['codproducto'])) { ?>
  
     <div class="row">
<div class="col-sm-12">
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-edit"></i> Gestión de Ingredientes</h3></div>
<div class="panel-body">
<div class="row">
<div class="col-sm-12 col-xs-12"> 
            <div class="box-body">
            
  
<div class="row">
           
         
<button type="button" onClick="addRowX()" class="btn btn-primary waves-light"><span class="fa fa-plus"></span> Agregar</button> 
<button type="button" onClick="borrar()" class="btn btn-danger waves-light" ><i class="fa fa-minus"></i> Quitar</button><hr>

          <table width="100%" id="tabla"><tr>
    <td> 
      
     

        <div class="col-md-4">         
          <div class="form-group has-feedback"> 
        <label class="control-label">Nombre de Ingrediente: </label> 
<input type="hidden" name="codingrediente[]" id="codingrediente"><input type="text" class="form-control" name="busqueda[]" id="busqueda" onKeyUp="this.value=this.value.toUpperCase(); autocompletar(this.name);" autocomplete="off" placeholder="Porción de Ingrediente">
                  <i class="fa fa-pencil form-control-feedback"></i>
                  </div> 
           </div>

         <div class="col-md-4">         
          <div class="form-group has-feedback"> 
        <label class="control-label">Cantidad de Porción: </label> 
<input type="text" class="form-control" name="cantidad[]" id="cantidad1" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Cantidad Porción">
                  <i class="fa fa-pencil form-control-feedback"></i>
                  </div> 
           </div>

         <div class="col-md-4">         
          <div class="form-group has-feedback"> 
        <label class="control-label">Unidad de Medida: </label> 
<input type="text" class="form-control" name="unidadingrediente[]" id="unidadingrediente" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Medida" readonly="readonly">
                  <i class="fa fa-pencil form-control-feedback"></i>
                  </div> 
           </div>
         </td>
    </tr><input type="hidden" name="var_cont">
</table>
                
           </div>
      </div><br>
        
       <div class="modal-footer"> 
<button type="submit" name="btn-submit" id="btn-submit" class="btn btn-primary"><span class="fa fa-save"></span> Guardar</button>
<button class="btn btn-danger" type="reset"><i class="fa fa-trash-o"></i> Limpiar</button>
 
            </div> 
                                
                                    </div><!-- /.box-body -->
                                  </div>
                          </div>
                     </div>
                </div>
           </div>
       </div>
<?php } ?>

     </form>
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
//autocompletar

//
var indiceFila=1;
myNewRow = document.getElementById('tabla').insertRow(-1);
myNewRow.id=indiceFila;
myNewCell=myNewRow.insertCell(-1);
myNewCell.innerHTML='<div class="col-md-4"><div class="form-group has-feedback"><label class="control-label">Nombre de Ingrediente: <span class="symbol required"></span></label><input type="hidden" name="codingrediente[]'+cont+'" id="codingrediente'+cont+'"><input type="text" class="form-control" name="busqueda[]'+cont+'" id="busqueda'+cont+'" onKeyUp="this.value=this.value.toUpperCase(); autocompletar(this.name);" title="Realice la busqueda de Ingrediente" autocomplete="off" placeholder="Porción de Ingrediente" required="" aria-required="true"><i class="fa fa-pencil form-control-feedback"></i></div></div><div class="col-md-4"><div class="form-group has-feedback"><label class="control-label">Cantidad de Porción: <span class="symbol required"></span></label><input type="text" class="form-control" name="cantidad[]'+cont+'" id="cantidad'+cont+'" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Cantidad Porción" title="Ingrese Cantidad de Porcion" required="" aria-required="true"><i class="fa fa-pencil form-control-feedback"></i></div></div><div class="col-md-4"><div class="form-group has-feedback"><label class="control-label">Unidad de Medida: <span class="symbol required"></span></label><input type="text" class="form-control" name="unidadingrediente[]'+cont+'" id="unidadingrediente'+cont+'" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Medida" readonly="readonly"><i class="fa fa-pencil form-control-feedback"></i></div></div>';
indiceFila++;
}

//////////////Borrar() ///////////
function borrar() {
  var table = document.getElementById('tabla');
  if(table.rows.length > 1)
  {
    table.deleteRow(table.rows.length -1);
    cont--;
  }
}

////////////FUNCION ASIGNA VALOR DE CONT PARA EL FOR DE MOSTRAR DATOS MP-MOD-TT////////
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