<?php
if (!isset($rsMenuPage) || $rsMenuPage === '') {
	$rsMenuPage = 'productos.php';
}
if (!isset($qBusqueda)) {
	$qBusqueda = '';
}
if (!isset($idCategoria)) {
	$idCategoria = 0;
}
if (!isset($session_id)) {
	$session_id = function_exists('web_session_id') ? web_session_id() : '';
}
?>
        
<aside id="notifications">
  <div class="container">
      </div>
</aside>
      
      <section id="wrapper">
       
              <div class="container">
                
            <nav data-depth="2" class="breadcrumb hidden-sm-down">
  <!--page name-->
      <p class="breadcrumb-page-name">Menú</p>
    <!--end page name-->
  <ol itemscope itemtype="">
    
              
          
        
              
          <li itemprop="itemListElement" itemscope itemtype="">
            <a itemprop="item" href="#">
              <span itemprop="name"></span>
            </a>
            <meta itemprop="position" content="2">
          </li>
        
          
  </ol>
</nav>

          <?php $categorias = CategoriasData::getAll(); ?>
          <nav class="rs-category-chips hidden-md-up" aria-label="Categorías del menú">
            <a class="rs-chip<?php echo $idCategoria === 0 ? ' is-active' : ''; ?>" href="<?php echo htmlspecialchars(web_menu_page_url($rsMenuPage, 0, $qBusqueda), ENT_QUOTES, 'UTF-8'); ?>">Todas</a>
            <?php if (@count($categorias) > 0) {
              foreach ($categorias as $categoria) {
                $catId = (int) $categoria->codcategoria;
                $chipHref = web_menu_page_url($rsMenuPage, $catId, $qBusqueda);
                $chipActive = ($idCategoria === $catId) ? ' is-active' : '';
                echo '<a class="rs-chip'.$chipActive.'" href="'.htmlspecialchars($chipHref).'">'.htmlspecialchars($categoria->nomcategoria).'</a>';
              }
            } ?>
          </nav>
          
          <div class="row rs-menu-layout">
            
              <div id="left-column" class="sidebar col-xs-12 col-sm-12 col-md-4 col-lg-3 rs-menu-sidebar">
                                  

<div class="block-categories block block-highlighted hidden-sm-down rs-categories-panel">
  <h4 class="title_block">Categorías</h4>
  <div class="block_content">
    <ul class="category-top-menu">
      <li>
        <ul class="category-sub-menu">
          <li data-depth="0" class="<?php echo $idCategoria === 0 ? 'rs-cat-active' : ''; ?>">
            <a href="<?php echo htmlspecialchars(web_menu_page_url($rsMenuPage, 0, $qBusqueda), ENT_QUOTES, 'UTF-8'); ?>">Todas</a>
          </li>
          <?php
            if(@count($categorias)>0){ ?>  
            <?php foreach($categorias as $categoria):
              $catId = (int) $categoria->codcategoria;
              $liActive = ($idCategoria === $catId) ? ' rs-cat-active' : '';
            ?>

              <li data-depth="0" class="<?php echo trim($liActive); ?>">
                <a href="<?php echo htmlspecialchars(web_menu_page_url($rsMenuPage, $catId, $qBusqueda), ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($categoria->nomcategoria); ?></a>
              </li>

            <?php endforeach; ?>
            <?php }else{  echo"<h4 class='alert alert-success'>NO HAY REGISTRO</h4>"; }; ?>
        </ul>
      </li>
    </ul>
  </div>
</div>

</div>
            

            
  <div id="content-wrapper" class="left-column col-xs-12 col-sm-12 col-md-8 col-lg-9">
    
    
  <section id="main">

    
  <div id="js-product-list-header">
            <div class="block-category card card-block rs-carta-hero">
            <div class="rs-carta-hero-text">
            <p class="rs-carta-eyebrow">Menú del restaurante</p>
            <h1 class="h1">Nuestra carta</h1>
            <p class="rs-carta-lead">Explora nuestros platos y agrégalos al carrito en un clic.</p>
            </div>
            <div class="block-category-inner rs-carta-hero-search">
              <form class="rs-product-search" method="get" action="<?php echo htmlspecialchars($rsMenuPage, ENT_QUOTES, 'UTF-8'); ?>" role="search">
                <?php if ($idCategoria > 0) { ?>
                  <input type="hidden" name="id" value="<?php echo $idCategoria; ?>">
                <?php } ?>
                <label class="sr-only" for="rs-buscar-producto">Buscar productos</label>
                <div class="rs-product-search-inner">
                  <input
                    type="search"
                    id="rs-buscar-producto"
                    name="q"
                    class="form-control"
                    value="<?php echo htmlspecialchars($qBusqueda); ?>"
                    placeholder="Buscar platos, bebidas..."
                    autocomplete="off"
                  >
                  <button type="submit" class="btn rs-btn-search" title="Buscar">
                    <i class="fa fa-search" aria-hidden="true"></i>
                    <span>Buscar</span>
                  </button>
                  <?php if ($qBusqueda !== '') { ?>
                    <a class="btn rs-btn-clear" href="<?php echo htmlspecialchars(web_menu_page_url($rsMenuPage, $idCategoria > 0 ? $idCategoria : 0, ''), ENT_QUOTES, 'UTF-8'); ?>" title="Limpiar búsqueda">Limpiar</a>
                  <?php } ?>
                </div>
              </form>
            </div>
        </div>
    </div>
  

    <section id="products">
      
        <div>
            
