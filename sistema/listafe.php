<?php
require_once("class/class.php"); 
if(isset($_SESSION['acceso'])) { 
if ($_SESSION['acceso'] == "administrador") {

$con = new Login();
$con = $con->ContarRegistros();

$tra = new Login();
$ses = $tra->ExpiraSession();
$reg = $tra->ListarSalas();


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
<script type="text/jscript" language="javascript" src="assets/script/script2.js"></script>
<!-- script jquery -->

</head>
<body onLoad="muestraReloj()" class="fixed-left">
                    
<div id="panel-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
                                            <div class="modal-dialog">
                                                <div class="modal-content p-0 b-0">
                                                    <div class="panel panel-color panel-primary">
                                                        <div class="panel-heading"> 
<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src="assets/images/close.png"/></button> 
            <h3 class="panel-title"><i class="fa fa-align-justify"></i> Datos de Sala</h3> 
                                                        </div> 
                                                        <div class="panel-body"> 
                                                         <div id="muestrasalamodal"></div>
                                                        </div>
                                                     <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-times-circle"></span> Aceptar</button>
                              </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                        
                                        
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
<style>
table tr:nth-child(odd) {background-color: #FBF8EF;}
table tr:nth-child(even) {background-color: #EFFBF5;}
 #valor1 {
border-bottom: 2px solid #F5ECCE;
} 
#valor1:hover {             
background-color: white;
border-bottom: 2px solid #A9E2F3
} 
</style>
<style type="text/css">
   .thumbnail1{
position: relative;
z-index: 0; 
}
.thumbnail1:hover{
background-color: transparent;
z-index: 50;
}
.thumbnail1 span{ /*Estilos del borde y texto*/
position: absolute;
background-color: white;
padding: 5px;
left: -100px;

visibility: hidden;
color: #FFFF00;
text-decoration: none;
}
.thumbnail1 span img{ /*CSS for enlarged image*/
border-width: 0;
padding: 2px;
}
.thumbnail1:hover span{ /*CSS for enlarged image on hover*/
visibility: visible;
top: 17px;
left: 40px; /*position where enlarged image should offset horizontally */
} 
img.imagen2{
padding:4px;
border:3px #0489B1 solid;
margin-left: 2px;
margin-right:5px;
margin-top: 5px;
float:left;
}
table tr:nth-child(odd) {background-color: #F5F6CE;}
table tr:nth-child(even) {background-color: #CEF6E3;}
#valor1:hover {            
background-color: white;
border-bottom: 2px solid #A9E2F3;
}  
#valor2:hover {             
background-color: white;
border-bottom: 2px solid #A9E2F3;
} 
#valor1 {             
background-color: #FBF8EF;
border-bottom: 2px solid #F5ECCE;
}  
#valor2 {              
background-color: #EFFBF5;
border-bottom: 2px solid #F5ECCE;
} 
.dt-button.red {
    color: black;
    background:red;
}
.dt-button.orange {
    color: black;
    background:orange;
}
.dt-button.green {
    color: black;
    background:green;
}
.dt-button.green1 {
    color: black;
    background:#01DFA5;
}
.dt-button.green2 {
    color: black;
     background:#2E9AFE;
}
tfoot {
    display: table-header-group;
}
.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
  background: none;
  color: black!important;
  border-radius: 4px;
  border: 1px solid #828282;
}
.dataTables_wrapper .dataTables_paginate .paginate_button:active {
  background: none;
  color: black!important;
}

th {
    color: #666;
    font-size: 11px !important;
}
.text-right {
    text-align: left !important;
}
</style>

<div class="content-page">
<div class="content">
<div class="container">
<div class="row">
<div class="col-sm-12">
<div class="page-header-title"><h4 class="pull-left page-title"><i class="fa fa-tasks"></i> Lista de documentos electrónicos</h4>
<ol class="breadcrumb pull-right"><li><a href="panel">Inicio</a></li>
<li class="active">Documentos</li>
</ol>

<div class="clearfix"></div>
</div>
</div>
</div>



<div class="row">
<div class="col-md-12">
<div class="panel panel-primary">


<div class="panel-body">
<div id="datatable-responsive_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">


<div class="row">
<div class="col-sm-12">



