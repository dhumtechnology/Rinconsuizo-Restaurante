<?php
class Db{
		
	private $dbHost;
    private $dbUsername;
    private $dbPassword;
    private $dbName;
	protected $p; 
	protected $dbh; 
	
    public function __construct(){
        $this->dbHost     = getenv('DB_HOST') ?: 'localhost';
        $this->dbUsername = getenv('DB_USER') ?: 'root';
        $this->dbPassword = getenv('DB_PASS') !== false ? getenv('DB_PASS') : '';
        $this->dbName     = getenv('DB_NAME') ?: 'rinconsuizo';

        if(!isset($this->dbh)){
            try{
	
	            date_default_timezone_set('America/Caracas');
                setlocale(LC_ALL,"es_VE.UTF-8","es_VE","esp");
	
                $conn = new PDO("mysql:host=".$this->dbHost.";dbname=".$this->dbName, $this->dbUsername, $this->dbPassword,
				array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8, time_zone = '-04:00'"));
                $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->dbh = $conn;
            }catch(PDOException $e){
                die("Failed to connect with MySQL: " . $e->getMessage());
            }
        }
    }
	
		public function SetNames()
	{
		return $this->dbh->query("SET NAMES 'utf8'");
	}

###### FIN DE CLASE #####	

}	
?>