<div id="js-product-list-top" class="products-selection rs-products-toolbar">
  <div class="row align-items-center">
    <div class="col-lg-5 col-md-12 rs-toolbar-intro">
      <p class="rs-toolbar-title">Platos disponibles</p>
      <p class="rs-toolbar-hint">Elige lo que más te apetezca y confirma en el checkout.</p>
    </div>
    <div class="col-lg-7 col-md-12">
      <div class="row sort-by-row rs-toolbar-filter">
          <label class="col-sm-12 sort-by" for="rs-filtro-categoria">Filtrar por categoría</label>
          <div class="col-md-12 products-sort-order dropdown">
              <select class="form-control rs-select-categoria" id="rs-filtro-categoria" name="id_categoria">
               <option value="">Todas las categorías</option>
                 <?php
                 $categoriasSelect = CategoriasData::getAll();
                 if (@count($categoriasSelect) > 0) {
                   foreach ($categoriasSelect as $categoria) {
                     $sel = ($idCategoria > 0 && (int) $categoria->codcategoria === $idCategoria) ? ' selected' : '';
                     echo '<option value="'.(int) $categoria->codcategoria.'"'.$sel.'>'.htmlspecialchars($categoria->nomcategoria).'</option>';
                   }
                 }
                 ?>
            </select>
          </div>
       </div>
    </div>


  </div>
</div>
          
        </div>

        
        
        

 <div>
       


<div id="js-product-list">
<div class="products">  

