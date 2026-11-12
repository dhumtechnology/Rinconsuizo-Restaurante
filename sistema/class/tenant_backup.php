<?php
/**
 * Respaldo y restauración SQL solo del tenant actual (id_restaurante).
 */

define('RS_TENANT_BACKUP_MARKER', 'RS_TENANT_BACKUP');
define('RS_TENANT_BACKUP_VERSION', '1');

/** Tablas con columna id_restaurante (orden: padres antes que hijos en INSERT). */
function rs_tenant_tables_direct()
{
	return array(
		'configuracion',
		'salas',
		'categorias',
		'mediospagos',
		'proveedores',
		'cajas',
		'impresoras',
		'mesas',
		'productos',
		'ingredientes',
		'clientes',
		'usuarios',
		'arqueocaja',
		'compras',
		'ventas',
		'movimientoscajas',
		'reservas',
		'carrito',
		'log',
	);
}

/**
 * Tablas hijas: SQL con un placeholder ? para id_restaurante.
 *
 * @return array<int, array{0: string, 1: string}>
 */
function rs_tenant_tables_child_queries()
{
	return array(
		array('mesas_unidas', 'SELECT mu.* FROM mesas_unidas mu INNER JOIN mesas m ON m.codmesa = mu.codmesa_principal WHERE m.id_restaurante = ?'),
		array('productosvsingredientes', 'SELECT pv.* FROM productosvsingredientes pv INNER JOIN productos p ON p.codproducto = pv.codproducto WHERE p.id_restaurante = ?'),
		array('kardexproductos', 'SELECT k.* FROM kardexproductos k INNER JOIN productos p ON p.codproducto = k.codproducto WHERE p.id_restaurante = ?'),
		array('kardexingredientes', 'SELECT k.* FROM kardexingredientes k INNER JOIN ingredientes i ON i.codingrediente = k.codingrediente WHERE i.id_restaurante = ?'),
		array('detallecompras', 'SELECT d.* FROM detallecompras d INNER JOIN compras c ON c.codcompra = d.codcompra WHERE c.id_restaurante = ?'),
		array('detalleventas', 'SELECT d.* FROM detalleventas d INNER JOIN ventas v ON v.codventa = d.codventa WHERE v.id_restaurante = ?'),
		array('abonoscreditos', 'SELECT a.* FROM abonoscreditos a INNER JOIN ventas v ON v.codventa = a.codventa WHERE v.id_restaurante = ?'),
		array('pagosventa', 'SELECT p.* FROM pagosventa p INNER JOIN ventas v ON v.codventa = (p.codventa COLLATE utf8mb3_spanish_ci) WHERE v.id_restaurante = ?'),
	);
}

function rs_tenant_allowed_insert_tables()
{
	$direct = rs_tenant_tables_direct();
	$child = array();
	foreach (rs_tenant_tables_child_queries() as $pair) {
		$child[] = $pair[0];
	}
	return array_merge($direct, $child);
}

function rs_tenant_build_inserts(PDO $dbh, $table, array $rows)
{
	if ($rows === array()) {
		return '';
	}
	$out = "\n-- Tabla: $table (" . count($rows) . " filas)\n";
	foreach ($rows as $row) {
		$cols = array_keys($row);
		$vals = array();
		foreach ($cols as $c) {
			if ($row[$c] === null) {
				$vals[] = 'NULL';
			} else {
				$vals[] = $dbh->quote((string) $row[$c]);
			}
		}
		$colList = implode(',', array_map(function ($c) {
			return '`' . str_replace('`', '``', $c) . '`';
		}, $cols));
		$out .= 'INSERT INTO `' . str_replace('`', '``', $table) . '` (' . $colList . ') VALUES (' . implode(',', $vals) . ");\n";
	}
	return $out;
}

