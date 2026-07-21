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
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new ProductoData());
	} 

	public static function getBycategoria($id){
		$sql = "select * from ".self::$tablename." where codcategoria=$id ";
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
}
?>