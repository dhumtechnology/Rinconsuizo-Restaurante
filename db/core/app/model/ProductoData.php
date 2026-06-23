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




}

?>