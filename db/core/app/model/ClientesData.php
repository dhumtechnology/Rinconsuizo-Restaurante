<?php
class ClientesData {
	public static $tablename = "clientes";

	public function ClientesData(){

	
	}


	public function add(){
		$sql = "insert into clientes (cedcliente,nomcliente,direccliente,tlfcliente,emailcliente,password,documento) ";
		$sql .= "value (\"$this->cedcliente\",\"$this->nomcliente\",\"$this->direccliente\",\"$this->tlfcliente\",\"$this->emailcliente\",\"$this->password\",1)";
		Executor::doit($sql);
	}

	public function addCliente(){
		$sql = "insert into clientes (cedcliente,nomcliente,direccliente,tlfcliente,emailcliente,password,documento,estado,codigo) ";
		$sql .= "value (\"$this->cedcliente\",\"$this->nomcliente\",\"$this->direccliente\",\"$this->tlfcliente\",\"$this->emailcliente\",\"$this->password\",1,\"$this->estado\",\"$this->codigo\")";
		Executor::doit($sql);
	}

	public function updateCantidad(){
		$sql = "update ".self::$tablename." set estado=\"$this->estado\" where codcliente=$this->codcliente";
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where codcliente=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ClientesData());

	}

	public static function getByEmail($id){
		$sql = "select * from ".self::$tablename." where emailcliente=\"$id\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new ClientesData());

	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new ClientesData());
	} 




}

?>