function rs_tenant_export_sql(PDO $dbh, $idRest)
{
	$idRest = (int) $idRest;
	if ($idRest <= 0) {
		return array('ok' => false, 'error' => 'Restaurante no identificado en la sesión.');
	}

	$slug = '';
	$st = $dbh->prepare('SELECT slug, nombre FROM restaurantes WHERE id_restaurante = ? LIMIT 1');
	$st->execute(array($idRest));
	if ($r = $st->fetch(PDO::FETCH_ASSOC)) {
		$slug = isset($r['slug']) ? $r['slug'] : '';
		$nombre = isset($r['nombre']) ? $r['nombre'] : '';
	} else {
		$nombre = 'restaurante';
	}

	$sql = '-- ' . RS_TENANT_BACKUP_MARKER . ' v' . RS_TENANT_BACKUP_VERSION . "\n";
	$sql .= '-- tenant_id=' . $idRest . "\n";
	$sql .= '-- tenant_slug=' . $slug . "\n";
	$sql .= '-- generated=' . date('c') . "\n";
	$sql .= "SET NAMES utf8mb4;\nSET FOREIGN_KEY_CHECKS=0;\n\n";

	foreach (rs_tenant_tables_direct() as $table) {
		if ($table === 'usuarios') {
			$q = $dbh->prepare('SELECT * FROM usuarios WHERE id_restaurante = ? AND (nivel IS NULL OR nivel <> ?)');
			$q->execute(array($idRest, 'SUPERADMINISTRADOR'));
		} else {
			$q = $dbh->prepare('SELECT * FROM `' . $table . '` WHERE id_restaurante = ?');
			$q->execute(array($idRest));
		}
		$rows = $q->fetchAll(PDO::FETCH_ASSOC);
		$sql .= rs_tenant_build_inserts($dbh, $table, $rows);
	}

	foreach (rs_tenant_tables_child_queries() as $pair) {
		$table = $pair[0];
		$query = $pair[1];
		$q = $dbh->prepare($query);
		$q->execute(array($idRest));
		$rows = $q->fetchAll(PDO::FETCH_ASSOC);
		$sql .= rs_tenant_build_inserts($dbh, $table, $rows);
	}

	$sql .= "\nSET FOREIGN_KEY_CHECKS=1;\n";

	return array(
		'ok' => true,
		'sql' => $sql,
		'filename' => preg_replace('/[^a-z0-9\-]+/i', '_', $slug !== '' ? $slug : 'restaurante') . '_backup_' . $idRest . '_' . date('Y-m-d_His') . '.sql',
		'nombre' => isset($nombre) ? $nombre : '',
	);
}

function rs_tenant_parse_backup_header($content)
{
	$tenantId = null;
	if (preg_match('/^\s*--\s*' . preg_quote(RS_TENANT_BACKUP_MARKER, '/') . '\s+v(\d+)/m', $content, $m)) {
		// ok
	}
	if (preg_match('/^\s*--\s*tenant_id=(\d+)/m', $content, $m)) {
		$tenantId = (int) $m[1];
	}
	return $tenantId;
}

function rs_tenant_purge(PDO $dbh, $idRest)
{
	$idRest = (int) $idRest;
	$dbh->exec('SET FOREIGN_KEY_CHECKS=0');

	$deletes = array(
		'DELETE p FROM pagosventa p INNER JOIN ventas v ON v.codventa = (p.codventa COLLATE utf8mb3_spanish_ci) WHERE v.id_restaurante = ' . $idRest,
		'DELETE a FROM abonoscreditos a INNER JOIN ventas v ON v.codventa = a.codventa WHERE v.id_restaurante = ' . $idRest,
		'DELETE d FROM detalleventas d INNER JOIN ventas v ON v.codventa = d.codventa WHERE v.id_restaurante = ' . $idRest,
		'DELETE d FROM detallecompras d INNER JOIN compras c ON c.codcompra = d.codcompra WHERE c.id_restaurante = ' . $idRest,
		'DELETE k FROM kardexproductos k INNER JOIN productos p ON p.codproducto = k.codproducto WHERE p.id_restaurante = ' . $idRest,
		'DELETE k FROM kardexingredientes k INNER JOIN ingredientes i ON i.codingrediente = k.codingrediente WHERE i.id_restaurante = ' . $idRest,
		'DELETE pv FROM productosvsingredientes pv INNER JOIN productos p ON p.codproducto = pv.codproducto WHERE p.id_restaurante = ' . $idRest,
		'DELETE mu FROM mesas_unidas mu INNER JOIN mesas m ON m.codmesa = mu.codmesa_principal WHERE m.id_restaurante = ' . $idRest,
	);

	foreach ($deletes as $sql) {
		$dbh->exec($sql);
	}

	$directPurge = array(
		'ventas', 'compras', 'movimientoscajas', 'arqueocaja', 'reservas', 'carrito', 'log',
		'productos', 'ingredientes', 'mesas', 'clientes', 'usuarios',
		'mediospagos', 'proveedores', 'categorias', 'cajas', 'impresoras', 'salas', 'configuracion',
	);

	foreach ($directPurge as $table) {
		if ($table === 'usuarios') {
			$dbh->exec("DELETE FROM usuarios WHERE id_restaurante = $idRest AND (nivel IS NULL OR nivel <> 'SUPERADMINISTRADOR')");
		} else {
			$dbh->exec("DELETE FROM `$table` WHERE id_restaurante = $idRest");
		}
	}

	$dbh->exec('SET FOREIGN_KEY_CHECKS=1');
}

