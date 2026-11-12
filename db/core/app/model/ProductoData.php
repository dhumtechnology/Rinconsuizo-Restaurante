<?php
class ProductoData {
	public static $tablename = "productos";

	public function ProductoData(){

	
	}

	

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where codalmacen=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ProductoData());

	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename." where 1=1";
		if (function_exists('web_tenant_sql')) {
			$sql .= web_tenant_sql();
		}
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductoData());
	} 

	public static function getBycategoria($id){
		$sql = "select * from ".self::$tablename." where codcategoria=$id ";
		if (function_exists('web_tenant_sql')) {
			$sql .= web_tenant_sql();
		}
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductoData());
	}

	/**
	 * Búsqueda de productos para la tienda web (nombre, código o código de barra).
	 * @param string $q
	 * @param int|null $categoriaId
	 */
	public static function buscar($q, $categoriaId = null){
		$q = trim((string) $q);
		$sql = "SELECT * FROM ".self::$tablename." WHERE 1=1";
		if (function_exists('web_tenant_sql')) {
			$sql .= web_tenant_sql();
		}
		if ($categoriaId !== null && $categoriaId !== '' && (int) $categoriaId > 0) {
			$sql .= " AND codcategoria=".(int) $categoriaId;
		}
		if ($q !== '') {
			$safe = addslashes($q);
			$sql .= " AND (producto LIKE \"%$safe%\" OR codproducto LIKE \"%$safe%\" OR codigobarra LIKE \"%$safe%\")";
		}
		$sql .= " AND (statusproducto = 'ACTIVO' OR statusproducto = '1' OR statusproducto = '' OR statusproducto IS NULL)";
		$sql .= " ORDER BY producto ASC";
		$query = Executor::doit($sql);
		return Model::many($query[0], new ProductoData());
	}

	/**
	 * Platos más vendidos de este restaurante (POS + web), para la carta pública.
	 * @param int $limit
	 */
	public static function getPopulares($limit = 5)
	{
		$limit = (int) $limit;
		if ($limit < 1) {
			$limit = 5;
		}
		if ($limit > 24) {
			$limit = 24;
		}
		$tid = function_exists('web_tenant_id') ? (int) web_tenant_id() : 0;
		if ($tid <= 0) {
			$tid = 1;
		}
		$sql = "SELECT p.*, x.cantidad_vendida
			FROM productos p
			INNER JOIN (
				SELECT d.codproducto, SUM(d.cantventa) AS cantidad_vendida
				FROM detalleventas d
				INNER JOIN ventas v ON v.codventa = d.codventa
				WHERE v.id_restaurante = $tid
				GROUP BY d.codproducto
			) x ON x.codproducto = p.codproducto
			WHERE p.id_restaurante = $tid
			AND (p.statusproducto = 'ACTIVO' OR p.statusproducto = '1' OR p.statusproducto = '' OR p.statusproducto IS NULL)
			ORDER BY x.cantidad_vendida DESC, p.producto ASC
			LIMIT $limit";
		$query = Executor::doit($sql);
		if (!$query || empty($query[0])) {
			return array();
		}
		return Model::many($query[0], new ProductoData());
	}
}
?>