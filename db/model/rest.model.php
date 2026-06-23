<?php
class Database
{
    public static function Conectar()
    {        
        try
			{
				$host = getenv('DB_HOST') ?: 'localhost';
				$user = getenv('DB_USER') ?: 'root';
				$pass = getenv('DB_PASS') !== false ? getenv('DB_PASS') : '';
				$name = getenv('DB_NAME_ECOMMERCE') ?: (getenv('DB_NAME') ?: 'rinconsuizo');
				$conexionn = new PDO("mysql:host={$host};dbname={$name};charset=utf8", $user, $pass);
	        	$conexionn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
	        	return $conexionn;  
			}
				catch(Exception $e)
			{
				die($e->getMessage());
			}
    }
}
?>