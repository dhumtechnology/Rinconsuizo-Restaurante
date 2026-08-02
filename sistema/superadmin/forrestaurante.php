<?php
require_once('_bootstrap.php');
$tra = sa_gate();

if (isset($_POST['btn-restaurante'])) {
	$tra->RegistrarRestaurante();
	exit;
}
if (isset($_POST['btn-actualizar'])) {
	$tra->ActualizarRestaurante();
	exit;
}

$id = 0;
if (isset($_GET['id_restaurante'])) {
	$decoded = @base64_decode($_GET['id_restaurante'], true);
	$id = ($decoded !== false && is_numeric($decoded)) ? (int)$decoded : (int)$_GET['id_restaurante'];
}
$reg = $id > 0 ? $tra->RestaurantePorId($id) : array();
$edit = !empty($reg);

$cPrim = $edit ? $reg[0]['color_primario'] : '#1a1a2e';
$cSec  = $edit ? $reg[0]['color_secundario'] : '#16213e';
$cAcc  = $edit ? $reg[0]['color_acento'] : '#e94560';
$nombrePrev = $edit ? $reg[0]['nombre'] : 'Nuevo restaurante';

sa_header($edit ? 'Editar restaurante' : 'Nuevo restaurante');
?>
<div id="sa-msg"></div>
<form class="sa-form" method="post" enctype="multipart/form-data" id="form-rest" action="#">
<?php if ($edit) { ?>
  <input type="hidden" name="id_restaurante" value="<?php echo (int)$reg[0]['id_restaurante']; ?>">
<?php } ?>

  <div class="sa-form-grid">
    <div class="form-group full">
      <label>Vista previa de marca</label>
      <div class="sa-brand-preview">
        <div class="sa-brand-preview-bar" id="preview-bar" style="background: <?php echo htmlspecialchars($cPrim); ?>;">
          <span class="name" id="preview-name"><?php echo htmlspecialchars($nombrePrev); ?></span>
          <button type="button" class="cta" id="preview-cta" style="background: <?php echo htmlspecialchars($cAcc); ?>;">Reservar</button>
        </div>
        <div class="sa-brand-preview-meta">
          <span>Primario <b id="hex-primario"><?php echo htmlspecialchars(strtoupper($cPrim)); ?></b></span>
          <span>Secundario <b id="hex-secundario"><?php echo htmlspecialchars(strtoupper($cSec)); ?></b></span>
          <span>Acento <b id="hex-acento"><?php echo htmlspecialchars(strtoupper($cAcc)); ?></b></span>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label>Nombre *</label>
      <input type="text" name="nombre" id="nombre" required value="<?php echo $edit ? htmlspecialchars($reg[0]['nombre']) : ''; ?>">
    </div>
    <div class="form-group">
      <label>Estado</label>
      <select name="status">
        <option value="ACTIVO" <?php echo (!$edit || $reg[0]['status']==='ACTIVO')?'selected':''; ?>>ACTIVO</option>
        <option value="INACTIVO" <?php echo ($edit && $reg[0]['status']==='INACTIVO')?'selected':''; ?>>INACTIVO</option>
      </select>
    </div>

    <div class="form-group">
      <label>Slug (URL) *</label>
      <input type="text" name="slug" value="<?php echo $edit ? htmlspecialchars($reg[0]['slug']) : ''; ?>" placeholder="mi-restaurante" required>
      <span class="sa-hint">Menú <code>/slug/</code> · POS <code>/slug/sistema/</code></span>
    </div>
    <div class="form-group">
      <label>Dominio propio</label>
      <input type="text" name="dominio" value="<?php echo $edit && !empty($reg[0]['dominio']) ? htmlspecialchars($reg[0]['dominio']) : ''; ?>" placeholder="www.mirestaurante.com">
      <span class="sa-hint">Opcional. Sin https://</span>
    </div>

    <?php if ($edit) {
      $slugShow = htmlspecialchars($reg[0]['slug']);
    ?>
    <div class="form-group full">
      <label>Enlaces</label>
      <div class="sa-links-box">
        <?php
          $menuUrl = function_exists('app_url') ? app_url('/'.$slugShow.'/') : '/'.$slugShow.'/';
          $posUrl = function_exists('app_url') ? app_url('/'.$slugShow.'/sistema/') : '/'.$slugShow.'/sistema/';
        ?>
        <p><a href="<?php echo htmlspecialchars($menuUrl); ?>" target="_blank">Menú / tienda → <?php echo htmlspecialchars($menuUrl); ?></a></p>
        <p><a href="<?php echo htmlspecialchars($posUrl); ?>" target="_blank">Login POS → <?php echo htmlspecialchars($posUrl); ?></a></p>
      </div>
    </div>
    <?php } ?>

    <div class="form-group">
      <label>RUC</label>
      <input type="text" name="ruc" value="<?php echo $edit ? htmlspecialchars($reg[0]['ruc']) : ''; ?>">
    </div>
    <div class="form-group">
      <label>Teléfono</label>
      <input type="text" name="telefono" value="<?php echo $edit ? htmlspecialchars($reg[0]['telefono']) : ''; ?>">
    </div>
    <div class="form-group full">
      <label>Email</label>
      <input type="email" name="email" value="<?php echo $edit ? htmlspecialchars($reg[0]['email']) : ''; ?>">
    </div>
    <div class="form-group full">
      <label>Dirección</label>
      <textarea name="direccion" rows="2"><?php echo $edit ? htmlspecialchars($reg[0]['direccion']) : ''; ?></textarea>
    </div>
    <div class="form-group full">
      <label>Logo</label>
      <input type="file" name="logo" accept="image/*">
      <?php if ($edit && !empty($reg[0]['logo'])) { ?>
        <p style="margin-top:10px;"><img class="sa-logo-preview" src="<?php echo htmlspecialchars(function_exists('restaurant_logo_url') ? restaurant_logo_url($reg[0]['logo']) : '../'.$reg[0]['logo']); ?>" alt="Logo"></p>
      <?php } ?>
    </div>

    <div class="form-group full">
      <label>Colores de marca (menú público)</label>
      <p class="sa-hint" style="margin:0 0 12px;opacity:.75;font-size:.9rem;">Se aplican a toda la tienda: barra, textos, botones, banner, modal del carrito y pie.</p>
      <div class="sa-colors">
        <div class="sa-color-field">
          <label for="color_primario">Primario <small>(barra, categorías, botones Agregar)</small></label>
          <div class="sa-color-row">
            <input type="color" id="color_primario" name="color_primario" value="<?php echo htmlspecialchars($cPrim); ?>">
            <input type="text" id="color_primario_hex" maxlength="7" value="<?php echo htmlspecialchars(strtoupper($cPrim)); ?>" spellcheck="false">
          </div>
          <div class="sa-color-chip" id="chip-primario" style="background: <?php echo htmlspecialchars($cPrim); ?>;"></div>
        </div>
        <div class="sa-color-field">
          <label for="color_secundario">Secundario <small>(textos, precios, pie de página)</small></label>
          <div class="sa-color-row">
            <input type="color" id="color_secundario" name="color_secundario" value="<?php echo htmlspecialchars($cSec); ?>">
            <input type="text" id="color_secundario_hex" maxlength="7" value="<?php echo htmlspecialchars(strtoupper($cSec)); ?>" spellcheck="false">
          </div>
          <div class="sa-color-chip" id="chip-secundario" style="background: <?php echo htmlspecialchars($cSec); ?>;"></div>
        </div>
        <div class="sa-color-field">
          <label for="color_acento">Acento <small>(enlaces, CTAs, badges del carrito)</small></label>
          <div class="sa-color-row">
            <input type="color" id="color_acento" name="color_acento" value="<?php echo htmlspecialchars($cAcc); ?>">
            <input type="text" id="color_acento_hex" maxlength="7" value="<?php echo htmlspecialchars(strtoupper($cAcc)); ?>" spellcheck="false">
          </div>
          <div class="sa-color-chip" id="chip-acento" style="background: <?php echo htmlspecialchars($cAcc); ?>;"></div>
        </div>
      </div>
    </div>
  </div>

  <div class="sa-form-actions">
    <button type="submit" class="sa-btn" name="<?php echo $edit ? 'btn-actualizar' : 'btn-restaurante'; ?>" id="btn-save">
      <?php echo $edit ? 'Actualizar' : 'Crear restaurante'; ?>
    </button>
    <a class="sa-btn secondary" href="restaurantes.php">Volver</a>
  </div>
