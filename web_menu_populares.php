<?php
if (!isset($rsPopulares) || !is_array($rsPopulares) || count($rsPopulares) === 0) {
	return;
}
$rsPopulares = array_slice($rsPopulares, 0, 5);
if (!isset($session_id)) {
	$session_id = function_exists('web_session_id') ? web_session_id() : '';
}
?>
<section class="rs-populares" aria-labelledby="rs-populares-title">
  <div class="rs-populares-head">
    <p class="rs-populares-eyebrow">Lo más pedido</p>
    <h2 id="rs-populares-title" class="rs-populares-title">Productos populares</h2>
    <p class="rs-populares-lead">Los platos que más se venden en este restaurante.</p>
  </div>
  <div class="row rs-populares-grid">
    <?php foreach ($rsPopulares as $productoc) {
      $foto = 'sistema/fotos/' . $productoc->codproducto . '.jpg';
      $fotoFs = __DIR__ . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $foto);
      if (!is_file($fotoFs)) {
        $foto = 'sistema/fotos/producto.png';
      }
    ?>
    <div class="ajax_block_product col-xs-6 col-sm-4 rs-popular-col">
         data-nombre="<?php echo htmlspecialchars(mb_strtolower($productoc->producto, 'UTF-8')); ?>">
      <article class="product-miniature js-product-miniature rs-popular-card">
        <div class="thumbnail-container">
          <div class="product-image">
            <span class="rs-popular-badge">Popular</span>
            <a href="javascript:void(0)" class="thumbnail product-thumbnail">
              <img class="img-fluid" src="<?php echo htmlspecialchars($foto, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($productoc->producto); ?>">
            </a>
            <span class="rs-product-image-shade" aria-hidden="true"></span>
          </div>
          <div class="product-meta">
            <h3 class="h3 product-title"><?php echo htmlspecialchars($productoc->producto); ?></h3>
            <p class="rs-product-price-inline">S/ <?php echo number_format($productoc->precioventa, 0, '.', ','); ?></p>
            <div class="meta-button">
              <div class="button-container cart">
                <input type="hidden" class="form-control" id="cantidad_<?php echo $productoc->codalmacen; ?>" value="1" min="1">
                <input type="hidden" class="form-control" id="precio_venta_<?php echo $productoc->codalmacen; ?>" value="<?php echo htmlspecialchars($productoc->precioventa); ?>">
                <a class="btn btn-product add-to-cart leo-bt-cart" href="javascript:void(0)" onclick="return agregar('<?php echo $productoc->codalmacen; ?>', event);">
                  <i class="icon-nqt-shopping-basket"></i>
                  <span class="name-btn-product">Agregar a carrito</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </article>
    </div>
    <?php } ?>
  </div>
</section>
