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
$reg = $tra->RegistrarCompras();
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
<script type="text/javascript" src="assets/script/titulos.js"></script>
<script type="text/javascript" src="assets/script/script2.js"></script>
<script type="text/javascript" src="assets/script/jscompras.js"></script>
<script type="text/javascript" src="assets/script/validation.min.js"></script>
<script type="text/javascript" src="assets/script/script.js"></script>
<!-- script jquery -->

<!-- Calendario -->
<link rel="stylesheet" href="assets/calendario/jquery-ui.css" />
<script src="assets/calendario/jquery-ui.js"></script>
<script src="assets/script/jscalendario.js"></script>
<script src="assets/script/autocompleto.js"></script>
<!-- Calendario -->

</head>
<body onLoad="muestraReloj(); getTime();" class="fixed-left">
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
<div class="page-header-title"><h4 class="pull-left page-title"><i class="fa fa-tasks"></i> Gestión de Compras</h4>
<ol class="breadcrumb pull-right"><li><a href="panel">Inicio</a></li>
<li><a href="compras">Control</a></li>
<li class="active">Compras</li>
</ol>

<div class="clearfix"></div>

</div>
</div>
</div>

<div class="row">
		<form class="form" method="post"  action="#" name="compras" id="compras">
<div class="col-sm-9">
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-edit"></i> Gestión de Compras</h3></div>
<div class="panel-body">
<div class="row">

<div class="col-sm-12 col-xs-12"> 
            <div class="box-body">
			
                                                  <div id="error">
                                                 <!-- error will be shown here ! -->
												  </div>
												
				<div class="row"> 
						
						<div class="col-md-3"> 
                               <div class="form-group has-feedback"> 
         <label class="control-label">Tipo de Gasto: <span class="symbol required"></span></label>
            <i class="fa fa-bars form-control-feedback"></i>
<select name="tipoentrada" id="tipoentrada" class="form-control" onChange="VerificaTipoEntrada()">
												<option value="">SELECCIONE</option>
												<option value="PRODUCTO">PRODUCTO</option>
												<option value="INGREDIENTE">INGREDIENTE</option>
							    </select>   
                              </div> 
                        </div>
							
						 
                            <div class="col-md-2"> 
                              <div class="form-group has-feedback"> 
                 <label class="control-label">Código: <span class="symbol required"></span></label>
<input class="form-control agregac" type="text" name="codproducto" id="codproducto" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Codigo">
<i class="fa fa-pencil form-control-feedback"></i>
                              </div> 
                        </div>
															
							<div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Nombre de Producto: <span class="symbol required"></span></label>
<input class="form-control agregac" type="text" name="producto" id="producto" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Descripcion de Producto">
                        <i class="fa fa-search form-control-feedback"></i> 
                              </div> 
                        </div>
						
						<div class="col-md-3"> 
                               <div class="form-group has-feedback"> 
             <label class="control-label">Categoria o Medida: </label>
            <i class="fa fa-bars form-control-feedback"></i>
<div id="muestratipoentrada"> <select name="codcategoria" id="codcategoria" class="form-control agregac">
												<option value="">SELECCIONE</option>
			<?php
			$cat = new Login();
			$cat = $cat->ListarCategorias();
			for($i=0;$i<sizeof($cat);$i++){
		              ?>
<option value="<?php echo $cat[$i]['codcategoria'] ?>"><?php echo $cat[$i]['nomcategoria'] ?></option>			  
                      <?php } ?>
						      </select></div>
                              </div> 
                        </div>	
                    </div>  
					
				
				<div class="row">
						
						<div class="col-md-3"> 
                              <div class="form-group has-feedback"> 
   <label class="control-label">Cantidad de Compra: <span class="symbol required"></span></label>
<input class="form-control agregac" type="text" name="cantidad" id="cantidad" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Cantidad de Compra">
<i class="fa fa-bolt form-control-feedback"></i>
                              </div> 
                        </div>
				          <div class="col-md-3"> 
                               <div class="form-group has-feedback"> 
       <label class="control-label">Precio de Compra: <span class="symbol required"></span></label>
<input class="form-control agregac" type="text" name="preciocompra" id="preciocompra" onKeyPress="EvaluateText('%f', this);" onBlur="this.value = NumberFormat(this.value, '2', '.', '')" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Precio de Compra"><input type="hidden" name="precioconiva" id="precioconiva" value="0.00"> 
                        <i class="fa fa-dollar form-control-feedback"></i> 
                              </div> 
                        </div>
						
						<div class="col-md-3"> 
                               <div class="form-group has-feedback"> 
                    <label class="control-label">Precio de Venta: </label>
