<?php
require_once("class/class.php");
?>
<script type="text/javascript" src="assets/script/script2.js"></script>


<?php if (isset($_GET['salas_mesas'])): ?>
<ul class="nav nav-tabs tabs">
    <?php
    $sala = new Login();
    $sala = $sala->ListarSalas();
    if($sala==""){ echo "";      
    } else {
    for ($i = 0; $i < sizeof($sala); $i++) {
    ?>
    <?php if ($i === 0): ?>
    <li class="tab active">
    <?php else: ?>
    <li class="tab">
    <?php endif; ?>
        <a href="#<?php echo $sala[$i]['codsala'];?>" data-toggle="tab" aria-expanded="true" role="tab">
        <span class="visible-xs" title="<?php echo $sala[$i]['nombresala'];?>"><i class="fa fa-building"></i></span>
        <span class="hidden-xs"><?php echo $sala[$i]['nombresala'];?></span>
        </a>
    </li>
    <?php
        }
    }
        ?>
</ul>
<div class="tab-content">
    <?php
        $sala = new Login();
        $sala = $sala->ListarSalas();
        for ($i = 0; $i < sizeof($sala); $i++) {
        ?>
    <?php if ($i === 0): ?>
    <div class="tab-pane active" id="<?php echo $sala[$i]['codsala'];?>">
    <?php else: ?>
    <div class="tab-pane" id="<?php echo $sala[$i]['codsala'];?>">
    <?php endif; ?>
        <?php
            $codigo_sala = $sala[$i]['codsala'];
            ?>
        <p>
            <!--AQUI LISTO LAS MESAS--> 
        <ul class="users-list clearfix" id="listMesas">
            <?php
                $mesa = new Login();
                $mesa = $mesa->ListarMesas();
                if($sala==""){ echo "";      
                } else {
                for ($ii = 0; $ii < sizeof($mesa); $ii++) {
                ?>
            <?php
                if ($mesa[$ii]['codsala'] == $codigo_sala) {
                ?>
            <li style="display:inline;float: left; margin-right: 4px;">
<div class="users-list-name codMesa" title="<?php echo $mesa[$ii]['nombremesa']; ?>" style="cursor:pointer;" onclick="RecibeMesa('<?php echo base64_encode($mesa[$ii]['codmesa']); ?>')">
                    <div id="<?php
                        echo $mesa[$ii]['nombremesa'];
                        ?>" style="width: 110px;height: 110px;-moz-border-radius: 50%;-webkit-border-radius: 50%;border-radius: 50%;background:<?php
                        if ($mesa[$ii]['statusmesa'] == '0') {
                        ?>#5cb85c;<?php
                        }
                        ?>red" class="miMesa"><img src="assets/images/mesa.png" style="display:inline;margin:18px;float:left;width:78px;height:65px;"></div>
                    <center><strong><?php
                        echo $mesa[$ii]['nombremesa'];
                        ?></strong></center>
                </div>
            </li>
            <?php
                }
                ?>
            <?php
                }
                ?>
        </ul>
        <!--AQUI LISTO LAS MESAS FIN -->
        </p>
    </div>
    <?php
        }
    }
        ?>
     </div>
</div>
<?php endif; ?>





<?php if (isset($_GET['prod_categorias'])): ?>

<div class="tabs-vertical-env">

     <!--AQUI LISTO LAS CATEGORIAS -->
<div class="scroll col-sm-3">
    <ul class="nav tabs-vertical">

    <?php
                    $categoria = new Login();
                    $categoria = $categoria->ListarCategorias();
                    if($categoria==""){ echo "";      
                    } else {
                    for ($i = 0; $i < sizeof($categoria); $i++) {
                    ?>
                    <?php if ($i === 0): ?>
                    <li class="active">
                    <?php else: ?>
                    <li class="">
                    <?php endif; ?>
<a href="#<?php echo $categoria[$i]['codcategoria'];?>" data-toggle="tab" title="<?php echo $categoria[$i]['nomcategoria'];?>" aria-expanded="false">
<span class="visible-xs"><i class="fa fa-building"></i></span>
<span class="hidden-xs"><?php echo $categoria[$i]['nomcategoria'];?></span>
                        </a>
                    </li>
                    <?php
                        }
                }
                        ?>
   </ul>