function rs_tenant_restore_sql(PDO $dbh, $idRest, $content)
{
	$idRest = (int) $idRest;
	if ($idRest <= 0) {
		return array('ok' => false, 'error' => 'Sesión sin restaurante válido.');
	}

	if (stripos($content, RS_TENANT_BACKUP_MARKER) === false) {
		return array('ok' => false, 'error' => 'El archivo no es un respaldo de restaurante válido (falta marca ' . RS_TENANT_BACKUP_MARKER . ').');
	}

	$fileTenant = rs_tenant_parse_backup_header($content);
	if ($fileTenant !== null && $fileTenant !== $idRest) {
		return array('ok' => false, 'error' => 'Este respaldo pertenece al restaurante #' . $fileTenant . ' y no coincide con su sesión (#' . $idRest . ').');
	}

	$allowed = rs_tenant_allowed_insert_tables();
	$allowedMap = array_fill_keys($allowed, true);

	$content = preg_replace('/\r\n|\r/', "\n", $content);
	$lines = explode("\n", $content);
	$statements = array();
	$buf = '';
	foreach ($lines as $line) {
		$trim = trim($line);
		if ($trim === '' || strpos($trim, '--') === 0) {
			continue;
		}
		if (stripos($trim, 'SET ') === 0) {
			continue;
		}
		$buf .= $line . "\n";
		if (substr(rtrim($trim), -1) === ';') {
			$statements[] = trim($buf);
			$buf = '';
		}
	}
	if (trim($buf) !== '') {
		$statements[] = trim($buf);
	}

	$inserts = array();
	foreach ($statements as $sql) {
		if (!preg_match('/^\s*INSERT\s+INTO\s+`?([a-zA-Z0-9_]+)`?/i', $sql, $m)) {
			continue;
		}
		$table = $m[1];
		if (empty($allowedMap[$table])) {
			return array('ok' => false, 'error' => 'Sentencia no permitida en la tabla: ' . $table);
		}
		$inserts[] = $sql;
	}

	if ($inserts === array()) {
		return array('ok' => false, 'error' => 'No se encontraron datos INSERT en el archivo.');
	}

	try {
		$dbh->beginTransaction();
		$dbh->exec('SET FOREIGN_KEY_CHECKS=0');
		rs_tenant_purge($dbh, $idRest);
		foreach ($inserts as $sql) {
			$dbh->exec($sql);
		}
		$dbh->exec('SET FOREIGN_KEY_CHECKS=1');
		$dbh->commit();
	} catch (PDOException $e) {
		if ($dbh->inTransaction()) {
			$dbh->rollBack();
		}
		return array('ok' => false, 'error' => 'Error al restaurar: ' . $e->getMessage());
	}

	return array('ok' => true, 'rows' => count($inserts));
}

function rs_tenant_backup_download_headers($filename)
{
	if (headers_sent()) {
		return false;
	}
	header('Pragma: no-cache');
	header('Expires: 0');
	header('Content-Type: application/sql; charset=UTF-8');
	header('Content-Disposition: attachment; filename="' . str_replace('"', '', $filename) . '"');
	return true;
}