<input class="form-control agregac" type="text" name="precioventa" id="precioventa" onKeyPress="EvaluateText('%f', this);" onBlur="this.value = NumberFormat(this.value, '2', '.', '')" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Precio de Venta"> 
                        <i class="fa fa-dollar form-control-feedback"></i>
                              </div> 
                        </div>
						
						<div class="col-md-3"> 
                               <div class="form-group has-feedback"> 
                 <label class="control-label">Tiene Iva: </label>
            <i class="fa fa-bars form-control-feedback"></i>
         <select name="ivaproducto" id="ivaproducto" class='form-control agregac'>
												<option value="">SELECCIONE</option>
												<option value="SI">SI</option>
												<option value="NO">NO</option>
							    </select>   
                              </div> 
                        </div> 
                    </div>
<hr>		
<div align="right"><button type="button" id="AgregaC" class="btn btn-info"><span class="fa fa-cart-plus"></span> Agregar</button> </div>
<hr>	
										
<div class="table-responsive" data-pattern="priority-columns">
           <table id="carrito" class="table table-small-font table-striped">
            <thead>
    <tr style="background:#01ba9a;">
    <th style="color:#FFFFFF;"><h3 class="panel-title"><div align="center">Cantidad</div></th>
    <th style="color:#FFFFFF;"><h3 class="panel-title"><div align="center">Código</div><h3 class="panel-title"></th>
    <th style="color:#FFFFFF;"><h3 class="panel-title"><div align="center">Descripción de Producto</div><h3 class="panel-title"></th>
    <th style="color:#FFFFFF;"><h3 class="panel-title"><div align="center">Precio</div><h3 class="panel-title"></th>
    <th style="color:#FFFFFF;"><h3 class="panel-title"><div align="center">IVA</div><h3 class="panel-title"></th>
    <th style="color:#FFFFFF;"><h3 class="panel-title"><div align="center">Importe</div><h3 class="panel-title"></th>
    <th style="color:#FFFFFF;"><h3 class="panel-title"><div align="center">Acción</div></h3></th>
    </tr>
          </thead>

              <tbody>
						<tr>
 <td colspan=7><center><label><h5>NO HAY PRODUCTOS AGREGADOS</h5></label></center></td>
                        </tr>
                </tbody>
 </table>

 <?php $simbolo = "<strong>".$config[0]['simbolo']."</strong>"; ?>

<table id="carritototal">
                        <tr>
<td width="10">&nbsp;</td>
<td width="350"><span class="Estilo10"><label>Subtotal Con IVA <?php echo $config[0]['ivac'] ?> %:</label></span></td>
<td width="150"><span class="Estilo10"><?php echo "<strong>".$simbolo."</strong>"; ?><label id="lblsubtotal" name="lblsubtotal">0.00</label><input type="hidden" name="txtsubtotal" id="txtsubtotal" value="0.00"/></span></td>
                          

<td width="350"><span class="Estilo10"><label>Subtotal IVA 0%:</label></span></td>
<td width="150"><span class="Estilo10"><?php echo "<strong>".$simbolo."</strong>"; ?><label id="lblsubtotal2" name="lblsubtotal2">0.00</label><input type="hidden" name="txtsubtotal2" id="txtsubtotal2" value="0.00"/></span></td>

 <td width="200"><span class="Estilo10"><center><label style="font-size:26px;">Total:</label></center></span></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>

<td><span class="Estilo10"><label>IVA <?php echo $config[0]['ivac'] ?>%: <input class="number" type="hidden" name="iva" id="iva" onKeyPress="EvaluateText('%f', this);" style="border-radius:4px;height:30px;width:70px;" onBlur="this.value = NumberFormat(this.value, '2', '.', '')" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" value="<?php echo $config[0]['ivac'] ?>"></label></span></td>
<td><span class="Estilo10"><?php echo "<strong>".$simbolo."</strong>"; ?><label id="lbliva" name="lbliva">0.00</label><input type="hidden" name="txtIva" id="txtIva" value="0.00"/></span></td>


<td><span class="Estilo10"><label>Descuento <input class="number" type="text" name="descuento" id="descuento" onKeyPress="EvaluateText('%f', this);" style="border-radius:4px;height:30px;width:70px;" onBlur="this.value = NumberFormat(this.value, '2', '.', '')" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" value="0.00"> %:</label></span></td>
<td><span class="Estilo10"><?php echo "<strong>".$simbolo."</strong>"; ?><label id="lbldescuento" name="lbldescuento">0.00</label><input type="hidden" name="txtDescuento" id="txtDescuento" value="0.00"/></span></td>

 <td><span class="Estilo10"><center style="font-size:22px;"><?php echo "<strong>".$simbolo."</strong>"; ?><label id="lbltotal" name="lbltotal">0.00</label>
