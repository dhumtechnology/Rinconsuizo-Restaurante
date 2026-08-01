<?php
require_once('_bootstrap.php');
$tra = sa_gate();
$lista = $tra->ListarRestaurantes();
sa_header('Restaurantes');
?>
<div class="sa-toolbar">
  <a class="sa-btn" href="forrestaurante.php">+ Nuevo restaurante</a>
</div>
<div class="sa-table-wrap">
<table class="sa-table">
<thead><tr><th>ID</th><th>Logo</th><th>Nombre</th><th>URLs</th><th>Dominio</th><th>Colores</th><th>Estado</th><th></th></tr></thead>
<tbody>
<?php for ($i = 0; $i < count($lista); $i++) { $r = $lista[$i]; $slug = htmlspecialchars($r['slug']); ?>
<tr>
  <td><?php echo (int)$r['id_restaurante']; ?></td>
  <td><?php if (!empty($r['logo'])) { ?><img class="sa-logo-preview" src="<?php echo htmlspecialchars(function_exists('restaurant_logo_url') ? restaurant_logo_url($r['logo']) : '../'.$r['logo']); ?>"><?php } else { echo '—'; } ?></td>
  <td><?php echo htmlspecialchars($r['nombre']); ?></td>
  <td style="font-size:0.8rem;">
    <a href="/<?php echo $slug; ?>/" target="_blank" style="color:#3d9cfd;">/<?php echo $slug; ?>/</a><br>
    <a href="/<?php echo $slug; ?>/sistema/" target="_blank" style="color:#8b9bb4;">/<?php echo $slug; ?>/sistema/</a>
  </td>
  <td><?php echo !empty($r['dominio']) ? htmlspecialchars($r['dominio']) : '—'; ?></td>
  <td>
    <span class="sa-swatches" title="<?php echo htmlspecialchars($r['color_primario'].' / '.$r['color_secundario'].' / '.$r['color_acento']); ?>">
      <span style="background:<?php echo htmlspecialchars($r['color_primario']); ?>"></span>
      <span style="background:<?php echo htmlspecialchars($r['color_secundario']); ?>"></span>
      <span style="background:<?php echo htmlspecialchars($r['color_acento']); ?>"></span>
    </span>
  </td>
  <td><span class="sa-badge <?php echo $r['status']==='ACTIVO'?'ok':'off'; ?>"><?php echo htmlspecialchars($r['status']); ?></span></td>
  <td class="sa-actions">
    <a href="forrestaurante.php?id_restaurante=<?php echo base64_encode($r['id_restaurante']); ?>">Editar</a>
    <a href="config_restaurante.php?id_restaurante=<?php echo (int)$r['id_restaurante']; ?>">Config POS</a>
    <a href="forusuario.php?id_restaurante=<?php echo (int)$r['id_restaurante']; ?>">Admin</a>
  </td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
<?php sa_footer(); ?>
