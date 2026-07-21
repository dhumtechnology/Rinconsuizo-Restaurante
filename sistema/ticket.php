<?php
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
$this->CellFitSpace(50,3,"Nº TLF:".utf8_decode($con[0]['tlfempresa']),0,1,'C');

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
$etiquetaMesa = (strpos($ve[0]['nombremesa'], '+') !== false) ? "MESAS: " : "N° DE MESA: ";
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
$this->Cell(24,3,'Descripción',0,0,'C');
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
$this->Cell(55,3,'------------------------ PAGO  ------------------------',0,0,'C');
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