<input type="hidden" name="txtTotal" id="txtTotal" value="0.00"/></center></span></td>
                        </tr>
                    </table>
                                            </div>
				
		
            <div class="modal-footer"> 
<button type="submit" name="btn-submit" id="btn-submit" class="btn btn-primary"><span class="fa fa-save"></span> Registrar</button>			
<button class="btn btn-danger" type="button" id="vaciarc"><span class="fa fa-trash-o"></span> Limpiar</button>  
                      </div>
                                    </div><!-- /.box-body -->
								</div>
                          </div>
                     </div>
                </div>
           </div>
		   
	
	
	
<div class="col-sm-3">
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-laptop"></i> Detalles de Compra</h3></div>
<div class="panel-body">
<div class="row">
<div class="col-sm-12 col-xs-12"> 
            <div class="box-body">

												
				<div class="row"> 
                           <div class="col-md-12"> 
                               <div class="form-group has-feedback"> 
     <label class="control-label">N° de Compra: <span class="symbol required"></span></label>
<input class="form-control" type="text" name="codcompra" id="codcompra" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese N° de Compra" required="required">
                        <i class="fa fa-bolt form-control-feedback"></i> 
                              </div> 
                        </div>
                    </div>
					
				<div class="row"> 
                           <div class="col-md-12"> 
                               <div class="form-group has-feedback"> 
           <label class="control-label">N° de Serie: <span class="symbol required"></span></label>
<input class="form-control" type="text" name="codseriec" id="codseriec" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese N° de Serie" required="required">
                        <i class="fa fa-bolt form-control-feedback"></i> 
                              </div> 
                        </div>
                    </div>
					
				<div class="row"> 
                           <div class="col-md-12"> 
                               <div class="form-group has-feedback"> 
          <label class="control-label">Proveedor: <span class="symbol required"></span></label>
            <i class="fa fa-bars form-control-feedback"></i>
<select name="codproveedor" id="codproveedor" class="form-control" required="" aria-required="true">
								<option value="">SELECCIONE</option>
			<?php
			$prov = new Login();
			$prov = $prov->ListarProveedores();
			for($i=0;$i<sizeof($prov);$i++){
		              ?>
					  <option value="<?php echo $prov[$i]['codproveedor'] ?>"><?php echo $prov[$i]['nomproveedor'] ?></option>			  
                      <?php } ?> </select> 
                              </div> 
                        </div>
                    </div>
					
					<div class="row"> 
                           <div class="col-md-12"> 
                               <div class="form-group has-feedback"> 
       <label class="control-label">Tipo de Compra: <span class="symbol required"></span></label>
            <i class="fa fa-bars form-control-feedback"></i>
<select name="tipocompra" id="tipocompra" class="form-control" onChange="BuscaFormaPagosComprass()" required="" aria-required="true">
								<option value="">SELECCIONE</option>
			                     <option value="CONTADO">CONTADO</option>
			                     <option value="CREDITO">CRÉDITO</option>
						  </select> 
                              </div> 
                        </div>
                    </div>

<div class="row"> 
                           <div class="col-md-12"> 
                               <div class="form-group has-feedback"> 
      <label class="control-label">Forma de Compra: <span class="symbol required"></span></label>
            <i class="fa fa-bars form-control-feedback"></i>
 <select name="formacompra" id="formacompra" class="form-control" disabled required="" aria-required="true">
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

<div class="row"> 
                           <div class="col-md-12"> 
                               <div class="form-group has-feedback"> 
<label class="control-label">Fecha Vence Cr&eacute;dito: <span class="symbol required"></span></label>
<input class="form-control calendario" type="text" name="fechavencecredito" id="fechavencecredito" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Fecha Vence Cr&eacute;dito" disabled required="" aria-required="true">
                        <i class="fa fa-calendar form-control-feedback"></i> 
                              </div> 
                        </div>
                    </div>
					
				<div class="row"> 
                           <div class="col-md-12"> 
                               <div class="form-group has-feedback"> 
                         <label class="control-label">Fecha de Compra: <span class="symbol required"></span></label>
<input class="form-control" type="text" name="fecharegistro" id="fecharegistro" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Fecha Compra" date="" readonly="readonly">
                              </div> 
                        </div>
                    </div>
					
					
                                    </div><!-- /.box-body -->
								</div>
                          </div>
                    
                     </div>
                </div>
           </div>
		   </form>
		   
		   
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