<div  class="product_list grid  product-default ">
    <div class="row">
                    
             
     <?php
      if ($qBusqueda !== '' || $idCategoria > 0) {
        $productos = ProductoData::buscar($qBusqueda, $idCategoria > 0 ? $idCategoria : null);
      } else {
        $productos = ProductoData::getAll();
      }

        if (@count($productos) > 0) { ?>
        <?php if ($qBusqueda !== '') { ?>
          <div class="col-12 rs-search-result-msg">
            <p>Resultados para <strong><?php echo htmlspecialchars($qBusqueda); ?></strong>: <?php echo (int) count($productos); ?> producto(s)</p>
          </div>
        <?php } ?>
        <?php foreach($productos as $productoc):?>
          <div class="ajax_block_product col-sp-12 col-xs-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 last-item-of-tablet-line last-item-of-mobile-line "
               data-nombre="<?php echo htmlspecialchars(mb_strtolower($productoc->producto, 'UTF-8')); ?>">    
                  <article class="product-miniature js-product-miniature" data-id-product="1" data-id-product-attribute="0" itemscope itemtype="">
                    <div class="thumbnail-container">
                      <div class="product-image">
                         <a href="" class="thumbnail product-thumbnail">
                         <img class="img-fluid" src="sistema/fotos/<?php echo $productoc->codproducto; ?>.jpg" alt = "" data-full-size-image-url = "img/platos/pina1.jpg">
                         <span class="product-additional" data-idproduct="1"></span>
                         </a>
                          <span class="rs-product-price-badge">S/ <?php echo number_format($productoc->precioventa, 0, '.', ','); ?></span>
                          <span class="rs-product-image-shade" aria-hidden="true"></span>
                      </div>
                      <div class="product-meta">
                        <h3 class="h3 product-title" itemprop="name"><a href=""><?php echo htmlspecialchars($productoc->producto); ?></a></h3>
                        <p class="rs-product-price-inline">S/ <?php echo number_format($productoc->precioventa, 0, '.', ','); ?></p>
                       
            
                     <div class="leo-list-product-reviews" itemprop="aggregateRating" itemscope itemtype="">
                        <div class="leo-list-product-reviews-wraper">
                           <div class="star_content clearfix">
                              <div class="star star_on"></div>
                              <div class="star star_on"></div>
                              <div class="star star_on"></div>
                              <div class="star star_on"></div>
                              <div class="star"></div>
                              <meta itemprop="worstRating" content = "0" />
                              <meta itemprop="ratingValue" content = "4" />
                              <meta itemprop="bestRating" content = "5" />
                           </div>
                            <span class="nb-revews"><span itemprop="reviewCount">1</span> Comentario (s)</span>
                        </div>
                    </div>


          <div class="meta-button">
            <div class="button-container cart">
                <input type="hidden" class="form-control"  id="cantidad_<?php echo $productoc->codalmacen; ?>"  value="1" min="1" >
                <input type="hidden" class="form-control" id="precio_venta_<?php echo $productoc->codalmacen; ?>"  value="<?php echo $productoc->precioventa;?>" >

                  <a class="btn btn-product add-to-cart leo-bt-cart leo-bt-cart_1" href="javascript:void(0)" onclick="return agregar('<?php echo $productoc->codalmacen; ?>', event);">
                    <i class="icon-nqt-shopping-basket"></i>
                    <span class="name-btn-product">Agregar a carrito</span>
                  </a>
             
            </div>

          
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModal<?php echo $productoc->codalmacen; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header" style="background: var(--brand-primary);">
                    <h4 class="modal-title" id="exampleModalLabel" style="color: white;"> <i class="fa fa-check"></i> Producto añadido con éxito a su carrito de compras</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
                  </div>

                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-5">
                        <div class="row">
                          <div class="col-md-6">
                            <img src="sistema/fotos/<?php echo $productoc->codproducto; ?>.jpg" class="product-image" style="width: 100%;">
                          </div>
                          <div class="col-md-6" style="text-align: left;">
                            <h6 class="h6 product-name" style="color: var(--brand-accent); font-size: 1.125rem;margin-bottom: 0.625rem;"><?php echo $productoc->producto;?></h6>
                            <p class="product-price" style="color: var(--brand-secondary);text-align: left;font-size: 24px;font-weight: 600;">S/ <?php echo number_format($productoc->precioventa,0,'.',',');?></p>
                            <span class="js-modal-qty">Cantidad: <b>1</b></span>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-7" style="border-left: solid 1px #bcbcbc;">
                        <div class="cart-content">
                          <p class="cart-products-count" style="text-align: left;">Hay <?php echo @count(CarritoData::getAllTemporal($session_id));?> artículos en su carrito.</p>
                          <p class="js-cart-subtotal" style="text-align: left;">Subtotal: <b>S/ <?php echo number_format($productoc->precioventa,0,'.',',');?></b></p>
                          <p style="text-align: left;">Transporte: <b>S/ 0</b></p>
                          <p style="text-align: left;">IGV: <b>S/ 0</b></p>
                          <p class="js-cart-total" style="text-align: left;">Total: <b>S/ <?php echo number_format($productoc->precioventa,0,'.',',');?></b></p>
                          <div class="">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CONTINUAR COMPRANDO</button>
                            <a  href="carrito.php" type="button" class="btn btn-primary">PASAR POR LA CAJA</a>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                 
                </div>
              </div>
            </div>


          <div class="quickview no-variants hidden-sm-down">
            <a href="#" class="quick-view btn-product" data-link-action="quickview" title="Vista rápida">
              <span class="leo-quickview-bt-loading cssload-speeding-wheel"></span>
              <span class="leo-quickview-bt-content">
                <i class="icon-nqt-eye"></i>
                <span class="name-btn-product">Vista rápida</span>
              </span>
            </a>
          </div>
          </div>

          </div>
          </div>
          </article>

          </div>

        <?php endforeach; ?>
    <?php } else {
      if ($qBusqueda !== '') {
        echo '<div class="col-12"><h4 class="alert alert-warning rs-search-empty">No se encontraron productos para &ldquo;'.htmlspecialchars($qBusqueda).'&rdquo;.</h4></div>';
      } else {
        echo "<h4 class='alert alert-success'>NO HAY REGISTRO</h4>";
      }
    }; ?>

                                        
      




                    

</div>
</div>
  
</div>

  
  

  <div class="hidden-md-up text-xs-right up">
    <a href="#header" class="btn btn-secondary">
      Volver arriba
      <i class="material-icons">&#xE316;</i>
    </a>
  </div>
</div>
          
</div>

<div id="js-product-list-bottom">
  <div id="js-product-list-bottom"></div>
</div>

</section>

</section>

    
  </div>


            
 </div>
</div>
        	
</section>