</div>
<div class="tab-content scroll col-sm-9">
     <?php
                        $categoria = new Login();
                        $categoria = $categoria->ListarCategorias();
                        if($categoria==""){ echo "";      
                        } else {
                        for ($i = 0; $i < sizeof($categoria); $i++) {
                        ?>
                    <?php if ($i === 0): ?>
                    <div class="tab-pane active" id="<?php echo $categoria[$i]['codcategoria'];?>">
                    <?php else: ?>
                    <div class="tab-pane" id="<?php echo $categoria[$i]['codcategoria'];?>">
                    <?php endif; ?>
            <?php $codigo_cate = $categoria[$i]['codcategoria']; ?>
                        <p>
                            <!--AQUI LISTO LOS PRODUCTOS -->
                            <div class="row">
                                <?php
                                $producto = new Login();
                                $producto = $producto->ListarProductos();
                                for ($ii = 0; $ii < sizeof($producto); $ii++) {

if ($producto[$ii]['codcategoria'] == $codigo_cate && $producto[$ii]['existencia'] > 0) {
                                ?>
<div class="col-md-2 mb" style="width:120px;cursor:pointer;" ng-click="afterClick()" ng-repeat="product in ::getFavouriteProducts()" OnClick="DoAction('<?php echo $producto[$ii]['codproducto']; ?>','<?php echo $producto[$ii]['producto']; ?>','<?php echo $producto[$ii]['codcategoria']; ?>','<?php echo $precioconiva = ( $producto[$ii]['ivaproducto'] == 'SI' ? $producto[$ii]['preciocompra'] : "0.00"); ?>','<?php echo $producto[$ii]['preciocompra']; ?>','<?php echo $producto[$ii]['precioventa']; ?>','<?php echo $producto[$ii]['ivaproducto']; ?>','<?php echo $producto[$ii]['existencia']; ?>');">
<div class="darkblue-panel pn" title="<?php echo $producto[$ii]['producto'];?>">
                                            <div class="darkblue-header">
<h6 class="text-white"><?php echo getSubString($producto[$ii]['producto'],12);?></h6>
                                            </div>
<p><?php if (file_exists("./fotos/".$producto[$ii]["codproducto"].".jpg")){

echo "<img src='fotos/".$producto[$ii]['codproducto'].".jpg?' class='img-circle' style='width:60px;height:60px;'>"; 

} else {

echo "<img src='fotos/producto.png' class='img-circle' style='width:60px;height:60px;'>";  } ?></p>
    <h5>$ <?php echo $producto[$ii]['precioventa'];?></h5>
<h5><i class="fa fa-bars"></i> <?php echo $producto[$ii]['existencia'];?></h5><br>
                                        </div><br>
                                    </div>
                                <?php
                                    }
                                    }
                                ?>
                            </div>
                            <!--FIN LISTO LOS PRODUCTOS -->
                        </p>
                    </div>
                    <?php
                        }
                }
                        ?>
                             </div>

                                        </div>
<?php endif; ?>








