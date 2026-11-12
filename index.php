<?php
require_once __DIR__ . '/web_session.php';

// Sin slug de restaurante: ir al login SuperAdmin (no hay tienda global)
$__slug = function_exists('web_tenant_slug') ? web_tenant_slug() : '';
if ($__slug === '' && empty($_GET['r_slug'])) {
	header('Location: ' . (function_exists('app_url') ? app_url('/sistema/superadmin/login.php') : '/sistema/superadmin/login.php'));
	exit;
}

$session_id = web_session_id();
include "db/core/autoload.php";
include "db/core/app/model/CategoriasData.php";
include "db/core/app/model/ProductoData.php";
include "db/core/app/model/CarritoData.php";

include "db/core/app/model/ClientesData.php";
$__tn = function_exists('web_tenant_row') ? web_tenant_row() : null;
$qBusqueda = isset($_GET['q']) ? trim($_GET['q']) : '';
$idCategoria = (isset($_GET['id']) && $_GET['id'] !== '') ? (int) $_GET['id'] : 0;
?>
<!doctype html>
<html lang="es"  class="default" >
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head> 
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?php echo $__tn ? htmlspecialchars($__tn['nombre']) : 'Menu'; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php if (function_exists('web_tenant_slug') && web_tenant_slug() !== '') { ?>
  <base href="<?php echo htmlspecialchars(web_base_href()); ?>">
  <?php } ?>
  <link rel="stylesheet" href="css/estilos.css" type="text/css" media="all">

<link rel="stylesheet" href="css/bos.css" type="text/css" media="all">
<script src="css/bos.js"  crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/icon-nqt-fa.css">
<link rel="stylesheet" href="css/tienda-mejoras.css?v=7" type="text/css" media="all">
  <?php if (function_exists('web_brand_head_styles')) { web_brand_head_styles(); } ?>

</head>

  <body id="cart" class="lang-es rs-menu-page country-us currency-usd layout-full-width page-cart tax-display-disabled cart-empty fullwidth">
    <main id="page">     
      <header id="header">
        <div class="header-container">     
           <div class="header-banner">
            <div class="container">
              <div class="inner"></div>
          </div>
        </div>
  <nav class="header-nav">
    <div class="topnav">
        <div class="container">
          <div class="inner"></div>
        </div>
    </div>
    <div class="bottomnav" style="background-color: var(--brand-primary, #132332) !important;">
        <div class="container">
        <div class="inner">
    <div id="form_7278891982233858" class="row dpnav2 ApRow  has-bg bg-fullwidth" data-src="" style="" data-bg_data=" no-repeat center center">
        
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6 col-sp-6 hidden-sm-down ApColumn ">
      
<div class="block ApHtml">
      <div class="block_content"><p class="text-freeship">¡Envio gratis en todas las ordenes!</p><div id="gtx-trans" style="position: absolute; left: -17px; top: -9px;"><div class="gtx-trans-icon"></div></div></div>
      </div>
    </div>
<div  class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 col-sp-12  ApColumn ">

<div class="block ApRawHtml">
    <?php echo function_exists('web_header_phone_html') ? web_header_phone_html() : ''; ?>      
</div>

