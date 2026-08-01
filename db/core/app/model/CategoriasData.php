<?php
class CategoriasData {
	public static $tablename = "categorias";

	public function CategoriasData(){

	
	}



	public static function getById($id){
		$sql = "select * from ".self::$tablename." where codcategoria=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new CategoriasData());

	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename." where 1=1";
		if (function_exists('web_tenant_sql')) {
			$sql .= web_tenant_sql();
		}
		$query = Executor::doit($sql);
		return Model::many($query[0],new CategoriasData());
	} 




}

?>