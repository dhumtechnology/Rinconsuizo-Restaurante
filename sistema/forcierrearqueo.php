<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"] == "cajero") {

$con = new Login();
$con = $con->ContarRegistros();

$tra = new Login();
$ses = $tra->ExpiraSession();

$reg = $tra->ArqueoCajaPorId();

if(isset($_POST['btn-update']))
{
$reg = $tra->CerrarArqueoCaja();
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
<script type="text/javascript" src="assets/script/validation.min.js"></script>
<script type="text/javascript" src="assets/script/script.js"></script>
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
<div class="page-header-title"><h4 class="pull-left page-title"><i class="fa fa-tasks"></i> Gestión de Cierre de Caja</h4>
<ol class="breadcrumb pull-right"><li><a href="panel">Inicio</a></li>
<li><a href="arqueoscajas">Control</a></li>
<li class="active">Cierre de Caja</li>
</ol>

<div class="clearfix"></div>

</div>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<div class="panel panel-primary">
<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-edit"></i> Gestión de Cierre de Caja</h3></div>
<div class="panel-body">
<div class="row">
<div class="col-sm-12 col-xs-12"> 
            <div class="box-body">
						
<form class="form" name="cierrecaja" id="cierrecaja" method="post" data-id="<?php echo $reg[0]["codarqueo"] ?>" action="#">
				
                                                  <div id="error">
                                                 <!-- error will be shown here ! -->
                      </div>
												
				<div class="row">
				

        <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
                <label class="control-label">Caja N°: <span class="symbol required"></span></label>
 <input type="hidden" name="codarqueo" id="codarqueo" <?php if (isset($reg[0]['codarqueo'])) { ?> value="<?php echo $reg[0]['codarqueo']; ?>"<?php } ?>>
<?php if ($_SESSION["acceso"]=="cajero") { ?><input type="hidden" class="form-control" name="codcaja" id="codcaja" value="<?php echo $reg[0]['codcaja']; ?>" ><input type="text" class="form-control" name="nrocaja" id="nrocaja" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" value="<?php echo $reg[0]['nrocaja'].": ".$reg[0]['nombrecaja']; ?>" readonly="readonly"><?php } else { ?>
            <i class="fa fa-bars form-control-feedback"></i>
							  <select name="codcaja" id="codcaja" class="form-control" required="" aria-required="true">
												<option value="">SELECCIONE</option>
			<?php
			$caja = new Login();
			$caja = $caja->ListarCajas();
			for($i=0;$i<sizeof($caja);$i++){
		              ?>
	<option value="<?php echo $caja[$i]['codcaja']; ?>"<?php if (!(strcmp($reg[0]['codcaja'], htmlentities($caja[$i]['codcaja'])))) {echo "selected=\"selected\"";} ?>><?php echo $caja[$i]['nombrecaja']; ?></option>			  
                      <?php } ?>
							    </select>
								<?php } ?>  
                              </div> 
                        </div>
						

				<div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
         <label class="control-label">Monto Inicial: <span class="symbol required"></span></label>
 <input type="text" class="form-control" name="montoinicial" id="montoinicial" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Monto Inicial" value="<?php echo $reg[0]['montoinicial']; ?>" readonly="readonly">
                        <i class="fa fa-usd form-control-feedback"></i>  
                              </div> 
                        </div>

				 
				<div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
              <label class="control-label">Ingresos: <span class="symbol required"></span></label>
 <input type="text" class="form-control" name="ingresos" id="ingresos"  autocomplete="off" placeholder="Ingrese Ingresos en Caja" value="<?php echo $reg[0]['ingresos']; ?>" readonly="readonly">
                        <i class="fa fa-usd form-control-feedback"></i>  
                              </div> 
                        </div> 
						  	
				</div>
				
				<div class="row">
						
				<div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
               <label class="control-label">Egresos: <span class="symbol required"></span></label>
 <input type="text" class="form-control" name="egresos" id="egresos" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Egresos de Caja" value="<?php echo $reg[0]['egresos']; ?>" readonly="readonly">
                        <i class="fa fa-usd form-control-feedback"></i>  
                              </div> 
                        </div>
            
        <div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
      <label class="control-label">Estimado en Caja: <span class="symbol required"></span></label>
 <input type="text" class="form-control" name="estimado" id="estimado" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Estimado en Caja" value="<?php echo number_format($reg[0]['montoinicial']+$reg[0]['ingresos']-$reg[0]['egresos'], 2, '.', ''); ?>" readonly="readonly">
                        <i class="fa fa-usd form-control-feedback"></i>  
                              </div> 
                        </div> 
                        
				<div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
   <label class="control-label">Efectivo Disponible: <span class="symbol required"></span></label>
 <input type="text" class="form-control calculo" name="dineroefectivo" id="dineroefectivo" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Dinero en Efectivo" onKeyPress="EvaluateText('%f', this);" onBlur="this.value = NumberFormat(this.value, '2', '.', '')" required="" aria-required="true">
                        <i class="fa fa-usd form-control-feedback"></i>  
                              </div> 
                        </div>  	
				</div>
				
<div class="row">
				<div class="col-md-4"> 
                               <div class="form-group has-feedback"> 
        <label class="control-label">Diferencia: <span class="symbol required"></span></label>
 <input type="text" class="form-control" name="diferencia" id="diferencia" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Diferencia en Caja" readonly="readonly">
                        <i class="fa fa-usd form-control-feedback"></i>  
                              </div> 
                        </div> 
						
						
				<div class="col-md-8"> 
                               <div class="form-group has-feedback"> 
                        <label class="control-label">Comentario: </label>
<textarea name="comentarios" class="form-control" id="comentarios" onKeyUp="this.value=this.value.toUpperCase();" autocomplete="off" placeholder="Ingrese Comentario de Cierre" required="" aria-required="true"></textarea>
                        <i class="fa fa-comment-o form-control-feedback"></i>  
                              </div> 
                        </div>  	
				</div><br>
					
             <div class="modal-footer"> 
<button type="submit" name="btn-update" id="btn-update" class="btn btn-primary"><span class="fa fa-edit"></span> Cerrar Caja</button>
<button class="btn btn-danger" type="reset"><span class="fa fa-trash-o"></span> Cancelar</button>  
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