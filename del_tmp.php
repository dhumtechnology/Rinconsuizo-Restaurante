<?php
require_once __DIR__ . '/web_session.php';
$session_id = web_session_id();

include "db/core/autoload.php";
include "db/core/app/model/CategoriasData.php";
include "db/core/app/model/ProductoData.php";
include "db/core/app/model/CarritoData.php";

if (isset($_GET['id'])) {
    $idCarrito = (int) $_GET['id'];
    if ($idCarrito > 0) {
        $del = CarritoData::getById($idCarrito);
        if ($del && (string) $del->sessionn_id === (string) $session_id) {
            $del->del();
        }
    }
}

$tpms = CarritoData::getAllTemporal($session_id);
$total = 0;
$cantidad = 0;
?>
<!-- Left Block: cart product informations & shpping -->
      <div class="cart-grid-body col-xs-12 col-lg-8">

        <!-- cart products detailed -->
        <div class="card cart-container">
          <div class="card-block">
            <h1 class="h1">Carrito de compras</h1>
          </div>
          <hr class="separator">

          <div class="cart-overview js-cart" data-refresh-url="">
          	<ul class="cart-items">
          	<?php if (@count($tpms) > 0) {
	          foreach ($tpms as $tpm):
	            $prod = $tpm->getProducto();
	            if (!$prod) {
	                continue;
	            }
	          ?>
	          	<li class="cart-item">
	          		<div class="product-line-grid row">
	          			<div class="product-line-grid-left col-md-3 col-xs-4">
	          				<span class="product-image media-middle">
	          					<img src="sistema/fotos/<?php echo $prod->codproducto; ?>.jpg" alt="">
	          				</span>
	          			</div>
	          			<div class="product-line-grid-body col-md-4 col-xs-8">
	          				<div class="product-line-info"><a href="" class="label">
	          					<?php echo htmlspecialchars($prod->producto); ?></a></div>
	          				<div class="product-line-info product-price h5 has-discount">
	          					<div class="current-price"><span class="price">S/ <?php echo $tpm->precio; ?></span></div>
	          				</div>
	          			</div>
					  <div class="product-line-grid-right product-line-actions col-md-5 col-xs-12">
					    <div class="row">
					      <div class="col-xs-4 hidden-md-up"></div>
					      <div class="col-md-10 col-xs-6">
					        <div class="row">
		          				<div class="col-md-5 col-xs-6 col-sp-12 qty">
		                          <div class="rs-qty" data-id="<?php echo (int) $tpm->id; ?>">
		                            <button type="button" class="rs-qty-btn" onclick="cambiarCantidad(<?php echo (int) $tpm->id; ?>, -1);" aria-label="Disminuir">−</button>
		                            <span class="rs-qty-val"><?php echo (int) $tpm->cantidad; ?></span>
		                            <button type="button" class="rs-qty-btn" onclick="cambiarCantidad(<?php echo (int) $tpm->id; ?>, 1);" aria-label="Aumentar">+</button>
		                          </div>
		                      	</div>
						        <div class="col-md-7 col-xs-2 col-sp-12 price">
						            <span class="product-price">
						              <strong>S/ <?php echo $tpm->precio * $tpm->cantidad; ?></strong>
						            </span>
						        </div>
        					</div>
      					  </div>
					      <div class="col-md-2 col-xs-2 text-xs-right">
					        <div class="cart-line-product-actions">
					        	<a href="#" onclick="eliminar('<?php echo (int) $tpm->id; ?>'); return false;">
					        		<i class="fa fa-trash"></i></a>
					        </div>
					      </div>
					    </div>
					  </div>
	          		</div>
	          	</li>
	          	<?php
	              $total = ($tpm->cantidad * $tpm->precio) + $total;
	              $cantidad = $tpm->cantidad + $cantidad;
	          endforeach;
	          echo '</ul>';
	        } else {
	          echo '</ul>';
	        ?>
            <span class="no-items">No hay más artículos en el carrito</span>
        	<?php } ?>
          </div>
        </div>
        <a class="label" href="productos.php"><i class="material-icons">chevron_left</i>Seguir comprando</a>
      </div>

      <!-- Right Block: cart subtotal & cart total -->
      <div class="cart-grid-right col-xs-12 col-lg-4">
        <div class="card cart-summary">
          <div class="cart-detailed-totals">
            <div class="card-block">
              <div class="cart-summary-line" id="cart-subtotal-products">
                  <span class="label js-subtotal"><?php echo $cantidad; ?> artículos</span>
                  <span class="value">S/ <?php echo $total; ?></span>
              </div>
              <div class="cart-summary-line" id="cart-subtotal-shipping">
                  <span class="label">Transporte</span>
                  <span class="value">Gratis</span>
              </div>
            </div>
            <div class="card-block cart-summary-totals">
              <div class="cart-summary-line">
                <span class="label">Total iva</span>
                <span class="value">S/ 0</span>
              </div>
              <div class="cart-summary-line cart-total">
                <span class="label">Total</span>
                <span class="value">S/ <?php echo $total; ?></span>
              </div>
            </div>
          </div>

  <div class="checkout text-sm-center card-block">
  <?php if ($total <= 0) { ?>
    <span class="btn btn-outline" style="background-color:#8b8b8b;border-color:#8b8b8b;color:white;">Pasar por caja</span>
  <?php } else { ?>
    <a href="order.php" class="btn btn-outline">Pasar por caja</a>
  <?php } ?>
  </div>

</div>

<div id="block-reassurance">
    <ul>
        <li>
          <div class="block-reassurance-item">
            <img src="img/icon3.png" alt="Política de seguridad">
            <span class="h6">Política de seguridad</span>
          </div>
        </li>
        <li>
          <div class="block-reassurance-item">
            <img src="img/icon1.png" alt="Política de entrega">
            <span class="h6">Política de entrega</span>
          </div>
        </li>
        <li>
          <div class="block-reassurance-item">
            <img src="img/icon2.png" alt="Política de devoluciones">
            <span class="h6">Política de devoluciones</span>
          </div>
        </li>
    </ul>
</div>

      </div>
