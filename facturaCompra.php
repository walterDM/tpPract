<?php 
session_start();
require 'conexion.php';
include 'includes/plantillaF.php';
if (isset($_SESSION['factura']) && !empty($_SESSION['factura'])) {
	$idFactura=$_SESSION['factura'];
	$fechaP=date('d-m-Y');
	$pdf= new PDF();	
	$pdf->AddPage();
	$pdf->AliasNbPages();
//declaracion de numero de Factura	
	$querynFact="SELECT df.numFactura n,tf.descripcion as t
	FROM `datosfacturas` as df
	JOIN tiposfacturas as tf on tf.idTipoFactura=df.idTipoFactura
	WHERE idFactura = (
	SELECT MAX(idFactura) 
	FROM `datosfacturas` )";
	$rsnFact=mysqli_query($conexion,$querynFact);
	while ($rn=mysqli_fetch_array($rsnFact)) {
		$nFact=$rn['n'];
		$tFact=$rn['t'];
		$numFactura= "001-".$nFact;
		$filename='FacturaVenta_n°_'.$numFactura;
	}
	$pdf->SetFont('Arial','B',14);
		$y=$pdf->GetY();
		$pdf->SetXY(140,$y-4);
	$pdf->Cell(70,6,utf8_decode('Factura N°: '.$numFactura),0,0,'C',0);
$y= $pdf->GetY();
$pdf->SetXY(140,$y+10);
$pdf->Cell(70,6,utf8_decode('Fecha: '.$fechaP),0,0,'C',0);
$pdf->setXY(10,35);
$pdf->SetFillColor(232,232,232);
$pdf->Cell(30,6,"Tipo Factura : ".$tFact,0,0,'C',0);
//Datos Cliente
$cliente=$_SESSION['login'];
$nombreC=mysqli_query($conexion,"SELECT nombre, apellido from personas where idPersona=$cliente");
while ($r=mysqli_fetch_array($nombreC)) {
	$ncliente=$r['nombre']." ".$r['apellido'];
};
$y= $pdf->GetY();
$pdf->setXY(20,50);
$pdf->SetFillColor(232,232,232);
$pdf->Cell(30,6,"Cliente : ".$ncliente,0,0,'C',0);
//Dirreccion de entrega
$calle=$_SESSION['calle'];
$altura=$_SESSION['altura'];

$y=$pdf->GetY();
$pdf->setXY(30,$y+10);
$pdf->SetFillColor(232,232,232);
$pdf->Cell(30,6,"Domicilio de Entrega : ".$calle." ".$altura,0,0,'C',0);
$y= $pdf->GetY();
$pdf->SetY($y+25);
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(35,10,'Producto',1,0,'C',1);
$pdf->Cell(30,10,'Cant.',1,0,'C',1);
$pdf->Cell(50,10,'Precio Unitario',1,0,'C',1);
$pdf->Cell(50,10,'Total Producto',1,0,'C',1);
$pdf->Ln(7);
$totalC=0;
$queryFD="SELECT p.descripcion d,fd.precioUnitario pu,fd.cantidad c from facturadetalles fd JOIN productos as p on p.idProducto=fd.idProducto where idFactura=$idFactura";
$rsFD=mysqli_query($conexion,$queryFD);

while($rf=mysqli_fetch_array($rsFD)){ 
	$subTotal=$rf['c']*$rf['pu'];
	$pdf->Ln(4);
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',14);
$pdf->Cell(35,10,$rf['d'],1,0,'C',1);
$pdf->Cell(30,10,$rf['c'],1,0,'C',1);
$pdf->Cell(50,10,$rf['pu'],1,0,'C',1);
$pdf->Cell(50,10,$subTotal,1,0,'C',1);
$totalC+=$subTotal;
$pdf->Ln(4);
}
$pdf->Ln(8);
$pdf->SetFont('Arial','B',14);
$pdf->SetFillColor(232,232,232);

$pdf->Cell(165,6,"Total Compra : ".$totalC,1,0,'C',1);
$pdf->Output('I',utf8_decode($filename).'.pdf');
	//header("location:index.php");
}
?>