<?php 
############################ MUESTRA PRODUCTOS FAVORITOS ###########################
if (isset($_GET['Muestra_Favoritos'])) { 
  
$favoritos = new Login();
$favoritos = $favoritos->ListarProductosFavoritos();
$x=1;

echo $status = ( $favoritos[0]["codproducto"] == '' ? '' : '<label class="control-label"><h4>Productos Favoritos: </h4></label><br>');

if($favoritos==""){

    echo "";      

} else {

for($i=0;$i<sizeof($favoritos);$i++){  ?>

<button type="button" class="button ng-scope" 
style="font-size:8px;border-radius:5px;width:69px; height:50px;cursor:pointer;"

ert-add-pending-addition="" ng-click="afterClick()" ng-repeat="product in ::getFavouriteProducts()" OnClick="DoAction('<?php echo $favoritos[$i]['codproducto']; ?>','<?php echo $favoritos[$i]['producto']; ?>','<?php echo $favoritos[$i]['codcategoria']; ?>','<?php echo $precioconiva = ( $favoritos[$i]['ivaproducto'] == 'SI' ? $favoritos[$i]['preciocompra'] : "0.00"); ?>','<?php echo $favoritos[$i]['preciocompra']; ?>','<?php echo $favoritos[$i]['precioventa']; ?>','<?php echo $favoritos[$i]['ivaproducto']; ?>','<?php echo $favoritos[$i]['existencia']; ?>');" title="<?php echo $favoritos[$i]['producto'];?>">

<?php if (file_exists("./fotos/".$favoritos[$i]["codproducto"].".jpg")){

echo "<img src='./fotos/".$favoritos[$i]['codproducto'].".jpg?' alt='x' style='border-radius:4px;width:40px;height:35px;'>"; 
}else{
echo "<img src='./fotos/producto.png' alt='x' style='border-radius:4px;width:40px;height:35px;'>";  
} ?>

<span class="product-label ng-binding "><?php echo getSubString($favoritos[$i]['producto'], 8);?></span>
</button>

    <?php  if($x==8){ echo "<div class='clearfix'></div>"; $x=0; } $x++; } }

    echo $status = ( $favoritos[0]["codproducto"] == '' ? '' : '<hr>'); ?>

<?php  }
############################ MUESTRA PRODUCTOS FAVORITOS ###########################
?>






<?php 
############################ MUESTRA PEDIDOS EN DELIVERY ###########################
if (isset($_GET['Muestra_Delivery'])) { 
  
$tra = new Login(); ?>


  <div id="div"><div class="table-responsive" data-pattern="priority-columns">
                  <table id="tech-companies-1" class="table table-small-font table-bordered table-striped">
                                                 <thead>
                                                 <tr role="row">
                                  <th>N&deg;</th>
                                  <th>Datos de Cliente</th>
                                  <th>Platillos</th>
<?php if($_SESSION["acceso"] != 'repartidor'){ ?><th>Nombres de Repartidor</th><?php } ?>
                                  <th>Status</th>
                                  <th>Procesar</th>
                              </tr>
                                                 </thead>
                                                 <tbody>
<?php 
$a=1;
$mostrador = new Login();
$reg = $mostrador->ListarDelivery();

if($reg==""){

    echo "";      
    
} else {

for($i=0;$i<sizeof($reg);$i++){  
?>
                                               <tr role="row" class="odd">
                                    <td class="sorting_1" tabindex="0"><?php echo $a++; ?></td>
<td><abbr title="<?php echo $cliente = ( $reg[$i]['cliente'] == '0' ? "<span class='label label-warning'> SIN ASIGNAR</span>" : $reg[$i]['nomcliente']); ?>"> <?php echo $reg[$i]['cedcliente']; ?></abbr></td>
<td><?php echo "<span style='font-size:12px;'><strong>".$reg[$i]['detalles']."</strong></span>"; ?></td>

<?php if($_SESSION["acceso"] != 'repartidor'){ ?><td><?php echo $reg[$i]['nombres']; ?></td><?php } ?>

<td><?php if($reg[$i]['entregado']== '0') { echo "<span class='label label-success'><i class='fa fa-check'></i> ENTREGADA</span>"; } else { echo "<span class='label label-danger'><i class='fa fa-times'></i> PENDIENTE</span>"; } ?></td>
                    <td>
<a class="btn btn-success btn-xs" data-placement="left" title="Ver Cliente" data-original-title="" data-href="#" data-toggle="modal" data-target="#panel-modal" data-backdrop="static" data-keyboard="false" onClick="VerCliente('<?php echo base64_encode($reg[$i]["codcliente"]); ?>')"><i class="fa fa-user"></i></a>

<a class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="left" title="" data-original-title="Procesar Entrega" onClick="ProcesarDelivery('<?php echo base64_encode($reg[$i]["codventa"]) ?>','<?php echo base64_encode("PROCESARENTREGA") ?>')"><i class="fa fa-motorcycle"></i></a>

<a href="reportepdf?codventa=<?php echo base64_encode($reg[$i]['codventa']); ?>&tipo=<?php echo base64_encode("TICKET") ?>" target="_black" rel="noopener noreferrer" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="left" title="" data-original-title="Ticket de Venta"><i class="fa fa-print"></i></a>
</td>
                                               </tr>
                                               <?php } } ?>
                                               </tbody>
</table></div></div>
 
<?php  } 
############################ MUESTRA PEDIDOS EN DELIVERY ###########################
?>





