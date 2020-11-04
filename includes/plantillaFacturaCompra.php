<?php 
 
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
$pdf->Cell(40,10,utf8_decode('¡Hola, Mundo!'));
$pdf->Output();
 ?>