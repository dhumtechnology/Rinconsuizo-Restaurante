<?php

class Database {
	public static $db;
	public static $con;
	public static $con1;
	
	function Database(){
		$this->host = getenv('DB_HOST') ?: 'localhost';
		$this->user = getenv('DB_USER') ?: 'root';
		$this->pass = getenv('DB_PASS') !== false ? getenv('DB_PASS') : '';
		$this->ddbb = getenv('DB_NAME') ?: 'rinconsuizo';
	} 

	
    
 
 	

	function connect(){
		$con = new mysqli($this->host,$this->user,$this->pass,$this->ddbb);
		$con->query("set sql_mode=''");
		return $con;
	}



	
	public static function Conectar()
    {        
        try
			{
				$host = getenv('DB_HOST') ?: 'localhost';
				$user = getenv('DB_USER') ?: 'root';
				$pass = getenv('DB_PASS') !== false ? getenv('DB_PASS') : '';
				$name = getenv('DB_NAME') ?: 'rinconsuizo';
				$conexionn = new PDO("mysql:host={$host};dbname={$name};charset=utf8", $user, $pass);
	        	$conexionn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
	        	return $conexionn;  
			}
				catch(Exception $e)
			{
				die($e->getMessage());
			}
    }

 
	function connect1(){
		$db = new PDO("mysql:host=$this->host;",$this->user,$this->pass);
		$db->exec("use `$this->ddbb`");
		return $db;	
	} 

	public static function getCon(){
		if(self::$con==null && self::$db==null){
			self::$db = new Database();
			self::$con = self::$db->connect();
		}
		return self::$con;
	}

	
}





?>
