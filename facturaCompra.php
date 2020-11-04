<?php 
session_start();
require 'conexion.php';
include 'includes/plantillaF.php';
$idPersona=$_SESSION['login'];
$total=$_POST['total'];
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha=date('Y-m-d');
$calle=$_POST['calle'];
$altura=$_POST['altura'];
$datos=$_SESSION['carrito'];
$insert=mysqli_query($conexion,"INSERT INTO facturas VALUES(00,$idPersona,$total,'$fecha',1,4)");
$idFactura=mysqli_insert_id($conexion);
for ($i=0; $i<count($datos);$i++){ 
	$idProd=$datos[$i]['IdProducto'];
	$cant=$datos[$i]['Cantidad'];
$insertDetalle=mysqli_query($conexion,"INSERT INTO facturasdetalles VALUES($idFactura,$idProd,$cant");
}
$cliente=$_SESSION['login'];
$nombreC=mysqli_query($conexion,"SELECT nombre, apellido from personas where idPersona=$cliente");
while ($r=mysqli_fetch_array($nombreC)) {
	$ncliente=$r['nombre']." ".$r['apellido'];
	}
	$pdf= new PDF();
	
	$pdf->AddPage();
	$pdf->AliasNbPages();

	
	$y= $pdf->GetY();
	$pdf->SetXY(150,$y+5);
	$pdf->Cell(70,6,utf8_decode('Factura N°: '.$idFactura),0,0,'C',0);
	$y= $pdf->GetY();
	$pdf->SetXY(150,$y+5);
	$pdf->Cell(70,6,utf8_decode('Fecha: '.$fecha),0,0,'C',0);
	$pdf->setXY(20,50);
	$pdf->SetFillColor(232,232,232);
	$pdf->Cell(30,6,"Cliente : ".$ncliente,0,0,'C',0);


	$y= $pdf->GetY();
	$pdf->SetY($y+25);
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(35,10,'Producto',1,0,'C',1);
	$pdf->Cell(30,10,'Cant.',1,0,'C',1);
	$pdf->Cell(50,10,'Total Producto',1,0,'C',1);
	$pdf->Ln(7);
	$totalC=0;

	 for ($i=0; $i<count($datos);$i++){ 
	 	$subTotal=$datos[$i]['Cantidad']*$datos[$i]['Precio'];
	 	$pdf->Ln(4);
		$pdf->SetFillColor(232,232,232);
		$pdf->SetFont('Arial','B',14);
		$pdf->Cell(35,10,$datos[$i]['Descripcion'],1,0,'C',1);
		$pdf->Cell(30,10,$datos[$i]['Cantidad'],1,0,'C',1);
		$pdf->Cell(50,10,$subTotal,1,0,'C',1);
		$totalC+=$subTotal;
		$pdf->Ln(4);
	}
	$pdf->Ln(8);
	$pdf->SetFont('Arial','B',14);
	$pdf->SetFillColor(232,232,232);
	$pdf->Cell(115,6,"Total Compra : ".$totalC,1,0,'C',1);
$pdf->Output();
?>