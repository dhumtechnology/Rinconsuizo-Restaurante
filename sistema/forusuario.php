<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
if ($_SESSION['acceso'] == "administrador") {

$con = new Login();
$con = $con->ContarRegistros();

$tra = new Login();
$ses = $tra->ExpiraSession();

if(isset($_POST['btn-submit']))
{
$reg = $tra->RegistrarUsuarios();
exit;
} 
else if(isset($_POST['btn-update']))
{
$reg = $tra->ActualizarUsuarios();
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
<script type="text/javascript" src="assets/script/jquery.mask.js"></script>
<script type="text/javascript" src="assets/script/titulos.js"></script>
<script type="text/javascript" src="assets/script/script2.js"></script>
<script type="text/javascript" src="assets/script/validation.min.js"></script>
<script type="text/javascript" src="assets/script/script.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
	$("#nrotelefono").mask("999 999 9999");
	});
</script>
<!-- script jquery -->	
	

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
<div class="page-header-title"><h4 class="pull-left page-title"><i class="fa fa-tasks"></i> Gestión de Usuarios</h4>
<ol class="breadcrumb pull-right"><li><a href="panel">Inicio</a></li>
<li><a href="usuarios">Control</a></li>
<li class="active">Gestión</li>
</ol>

<div class="clearfix"></div>

</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-edit"></i> Gestión de Usuarios</h3></div>
<div class="panel-body">
<div class="row">
<div class="col-sm-12 col-xs-12"> 
            <div class="box-body">
			
<?php  if (isset($_GET['codigo'])) {
			
			$reg = $tra->UsuariosPorId(); ?>
			
<form class="form" name="updateusuario" id="updateusuario" method="post" data-id="<?php echo $reg[0]["codigo"] ?>" action="#" enctype="multipart/form-data" >
				
		<?php } else { ?>
				
		<form class="form" method="post"  action="#" name="usuario" id="usuario" enctype="multipart/form-data">	
			
		<?php } ?>
                                                  <div id="error">
                                                 <!-- error will be shown here ! -->
                      </div>
												
				<div class="row"> 
                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
      <label class="control-label">Nit de Usuario: <span class="symbol required"></span></label> 
 <input type="hidden" name="codigo" id="codigo" <?php if (isset($reg[0]['codigo'])) { ?> value="<?php echo $reg[0]['codigo']; ?>"<?php } ?>>
			  <input type="text" class="form-control" name="cedula" id="cedula" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Nit de Usuario" <?php if (isset($reg[0]['cedula'])) { ?> value="<?php echo $reg[0]['cedula']; ?>"<?php } ?> required="" aria-required="true">
                        <i class="fa fa-pencil form-control-feedback"></i>  
                              </div> 
                        </div>
															
							<div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
     <label class="control-label">Nombre de Usuario: <span class="symbol required"></span></label> 
  <input type="text" class="form-control" name="nombres" id="nombres" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Nombre de Usuario" <?php if (isset($reg[0]['nombres'])) { ?> value="<?php echo $reg[0]['nombres']; ?>"<?php } ?> required="" aria-required="true">
                        <i class="fa fa-pencil form-control-feedback"></i>  
                              </div> 
                        </div>

                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
      <label class="control-label">N° de Teléfono: <span class="symbol required"></span></label> 
 <input type="text" class="form-control" name="nrotelefono" id="nrotelefono" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese N° de Teléfono" <?php if (isset($reg[0]['nrotelefono'])) { ?> value="<?php echo $reg[0]['nrotelefono']; ?>"<?php } ?> required="" aria-required="true">
                        <i class="fa fa-phone form-control-feedback"></i>  
                              </div> 
                        </div>	
                    </div>
					
					<div class="row"> 
                              
              <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Cargo de Usuario: <span class="symbol required"></span></label> 
    <input type="text" class="form-control" name="cargo" id="cargo" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Cargo de Usuario" <?php if (isset($reg[0]['cargo'])) { ?> value="<?php echo $reg[0]['cargo']; ?>"<?php } ?> required="" aria-required="true">
                        <i class="fa fa-pencil form-control-feedback"></i>  
                              </div> 
                        </div> 
                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
  <label class="control-label">Correo de Usuario: <span class="symbol required"></span></label> 
 <input type="text" class="form-control" name="email" id="email" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Correo de Usuario" <?php if (isset($reg[0]['email'])) { ?> value="<?php echo $reg[0]['email']; ?>"<?php } ?> required="" aria-required="true">
                        <i class="fa fa-envelope-o form-control-feedback"></i>  
                              </div> 
                        </div>
															
							<div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
  <label class="control-label">Usuarios de Acceso: <span class="symbol required"></span></label> 
