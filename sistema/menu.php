
<!--#e5960c #461756 -->
<?php 
if(isset($_SESSION['acceso'])) { 
  if ($_SESSION['acceso'] == "administrador" || $_SESSION["acceso"]=="cajero" || $_SESSION["acceso"]=="cocinero" || $_SESSION["acceso"]=="mesero" || $_SESSION["acceso"]=="repartidor") {

    if($_SESSION['acceso'] == "administrador") { ?>

<!----- INICIO DE MENU ----->
 <div id="sidebar-menu">
 <ul>
 <li> <a href="panel" class="waves-effect"><i class="fa fa-desktop"></i><span> Mostrador </span></a></li>


<li> <a href="delivery" class="waves-effect"><i class="fa fa-calendar"></i><span> delivery </span></a></li>

 <li> <a href="reservaweb" class="waves-effect"><i class="fa fa-calendar"></i><span> Reserva por web </span></a></li>
 



  <li class="has_sub"> 
 <a href="javascript:void(0);" class="waves-effect">
 <i class="fa fa-cog"></i> <span> Administración </span><span class="pull-right"><i class="ion ion-plus"></i></span></a>
 <ul class="list-unstyled" style="">
 <li><a href="cargamasiva">Carga Masiva</a></li>
 <li><a href="configuracion">Configuración</a></li>
 <li><a href="salas">Salas</a></li>
 <li><a href="mesas">Mesas</a></li>
 <li><a href="mediospagos">Medios de Pago</a></li>
 <li><a href="categorias">Categorias</a></li>
 <li class="has_sub"><a href="javascript:void(0);"><span>Seguridad</span><i class="pull-right fa fa-angle-double-right"></i></a>
                                <ul style="">
                                  <li><a href="usuarios">Usuarios</a></li>
								<li><a href="logs">Logs de Acceso</a></li>
                                </ul>
                        </li>
					  <li class="has_sub"><a href="javascript:void(0);"><span>Base de Datos</span><i class="pull-right fa fa-angle-double-right"></i></a>
                                <ul style="">
                                  <li><a href="backup">Respaldar</a></li>
                                  <li><a href="restore">Restaurar</a></li>
                                </ul>
                        </li>
 </ul>
 </li>
 
 <li class="has_sub"> 
 <a href="javascript:void(0);" class="waves-effect">
 <i class="fa fa-suitcase"></i> <span> Mantenimiento </span> <span class="pull-right"><i class="ion ion-plus"></i></span></a>
 <ul class="list-unstyled" style="">
 <li><a href="cajas">Cajas</a></li>
 <li><a href="clientes">Clientes</a></li>
 <li><a href="proveedores">Proveedores</a></li> 
 <li class="has_sub"><a href="javascript:void(0);"><span>Ingredientes</span><i class="pull-right fa fa-angle-double-right"></i></a>
          <ul style="">
          <li><a href="ingredientes">Ingredientes</a></li>
          <li><a href="buscakardexi">Movimientos</a></li>
          <li><a href="ingredientesvendidos">Vendidos</a></li>
         </ul>
       </li>
 <li class="has_sub"><a href="javascript:void(0);"><span>Productos</span><i class="pull-right fa fa-angle-double-right"></i></a>
          <ul style="">
          <li><a href="productos">Productos</a></li>
          <li><a href="buscakardexp">Movimientos</a></li>
          <li><a href="productosvendidos">Vendidos</a></li>
         </ul>
       </li>
 </ul>
 </li>
 
  <li class="has_sub"> 
 <a href="javascript:void(0);" class="waves-effect">
 <i class="fa fa-cart-arrow-down"></i> <span> Compras </span> <span class="pull-right"><i class="ion ion-plus"></i></span></a>
 <ul class="list-unstyled" style="">
 <li><a href="forcompras">Nueva Compra</a></li>
 <li><a href="compras"> Consulta de Compras</a></li>
 <li><a href="detallescompras">Detalles de Compras</a></li>
 <li><a href="compraspendientes"> Cuentas por Pagar</a></li>
 <li class="has_sub"><a href="javascript:void(0);"><span>Reportes</span><i class="pull-right fa fa-angle-double-right"></i></a>
  <ul style="">
   <li><a href="comprasxproveedor">Por Proveedor</a></li>
   <li><a href="comprasxfechas">Por Fechas</a></li>
 </ul>
</li>
 </ul>
 </li>
 
<li class="has_sub"> 
 <a href="javascript:void(0);" class="waves-effect">
 <i class="fa fa-cutlery"></i><span> Ventas </span><span class="pull-right"><i class="ion ion-plus"></i></span></a>
 <ul class="list-unstyled" style="">
 <li><a href="arqueoscajas">Arqueo de Caja</a></li>
 <li><a href="movimientoscajas">Movimiento de Cajas</a></li>
 <li><a href="ventas">Ventas</a></li>
 <li><a href="detallesventas">Detalles de Ventas</a></li>
<li class="has_sub"><a href="javascript:void(0);"><span>Reportes</span><i class="pull-right fa fa-angle-double-right"></i></a>
            <ul style="">
            <li><a href="ventasxcajas">Ventas por Cajas</a></li>
            <li><a href="ventasxfechas">Ventas por Fechas</a></li>
            <li><a href="arqueoscajasfechas">Arqueo de Cajas</a></li>
            <li><a href="movimientoscajasfechas">Movim. de Cajas</a></li>
            <li><a href="informeventas">Informe Ventas</a></li>
            <li><a href="informecajas">Informe Cajas</a></li>
           </ul>
         </li>
 </ul>
 </li>
 
 <li class="has_sub"> 
 <a href="javascript:void(0);" class="waves-effect">
 <i class="fa fa-credit-card"></i><span> Cartera de Clientes </span><span class="pull-right"><i class="ion ion-plus"></i></span></a>
 <ul class="list-unstyled" style="">
 <li><a href="forcartera">Nuevo Pago</a></li>
 <li><a href="carteracreditos">Consulta de Pagos</a></li>
 <li class="has_sub"><a href="javascript:void(0);"><span>Reportes</span><i class="pull-right fa fa-angle-double-right"></i></a>
  <ul style="">
  <li><a href="creditoxcliente">Por Clientes</a></li>
  <li><a href="creditoxfecha">Por Fechas</a></li>
 </ul>
</li>
 </ul>
 </li>
 
 <li> <a href="logout" class="waves-effect"><i class="fa fa-power-off"></i> Cerrar Sesión</a></li>
 
 </ul>
 </div>
 <!----- FIN DE MENU ----->
			
			<?php } elseif($_SESSION['acceso'] == "cajero") { ?>


<!----- INICIO DE MENU ----->
 <div id="sidebar-menu">
 <ul>
 <li> <a href="panel" class="waves-effect"><i class="fa fa-desktop"></i><span> Mostrador </span></a></li>

 <li> <a href="delivery" class="waves-effect"><i class="fa fa-motorcycle"></i><span> Delivery </span></a></li>
 
 <li class="has_sub"> 
 <a href="javascript:void(0);" class="waves-effect">
 <i class="fa fa-cutlery"></i><span> Ventas </span><span class="pull-right"><i class="ion ion-plus"></i></span></a>
 <ul class="list-unstyled" style="">
 <li><a href="arqueoscajas">Arqueo de Caja</a></li>
 <li><a href="movimientoscajas">Movimiento de Cajas</a></li>
 <li><a href="ventas">Ventas</a></li>
 <li><a href="detallesventas">Detalles de Ventas</a></li>
<li class="has_sub"><a href="javascript:void(0);"><span>Reportes</span><i class="pull-right fa fa-angle-double-right"></i></a>
            <ul style="">
            <li><a href="ventasxcajas">Ventas por Cajas</a></li>
            <li><a href="ventasxfechas">Ventas por Fechas</a></li>
            <li><a href="arqueoscajasfechas">Arqueo de Cajas</a></li>
            <li><a href="movimientoscajasfechas">Movim. de Cajas</a></li>
            <li><a href="informeventas">Informe Ventas</a></li>
            <li><a href="informecajas">Informe Cajas</a></li>
           </ul>
         </li>
 </ul>
 </li>
 
 <li class="has_sub"> 
 <a href="javascript:void(0);" class="waves-effect">
 <i class="fa fa-credit-card"></i><span> Cartera de Clientes </span><span class="pull-right"><i class="ion ion-plus"></i></span></a>
 <ul class="list-unstyled" style="">
 <li><a href="forcartera">Nuevo Pago</a></li>
 <li><a href="carteracreditos">Consulta de Pagos</a></li>
 <li class="has_sub"><a href="javascript:void(0);"><span>Reportes</span><i class="pull-right fa fa-angle-double-right"></i></a>
  <ul style="">
  <li><a href="creditoxcliente">Por Clientes</a></li>
  <li><a href="creditoxfecha">Por Fechas</a></li>
 </ul>
</li>
 </ul>
 </li>
 
 <li> <a href="logout" class="waves-effect"><i class="fa fa-power-off"></i> Cerrar Sesión</a></li>
 
 </ul>
 </div>
<!----- FIN DE MENU ----->
			

			
			<?php } elseif($_SESSION['acceso'] == "mesero") { ?>


<!----- INICIO DE MENU ----->
 <div id="sidebar-menu">
 <ul>
 <li> <a href="panel" class="waves-effect"><i class="fa fa-desktop"></i><span> Mostrador </span></a></li>
 
 
 <li> <a href="logout" class="waves-effect"><i class="fa fa-power-off"></i> Cerrar Sesión</a></li>
 
 </ul>
 </div>
<!----- FIN DE MENU ----->

      <?php } elseif($_SESSION['acceso'] == "cocinero") { ?>
			
 <!----- INICIO DE MENU ----->
 <div id="sidebar-menu">
 <ul>
 <li> <a href="panel" class="waves-effect"><i class="fa fa-desktop"></i><span> Mostrador </span></a></li>
 
 
 <li> <a href="logout" class="waves-effect"><i class="fa fa-power-off"></i> Cerrar Sesión</a></li>
 
 </ul>
 </div>
<!----- FIN DE MENU ----->

      <?php } elseif($_SESSION['acceso'] == "repartidor") { ?>
      
 <!----- INICIO DE MENU ----->
 <div id="sidebar-menu">
 <ul>
 <li> <a href="panel" class="waves-effect"><i class="fa fa-motorcycle"></i><span> Delivery </span></a></li>
 
 
 <li> <a href="logout" class="waves-effect"><i class="fa fa-power-off"></i> Cerrar Sesión</a></li>
 
 </ul>
 </div>
<!----- FIN DE MENU ----->
		
                <?php } ?>

<link rel="stylesheet" href="assets/css/teclado-tactil.css?v=3">
<script src="assets/script/teclado-tactil.js?v=3"></script>

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