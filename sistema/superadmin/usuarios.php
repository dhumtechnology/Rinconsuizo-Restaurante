<?php
require_once('_bootstrap.php');
$tra = sa_gate();
$lista = $tra->ListarUsuariosPlataforma();
sa_header('Usuarios de restaurantes');
?>
<div class="sa-toolbar">
  <a class="sa-btn" href="forusuario.php">+ Crear administrador</a>
</div>
<div class="sa-table-wrap">
<table class="sa-table">
<thead><tr><th>Código</th><th>Nombre</th><th>Usuario</th><th>Nivel</th><th>Restaurante</th><th>Estado</th></tr></thead>
<tbody>
<?php for ($i = 0; $i < count($lista); $i++) { $u = $lista[$i]; ?>
<tr>
  <td><?php echo (int)$u['codigo']; ?></td>
  <td><?php echo htmlspecialchars($u['nombres']); ?></td>
  <td><?php echo htmlspecialchars($u['usuario']); ?></td>
  <td><?php echo htmlspecialchars($u['nivel']); ?></td>
  <td><?php echo htmlspecialchars(isset($u['restaurante_nombre']) ? $u['restaurante_nombre'] : '—'); ?></td>
  <td><span class="sa-badge <?php echo $u['status']==='ACTIVO'?'ok':'off'; ?>"><?php echo htmlspecialchars($u['status']); ?></span></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
<?php sa_footer(); ?>