<div id="resultados"></div>
<?php

	require_once ("model/db.php");
	require_once ("model/conexion.php");
    date_default_timezone_set('America/Lima');
    $fecha1  = date("Y-m-d H:i:s");
	$action = 'ajax';
	if($action == 'ajax'){               
		$sTable = "ventas vta, clientes clt, usuarios usu";
		$sWhere = "";
		$sWhere.=" WHERE vta.codcliente=clt.codcliente and vta.codigo = usu.codigo and vta.comprobante < 3";
     
		$sWhere.=" ";
		include 'view/facturacion/pagination.php';
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 100; 
		$adjacents  = 4; 
		$offset = ($page - 1) * $per_page;
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './facturas.php';
        $sql1="SELECT * FROM configuracion where id=1";
		$query1 = mysqli_query($con, $sql1);
        $row1=mysqli_fetch_array($query1);
        $ruc1=$row1['rifempresa'];
        $sql="SELECT vta.idventa, vta.codventa as numero_factura, vta.fechaventa, vta.formapagove, vta.comprobante, vta.serie_doc, vta.statusventa, vta.aceptado, vta.enviado, vta.totalpago, vta.observaciones, clt.nomcliente as nombre_cliente, clt.cedcliente as dni_cliente, clt.documento as tipodoc, clt.tlfcliente as telefono_cliente, clt.emailcliente as email_cliente, usu.nombres as nombres_usuario FROM  $sTable $sWhere ";
		$query = mysqli_query($con, $sql);
		//echo json_encode($sql);
		if ($numrows>0){
			echo mysqli_error($con);
			?>
			
			  <table id="datatable-responsive" style="width: 100%;font-size: 11px;"  cellspacing="0" >
                <thead>
				<tr  style="background-color:#FE9A2E;color:white;font-size: 10px; ">
                    <th  class="no-sort"> 
                        <!--<input type="checkbox" onClick="toggle(this)" /> Sel. Todo<br/>-->
                        <!--<a href="#" class='btn btn-primary btn-xs' title='Enviar sunat' onclick="enviar_todos();">Enviar</i></a> -->
                    </th>
					<th>Nro Doc</th>
                    <th class='text-right'>Tipo de Doc</th>
                    <th>Fecha</th>
					<th>Cliente</th>
					<th class='text-right'>Total</th>
                    <th class='text-right'>Hora envio a Sunat</th>
                    <th class='text-right'>Desc<br>XML</th>
                    <th class='text-right'><img src="assets/img/sunat.png" width="25" height="25">Enviar</th>
					<th class='text-right'>Respuesta<br>Sunat(CDR)</th>
					<th class='text-right'>Imprimir</th>
					
				</tr>
                </thead>
				<?php
				while ($row=mysqli_fetch_array($query)){
                        $activo=$row['enviado'];
						if ($activo=='1'){
                            $id_venta=$row['numero_factura'];
                            $nro_doc=$row['numero_factura'];
                            $fecha=date("d/m/Y", strtotime($row['fechaventa']));
                            $razon_social=$row['nombre_cliente'];
                            if ($row['tipodoc']=="2"){
                                $nombre_cliente = $row['nombre_cliente'];
                            } else {
                                $nombre_cliente = $row['nombre_cliente'];
                            }
                            $telefono_cliente=$row['telefono_cliente'];
                            $ruc=$row['dni_cliente'];
                            $email_cliente=$row['email_cliente'];
                            
                            $id_tipo_doc=$row['comprobante'];
                            $tip=0;
                            if ($id_tipo_doc==1){
                                $serie="B".$row['serie_doc'];
                                $tip="03";
                                $estado1="Boleta";
                            } else if ($id_tipo_doc==2){
                                $serie="F".$row['serie_doc'];
                                $tip="01";
                                $estado1="Factura";
                            }
                            
                            $dni=$row['dni_cliente'];
                                                
						    $nombre_vendedor=$row['nombres_usuario'];
                            
                            $nro_doc1=str_pad($nro_doc, 8, "0", STR_PAD_LEFT);
                            $doc1="$ruc1-$tip-$serie-$nro_doc1.XML";
                            
                            $doc2="$ruc1-$tip-$serie-$nro_doc1";
                            
                            $doc3="R-$ruc1-$tip-$serie-$nro_doc1.XML";
                            $aceptado1="No enviado";
                            $fecha3="";
                            $hora3="";
                            if (file_exists('view/inicio/sunat/cdr/'.$doc3.'')) {
                                $xml = file_get_contents('view/inicio/sunat/cdr/'.$doc3.'');
                                #== Obteniendo datos del archivo .XML 
                                $aceptado="";
                                $DOM = new DOMDocument('1.0', 'ISO-8859-1');
                                $DOM->preserveWhiteSpace = FALSE;
                                $DOM->loadXML($xml);
                                ### DATOS DE LA FACTURA ####################################################
                                // Obteniendo RUC.
                                $DocXML = $DOM->getElementsByTagName('Description');
                                foreach($DocXML as $Nodo){
                                    $aceptado = $Nodo->nodeValue; 
                                }  
                                $DocXML = $DOM->getElementsByTagName('ResponseDate');
                                foreach($DocXML as $Nodo){
                                    $fecha3 = $Nodo->nodeValue; 
                                }
                                $DocXML = $DOM->getElementsByTagName('ResponseTime');
                                foreach($DocXML as $Nodo){
                                $hora3 = $Nodo->nodeValue; 
                                }
                                $fecha3=date("d/m/Y", strtotime($fecha3));
                                $pos = strpos($aceptado, "aceptada");
                                if ($pos === false) {
                                    $aceptado1= "No aceptada";
                                } else {
                                $aceptado1= "Aceptada";

                                }
						    }
                            if($row['aceptado']=="Aceptada"){
                            $aceptado1= "Aceptada"; 
                            }
                            if($fecha3=="" and $aceptado1=="Aceptada"){
                                $fecha3=$row['obs'];
                            }
                           
                            $mon="S/.";
//                             $estado_factura=$row['condiciones'];
                            //$total_venta=floatval($row['total']);
							$total_venta=floatval($row['totalpago']);
							
					?>
					<tr id="valor1">
                        <td align="center" style="border: 1px solid #e2dfdf;">
                           
                        </td>
                        <td style="border: 1px solid #e2dfdf;"><?php echo $serie; ?>-<?php echo $nro_doc; ?></td>
                        <td style="border: 1px solid #e2dfdf;"><?php echo $estado1; ?></td>
                        <td style="border: 1px solid #e2dfdf;"><?php echo $fecha; ?></td>
						<td style="border: 1px solid #e2dfdf;"><?php echo $nombre_cliente;?></td>   
                        <td class='text-right'><?php print"$mon"; echo number_format ($total_venta,2); ?></td>					
                        <td class='text-right'><font color='black'><strong><?php print"$fecha3&nbsp;&nbsp;"; echo $hora3; ?></strong></font></td>
						<td class="text-right" style="border: 1px solid #e2dfdf;">
                            <?php
                            if($aceptado1=="No enviado"){
                            ?>
                            <a href="#" class='btn btn-primary btn-xs' title='Descargar xml' onclick="imprimir_factura('<?php echo $doc1;?>');"><i class="glyphicon glyphicon-download"></i></a> 
                            <?php
                            }
                            if($aceptado1<>"No enviado"){
                                ?> 
                            <a href="#" class='btn btn-success btn-xs' title='Descargar xml' onclick="imprimir_factura2('<?php echo $doc1;?>');"><i class="glyphicon glyphicon-download"></i></a> 
                                    <?php
                            }
                            ?>
                        </td>
                        <td class="text-right" style="border: 1px solid #e2dfdf;">
                            <?php
                            if($aceptado1<> "Aceptada"){
                                ?>
                            <a href="#" class='btn btn-warning btn-xs' title='Enviar sunat' onclick="enviar('<?php echo $doc2."-".$id_venta;?>');"><i class="glyphicon glyphicon-download">Enviar</i></a> 
    
                                    <?php
                            }else{
                                ?>
                            <a class='btn btn-info btn-xs'><i class="glyphicon glyphicon-download">Enviado</i></a> 
    
                                    <?php
                            }
                            ?>
                        </td>
                        <td class="text-right" style="border: 1px solid #e2dfdf;">
                            <?php
                            if($serie<>"" and ($id_tipo_doc<=2) and $aceptado1=="Aceptada"){
                            ?>
                            <a href="#" class='btn btn-danger btn-xs' title='Descargar CDR' onclick="imprimir_factura1('<?php echo $doc3;?>','<?php echo $id_venta;?>');"><?php echo $aceptado1;?></a> 
                            <?php
                            } else {                                
                                ?>
                                <a href="#" class='btn btn-danger btn-xs' title='Descargar CDR' ><?php echo $aceptado1;?></a>
                                <?php 
                            }
                            ?>
                        </td style="border: 1px solid #e2dfdf;"> 
                        <td style="border: 1px solid #e2dfdf;">
                        	<a href="reportepdffa?codventa=<?php echo $id_venta; ?>&tipo=TICKET" class="btn btn-xs btn-success" target="_blank" style="margin: 4px !important;"><i class="fa fa-print"></i></a>
                        </td>
                        
					</tr>
					<?php
                                        $numrows=$numrows-1;
                                        
				}
                            }
                            ?>
			</table>
                   
                    <?php
		}
            }
