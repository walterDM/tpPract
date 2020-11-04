<?php 
session_start();
require 'conexion.php';
$idPersona=$_SESSION['login'];
$total=$_POST['total'];
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha=date('Y-m-d');
$calle=$_POST['calle'];
$altura=$_POST['altura'];
$datos=$_SESSION['carrito'];
$insert=mysqli_query($conexion,"INSERT INTO facturas VALUES(00,$idPersona,$total,'$fecha',1)");
require 'fpdf/fpdf.php';
	class PDF extends FPDF{
		Function Header(){
			$this->Image('imagenes/logo1.png',5,5,50);
			$this->SetFont('Arial','B',15);
			$this->cell(30);
			$this->SetXY(40,20);
			$this->cell(120,10,'Factura',0,0,'C');

			$this->Ln(20);

		}

		Function Footer(){
			$this->setY(-15);
			$this->SetFont('Arial','I',8);
			$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
		}
	}
$pdf = new PDF();
$pdf->  AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
	$y= $pdf->GetY();
	$pdf->SetY($y+25);
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(35,10,'nro factura',1,0,'C',1);
	$pdf->Cell(30,10,'Cliente',1,0,'C',1);
	$pdf->Cell(35,10,'Tipo Producto',1,0,'C',1);
	$pdf->Cell(30,10,'Marca',1,0,'C',1);
	$pdf->Cell(30,10,'Estante',1,0,'C',1);
	$pdf->Cell(20,10,'Cant.',1,0,'C',1);
	$pdf->Ln(7);
$pdf->Output();
?>