<input type="text" class="form-control" name="usuario" id="usuario" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Usuario de Acceso" <?php if (isset($reg[0]['usuario'])) { ?> value="<?php echo $reg[0]['usuario']; ?>"<?php } ?> required="" aria-required="true">
                        <i class="fa fa-user form-control-feedback"></i>  
                              </div> 
                    </div> 	
               </div>
					
					<div class="row"> 
                           <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
  <label class="control-label">Password de Acceso: <span class="symbol required"></span></label> 
   <input name="password" class="form-control" type="text" id="password" onKeyUp="this.value=this.value.toUpperCase();" placeholder="Ingrese Password de Acceso" autocomplete="off" required="required"/>
                        <i class="fa fa-unlock form-control-feedback"></i>  
                              </div> 
                        </div> 	
															
							<div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
    <label class="control-label">Repita Password: <span class="symbol required"></span></label>
                                  <input type="text" class="form-control" name="password2" id="password2" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Password de Acceso" required="" aria-required="true">
                        <i class="fa fa-unlock form-control-feedback"></i>  
                              </div> 
                        </div>

                            <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
     <label class="control-label">Nivel de Acceso: <span class="symbol required"></span></label>
            <i class="fa fa-bars form-control-feedback"></i>
                              <?php if (isset($reg[0]['nivel'])) { ?>
			 <select name="nivel" id="nivel" class="form-control" required="" aria-required="true">
												<option value="">SELECCIONE</option>
<option value="ADMINISTRADOR"<?php if (!(strcmp('ADMINISTRADOR', $reg[0]['nivel']))) {echo "selected=\"selected\"";} ?>>ADMINISTRADOR(A)</option>
<option value="CAJERO"<?php if (!(strcmp('CAJERO', $reg[0]['nivel']))) {echo "selected=\"selected\"";} ?>>CAJERO(A)</option>
<option value="REPARTIDOR"<?php if (!(strcmp('REPARTIDOR', $reg[0]['nivel']))) {echo "selected=\"selected\"";} ?>>REPARTIDOR(A)</option>
<option value="COCINERO"<?php if (!(strcmp('COCINERO', $reg[0]['nivel']))) {echo "selected=\"selected\"";} ?>>COCINERO(A)</option>
<option value="MESERO"<?php if (!(strcmp('MESERO', $reg[0]['nivel']))) {echo "selected=\"selected\"";} ?>>MESERO(A)</option>
										  </select>
                             <?php } else { ?>  
							 <select name="nivel" id="nivel" class="form-control" required="" aria-required="true">
												<option value="">SELECCIONE</option>
												<option value="ADMINISTRADOR">ADMINISTRADOR(A)</option>
												<option value="CAJERO">CAJERO(A)</option>
                        <option value="REPARTIDOR">REPARTIDOR(A)</option>
												<option value="COCINERO">COCINERO(A)</option>
												<option value="MESERO">MESERO(A)</option>
							    </select>
                              <?php } ?>
                              </div> 
                        </div>
                    </div>
					
					<div class="row">
                              
              <div class="col-md-4"> 
                              <div class="form-group has-feedback"> 
       <label class="control-label">Status de Usuario: <span class="symbol required"></span></label>
            <i class="fa fa-bars form-control-feedback"></i>
                               <?php if (isset($reg[0]['status'])) { ?>
                     <select name="status" id="status" class="form-control" required="" aria-required="true">
                        <option value="">SELECCIONE</option>
               <option value="ACTIVO"<?php if (!(strcmp('ACTIVO', $reg[0]['status']))) {echo "selected=\"selected\"";} ?>>ACTIVO</option>
         <option value="INACTIVO"<?php if (!(strcmp('INACTIVO', $reg[0]['status']))) {echo "selected=\"selected\"";} ?>>INACTIVO</option>
                      </select>
                             <?php } else { ?>
               <select name="status" id="status" class="form-control" required="" aria-required="true">
                        <option value="">SELECCIONE</option>
                        <option value="ACTIVO">ACTIVO</option>
                        <option value="INACTIVO">INACTIVO</option>
                      </select>
                   <?php } ?> 
                              </div> 
                        </div> 

						 <div class="col-sm-4">
													<div class="fileinput fileinput-new" data-provides="fileinput">
					<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 90px; height: 100px;">
<?php if (isset($reg[0]['cedula'])) {
	if (file_exists("fotos/".$reg[0]['cedula'].".jpg")){
    echo "<img src='fotos/".$reg[0]['cedula'].".jpg?".date('h:i:s')."' class='img-rounded' border='0' width='100' height='110' title='Foto del Usuario' data-rel='tooltip'>"; 
}else{
    echo "<img src='fotos/avatar.jpg' class='img-rounded' border='1' width='90' height='100' title='SIN FOTO' data-rel='tooltip'>"; 
} } else {
	echo "<img src='fotos/avatar.jpg' class='img-rounded' border='1' width='90' height='100' title='SIN FOTO' data-rel='tooltip'>"; 
}
?>
													  </div>
														<div>
															<span class="btn btn-default btn-file">
							<span class="fileinput-new"><i class="fa fa-file-image-o"></i> Imagen</span>
							 <span class="fileinput-exists"><i class="fa fa-paint-brush"></i> Imagen</span>
				<input type="file" size="10" data-original-title="Subir Fotografia" data-rel="tooltip" placeholder="Suba su Fotografia" name="imagen" id="imagen"/>
															</span>
 <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times-circle"></i> Remover</a><small><p>Para Subir su Fotografia debe tener en cuenta lo siguiente:<br> * La Imagen debe ser extension.jpg<br> * La imagen no debe ser mayor de 50 KB</p></small>															</div>
													</div>
												</div>
						 	
                    </div>
			  
            <div class="modal-footer"> 
<?php  if (isset($_GET['codigo'])) { ?>
<button type="submit" name="btn-update" id="btn-update" class="btn btn-primary"><span class="fa fa-edit"></span> Actualizar</button>
<button class="btn btn-danger" type="reset"><span class="fa fa-trash-o"></span> Cancelar</button>
    <?php } else { ?>
<button type="submit" name="btn-submit" id="btn-submit" class="btn btn-primary"><span class="fa fa-save"></span> Registrar</button> 
<button class="btn btn-danger" type="reset"><span class="fa fa-trash-o"></span> Limpiar</button>    
    <?php } ?>  
                          </div>
                                </form>
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