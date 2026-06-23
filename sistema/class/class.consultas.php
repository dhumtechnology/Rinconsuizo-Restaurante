<?php
require_once("classconexion.php");

class conectorDB extends Db
{
	public function __construct()
    {
        parent::__construct();
    } 	
	
	public function EjecutarSentencia($consulta, $valores = array()){  //funcion principal, ejecuta todas las consultas
		$resultado = false;
		
		if($statement = $this->dbh->prepare($consulta)){  //prepara la consulta
			if(preg_match_all("/(:\w+)/", $consulta, $campo, PREG_PATTERN_ORDER)){ //tomo los nombres de los campos iniciados con :xxxxx
				$campo = array_pop($campo); //inserto en un arreglo
				foreach($campo as $parametro){
					$statement->bindValue($parametro, $valores[substr($parametro,1)]);
				}
			}
			try {
				if (!$statement->execute()) { //si no se ejecuta la consulta...
					print_r($statement->errorInfo()); //imprimir errores
					return false;
				}
				$resultado = $statement->fetchAll(PDO::FETCH_ASSOC); //si es una consulta que devuelve valores los guarda en un arreglo.
				$statement->closeCursor();
			}
			catch(PDOException $e){
				echo "Error de ejecución: \n";
				print_r($e->getMessage());
			}	
		}
		return $resultado;
		$this->dbh = null; //cerramos la conexión
	} /// Termina funcion consultarBD
}/// Termina clase conectorDB

class Json
{
	private $json;
	public function BuscaProductos($filtro){
    $consulta = "SELECT DISTINCT CONCAT(productos.producto) as label, productos.codproducto, productos.codcategoria, productos.precioventa, productos.preciocompra, productos.ivaproducto, productos.existencia, productosvsingredientes.codingrediente, productosvsingredientes.cantracion FROM productos LEFT JOIN productosvsingredientes ON productos.codproducto = productosvsingredientes.codproducto WHERE CONCAT(productos.codproducto, '',productos.producto) LIKE '%".$filtro."%' GROUP BY productos.codproducto ASC LIMIT 0,15";
		$conexion = new conectorDB;
		$this->json = $conexion->EjecutarSentencia($consulta);
		return $this->json;
	}
	
	public function BuscaIngredientes($filtro){
    $consulta = "SELECT CONCAT(nomingrediente) as label, codingrediente, nomingrediente, unidadingrediente, costoingrediente FROM ingredientes WHERE CONCAT(codingrediente, '',nomingrediente) LIKE '%".$filtro."%' GROUP BY codingrediente ASC LIMIT 0,15";
	$conexion = new conectorDB;
		$this->json = $conexion->EjecutarSentencia($consulta);
		return $this->json;
	}
	
	public function BuscaClientes($filtro){
		$consulta = "SELECT CONCAT(cedcliente, ': ',nomcliente) as label, codcliente FROM clientes WHERE CONCAT(cedcliente, '',nomcliente) LIKE '%".$filtro."%' order by codcliente asc LIMIT 0,15";
		$conexion = new conectorDB;
		$this->json = $conexion->EjecutarSentencia($consulta);
		return $this->json;
	}

	public function BuscaCodventa($filtro){
		$consulta = "SELECT codventa as label FROM ventas WHERE codventa LIKE '%".$filtro."%' order by codventa asc LIMIT 0,10";
		$conexion = new conectorDB;
		$this->json = $conexion->EjecutarSentencia($consulta);
		return $this->json;
	}
	
}/// TERMINA CLASE  ///
?>