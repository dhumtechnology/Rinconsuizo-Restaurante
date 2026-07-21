<?php
define('FPDF_FONTPATH','fpdf/font/');
require('fpdf.php');
 
class PDF extends FPDF
{
var $flowingBlockAttr;


########################## FUNCION PARA MOSTRAR EL FOOTER ############################
	
	//Pie de p�gina
function Footer()
    {
        //Posici�n: a 2 cm del final
  $this->Ln();
  $this->SetY(-12);
  $this->SetFont('courier','B',10);
        //N�mero de p�gina
  
  //Page number
  /*$pagenumber = '{nb}';
    if($this->PageNo() == 2){
        $this->Cell(173,10, ' FOOTER TEST  -  '.$pagenumber, 0, 0);
    }*/

      if($this->page>0)
        {
            // Page footer
            //$this->InFooter = true;
            //$this->Footer();
            //$this->InFooter = false;
            // Close page
            $this->_endpage();
        }

    } 
############################## FIN DE FUNCION PARA MOSTRAR EL FOOTER ######################################











################################ REPORTES DE MANTENIMIENTO ######################################

    
########################## FUNCION LISTAR USUARIOS ##############################
      function TablaListarUsuarios()
   {
    //Logo
    $logo = "./assets/images/logo_dark.png";
    $logo2 = "./assets/images/logo_white_2.png";
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,22,$this->Image($logo, $this->GetX()+88, $this->GetY()+4, 24),5,0,'L');
    $this->Cell(250,8,'SISTEMA DE GESTI�N PARA RESTAURANTES',5,0,'C');
    $this->Cell(45,22,$this->Image($logo2, $this->GetX()-72, $this->GetY()+6, 58),5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-28,utf8_decode($con[0]['nomempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-20,'RUC: '.utf8_decode($con[0]['rifempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-12,'DIREC: '.utf8_decode($con[0]['direcempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-4,'N� DE TEL�FONO: '.utf8_decode($con[0]['tlfempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,4,'EMAIL: '.utf8_decode($con[0]['correoempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    $this->Ln(8);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(350,10,'LISTADO GENERAL DE USUARIOS',0,0,'C');
    
   
    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(230, 126, 34); // establece el color del fondo de la celda (en este caso es NARANJA)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(30,8,'Nit',1,0,'C', True);
    $this->Cell(80,8,'NOMBRES Y APELLIDOS',1,0,'C', True);
    $this->Cell(25,8,'CARGO',1,0,'C', True);
    $this->Cell(70,8,'EMAIL',1,0,'C', True);
    $this->Cell(35,8,'N� DE TEL�FONO',1,0,'C', True);
    $this->Cell(40,8,'USUARIO',1,0,'C', True);
    $this->Cell(40,8,'NIVEL',1,1,'C', True);
    
    $tra = new Login();
    $reg = $tra->ListarUsuarios();

    if($reg==""){
    echo "";      
    } else {
 
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){
    $this->SetFont('courier','',9);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(10,6,$a++,1,0,'C');
    $this->CellFitSpace(30,6,$reg[$i]["cedula"],1,0,'C');
    $this->CellFitSpace(80,6,utf8_decode($reg[$i]["nombres"]),1,0,'C');
    $this->CellFitSpace(25,6,utf8_decode($reg[$i]["cargo"]),1,0,'C');
    $this->CellFitSpace(70,6,utf8_decode($reg[$i]["email"]),1,0,'C');
    $this->CellFitSpace(35,6,utf8_decode($reg[$i]["nrotelefono"]),1,0,'C');
    $this->CellFitSpace(40,6,utf8_decode($reg[$i]["usuario"]),1,0,'C');
    $this->CellFitSpace(40,6,utf8_decode($reg[$i]["nivel"]),1,0,'C');
    $this->Ln();
         }
   }
    $this->Ln(12); 
    $this->SetFont('courier','B',9);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO POR: '.utf8_decode($_SESSION["nivel"]."/".$_SESSION["nombres"]),0,0,'');
    $this->Cell(120,6,'RECIBIDO:__________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA ELABORACI�N:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(120,6,'',0,0,'');
    $this->Ln(4);
     }
########################## FUNCION LISTAR USUARIOS ##############################
	
########################### FUNCION LISTAR LOGS DE ACCESO DE USUARIOS ##############################
	  function TablaListarLogs()
   {
    //Logo
    $logo = "./assets/images/logo_dark.png";
    $logo2 = "./assets/images/logo_white_2.png";
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,22,$this->Image($logo, $this->GetX()+88, $this->GetY()+4, 24),5,0,'L');
    $this->Cell(250,8,'SISTEMA DE GESTI�N PARA RESTAURANTES',5,0,'C');
    $this->Cell(45,22,$this->Image($logo2, $this->GetX()-72, $this->GetY()+6, 58),5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-28,utf8_decode($con[0]['nomempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-20,'RUC: '.utf8_decode($con[0]['rifempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-12,'DIREC: '.utf8_decode($con[0]['direcempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-4,'N� DE TEL�FONO: '.utf8_decode($con[0]['tlfempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,4,'EMAIL: '.utf8_decode($con[0]['correoempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    $this->Ln(8);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(350,10,'LISTADO GENERAL DE LOGS DE USUARIOS',0,0,'C');
	
	$this->Ln();
	$this->SetFont('courier','B',10);
	$this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(230, 126, 34); // establece el color del fondo de la celda (en este caso es NARANJA)
	$this->Cell(10,8,'N�',1,0,'C', True);
	$this->Cell(35,8,'IP',1,0,'C', True);
	$this->Cell(45,8,'TIEMPO ENTRADA',1,0,'C', True);
	$this->Cell(190,8,'NAVEGADOR DE ACCESO',1,0,'C', True);
	$this->Cell(50,8,'USUARIO',1,1,'C', True);
	
    $tra = new Login();
    $reg = $tra->ListarLogs();

    if($reg==""){

    echo "";      
    
    } else {
 
	$a=1;
    for($i=0;$i<sizeof($reg);$i++){
	$this->SetFont('courier','',9);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(10,6,$a++,1,0,'C');
	$this->CellFitSpace(35,6,$reg[$i]["ip"],1,0,'C');
    $this->CellFitSpace(45,6,utf8_decode($reg[$i]["tiempo"]),1,0,'C');
    $this->CellFitSpace(190,6,utf8_decode($reg[$i]["detalles"]),1,0,'C');
	$this->CellFitSpace(50,6,utf8_decode($reg[$i]["usuario"]),1,0,'C');
    $this->Ln();
	  }
   }
    $this->Ln(12); 
    $this->SetFont('courier','B',9);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO POR: '.utf8_decode($_SESSION["nivel"]."/".$_SESSION["nombres"]),0,0,'');
    $this->Cell(120,6,'RECIBIDO:__________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA ELABORACI�N:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(120,6,'',0,0,'');
    $this->Ln(4);
     }
######################## FIN DE FUNCION LISTAR LOGS DE ACCESO DE USUARIOS ######################

########################### FUNCION LISTAR CAJAS DE VENTAS ###########################
	  function TablaListarCajas()
   {
    //Logo
    $logo = "./assets/images/logo_dark.png";
    $logo2 = "./assets/images/logo_white_2.png";
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,22,$this->Image($logo, $this->GetX()+24, $this->GetY()+4, 22),5,0,'L');
    $this->Cell(105,8,'SISTEMA DE GESTI�N PARA RESTAURANTES',5,0,'C');
    $this->Cell(45,22,$this->Image($logo2, $this->GetX()-2, $this->GetY()+6, 34),5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-28,utf8_decode($con[0]['nomempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-20,'RUC: '.utf8_decode($con[0]['rifempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-12,'DIREC: '.utf8_decode($con[0]['direcempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-4,'N� DE TEL�FONO: '.utf8_decode($con[0]['tlfempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,4,'EMAIL: '.utf8_decode($con[0]['correoempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    $this->Ln(8);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(195,10,'LISTADO GENERAL DE CAJAS DE VENTAS',0,0,'C');
	
	$this->Ln();
    $this->SetFont('courier','B',10);
	$this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(230, 126, 34); // establece el color del fondo de la celda (en este caso es NARANJA)
	$this->Cell(10,8,'N�',1,0,'C', True);
	$this->Cell(25,8,'N� CAJA',1,0,'C', True);
	$this->Cell(45,8,'NOMBRE DE CAJA',1,0,'C', True);
	$this->Cell(40,8,'Nit DE CAJERO',1,0,'C', True);
	$this->Cell(70,8,'NOMBRE DE CAJERO',1,1,'C', True);
	
    $tra = new Login();
    $reg = $tra->ListarCajas();

    if($reg==""){

    echo "";      
    
    } else {
 
	$a=1;
    for($i=0;$i<sizeof($reg);$i++){
	$this->SetFont('courier','',9);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(10,6,$a++,1,0,'C');
	$this->CellFitSpace(25,6,utf8_decode($reg[$i]["nrocaja"]),1,0,'C');
    $this->CellFitSpace(45,6,utf8_decode($reg[$i]["nombrecaja"]),1,0,'C');
    $this->CellFitSpace(40,6,utf8_decode($reg[$i]["cedula"]),1,0,'C');
	$this->CellFitSpace(70,6,utf8_decode($reg[$i]["nombres"]),1,0,'C');
    $this->Ln();
	   }
   }
    $this->Ln(12); 
    $this->SetFont('courier','B',9);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(120,6,'ELABORADO POR: '.utf8_decode($_SESSION["nivel"]."/".$_SESSION["nombres"]),0,0,'');
    $this->Cell(40,6,'RECIBIDO:_________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(120,6,'FECHA/HORA ELABORACI�N:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(40,6,'',0,0,'');
    $this->Ln(4);
     }
############################ FIN DE FUNCION LISTAR CAJAS DE VENTAS ############################

############################# FUNCION LISTAR CLIENTES #############################
	  function TablaListarClientes()
   {
    //Logo
    $logo = "./assets/images/logo_dark.png";
    $logo2 = "./assets/images/logo_white_2.png";
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,22,$this->Image($logo, $this->GetX()+88, $this->GetY()+4, 24),5,0,'L');
    $this->Cell(250,8,'SISTEMA DE GESTI�N PARA RESTAURANTES',5,0,'C');
    $this->Cell(45,22,$this->Image($logo2, $this->GetX()-72, $this->GetY()+6, 58),5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-28,utf8_decode($con[0]['nomempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-20,'RUC: '.utf8_decode($con[0]['rifempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-12,'DIREC: '.utf8_decode($con[0]['direcempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-4,'N� DE TEL�FONO: '.utf8_decode($con[0]['tlfempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,4,'EMAIL: '.utf8_decode($con[0]['correoempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    $this->Ln(8);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(350,10,'LISTADO GENERAL DE CLIENTES',0,0,'C');
    
    $this->Ln();
	$this->SetFont('courier','B',10);
	$this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(230, 126, 34); // establece el color del fondo de la celda (en este caso es NARANJA)
	$this->Cell(10,8,'N�',1,0,'C', True);
	$this->Cell(35,8,'Nit',1,0,'C', True);
	$this->Cell(70,8,'NOMBRES Y APELLIDOS',1,0,'C', True);
	$this->Cell(110,8,'DIRECCI�N DOMICILIARIA',1,0,'C', True);
	$this->Cell(35,8,'N� DE TEL�FONO',1,0,'C', True);
	$this->Cell(75,8,'CORREO',1,1,'C', True);
	
    $tra = new Login();
    $reg = $tra->ListarClientes();

    if($reg==""){

    echo "";      
    
    } else {
 
	$a=1;
    for($i=0;$i<sizeof($reg);$i++){
	$this->SetFont('courier','',9);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(10,6,$a++,1,0,'C');
	$this->CellFitSpace(35,6,utf8_decode($reg[$i]["cedcliente"]),1,0,'C');
    $this->CellFitSpace(70,6,utf8_decode($reg[$i]["nomcliente"]),1,0,'C');
    $this->CellFitSpace(110,6,utf8_decode($reg[$i]["direccliente"]),1,0,'C');
	$this->Cell(35,6,utf8_decode($reg[$i]["tlfcliente"]),1,0,'C');
	$this->Cell(75,6,utf8_decode($correo = ( $reg[$i]['emailcliente'] == '' ? "NINGUNO" : $reg[$i]['emailcliente'])),1,0,'C');
    $this->Ln();
	   }
   }
    $this->Ln(12); 
    $this->SetFont('courier','B',9);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO POR: '.utf8_decode($_SESSION["nivel"]."/".$_SESSION["nombres"]),0,0,'');
    $this->Cell(120,6,'RECIBIDO:__________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA ELABORACI�N:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(120,6,'',0,0,'');
    $this->Ln(4);
     }
############################ FIN DE FUNCION LISTAR CLIENTES #############################

############################ FUNCION LISTAR PROVEEDORES #############################
	  function TablaListarProveedores()
   {
    //Logo
    $logo = "./assets/images/logo_dark.png";
    $logo2 = "./assets/images/logo_white_2.png";
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,22,$this->Image($logo, $this->GetX()+88, $this->GetY()+4, 24),5,0,'L');
    $this->Cell(250,8,'SISTEMA DE GESTI�N PARA RESTAURANTES',5,0,'C');
    $this->Cell(45,22,$this->Image($logo2, $this->GetX()-72, $this->GetY()+6, 58),5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-28,utf8_decode($con[0]['nomempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-20,'RUC: '.utf8_decode($con[0]['rifempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-12,'DIREC: '.utf8_decode($con[0]['direcempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-4,'N� DE TEL�FONO: '.utf8_decode($con[0]['tlfempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,4,'EMAIL: '.utf8_decode($con[0]['correoempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    $this->Ln(8);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(350,10,'LISTADO GENERAL DE PROVEEDORES',0,0,'C');
    
    $this->Ln();
	$this->SetFont('courier','B',10);
	$this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(230, 126, 34); // establece el color del fondo de la celda (en este caso es NARANJA)
	$this->Cell(10,8,'N�',1,0,'C', True);
	$this->Cell(28,8,'Nit',1,0,'C', True);
	$this->Cell(70,8,'PROVEEDOR',1,0,'C', True);
	$this->Cell(65,8,'DIRECCI�N DOMICILIARIA',1,0,'C', True);
	$this->Cell(32,8,'N� TEL�FONO',1,0,'C', True);
	$this->Cell(75,8,'CORREO',1,0,'C', True);
	$this->Cell(55,8,'CONTACTO',1,1,'C', True);
	
    $tra = new Login();
    $reg = $tra->ListarProveedores();

    if($reg==""){

    echo "";      
    
    } else {
 
	$a=1;
    for($i=0;$i<sizeof($reg);$i++){
	$this->SetFont('courier','',9);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(10,6,$a++,1,0,'C');
	$this->CellFitSpace(28,6,utf8_decode($reg[$i]["ritproveedor"]),1,0,'C');
    $this->CellFitSpace(70,6,utf8_decode($reg[$i]["nomproveedor"]),1,0,'C');
    $this->CellFitSpace(65,6,utf8_decode($reg[$i]["direcproveedor"]),1,0,'C');
	$this->Cell(32,6,utf8_decode($reg[$i]["tlfproveedor"]),1,0,'C');
	$this->Cell(75,6,utf8_decode($reg[$i]["emailproveedor"]),1,0,'C');
	$this->Cell(55,6,utf8_decode($reg[$i]["contactoproveedor"]),1,0,'C');
    $this->Ln();
	   }
   }
    $this->Ln(12); 
    $this->SetFont('courier','B',9);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO POR: '.utf8_decode($_SESSION["nivel"]."/".$_SESSION["nombres"]),0,0,'');
    $this->Cell(120,6,'RECIBIDO:__________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA ELABORACI�N:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(120,6,'',0,0,'');
    $this->Ln(4);
     }
############################ FIN DE FUNCION LISTAR PROVEEDORES #############################


############################### FUNCION LISTAR INGREDIENTES #################################
	  function TablaListarIngredientes()
   {
     //Logo
    $logo = "./assets/images/logo_dark.png";
    $logo2 = "./assets/images/logo_white_2.png";
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,22,$this->Image($logo, $this->GetX()+24, $this->GetY()+4, 22),5,0,'L');
    $this->Cell(105,8,'SISTEMA DE GESTI�N PARA RESTAURANTES',5,0,'C');
    $this->Cell(45,22,$this->Image($logo2, $this->GetX()-2, $this->GetY()+6, 34),5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-28,utf8_decode($con[0]['nomempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-20,'RUC: '.utf8_decode($con[0]['rifempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-12,'DIREC: '.utf8_decode($con[0]['direcempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-4,'N� DE TEL�FONO: '.utf8_decode($con[0]['tlfempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,4,'EMAIL: '.utf8_decode($con[0]['correoempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    $this->Ln(8);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(195,10,'LISTADO GENERAL DE INGREDIENTES',0,0,'C');
    
    $this->Ln();
	$this->SetFont('courier','B',10);
	$this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(230, 126, 34); // establece el color del fondo de la celda (en este caso es NARANJA)
	$this->Cell(10,8,'N�',1,0,'C', True);
	$this->Cell(25,8,'C�DIGO',1,0,'C', True);
	$this->Cell(75,8,'DESCRIPCI�N DE INGREDIENTE',1,0,'C', True);
	$this->Cell(25,8,'EXISTENCIA',1,0,'C', True);
	$this->Cell(30,8,'COSTO',1,0,'C', True);
	$this->Cell(25,8,'STOCK MIN',1,1,'C', True);
	
    $tra = new Login();
    $reg = $tra->ListarIngredientes();

    if($reg==""){

    echo "";      
    
    } else {
 
	$a=1;
    for($i=0;$i<sizeof($reg);$i++){
	$this->SetFont('courier','',9);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(10,6,$a++,1,0,'C');
	$this->CellFitSpace(25,6,utf8_decode($reg[$i]["codingrediente"]),1,0,'C');
    $this->CellFitSpace(75,6,utf8_decode($reg[$i]["nomingrediente"]),1,0,'C');
    $this->CellFitSpace(25,6,utf8_decode($reg[$i]["cantingrediente"]." ".$reg[$i]["unidadingrediente"]),1,0,'C');
	$this->Cell(30,6,utf8_decode($con[0]['simbolo'].$reg[$i]["costoingrediente"]),1,0,'C');
	$this->Cell(25,6,utf8_decode($reg[$i]["stockminimoingrediente"]),1,0,'C');
    $this->Ln();
         }
      }
   
    $this->Ln(12); 
    $this->SetFont('courier','B',9);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(120,6,'ELABORADO POR: '.utf8_decode($_SESSION["nivel"]."/".$_SESSION["nombres"]),0,0,'');
    $this->Cell(40,6,'RECIBIDO:_________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(120,6,'FECHA/HORA ELABORACI�N:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(40,6,'',0,0,'');
    $this->Ln(4);
     }
############################### FIN DE FUNCION LISTAR INGREDIENTES #################################

####################### FUNCION LISTAR INGREDIENTES EN STOCK MINIMO #########################
      function ListarIngredientesStockMinimo()
   {
     //Logo
    $logo = "./assets/images/logo_dark.png";
    $logo2 = "./assets/images/logo_white_2.png";
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,22,$this->Image($logo, $this->GetX()+24, $this->GetY()+4, 22),5,0,'L');
    $this->Cell(105,8,'SISTEMA DE GESTI�N PARA RESTAURANTES',5,0,'C');
    $this->Cell(45,22,$this->Image($logo2, $this->GetX()-2, $this->GetY()+6, 34),5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-28,utf8_decode($con[0]['nomempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-20,'RUC: '.utf8_decode($con[0]['rifempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-12,'DIREC: '.utf8_decode($con[0]['direcempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-4,'N� DE TEL�FONO: '.utf8_decode($con[0]['tlfempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,4,'EMAIL: '.utf8_decode($con[0]['correoempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    $this->Ln(8);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(195,10,'LISTADO DE INGREDIENTES EN STOCK MINIMO',0,0,'C');
    
    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(230, 126, 34); // establece el color del fondo de la celda (en este caso es NARANJA)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(25,8,'C�DIGO',1,0,'C', True);
    $this->Cell(75,8,'NOMBRE',1,0,'C', True);
    $this->Cell(25,8,'EXISTENCIA',1,0,'C', True);
    $this->Cell(30,8,'COSTO',1,0,'C', True);
    $this->Cell(25,8,'STOCK MIN',1,1,'C', True);
    
    $tra = new Login();
    $reg = $tra->ListarIngredientesStockMinimo();

    if($reg==""){

    echo "";      
    
    } else {
 
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){
    $this->SetFont('courier','',9);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(10,6,$a++,1,0,'C');
    $this->CellFitSpace(25,6,utf8_decode($reg[$i]["codingrediente"]),1,0,'C');
    $this->CellFitSpace(75,6,utf8_decode($reg[$i]["nomingrediente"]),1,0,'C');
    $this->CellFitSpace(25,6,utf8_decode($reg[$i]["cantingrediente"]." ".$reg[$i]["unidadingrediente"]),1,0,'C');
    $this->Cell(30,6,utf8_decode($con[0]['simbolo'].$reg[$i]["costoingrediente"]),1,0,'C');
    $this->Cell(25,6,utf8_decode($reg[$i]["stockminimoingrediente"]),1,0,'C');
    $this->Ln();
     }
        }
   
    $this->Ln(12); 
    $this->SetFont('courier','B',9);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(120,6,'ELABORADO POR: '.utf8_decode($_SESSION["nivel"]."/".$_SESSION["nombres"]),0,0,'');
    $this->Cell(40,6,'RECIBIDO:_________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(120,6,'FECHA/HORA ELABORACI�N:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(40,6,'',0,0,'');
    $this->Ln(4);
     }
##################### FIN DE FUNCION LISTAR INGREDIENTES EN STOCK MINIMO ######################

############################# FUNCION LISTAR MOVIMIENTO DE INGREDIENTE ##########################
      function TablaKardexIngredientes()
   {

    //Logo
    $logo = "./assets/images/logo_dark.png";
    $logo2 = "./assets/images/logo_white_2.png";
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $tra = new Login();
    $reg = $tra->BuscarKardexIngrediente();

    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,22,$this->Image($logo, $this->GetX()+88, $this->GetY()+4, 24),5,0,'L');
    $this->Cell(250,8,'SISTEMA DE GESTI�N PARA RESTAURANTES',5,0,'C');
    $this->Cell(45,22,$this->Image($logo2, $this->GetX()-72, $this->GetY()+6, 58),5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-28,utf8_decode($con[0]['nomempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-20,'RUC: '.utf8_decode($con[0]['rifempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-12,'DIREC: '.utf8_decode($con[0]['direcempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-4,'N� DE TEL�FONO: '.utf8_decode($con[0]['tlfempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,4,'EMAIL: '.utf8_decode($con[0]['correoempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    $this->Ln(8);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(350,10,'MOVIMIENTO DEL INGREDIENTE '.utf8_decode($reg[0]['nomingrediente']),0,0,'C');
    
    $this->Ln();
    $this->SetFont('courier','B',9);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(230, 126, 34); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->CellFitSpace(10,8,'N�',1,0,'C', True);
    $this->CellFitSpace(35,8,'MOVIMIENTO',1,0,'C', True);
    $this->CellFitSpace(20,8,'ENTRADAS',1,0,'C', True);
    $this->CellFitSpace(20,8,'SALIDAS',1,0,'C', True);
    //$this->CellFitSpace(20,8,'DEVOLUCI�N',1,0,'C', True);
    $this->CellFitSpace(40,8,'PRECIO MOVIMIENTO',1,0,'C', True);
    $this->CellFitSpace(50,8,'COSTO MOVIMIENTO',1,0,'C', True);
    $this->CellFitSpace(30,8,'STOCK ACTUAL',1,0,'C', True);
    $this->CellFitSpace(95,8,'DOCUMENTO',1,0,'C', True);
    $this->CellFitSpace(30,8,'FECHA',1,1,'C', True);

  if($reg==""){
    echo "";      
    } else {

  $TotalEntradas=0;
  $TotalSalidas=0;
  $TotalDevolucion=0;
  $simbolo = $con[0]['simbolo'];
  $a=1;
  for($i=0;$i<sizeof($reg);$i++){ 
$TotalEntradas+=$reg[$i]['entradasing'];
$TotalSalidas+=$reg[$i]['salidasing'];
//$TotalDevolucion+=$reg[$i]['devolucion'];
    
    $this->SetFont('courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(10,6,$a++,1,0,'C');
    $this->CellFitSpace(35,6,$reg[$i]['movimientoing'],1,0,'C');
    $this->CellFitSpace(20,6,utf8_decode($reg[$i]['entradasing']),1,0,'C');
    $this->CellFitSpace(20,6,utf8_decode($reg[$i]['salidasing']),1,0,'C');
    //$this->CellFitSpace(20,5,utf8_decode($reg[$i]['devolucion']),1,0,'C');
    $this->CellFitSpace(40,6,utf8_decode($simbolo.number_format($reg[$i]['preciouniting'], 2, '.', ',')),1,0,'C');
    if($reg[$i]['movimientoing']=="ENTRADAS"){
$this->CellFitSpace(50,6,utf8_decode($simbolo.number_format($reg[$i]['preciouniting']*$reg[$i]['entradasing'], 2, '.', ',')),1,0,'C');

} else if($reg[$i]['movimientoing']=="SALIDAS"){
$this->CellFitSpace(50,6,utf8_decode($simbolo.number_format($reg[$i]['preciouniting']*$reg[$i]['salidasing'], 2, '.', ',')),1,0,'C');

}
    $this->CellFitSpace(30,6,utf8_decode($reg[$i]['stockactualing']),1,0,'C');
    $this->CellFitSpace(95,6,utf8_decode($reg[$i]['documentoing']),1,0,'C');
    $this->CellFitSpace(30,6,utf8_decode(date("d-m-Y",strtotime($reg[$i]['fechakardexing']))),1,0,'C');
    $this->Ln();
             }
   } 
   
    $this->Cell(325,6,'',0,0,'C');
    $this->Ln();
    
   $this->SetFont('courier','B',9);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(130,6,'DETALLES DEL INGREDIENTE',1,0,'C', True);
    $this->Ln();
    
    $this->Cell(45,6,'C�DIGO',1,0,'C', True);
    $this->SetFont('courier','B',8);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(85,6,utf8_decode($reg[0]['codingrediente']),1,0,'C');
    $this->Ln();
    
    $this->SetFont('courier','B',9);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(45,6,'DESCRIPCI�N',1,0,'C', True);
    $this->SetFont('courier','B',8);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(85,6,utf8_decode($reg[0]['nomingrediente']),1,0,'C');
    $this->Ln();
    
    $this->SetFont('courier','B',9);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(45,6,'CATEGORIA',1,0,'C', True);
    $this->SetFont('courier','B',8);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(85,6,utf8_decode($reg[0]['unidadingrediente']),1,0,'C');
    $this->Ln();
    
    $this->SetFont('courier','B',9);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(45,6,'ENTRADAS',1,0,'C', True);
    $this->SetFont('courier','B',8);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(85,6,utf8_decode($TotalEntradas),1,0,'C');
    $this->Ln();
    
    $this->SetFont('courier','B',9);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(45,6,'SALIDAS',1,0,'C', True);
    $this->SetFont('courier','B',8);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(85,6,utf8_decode($TotalSalidas),1,0,'C');
    $this->Ln();
    
    $this->SetFont('courier','B',9);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(45,6,'EXISTENCIA',1,0,'C', True);
    $this->SetFont('courier','B',8);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(85,6,utf8_decode($reg[0]['cantingrediente']),1,0,'C');
    $this->Ln();
    
    $this->SetFont('courier','B',9);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(45,6,'PRECIO DE COMPRA',1,0,'C', True);
    $this->SetFont('courier','B',8);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(85,6,utf8_decode($simbolo.$reg[0]['costoingrediente']),1,0,'C');
    $this->Ln();
   
    $this->Ln(12); 
    $this->SetFont('courier','B',9);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO POR: '.utf8_decode($_SESSION["nivel"]."/".$_SESSION["nombres"]),0,0,'');
    $this->Cell(120,6,'RECIBIDO:__________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA ELABORACI�N:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(120,6,'',0,0,'');
    $this->Ln(4);
     }
############################# FUNCION LISTAR MOVIMIENTO DE INGREDIENTE ##########################

############################## FUNCION LISTAR INGREDIENTES VENDIDOS #############################
      function TablaListarIngredientesVendidos()
   {
    //Logo
    $logo = "./assets/images/logo_dark.png";
    $logo2 = "./assets/images/logo_white_2.png";
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,22,$this->Image($logo, $this->GetX()+24, $this->GetY()+4, 22),5,0,'L');
    $this->Cell(105,8,'SISTEMA DE GESTI�N PARA RESTAURANTES',5,0,'C');
    $this->Cell(45,22,$this->Image($logo2, $this->GetX()-2, $this->GetY()+6, 34),5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-28,utf8_decode($con[0]['nomempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-20,'RUC: '.utf8_decode($con[0]['rifempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-12,'DIREC: '.utf8_decode($con[0]['direcempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-4,'N� DE TEL�FONO: '.utf8_decode($con[0]['tlfempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,4,'EMAIL: '.utf8_decode($con[0]['correoempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    $this->Ln(8);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(195,10,'INGREDIENTES VENDIDOS DESDE '.$_GET["desde"].' HASTA '.$_GET["hasta"],0,0,'C');
    
    $this->Ln();
    $this->SetFont('courier','B',9);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(230, 126, 34); // establece el color del fondo de la celda (en este caso es NARANJA)
    $this->CellFitSpace(10,8,'N�',1,0,'C', True);
    $this->CellFitSpace(40,8,'C�DIGO',1,0,'C', True);
    $this->CellFitSpace(40,8,'INGREDIENTES',1,0,'C', True);
    $this->CellFitSpace(30,8,'PRECIO',1,0,'C', True);
    $this->CellFitSpace(20,8,'VENDIDO',1,0,'C', True);
    $this->CellFitSpace(25,8,'COSTO TOTAL',1,0,'C', True);
    $this->CellFitSpace(25,8,'EXISTENCIA',1,1,'C', True);
    
    $tra = new Login();
    $reg = $tra->BuscarIngredientesVendidos();

    if($reg==""){

    echo "";      
    
    } else {
 
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){
    $this->SetFont('courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(10,6,$a++,1,0,'C');
    $this->CellFitSpace(40,6,$reg[$i]["codingrediente"],1,0,'C');
    $this->CellFitSpace(40,6,utf8_decode($reg[$i]["nomingrediente"]),1,0,'C');
    $this->CellFitSpace(30,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]["costoingrediente"], 2, '.', ',')),1,0,'C');
    $this->CellFitSpace(20,6,utf8_decode($reg[$i]["cantidades"]),1,0,'C');
    $this->CellFitSpace(25,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]["costoingrediente"]*$reg[$i]["cantidades"], 2, '.', ',')),1,0,'C');
    $this->CellFitSpace(25,6,utf8_decode($reg[$i]["cantingrediente"]),1,0,'C');
    $this->Ln();
     }
        }

    $this->Ln(12); 
    $this->SetFont('courier','B',9);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(120,6,'ELABORADO POR: '.utf8_decode($_SESSION["nivel"]."/".$_SESSION["nombres"]),0,0,'');
    $this->Cell(40,6,'RECIBIDO:_________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(120,6,'FECHA/HORA ELABORACI�N:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(40,6,'',0,0,'');
    $this->Ln(4);
     }
######################### FIN DE FUNCION LISTAR INGREDIENTES VENDIDOS #####################



############################ FUNCION LISTAR PRODUTOS EN ALMACEN ##############################
	  function TablaListarProductos()
   {
    //Logo
    $logo = "./assets/images/logo_dark.png";
    $logo2 = "./assets/images/logo_white_2.png";
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,22,$this->Image($logo, $this->GetX()+88, $this->GetY()+4, 24),5,0,'L');
    $this->Cell(250,8,'SISTEMA DE GESTI�N PARA RESTAURANTES',5,0,'C');
    $this->Cell(45,22,$this->Image($logo2, $this->GetX()-72, $this->GetY()+6, 58),5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-28,utf8_decode($con[0]['nomempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-20,'RUC: '.utf8_decode($con[0]['rifempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-12,'DIREC: '.utf8_decode($con[0]['direcempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-4,'N� DE TEL�FONO: '.utf8_decode($con[0]['tlfempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,4,'EMAIL: '.utf8_decode($con[0]['correoempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    $this->Ln(8);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(350,10,'LISTADO GENERAL DE PRODUCTOS',0,0,'C');
    
    $this->Ln();
	$this->SetFont('courier','B',9);
	$this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(230, 126, 34); // establece el color del fondo de la celda (en este caso es NARANJA)
	$this->CellFitSpace(10,8,'N�',1,0,'C', True);
	$this->CellFitSpace(25,8,'C�DIGO',1,0,'C', True);
	$this->CellFitSpace(90,8,'DESCRIPCION DE PRODUCTO',1,0,'C', True);
	$this->CellFitSpace(40,8,'CATEGORIA',1,0,'C', True);
	$this->CellFitSpace(28,8,'PRECIO',1,0,'C', True);
	$this->CellFitSpace(25,8,'EXISTENCIA',1,0,'C', True);
	$this->CellFitSpace(35,8,'COSTO TOTAL',1,0,'C', True);
	$this->CellFitSpace(20,8,'STOCK MIN',1,0,'C', True);
    $this->CellFitSpace(12,8,'IGV',1,0,'C', True);
	$this->CellFitSpace(20,8,'DESC%',1,0,'C', True);
	$this->CellFitSpace(25,8,'STATUS',1,1,'C', True);
	
    $tra = new Login();
    $reg = $tra->ListarProductos();
	$a=1;
    $TotalExistencia=0;
    $TotalInventario=0;

    if($reg==""){

    echo "";      
    
    } else {
 
    for($i=0;$i<sizeof($reg);$i++){
    $TotalExistencia+=$reg[$i]['existencia'];
    $TotalInventario+=$reg[$i]["precioventa"]*$reg[$i]["existencia"];


	$this->SetFont('courier','',9);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(10,6,$a++,1,0,'C');
	$this->CellFitSpace(25,6,$reg[$i]["codproducto"],1,0,'C');
    $this->CellFitSpace(90,6,utf8_decode($reg[$i]["producto"]),1,0,'C');
	$this->CellFitSpace(40,6,utf8_decode($reg[$i]["nomcategoria"]),1,0,'C');
	$this->CellFitSpace(28,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]["precioventa"], 2, '.', ',')),1,0,'C');
    $this->CellFitSpace(25,6,utf8_decode($reg[$i]["existencia"]),1,0,'C');
    $this->CellFitSpace(35,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]["precioventa"]*$reg[$i]["existencia"], 2, '.', ',')),1,0,'C');
	$this->CellFitSpace(20,6,utf8_decode($reg[$i]["stockminimo"]),1,0,'C');
    $this->Cell(12,6,utf8_decode($reg[$i]["ivaproducto"]),1,0,'C');
	$this->Cell(20,6,utf8_decode($reg[$i]["descproducto"]),1,0,'C');
    $this->CellFitSpace(25,6,utf8_decode($reg[$i]["statusproducto"]),1,0,'C');
    $this->Ln();
     }
	
   }

    $this->Cell(325,6,'',0,0,'C');
    $this->Ln();
    
    $this->SetFont('courier','B',9);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(120,6,'DETALLES DEL INVENTARIO',1,0,'C', True);
    $this->Ln();
    
    $this->Cell(35,6,'TOTAL ARTICULOS',1,0,'C', True);
    $this->SetFont('courier','B',8);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(85,6,utf8_decode($TotalExistencia),1,0,'C');
    $this->Ln();

    $this->SetFont('courier','B',9);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(35,6,'COSTO INVENTARIO',1,0,'C', True);
    $this->SetFont('courier','B',8);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(85,6,$con[0]['simbolo'].number_format($TotalInventario, 2, '.', ','),1,0,'C');
    $this->Ln();

    $this->Ln(12); 
    $this->SetFont('courier','B',9);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO POR: '.utf8_decode($_SESSION["nivel"]."/".$_SESSION["nombres"]),0,0,'');
    $this->Cell(120,6,'RECIBIDO:__________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA ELABORACI�N:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(120,6,'',0,0,'');
    $this->Ln(4);
     }
######################### FIN DE FUNCION LISTAR PRODUCTOS EN ALMACEN ##########################

########################## FUNCION LISTAR PRODUTOS EN STOCK MINIMO ############################
      function ListarProductosStockMinimo()
   {
    //Logo
    $logo = "./assets/images/logo_dark.png";
    $logo2 = "./assets/images/logo_white_2.png";
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,22,$this->Image($logo, $this->GetX()+88, $this->GetY()+4, 24),5,0,'L');
    $this->Cell(250,8,'SISTEMA DE GESTI�N PARA RESTAURANTES',5,0,'C');
    $this->Cell(45,22,$this->Image($logo2, $this->GetX()-72, $this->GetY()+6, 58),5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-28,utf8_decode($con[0]['nomempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-20,'RUC: '.utf8_decode($con[0]['rifempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-12,'DIREC: '.utf8_decode($con[0]['direcempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-4,'N� DE TEL�FONO: '.utf8_decode($con[0]['tlfempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,4,'EMAIL: '.utf8_decode($con[0]['correoempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    $this->Ln(8);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(350,10,'LISTADO DE PRODUCTOS EN STOCK MINIMO',0,0,'C');
    
    $this->Ln();
    $this->SetFont('courier','B',9);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(230, 126, 34); // establece el color del fondo de la celda (en este caso es NARANJA)
    $this->CellFitSpace(10,8,'N�',1,0,'C', True);
    $this->CellFitSpace(20,8,'C�DIGO',1,0,'C', True);
    $this->CellFitSpace(80,8,'DESCRIPCI�N DE PRODUCTO',1,0,'C', True);
    $this->CellFitSpace(30,8,'CATEGORIA',1,0,'C', True);
    $this->CellFitSpace(28,8,'PRECIO',1,0,'C', True);
    $this->CellFitSpace(25,8,'EXISTENCIA',1,0,'C', True);
    $this->CellFitSpace(35,8,'STOCK MINIMO',1,0,'C', True);
    $this->CellFitSpace(15,8,'IGV',1,0,'C', True);
    $this->CellFitSpace(20,8,'DESC%',1,0,'C', True);
    $this->CellFitSpace(20,8,'FAVORITO',1,0,'C', True);
    $this->CellFitSpace(25,8,'C�D BARRA',1,0,'C', True);
    $this->CellFitSpace(22,8,'STATUS',1,1,'C', True);
    
    $tra = new Login();
    $reg = $tra->ListarProductosStockMinimo();

    if($reg==""){

    echo "";      
    
    } else {
 
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){
    $this->SetFont('courier','',9);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(10,6,$a++,1,0,'C');
    $this->CellFitSpace(20,6,$reg[$i]["codproducto"],1,0,'C');
    $this->CellFitSpace(80,6,utf8_decode($reg[$i]["producto"]),1,0,'C');
    $this->CellFitSpace(30,6,utf8_decode($reg[$i]["nomcategoria"]),1,0,'C');
    $this->CellFitSpace(28,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]["precioventa"], 2, '.', ',')),1,0,'C');
    $this->CellFitSpace(25,6,utf8_decode($reg[$i]["existencia"]),1,0,'C');
    $this->CellFitSpace(35,6,utf8_decode($reg[$i]["stockminimo"]),1,0,'C');
    $this->Cell(15,6,utf8_decode($reg[$i]["ivaproducto"]),1,0,'C');
    $this->Cell(20,6,utf8_decode($reg[$i]["descproducto"]),1,0,'C');
    $this->Cell(20,6,utf8_decode($reg[$i]["favorito"]),1,0,'C');
    $this->Cell(25,6,utf8_decode($reg[$i]["codigobarra"]),1,0,'C');
    $this->CellFitSpace(22,6,utf8_decode($reg[$i]["statusproducto"]),1,0,'C');
    $this->Ln();
     }
    
   }
    $this->Ln(12); 
    $this->SetFont('courier','B',9);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO POR: '.utf8_decode($_SESSION["nivel"]."/".$_SESSION["nombres"]),0,0,'');
    $this->Cell(120,6,'RECIBIDO:__________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA ELABORACI�N:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(120,6,'',0,0,'');
    $this->Ln(4);
     }
######################## FIN DE FUNCION LISTAR PRODUCTOS EN STOCK MINIMO ######################

############################# FUNCION LISTAR MOVIMIENTO DE PRODUCTO ##########################
      function TablaKardexProductos()
   {
    //Logo
    $logo = "./assets/images/logo_dark.png";
    $logo2 = "./assets/images/logo_white_2.png";
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $tra = new Login();
    $reg = $tra->BuscarKardexProducto();

    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,22,$this->Image($logo, $this->GetX()+88, $this->GetY()+4, 24),5,0,'L');
    $this->Cell(250,8,'SISTEMA DE GESTI�N PARA RESTAURANTES',5,0,'C');
    $this->Cell(45,22,$this->Image($logo2, $this->GetX()-72, $this->GetY()+6, 58),5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-28,utf8_decode($con[0]['nomempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-20,'RUC: '.utf8_decode($con[0]['rifempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-12,'DIREC: '.utf8_decode($con[0]['direcempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-4,'N� DE TEL�FONO: '.utf8_decode($con[0]['tlfempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,4,'EMAIL: '.utf8_decode($con[0]['correoempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    $this->Ln(8);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(350,10,'MOVIMIENTOS DEL PRODUCTO '.utf8_decode($reg[0]['producto']),0,0,'C');
    
    $this->Ln();
    $this->SetFont('courier','B',9);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(230, 126, 34); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->CellFitSpace(10,8,'N�',1,0,'C', True);
    $this->CellFitSpace(35,8,'MOVIMIENTO',1,0,'C', True);
    $this->CellFitSpace(20,8,'ENTRADAS',1,0,'C', True);
    $this->CellFitSpace(20,8,'SALIDAS',1,0,'C', True);
    $this->CellFitSpace(20,8,'DEVOLUCI�N',1,0,'C', True);
    $this->CellFitSpace(40,8,'PRECIO MOVIMIENTO',1,0,'C', True);
    $this->CellFitSpace(40,8,'COSTO MOVIMIENTO',1,0,'C', True);
    $this->CellFitSpace(30,8,'STOCK ACTUAL',1,0,'C', True);
    $this->CellFitSpace(85,8,'DOCUMENTO',1,0,'C', True);
    $this->CellFitSpace(30,8,'FECHA',1,1,'C', True);

  if($reg==""){
    echo "";      
    } else {

  $TotalEntradas=0;
  $TotalSalidas=0;
  $TotalDevolucion=0;
  $simbolo = $con[0]['simbolo'];
  $a=1;
  for($i=0;$i<sizeof($reg);$i++){ 
$TotalEntradas+=$reg[$i]['entradas'];
$TotalSalidas+=$reg[$i]['salidas'];
$TotalDevolucion+=$reg[$i]['devolucion'];
    
    $this->SetFont('courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(10,6,$a++,1,0,'C');
    $this->CellFitSpace(35,6,$reg[$i]['movimiento'],1,0,'C');
    $this->CellFitSpace(20,6,utf8_decode($reg[$i]['entradas']),1,0,'C');
    $this->CellFitSpace(20,6,utf8_decode($reg[$i]['salidas']),1,0,'C');
    $this->CellFitSpace(20,6,utf8_decode($reg[$i]['devolucion']),1,0,'C');
    $this->CellFitSpace(40,6,utf8_decode($simbolo.number_format($reg[$i]['preciom'], 2, '.', ',')),1,0,'C');
    if($reg[$i]['movimiento']=="ENTRADAS"){
$this->CellFitSpace(40,6,utf8_decode($simbolo.number_format($reg[$i]['preciom']*$reg[$i]['entradas'], 2, '.', ',')),1,0,'C');

} else if($reg[$i]['movimiento']=="SALIDAS"){
$this->CellFitSpace(40,6,utf8_decode($simbolo.number_format($reg[$i]['preciom']*$reg[$i]['salidas'], 2, '.', ',')),1,0,'C');

} else if($reg[$i]['movimiento']=="DEVOLUCION"){
$this->CellFitSpace(40,6,utf8_decode($simbolo.number_format($reg[$i]['preciom']*$reg[$i]['devolucion'], 2, '.', ',')),1,0,'C');
}
    $this->CellFitSpace(30,6,utf8_decode($reg[$i]['stockactual']),1,0,'C');
    $this->CellFitSpace(85,6,utf8_decode($reg[$i]['documento']),1,0,'C');
    $this->CellFitSpace(30,6,utf8_decode(date("d-m-Y",strtotime($reg[$i]['fechakardex']))),1,0,'C');
    $this->Ln();
             }
   } 
   
    $this->Cell(325,6,'',0,0,'C');
    $this->Ln();
    
   $this->SetFont('courier','B',9);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(130,6,'DETALLES DEL PRODUCTO',1,0,'C', True);
    $this->Ln();
    
    $this->Cell(45,6,'C�DIGO',1,0,'C', True);
    $this->SetFont('courier','B',8);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(85,6,utf8_decode($reg[0]['codproducto']),1,0,'C');
    $this->Ln();
    
    $this->SetFont('courier','B',9);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(45,6,'DESCRIPCI�N',1,0,'C', True);
    $this->SetFont('courier','B',8);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(85,6,utf8_decode($reg[0]['producto']),1,0,'C');
    $this->Ln();
    
    $this->SetFont('courier','B',9);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(45,6,'CATEGORIA',1,0,'C', True);
    $this->SetFont('courier','B',8);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(85,6,utf8_decode($reg[0]['nomcategoria']),1,0,'C');
    $this->Ln();
    
    $this->SetFont('courier','B',9);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(45,6,'ENTRADAS',1,0,'C', True);
    $this->SetFont('courier','B',8);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(85,6,utf8_decode($TotalEntradas),1,0,'C');
    $this->Ln();
    
    $this->SetFont('courier','B',9);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(45,6,'SALIDAS',1,0,'C', True);
    $this->SetFont('courier','B',8);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(85,6,utf8_decode($TotalSalidas),1,0,'C');
    $this->Ln();

    $this->SetFont('courier','B',9);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(45,6,'DEVOLUCI�N',1,0,'C', True);
    $this->SetFont('courier','B',8);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(85,6,utf8_decode($TotalDevolucion),1,0,'C');
    $this->Ln();
    
    $this->SetFont('courier','B',9);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(45,6,'EXISTENCIA',1,0,'C', True);
    $this->SetFont('courier','B',8);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(85,6,utf8_decode($reg[0]['existencia']),1,0,'C');
    $this->Ln();
    
    $this->SetFont('courier','B',9);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(45,6,'PRECIO DE COMPRA',1,0,'C', True);
    $this->SetFont('courier','B',8);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(85,6,utf8_decode($simbolo.$reg[0]['preciocompra']),1,0,'C');
    $this->Ln();
    
    $this->SetFont('courier','B',9);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(45,6,'PRECIO DE VENTA',1,0,'C', True);
    $this->SetFont('courier','B',8);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(85,6,utf8_decode($simbolo.$reg[0]['precioventa']),1,0,'C');
   
    $this->Ln(12); 
    $this->SetFont('courier','B',9);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO POR: '.utf8_decode($_SESSION["nivel"]."/".$_SESSION["nombres"]),0,0,'');
    $this->Cell(120,6,'RECIBIDO:__________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA ELABORACI�N:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(120,6,'',0,0,'');
    $this->Ln(4);
     }
############################# FUNCION LISTAR MOVIMIENTO DE PRODUCTO ##########################

########################### FUNCION LISTAR PRODUTOS VENDIDOS ###############################
      function TablaListarProductosVendidos()
   {
    //Logo
    $logo = "./assets/images/logo_dark.png";
    $logo2 = "./assets/images/logo_white_2.png";
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,22,$this->Image($logo, $this->GetX()+24, $this->GetY()+4, 22),5,0,'L');
    $this->Cell(105,8,'SISTEMA DE GESTI�N PARA RESTAURANTES',5,0,'C');
    $this->Cell(45,22,$this->Image($logo2, $this->GetX()-2, $this->GetY()+6, 34),5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-28,utf8_decode($con[0]['nomempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-20,'RUC: '.utf8_decode($con[0]['rifempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-12,'DIREC: '.utf8_decode($con[0]['direcempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-4,'N� DE TEL�FONO: '.utf8_decode($con[0]['tlfempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,4,'EMAIL: '.utf8_decode($con[0]['correoempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    $this->Ln(8);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(195,10,'PRODUCTOS VENDIDOS DESDE '.$_GET["desde"].' HASTA '.$_GET["hasta"],0,0,'C');
    
    $this->Ln();
    $this->SetFont('courier','B',9);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(230, 126, 34); // establece el color del fondo de la celda (en este caso es NARANJA)
    $this->CellFitSpace(10,8,'N�',1,0,'C', True);
    $this->CellFitSpace(18,8,'C�DIGO',1,0,'C', True);
    $this->CellFitSpace(60,8,'DESCRIPCI�N',1,0,'C', True);
    $this->CellFitSpace(28,8,'CATEGORIA',1,0,'C', True);
    $this->CellFitSpace(20,8,'PRECIO',1,0,'C', True);
    $this->CellFitSpace(18,8,'VENDIDO',1,0,'C', True);
    $this->CellFitSpace(25,8,'COSTO TOTAL',1,0,'C', True);
    $this->CellFitSpace(15,8,'EXISTE',1,1,'C', True);
    
    $tra = new Login();
    $reg = $tra->ListarProductosVendidos();

    if($reg==""){

    echo "";      
    
    } else {
 
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){
    $this->SetFont('courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(10,6,$a++,1,0,'C');
    $this->CellFitSpace(18,6,$reg[$i]["codproducto"],1,0,'C');
    $this->CellFitSpace(60,6,utf8_decode($reg[$i]["producto"]),1,0,'C');
    $this->CellFitSpace(28,6,utf8_decode($reg[$i]["nomcategoria"]),1,0,'C');
    $this->CellFitSpace(20,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]["precioventa"], 2, '.', ',')),1,0,'C');
    $this->CellFitSpace(18,6,utf8_decode($nro = ( $reg[$i]["cantidad"] == '' ? "0" : $reg[$i]["cantidad"])),1,0,'C');
    $this->CellFitSpace(25,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]["precioventa"]*$reg[$i]["cantidad"], 2, '.', ',')),1,0,'C');
    $this->CellFitSpace(15,6,utf8_decode($reg[$i]["existencia"]),1,0,'C');
    $this->Ln();
     }
    
   }
    $this->Ln(12); 
    $this->SetFont('courier','B',9);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(100,6,'ELABORADO POR: '.utf8_decode($_SESSION["nivel"]."/".$_SESSION["nombres"]),0,0,'');
    $this->Cell(60,6,'RECIBIDO:__________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(100,6,'FECHA/HORA ELABORACI�N:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(60,6,'',0,0,'');
    $this->Ln(4);
     }
######################### FIN DE FUNCION LISTAR PRODUCTOS VENDIDOS ##########################

############################# REPORTES DE MANTENIMIENTO ############################






































############################## CLASE COMPRAS DE PRODUCTOS ###########################

###################### FUNCION LISTAR FACTURA DE COMPRAS DE PRODUCTOS #######################
	  function TablaComprasProductos()
   {
    //Logo #1
    $this->Image("./assets/images/logo_white_2.png" , 15 ,10, 55 , 18 , "PNG");  
    //Logo #2
    $this->Image("./assets/images/logo_dark.png" , 95 ,12, 25 , 16 , "PNG");
    //Arial bold 15
    $this->SetFont('Courier','B',15);
    //Movernos a la derecha
	
	$con = new Login();
    $con = $con->ConfiguracionPorId();
	
	$co = new Login();
    $co = $co->ComprasPorId();
	
####################### BLOQUE N� 1 #########################

   //Bloque de membrete principal
    $this->SetFillColor(192);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.3);
    $this->RoundedRect(10, 10, 190, 20, '1.5', '');
	
	//Linea de membrete Nro 1
	$this->SetFont('courier','B',9);
    $this->SetXY(130, 11);
    $this->Cell(20, 5, 'N� DE COMPRA: ', 0 , 0);
	$this->SetFont('courier','B',9);
    $this->SetXY(160, 11);
    $this->Cell(20, 5,utf8_decode($co[0]['codcompra']), 0 , 0);
	
	//Linea de membrete Nro 2
	$this->SetFont('courier','B',9);
    $this->SetXY(130, 14);
    $this->Cell(20, 5, 'N� DE SERIE: ', 0 , 0);
	$this->SetFont('courier','B',9);
    $this->SetXY(160, 14);
    $this->Cell(20, 5,utf8_decode($co[0]['codseriec']), 0 , 0);
	
	//Linea de membrete Nro 3
	$this->SetFont('courier','B',8);
    $this->SetXY(130, 17);
    $this->Cell(20, 5, 'FECHA DE COMPRA: ', 0 , 0);
	$this->SetFont('courier','B',8);
    $this->SetXY(160, 17);
    $this->Cell(20, 5,utf8_decode(date("d-m-Y h:i:s",strtotime($co[0]['fechacompra']))), 0 , 0);
	
	//Linea de membrete Nro 4
	$this->SetFont('courier','B',8);
    $this->SetXY(130, 20);
    $this->Cell(20, 5, 'FECHA DE EMISI�N: ', 0 , 0);
	$this->SetFont('courier','',8);
    $this->SetXY(160, 20);
    $this->Cell(20, 5,utf8_decode(date("d-m-Y h:i:s")), 0 , 0);

	
	$dias = ( $co[0]['fechavencecredito'] == '0000-00-00' ? "0" : Dias_Transcurridos($co[0]['fechavencecredito'],date("Y-m-d")));
	
	//Linea de membrete Nro 5
	$this->SetFont('courier','B',8);
    $this->SetXY(130, 23);
    $this->Cell(20, 5, 'STATUS DE COMPRA: ', 0 , 0);
	$this->SetFont('courier','',8);
    $this->SetXY(160, 23);
    
	if($co[0]['fechavencecredito']== '0000-00-00') { 
	$this->Cell(20, 5,utf8_decode($co[0]['statuscompra']), 0 , 0);
	} elseif($co[0]['fechavencecredito'] >= date("Y-m-d")) { 
	$this->Cell(20, 5,utf8_decode($co[0]['statuscompra']), 0 , 0);
	} elseif($co[0]['fechavencecredito'] < date("Y-m-d")) { 
	$this->Cell(20, 5,utf8_decode("VENCIDA"), 0 , 0);
	}

############################### BLOQUE N� 2 #############################	

	//Bloque de datos de empresa
    $this->SetFillColor(192);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.3);
    $this->RoundedRect(10, 32, 190, 18, '1.5', '');
	//Linea de membrete Nro 1
	$this->SetFont('courier','B',9);
    $this->SetXY(15, 32);
    $this->Cell(20, 5, 'DATOS DE LA EMPRESA ', 0 , 0);

	//Linea de membrete Nro 2
	$this->SetFont('courier','B',8);
    $this->SetXY(15, 36);
    $this->Cell(20, 5, 'RAZ�N SOCIAL :', 0 , 0);
	$this->SetFont('courier','',8);
    $this->SetXY(40, 36);
    $this->Cell(20, 5,utf8_decode($con[0]['nomempresa']), 0 , 0);

	//Linea de membrete Nro 3
	$this->SetFont('courier','B',8);
    $this->SetXY(100, 36);
    $this->Cell(90, 5, 'Nit :', 0 , 0);
	$this->SetFont('courier','',8);
    $this->SetXY(116, 36);
    $this->Cell(90, 5,utf8_decode($con[0]['rifempresa']), 0 , 0);

    //Linea de membrete Nro 4
    $this->SetFont('courier','B',8);
    $this->SetXY(146, 36);
    $this->Cell(20, 5, 'N� DE TEL�F :', 0 , 0);
    $this->SetFont('courier','',8);
    $this->SetXY(170, 36);
    $this->Cell(20, 5,utf8_decode($con[0]['tlfempresa']), 0 , 0);

	//Linea de membrete Nro 5
	$this->SetFont('courier','B',8);
    $this->SetXY(15, 40);
    $this->Cell(20, 5, 'DIRECCI�N :', 0 , 0);
	$this->SetFont('courier','',8);
    $this->SetXY(36, 40);
    $this->Cell(20, 5,utf8_decode($con[0]['direcempresa']), 0 , 0);

    //Linea de membrete Nro 6
    $this->SetFont('courier','B',8);
    $this->SetXY(130, 40);
    $this->Cell(20, 5, 'CORREO :', 0 , 0);
    $this->SetFont('courier','',8);
    $this->SetXY(145, 40);
    $this->Cell(20, 5,utf8_decode($con[0]['correoempresa']), 0 , 0);

	//Linea de membrete Nro 7
	$this->SetFont('courier','B',8);
    $this->SetXY(15, 44);
    $this->Cell(20, 5, 'RESPONSABLE :', 0 , 0);
	$this->SetFont('courier','',8);
    $this->SetXY(38, 44);
    $this->Cell(20, 5,utf8_decode($con[0]['nomresponsable']), 0 , 0);

	//Linea de membrete Nro 8
	$this->SetFont('courier','B',8);
    $this->SetXY(90, 44);
    $this->Cell(20, 5, 'Nit :', 0 , 0);
	$this->SetFont('courier','',8);
    $this->SetXY(106, 44);
    $this->Cell(20, 5,utf8_decode($con[0]['cedresponsable']), 0 , 0);

	//Linea de membrete Nro 9
	$this->SetFont('courier','B',8);
    $this->SetXY(130, 44);
    $this->Cell(20, 5, 'CORREO :', 0 , 0);
	$this->SetFont('courier','',8);
    $this->SetXY(145, 44);
    $this->Cell(20, 5,utf8_decode($con[0]['correoresponsable']), 0 , 0);
	
######################### BLOQUE N� 3 ###########################	

	//Bloque de datos de empresa
    $this->SetFillColor(192);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.3);
    $this->RoundedRect(10, 52, 190, 14, '1.5', '');
	//Linea de membrete Nro 1
	$this->SetFont('courier','B',9);
    $this->SetXY(15, 52);
    $this->Cell(20, 5, 'DATOS DEL PROVEEDOR ', 0 , 0);
	//Linea de membrete Nro 2
	$this->SetFont('courier','B',8);
    $this->SetXY(15, 56);
    $this->Cell(20, 5, 'RAZ�N SOCIAL :', 0 , 0);
	$this->SetFont('courier','',8);
    $this->SetXY(40, 56);
    $this->Cell(20, 5,utf8_decode($co[0]['nomproveedor']), 0 , 0);
	//Linea de membrete Nro 3
	$this->SetFont('courier','B',8);
    $this->SetXY(90, 56);
    $this->Cell(70, 5, 'Nit :', 0 , 0);
	$this->SetFont('courier','',8);
    $this->SetXY(106, 56);
    $this->Cell(75, 5,utf8_decode($co[0]['ritproveedor']), 0 , 0);
	//Linea de membrete Nro 4
	$this->SetFont('courier','B',8);
    $this->SetXY(130, 56);
    $this->Cell(90, 5, 'CORREO :', 0 , 0);
	$this->SetFont('courier','',8);
    $this->SetXY(145, 56);
    $this->Cell(90, 5,utf8_decode($co[0]['emailproveedor']), 0 , 0);
	//Linea de membrete Nro 5
	$this->SetFont('courier','B',8);
    $this->SetXY(15, 60);
    $this->Cell(20, 5, 'DIRECCI�N :', 0 , 0);
	$this->SetFont('courier','',8);
    $this->SetXY(36, 60);
    $this->Cell(20, 5,utf8_decode($co[0]['direcproveedor']), 0 , 0);
	//Linea de membrete Nro 6
	$this->SetFont('courier','B',8);
    $this->SetXY(82, 60);
    $this->Cell(20, 5, 'N� DE TEL�F :', 0 , 0);
	$this->SetFont('courier','',8);
    $this->SetXY(105, 60);
    $this->Cell(20, 5,utf8_decode($co[0]['tlfproveedor']), 0 , 0);
	//Linea de membrete Nro 6
	$this->SetFont('courier','B',8);
    $this->SetXY(130, 60);
    $this->Cell(20, 5, 'CONTACTO :', 0 , 0);
	$this->SetFont('courier','',8);
    $this->SetXY(148, 60);
    $this->Cell(20, 5,utf8_decode($co[0]['contactoproveedor']), 0 , 0);
	
	$this->Ln(8);
	$this->SetFont('courier','B',9);
	$this->SetTextColor(3, 3, 3); // Establece el color del texto (en este caso es Negro)
    $this->SetFillColor(229, 229, 229); // establece el color del fondo de la celda (en este caso es GRIS)
	$this->Cell(6,8,'N�',1,0,'C', True);
	$this->Cell(20,8,'C�DIGO',1,0,'C', True);
	$this->Cell(60,8,'DESCRIPCI�N DE PRODUCTO',1,0,'C', True);
	$this->Cell(30,8,'CATEGORIAS',1,0,'C', True);
	$this->Cell(20,8,'PRECIO',1,0,'C', True);
	$this->Cell(20,8,'CANTIDAD',1,0,'C', True);
	$this->Cell(34,8,'IMPORTE',1,1,'C', True);
	
	########################### BLOQUE N� 4 DE DETALLES DE PRODUCTOS ##########################	
	//Bloque de datos de empresa
    $this->SetFillColor(192);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.3);
    $this->RoundedRect(10, 78, 190, 170, '1.5', '');
	
	$this->Ln(3);
    $tra = new Login();
    $reg = $tra->VerDetallesCompras();
	$cantidad=0;
	$a=1;
    for($i=0;$i<sizeof($reg);$i++){
	$cantidad+=$reg[$i]['cantcompra'];
	$this->SetFont('courier','',8);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(6,4,$a++,0,0,'C');
	$this->CellFitSpace(20,4,utf8_decode($reg[$i]["codproducto"]),0,0,'C');
    $this->CellFitSpace(60,4,utf8_decode(getSubString($reg[$i]["producto"], 35)),0,0,'C');
    if($reg[$i]['tipoentrada']=="PRODUCTO"){
	$this->Cell(30,4,utf8_decode($reg[$i]["nomcategoria"]),0,0,'C');
	} else { 
	$this->Cell(30,4,utf8_decode($reg[$i]["categoria"]),0,0,'C');
	}
	$this->CellFitSpace(20,4,utf8_decode($con[0]['simbolo'].number_format($reg[$i]["precio1"], 2, '.', ',')),0,0,'C');
	$this->CellFitSpace(20,4,utf8_decode($reg[$i]["cantcompra"]),0,0,'C');
	$this->CellFitSpace(34,4,utf8_decode($con[0]['simbolo'].number_format($reg[$i]["importecompra"], 2, '.', ',')),0,0,'C');
    $this->Ln();
                                 }
    
############################ BLOQUE N� 5 DE TOTALES ################################
	//Bloque de Informacion adicional
    $this->SetFillColor(192);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.3);
    $this->RoundedRect(10, 250, 110, 28, '1.5', '');
	//Linea de membrete Nro 1
	$this->SetFont('courier','B',10);
    $this->SetXY(44, 250);
    $this->Cell(20, 5, 'INFORMACI�N ADICIONAL', 0 , 0);
	
	//Linea de membrete Nro 2
	$this->SetFont('courier','B',8);
    $this->SetXY(12, 254);
    $this->Cell(20, 5, 'CANTIDAD DE PRODUCTOS :', 0 , 0);
    $this->SetXY(60, 254);
	$this->SetFont('courier','',9);
    $this->Cell(20, 5,utf8_decode($cantidad), 0 , 0);
	
	//Linea de membrete Nro 3
	$this->SetFont('courier','B',8);
    $this->SetXY(12, 257.2);
    $this->Cell(20, 5, 'TIPO DE DOCUMENTO :', 0 , 0);
    $this->SetXY(60, 257.2);
	$this->SetFont('courier','',9);
    $this->Cell(20, 5,utf8_decode("FACTURA"), 0 , 0);
	
	//Linea de membrete Nro 4
	$this->SetFont('courier','B',8);
    $this->SetXY(12, 260.5);
    $this->Cell(20, 5, 'TIPO DE PAGO :', 0 , 0);
    $this->SetXY(60, 260.5);
	$this->SetFont('courier','',9);
    $this->Cell(20, 5,utf8_decode($co[0]['tipocompra']." - ".$variable = ( $co[0]['tipocompra'] == 'CONTADO' ? $co[0]['mediopago'] : $co[0]['formapago'])), 0 , 0);
	
	//Linea de membrete Nro 5
	$this->SetFont('courier','B',8);
    $this->SetXY(12, 263.5);
    $this->Cell(20, 5, 'FECHA DE VENCIMIENTO :', 0 , 0);
    $this->SetXY(60, 263.5);
	$this->SetFont('courier','',9);
    $this->Cell(20, 5,utf8_decode($vence = ( $co[0]['fechavencecredito'] == '0000-00-00' ? "0" : date("d-m-Y",strtotime($co[0]['fechavencecredito'])))), 0 , 0);
	
	//Linea de membrete Nro 6
	$this->SetFont('courier','B',8);
    $this->SetXY(12, 266.5);
    $this->Cell(20, 5, 'DIAS VENCIDOS :', 0 , 0);
    $this->SetXY(60, 266.5);
	$this->SetFont('courier','',9);
	
    if($co[0]['fechavencecredito']== '0000-00-00') { 
	$this->Cell(20, 5,utf8_decode("0"), 0 , 0);
	} elseif($co[0]['fechavencecredito'] >= date("Y-m-d")) { 
	$this->Cell(20, 5,utf8_decode("0"), 0 , 0);
	} elseif($co[0]['fechavencecredito'] < date("Y-m-d")) { 
	$this->Cell(20, 5,utf8_decode(Dias_Transcurridos(date("Y-m-d"),$co[0]['fechavencecredito'])), 0 , 0);
	}
	
	//Linea de membrete Nro 7
	$this->SetXY(52, 33);
	$this->Codabar(13,271,utf8_decode("133923786899444489448576556789"));
	//Linea de membrete Nro 2
    $this->SetFont('courier','B',6.5);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->SetXY(48, 271);
    $this->Cell(20, 5, 'Este documento no constituye un comprobante de pago', 0 , 0);
	
	//Bloque de Totales de factura
    $this->SetFillColor(192);
    $this->SetDrawColor(3,3,3);
    $this->SetLineWidth(.3);
    $this->RoundedRect(122, 250, 78, 28, '1.5', '');
	//Linea de membrete Nro 1
	$this->SetFont('courier','B',9);
    $this->SetXY(124, 253);
    $this->Cell(20, 5, 'SUBTOTAL IGV '.$co[0]["ivac"].'% :', 0 , 0);
    $this->SetXY(167, 253);
	$this->SetFont('courier','',9);
    $this->Cell(20, 5,utf8_decode($con[0]['simbolo'].number_format($co[0]["subtotalivasic"], 2, '.', ',')), 0 , 0);
	
	//Linea de membrete Nro 1
	$this->SetFont('courier','B',9);
    $this->SetXY(124, 257);
    $this->Cell(20, 5, 'SUBTOTAL IGV 0% :', 0 , 0);
    $this->SetXY(167, 257);
	$this->SetFont('courier','',9);
    $this->Cell(20, 5,utf8_decode($con[0]['simbolo'].number_format($co[0]["subtotalivanoc"], 2, '.', ',')), 0 , 0);
	//Linea de membrete Nro 2
	$this->SetFont('courier','B',9);
    $this->SetXY(124, 261);
    $this->Cell(20, 5, 'IGV '.$co[0]["ivac"].'% :', 0 , 0);
    $this->SetXY(167, 261);
	$this->SetFont('courier','',9);
    $this->Cell(20, 5,utf8_decode($con[0]['simbolo'].number_format($co[0]["totalivac"], 2, '.', ',')), 0 , 0);
	//Linea de membrete Nro 3
	$this->SetFont('courier','B',9);
    $this->SetXY(124, 265);
    $this->Cell(20, 5, 'DESC '.$co[0]["descuentoc"].'% :', 0 , 0);
    $this->SetXY(167, 265);
	$this->SetFont('courier','',9);
    $this->Cell(20, 5,utf8_decode($con[0]['simbolo'].number_format($co[0]["totaldescuentoc"], 2, '.', ',')), 0 , 0);
	//Linea de membrete Nro 2
	$this->SetFont('courier','B',9);
    $this->SetXY(124, 269);
    $this->Cell(20, 5, 'TOTAL PAGO :', 0 , 0);
    $this->SetXY(167, 269);
	$this->SetFont('courier','',9);
    $this->Cell(20, 5,utf8_decode($con[0]['simbolo'].number_format($co[0]["totalc"], 2, '.', ',')), 0 , 0);
    
}
################## FIN DE FUNCION FACTURA DE COMPRAS DE PRODUCTOS ##########################

######################### FUNCION LISTAR COMPRAS POR PROVEEDORES ################################
	  function TablaComprasProveedor()
   {		 
    //Logo
    $logo = "./assets/images/logo_dark.png";
    $logo2 = "./assets/images/logo_white_2.png";
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 
    
    $tra = new Login();
    $reg = $tra->BuscarComprasProveedor();

    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,22,$this->Image($logo, $this->GetX()+88, $this->GetY()+4, 24),5,0,'L');
    $this->Cell(250,8,'SISTEMA DE GESTI�N PARA RESTAURANTES',5,0,'C');
    $this->Cell(45,22,$this->Image($logo2, $this->GetX()-72, $this->GetY()+6, 58),5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-28,utf8_decode($con[0]['nomempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-20,'RUC: '.utf8_decode($con[0]['rifempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-12,'DIREC: '.utf8_decode($con[0]['direcempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-4,'N� DE TEL�FONO: '.utf8_decode($con[0]['tlfempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,4,'EMAIL: '.utf8_decode($con[0]['correoempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    $this->Ln(8);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(350,10,'LISTADO DE COMPRAS AL PROVEEDOR '.utf8_decode($reg[0]["nomproveedor"]),0,0,'C');
    
	$this->Ln();
    $this->SetFont('courier','B',9);
	$this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(230, 126, 34); // establece el color del fondo de la celda (en este caso es NARANJA)
	$this->CellFitSpace(10,8,'N�',1,0,'C', True);
	$this->CellFitSpace(40,8,'N� DE COMPRA',1,0,'C', True);
	$this->CellFitSpace(30,8,'STATUS COMPRA',1,0,'C', True);
	$this->CellFitSpace(40,8,'FECHA COMPRA',1,0,'C', True);
	$this->CellFitSpace(25,8,'ARTICULOS',1,0,'C', True);
	$this->CellFitSpace(30,8,'SUBTOTAL CON IGV',1,0,'C', True);
	$this->CellFitSpace(30,8,'SUBTOTAL IGV 0%',1,0,'C', True);
	$this->CellFitSpace(20,8,'IGV',1,0,'C', True);
	$this->CellFitSpace(25,8,'TOTAL IGV',1,0,'C', True);
	$this->CellFitSpace(20,8,'DESCUENTO',1,0,'C', True);
	$this->CellFitSpace(25,8,'TOTAL DESC',1,0,'C', True);
	$this->CellFitSpace(35,8,'TOTAL PAGO',1,1,'C', True);
	
	$totalarticulos=0;
	$Subtotalconiva=0;
	$Subtotalsiniva=0;
	$Totaliva=0;
	$Totaldescuento=0;
	$pagoDescuento=0;
	$Pagototal=0;
	$a=1;
	
    for($i=0;$i<sizeof($reg);$i++){
	
    $totalarticulos+=$reg[$i]['articulos'];
    $Subtotalconiva+=$reg[$i]['subtotalivasic'];
    $Subtotalsiniva+=$reg[$i]['subtotalivanoc'];
	$Totaliva+=$reg[$i]['totalivac']; 
	$Totaldescuento+=$reg[$i]['totaldescuentoc']; 
	$Pagototal+=$reg[$i]['totalc'];  
	
	//$dias = ( $reg[$i]['fechavencecredito'] == '0000-00-00' ? "0" : Dias_Transcurridos($reg[$i]['fechavencecredito'],date("Y-m-d")));
	
	$this->SetFont('courier','',9);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(10,6,$a++,1,0,'C');
	$this->CellFitSpace(40,6,$reg[$i]["codcompra"],1,0,'C');
	
	if($reg[$i]['fechavencecredito']== '0000-00-00') { 
	$this->CellFitSpace(30, 6,utf8_decode($reg[$i]['statuscompra']),1,0,'C');
	} elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d")) { 
	$this->CellFitSpace(30, 6,utf8_decode($reg[$i]['statuscompra']),1,0,'C');
	} elseif($reg[$i]['fechavencecredito'] < date("Y-m-d")) { 
	$this->CellFitSpace(30, 6,utf8_decode("VENCIDA"),1,0,'C');
	}
	$this->CellFitSpace(40,6,utf8_decode(date("d-m-Y h:i:s",strtotime($reg[$i]['fechacompra']))),1,0,'C');
	$this->CellFitSpace(25,6,utf8_decode($reg[$i]["articulos"]),1,0,'C');
	$this->CellFitSpace(30,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]['subtotalivasic'], 2, '.', ',')),1,0,'C');
	$this->CellFitSpace(30,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]['subtotalivanoc'], 2, '.', ',')),1,0,'C');
    $this->CellFitSpace(20,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]['ivac'], 2, '.', ',')),1,0,'C');
    $this->CellFitSpace(25,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]['totalivac'], 2, '.', ',')),1,0,'C');
    $this->CellFitSpace(20,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]['descuentoc'], 2, '.', ',')),1,0,'C');
    $this->CellFitSpace(25,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]['totaldescuentoc'], 2, '.', ',')),1,0,'C');
	$this->CellFitSpace(35,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]['totalc'], 2, '.', ',')),1,0,'C');
    $this->Ln();
	
   } 
   
	$this->Cell(10,6,'',0,0,'C');
    $this->Cell(40,6,'',0,0,'C');	
    $this->Cell(30,6,'',0,0,'C');	
    $this->SetFont('courier','B',12);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    //$this->Cell(40,6,'TOTAL GENERAL',1,0,'C', True);
    $this->Cell(40,6,'TOTAL GENERAL',0,0,'C');
    $this->SetFont('courier','B',9);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
	$this->Cell(25,6,utf8_decode($totalarticulos),1,0,'C');
    $this->Cell(30,6,utf8_decode($con[0]['simbolo'].number_format($Subtotalconiva, 2, '.', ',')),1,0,'C');
    $this->Cell(30,6,utf8_decode($con[0]['simbolo'].number_format($Subtotalsiniva, 2, '.', ',')),1,0,'C');
    $this->Cell(20,6,"",1,0,'C');
    $this->Cell(25,6,utf8_decode($con[0]['simbolo'].number_format($Totaliva, 2, '.', ',')),1,0,'C');
    $this->Cell(20,6,"",1,0,'C');
    $this->Cell(25,6,utf8_decode($con[0]['simbolo'].number_format($Totaldescuento, 2, '.', ',')),1,0,'C');
    $this->Cell(35,6,utf8_decode($con[0]['simbolo'].number_format($Pagototal, 2, '.', ',')),1,0,'C');
    $this->Ln();
   
    $this->Ln(12); 
    $this->SetFont('courier','B',9);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO POR: '.utf8_decode($_SESSION["nivel"]."/".$_SESSION["nombres"]),0,0,'');
    $this->Cell(120,6,'RECIBIDO:__________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA ELABORACI�N:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(120,6,'',0,0,'');
    $this->Ln(4);
	
     }
######################## FIN DE FUNCION LISTAR COMPRAS POR PROVEEDORES #######################

########################## FUNCION LISTAR COMPRAS POR FECHAS #################################
	  function TablaComprasFechas()
   {		 
	//Logo
    $logo = "./assets/images/logo_dark.png";
    $logo2 = "./assets/images/logo_white_2.png";
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 
    
    $tra = new Login();
    $reg = $tra->BuscarComprasFechas();

    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,22,$this->Image($logo, $this->GetX()+88, $this->GetY()+4, 24),5,0,'L');
    $this->Cell(250,8,'SISTEMA DE GESTI�N PARA RESTAURANTES',5,0,'C');
    $this->Cell(45,22,$this->Image($logo2, $this->GetX()-72, $this->GetY()+6, 58),5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-28,utf8_decode($con[0]['nomempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-20,'RUC: '.utf8_decode($con[0]['rifempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-12,'DIREC: '.utf8_decode($con[0]['direcempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-4,'N� DE TEL�FONO: '.utf8_decode($con[0]['tlfempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,4,'EMAIL: '.utf8_decode($con[0]['correoempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    $this->Ln(8);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(350,10,'LISTADO DE COMPRAS POR FECHAS DESDE '.$_GET["desde"].' HASTA '.$_GET["hasta"],0,0,'C');
    
    $this->Ln();
	$this->SetFont('courier','B',9);
	$this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(230, 126, 34); // establece el color del fondo de la celda (en este caso es NARANJA)
	$this->CellFitSpace(10,8,'N�',1,0,'C', True);
	$this->CellFitSpace(25,8,'N� DE COMPRA',1,0,'C', True);
	$this->CellFitSpace(60,8,'PROVEEDOR',1,0,'C', True);
	$this->CellFitSpace(20,8,'STATUS',1,0,'C', True);
	$this->CellFitSpace(35,8,'FECHA COMPRA',1,0,'C', True);
	$this->CellFitSpace(20,8,'ARTIC.',1,0,'C', True);
	$this->CellFitSpace(25,8,'SUBT. CON IGV',1,0,'C', True);
	$this->CellFitSpace(25,8,'SUBT. IGV 0%',1,0,'C', True);
	$this->CellFitSpace(15,8,'IGV',1,0,'C', True);
	$this->CellFitSpace(25,8,'TOTAL IGV',1,0,'C', True);
	$this->CellFitSpace(15,8,'DESC.',1,0,'C', True);
	$this->CellFitSpace(25,8,'TOTAL DESC',1,0,'C', True);
	$this->CellFitSpace(35,8,'TOTAL PAGO',1,1,'C', True);
	
	$totalarticulos=0;
	$Subtotalconiva=0;
	$Subtotalsiniva=0;
	$Totaliva=0;
	$Totaldescuento=0;
	$pagoDescuento=0;
	$Pagototal=0;
	$a=1;
	
    for($i=0;$i<sizeof($reg);$i++){
	
    $totalarticulos+=$reg[$i]['articulos'];
    $Subtotalconiva+=$reg[$i]['subtotalivasic'];
    $Subtotalsiniva+=$reg[$i]['subtotalivanoc'];
	$Totaliva+=$reg[$i]['totalivac']; 
	$Totaldescuento+=$reg[$i]['totaldescuentoc']; 
	$Pagototal+=$reg[$i]['totalc'];  
	
	$this->SetFont('courier','',9);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(10,6,$a++,1,0,'C');
	$this->CellFitSpace(25,6,$reg[$i]["codcompra"],1,0,'C');
	$this->CellFitSpace(60,6,$reg[$i]["nomproveedor"],1,0,'C');
	
	if($reg[$i]['fechavencecredito']== '0000-00-00') { 
	$this->CellFitSpace(20, 6,utf8_decode($reg[$i]['statuscompra']),1,0,'C');
	} elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d")) { 
	$this->CellFitSpace(20, 6,utf8_decode($reg[$i]['statuscompra']),1,0,'C');
	} elseif($reg[$i]['fechavencecredito'] < date("Y-m-d")) { 
	$this->CellFitSpace(20, 6,utf8_decode("VENCIDA"),1,0,'C');
	}
	$this->CellFitSpace(35,6,utf8_decode(date("d-m-Y h:i:s",strtotime($reg[$i]['fechacompra']))),1,0,'C');
	$this->CellFitSpace(20,6,utf8_decode($reg[$i]["articulos"]),1,0,'C');
	$this->CellFitSpace(25,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]['subtotalivasic'], 2, '.', ',')),1,0,'C');
	$this->CellFitSpace(25,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]['subtotalivanoc'], 2, '.', ',')),1,0,'C');
    $this->CellFitSpace(15,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]['ivac'], 2, '.', ',')),1,0,'C');
    $this->CellFitSpace(25,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]['totalivac'], 2, '.', ',')),1,0,'C');
    $this->CellFitSpace(15,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]['descuentoc'], 2, '.', ',')),1,0,'C');
    $this->CellFitSpace(25,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]['totaldescuentoc'], 2, '.', ',')),1,0,'C');
	$this->CellFitSpace(35,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]['totalc'], 2, '.', ',')),1,0,'C');
    $this->Ln();
	
   } 
   
	$this->Cell(10,6,'',0,0,'C');
    $this->Cell(25,6,'',0,0,'C');
    $this->Cell(60,6,'',0,0,'C');	
    $this->Cell(20,6,'',0,0,'C');	
    $this->SetFont('courier','B',12);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    //$this->Cell(35,6,'TOTAL GENERAL',1,0,'C', True);
    $this->Cell(35,6,'TOTAL GENERAL',0,0,'C');
    $this->SetFont('courier','B',9);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
	$this->Cell(20,6,utf8_decode($totalarticulos),1,0,'C');
    $this->Cell(25,6,utf8_decode($con[0]['simbolo'].number_format($Subtotalconiva, 2, '.', ',')),1,0,'C');
    $this->Cell(25,6,utf8_decode($con[0]['simbolo'].number_format($Subtotalsiniva, 2, '.', ',')),1,0,'C');
    $this->Cell(15,6,"",1,0,'C');
    $this->Cell(25,6,utf8_decode($con[0]['simbolo'].number_format($Totaliva, 2, '.', ',')),1,0,'C');
    $this->Cell(15,6,"",1,0,'C');
    $this->Cell(25,6,utf8_decode($con[0]['simbolo'].number_format($Totaldescuento, 2, '.', ',')),1,0,'C');
    $this->Cell(35,6,utf8_decode($con[0]['simbolo'].number_format($Pagototal, 2, '.', ',')),1,0,'C');
    $this->Ln();
   
    $this->Ln(12); 
    $this->SetFont('courier','B',9);
    $this->Cell(40,6,'',0,0,'');
    $this->Cell(140,6,'ELABORADO POR: '.utf8_decode($_SESSION["nivel"]."/".$_SESSION["nombres"]),0,0,'');
    $this->Cell(80,6,'RECIBIDO:__________________________________',0,0,'');
    $this->Ln();
    $this->Cell(40,6,'',0,0,'');
    $this->Cell(140,6,'FECHA/HORA ELABORACI�N:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(80,6,'',0,0,'');
    $this->Ln(4);
	
     }
####################### FIN DE FUNCION LISTAR COMPRAS POR FECHAS ###########################

############################### FUNCION LISTAR COMPRAS POR PAGAR ################################
      function TablaComprasxPagar()
   { 
    
    //Logo
    $logo = "./assets/images/logo_dark.png";
    $logo2 = "./assets/images/logo_white_2.png";
    
    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = utf8_decode($con[0]['simbolo']);

    $tra = new Login();
    $reg = $tra->ListarComprasPend(); 

    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,22,$this->Image($logo, $this->GetX()+88, $this->GetY()+4, 24),5,0,'L');
    $this->Cell(250,8,'SISTEMA DE GESTI�N PARA RESTAURANTES',5,0,'C');
    $this->Cell(45,22,$this->Image($logo2, $this->GetX()-72, $this->GetY()+6, 58),5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-28,utf8_decode($con[0]['nomempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-20,'RUC: '.utf8_decode($con[0]['rifempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-12,'DIREC: '.utf8_decode($con[0]['direcempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-4,'N� DE TEL�FONO: '.utf8_decode($con[0]['tlfempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,4,'EMAIL: '.utf8_decode($con[0]['correoempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    $this->Ln(8);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(350,10,'LISTADO DE COMPRAS POR PAGAS',0,0,'C');
    
    $this->Ln();
    $this->SetFont('courier','B',9);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(230, 126, 34); // establece el color del fondo de la celda (en este caso es AZUL)
    $this->CellFitSpace(12,8,'N�',1,0,'C', True);
    $this->CellFitSpace(20,8,'N� DE COMPRA',1,0,'C', True);
    $this->CellFitSpace(48,8,'PROVEEDOR',1,0,'C', True);
    $this->CellFitSpace(25,8,'STATUS',1,0,'C', True);
    $this->CellFitSpace(20,8,'DIAS VENC',1,0,'C', True);
    $this->CellFitSpace(40,8,'FECHA COMPRA',1,0,'C', True);
    $this->CellFitSpace(20,8,'N� ARTIC',1,0,'C', True);
    $this->CellFitSpace(20,8,'DCTO',1,0,'C', True);
    $this->CellFitSpace(32,8,'SUBTOTAL 0%',1,0,'C', True);
    $this->CellFitSpace(32,8,'SUBTOTAL CON %',1,0,'C', True);
    $this->CellFitSpace(32,8,'TOTAL IGV',1,0,'C', True);
    $this->CellFitSpace(32,8,'TOTAL PAGO',1,1,'C', True);
    
    $TotalArticulos=0;
    $TotalTarifano=0;
    $TotalTarifasi=0;
    $Totaliva=0;
    $TotalDescuento=0;
    $TotalPago=0;

    $a=1;
    for($i=0;$i<sizeof($reg);$i++){

    $TotalArticulos+=$reg[$i]['articulos'];
    $TotalTarifano+=$reg[$i]['subtotalivanoc'];
    $TotalTarifasi+=$reg[$i]['subtotalivasic'];
    $Totaliva+=$reg[$i]['totalivac'];  
    $TotalDescuento+=$reg[$i]['descuentoc'];
    $TotalPago+=$reg[$i]['totalc'];   
        
    $this->SetFont('courier','',9);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(12,6,$a++,1,0,'C');
    $this->CellFitSpace(20,6,$reg[$i]["codcompra"],1,0,'C');
    $this->CellFitSpace(48,6,utf8_decode($reg[$i]["nomproveedor"]),1,0,'C');   

    if($reg[$i]['fechavencecredito']== '0000-00-00') { 
    $this->CellFitSpace(25,6,utf8_decode($reg[$i]['statuscompra']),1,0,'C');
    } elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d")) { 
    $this->CellFitSpace(25,6,utf8_decode($reg[$i]['statuscompra']),1,0,'C');
    } elseif($reg[$i]['fechavencecredito'] < date("Y-m-d")) { 
    $this->CellFitSpace(25,6,utf8_decode("VENCIDA"),1,0,'C'); 
    }

    if($reg[$i]['fechavencecredito']== '0000-00-00') { 
    $this->Cell(20, 6,utf8_decode("0"),1,0,'C');
    } elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d")) { 
    $this->Cell(20, 6,utf8_decode("0"),1,0,'C');
    } elseif($reg[$i]['fechavencecredito'] < date("Y-m-d")) { 
    $this->Cell(20, 6,utf8_decode(Dias_Transcurridos(date("Y-m-d"),$reg[$i]['fechavencecredito'])),1,0,'C');
    }

    $this->CellFitSpace(40,6,utf8_decode($reg[$i]["fechacompra"]),1,0,'C');
        
$this->CellFitSpace(20,6,utf8_decode($reg[$i]['articulos']),1,0,'C');
$this->CellFitSpace(20,6,utf8_decode($simbolo.number_format($reg[$i]['descuentoc'], 2, '.', ',')),1,0,'C');
$this->CellFitSpace(32,6,utf8_decode($simbolo.number_format($reg[$i]['subtotalivanoc'], 2, '.', ',')),1,0,'C');
$this->CellFitSpace(32,6,utf8_decode($simbolo.number_format($reg[$i]['subtotalivasic'], 2, '.', ',')),1,0,'C');
$this->CellFitSpace(32,6,utf8_decode($simbolo.number_format($reg[$i]['totalivac'], 2, '.', ',')),1,0,'C');
$this->CellFitSpace(32,6,utf8_decode($simbolo.number_format($reg[$i]['totalc'], 2, '.', ',')),1,0,'C');
    $this->Ln();
} 
   
    $this->Cell(125,5,'',0,0,'C');   
    $this->SetFont('courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    //$this->Cell(40,5,'TOTAL GENERAL',1,0,'C', True);
    $this->Cell(40,6,'TOTAL GENERAL',0,0,'C');
    $this->SetFont('courier','B',9);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(20,5,utf8_decode($TotalArticulos),1,0,'C');
    $this->Cell(20,5,utf8_decode($simbolo.number_format($TotalDescuento, 2, '.', ',')),1,0,'C');
    $this->Cell(32,5,utf8_decode($simbolo.number_format($TotalTarifano, 2, '.', ',')),1,0,'C');
    $this->Cell(32,5,utf8_decode($simbolo.number_format($TotalTarifasi, 2, '.', ',')),1,0,'C');
    $this->Cell(32,5,utf8_decode($simbolo.number_format($Totaliva, 2, '.', ',')),1,0,'C');
    $this->Cell(32,5,utf8_decode($simbolo.number_format($TotalPago, 2, '.', ',')),1,0,'C');
    $this->Ln();
   
    
    $this->Ln(12); 
    $this->SetFont('courier','B',9);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO POR: '.utf8_decode($_SESSION["nivel"]."/".$_SESSION["nombres"]),0,0,'');
    $this->Cell(120,6,'RECIBIDO:__________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA ELABORACI�N:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(120,6,'',0,0,'');
    $this->Ln(4);
}
############################### FUNCION LISTAR COMPRAS POR PAGAR ################################

#################################### CLASE COMPRAS DE PRODUCTOS #################################





























































################################ CLASE VENTAS DE PRODUCTOS ############################

######################### FUNCION TICKET DE COMANDA ##################################
function TablaTicketComanda()
   {
  
$con = new Login();
$con = $con->ConfiguracionPorId();
$simbolo = $con[0]['simbolo'];

$ve = new Login();
$ve = $ve->VentasPorId(); 

$this->SetFont('courier','B',18);
$this->SetFillColor(2,157,116);
$this->SetXY(4, 6);
$this->Cell(66, 5, "COMANDA", 0 , 0, 'C');
$this->Ln(5);



$this->SetFont('courier','B',10);
$this->SetX(2);
$this->Cell(70,3,'---------------------------------------',0,0,'C');
$this->Ln(3);


if($ve[0]['delivery']!="1"){

$this->SetXY(3, 14);
$this->Cell(3, 5, "SALA: ".utf8_decode($ve[0]['nombresala']), 0 , 0);
$this->SetXY(3, 17);
$etiquetaMesa = (strpos($ve[0]['nombremesa'], '+') !== false) ? "MESAS: " : "N� DE MESA: ";
$this->Cell(3, 5, $etiquetaMesa.utf8_decode($ve[0]['nombremesa']), 0 , 0);  
$this->SetXY(3, 20);
$this->Cell(3, 5, "MESERO: ".utf8_decode($ve[0]['nombres']), 0 , 0);
$this->SetXY(3, 23);
$this->Cell(3, 5, "FECHA DE IMPRESI�N: ".date("d-m-Y h:i:s A ",time()+1800), 0 , 0);

} else {

$this->SetXY(3, 14);
$this->Cell(3, 5, "CAJERO: ".utf8_decode($ve[0]['nombres']), 0 , 0);
$this->SetXY(3, 17);
$this->Cell(3, 5, "FECHA DE IMPRESI�N: ".date("d-m-Y h:i:s A ",time()+1800), 0 , 0);
  
}


$this->Ln(5);
$this->SetFont('courier','B',10);
$this->SetX(2);
$this->Cell(70,3,'--------------- CLIENTE ---------------',0,1,'C');

if($ve[0]['cliente']=="0"){

$this->SetFont('courier','B',6.5);
$this->SetX(3);
$this->Cell(3, 3, "CLIENTE: CONSUMIDOR FINAL",0,0);

} else {

$this->SetFont('courier','B',10);
$this->SetX(3);
$this->Cell(3, 3,"C.I/RUC DE CLIENTE: ".utf8_decode($ve[0]['cedcliente']),0,1);
$this->SetX(3);
$this->Cell(3, 3, "NOMBRE DE CLIENTE: ".utf8_decode(getSubString($ve[0]['nomcliente'], 32)),0,0);

}

$this->Ln();
$this->SetFont('courier','B',8);
$this->SetX(2);
$this->Cell(70,3,'-------------- PRODUCTOS --------------',0,1,'C');
$this->Ln(1);


$this->SetX(4);
$this->SetFont('courier','B',11);
$this->SetTextColor(3, 3, 3); // Establece el color del texto (en este caso es Negro)
$this->SetFillColor(229, 229, 229); // establece el color del fondo de la celda (en este caso es GRIS)
$this->Cell(10,3,'CANT',0,0,'C');
$this->Cell(55,3,'DESCRIPCI�N DE PRODUCTO',0,1,'C');
$this->SetFont('courier','B',8);
$this->SetX(2);
$this->Cell(70,3,'---------------------------------------',0,0,'C');
$this->Ln(3);

$tra = new Login();
$reg = $tra->VerDetallesVentas();
$cantidad=0;
$a=1;
for($i=0;$i<sizeof($reg);$i++){
  
$this->SetX(4);

$this->SetFillColor(192);
$this->SetDrawColor(3,3,3);
$this->SetLineWidth(.2);
$this->SetFont('courier','B',11);  
$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
$this->CellFitSpace(10,3,utf8_decode($reg[$i]['cantventa']),0,0,'C');
$this->CellFitSpace(55,3,utf8_decode(getSubString($reg[$i]["producto"], 40)),0,0,'C');
$this->Ln();  
 }

$this->Ln(3);
$this->SetFont('courier','B',11);
$this->SetX(2);
$this->Cell(70,3,'------------ OBSERVACIONES ------------',0,0,'C');
$this->Ln(3);

$this->SetX(4);
$this->SetFont('courier','B',11);
$this->SetTextColor(3, 3, 3); // Establece el color del texto (en este caso es Negro)
$this->SetFillColor(229, 229, 229); // establece el color del fondo de la celda (en este caso es GRIS)

if($ve[0]['observaciones']==""){

$this->SetFont('courier','',6);
$this->Cell(3, 3, "SIN OBSERVACIONES",0,1);
$this->Ln(3);

    } else {

$this->SetFont('courier','',11);
$this->MultiCell(66,3,utf8_decode($ve[0]['observaciones']),0,'J');
$this->Ln(3);
    }

$this->SetFont('courier','B',8);
$this->SetX(2);
$this->Cell(70,0.5,'---------------------------------------',0,1,'C');
$this->SetX(2);
$this->Cell(70,0.5,'---------------------------------------',0,1,'C');
$this->Ln(3);

$this->Codabar(6,-90,utf8_decode("111111222222333333444444555555666666777777888888999999"));

     }
####################### FIN DE FUNCION TICKET DE COMANDA ####################

######################### FUNCION TICKET DE PRECUENTA #########################
function TablaTicketPrecuenta()
   {
  
$con = new Login();
$con = $con->ConfiguracionPorId();
$simbolo = $con[0]['simbolo'];

$ve = new Login();
$ve = $ve->VentasPorId();

$this->SetFont('Arial','B',14);
$this->SetFillColor(2,157,116);
$this->SetXY(4, 6);
$this->Cell(50, 5, "PRECUENTA", 0 , 0, 'C');
$this->Ln(5);

$this->SetFont('Arial','B',6.5);
$this->SetFillColor(2,157,116);
$this->SetXY(4, 11);
$this->CellFitSpace(50,3,utf8_decode($con[0]['direcempresa']),0,1,'C');
$this->SetXY(4, 13.5);
$this->CellFitSpace(50,3,"Nit:".utf8_decode($con[0]['rifempresa']),0,1,'C');
$this->SetXY(4, 16.5);
$this->CellFitSpace(50,3,utf8_decode($con[0]['nomempresa']),0,1,'C');
$this->SetXY(4, 19.5);
$this->CellFitSpace(50,3,"N� TLF:".utf8_decode($con[0]['tlfempresa']),0,1,'C');

$this->SetFont('Arial','B',8);
$this->SetX(2);
$this->Cell(60,3,'---------------------------------------',0,0,'C');
$this->Ln(3);

$this->SetFont('Arial','B',7);
$this->SetFillColor(2,157,116);
$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)

if($ve[0]['delivery']!="1"){

$this->SetXY(4, 25);
$this->Cell(4, 5, "SALA: ".utf8_decode($ve[0]['nombresala']), 0 , 0);
$this->SetXY(4, 28);
$etiquetaMesa = (strpos($ve[0]['nombremesa'], '+') !== false) ? "MESAS: " : "N� DE MESA: ";
$this->Cell(4, 5, $etiquetaMesa.utf8_decode($ve[0]['nombremesa']), 0 , 0);
$this->SetXY(4, 31);
$this->Cell(4, 5, "MESERO: ".utf8_decode($ve[0]['nombres']), 0 , 0);
$this->SetXY(4, 34);
$this->Cell(4, 5, "FECHA: ".date("d-m-Y h:i:s A ",time()+1800), 0 , 0);

} else {

$this->SetXY(4, 25);
$this->Cell(4, 5, "CAJERO: ".utf8_decode($ve[0]['nombres']), 0 , 0);
$this->SetXY(4, 28);
$this->Cell(4, 5, "FECHA: ".date("d-m-Y h:i:s A ",time()+1800), 0 , 0);
  
}

$this->Ln(5);
$this->SetFont('Arial','B',8);
$this->SetX(2);
$this->Cell(55,3,'-------------------- CLIENTE ----------------------',0,1,'C');

if($ve[0]['cliente']=="0"){

$this->SetFont('Arial','B',6.5);
$this->SetX(4);
$this->Cell(4, 3, "CLIENTE: CONSUMIDOR FINAL",0,0);

} else {

$this->SetFont('Arial','B',6.5);
$this->SetX(4);
$this->Cell(4, 3,"C.I/RUC DE CLIENTE: ".utf8_decode($ve[0]['cedcliente']),0,1);
$this->SetX(4);
$this->Cell(4, 3, "NOMBRE DE CLIENTE: ".utf8_decode(getSubString($ve[0]['nomcliente'], 32)),0,0);

}

$this->Ln();
$this->SetFont('Arial','B',8);
$this->SetX(2);
$this->Cell(55,3,'------------------- PRODUCTOS -----------------',0,1,'C');
$this->Ln(1);


$this->SetX(4);
$this->SetFont('Arial','B',8);
$this->SetTextColor(3, 3, 3); // Establece el color del texto (en este caso es Negro)
$this->SetFillColor(229, 229, 229); // establece el color del fondo de la celda (en este caso es GRIS)
$this->Cell(6,3,'Cant',0,0,'C');
$this->Cell(24,3,'Descripci�n',0,0,'C');
$this->Cell(8,3,'P.',0,0,'C');
$this->Cell(8,3,'Importe',0,1,'C');
    

$this->SetFont('Arial','B',8);
$this->SetX(1);
$this->Cell(55,3,'---------------------------------------------------------',0,0,'C');
$this->Ln(3);

$tra = new Login();
$reg = $tra->VerDetallesVentasPrecuenta();
$cantidad=0;
$a=1;
for($i=0;$i<sizeof($reg);$i++){
  
$this->SetX(4);
$this->SetFillColor(192);
$this->SetDrawColor(3,3,3);
$this->SetLineWidth(.2);
$this->SetFont('Arial','B',5);  
$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
$this->CellFitSpace(6,3,utf8_decode($reg[$i]['cantventa']),0,0,'C');
$this->CellFitSpace(24,3,utf8_decode(getSubString($reg[$i]["producto"], 22)),0,0,'C');
$this->CellFitSpace(8,3,utf8_decode($simbolo.number_format($reg[$i]["precioventa"], 2, '.', ',')),0,0,'R');
$this->CellFitSpace(8,3,utf8_decode($simbolo.number_format($reg[$i]["precioventa"]*$reg[$i]["cantventa"], 2, '.', ',')),0,0,'R');
$this->Ln();  
 }

$this->Ln(3);
$this->SetFont('Arial','B',8);
$this->SetX(1);
$this->Cell(55,3,'------------------------ PAGO ------------------------',0,0,'C');
$this->Ln(3);

$this->SetX(1);
$this->SetFont('Arial','B',8);
$this->CellFitSpace(30,3,"SUBTOTAL IGV ".$ve[0]["ivave"].'%:',0,0,'R');
$this->SetFont('courier','B',8);
$this->CellFitSpace(15,3,utf8_decode($simbolo.number_format($ve[0]["subtotalivasive"], 2, '.', ',')),0,1,'R');

$this->SetX(1);
$this->SetFont('Arial','B',8);
$this->CellFitSpace(30,3,"SUBTOTAL IGV 0%:",0,0,'R');
$this->SetFont('Arial','B',8);
$this->CellFitSpace(15,3,utf8_decode($simbolo.number_format($ve[0]["subtotalivanove"], 2, '.', ',')),0,1,'R');

$this->SetX(1);
$this->SetFont('Arial','B',8);
$this->CellFitSpace(30,3,"IGV ".$ve[0]["ivave"].'%:',0,0,'R');
$this->SetFont('courier','B',8);
$this->CellFitSpace(15,3,utf8_decode($simbolo.number_format($ve[0]["totalivave"], 2, '.', ',')),0,1,'R');

$this->SetX(1);
$this->SetFont('Arial','B',8);
$this->CellFitSpace(30,3,"DESCUENTO ".$ve[0]["descuentove"].'%:',0,0,'R');
$this->SetFont('Arial','',8);
$this->CellFitSpace(15,3,utf8_decode($simbolo.number_format($ve[0]["totaldescuentove"], 2, '.', ',')),0,1,'R');

$this->SetX(4);
$this->SetFont('Arial','B',8);
$this->CellFitSpace(27,3,"TOTAL A PAGAR:",0,0,'R');
$this->SetFont('Arial','B',8);
$this->CellFitSpace(15,3,utf8_decode($simbolo.number_format($ve[0]["totalpago"], 2, '.', ',')),0,1,'R');
$this->Ln(1);

$this->SetFont('Arial','B',8);
$this->SetX(1);
$this->Cell(50,0.5,'---------------------------------------',0,1,'C');
$this->SetX(2);
$this->Cell(50,0.5,'---------------------------------------',0,1,'C');
$this->Ln(3);
          
$this->SetFont('Arial','BI',8);
$this->SetX(1);
$this->SetFillColor(3, 3, 3);
$this->CellFitSpace(50,3,"GRACIAS POR PREFERIRNOS",0,1,'C');


$this->Codabar(6,-90,utf8_decode("111111222222333333444444555555666666777777888888999999"));

     }
####################### FIN DE FUNCION TICKET DE PRECUENTA ####################

######################### FUNCION TICKET DE VENTAS ##################################
	  function TablaTicketVentas()
   {
  
$con = new Login();
$con = $con->ConfiguracionPorId();
$simbolo = $con[0]['simbolo'];
 
$ve = new Login();
$ve = $ve->VentasPorId();
 
$this->SetFont('courier','B',14);
$this->SetFillColor(2,157,116);
$this->SetXY(4, 6);
$this->Cell(50, 5, "TICKET DE VENTA", 0 , 0, 'C');
$this->Ln(5);

$this->SetFont('courier','B',6.5);
$this->SetFillColor(2,157,116);
$this->SetXY(4, 11);
$this->CellFitSpace(50,3,utf8_decode($con[0]['direcempresa']),0,1,'C');
$this->SetXY(4, 13.5);
$this->CellFitSpace(50,3,"RUC:".utf8_decode($con[0]['rifempresa']),0,1,'C');
$this->SetXY(4, 16.5);
$this->CellFitSpace(50,3,utf8_decode($con[0]['nomempresa']),0,1,'C');
$this->SetXY(4, 19.5);
$this->CellFitSpace(50,3,"N� TLF:".utf8_decode($con[0]['tlfempresa']),0,1,'C');

$this->SetFont('courier','B',8);
$this->SetX(2);
$this->Cell(60,3,'---------------------------------------',0,0,'C');
$this->Ln(3);

$this->SetFont('courier','B',6.5);
$this->SetFillColor(2,157,116);
$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
$this->SetXY(4, 25);
$this->Cell(4, 5, "N� DE VENTA: ".utf8_decode($ve[0]['codventa']), 0 , 0);
$this->SetXY(4, 28);
$this->Cell(4, 5, "FECHA DE VENTA: ".date("d-m-Y h:i:s",strtotime($ve[0]['fechaventa'])), 0 , 0);
$this->SetXY(4, 31);
$this->Cell(4, 5, "FECHA: ".date("d-m-Y h:i:s A ",time()+1800), 0 , 0);
if (isset($ve[0]['delivery']) && $ve[0]['delivery'] != "1" && !empty($ve[0]['nombremesa'])) {
	$this->SetXY(4, 34);
	$etiquetaMesa = (strpos($ve[0]['nombremesa'], '+') !== false) ? "MESAS: " : "N� DE MESA: ";
	$this->Cell(4, 5, $etiquetaMesa.utf8_decode($ve[0]['nombremesa']), 0 , 0);
	if (!empty($ve[0]['nombresala'])) {
		$this->SetXY(4, 37);
		$this->Cell(4, 5, "SALA: ".utf8_decode($ve[0]['nombresala']), 0 , 0);
	}
}

$this->Ln(5);
$this->SetFont('courier','B',8);
$this->SetX(2);
$this->Cell(60,3,'--------------- CLIENTE ---------------',0,1,'C');

if($ve[0]['cliente']=="0"){

$this->SetFont('courier','B',6.5);
$this->SetX(4);
$this->Cell(4, 3, "CLIENTE: CONSUMIDOR FINAL",0,0);

} else {

$this->SetFont('courier','B',6.5);
$this->SetX(4);
$this->Cell(4, 3,"C.I/RUC DE CLIENTE: ".utf8_decode($ve[0]['cedcliente']),0,1);
$this->SetX(4);
$this->Cell(4, 3, "NOMBRE DE CLIENTE: ".utf8_decode(getSubString($ve[0]['nomcliente'], 32)),0,0);

}

$this->Ln();
$this->SetFont('courier','B',8);
$this->SetX(2);
$this->Cell(60,3,'-------------- PRODUCTOS --------------',0,1,'C');
$this->Ln(1);


$this->SetX(4);
$this->SetFont('courier','B',8);
$this->SetTextColor(3, 3, 3); // Establece el color del texto (en este caso es Negro)
$this->SetFillColor(229, 229, 229); // establece el color del fondo de la celda (en este caso es GRIS)
$this->Cell(6,3,'Cant',0,0,'C');
$this->Cell(24,3,'Descripci�n',0,0,'C');
$this->Cell(8,3,'P.',0,0,'C');
$this->Cell(8,3,'Importe',0,1,'C');


$this->SetFont('courier','B',8);
$this->SetX(2);
$this->Cell(55,3,'---------------------------------------',0,0,'C');
$this->Ln(3);

$tra = new Login();
$reg = $tra->VerDetallesVentasPrecuenta();
$cantidad=0;
$a=1;
for($i=0;$i<sizeof($reg);$i++){
  
$this->SetX(4);
$this->SetFillColor(192);
$this->SetDrawColor(3,3,3);
$this->SetLineWidth(.2);
$this->SetFont('Arial','B',5);  
$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
$this->CellFitSpace(6,3,utf8_decode($reg[$i]['cantventa']),0,0,'C');
$this->CellFitSpace(24,3,utf8_decode(getSubString($reg[$i]["producto"], 22)),0,0,'C');
$this->CellFitSpace(8,3,utf8_decode($simbolo.number_format($reg[$i]["precioventa"], 2, '.', ',')),0,0,'C');
$this->CellFitSpace(8,3,utf8_decode($simbolo.number_format($reg[$i]["precioventa"]*$reg[$i]["cantventa"], 2, '.', ',')),0,0,'C');
$this->Ln();  
 }

$this->Ln(2);
$this->SetFont('courier','B',8);
$this->SetX(2);
$this->Cell(55,3,'---------------- PAGO -----------------',0,0,'C');
$this->Ln(3);

$this->SetX(4);
$this->SetFont('courier','B',8);
$this->CellFitSpace(30,3,"SUBTOTAL IGV ".$ve[0]["ivave"].'%:',0,0,'R');
$this->SetFont('courier','',8);
$this->CellFitSpace(15,3,utf8_decode($simbolo.number_format($ve[0]["subtotalivanove"]-($ve[0]["subtotalivanove"]*18)/100, 2, '.', ',')),0,1,'R');

$this->SetX(4);
$this->SetFont('courier','B',8);
$this->CellFitSpace(30,3,"SUBTOTAL IGV 0%:",0,0,'R');
$this->SetFont('courier','',8);
$this->CellFitSpace(15,3,utf8_decode($simbolo.number_format($ve[0]["subtotalivanove"], 2, '.', ',')),0,1,'R');

$this->SetX(4);
$this->SetFont('courier','B',8);
$this->CellFitSpace(30,3,"IGV ".$ve[0]["ivave"].'%:',0,0,'R');
$this->SetFont('courier','',8);
$this->CellFitSpace(15,3,utf8_decode($simbolo.number_format(($ve[0]["subtotalivanove"]*18)/100, 2, '.', ',')),0,1,'R');

$this->SetX(4);
$this->SetFont('courier','B',8);
$this->CellFitSpace(30,3,"DESCUENTO ".$ve[0]["descuentove"].'%:',0,0,'R');
$this->SetFont('courier','',8);
$this->CellFitSpace(15,3,utf8_decode($simbolo.number_format($ve[0]["totaldescuentove"], 2, '.', ',')),0,1,'R');

$this->SetX(4);
$this->SetFont('courier','B',8);
$this->CellFitSpace(30,3,"TOTAL A PAGAR:",0,0,'R');
$this->SetFont('courier','',8);
$this->CellFitSpace(15,3,utf8_decode($simbolo.number_format($ve[0]["totalpago"], 2, '.', ',')),0,1,'R');
$this->Ln(1);

$this->SetFont('courier','B',8);
$this->SetX(2);
$this->Cell(50,3,'------------- MEDIO PAGO --------------',0,1,'C');
$this->Ln(1);


if($ve[0]['tipopagove']=="CREDITO"){

$this->SetX(4);
$this->SetFont('courier','B',8);
$this->CellFitSpace(30,3,"TIPO PAGO:",0,0,'R');
$this->SetFont('courier','',8);
$this->CellFitSpace(15,3,utf8_decode($ve[0]["tipopagove"]),0,1,'R');

$this->SetX(4);
$this->SetFont('courier','B',8);
$this->CellFitSpace(30,3,"STATUS PAGO:",0,0,'R');
$this->SetFont('courier','',8);
if($ve[0]['fechavencecredito']== '0000-00-00') { 
$this->CellFitSpace(15,3,utf8_decode($ve[0]["statusventa"]),0,1,'R');
} elseif($ve[0]['fechavencecredito'] >= date("Y-m-d")) { 
$this->CellFitSpace(15,3,utf8_decode($ve[0]["statusventa"]),0,1,'R');
} elseif($ve[0]['fechavencecredito'] < date("Y-m-d")) { 
$this->CellFitSpace(15,3,utf8_decode("VENCIDA"),0,1,'R');
} 

$this->SetX(4);
$this->SetFont('courier','B',8);
$this->CellFitSpace(30,3,"FECHA VENC:",0,0,'R');
$this->SetFont('courier','',8);
$this->CellFitSpace(15,3,utf8_decode($ve[0]["fechavencecredito"]),0,1,'R');

$this->SetX(4);
$this->SetFont('courier','B',8);
$this->CellFitSpace(30,3,"DIAS VENCIDOS:",0,0,'R');
$this->SetFont('courier','',8);
if($ve[0]['fechavencecredito']== '0000-00-00') { 
$this->CellFitSpace(15,3,utf8_decode("0"),0,1,'R');
} elseif($ve[0]['fechavencecredito'] >= date("Y-m-d")) { 
$this->CellFitSpace(15,3,utf8_decode("0"),0,1,'R');
} elseif($ve[0]['fechavencecredito'] < date("Y-m-d")) { 
$this->CellFitSpace(15,3,utf8_decode(Dias_Transcurridos(date("Y-m-d"),$ve[0]['fechavencecredito'])),0,1,'R');
}

$this->SetX(4);
$this->SetFont('courier','B',8);
$this->CellFitSpace(30,3,"TOTAL ABONO:",0,0,'R');
$this->SetFont('courier','',8);
$this->CellFitSpace(15,3,utf8_decode($simbolo.number_format($ve[0]["abonototal"], 2, '.', ',')),0,1,'R');

$this->SetX(4);
$this->SetFont('courier','B',8);
$this->CellFitSpace(30,3,"TOTAL DEBE:",0,0,'R');
$this->SetFont('courier','',8);
$this->CellFitSpace(15,3,utf8_decode($simbolo.number_format($ve[0]["totalpago"]-$ve[0]["abonototal"], 2, '.', ',')),0,1,'R');
$this->Ln(1);

} else {

$this->SetX(4);
$this->SetFont('courier','B',8);
$this->CellFitSpace(20,3,"TIPO PAGO:",0,0,'R');
$this->SetFont('courier','',8);
$this->CellFitSpace(15,3,utf8_decode($ve[0]["tipopagove"]),0,1,'R');

$this->SetX(4);
$this->CellFitSpace(37,3,utf8_decode($ve[0]["mediopago"]),0,1,'R');

$this->SetX(4);
$this->SetFont('courier','B',8);
$this->CellFitSpace(20,3,"EFECTIVO:",0,0,'R');
$this->SetFont('courier','',8);
$this->CellFitSpace(15,3,utf8_decode($simbolo.number_format($ve[0]["montopagado"], 2, '.', ',')),0,1,'R');

$this->SetX(4);
$this->SetFont('courier','B',8);
$this->CellFitSpace(20,3,"CAMBIO:",0,0,'R');
$this->SetFont('courier','',8);
$this->CellFitSpace(15,3,utf8_decode($simbolo.number_format($ve[0]["montodevuelto"], 2, '.', ',')),0,1,'R');
$this->Ln(1);

}

$this->SetFont('courier','B',8);
$this->SetX(2);
$this->Cell(50,3,'-------- INFORMACI�N ADICIONAL --------',0,1,'C');
$this->Ln(1);

$this->SetFont('courier','B',7);
$this->SetX(4);
$this->Cell(50, 3,"CAJERO: ".utf8_decode($ve[0]['nombres']),0,1,'L');
$this->Ln(5);

$this->SetFont('courier','B',8);
$this->SetX(2);
$this->Cell(65,3,'FIRMA: ------------------------------',0,1,'C');
$this->Ln(4);


$this->SetFont('courier','B',8);
$this->SetX(2);
$this->Cell(50,0.5,'---------------------------------------',0,1,'C');
$this->SetX(2);
$this->Cell(50,0.5,'---------------------------------------',0,1,'C');
$this->Ln(3);
      
$this->SetFont('courier','BI',8);
$this->SetX(4);
$this->SetFillColor(3, 3, 3);
$this->CellFitSpace(50,3,"GRACIAS POR SU COMPRA",0,1,'C');

$this->Ln(3);
$this->SetX(4);
$this->Ln(7);
$this->Ln(2);

$this->Codabar(6,-90,utf8_decode("111111222222333333444444555555666666777777888888999999"));

     }
####################### FIN DE FUNCION TICKET DE VENTAS ####################





######################### FUNCION TICKET DE VENTAS ##################################
      function TablaTicketVentasFa()
   {
  
$con = new Login();
$con = $con->ConfiguracionPorId();
$simbolo = $con[0]['simbolo'];
 
$ve = new Login();
$ve = $ve->VentasPorIdFa();
 
$this->SetFont('courier','B',14);
$this->SetFillColor(2,157,116);
$this->SetXY(4, 6);
$texto="TICKET";
if($ve[0]['comprobante']=="1"){
    $texto="BOLETA ELECTRONICA";
}else if($ve[0]['comprobante']=="2"){
    $texto="FACTURA ELECTRONICA";
}else{
    $texto="TICKET";
}
$this->Cell(50, 5, $texto, 0 , 0, 'C');
$this->Ln(5);

$this->SetFont('courier','B',6.5);
$this->SetFillColor(2,157,116);
$this->SetXY(4, 11);
$this->CellFitSpace(50,3,utf8_decode($con[0]['direcempresa']),0,1,'C');
$this->SetXY(4, 13.5);
$this->CellFitSpace(50,3,"RUC:".utf8_decode($con[0]['rifempresa']),0,1,'C');
$this->SetXY(4, 16.5);
$this->CellFitSpace(50,3,utf8_decode($con[0]['nomempresa']),0,1,'C');
$this->SetXY(4, 19.5);
$this->CellFitSpace(50,3,"N� TLF:".utf8_decode($con[0]['tlfempresa']),0,1,'C');

$this->SetFont('courier','B',8);
$this->SetX(2);
$this->Cell(60,3,'---------------------------------------',0,0,'C');
$this->Ln(3);

$this->SetFont('courier','B',6.5);
$this->SetFillColor(2,157,116);
$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
$this->SetXY(4, 25);
$this->Cell(4, 5, "N� DE VENTA: ".utf8_decode($ve[0]['codventa']), 0 , 0);
$this->SetXY(4, 28);
$this->Cell(4, 5, "FECHA DE VENTA: ".date("d-m-Y h:i:s",strtotime($ve[0]['fechaventa'])), 0 , 0);
$this->SetXY(4, 31);
$this->Cell(4, 5, "FECHA: ".date("d-m-Y h:i:s A ",time()+1800), 0 , 0);
if (isset($ve[0]['delivery']) && $ve[0]['delivery'] != "1" && !empty($ve[0]['nombremesa'])) {
	$this->SetXY(4, 34);
	$etiquetaMesa = (strpos($ve[0]['nombremesa'], '+') !== false) ? "MESAS: " : "N� DE MESA: ";
	$this->Cell(4, 5, $etiquetaMesa.utf8_decode($ve[0]['nombremesa']), 0 , 0);
	if (!empty($ve[0]['nombresala'])) {
		$this->SetXY(4, 37);
		$this->Cell(4, 5, "SALA: ".utf8_decode($ve[0]['nombresala']), 0 , 0);
	}
}

$this->Ln(5);
$this->SetFont('courier','B',8);
$this->SetX(2);
$this->Cell(60,3,'--------------- CLIENTE ---------------',0,1,'C');

if($ve[0]['cliente']=="0"){

$this->SetFont('courier','B',6.5);
$this->SetX(4);
$this->Cell(4, 3, "CLIENTE: CONSUMIDOR FINAL",0,0);

} else {

$this->SetFont('courier','B',6.5);
$this->SetX(4);
$this->Cell(4, 3,"C.I/RUC DE CLIENTE: ".utf8_decode($ve[0]['cedcliente']),0,1);
$this->SetX(4);
$this->Cell(4, 3, "NOMBRE DE CLIENTE: ".utf8_decode(getSubString($ve[0]['nomcliente'], 32)),0,0);

}

$this->Ln();
$this->SetFont('courier','B',8);
$this->SetX(2);
$this->Cell(60,3,'-------------- PRODUCTOS --------------',0,1,'C');
$this->Ln(1);


$this->SetX(4);
$this->SetFont('courier','B',8);
$this->SetTextColor(3, 3, 3); // Establece el color del texto (en este caso es Negro)
$this->SetFillColor(229, 229, 229); // establece el color del fondo de la celda (en este caso es GRIS)
$this->Cell(6,3,'Cant',0,0,'C');
$this->Cell(24,3,'Descripci�n',0,0,'C');
$this->Cell(8,3,'P.',0,0,'C');
$this->Cell(8,3,'Importe',0,1,'C');


$this->SetFont('courier','B',8);
$this->SetX(2);
$this->Cell(55,3,'---------------------------------------',0,0,'C');
$this->Ln(3);

$tra = new Login();
$reg = $tra->VerDetallesVentasPrecuenta();
$cantidad=0;
$a=1;
for($i=0;$i<sizeof($reg);$i++){
  
$this->SetX(4);
$this->SetFillColor(192);
$this->SetDrawColor(3,3,3);
$this->SetLineWidth(.2);
$this->SetFont('Arial','B',5);  
$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
$this->CellFitSpace(6,3,utf8_decode($reg[$i]['cantventa']),0,0,'C');
$this->CellFitSpace(24,3,utf8_decode(getSubString($reg[$i]["producto"], 22)),0,0,'C');
$this->CellFitSpace(8,3,utf8_decode($simbolo.number_format($reg[$i]["precioventa"], 2, '.', ',')),0,0,'C');
$this->CellFitSpace(8,3,utf8_decode($simbolo.number_format($reg[$i]["precioventa"]*$reg[$i]["cantventa"], 2, '.', ',')),0,0,'C');
$this->Ln();  
 }

$this->Ln(2);
$this->SetFont('courier','B',8);
$this->SetX(2);
$this->Cell(55,3,'---------------- PAGO -----------------',0,0,'C');
$this->Ln(3);

$this->SetX(4);
$this->SetFont('courier','B',8);
$this->CellFitSpace(30,3,"SUBTOTAL IGV ".$ve[0]["ivave"].'%:',0,0,'R');
$this->SetFont('courier','',8);
$this->CellFitSpace(15,3,utf8_decode($simbolo.number_format($ve[0]["subtotalivanove"]-($ve[0]["subtotalivanove"]*18)/100, 2, '.', ',')),0,1,'R');

$this->SetX(4);
$this->SetFont('courier','B',8);
$this->CellFitSpace(30,3,"SUBTOTAL IGV 0%:",0,0,'R');
$this->SetFont('courier','',8);
$this->CellFitSpace(15,3,utf8_decode($simbolo.number_format($ve[0]["subtotalivanove"], 2, '.', ',')),0,1,'R');

$this->SetX(4);
$this->SetFont('courier','B',8);
$this->CellFitSpace(30,3,"IGV ".$ve[0]["ivave"].'%:',0,0,'R');
$this->SetFont('courier','',8);
$this->CellFitSpace(15,3,utf8_decode($simbolo.number_format(($ve[0]["subtotalivanove"]*18)/100, 2, '.', ',')),0,1,'R');

$this->SetX(4);
$this->SetFont('courier','B',8);
$this->CellFitSpace(30,3,"DESCUENTO ".$ve[0]["descuentove"].'%:',0,0,'R');
$this->SetFont('courier','',8);
$this->CellFitSpace(15,3,utf8_decode($simbolo.number_format($ve[0]["totaldescuentove"], 2, '.', ',')),0,1,'R');

$this->SetX(4);
$this->SetFont('courier','B',8);
$this->CellFitSpace(30,3,"TOTAL A PAGAR:",0,0,'R');
$this->SetFont('courier','',8);
$this->CellFitSpace(15,3,utf8_decode($simbolo.number_format($ve[0]["totalpago"], 2, '.', ',')),0,1,'R');
$this->Ln(1);

$this->SetFont('courier','B',8);
$this->SetX(2);
$this->Cell(50,3,'------------- MEDIO PAGO --------------',0,1,'C');
$this->Ln(1);


if($ve[0]['tipopagove']=="CREDITO"){

$this->SetX(4);
$this->SetFont('courier','B',8);
$this->CellFitSpace(30,3,"TIPO PAGO:",0,0,'R');
$this->SetFont('courier','',8);
$this->CellFitSpace(15,3,utf8_decode($ve[0]["tipopagove"]),0,1,'R');

$this->SetX(4);
$this->SetFont('courier','B',8);
$this->CellFitSpace(30,3,"STATUS PAGO:",0,0,'R');
$this->SetFont('courier','',8);
if($ve[0]['fechavencecredito']== '0000-00-00') { 
$this->CellFitSpace(15,3,utf8_decode($ve[0]["statusventa"]),0,1,'R');
} elseif($ve[0]['fechavencecredito'] >= date("Y-m-d")) { 
$this->CellFitSpace(15,3,utf8_decode($ve[0]["statusventa"]),0,1,'R');
} elseif($ve[0]['fechavencecredito'] < date("Y-m-d")) { 
$this->CellFitSpace(15,3,utf8_decode("VENCIDA"),0,1,'R');
} 

$this->SetX(4);
$this->SetFont('courier','B',8);
$this->CellFitSpace(30,3,"FECHA VENC:",0,0,'R');
$this->SetFont('courier','',8);
$this->CellFitSpace(15,3,utf8_decode($ve[0]["fechavencecredito"]),0,1,'R');

$this->SetX(4);
$this->SetFont('courier','B',8);
$this->CellFitSpace(30,3,"DIAS VENCIDOS:",0,0,'R');
$this->SetFont('courier','',8);
if($ve[0]['fechavencecredito']== '0000-00-00') { 
$this->CellFitSpace(15,3,utf8_decode("0"),0,1,'R');
} elseif($ve[0]['fechavencecredito'] >= date("Y-m-d")) { 
$this->CellFitSpace(15,3,utf8_decode("0"),0,1,'R');
} elseif($ve[0]['fechavencecredito'] < date("Y-m-d")) { 
$this->CellFitSpace(15,3,utf8_decode(Dias_Transcurridos(date("Y-m-d"),$ve[0]['fechavencecredito'])),0,1,'R');
}

$this->SetX(4);
$this->SetFont('courier','B',8);
$this->CellFitSpace(30,3,"TOTAL ABONO:",0,0,'R');
$this->SetFont('courier','',8);
$this->CellFitSpace(15,3,utf8_decode($simbolo.number_format($ve[0]["abonototal"], 2, '.', ',')),0,1,'R');

$this->SetX(4);
$this->SetFont('courier','B',8);
$this->CellFitSpace(30,3,"TOTAL DEBE:",0,0,'R');
$this->SetFont('courier','',8);
$this->CellFitSpace(15,3,utf8_decode($simbolo.number_format($ve[0]["totalpago"]-$ve[0]["abonototal"], 2, '.', ',')),0,1,'R');
$this->Ln(1);

} else {

$this->SetX(4);
$this->SetFont('courier','B',8);
$this->CellFitSpace(20,3,"TIPO PAGO:",0,0,'R');
$this->SetFont('courier','',8);
$this->CellFitSpace(15,3,utf8_decode($ve[0]["tipopagove"]),0,1,'R');

$this->SetX(4);
$this->CellFitSpace(37,3,utf8_decode($ve[0]["mediopago"]),0,1,'R');

$this->SetX(4);
$this->SetFont('courier','B',8);
$this->CellFitSpace(20,3,"EFECTIVO:",0,0,'R');
$this->SetFont('courier','',8);
$this->CellFitSpace(15,3,utf8_decode($simbolo.number_format($ve[0]["montopagado"], 2, '.', ',')),0,1,'R');

$this->SetX(4);
$this->SetFont('courier','B',8);
$this->CellFitSpace(20,3,"CAMBIO:",0,0,'R');
$this->SetFont('courier','',8);
$this->CellFitSpace(15,3,utf8_decode($simbolo.number_format($ve[0]["montodevuelto"], 2, '.', ',')),0,1,'R');
$this->Ln(1);

}

$this->SetFont('courier','B',8);
$this->SetX(2);
$this->Cell(50,3,'-------- INFORMACI�N ADICIONAL --------',0,1,'C');
$this->Ln(1);

$this->SetFont('courier','B',7);
$this->SetX(4);
$this->Cell(50, 3,"CAJERO: ".utf8_decode($ve[0]['nombres']),0,1,'L');
$this->Ln(5);

$this->SetFont('courier','B',8);
$this->SetX(2);
$this->Cell(65,3,'FIRMA: ------------------------------',0,1,'C');
$this->Ln(4);


$this->SetFont('courier','B',8);
$this->SetX(2);
$this->Cell(50,0.5,'---------------------------------------',0,1,'C');
$this->SetX(2);
$this->Cell(50,0.5,'---------------------------------------',0,1,'C');
$this->Ln(3);
      
$this->SetFont('courier','BI',8);
$this->SetX(4);
$this->SetFillColor(3, 3, 3);
$this->CellFitSpace(50,3,"GRACIAS POR SU COMPRA",0,1,'C');

$this->Ln(3);
$this->SetX(4);
$this->Ln(7);
$this->Ln(2);

$this->Codabar(6,-90,utf8_decode("111111222222333333444444555555666666777777888888999999"));

     }
####################### FIN DE FUNCION TICKET DE VENTAS ####################



     ######################### FUNCION ARQUEO CAJA ##################################
      function TablaTicketArqueo()
   {
  
$con = new Login();
$con = $con->ConfiguracionPorId();
$simbolo = $con[0]['simbolo'];
 
$reg =  new Login();
$reg = $reg->ArqueoCajaPorId();

$this->SetFont('courier','B',14);
$this->SetFillColor(2,157,116);
$this->SetXY(4, 6);
$this->Cell(50, 5, "ARQUEO DE CAJA", 0 , 0, 'C');
$this->Ln(5);

$this->SetFont('courier','B',6.5);
$this->SetFillColor(2,157,116);
$this->SetXY(4, 11);
$this->CellFitSpace(50,3,utf8_decode($con[0]['direcempresa']),0,1,'C');
$this->SetXY(4, 13.5);
$this->CellFitSpace(50,3,"RUC:".utf8_decode($con[0]['rifempresa']),0,1,'C');
$this->SetXY(4, 16.5);

$this->SetFont('courier','B',8);
$this->SetX(2);
$this->Cell(60,3,'---------------------------------------',0,0,'C');
$this->Ln(3);

$this->SetFont('courier','B',6.5);
$this->SetFillColor(2,157,116);
$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
$this->SetXY(4, 25);
$this->Cell(4, 5, "N� de Caja: ".$reg[0]['nrocaja'], 0 , 0);
$this->SetXY(4, 28);
$this->Cell(4, 5, "Nombre de Caja: ".$reg[0]['nombrecaja'], 0 , 0);
$this->SetXY(4, 31);
$this->Cell(4, 5, "Monto Inicial: ".$con[0]['simbolo'].' '.number_format($reg[0]['montoinicial'], 2, '.', ','), 0 , 0);
$this->SetXY(4, 34);
$this->Cell(4, 5, "Ingresos: ".$con[0]['simbolo'].' '.number_format($reg[0]['ingresos'], 2, '.', ','), 0 , 0);
$this->SetXY(4, 37);
$this->Cell(4, 5, "Egresos: ".$con[0]['simbolo'].' '.number_format($reg[0]['egresos'], 2, '.', ','), 0 , 0);
$this->SetXY(4, 40);
$this->Cell(4, 5, "Dinero en Efectivo: ".$con[0]['simbolo'].' '.number_format($reg[0]['dineroefectivo'], 2, '.', ','), 0 , 0);
$this->SetXY(4, 43);
$this->Cell(4, 5, "Diferencia: ".$con[0]['simbolo'].' '.number_format($reg[0]['diferencia'], 2, '.', ','), 0 , 0);
$this->SetXY(4, 46);
$this->Cell(4, 5, "Comentario: ".$reg[0]['comentarios'], 0 , 0);
$this->SetXY(4, 49);
$this->Cell(4, 5, "Hora Apertura: ".date("d-m-Y h:i:s",strtotime($reg[0]['fechaapertura'])), 0 , 0);
$this->SetXY(4, 52);
$this->Cell(4, 5, "Hora Cierre: ".$cierre = ( $reg[0]['statusarqueo'] == '1' ? $reg[0]['fechacierre'] : date("d-m-Y h:i:s",strtotime($reg[0]['fechacierre']))), 0 , 0);


$this->Ln(5);
$this->SetFont('courier','B',8);
$this->SetX(2);
$this->Cell(60,3,'------------- RESPONSABLE -------------',0,1,'C');


$this->SetFont('courier','B',6.5);
$this->SetX(4);
$this->Cell(4, 3,"Responsable: ".$reg[0]['nombres'],0,0);


$tra = new Login();
$reg = $tra->BuscarVentasCajasID();
$Pagototal=0;
$pagoefectivo=0;
$pagotrans=0;
$pagotarjeta=0;
$pagoyape=0;
$pagoplin=0;
$pagocheque=0;
$a=1;
  
for($i=0;$i<sizeof($reg);$i++){
  
    if($reg[$i]['formapagove']=="1"){
      $pagoefectivo+=$reg[$i]['totalpago'];
    }else if($reg[$i]['formapagove']=="2"){
      $pagotrans+=$reg[$i]['totalpago'];
    }else if($reg[$i]['formapagove']=="3"){
      $pagotarjeta+=$reg[$i]['totalpago'];
    }else if($reg[$i]['formapagove']=="4"){
      $pagoyape+=$reg[$i]['totalpago'];
    }else if($reg[$i]['formapagove']=="5"){
      $pagoplin+=$reg[$i]['totalpago'];
    }else{
      $pagocheque+=$reg[$i]['totalpago'];
    }
    $Pagototal+=$reg[$i]['totalpago']; 

}

$this->Ln(6);
$this->SetFont('courier','B',8);
$this->SetX(2);
$this->Cell(55,3,'---------------- TIPO PAGO ---------------',0,0,'C');
$this->Ln(3);

$this->SetX(4);
$this->SetFont('courier','B',8);
$this->CellFitSpace(30,3,"EFECTIVO: ",0,0,'R');
$this->SetFont('courier','',8);
$this->CellFitSpace(15,3,$con[0]['simbolo'].number_format($pagoefectivo, 2, '.', ','),0,1,'R');

$this->SetX(4);
$this->SetFont('courier','B',8);
$this->CellFitSpace(30,3,"TRANFERENCIA:",0,0,'R');
$this->SetFont('courier','',8);
$this->CellFitSpace(15,3,$con[0]['simbolo'].number_format($pagotrans, 2, '.', ','),0,1,'R');

$this->SetX(4);
$this->SetFont('courier','B',8);
$this->CellFitSpace(30,3,"TARJETA D/C: ",0,0,'R');
$this->SetFont('courier','',8);
$this->CellFitSpace(15,3,$con[0]['simbolo'].number_format($pagotarjeta, 2, '.', ','),0,1,'R');

$this->SetX(4);
$this->SetFont('courier','B',8);
$this->CellFitSpace(30,3,"YAPE: ",0,0,'R');
$this->SetFont('courier','',8);
$this->CellFitSpace(15,3,$con[0]['simbolo'].number_format($pagoyape, 2, '.', ','),0,1,'R');

$this->SetX(4);
$this->SetFont('courier','B',8);
$this->CellFitSpace(30,3,"PLIN:",0,0,'R');
$this->SetFont('courier','',8);
$this->CellFitSpace(15,3,$con[0]['simbolo'].number_format($pagoplin, 2, '.', ','),0,1,'R');
$this->Ln(1);



$this->Ln(6);
$this->SetFont('courier','B',8);
$this->SetX(6);
$this->Cell(65,3,'FIRMA: ------------------------------',0,1,'C');
$this->Ln(4);



$this->Ln(3);
$this->SetX(4);
$this->Ln(7);
$this->Ln(2);

$this->Codabar(6,-90,utf8_decode("111111222222333333444444555555666666777777888888999999"));

     }
####################### FIN DE FUNCION ARQUEO CAJA ####################

######################### FUNCION LISTAR VENTAS POR FECHAS Y CAJAS DE VENTAS #########################
	  function TablaVentasCajas()
   {
	//Logo
    $logo = "./assets/images/logo_dark.png";
    $logo2 = "./assets/images/logo_white_2.png";
    
    $con = new Login();
    $con = $con->ConfiguracionPorId();

    $tra = new Login();
    $reg = $tra->BuscarVentasCajas();

    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,22,$this->Image($logo, $this->GetX()+88, $this->GetY()+4, 24),5,0,'L');
    $this->Cell(250,8,'SISTEMA DE GESTI�N PARA RESTAURANTES',5,0,'C');
    $this->Cell(45,22,$this->Image($logo2, $this->GetX()-72, $this->GetY()+6, 58),5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-28,utf8_decode($con[0]['nomempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-20,'RUC: '.utf8_decode($con[0]['rifempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-12,'DIREC: '.utf8_decode($con[0]['direcempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-4,'N� DE TEL�FONO: '.utf8_decode($con[0]['tlfempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,4,'EMAIL: '.utf8_decode($con[0]['correoempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    $this->Ln(8);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(350,10,'VENTAS DESDE '.$_GET["desde"].' HASTA '.$_GET["hasta"].' Y CAJA N�.'.$reg[0]['nrocaja'],0,0,'C');
    
    $this->Ln();
	$this->SetFont('courier','B',9);
	$this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(230, 126, 34); // establece el color del fondo de la celda (en este caso es NARANJA)
	$this->CellFitSpace(10,8,'N�',1,0,'C', True);
	$this->CellFitSpace(32,8,'N� DE VENTA',1,0,'C', True);
	$this->CellFitSpace(70,8,'CLIENTES',1,0,'C', True);
	$this->CellFitSpace(17,8,'STATUS',1,0,'C', True);
	$this->CellFitSpace(35,8,'FECHA VENTA',1,0,'C', True);
	$this->CellFitSpace(15,8,'ARTIC',1,0,'C', True);
	$this->CellFitSpace(28,8,'SUBTOT CON IGV',1,0,'C', True);
	$this->CellFitSpace(28,8,'SUBTOT IGV 0%',1,0,'C', True);
	$this->CellFitSpace(12,8,'IGV',1,0,'C', True);
	$this->CellFitSpace(22,8,'TOTAL IGV',1,0,'C', True);
	$this->CellFitSpace(12,8,'DESC',1,0,'C', True);
	$this->CellFitSpace(20,8,'TOT DESC',1,0,'C', True);
	$this->CellFitSpace(30,8,'TOTAL PAGO',1,1,'C', True);
	
	$totalarticulos=0;
	$Subtotalconiva=0;
	$Subtotalsiniva=0;
	$Totaliva=0;
	$Totaldescuento=0;
	$pagoDescuento=0;
	$Pagototal=0;
	$a=1;
	
    for($i=0;$i<sizeof($reg);$i++){
	
    $totalarticulos+=$reg[$i]['articulos'];
    $Subtotalconiva+=$reg[$i]['subtotalivasive'];
    $Subtotalsiniva+=$reg[$i]['subtotalivanove'];
	$Totaliva+=$reg[$i]['totalivave']; 
	$Totaldescuento+=$reg[$i]['totaldescuentove']; 
	$Pagototal+=$reg[$i]['totalpago'];  
	
	$this->SetFont('courier','',9);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(10,6,$a++,1,0,'C');
	$this->CellFitSpace(32,6,$reg[$i]["codventa"],1,0,'C');
	$this->Cell(70,6,utf8_decode($cliente = ( $reg[$i]['codcliente'] == '0' ? "SIN ASIGNACION" : $reg[$i]["nomcliente"])),1,0,'C');
	
	if($reg[$i]['fechavencecredito']== '0000-00-00') { 
	$this->CellFitSpace(17, 6,utf8_decode($reg[$i]['statusventa']),1,0,'C');
	} elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d")) { 
	$this->CellFitSpace(17, 6,utf8_decode($reg[$i]['statusventa']),1,0,'C');
	} elseif($reg[$i]['fechavencecredito'] < date("Y-m-d")) { 
	$this->CellFitSpace(17, 6,utf8_decode("VENCIDA"),1,0,'C');
	}
	$this->CellFitSpace(35,6,utf8_decode(date("d-m-Y h:i:s",strtotime($reg[$i]['fechaventa']))),1,0,'C');
	$this->CellFitSpace(15,6,utf8_decode($reg[$i]["articulos"]),1,0,'C');
	$this->CellFitSpace(28,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]['subtotalivasive'], 2, '.', ',')),1,0,'C');
	$this->CellFitSpace(28,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]['subtotalivanove'], 2, '.', ',')),1,0,'C');
    $this->CellFitSpace(12,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]['ivave'], 2, '.', ',')),1,0,'C');
    $this->CellFitSpace(22,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]['totalivave'], 2, '.', ',')),1,0,'C');
    $this->CellFitSpace(12,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]['descuentove'], 2, '.', ',')),1,0,'C');
    $this->CellFitSpace(20,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]['totaldescuentove'], 2, '.', ',')),1,0,'C');
	$this->CellFitSpace(30,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]['totalpago'], 2, '.', ',')),1,0,'C');
    $this->Ln();
	
   } 
   
	$this->Cell(10,6,'',0,0,'C');
    $this->Cell(32,6,'',0,0,'C');		
    $this->Cell(70,6,'',0,0,'C');		
    $this->Cell(17,6,'',0,0,'C');	
    $this->SetFont('courier','B',12);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco 255)
    $this->Cell(35,6,'TOTAL GENERAL',0,0,'C');
    $this->SetFont('courier','B',9);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
	$this->Cell(15,6,utf8_decode($totalarticulos),1,0,'C');
    $this->Cell(28,6,utf8_decode($con[0]['simbolo'].number_format($Subtotalconiva, 2, '.', ',')),1,0,'C');
    $this->Cell(28,6,utf8_decode($con[0]['simbolo'].number_format($Subtotalsiniva, 2, '.', ',')),1,0,'C');
    $this->Cell(12,6,"",1,0,'C');
    $this->Cell(22,6,utf8_decode($con[0]['simbolo'].number_format($Totaliva, 2, '.', ',')),1,0,'C');
    $this->Cell(12,6,"",1,0,'C');
    $this->Cell(20,6,utf8_decode($con[0]['simbolo'].number_format($Totaldescuento, 2, '.', ',')),1,0,'C');
    $this->Cell(30,6,utf8_decode($con[0]['simbolo'].number_format($Pagototal, 2, '.', ',')),1,0,'C');
    $this->Ln();
   
    $this->Ln(12); 
    $this->SetFont('courier','B',9);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO POR: '.utf8_decode($_SESSION["nivel"]."/".$_SESSION["nombres"]),0,0,'');
    $this->Cell(120,6,'RECIBIDO:__________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA ELABORACI�N:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(120,6,'',0,0,'');
    $this->Ln(4);
     }
######################### FIN DE FUNCION LISTAR VENTAS POR FECHAS Y CAJAS DE VENTAS #######################

################################### FUNCION LISTAR VENTAS POR FECHAS ######################################
	  function TablaVentasFechas()
   {
    //Logo
    $logo = "./assets/images/logo_dark.png";
    $logo2 = "./assets/images/logo_white_2.png";
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,22,$this->Image($logo, $this->GetX()+88, $this->GetY()+4, 24),5,0,'L');
    $this->Cell(250,8,'SISTEMA DE GESTI�N PARA RESTAURANTES',5,0,'C');
    $this->Cell(45,22,$this->Image($logo2, $this->GetX()-72, $this->GetY()+6, 58),5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-28,utf8_decode($con[0]['nomempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-20,'RUC: '.utf8_decode($con[0]['rifempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-12,'DIREC: '.utf8_decode($con[0]['direcempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-4,'N� DE TEL�FONO: '.utf8_decode($con[0]['tlfempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,4,'EMAIL: '.utf8_decode($con[0]['correoempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    $this->Ln(8);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(350,10,'LISTADO DE VENTAS DESDE '.$_GET["desde"].' HASTA '.$_GET["hasta"],0,0,'C');
    
    $this->Ln();
	$this->SetFont('courier','B',9);
	$this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(230, 126, 34); // establece el color del fondo de la celda (en este caso es NARANJA)
	$this->CellFitSpace(10,8,'N�',1,0,'C', True);
	$this->CellFitSpace(27,8,'N� DE VENTA',1,0,'C', True);
	$this->CellFitSpace(20,8,'CAJA',1,0,'C', True);
	$this->CellFitSpace(60,8,'CLIENTES',1,0,'C', True);
	$this->CellFitSpace(17,8,'STATUS',1,0,'C', True);
	$this->CellFitSpace(35,8,'FECHA VENTA',1,0,'C', True);
	$this->CellFitSpace(15,8,'ARTIC',1,0,'C', True);
	$this->CellFitSpace(28,8,'SUBTOT CON IGV',1,0,'C', True);
	$this->CellFitSpace(28,8,'SUBTOT IGV 0%',1,0,'C', True);
	$this->CellFitSpace(12,8,'IGV',1,0,'C', True);
	$this->CellFitSpace(22,8,'TOTAL IGV',1,0,'C', True);
	$this->CellFitSpace(12,8,'DESC',1,0,'C', True);
	$this->CellFitSpace(20,8,'TOT DESC',1,0,'C', True);
	$this->CellFitSpace(27,8,'TOTAL PAGO',1,1,'C', True);
	
    $tra = new Login();
    $reg = $tra->BuscarVentasFechas();
	$totalarticulos=0;
	$Subtotalconiva=0;
	$Subtotalsiniva=0;
	$Totaliva=0;
	$Totaldescuento=0;
	$pagoDescuento=0;
	$Pagototal=0;
	$a=1;
	
    for($i=0;$i<sizeof($reg);$i++){
	
    $totalarticulos+=$reg[$i]['articulos'];
    $Subtotalconiva+=$reg[$i]['subtotalivasive'];
    $Subtotalsiniva+=$reg[$i]['subtotalivanove'];
	$Totaliva+=$reg[$i]['totalivave']; 
	$Totaldescuento+=$reg[$i]['totaldescuentove']; 
	$Pagototal+=$reg[$i]['totalpago'];  
	
	$this->SetFont('courier','',9);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(10,6,$a++,1,0,'C');
	$this->CellFitSpace(27,6,$reg[$i]["codventa"],1,0,'C');
	$this->Cell(20,6,utf8_decode($caja = ( $reg[$i]['codcaja'] == '0' ? "SIN COBRAR" : $reg[$i]["nrocaja"])),1,0,'C');
	$this->Cell(60,6,utf8_decode($cliente = ( $reg[$i]['codcliente'] == '0' ? "SIN ASIGNACI�N" : $reg[$i]["nomcliente"])),1,0,'C');
	
	if($reg[$i]['fechavencecredito']== '0000-00-00') { 
	$this->CellFitSpace(17, 6,utf8_decode($reg[$i]['statusventa']),1,0,'C');
	} elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d")) { 
	$this->CellFitSpace(17, 6,utf8_decode($reg[$i]['statusventa']),1,0,'C');
	} elseif($reg[$i]['fechavencecredito'] < date("Y-m-d")) { 
	$this->CellFitSpace(17, 6,utf8_decode("VENCIDA"),1,0,'C');
	}
	$this->CellFitSpace(35,6,utf8_decode(date("d-m-Y h:i:s",strtotime($reg[$i]['fechaventa']))),1,0,'C');
	$this->CellFitSpace(15,6,utf8_decode($reg[$i]["articulos"]),1,0,'C');
	$this->CellFitSpace(28,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]['subtotalivasive'], 2, '.', ',')),1,0,'C');
	$this->CellFitSpace(28,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]['subtotalivanove'], 2, '.', ',')),1,0,'C');
    $this->CellFitSpace(12,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]['ivave'], 2, '.', ',')),1,0,'C');
    $this->CellFitSpace(22,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]['totalivave'], 2, '.', ',')),1,0,'C');
    $this->CellFitSpace(12,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]['descuentove'], 2, '.', ',')),1,0,'C');
    $this->CellFitSpace(20,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]['totaldescuentove'], 2, '.', ',')),1,0,'C');
	$this->CellFitSpace(27,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]['totalpago'], 2, '.', ',')),1,0,'C');
    $this->Ln();
	
   } 
   
	$this->Cell(10,6,'',0,0,'C');
    $this->Cell(32,6,'',0,0,'C');		
    $this->Cell(15,6,'',0,0,'C');
    $this->Cell(60,6,'',0,0,'C');	
    $this->SetFont('courier','B',12);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(52,6,'TOTAL GENERAL',0,0,'C');
    $this->SetFont('courier','B',9);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
	$this->Cell(15,6,utf8_decode($totalarticulos),1,0,'C');
    $this->Cell(28,6,utf8_decode($con[0]['simbolo'].number_format($Subtotalconiva, 2, '.', ',')),1,0,'C');
    $this->Cell(28,6,utf8_decode($con[0]['simbolo'].number_format($Subtotalsiniva, 2, '.', ',')),1,0,'C');
    $this->Cell(12,6,"",1,0,'C');
    $this->Cell(22,6,utf8_decode($con[0]['simbolo'].number_format($Totaliva, 2, '.', ',')),1,0,'C');
    $this->Cell(12,6,"",1,0,'C');
    $this->Cell(20,6,utf8_decode($con[0]['simbolo'].number_format($Totaldescuento, 2, '.', ',')),1,0,'C');
    $this->Cell(27,6,utf8_decode($con[0]['simbolo'].number_format($Pagototal, 2, '.', ',')),1,0,'C');
    $this->Ln();
   
    $this->Ln(12); 
    $this->SetFont('courier','B',9);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO POR: '.utf8_decode($_SESSION["nivel"]."/".$_SESSION["nombres"]),0,0,'');
    $this->Cell(120,6,'RECIBIDO:__________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA ELABORACI�N:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(120,6,'',0,0,'');
    $this->Ln(4);
     }
############################ FIN DE FUNCION LISTAR VENTAS POR FECHAS ############################

################################# FUNCION LISTAR ARQUEOS DE CAJAS #####################################
      function TablaListarArqueosCajas()
   {
    //Logo
    $logo = "./assets/images/logo_dark.png";
    $logo2 = "./assets/images/logo_white_2.png";
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,22,$this->Image($logo, $this->GetX()+24, $this->GetY()+4, 22),5,0,'L');
    $this->Cell(105,8,'SISTEMA DE GESTI�N PARA RESTAURANTES',5,0,'C');
    $this->Cell(45,22,$this->Image($logo2, $this->GetX()-2, $this->GetY()+6, 34),5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-28,utf8_decode($con[0]['nomempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-20,'RUC: '.utf8_decode($con[0]['rifempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-12,'DIREC: '.utf8_decode($con[0]['direcempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-4,'N� DE TEL�FONO: '.utf8_decode($con[0]['tlfempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,4,'EMAIL: '.utf8_decode($con[0]['correoempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    $this->Ln(8);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(195,10,'ARQUEOS DE CAJAS DESDE '.$_GET["desde"].' HASTA '.$_GET["hasta"],0,0,'C');
    
    $this->Ln();
    $this->SetFont('courier','B',9);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(230, 126, 34); // establece el color del fondo de la celda (en este caso es NARANJA)
    $this->CellFitSpace(10,8,'N�',1,0,'C', True);
    $this->CellFitSpace(32,8,'CAJA',1,0,'C', True);
    $this->CellFitSpace(40,8,'HORA DE APERTURA',1,0,'C', True);
    $this->CellFitSpace(40,8,'HORA DE CIERRE',1,0,'C', True);
    $this->CellFitSpace(23,8,'ESTIMADO',1,0,'C', True);
    $this->CellFitSpace(23,8,'REAL',1,0,'C', True);
    $this->CellFitSpace(23,8,'DIFERENCIA',1,1,'C', True);
    
    $tra = new Login();
    $reg = $tra->BuscarArqueosCajasFechas();

    if($reg==""){

    echo "";      
    
    } else {
 
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){
    $this->SetFont('courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(10,6,$a++,1,0,'C');
    $this->CellFitSpace(32,6,$reg[$i]["nombrecaja"],1,0,'C');
    $this->CellFitSpace(40,6,utf8_decode($reg[$i]["fechaapertura"]),1,0,'C');
    $this->CellFitSpace(40,6,utf8_decode($reg[$i]["fechacierre"]),1,0,'C');
    $this->CellFitSpace(23,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]['montoinicial']+$reg[$i]['ingresos']-$reg[$i]['egresos'], 2, '.', ',')),1,0,'C');
    $this->CellFitSpace(23,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]["dineroefectivo"], 2, '.', ',')),1,0,'C');
    $this->CellFitSpace(23,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]["diferencia"], 2, '.', ',')),1,0,'C');
    $this->Ln();
}
    
   }
    $this->Ln(12); 
    $this->SetFont('courier','B',9);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(120,6,'ELABORADO POR: '.utf8_decode($_SESSION["nivel"]."/".$_SESSION["nombres"]),0,0,'');
    $this->Cell(40,6,'RECIBIDO:_________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(120,6,'FECHA/HORA ELABORACI�N:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(40,6,'',0,0,'');
    $this->Ln(4);
     }
########################### FIN DE FUNCION LISTAR ARQUEOS DE CAJAS ##############################

############################ FUNCION LISTAR MOVIMIENTOS DE CAJAS ################################
      function TablaListarMovimientosCajas()
   {
    //Logo
    $logo = "./assets/images/logo_dark.png";
    $logo2 = "./assets/images/logo_white_2.png";
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 
    
    $movim = new Login();
    $reg = $movim->BuscarMovimientosCajasFechas();

    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,22,$this->Image($logo, $this->GetX()+24, $this->GetY()+4, 22),5,0,'L');
    $this->Cell(105,8,'SISTEMA DE GESTI�N PARA RESTAURANTES',5,0,'C');
    $this->Cell(45,22,$this->Image($logo2, $this->GetX()-2, $this->GetY()+6, 34),5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-28,utf8_decode($con[0]['nomempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-20,'RUC: '.utf8_decode($con[0]['rifempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-12,'DIREC: '.utf8_decode($con[0]['direcempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-4,'N� DE TEL�FONO: '.utf8_decode($con[0]['tlfempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,4,'EMAIL: '.utf8_decode($con[0]['correoempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    $this->Ln(8);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(195,10,'MOVIMIENTOS DE CAJAS DESDE '.$_GET["desde"].' HASTA '.$_GET["hasta"],0,0,'C');
    
    $this->Ln();
    $this->SetFont('courier','B',9);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(230, 126, 34); // establece el color del fondo de la celda (en este caso es NARANJA)
    $this->CellFitSpace(10,8,'N�',1,0,'C', True);
    $this->CellFitSpace(35,8,'FECHA MOVIMIENTO',1,0,'C', True);
    $this->CellFitSpace(30,8,'TIPO',1,0,'C', True);
    $this->CellFitSpace(90,8,'DESCRIPCI�N DE MOVIMIENTO',1,0,'C', True);
    $this->CellFitSpace(25,8,'MONTO',1,1,'C', True);
    
    $a=1;
$TotalIngresos=0;
$TotalEgresos=0;

    if($reg==""){

    echo "";      
    
    } else {
 
for($i=0;$i<sizeof($reg);$i++){ 
$TotalIngresos+=$ingresos = ( $reg[$i]['tipomovimientocaja'] == 'INGRESO' ? $reg[$i]['montomovimientocaja'] : "0");
$TotalEgresos+=$egresos = ( $reg[$i]['tipomovimientocaja'] == 'EGRESO' ? $reg[$i]['montomovimientocaja'] : "0"); 


    $this->SetFont('courier','',8);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(10,6,$a++,1,0,'C');
    $this->CellFitSpace(35,6,$reg[$i]["fechamovimientocaja"],1,0,'C');
    $this->CellFitSpace(30,6,utf8_decode($reg[$i]["tipomovimientocaja"]),1,0,'C');
    $this->CellFitSpace(90,6,utf8_decode($reg[$i]["descripcionmovimientocaja"]),1,0,'C');
    $this->CellFitSpace(25,6,utf8_decode($con[0]['simbolo'].number_format($reg[$i]['montomovimientocaja'], 2, '.', ',')),1,0,'C');
    $this->Ln();
      }
    
   }
   
    $this->Cell(325,5,'',0,0,'C');
    $this->Ln();
    
    $this->SetFont('courier','B',9);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(230, 126, 34); // establece el color del fondo de la celda (en este caso es NARANJA)
    $this->Cell(95,5,'DETALLES DE MOVIMIENTO',1,0,'C', True);
    $this->Ln();


    $this->SetFont('courier','B',8);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(230, 126, 34); // establece el color del fondo de la celda (en este caso es NARANJA)
    $this->Cell(35,5,'NOMBRE DE CAJA',1,0,'C', True);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(60,5,utf8_decode($reg[0]['nombrecaja']),1,0,'C');
    $this->Ln();

    $this->SetFont('courier','B',8);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(230, 126, 34); // establece el color del fondo de la celda (en este caso es NARANJA)
    $this->Cell(35,5,'TOTAL INGRESOS',1,0,'C', True);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(60,5,$con[0]['simbolo'].number_format($TotalIngresos, 2, '.', ','),1,0,'C');
    $this->Ln();

    $this->SetFont('courier','B',8);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(230, 126, 34); // establece el color del fondo de la celda (en este caso es NARANJA)
    $this->Cell(35,5,'TOTAL EGRESOS',1,0,'C', True);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(60,5,$con[0]['simbolo'].number_format($TotalEgresos, 2, '.', ','),1,0,'C');
    $this->Ln();


    $this->Ln(12); 
    $this->SetFont('courier','B',9);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(120,6,'ELABORADO POR: '.utf8_decode($_SESSION["nivel"]."/".$_SESSION["nombres"]),0,0,'');
    $this->Cell(40,6,'RECIBIDO:_________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(120,6,'FECHA/HORA ELABORACI�N:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(40,6,'',0,0,'');
    $this->Ln(4);
     }
######################### FIN DE FUNCION LISTAR MOVIMIENTOS DE CAJAS ###############################

########################### FUNCION LISTAR INFORMES DE VENTAS #####################################
      function TablaListarInformeVentas()
   {
    //Logo
    $logo = "./assets/images/logo_dark.png";
    $logo2 = "./assets/images/logo_white_2.png";
    
    $con = new Login();
    $con = $con->ConfiguracionPorId();
    
    $venta = new Login();
    $venta = $venta->SumarVentas();

    $compra = new Login();
    $compra = $compra->SumarCompras();

    $ing = new Login();
    $ing = $ing->SumarIngresos();

    $egr = new Login();
    $egr = $egr->SumarEgresos();

    $abo = new Login();
    $abo = $abo->SumarAbonos();

    $car = new Login();
    $car = $car->SumarCarteraCreditos();

    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,22,$this->Image($logo, $this->GetX()+24, $this->GetY()+4, 22),5,0,'L');
    $this->Cell(105,8,'SISTEMA DE GESTI�N PARA RESTAURANTES',5,0,'C');
    $this->Cell(45,22,$this->Image($logo2, $this->GetX()-2, $this->GetY()+6, 34),5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-28,utf8_decode($con[0]['nomempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-20,'RUC: '.utf8_decode($con[0]['rifempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-12,'DIREC: '.utf8_decode($con[0]['direcempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-4,'N� DE TEL�FONO: '.utf8_decode($con[0]['tlfempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,4,'EMAIL: '.utf8_decode($con[0]['correoempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    $this->Ln(8);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(195,10,'INFORME GENERAL DE VENTAS DESDE '.$_GET["desde"].' HASTA '.$_GET["hasta"],0,0,'C');
    $this->Ln();

    $balance = $venta[0]['totalventa']-$venta[0]['totaliva']+$ing[0]['totalingresos']+$abo[0]['totalabonos'];
    $balance2 = $compra[0]['totalcomprageneral']+$egr[0]['totalegresos'];
    $balancegeneral = $balance-$balance2;

    $this->SetFont('courier','B',12);
    $this->Cell(100,8,'TOTAL DE VENTAS',1,0,'C', false);
    $this->Cell(90,8,utf8_decode($con[0]['simbolo'].number_format($venta[0]['totalventa'], 2, '.', ',')),1,0,'C');
    $this->Ln();


    $this->Cell(100,8,'TOTAL DE INGRESOS',1,0,'C', false);
    $this->Cell(90,8,utf8_decode($con[0]['simbolo'].number_format($ing[0]['totalingresos'], 2, '.', ',')),1,0,'C');
    $this->Ln();


    $this->Cell(100,8,'ABONOS A CR�DITOS',1,0,'C', false);
    $this->Cell(90,8,utf8_decode($con[0]['simbolo'].number_format($abo[0]['totalabonos'], 2, '.', ',')),1,1,'C');
    $this->Ln();
   

    $this->Cell(100,8,'TOTAL DE COMPRAS',1,0,'C', false);
    $this->Cell(90,8,utf8_decode($con[0]['simbolo'].number_format($compra[0]['totalcomprageneral'], 2, '.', ',')),1,0,'C');
    $this->Ln();

    $this->Cell(100,8,'TOTAL DE GASTOS (EGRESOS)',1,0,'C', false);
    $this->Cell(90,8,utf8_decode($con[0]['simbolo'].number_format($egr[0]['totalegresos'], 2, '.', ',')),1,0,'C');
    $this->Ln();

    $this->Cell(100,8,'CARTERA DE CLIENTES',1,0,'C', false);
    $this->Cell(90,8,utf8_decode($con[0]['simbolo'].number_format($car[0]['totaldebe']-$car[0]['totalabono'], 2, '.', ',')),1,1,'C');
    $this->Ln();
  
    $this->Cell(100,8,'TOTAL DE IMPUESTOS VENTAS IGV '.$con[0]['ivav'].'%',1,0,'C', false);
    $this->Cell(90,8,utf8_decode($con[0]['simbolo'].number_format($venta[0]['totaliva'], 2, '.', ',')),1,1,'C');
    $this->Ln();

    $this->Cell(100,8,'BALANCE GENERAL ',1,0,'C', false);
    $this->Cell(90,8,utf8_decode($con[0]['simbolo'].number_format($balancegeneral, 2, '.', ',')),1,0,'C');
    $this->Ln();

    $this->Cell(100,8,'UTILIDAD NETA',1,0,'C', false);
    $this->Cell(90,8,utf8_decode($con[0]['simbolo'].number_format($venta[0]['totalventa']-$venta[0]['totalcompra']-$venta[0]['totaliva'], 2, '.', ',')),1,0,'C');
    $this->Ln();


    $this->Ln(12); 
    $this->SetFont('courier','B',9);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(120,6,'ELABORADO POR: '.utf8_decode($_SESSION["nivel"]."/".$_SESSION["nombres"]),0,0,'');
    $this->Cell(40,6,'RECIBIDO:_________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(120,6,'FECHA/HORA ELABORACI�N:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(40,6,'',0,0,'');
    $this->Ln(4);
     }
########################### FIN DE FUNCION LISTAR INFORMES DE VENTAS ##########################


############################# FUNCION LISTAR INFORMES DE CAJAS ############################
      function TablaListarInformeCajas()
   {
    //Logo
    $logo = "./assets/images/logo_dark.png";
    $logo2 = "./assets/images/logo_white_2.png";
    
    $reg = new Login();
    $reg = $reg->CajerosPorId();

    $con = new Login();
    $con = $con->ConfiguracionPorId();
    
    $venta = new Login();
    $venta = $venta->SumarVentasCajas();

    $ing = new Login();
    $ing = $ing->SumarIngresosCajas();

    $egr = new Login();
    $egr = $egr->SumarEgresosCajas();


    $abo = new Login();
    $abo = $abo->SumarAbonosCajas();

    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,22,$this->Image($logo, $this->GetX()+24, $this->GetY()+4, 22),5,0,'L');
    $this->Cell(105,8,'SISTEMA DE GESTI�N PARA RESTAURANTES',5,0,'C');
    $this->Cell(45,22,$this->Image($logo2, $this->GetX()-2, $this->GetY()+6, 34),5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-28,utf8_decode($con[0]['nomempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-20,'RUC: '.utf8_decode($con[0]['rifempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-12,'DIREC: '.utf8_decode($con[0]['direcempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-4,'N� DE TEL�FONO: '.utf8_decode($con[0]['tlfempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,4,'EMAIL: '.utf8_decode($con[0]['correoempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    $this->Ln(8);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(195,6,'INFORME GENERAL DE CAJA '. $reg[0]['nombrecaja'],0,1,'C');
    $this->Cell(195,6,' DESDE '.$_GET["desde"].' HASTA '.$_GET["hasta"],0,0,'C');
    $this->Ln(8);

$balance = $venta[0]['totalventa']-$venta[0]['totaliva']+$ing[0]['totalingresos']+$abo[0]['totalabonos'];
$ganancias = $balance-$egr[0]['totalegresos'];


    $this->SetFont('courier','B',12);
    $this->Cell(100,8,'TOTAL DE VENTAS',1,0,'C', false);
    $this->Cell(80,8,utf8_decode($con[0]['simbolo'].number_format($venta[0]['totalventa'], 2, '.', ',')),1,0,'C');
    $this->Ln();

    //$con[0]['simbolo'].number_format($TotalIngresos, 2, '.', ',')

    $this->Cell(100,8,'TOTAL DE INGRESOS',1,0,'C', false);
    $this->Cell(80,8,utf8_decode($con[0]['simbolo'].number_format($ing[0]['totalingresos'], 2, '.', ',')),1,0,'C');
    $this->Ln();

    $this->Cell(100,8,'ABONOS A CR�DITOS',1,0,'C', false);
    $this->Cell(80,8,utf8_decode($con[0]['simbolo'].number_format($abo[0]['totalabonos'], 2, '.', ',')),1,1,'C');
    $this->Ln();
   

    $this->Cell(100,8,'TOTAL DE GASTOS (EGRESOS)',1,0,'C', false);
    $this->Cell(80,8,utf8_decode($con[0]['simbolo'].number_format($egr[0]['totalegresos'], 2, '.', ',')),1,1,'C');
    $this->Ln();
  
    $this->Cell(100,8,'TOTAL DE IMPUESTOS VENTAS IGV '.$con[0]['ivav'].'%',1,0,'C', false);
    $this->Cell(80,8,utf8_decode($con[0]['simbolo'].number_format($venta[0]['totaliva'], 2, '.', ',')),1,1,'C');
    $this->Ln();

    $this->Cell(100,8,'EFECTIVO EN CAJA SIN IGV ',1,0,'C', false);
    $this->Cell(80,8,utf8_decode($con[0]['simbolo'].number_format($ganancias, 2, '.', ',')),1,0,'C');
    $this->Ln();


    $this->Ln(12); 
    $this->SetFont('courier','B',9);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(120,6,'ELABORADO POR: '.utf8_decode($_SESSION["nivel"]."/".$_SESSION["nombres"]),0,0,'');
    $this->Cell(40,6,'RECIBIDO:_________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(120,6,'FECHA/HORA ELABORACI�N:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(40,6,'',0,0,'');
    $this->Ln(4);
     }
########################## FIN DE FUNCION LISTAR INFORMES DE CAJAS #################################

########################### FUNCION LISTAR DELIVERY PENDIENTES ##############################
      function TablaListarDelivery()
   {
    //Logo
    $logo = "./assets/images/logo_dark.png";
    $logo2 = "./assets/images/logo_white_2.png";
    
    $con = new Login();
    $con = $con->ConfiguracionPorId();
    $simbolo = $con[0]['simbolo']; 

    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,22,$this->Image($logo, $this->GetX()+88, $this->GetY()+4, 24),5,0,'L');
    $this->Cell(250,8,'SISTEMA DE GESTI�N PARA RESTAURANTES',5,0,'C');
    $this->Cell(45,22,$this->Image($logo2, $this->GetX()-72, $this->GetY()+6, 58),5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-28,utf8_decode($con[0]['nomempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-20,'RUC: '.utf8_decode($con[0]['rifempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-12,'DIREC: '.utf8_decode($con[0]['direcempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-4,'N� DE TEL�FONO: '.utf8_decode($con[0]['tlfempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,4,'EMAIL: '.utf8_decode($con[0]['correoempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    $this->Ln(8);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(350,10,'LISTADO GENERAL DE DELIVERY PENDIENTES',0,0,'C');
    
 if($_SESSION["acceso"] == 'repartidor'){

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(230, 126, 34); // establece el color del fondo de la celda (en este caso es NARANJA)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(65,8,'NOMBRES DE CLIENTES',1,0,'C', True);
    $this->Cell(80,8,'DIRECCI�N DE CLIENTES',1,0,'C', True);
    $this->Cell(145,8,'PLATILLOS',1,0,'C', True);
    $this->Cell(35,8,'TOTAL FACTURA',1,1,'C', True);
    
    $tra = new Login();
    $reg = $tra->ListarDelivery();

    if($reg==""){

    echo "";      
    
    } else {
 
    /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,65,80,145,35));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    $TotalFactura=0;
    for($i=0;$i<sizeof($reg);$i++){ 
    $TotalFactura+=$reg[$i]["totalpago"];
    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        utf8_decode($cliente = ( $reg[$i]['cliente'] == '0' ? "<span class='label label-warning'> SIN ASIGNAR</span>" : $reg[$i]['nomcliente'])),
        utf8_decode($reg[$i]["direccliente"]),
        utf8_decode($reg[$i]["detalles"]),
        utf8_decode($simbolo.number_format($reg[$i]["totalpago"], 2, '.', ','))));
       }
   } 

    $this->Cell(260,6,'',0,0,'C');
    $this->SetFont('courier','B',12);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(40,6,'TOTAL GENERAL',0,0,'C');
    $this->SetFont('courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(35,6,$simbolo.number_format($TotalFactura, 2, '.', ','),1,0,'C');
    $this->Ln();


    } else {

    $this->Ln();
    $this->SetFont('courier','B',10);
    $this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es BLANCO)
    $this->SetFillColor(230, 126, 34); // establece el color del fondo de la celda (en este caso es NARANJA)
    $this->Cell(10,8,'N�',1,0,'C', True);
    $this->Cell(65,8,'NOMBRES DE CLIENTES',1,0,'C', True);
    $this->Cell(70,8,'DIRECCI�N DE CLIENTES',1,0,'C', True);
    $this->Cell(125,8,'PLATILLOS',1,0,'C', True);
    $this->Cell(65,8,'REPARTIDOR',1,1,'C', True);
    
    $tra = new Login();
    $reg = $tra->ListarDelivery();

    if($reg==""){

    echo "";      
    
    } else {
 
    /* AQUI DECLARO LAS COLUMNAS */
    $this->SetWidths(array(10,65,70,125,65));

    /* AQUI AGREGO LOS VALORES A MOSTRAR EN COLUMNAS */
    $a=1;
    for($i=0;$i<sizeof($reg);$i++){ 
    $this->SetFont('Courier','',10);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Row(array($a++,
        utf8_decode($cliente = ( $reg[$i]['cliente'] == '0' ? "<span class='label label-warning'> SIN ASIGNAR</span>" : $reg[$i]['nomcliente'])),
        utf8_decode($reg[$i]["direccliente"]),
        utf8_decode($reg[$i]["detalles"]),
        utf8_decode($reg[$i]["nombres"])));
       }
   }
}

    $this->Ln(12); 
    $this->SetFont('courier','B',9);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO POR: '.utf8_decode($_SESSION["nivel"]."/".$_SESSION["nombres"]),0,0,'');
    $this->Cell(120,6,'RECIBIDO:__________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA ELABORACI�N:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(120,6,'',0,0,'');
    $this->Ln(4);
     }
######################## FIN DE FUNCION LISTAR DELIVERY PENDIENTES ######################

##################################### CLASE VENTAS DE PRODUCTOS #####################################








































############################## CLASE CREDITOS DE VENTAS ####################################

############################ FUNCION TICKET DE ABONOS DE CREDITOS ###########################

  function TablaTicketCreditos()
{

  $con = new Login();
$con = $con->ConfiguracionPorId();
$simbolo = $con[0]['simbolo'];

  $ve = new Login();
$ve = $ve->VentasPorId();

$this->SetFont('courier','B',14);
$this->SetFillColor(2,157,116);
$this->SetXY(4, 6);
$this->Cell(66, 5, "TICKET DE CR�DITO", 0 , 0, 'C');
$this->Ln(5);

$this->SetFont('courier','B',6.5);
$this->SetFillColor(2,157,116);
$this->SetXY(4, 11);
$this->CellFitSpace(65,3,utf8_decode($con[0]['direcempresa']),0,1,'C');
$this->SetXY(4, 13.5);
$this->CellFitSpace(65,3,"Nit:".utf8_decode($con[0]['rifempresa']),0,1,'C');
$this->SetXY(4, 16.5);
$this->CellFitSpace(65,3,utf8_decode($con[0]['nomempresa']),0,1,'C');
$this->SetXY(4, 19.5);
$this->CellFitSpace(65,3,"N� DE TLF:".utf8_decode($con[0]['tlfempresa']),0,1,'C');

$this->SetFont('courier','B',8);
$this->SetX(2);
$this->Cell(70,3,'---------------------------------------',0,0,'C');
$this->Ln(3);

$this->SetFont('courier','B',6.5);
$this->SetFillColor(2,157,116);
$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
$this->SetXY(3, 25);
$this->Cell(3, 5, "N� DE VENTA: ".utf8_decode($ve[0]['codventa']), 0 , 0);
$this->SetXY(3, 28);
$this->Cell(3, 5, "FECHA DE VENTA: ".utf8_decode($ve[0]['fechaventa']), 0 , 0);
$this->SetXY(3, 31);
$this->Cell(3, 5, "FECHA DE IMPRESI�N: ".date("Y-m-d h:i:s A ",time()+1800), 0 , 0);

$this->Ln(5);
$this->SetFont('courier','B',8);
$this->SetX(2);
$this->Cell(70,3,'--------------- CLIENTE ---------------',0,1,'C');

if($ve[0]['cliente']=="0"){

$this->SetFont('courier','B',6.5);
$this->SetX(3);
$this->Cell(3, 3, "CONSUMIDOR FINAL",0,0);

} else {

$this->SetFont('courier','B',6.5);
$this->SetX(3);
$this->Cell(3, 3,"Nit DE CLIENTE: ".utf8_decode($ve[0]['cedcliente']),0,1);
$this->SetX(3);
$this->Cell(3, 3, "NOMBRE DE CLIENTE: ".utf8_decode(getSubString($ve[0]['nomcliente'], 32)),0,0);

}

$this->Ln();
$this->SetFont('courier','B',8);
$this->SetX(2);
$this->Cell(70,3,'-------------- PRODUCTOS --------------',0,1,'C');
$this->Ln(1);


$this->SetX(4);
$this->SetFont('courier','B',7);
$this->SetTextColor(3, 3, 3); // Establece el color del texto (en este caso es Negro)
$this->SetFillColor(229, 229, 229); // establece el color del fondo de la celda (en este caso es GRIS)
$this->Cell(6,3,'CANT',0,0,'C');
$this->Cell(30,3,'DESCRIPCI�N',0,0,'C');
$this->Cell(15,3,'PRECIO',0,0,'C');
$this->Cell(15,3,'IMPORTE',0,1,'C');


$this->SetFont('courier','B',8);
$this->SetX(2);
$this->Cell(70,3,'---------------------------------------',0,0,'C');
$this->Ln(3);

$tra = new Login();
$reg = $tra->VerDetallesVentas();
$cantidad=0;
$a=1;
for($i=0;$i<sizeof($reg);$i++){

$this->SetX(4);
$this->SetFillColor(192);
$this->SetDrawColor(3,3,3);
$this->SetLineWidth(.2);
$this->SetFont('courier','',6);  
$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
$this->CellFitSpace(6,3,utf8_decode($reg[$i]['cantventa']),0,0,'C');
$this->CellFitSpace(30,3,utf8_decode(getSubString($reg[$i]["producto"], 22)),0,0,'C');
$this->CellFitSpace(15,3,utf8_decode($simbolo.number_format($reg[$i]["precioventa"], 2, '.', ',')),0,0,'C');
$this->CellFitSpace(15,3,utf8_decode($simbolo.number_format($reg[$i]["precioventa"]*$reg[$i]["cantventa"], 2, '.', ',')),0,0,'C');
$this->Ln();  
 }

$this->Ln(2);
$this->SetFont('courier','B',8);
$this->SetX(2);
$this->Cell(70,3,'---------------- PAGO -----------------',0,0,'C');
$this->Ln(3);

$this->SetX(4);
$this->SetFont('courier','B',8);
$this->CellFitSpace(40,3,"SUBTOTAL IGV ".$ve[0]["ivave"].'%:',0,0,'R');
$this->SetFont('courier','',8);
$this->CellFitSpace(25,3,utf8_decode($simbolo.number_format($ve[0]["subtotalivasive"], 2, '.', ',')),0,1,'R');

$this->SetX(4);
$this->SetFont('courier','B',8);
$this->CellFitSpace(40,3,"SUBTOTAL IGV 0%:",0,0,'R');
$this->SetFont('courier','',8);
$this->CellFitSpace(25,3,utf8_decode($simbolo.number_format($ve[0]["subtotalivanove"], 2, '.', ',')),0,1,'R');

$this->SetX(4);
$this->SetFont('courier','B',8);
$this->CellFitSpace(40,3,"IGV ".$ve[0]["ivave"].'%:',0,0,'R');
$this->SetFont('courier','',8);
$this->CellFitSpace(25,3,utf8_decode($simbolo.number_format($ve[0]["totalivave"], 2, '.', ',')),0,1,'R');

$this->SetX(4);
$this->SetFont('courier','B',8);
$this->CellFitSpace(40,3,"DESCUENTO ".$ve[0]["descuentove"].'%:',0,0,'R');
$this->SetFont('courier','',8);
$this->CellFitSpace(25,3,utf8_decode($simbolo.number_format($ve[0]["totaldescuentove"], 2, '.', ',')),0,1,'R');

$this->SetX(4);
$this->SetFont('courier','B',8);
$this->CellFitSpace(40,3,"TOTAL A PAGAR:",0,0,'R');
$this->SetFont('courier','',8);
$this->CellFitSpace(25,3,utf8_decode($simbolo.number_format($ve[0]["totalpago"], 2, '.', ',')),0,1,'R');
$this->Ln(1);

$this->SetFont('courier','B',8);
$this->SetX(2);
$this->Cell(70,3,'------------- MEDIO PAGO --------------',0,1,'C');
$this->Ln(1);

  if($ve[0]['tipopagove']=="CREDITO"){

  $this->SetX(4);
  $this->SetFont('courier','B',8);
  $this->CellFitSpace(40,3,"TIPO PAGO:",0,0,'R');
  $this->SetFont('courier','',8);
  $this->CellFitSpace(25,3,utf8_decode($ve[0]["tipopagove"]),0,1,'R');

  $this->SetX(4);
  $this->SetFont('courier','B',8);
  $this->CellFitSpace(40,3,"STATUS PAGO:",0,0,'R');
  $this->SetFont('courier','',8);
  if($ve[0]['fechavencecredito']== '0000-00-00') { 
  $this->CellFitSpace(25,3,utf8_decode($ve[0]["statusventa"]),0,1,'R');
  } elseif($ve[0]['fechavencecredito'] >= date("Y-m-d")) { 
  $this->CellFitSpace(25,3,utf8_decode($ve[0]["statusventa"]),0,1,'R');
  } elseif($ve[0]['fechavencecredito'] < date("Y-m-d")) { 
  $this->CellFitSpace(25,3,utf8_decode("VENCIDA"),0,1,'R');
  } 

  $this->SetX(4);
  $this->SetFont('courier','B',8);
  $this->CellFitSpace(40,3,"FECHA VENC:",0,0,'R');
  $this->SetFont('courier','',8);
  $this->CellFitSpace(25,3,utf8_decode($ve[0]["fechavencecredito"]),0,1,'R');

  $this->SetX(4);
  $this->SetFont('courier','B',8);
  $this->CellFitSpace(40,3,"DIAS VENCIDOS:",0,0,'R');
  $this->SetFont('courier','',8);
  if($ve[0]['fechavencecredito']== '0000-00-00') { 
  $this->CellFitSpace(25,3,utf8_decode("0"),0,1,'R');
  } elseif($ve[0]['fechavencecredito'] >= date("Y-m-d")) { 
  $this->CellFitSpace(25,3,utf8_decode("0"),0,1,'R');
  } elseif($ve[0]['fechavencecredito'] < date("Y-m-d")) { 
  $this->CellFitSpace(25,3,utf8_decode(Dias_Transcurridos(date("Y-m-d"),$ve[0]['fechavencecredito'])),0,1,'R');
  }

  $this->SetX(4);
  $this->SetFont('courier','B',8);
  $this->CellFitSpace(40,3,"TOTAL ABONO:",0,0,'R');
  $this->SetFont('courier','',8);
  $this->CellFitSpace(25,3,utf8_decode(number_format($ve[0]["abonototal"], 2, '.', ',')),0,1,'R');

  $this->SetX(4);
  $this->SetFont('courier','B',8);
  $this->CellFitSpace(40,3,"TOTAL DEBE:",0,0,'R');
  $this->SetFont('courier','',8);
  $this->CellFitSpace(25,3,utf8_decode(number_format($ve[0]["totalpago"]-$ve[0]["abonototal"], 2, '.', ',')),0,1,'R');
  $this->Ln(1);

} else {

  $this->SetX(4);
  $this->SetFont('courier','B',8);
  $this->CellFitSpace(40,3,"TIPO PAGO:",0,0,'R');
  $this->SetFont('courier','',8);
  $this->CellFitSpace(25,3,utf8_decode($ve[0]["tipopagove"]),0,1,'R');

  $this->SetX(4);
  $this->CellFitSpace(65,3,utf8_decode($ve[0]["mediopago"]),0,1,'R');

  $this->SetX(4);
  $this->SetFont('courier','B',8);
  $this->CellFitSpace(40,3,"EFECTIVO:",0,0,'R');
  $this->SetFont('courier','',8);
  $this->CellFitSpace(25,3,utf8_decode(number_format($ve[0]["montopagado"], 2, '.', ',')),0,1,'R');

  $this->SetX(4);
  $this->SetFont('courier','B',8);
  $this->CellFitSpace(40,3,"CAMBIO:",0,0,'R');
  $this->SetFont('courier','',8);
  $this->CellFitSpace(25,3,utf8_decode(number_format($ve[0]["montodevuelto"], 2, '.', ',')),0,1,'R');
  $this->Ln(1);

}

  $this->SetFont('courier','B',8);
  $this->SetX(2);
  $this->Cell(70,3,'-------- INFORMACI�N ADICIONAL --------',0,1,'C');
  $this->Ln(1);

  $this->SetFont('courier','B',7);
  $this->SetX(4);
  $this->Cell(60, 3,"CAJERO: ".utf8_decode($ve[0]['nombres']),0,1,'C');
  $this->Ln(5);

  $this->SetFont('courier','B',8);
  $this->SetX(2);
  $this->Cell(70,3,'FIRMA: ------------------------------',0,1,'C');
  $this->Ln(4);


  $this->SetFont('courier','B',8);
  $this->SetX(2);
  $this->Cell(70,0.5,'---------------------------------------',0,1,'C');
  $this->SetX(2);
  $this->Cell(70,0.5,'---------------------------------------',0,1,'C');
  $this->Ln(3);
          
  $this->SetFont('courier','BI',8);
  $this->SetX(4);
  $this->SetFillColor(3, 3, 3);
  $this->CellFitSpace(65,3,"GRACIAS POR PREFERIRNOS",0,1,'C');

  $this->Ln(3);
  $this->SetX(4);
  $this->Ln(7);
  $logo = "./assets/images/barcode.png";
  $this->Cell(4,10,$this->Image($logo, $this->GetX()-4, $this->GetY()-7, 65),5,0,'C');
  $this->Ln(2);

  $this->Codabar(6,-90,utf8_decode("111111222222333333444444555555666666777777888888999999"));

}
####################### FIN DE FUNCION TICKET DE ABONOS DE CREDITOS ###########################

########################## FUNCION LISTAR CREDITOS POR CLIENTES ###########################
	  function TablaCreditosClientes()
   {
    //Logo
    $logo = "./assets/images/logo_dark.png";
    $logo2 = "./assets/images/logo_white_2.png";
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 
    
    $tra = new Login();
    $reg = $tra->BuscarClientesAbonos();

    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,22,$this->Image($logo, $this->GetX()+24, $this->GetY()+4, 22),5,0,'L');
    $this->Cell(105,8,'SISTEMA DE GESTI�N PARA RESTAURANTES',5,0,'C');
    $this->Cell(45,22,$this->Image($logo2, $this->GetX()-2, $this->GetY()+6, 34),5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-28,utf8_decode($con[0]['nomempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-20,'RUC: '.utf8_decode($con[0]['rifempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-12,'DIREC: '.utf8_decode($con[0]['direcempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,-4,'N� DE TEL�FONO: '.utf8_decode($con[0]['tlfempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(105,4,'EMAIL: '.utf8_decode($con[0]['correoempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    $this->Ln(8);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
$this->Cell(195,10,'CR�DITOS DEL CLIENTE '.utf8_decode($reg[0]['cedcliente'].": ".$reg[0]['nomcliente']),0,0,'C');
    
    $this->Ln();
	$this->SetFont('courier','B',9);
	$this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(230, 126, 34); // establece el color del fondo de la celda (en este caso es NARANJA)
	$this->CellFitSpace(8,8,'N�',1,0,'C', True);
	$this->CellFitSpace(30,8,'N� DE VENTA',1,0,'C', True);
	$this->CellFitSpace(18,8,'N� CAJA',1,0,'C', True);
	$this->CellFitSpace(17,8,'STATUS',1,0,'C', True);
	$this->CellFitSpace(20,8,'DIAS VENC',1,0,'C', True);
	$this->CellFitSpace(26,8,'FECHA VENTA',1,0,'C', True);
	$this->CellFitSpace(25,8,'TOT FACTURA',1,0,'C', True);
	$this->CellFitSpace(25,8,'TOT ABONO',1,0,'C', True);
	$this->CellFitSpace(20,8,'TOT DEBE',1,1,'C', True);
	
    $TotalFactura=0;
	$TotalCredito=0;
	$TotalDebe=0;
	$a=1;
	for($i=0;$i<sizeof($reg);$i++){  
	$TotalFactura+=$reg[$i]['totalpago'];
	$TotalCredito+=$reg[$i]['abonototal'];
	$TotalDebe+=$reg[$i]['totalpago']-$reg[$i]['abonototal'];

	$this->SetFont('courier','',9);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(8,5,$a++,1,0,'C');
	$this->CellFitSpace(30,5,$reg[$i]["codventa"],1,0,'C');
    $this->CellFitSpace(18,5,$reg[$i]['nrocaja'],1,0,'C');
	
	
	if($reg[$i]['fechavencecredito']== '0000-00-00') { 
	$this->CellFitSpace(17, 5,utf8_decode($reg[$i]['statusventa']),1,0,'C');
	} elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d")) { 
	$this->CellFitSpace(17, 5,utf8_decode($reg[$i]['statusventa']),1,0,'C');
	} elseif($reg[$i]['fechavencecredito'] < date("Y-m-d")) { 
	$this->CellFitSpace(17, 5,utf8_decode("VENCIDA"),1,0,'C');
	}	
	if($reg[$i]['fechavencecredito']== '0000-00-00') { 
	$this->CellFitSpace(20, 5,utf8_decode("0"),1,0,'C');
	} elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d")) { 
	$this->CellFitSpace(20, 5,utf8_decode("0"),1,0,'C');
	} elseif($reg[$i]['fechavencecredito'] < date("Y-m-d")) { 
	$this->CellFitSpace(20, 5,utf8_decode(Dias_Transcurridos(date("Y-m-d"),$reg[$i]['fechavencecredito'])),1,0,'C');
	}
	$this->CellFitSpace(26,5,date("d-m-Y h:i:s",strtotime($reg[$i]['fechaventa'])),1,0,'C');
    $this->CellFitSpace(25,5,$con[0]['simbolo'].number_format($reg[$i]['totalpago'], 2, '.', ','),1,0,'C');
	$this->CellFitSpace(25,5,$con[0]['simbolo'].number_format($reg[$i]['abonototal'], 2, '.', ','),1,0,'C');
	$this->CellFitSpace(20,5,$con[0]['simbolo'].number_format($reg[$i]['totalpago']-$reg[$i]['abonototal'], 2, '.', ','),1,0,'C');
    $this->Ln();
	
   } 
   
	$this->Cell(8,5,'',0,0,'C');
    $this->Cell(30,5,'',0,0,'C');
    $this->Cell(18,5,'',0,0,'C');
    $this->Cell(17,5,'',0,0,'C'); 
    $this->Cell(20,5,'',0,0,'C');
    $this->SetFont('courier','B',12);
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(26,5,'TOTAL GENERAL',0,0,'C');	
    $this->SetFont('courier','B',9);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(25,5,utf8_decode($con[0]['simbolo'].number_format($TotalFactura, 2, '.', ',')),1,0,'C');
    $this->Cell(25,5,utf8_decode($con[0]['simbolo'].number_format($TotalCredito, 2, '.', ',')),1,0,'C');
    $this->Cell(20,5,utf8_decode($con[0]['simbolo'].number_format($TotalDebe, 2, '.', ',')),1,0,'C');
    $this->Ln();


    $this->Ln(12); 
    $this->SetFont('courier','B',9);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(120,6,'ELABORADO POR: '.utf8_decode($_SESSION["nivel"]."/".$_SESSION["nombres"]),0,0,'');
    $this->Cell(40,6,'RECIBIDO:_________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(120,6,'FECHA/HORA ELABORACI�N:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(40,6,'',0,0,'');
    $this->Ln(4);
     }
	

################################# FIN DE FUNCION LISTAR CREDITOS POR CLIENTES ##############################

################################# FUNCION LISTAR CREDITOS POR FECHAS #################################
	  function TablaCreditosFechas()
   {
    //Logo
    $logo = "./assets/images/logo_dark.png";
    $logo2 = "./assets/images/logo_white_2.png";
    
    $con = new Login();
    $con = $con->ConfiguracionPorId(); 

    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,22,$this->Image($logo, $this->GetX()+88, $this->GetY()+4, 24),5,0,'L');
    $this->Cell(250,8,'SISTEMA DE GESTI�N PARA RESTAURANTES',5,0,'C');
    $this->Cell(45,22,$this->Image($logo2, $this->GetX()-72, $this->GetY()+6, 58),5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-28,utf8_decode($con[0]['nomempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-20,'RUC: '.utf8_decode($con[0]['rifempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-12,'DIREC: '.utf8_decode($con[0]['direcempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,-4,'N� DE TEL�FONO: '.utf8_decode($con[0]['tlfempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    
    $this->Ln();
    $this->SetFont('Courier','B',10);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(5, 130, 275); // establece el color del fondo de la celda (en este caso es AZUL
    $this->Cell(45,0,'',5,0,'L');
    $this->Cell(250,4,'EMAIL: '.utf8_decode($con[0]['correoempresa']),5,0,'C');
    $this->Cell(45,0,'',5,0,'L');
    $this->Ln(8);
    
    $this->SetFont('Courier','B',14);  
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(350,10,'LISTADO DE CR�DITOS DESDE '.$_GET["desde"].' HASTA '.$_GET["hasta"],0,0,'C');
    
    $this->Ln();
	$this->SetFont('courier','B',9);
	$this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->SetFillColor(230, 126, 34); // establece el color del fondo de la celda (en este caso es NARANJA)
	$this->CellFitSpace(8,8,'N�',1,0,'C', True);
	$this->CellFitSpace(30,8,'Nit',1,0,'C', True);
	$this->CellFitSpace(75,8,'NOMBRE CLIENTE',1,0,'C', True);
	$this->CellFitSpace(20,8,'N� CAJA',1,0,'C', True);
	$this->CellFitSpace(20,8,'STATUS',1,0,'C', True);
	$this->CellFitSpace(20,8,'DIAS VENC',1,0,'C', True);
	$this->CellFitSpace(30,8,'N� DE VENTA',1,0,'C', True);
	$this->CellFitSpace(35,8,'FECHA VENTA',1,0,'C', True);
	$this->CellFitSpace(30,8,'TOTAL FACTURA',1,0,'C', True);
	$this->CellFitSpace(30,8,'TOTAL ABONO',1,0,'C', True);
	$this->CellFitSpace(30,8,'TOTAL DEBE',1,1,'C', True);
	
   	$tra = new Login();
    $reg = $tra->BuscarCreditosFechas(); 
	$TotalFactura=0;
	$TotalCredito=0;
	$TotalDebe=0;
	$a=1;
	for($i=0;$i<sizeof($reg);$i++){  
	$TotalFactura+=$reg[$i]['totalpago'];
	$TotalCredito+=$reg[$i]['abonototal'];
	$TotalDebe+=$reg[$i]['totalpago']-$reg[$i]['abonototal'];

	$this->SetFont('courier','',8);  
	$this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es negro)
    $this->Cell(8,5,$a++,1,0,'C');
   if($reg[$i]['cedcliente']== '') {
    $this->CellFitSpace(30,5,"SIN ASIGNAR",1,0,'C');
   } else {
    $this->CellFitSpace(30,5,$reg[$i]['cedcliente'],1,0,'C');
   }
   if($reg[$i]['nomcliente']== '') {
    $this->CellFitSpace(75,5,"SIN ASIGNAR",1,0,'C');
   } else {
    $this->CellFitSpace(75,5,$reg[$i]['nomcliente'],1,0,'C');
   }
	$this->CellFitSpace(20,5,$reg[$i]['nrocaja'],1,0,'C');
	if($reg[$i]['fechavencecredito']== '0000-00-00') { 
	$this->Cell(20, 5,utf8_decode($reg[$i]['statusventa']),1,0,'C');
	} elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d")) { 
	$this->CellFitSpace(20, 5,utf8_decode($reg[$i]['statusventa']),1,0,'C');
	} elseif($reg[$i]['fechavencecredito'] < date("Y-m-d")) { 
	$this->CellFitSpace(20, 5,utf8_decode("VENCIDA"),1,0,'C');
	}	
	if($reg[$i]['fechavencecredito']== '0000-00-00') { 
	$this->CellFitSpace(20, 5,utf8_decode("0"),1,0,'C');
	} elseif($reg[$i]['fechavencecredito'] >= date("Y-m-d")) { 
	$this->CellFitSpace(20, 5,utf8_decode("0"),1,0,'C');
	} elseif($reg[$i]['fechavencecredito'] < date("Y-m-d")) { 
	$this->CellFitSpace(20, 5,utf8_decode(Dias_Transcurridos(date("Y-m-d"),$reg[$i]['fechavencecredito'])),1,0,'C');
	}
	$this->CellFitSpace(30,5,$reg[$i]["codventa"],1,0,'C');
	$this->CellFitSpace(35,5,date("d-m-Y h:i:s",strtotime($reg[$i]['fechaventa'])),1,0,'C');
    $this->CellFitSpace(30,5,$con[0]['simbolo'].number_format($reg[$i]['totalpago'], 2, '.', ','),1,0,'C');
	$this->CellFitSpace(30,5,$con[0]['simbolo'].number_format($reg[$i]['abonototal'], 2, '.', ','),1,0,'C');
	$this->CellFitSpace(30,5,$con[0]['simbolo'].number_format($reg[$i]['totalpago']-$reg[$i]['abonototal'], 2, '.', ','),1,0,'C');
    $this->Ln();
	
   } 
   
    $this->Cell(203,5,'',0,0,'C');	
    $this->SetFont('courier','B',9);
	$this->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(35,5,'TOTAL GENERAL',1,0,'C', True);
    $this->SetFont('courier','B',7);
    $this->SetTextColor(3,3,3);  // Establece el color del texto (en este caso es blanco)
    $this->Cell(30,5,utf8_decode($con[0]['simbolo'].number_format($TotalFactura, 2, '.', ',')),1,0,'C');
    $this->Cell(30,5,utf8_decode($con[0]['simbolo'].number_format($TotalCredito, 2, '.', ',')),1,0,'C');
    $this->Cell(30,5,utf8_decode($con[0]['simbolo'].number_format($TotalDebe, 2, '.', ',')),1,0,'C');
    $this->Ln();

    $this->Ln(12); 
    $this->SetFont('courier','B',9);
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'ELABORADO POR: '.utf8_decode($_SESSION["nivel"]."/".$_SESSION["nombres"]),0,0,'');
    $this->Cell(120,6,'RECIBIDO:__________________________________',0,0,'');
    $this->Ln();
    $this->Cell(5,6,'',0,0,'');
    $this->Cell(200,6,'FECHA/HORA ELABORACI�N:  '.date('d-m-Y h:i:s A'),0,0,'');
    $this->Cell(120,6,'',0,0,'');
    $this->Ln(4);
     }
	

########################### FIN DE FUNCION LISTAR CREDITOS POR FECHAS ##################################

################################# CLASE CREDITOS DE VENTAS ####################################








































































































   
############################## AQUI COMIENZA CODIGO PARA AJUSTAR TEXTO #####################################

########### FUNCION PARA CODIGO DE BARRA CON CODE39 ############
function Code39($x, $y, $code, $ext = true, $cks = false, $w = 0.3, $h = 8, $wide = true) {

    //Display code
    $this->SetFont('Arial', '', 0.1);
    $this->Text($x, $y+$h+4, $code);

    if($ext) {
        //Extended encoding
        $code = $this->encode_code39_ext($code);
    }
    else {
        //Convert to upper case
        $code = strtoupper($code);
        //Check validity
        if(!preg_match('|^[0-9A-Z. $/+%-]*$|', $code))
            $this->Error('Invalid barcode value: '.$code);
    }

    //Compute checksum
    if ($cks)
        $code .= $this->checksum_code39($code);

    //Add start and stop characters
    $code = '*'.$code.'*';

    //Conversion tables
    $narrow_encoding = array (
        '0' => '101001101101', '1' => '110100101011', '2' => '101100101011', 
        '3' => '110110010101', '4' => '101001101011', '5' => '110100110101', 
        '6' => '101100110101', '7' => '101001011011', '8' => '110100101101', 
        '9' => '101100101101', 'A' => '110101001011', 'B' => '101101001011', 
        'C' => '110110100101', 'D' => '101011001011', 'E' => '110101100101', 
        'F' => '101101100101', 'G' => '101010011011', 'H' => '110101001101', 
        'I' => '101101001101', 'J' => '101011001101', 'K' => '110101010011', 
        'L' => '101101010011', 'M' => '110110101001', 'N' => '101011010011', 
        'O' => '110101101001', 'P' => '101101101001', 'Q' => '101010110011', 
        'R' => '110101011001', 'S' => '101101011001', 'T' => '101011011001', 
        'U' => '110010101011', 'V' => '100110101011', 'W' => '110011010101', 
        'X' => '100101101011', 'Y' => '110010110101', 'Z' => '100110110101', 
        '-' => '100101011011', '.' => '110010101101', ' ' => '100110101101', 
        '*' => '100101101101', '$' => '100100100101', '/' => '100100101001', 
        '+' => '100101001001', '%' => '101001001001' );

    $wide_encoding = array (
        '0' => '101000111011101', '1' => '111010001010111', '2' => '101110001010111', 
        '3' => '111011100010101', '4' => '101000111010111', '5' => '111010001110101', 
        '6' => '101110001110101', '7' => '101000101110111', '8' => '111010001011101', 
        '9' => '101110001011101', 'A' => '111010100010111', 'B' => '101110100010111', 
        'C' => '111011101000101', 'D' => '101011100010111', 'E' => '111010111000101', 
        'F' => '101110111000101', 'G' => '101010001110111', 'H' => '111010100011101', 
        'I' => '101110100011101', 'J' => '101011100011101', 'K' => '111010101000111', 
        'L' => '101110101000111', 'M' => '111011101010001', 'N' => '101011101000111', 
        'O' => '111010111010001', 'P' => '101110111010001', 'Q' => '101010111000111', 
        'R' => '111010101110001', 'S' => '101110101110001', 'T' => '101011101110001', 
        'U' => '111000101010111', 'V' => '100011101010111', 'W' => '111000111010101', 
        'X' => '100010111010111', 'Y' => '111000101110101', 'Z' => '100011101110101', 
        '-' => '100010101110111', '.' => '111000101011101', ' ' => '100011101011101', 
        '*' => '100010111011101', '$' => '100010001000101', '/' => '100010001010001', 
        '+' => '100010100010001', '%' => '101000100010001');

    $encoding = $wide ? $wide_encoding : $narrow_encoding;

    //Inter-character spacing
    $gap = ($w > 0.09) ? '00' : '0';

    //Convert to bars
    $encode = '';
    for ($i = 0; $i< strlen($code); $i++)
        $encode .= $encoding[$code[$i]].$gap;

    //Draw bars
    $this->draw_code39($encode, $x, $y, $w, $h);
}

function checksum_code39($code) {

    //Compute the modulo 43 checksum

    $chars = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 
                            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 
                            'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 
                            'W', 'X', 'Y', 'Z', '-', '.', ' ', '$', '/', '+', '%');
    $sum = 0;
    for ($i=0 ; $i<strlen($code); $i++) {
        $a = array_keys($chars, $code[$i]);
        $sum += $a[0];
    }
    $r = $sum % 43;
    return $chars[$r];
}

function encode_code39_ext($code) {

    //Encode characters in extended mode

    $encode = array(
        chr(0) => '%U', chr(1) => '$A', chr(2) => '$B', chr(3) => '$C', 
        chr(4) => '$D', chr(5) => '$E', chr(6) => '$F', chr(7) => '$G', 
        chr(8) => '$H', chr(9) => '$I', chr(10) => '$J', chr(11) => '�K', 
        chr(12) => '$L', chr(13) => '$M', chr(14) => '$N', chr(15) => '$O', 
        chr(16) => '$P', chr(17) => '$Q', chr(18) => '$R', chr(19) => '$S', 
        chr(20) => '$T', chr(21) => '$U', chr(22) => '$V', chr(23) => '$W', 
        chr(24) => '$X', chr(25) => '$Y', chr(26) => '$Z', chr(27) => '%A', 
        chr(28) => '%B', chr(29) => '%C', chr(30) => '%D', chr(31) => '%E', 
        chr(32) => ' ', chr(33) => '/A', chr(34) => '/B', chr(35) => '/C', 
        chr(36) => '/D', chr(37) => '/E', chr(38) => '/F', chr(39) => '/G', 
        chr(40) => '/H', chr(41) => '/I', chr(42) => '/J', chr(43) => '/K', 
        chr(44) => '/L', chr(45) => '-', chr(46) => '.', chr(47) => '/O', 
        chr(48) => '0', chr(49) => '1', chr(50) => '2', chr(51) => '3', 
        chr(52) => '4', chr(53) => '5', chr(54) => '6', chr(55) => '7', 
        chr(56) => '8', chr(57) => '9', chr(58) => '/Z', chr(59) => '%F', 
        chr(60) => '%G', chr(61) => '%H', chr(62) => '%I', chr(63) => '%J', 
        chr(64) => '%V', chr(65) => 'A', chr(66) => 'B', chr(67) => 'C', 
        chr(68) => 'D', chr(69) => 'E', chr(70) => 'F', chr(71) => 'G', 
        chr(72) => 'H', chr(73) => 'I', chr(74) => 'J', chr(75) => 'K', 
        chr(76) => 'L', chr(77) => 'M', chr(78) => 'N', chr(79) => 'O', 
        chr(80) => 'P', chr(81) => 'Q', chr(82) => 'R', chr(83) => 'S', 
        chr(84) => 'T', chr(85) => 'U', chr(86) => 'V', chr(87) => 'W', 
        chr(88) => 'X', chr(89) => 'Y', chr(90) => 'Z', chr(91) => '%K', 
        chr(92) => '%L', chr(93) => '%M', chr(94) => '%N', chr(95) => '%O', 
        chr(96) => '%W', chr(97) => '+A', chr(98) => '+B', chr(99) => '+C', 
        chr(100) => '+D', chr(101) => '+E', chr(102) => '+F', chr(103) => '+G', 
        chr(104) => '+H', chr(105) => '+I', chr(106) => '+J', chr(107) => '+K', 
        chr(108) => '+L', chr(109) => '+M', chr(110) => '+N', chr(111) => '+O', 
        chr(112) => '+P', chr(113) => '+Q', chr(114) => '+R', chr(115) => '+S', 
        chr(116) => '+T', chr(117) => '+U', chr(118) => '+V', chr(119) => '+W', 
        chr(120) => '+X', chr(121) => '+Y', chr(122) => '+Z', chr(123) => '%P', 
        chr(124) => '%Q', chr(125) => '%R', chr(126) => '%S', chr(127) => '%T');

    $code_ext = '';
    for ($i = 0 ; $i<strlen($code); $i++) {
        if (ord($code[$i]) > 127)
            $this->Error('Invalid character: '.$code[$i]);
        $code_ext .= $encode[$code[$i]];
    }
    return $code_ext;
}

function draw_code39($code, $x, $y, $w, $h) {

    //Draw bars

    for($i=0; $i<strlen($code); $i++) {
        if($code[$i] == '1')
            $this->Rect($x+$i*$w, $y, $w, $h, 'F');
    }
}


########### FUNCION PARA CODIGO DE BARRA CON EAN13 ############
function EAN13($x, $y, $barcode, $h=16, $w=.35)
{
 $this->Barcode($x,$y,$barcode,$h,$w,13);
}
function UPC_A($x, $y, $barcode, $h=16, $w=.35)
{
 $this->Barcode($x,$y,$barcode,$h,$w,12);
}
function GetCheckDigit($barcode)
{
 //Compute the check digit
 $sum=0;
 for($i=1;$i<=11;$i+=2)
 $sum+=3*$barcode[$i];
 for($i=0;$i<=10;$i+=2)
 $sum+=$barcode[$i];
 $r=$sum%10;
 if($r>0)
 $r=10-$r;
 return $r;
}
function TestCheckDigit($barcode)
{
 //Test validity of check digit
 $sum=0;
 for($i=1;$i<=11;$i+=2)
 $sum+=3*$barcode[$i];
 for($i=0;$i<=10;$i+=2)
 $sum+=$barcode[$i];
 return ($sum+$barcode[12])%10==0;
}
function Barcode($x, $y, $barcode, $h, $w, $len)
{
 //Padding
 $barcode=str_pad($barcode,$len-1,'0',STR_PAD_LEFT);
 if($len==12)
 $barcode='0'.$barcode;
 //Add or control the check digit
 if(strlen($barcode)==12)
 $barcode.=$this->GetCheckDigit($barcode);
 elseif(!$this->TestCheckDigit($barcode))
 $this->Error('Incorrect check digit');
 //Convert digits to bars
 $codes=array(
 'A'=>array(
 '0'=>'0001101','1'=>'0011001','2'=>'0010011','3'=>'0111101','4'=>'0100011',
 '5'=>'0110001','6'=>'0101111','7'=>'0111011','8'=>'0110111','9'=>'0001011'),
 'B'=>array(
 '0'=>'0100111','1'=>'0110011','2'=>'0011011','3'=>'0100001','4'=>'0011101',
 '5'=>'0111001','6'=>'0000101','7'=>'0010001','8'=>'0001001','9'=>'0010111'),
 'C'=>array(
 '0'=>'1110010','1'=>'1100110','2'=>'1101100','3'=>'1000010','4'=>'1011100',
 '5'=>'1001110','6'=>'1010000','7'=>'1000100','8'=>'1001000','9'=>'1110100')
 );
 $parities=array(
 '0'=>array('A','A','A','A','A','A'),
 '1'=>array('A','A','B','A','B','B'),
 '2'=>array('A','A','B','B','A','B'),
 '3'=>array('A','A','B','B','B','A'),
 '4'=>array('A','B','A','A','B','B'),
 '5'=>array('A','B','B','A','A','B'),
 '6'=>array('A','B','B','B','A','A'),
 '7'=>array('A','B','A','B','A','B'),
 '8'=>array('A','B','A','B','B','A'),
 '9'=>array('A','B','B','A','B','A')
 );
 $code='101';
 $p=$parities[$barcode[0]];
 for($i=1;$i<=6;$i++)
 $code.=$codes[$p[$i-1]][$barcode[$i]];
 $code.='01010';
 for($i=7;$i<=12;$i++)
 $code.=$codes['C'][$barcode[$i]];
 $code.='101';
 //Draw bars
 for($i=0;$i<strlen($code);$i++)
 {
 if($code[$i]=='1')
 $this->Rect($x+$i*$w,$y,$w,$h,'F');
 }
 //Print text uder barcode
 $this->SetFont('Arial','',12);
 $this->Text($x,$y+$h+11/$this->k,substr($barcode,-$len));
}




########### FUNCION PARA CREAR MULTICELL SIN SALTO DE LINEA ############
function SetWidths($w)
{
//Set the array of column widths
$this->widths=$w;
}

function SetAligns($a)
{
//Set the array of column alignments
$this->aligns=$a;
}

function Row($data)
{
//Calculate the height of the row
$nb=0;
for($i=0;$i<count($data);$i++)
$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
$h=5*$nb;
//Issue a page break first if needed
$this->CheckPageBreak($h);
//Draw the cells of the row
for($i=0;$i<count($data);$i++)
{
$w=$this->widths[$i];
$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
//Save the current position
$x=$this->GetX();
$y=$this->GetY();
//Draw the border
$this->Rect($x,$y,$w,$h);
//Print the text
$this->MultiCell($w,5,$data[$i],0,$a);
//Put the position to the right of the cell
$this->SetXY($x+$w,$y);
}
//Go to the next line
$this->Ln($h);
}

function CheckPageBreak($h)
{
//If the height h would cause an overflow, add a new page immediately
if($this->GetY()+$h>$this->PageBreakTrigger)
$this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
//Computes the number of lines a MultiCell of width w will take
$cw=&$this->CurrentFont['cw'];
if($w==0)
$w=$this->w-$this->rMargin-$this->x;
$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
$s=str_replace("\r",'',$txt);
$nb=strlen($s);
if($nb>0 and $s[$nb-1]=="\n")
$nb--;
$sep=-1;
$i=0;
$j=0;
$l=0;
$nl=1;
while($i<$nb)
{
$c=$s[$i];
if($c=="\n")
{
$i++;
$sep=-1;
$j=$i;
$l=0;
$nl++;
continue;
}
if($c==' ')
$sep=$i;
$l+=$cw[$c];
if($l>$wmax)
{
if($sep==-1)
{
if($i==$j)
$i++;
}
else
$i=$sep+1;
$sep=-1;
$j=$i;
$l=0;
$nl++;
}
else
$i++;
}
return $nl;
}
########### FUNCION PARA CREAR MULTICELL SIN SALTO DE LINEA ############

function GetMultiCellHeight($w, $h, $txt, $border=null, $align='J') {
    // Calculate MultiCell with automatic or explicit line breaks height
    // $border is un-used, but I kept it in the parameters to keep the call
    //   to this function consistent with MultiCell()
    $cw = &$this->CurrentFont['cw'];
    if($w==0)
        $w = $this->w-$this->rMargin-$this->x;
    $wmax = ($w-2*$this->cMargin)*1000/$this->FontSize;
    $s = str_replace("\r",'',$txt);
    $nb = strlen($s);
    if($nb>0 && $s[$nb-1]=="\n")
        $nb--;
    $sep = -1;
    $i = 0;
    $j = 0;
    $l = 0;
    $ns = 0;
    $height = 0;
    while($i<$nb)
    {
        // Get next character
        $c = $s[$i];
        if($c=="\n")
        {
            // Explicit line break
            if($this->ws>0)
            {
                $this->ws = 0;
                $this->_out('0 Tw');
            }
            //Increase Height
            $height += $h;
            $i++;
            $sep = -1;
            $j = $i;
            $l = 0;
            $ns = 0;
            continue;
        }
        if($c==' ')
        {
            $sep = $i;
            $ls = $l;
            $ns++;
        }
        $l += $cw[$c];
        if($l>$wmax)
        {
            // Automatic line break
            if($sep==-1)
            {
                if($i==$j)
                    $i++;
                if($this->ws>0)
                {
                    $this->ws = 0;
                    $this->_out('0 Tw');
                }
                //Increase Height
                $height += $h;
            }
            else
            {
                if($align=='J')
                {
                    $this->ws = ($ns>1) ? ($wmax-$ls)/1000*$this->FontSize/($ns-1) : 0;
                    $this->_out(sprintf('%.3F Tw',$this->ws*$this->k));
                }
                //Increase Height
                $height += $h;
                $i = $sep+1;
            }
            $sep = -1;
            $j = $i;
            $l = 0;
            $ns = 0;
        }
        else
            $i++;
    }
    // Last chunk
    if($this->ws>0)
    {
        $this->ws = 0;
        $this->_out('0 Tw');
    }
    //Increase Height
    $height += $h;

    return $height;
}

function MultiAlignCell($w,$h,$text,$border=0,$ln=0,$align='L',$fill=false)
{
    // Store reset values for (x,y) positions
    $x = $this->GetX() + $w;
    $y = $this->GetY();

    // Make a call to FPDF's MultiCell
    $this->MultiCell($w,$h,$text,$border,$align,$fill);

    // Reset the line position to the right, like in Cell
    if( $ln==0 )
    {
        $this->SetXY($x,$y);
    }
}


function MultiCellText($w, $h, $txt, $border=0, $ln=0, $align='J', $fill=false)
{
    // Custom Tomaz Ahlin
    if($ln == 0) {
        $current_y = $this->GetY();
        $current_x = $this->GetX();
    }

    // Output text with automatic or explicit line breaks
    $cw = &$this->CurrentFont['cw'];
    if($w==0)
        $w = $this->w-$this->rMargin-$this->x;
    $wmax = ($w-2*$this->cMargin)*1000/$this->FontSize;
    $s = str_replace("\r",'',$txt);
    $nb = strlen($s);
    if($nb>0 && $s[$nb-1]=="\n")
        $nb--;
    $b = 0;
    if($border)
    {
        if($border==1)
        {
            $border = 'LTRB';
            $b = 'LRT';
            $b2 = 'LR';
        }
        else
        {
            $b2 = '';
            if(strpos($border,'L')!==false)
                $b2 .= 'L';
            if(strpos($border,'R')!==false)
                $b2 .= 'R';
            $b = (strpos($border,'T')!==false) ? $b2.'T' : $b2;
        }
    }
    $sep = -1;
    $i = 0;
    $j = 0;
    $l = 0;
    $ns = 0;
    $nl = 1;
    while($i<$nb)
    {
        // Get next character
        $c = $s[$i];
        if($c=="\n")
        {
            // Explicit line break
            if($this->ws>0)
            {
                $this->ws = 0;
                $this->_out('0 Tw');
            }
            $this->Cell($w,$h,substr($s,$j,$i-$j),$b,2,$align,$fill);
            $i++;
            $sep = -1;
            $j = $i;
            $l = 0;
            $ns = 0;
            $nl++;
            if($border && $nl==2)
                $b = $b2;
            continue;
        }
        if($c==' ')
        {
            $sep = $i;
            $ls = $l;
            $ns++;
        }
        $l += $cw[$c];
        if($l>$wmax)
        {
            // Automatic line break
            if($sep==-1)
            {
                if($i==$j)
                    $i++;
                if($this->ws>0)
                {
                    $this->ws = 0;
                    $this->_out('0 Tw');
                }
                $this->Cell($w,$h,substr($s,$j,$i-$j),$b,2,$align,$fill);
            }
            else
            {
                if($align=='J')
                {
                    $this->ws = ($ns>1) ?     ($wmax-$ls)/1000*$this->FontSize/($ns-1) : 0;
                    $this->_out(sprintf('%.3F Tw',$this->ws*$this->k));
                }
                $this->Cell($w,$h,substr($s,$j,$sep-$j),$b,2,$align,$fill);
                $i = $sep+1;
            }
            $sep = -1;
            $j = $i;
            $l = 0;
            $ns = 0;
            $nl++;
            if($border && $nl==2)
                $b = $b2;
        }
        else
            $i++;
    }
    // Last chunk
    if($this->ws>0)
    {
        $this->ws = 0;
        $this->_out('0 Tw');
    }
    if($border && strpos($border,'B')!==false)
        $b .= 'B';
    $this->Cell($w,$h,substr($s,$j,$i-$j),$b,2,$align,$fill);
    $this->x = $this->lMargin;

    // Custom Tomaz Ahlin
    if($ln == 0) {
        $this->SetXY($current_x + $w, $current_y);
    }
}


function RoundedRect($x, $y, $w, $h, $r, $style = '')
	{
		$k = $this->k;
		$hp = $this->h;
		if($style=='F')
			$op='f';
		elseif($style=='FD' || $style=='DF')
			$op='B';
		else
			$op='S';
		$MyArc = 4/3 * (sqrt(2) - 1);
		$this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k ));
		$xc = $x+$w-$r ;
		$yc = $y+$r;
		$this->_out(sprintf('%.2F %.2F l', $xc*$k,($hp-$y)*$k ));

		$this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);
		$xc = $x+$w-$r ;
		$yc = $y+$h-$r;
		$this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
		$this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);
		$xc = $x+$r ;
		$yc = $y+$h-$r;
		$this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
		$this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);
		$xc = $x+$r ;
		$yc = $y+$r;
		$this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$yc)*$k ));
		$this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
		$this->_out($op);
	}

	function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
	{
		$h = $this->h;
		$this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1*$this->k, ($h-$y1)*$this->k,
			$x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
	}


function CellFit($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='', $scale=false, $force=true)

    {

        //Get string width

        $str_width=$this->GetStringWidth($txt);


        //Calculate ratio to fit cell

        if($w==0)

            $w = $this->w-$this->rMargin-$this->x;

        $ratio = ($w-$this->cMargin*2)/$str_width;


        $fit = ($ratio < 1 || ($ratio > 1 && $force));

        if ($fit)

        {

            if ($scale)

            {

                //Calculate horizontal scaling

                $horiz_scale=$ratio*100.0;

                //Set horizontal scaling

                $this->_out(sprintf('BT %.2F Tz ET',$horiz_scale));

            }

            else

            {

                //Calculate character spacing in points

                $char_space=($w-$this->cMargin*2-$str_width)/max($this->MBGetStringLength($txt)-1,1)*$this->k;

                //Set character spacing

                $this->_out(sprintf('BT %.2F Tc ET',$char_space));

            }

            //Override user alignment (since text will fill up cell)

            $align='';

        }


        //Pass on to Cell method

        $this->Cell($w,$h,$txt,$border,$ln,$align,$fill,$link);


        //Reset character spacing/horizontal scaling

        if ($fit)

            $this->_out('BT '.($scale ? '100 Tz' : '0 Tc').' ET');

    }


    function CellFitSpace($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')

    {

        $this->CellFit($w,$h,$txt,$border,$ln,$align,$fill,$link,false,false);

    }


    //Patch to also work with CJK double-byte text

    function MBGetStringLength($s)

    {

        if($this->CurrentFont['type']=='Type0')

        {

            $len = 0;

            $nbbytes = strlen($s);

            for ($i = 0; $i < $nbbytes; $i++)

            {

                if (ord($s[$i])<128)

                    $len++;

                else

                {

                    $len++;

                    $i++;

                }

            }

            return $len;

        }

        else

            return strlen($s);

    }

########################## FIN DEL CODIGO PARA AJUSTAR TEXTO EN CELDAS ###############################


function saveFont()
	{

		$saved = array();

		$saved[ 'family' ] = $this->FontFamily;
		$saved[ 'style' ] = $this->FontStyle;
		$saved[ 'sizePt' ] = $this->FontSizePt;
		$saved[ 'size' ] = $this->FontSize;
		$saved[ 'curr' ] =& $this->CurrentFont;

		return $saved;

	}

	function restoreFont( $saved )
	{

		$this->FontFamily = $saved[ 'family' ];
		$this->FontStyle = $saved[ 'style' ];
		$this->FontSizePt = $saved[ 'sizePt' ];
		$this->FontSize = $saved[ 'size' ];
		$this->CurrentFont =& $saved[ 'curr' ];

		if( $this->page > 0)
			$this->_out( sprintf( 'BT /F%d %.2F Tf ET', $this->CurrentFont[ 'i' ], $this->FontSizePt ) );

	}

	function newFlowingBlock( $w, $h, $b = 0, $a = 'J', $f = 0 )
	{

		// cell width in points
		$this->flowingBlockAttr[ 'width' ] = $w * $this->k;

		// line height in user units
		$this->flowingBlockAttr[ 'height' ] = $h;

		$this->flowingBlockAttr[ 'lineCount' ] = 0;

		$this->flowingBlockAttr[ 'border' ] = $b;
		$this->flowingBlockAttr[ 'align' ] = $a;
		$this->flowingBlockAttr[ 'fill' ] = $f;

		$this->flowingBlockAttr[ 'font' ] = array();
		$this->flowingBlockAttr[ 'content' ] = array();
		$this->flowingBlockAttr[ 'contentWidth' ] = 0;

	}

	function finishFlowingBlock()
	{

		$maxWidth =& $this->flowingBlockAttr[ 'width' ];

		$lineHeight =& $this->flowingBlockAttr[ 'height' ];

		$border =& $this->flowingBlockAttr[ 'border' ];
		$align =& $this->flowingBlockAttr[ 'align' ];
		$fill =& $this->flowingBlockAttr[ 'fill' ];

		$content =& $this->flowingBlockAttr[ 'content' ];
		$font =& $this->flowingBlockAttr[ 'font' ];

		// set normal spacing
		$this->_out( sprintf( '%.3F Tw', 0 ) );

		// print out each chunk

		// the amount of space taken up so far in user units
		$usedWidth = 0;

		foreach ( $content as $k => $chunk )
		{

			$b = '';

			if ( is_int( strpos( $border, 'B' ) ) )
				$b .= 'B';

			if ( $k == 0 && is_int( strpos( $border, 'L' ) ) )
				$b .= 'L';

			if ( $k == count( $content ) - 1 && is_int( strpos( $border, 'R' ) ) )
				$b .= 'R';

			$this->restoreFont( $font[ $k ] );

			// if it's the last chunk of this line, move to the next line after
			if ( $k == count( $content ) - 1 )
				$this->Cell( ( $maxWidth / $this->k ) - $usedWidth + 2 * $this->cMargin, $lineHeight, $chunk, $b, 1, $align, $fill );
			else
				$this->Cell( $this->GetStringWidth( $chunk ), $lineHeight, $chunk, $b, 0, $align, $fill );

			$usedWidth += $this->GetStringWidth( $chunk );

		}

	}

	function WriteFlowingBlock( $s )
	{

		// width of all the content so far in points
		$contentWidth =& $this->flowingBlockAttr[ 'contentWidth' ];

		// cell width in points
		$maxWidth =& $this->flowingBlockAttr[ 'width' ];

		$lineCount =& $this->flowingBlockAttr[ 'lineCount' ];

		// line height in user units
		$lineHeight =& $this->flowingBlockAttr[ 'height' ];

		$border =& $this->flowingBlockAttr[ 'border' ];
		$align =& $this->flowingBlockAttr[ 'align' ];
		$fill =& $this->flowingBlockAttr[ 'fill' ];

		$content =& $this->flowingBlockAttr[ 'content' ];
		$font =& $this->flowingBlockAttr[ 'font' ];

		$font[] = $this->saveFont();
		$content[] = '';

		$currContent =& $content[ count( $content ) - 1 ];

		// where the line should be cutoff if it is to be justified
		$cutoffWidth = $contentWidth;

		// for every character in the string
		for ( $i = 0; $i < strlen( $s ); $i++ )
		{

			// extract the current character
			$c = $s[ $i ];

			// get the width of the character in points
			$cw = $this->CurrentFont[ 'cw' ][ $c ] * ( $this->FontSizePt / 1000 );

			if ( $c == ' ' )
			{

				$currContent .= ' ';
				$cutoffWidth = $contentWidth;

				$contentWidth += $cw;

				continue;

			}

			// try adding another char
			if ( $contentWidth + $cw > $maxWidth )
			{

				// won't fit, output what we have
				$lineCount++;

				// contains any content that didn't make it into this print
				$savedContent = '';
				$savedFont = array();

				// first, cut off and save any partial words at the end of the string
				$words = explode( ' ', $currContent );

				// if it looks like we didn't finish any words for this chunk
				if ( count( $words ) == 1 )
				{

					// save and crop off the content currently on the stack
					$savedContent = array_pop( $content );
					$savedFont = array_pop( $font );

					// trim any trailing spaces off the last bit of content
					$currContent =& $content[ count( $content ) - 1 ];

					$currContent = rtrim( $currContent );

				}

				// otherwise, we need to find which bit to cut off
				else
				{

					$lastContent = '';

					for ( $w = 0; $w < count( $words ) - 1; $w++)
						$lastContent .= "{$words[ $w ]} ";

					$savedContent = $words[ count( $words ) - 1 ];
					$savedFont = $this->saveFont();

					// replace the current content with the cropped version
					$currContent = rtrim( $lastContent );

				}

				// update $contentWidth and $cutoffWidth since they changed with cropping
				$contentWidth = 0;

				foreach ( $content as $k => $chunk )
				{

					$this->restoreFont( $font[ $k ] );

					$contentWidth += $this->GetStringWidth( $chunk ) * $this->k;

				}

				$cutoffWidth = $contentWidth;

				// if it's justified, we need to find the char spacing
				if( $align == 'J' )
				{

					// count how many spaces there are in the entire content string
					$numSpaces = 0;

					foreach ( $content as $chunk )
						$numSpaces += substr_count( $chunk, ' ' );

					// if there's more than one space, find word spacing in points
					if ( $numSpaces > 0 )
						$this->ws = ( $maxWidth - $cutoffWidth ) / $numSpaces;
					else
						$this->ws = 0;

					$this->_out( sprintf( '%.3F Tw', $this->ws ) );

				}

				// otherwise, we want normal spacing
				else
					$this->_out( sprintf( '%.3F Tw', 0 ) );

				// print out each chunk
				$usedWidth = 0;

				foreach ( $content as $k => $chunk )
				{

					$this->restoreFont( $font[ $k ] );

					$stringWidth = $this->GetStringWidth( $chunk ) + ( $this->ws * substr_count( $chunk, ' ' ) / $this->k );

					// determine which borders should be used
					$b = '';

					if ( $lineCount == 1 && is_int( strpos( $border, 'T' ) ) )
						$b .= 'T';

					if ( $k == 0 && is_int( strpos( $border, 'L' ) ) )
						$b .= 'L';

					if ( $k == count( $content ) - 1 && is_int( strpos( $border, 'R' ) ) )
						$b .= 'R';

					// if it's the last chunk of this line, move to the next line after
					if ( $k == count( $content ) - 1 )
						$this->Cell( ( $maxWidth / $this->k ) - $usedWidth + 2 * $this->cMargin, $lineHeight, $chunk, $b, 1, $align, $fill );
					else
					{

						$this->Cell( $stringWidth + 2 * $this->cMargin, $lineHeight, $chunk, $b, 0, $align, $fill );
						$this->x -= 2 * $this->cMargin;

					}

					$usedWidth += $stringWidth;

				}

				// move on to the next line, reset variables, tack on saved content and current char
				$this->restoreFont( $savedFont );

				$font = array( $savedFont );
				$content = array( $savedContent . $s[ $i ] );

				$currContent =& $content[ 0 ];

				$contentWidth = $this->GetStringWidth( $currContent ) * $this->k;
				$cutoffWidth = $contentWidth;

			}

			// another character will fit, so add it on
			else
			{

				$contentWidth += $cw;
				$currContent .= $s[ $i ];

			}

		}

	}
	
	########### FUNCION PARA CODIGO DE BARRA CON CODABAR ############
	function Codabar($xpos, $ypos, $code, $start='A', $end='A', $basewidth=0.12, $height=6) {
	$barChar = array (
		'0' => array (6.5, 4.4, 6.5, 3.4, 6.5, 7.3, 2.9),
		'1' => array (6.5, 4.4, 6.5, 8.4, 4.9, 4.3, 6.5),
		'2' => array (6.5, 4.0, 6.5, 9.4, 6.5, 3.0, 8.6),
		'3' => array (17.9, 24.3, 6.5, 6.4, 6.5, 3.4, 6.5),
		'4' => array (6.5, 2.4, 8.9, 6.4, 6.5, 4.3, 6.5),
		'5' => array (5.9,	2.4, 6.5, 6.4, 6.5, 4.3, 6.5),
		'6' => array (6.5, 8.3, 6.5, 6.4, 6.5, 6.4, 7.9),
		'7' => array (6.5, 8.3, 6.5, 2.4, 7.9, 6.4, 6.5),
		'8' => array (6.5, 8.3, 5.9, 10.4, 6.5, 6.4, 6.5),
		'9' => array (7.6, 5.0, 6.5, 8.4, 6.5, 3.0, 6.5),
		'$' => array (6.5, 5.0, 18.6, 24.4, 6.5, 10.0, 6.5),
		'-' => array (6.5, 5.0, 6.5, 4.4, 8.6, 10.0, 6.5),
		':' => array (16.7, 9.3, 6.5, 9.3, 16.7, 9.3, 14.7),
		'/' => array (14.7, 9.3, 16.7, 9.3, 6.5, 9.3, 16.7),
		'.' => array (13.6, 10.1, 14.9, 10.1, 17.2, 10.1, 6.5),
		'+' => array (6.5, 10.1, 17.2, 10.1, 14.9, 10.1, 13.6),
		'A' => array (6.5, 8.0, 19.6, 19.4, 6.5, 16.1, 6.5),
		'T' => array (6.5, 8.0, 19.6, 19.4, 6.5, 16.1, 6.5),
		'B' => array (6.5, 16.1, 6.5, 19.4, 6.5, 8.0, 19.6),
		'N' => array (6.5, 16.1, 6.5, 19.4, 6.5, 8.0, 19.6),
		'C' => array (6.5, 8.0, 6.5, 19.4, 6.5, 16.1, 19.6),
		'*' => array (6.5, 8.0, 6.5, 19.4, 6.5, 16.1, 19.6),
		'D' => array (6.5, 8.0, 6.5, 19.4, 19.6, 16.1, 6.5),
		'E' => array (6.5, 8.0, 6.5, 19.4, 19.6, 16.1, 6.5),
	);
	$this->SetFont('Arial','',1);
	$this->SetTextColor(259);  // Establece el color del texto (en este caso es blanco)
	$this->Text($xpos, $ypos + $height + 2, $code);
	$this->SetFillColor(0);
	$code = strtoupper($start.$code.$end);
	for($i=0; $i<strlen($code); $i++){
		$char = $code[$i];
		if(!isset($barChar[$char])){
			$this->Error('Invalid character in barcode: '.$char);
		}
		$seq = $barChar[$char];
		for($bar=0; $bar<7; $bar++){
			$lineWidth = $basewidth*$seq[$bar]/6.5;
			if($bar % 2 == 0){
				$this->Rect($xpos, $ypos, $lineWidth, $height, 'F');
			}
			$xpos += $lineWidth;
		}
		$xpos += $basewidth*10.4/6.5;
	}
}

   function TextWithDirection($x, $y, $txt, $direction='R')
{
    if ($direction=='R')
        $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET', 1, 0, 0, 1, $x*$this->k, ($this->h-$y)*$this->k, $this->_escape($txt));
    elseif ($direction=='L')
        $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET', -1, 0, 0, -1, $x*$this->k, ($this->h-$y)*$this->k, $this->_escape($txt));
    elseif ($direction=='U')
        $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET', 0, 1, -1, 0, $x*$this->k, ($this->h-$y)*$this->k, $this->_escape($txt));
    elseif ($direction=='D')
        $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET', 0, -1, 1, 0, $x*$this->k, ($this->h-$y)*$this->k, $this->_escape($txt));
    else
        $s=sprintf('BT %.2F %.2F Td (%s) Tj ET', $x*$this->k, ($this->h-$y)*$this->k, $this->_escape($txt));
    if ($this->ColorFlag)
        $s='q '.$this->TextColor.' '.$s.' Q';
    $this->_out($s);
}

function TextWithRotation($x, $y, $txt, $txt_angle, $font_angle=0)
{
    $font_angle+=90+$txt_angle;
    $txt_angle*=M_PI/180;
    $font_angle*=M_PI/180;

    $txt_dx=cos($txt_angle);
    $txt_dy=sin($txt_angle);
    $font_dx=cos($font_angle);
    $font_dy=sin($font_angle);

    $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET', $txt_dx, $txt_dy, $font_dx, $font_dy, $x*$this->k, ($this->h-$y)*$this->k, $this->_escape($txt));
    if ($this->ColorFlag)
        $s='q '.$this->TextColor.' '.$s.' Q';
    $this->_out($s);
}

 // FIN Class PDF

}
?>