?>

</div>
</div>
</div>
</div>
</div>
</div>
</div>


</div>
</div>
</div>




<script type="text/javascript" src="assets/js/VentanaCentrada.js"></script>

<script>

function enviar (id){
            $.ajax({
                type: "GET",
                url: "view/inicio/sunat/enviar_sunat_web_service.php",
                data: "fac=" + id + "&enviar_todos=0",
                beforeSend: function(objeto){
                    $("#resultados").html("Mensaje: Cargando...");
                },
                success: function(datos){  
                    $("#resultados").html(datos);
                    load(1);
                }
            });     
        }


function enviar_todos (){
            var favorite = [];
            $.each($("input[name='check_enviar']:checked"), function(){            
                favorite.push($(this).val());
            });

            if (favorite==''){
              alert ('Debe Seleccionar un registro como minimo');
            } else {
              var q= $("#q").val();         
              $.ajax({
                type: "GET",
                url: "view/inicio/sunat/enviar_sunat_web_service.php",
                data: "enviar_todos=1" + "&all_fact="+favorite.join(","),"q":q,
                beforeSend: function(objeto){
                  $("#resultados").html("Mensaje: Cargando...");
                  },
                success: function(datos){
                  $("#resultados").html(datos);
                    load(1);
                }
              });
            }
         }  
         
        function imprimir_factura(id_factura){
            VentanaCentrada('view/inicio/sunat/factura-sin-firmar/'+id_factura,'Factura','','1024','768','true');
        }

        function imprimir_factura1(id_factura, id_venta){
            var url = 'view/inicio/sunat/cdr/'+id_factura;
            $.get(url)
            .done(function() { 
                VentanaCentrada('view/inicio/sunat/cdr/'+id_factura,'Factura','','1024','768','true'); 
            }).fail(function() { 
                VentanaCentrada('view/inicio/sunat/cdr/presentar_xml.php?id_factura='+id_factura+'&id_venta='+id_venta,'Factura','','1024','768','true');
            })
            
        }
                   
        function imprimir_factura2(id_factura){
            VentanaCentrada('view/inicio/sunat/factura-firmada/'+id_factura,'Factura','','1024','768','true');
        }

        function enviar_correo(id_venta){
            VentanaCentrada('view/config/email/index.php?id_venta='+id_venta,'Envio Correo','','600','325','true');
        }

