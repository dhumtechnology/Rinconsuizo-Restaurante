<?php
class ReservaData {
	public static $tablename = "reservas";

	public function ReservaData(){

	
	}

	public function getCliente(){
		$idCli = isset($this->id_cliente) ? (int) $this->id_cliente : 0;
		if ($idCli <= 0 || !class_exists('ClientesData')) {
			return null;
		}
		$cli = ClientesData::getById($idCli);
		return ($cli && is_object($cli)) ? $cli : null;
	}

	private static function resolveTenantId()
	{
		if (function_exists('tenantId')) {
			$id = (int) tenantId();
			if ($id > 0) {
				return $id;
			}
		}
		if (function_exists('web_tenant_id')) {
			$id = (int) web_tenant_id();
			if ($id > 0) {
				return $id;
			}
		}
		return 0;
	}

	public function add(){
		$id = (int) $this->id_cliente;
		$cant = (int) $this->cantidad;
		$fecha = addslashes($this->fecha);
		$mensaje = addslashes($this->mensaje);
		$telefono = isset($this->telefono) ? addslashes($this->telefono) : '';
		$idRest = self::resolveTenantId();
		if ($idRest <= 0) {
			return false;
		}
		$sql = "insert into reservas (id_cliente,cantidad,fecha,mensaje,telefono,id_restaurante) ";
		$sql .= "values (\"$id\",\"$cant\",\"$fecha\",\"$mensaje\",\"$telefono\",\"$idRest\")";
		$result = Executor::doit($sql);
		return is_array($result) && $result[0] !== false;
	}

	public function del(){
		$idRest = self::resolveTenantId();
		$extra = ($idRest > 0) ? " AND id_restaurante=$idRest" : ' AND 1=0';
		$sql = "delete from ".self::$tablename." where id=$this->id".$extra;
		Executor::doit($sql);
	}

	public static function getById($id){
		$idRest = self::resolveTenantId();
		$extra = ($idRest > 0) ? " AND id_restaurante=$idRest" : ' AND 1=0';
		$sql = "select * from ".self::$tablename." where id=$id".$extra;
		$query = Executor::doit($sql);
		return Model::one($query[0],new ReservaData());
	}

	public static function getAll(){
		$idRest = self::resolveTenantId();
		if ($idRest > 0) {
			$sql = "select * from ".self::$tablename." WHERE id_restaurante=$idRest ORDER BY id DESC";
		} elseif (function_exists('esSuperAdmin') && esSuperAdmin()) {
			$sql = "select * from ".self::$tablename." ORDER BY id DESC";
		} else {
			$sql = "select * from ".self::$tablename." WHERE 1=0 ORDER BY id DESC";
		}
		$query = Executor::doit($sql);
		if (!$query || empty($query[0])) {
			return array();
		}
		return Model::many($query[0], new ReservaData());
	}
}

?>