<!--<?php if (isset($_GET['salas_mesa8uus'])): ?>
<ul class="nav nav-tabs tabs">
    <?php
    $sala = new Login();
    $sala = $sala->ListarSalas();
    for ($i = 0; $i < sizeof($sala); $i++) {
    ?>
    <?php if ($i === 0): ?>
    <li class="tab active">
    <?php else: ?>
    <li class="tab">
    <?php endif; ?>
        <a href="#<?php echo $sala[$i]['codsala'];?>" data-toggle="tab" aria-expanded="true" role="tab">
            <span class="visible-xs"><i class="fa fa-building"></i></span>
            <span class="hidden-xs"><?php echo $sala[$i]['nombresala'];?></span>
        </a>
    </li>
    <?php
        }
        ?>
</ul>
<div class="tab-content">
    <?php
        $sala = new Login();
        $sala = $sala->ListarSalas();
        for ($i = 0; $i < sizeof($sala); $i++) {
        ?>
    <?php if ($i === 0): ?>
    <div class="tab-pane active" id="<?php echo $sala[$i]['codsala'];?>">
    <?php else: ?>
    <div class="tab-pane" id="<?php echo $sala[$i]['codsala'];?>">
    <?php endif; ?>
        <?php
            $codigo_sala = $sala[$i]['codsala'];
            ?>
        <p>
            <!--AQUI LISTO LAS MESAS 
        <ul class="users-list clearfix" id="listMesas">
            <?php
                $mesa = new Login();
                $mesa = $mesa->ListarMesas();
                for ($ii = 0; $ii < sizeof($mesa); $ii++) {
                ?>
            <?php
                if ($mesa[$ii]['codsala'] == $codigo_sala) {
                ?>
            <li style="display:inline;float: left; margin-right: 4px;">
                <a class="users-list-name codMesa" href="#" onclick="RecibeMesa('<?php
                    echo base64_encode($mesa[$ii]['codmesa']);
                    ?>')">
                    <div id="<?php
                        echo $mesa[$ii]['nombremesa'];
                        ?>" style="width: 110px;height: 110px;-moz-border-radius: 50%;-webkit-border-radius: 50%;border-radius: 50%;background:<?php
                        if ($mesa[$ii]['statusmesa'] == '0') {
                        ?>#5cb85c;<?php
                        }
                        ?>red" class="miMesa"><img src="assets/images/mesa.png" style="padding:12px;margin:11px;float:left;width:90px;"></div>
                    <center><strong><?php
                        echo $mesa[$ii]['nombremesa'];
                        ?></strong></center>
                </a>
            </li>
            <?php
                }
                ?>
            <?php
                }
                ?>
        </ul>
        <!--AQUI LISTO LAS MESAS FIN 
        </p>
    </div>
    <?php
        }
        ?>
</div>
<?php endif; ?>-->