<div id="leo_block_top" class="popup-over e-scale float-md-right">
    <a href="javascript:void(0)" data-toggle="dropdown" class="popup-title btn-setting">
      <i class="icon-nqt-user-cog" aria-hidden="true"></i>
    <span class="title-cog"><?php if(isset($_SESSION["id_cliente"]) ){ echo ClientesData::getById($_SESSION["id_cliente"])->nomcliente;  }else{ echo "Cuenta";}?></span>
    </a>      
  <div class="popup-content">
    <div class="row">
      <div class="col-xs-6">
        <div class="language-selector">
          <span>Idioma:</span>
          <ul class="link">
              <li  class="current" >
                <a href="#" class="dropdown-item">
                  <img src="img/l/5.jpg" alt="Español" width="16" height="11" />
                </a>
              </li>
          </ul>
        </div>
        <div class="currency-selector">
          <span>Moneda:</span>
          <ul class="link">
              <li>
                <a title="Soles" rel="nofollow" href="#" class="dropdown-item">PEN</a>
              </li>
          </ul>
        </div>
      </div>
      <div class="col-xs-6">
          <div class="useinfo-selector">
            <ul class="user-info">

              <?php if(isset($_SESSION["id_cliente"]) ):?>  

              <li>
                <a class="signin leo-quicklogin" data-enable-sociallogin="enable"  href="javascript:void(0)" title="Hola" >
                  <i class="material-icons">&#xE88D;</i><span> Hola <?php if(isset($_SESSION["id_cliente"]) ){ echo ClientesData::getById($_SESSION["id_cliente"])->nomcliente;  }?></span>
                </a>
              </li>

              <li>
                <a class="signin leo-quicklogin" data-enable-sociallogin="enable"  href="salir.php" title="Salir de sesión" >
                  <i class="material-icons">&#xE88D;</i><span>Salir</span>
                </a>
              </li>
              
                      
              <?php else:?>
                <li>
                  <a class="signin leo-quicklogin" data-enable-sociallogin="enable"  href="micuenta.php" title="Iniciar sesión" >
                    <i class="material-icons">&#xE88D;</i><span>Iniciar sesión</span>
                  </a>
                </li>

              <?php endif;?>

              
              <li>
                <a class="myacount"  href="micuenta.php" title="Mi cuenta" rel="nofollow">
                  <i class="material-icons">&#xE8A6;</i> <span>Mi cuenta</span>
                </a>
              </li>
             <li>
                <a class="checkout" href="carrito.php" title="Checkout" rel="nofollow">
                  <i class="material-icons">&#xE890;</i><span>Checkout</span>
                </a>
            </li>
            
            </ul>
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
</nav>



  <div class="header-top">
    <div class="container">
        <div class="inner">
          <div id="form_6256705932421997" class="row dptop ApRow  has-bg bg-fullwidth" style="" data-bg_data=" #fff no-repeat center center">
              <div class="col-xl-3 col-lg-12 col-md-4 col-sm-4 col-xs-4 col-sp-4  ApColumn " >
                  <div class="logo-header"><a href="<?php echo function_exists('web_url') ? htmlspecialchars(web_url()) : '#'; ?>"><img class="logo img-fluid" src="<?php echo htmlspecialchars(function_exists('restaurant_logo_url') ? restaurant_logo_url() : 'img/logo.jpg'); ?>" alt="<?php $__br = function_exists('web_tenant_row') ? web_tenant_row() : null; echo htmlspecialchars($__br ? $__br['nombre'] : 'Menu'); ?>" style="max-height:64px;width:auto;object-fit:contain;"></a></div>

              </div>
              <div    class="col-xl-6 col-lg-9 col-md-4 col-sm-4 col-xs-4 col-sp-4  ApColumn ">
                 
              <div id="memgamenu-form_9770107693982036" class="ApMegamenu">
                <nav data-megamenu-id="9770107693982036" class="leo-megamenu cavas_menu navbar navbar-default enable-canvas " role="navigation">
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggler hidden-lg-up" data-toggle="collapse" data-target=".megamenu-off-canvas-9770107693982036" aria-controls="leo-mobile-menu" aria-expanded="false" aria-label="Abrir menú">
                        <span class="sr-only">Abrir menú</span>
                                            &#9776;                    
                    </button>
                  </div>
                  <div id="leo-mobile-menu" class="leo-top-menu collapse navbar-toggleable-md megamenu-off-canvas megamenu-off-canvas-9770107693982036">
                    <ul class="nav navbar-nav megamenu horizontal">

                       
                        <li data-menu-type="url" class="nav-item" >
                            <a class="nav-link has-category" href="index.php" target="_self">
                                  <span class="menu-title">Inicio</span>
                            </a>
                        </li>

                        <li data-menu-type="url" class="nav-item" >
                            <a class="nav-link has-category" href="productos.php" target="_self">
                                  <span class="menu-title">Orden online</span>
                            </a>
                        </li>
                        
                        <li data-menu-type="url" class="nav-item  " >
                            <a class="nav-link has-category" href="reserva.php" target="_self">
                                  <span class="menu-title">Reservas</span>
                            </a>
                        </li><li data-menu-type="url" class="nav-item  " >
                            <a class="nav-link has-category" href="carrito.php" target="_self">
                                  <span class="menu-title">Checkout</span>
                            </a>
                        </li>
                     
                        <li data-menu-type="controller" class="nav-item  " >
                            <a class="nav-link has-category" href="contacto.php" target="_self">
                                <span class="menu-title">Contacto</span>
                            </a>
                          </li>
                    </ul>