</script>

<footer class="footer"> <i class="fa fa-copyright"></i> <span class="current-year"></span>. </footer>
</div>
</div> 

   
<script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
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
        <script src="assets/plugins/moment/moment.js"></script>
        
        <!-- jQuery  -->
        <script src="assets/plugins/waypoints/lib/jquery.waypoints.js"></script>
        <script src="assets/plugins/counterup/jquery.counterup.min.js"></script>
        
        <!-- Datatables-->
        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.bootstrap.js"></script>
        <script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="assets/plugins/datatables/buttons.bootstrap.min.js"></script>
        <script src="assets/plugins/datatables/jszip.min.js"></script>
        <script src="assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="assets/plugins/datatables/vfs_fonts.js"></script>
        <script src="assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="assets/plugins/datatables/buttons.print.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.keyTable.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="assets/plugins/datatables/responsive.bootstrap.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.scroller.min.js"></script>

        <!-- Datatable init js -->
        <script src="assets/pages/datatables.init.js"></script>

        <!-- jQuery  -->
        <script src="assets/pages/jquery.todo.js"></script>
        
        <!-- jQuery  -->
        <script src="assets/pages/jquery.dashboard.js"></script>
        
        <script type="text/javascript">
            /* ==============================================
            Counter Up
            =============================================== */
            jQuery(document).ready(function($) {
                $('.counter').counterUp({
                    delay: 100,
                    time: 1200
                });
            });
        </script>
        

        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable(
                  
                  );

                $('#datatable-keytable').DataTable( { keys: true } );
                $('#datatable-responsive').DataTable({
                    "pageLength": 25,
                  });
                $('#datatable-scroller').DataTable( { ajax: "assets/plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
                var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
            } );
            TableManageButtons.init();
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