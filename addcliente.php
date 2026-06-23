<?php
include "db/core/autoload.php";
include "db/core/app/model/ClientesData.php";

 
if(count($_POST)>0){ 
 


$clienteexiste = ClientesData::getByEmail($_POST["email"]);

if(@count($clienteexiste)>0){

 print "<script>alert('Error, ya existe esta cuenta.');</script>";

   print "<script>window.location='micuenta.php';</script>"; 

}else{



$caracteres_permitidos = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
$longitud = 6;
$codigo = substr(str_shuffle($caracteres_permitidos), 0, $longitud);

	$cliente = new ClientesData();
	
	$cliente->cedcliente = $_POST["documento"];
	$cliente->nomcliente = $_POST["nombre"];
	$cliente->direccliente = $_POST["direccion"];
	$cliente->tlfcliente = $_POST["celular"];
	$cliente->emailcliente = $_POST["email"];
	$cliente->password = $_POST["password"];
	$cliente->codigo = $codigo;
	$cliente->estado = 0;
	$cliente->addCliente();


$para  = $_POST['email'];
$titulo = 'CONFIRMACION RESTO';
ob_start();
include "mail/voucher.php";
$mensaje = ob_get_contents();
ob_end_clean();
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";   
$cabeceras .= 'From: NRO DE CONFIRMACION <rinconsuizo0744@gmail.com>' . "\r\n";    
mail($para, $titulo, $mensaje, $cabeceras);


session_start();

$base = new Database();
$con = $base->connect();


$username = $_POST['email'];
$password = $_POST['password'];
 
$sql = "SELECT * FROM clientes WHERE emailcliente = '$username'";

$result = $con->query($sql);


if ($result->num_rows > 0) {     
 }
 $row = $result->fetch_array(MYSQLI_ASSOC);
 if ($row['password']==$_POST['password'] ) { 
 	
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['id_cliente'] = $row['codcliente'];
    $_SESSION['start'] = time();
    $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);

 
    print "<script>window.location='micuenta.php';</script>"; 

 } else { 
    print "<script>alert('Error, ya existe esta cuenta');</script>";

   print "<script>window.location='micuenta.php';</script>"; 
 }
 mysqli_close($con); 






}



}


?>