</div>

</nav>
           
    
</div>

    </div><!-- @file modules\appagebuilder\views\templates\hook\ApColumn -->


<div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-xs-4 col-sp-4  ApColumn ">
                    <!-- @file modules\appagebuilder\views\templates\hook\ApModule -->
<div id="_desktop_cart">
  <div class="blockcart cart-preview inactive" data-refresh-url="">
    <a href="carrito.php" class="header btn-header btn-cart" title="Ir al checkout">
              <i class="icon-nqt-shopping-basket" aria-hidden="true"></i>
        <span class="cart-products-count"><?php echo @count(CarritoData::getAllTemporal($session_id));?></span>
          </a>

     <?php $tpms = CarritoData::getAllTemporal($session_id); 
        $total=0;
        if(@count($tpms)>0){
          $total=0;
          foreach($tpms as $tpm):
              $total=($tpm->cantidad*$tpm->precio)+$total;
          endforeach; 
        }else{ $total=0; };?>

    <span class="cart-count-items">S/ <?php echo $total;?></span>
  </div>
</div>


</div>            
</div>
</div>
</div>
 </div>
  
          
  </div>
</header>
      
        

<?php $rsMenuPage = 'index.php'; require __DIR__ . '/web_menu_carta.php'; ?>


<footer id="footer" class="footer-container">
            
  <div class="footer-top">
    <div class="container">
    <div class="inner"></div>
    </div>
  </div>


  <div class="footer-center">
      <div class="container">
        <div class="inner">
          <div class="row box-service ApRow  has-bg bg-boxed" style="background: no-repeat;" data-bg_data=" no-repeat">
            
            <div  class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 col-sp-12  ApColumn ">
              <div  class="block ApHtml">
                 <div class="block_content"><div></div></div>
              </div>
            </div>
          <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 col-sp-12  ApColumn ">
            <div class="block ApHtml">
               <div class="block_content">
                <div class="icon-nqt-badge-dollar"></div>
                <div class="service-text">
                  <h3>Devoluciones gratis</h3>
                  <p>Política de devoluciones sin problemas y garantía de devolución del 100% del dinero. 
                  <span class="text-bold">Más sobre devoluciones</span></p>
                </div>
              </div>
            </div>
          </div>
          <div  class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12 col-sp-12  ApColumn ">
             <div  class="block ApHtml">
               <div class="block_content"><div></div></div>
             </div>
          </div>
        </div>

<div class="wrapper">
  <div class="containet">
    <div class="row copyright box-padding ApRow  has-bg bg-boxed" style="background: no-repeat;" data-bg_data=" no-repeat">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 col-sp-12  ApColumn ">
        <div id="image-form_9629377904050320" class="block ApImage">
           <img src="img/pay-image.png" class="" title="" alt="" style=" width:auto; height:auto" />

              <div class='image_description'>
                <p>Copyright © 2022 <span>Resto en linea</span>. Todos los derechos reservados</p>            
              </div>
        </div>
    </div>            
  </div>
</div>
</div>


</div>
</div>
 </div>


  <div class="footer-bottom">
          <div class="container">
          <div class="inner"></div>
          </div>
  </div>
        
</footer>

</main>


<script src="css/jquery.js"></script>
<script src="js/tienda-nav.js"></script>
<script src="js/carrito-home.js?v=3"></script>
<?php require __DIR__ . '/web_menu_carta_scripts.php'; ?>


  </body>


</html>