</form>
<script>
(function () {
  function normHex(v) {
    v = (v || '').trim();
    if (v.charAt(0) !== '#') v = '#' + v;
    if (/^#[0-9A-Fa-f]{6}$/.test(v)) return v.toUpperCase();
    return null;
  }

  function syncPreview() {
    var p = $('#color_primario').val();
    var s = $('#color_secundario').val();
    var a = $('#color_acento').val();
    $('#preview-bar').css('background', p);
    $('#preview-cta').css('background', a);
    $('#chip-primario').css('background', p);
    $('#chip-secundario').css('background', s);
    $('#chip-acento').css('background', a);
    $('#hex-primario').text((p || '').toUpperCase());
    $('#hex-secundario').text((s || '').toUpperCase());
    $('#hex-acento').text((a || '').toUpperCase());
    var n = ($('#nombre').val() || '').trim();
    $('#preview-name').text(n || 'Nuevo restaurante');
  }

  function bindColor(id) {
    var $picker = $('#' + id);
    var $hex = $('#' + id + '_hex');
    $picker.on('input change', function () {
      $hex.val(($picker.val() || '').toUpperCase());
      syncPreview();
    });
    $hex.on('input change blur', function () {
      var h = normHex($hex.val());
      if (h) {
        $picker.val(h);
        $hex.val(h);
        syncPreview();
      }
    });
  }

  bindColor('color_primario');
  bindColor('color_secundario');
  bindColor('color_acento');
  $('#nombre').on('input', syncPreview);
  syncPreview();

  $('#form-rest').on('submit', function (e) {
    e.preventDefault();
    // Sincronizar hex → color picker antes de enviar
    ['color_primario', 'color_secundario', 'color_acento'].forEach(function (id) {
      var h = normHex($('#' + id + '_hex').val());
      if (h) $('#' + id).val(h);
    });
    var fd = new FormData(this);
    fd.append($('#btn-save').attr('name'), '1');
    // Asegurar valores de color en el FormData
    fd.set('color_primario', $('#color_primario').val());
    fd.set('color_secundario', $('#color_secundario').val());
    fd.set('color_acento', $('#color_acento').val());
    $.ajax({
      url: 'forrestaurante.php',
      type: 'POST',
      data: fd,
      processData: false,
      contentType: false,
      success: function (html) {
        $('#sa-msg').html(html);
        if (html.indexOf('alert-success') !== -1) {
          setTimeout(function () { window.location = 'restaurantes.php'; }, 900);
        }
      }
    });
  });
})();
</script>
<?php sa_footer(); ?>
