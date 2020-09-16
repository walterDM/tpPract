<?php 
require 'conexion.php';
include 'plantillaPDF.php'; 
if (isset($_POST['seleccionado']) && !empty($_POST['seleccionado']) && isset($_POST['cant'])) {

	$vari=$_POST['seleccionado'];
	$cant[]=$_POST['cant'];
	$idFactura=3;
	$filename="Factura__".$idFactura;//id Factura
	$pedido=10;
	$fechaActual = date('Y-m-d');


	$pdf= new PDF();
	
	$pdf->AddPage();
	$pdf->AliasNbPages();

	$pdf->SetXY(150,10);
	$pdf->Cell(70,6,utf8_decode('Pedido N°: '.$idFactura),0,0,'C',0);
	$y= $pdf->GetY();
	$pdf->SetXY(150,$y+5);
	$pdf->Cell(70,6,utf8_decode('Fecha: '.$fechaActual),0,0,'C',0);
	$y= $pdf->GetY();
	$pdf->SetY($y+25);
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(70,6,'Tipo Producto',1,0,'C',1);
	$pdf->Cell(70,6,'Marca',1,0,'C',1);
	$pdf->Cell(30,6,'Cantidad',1,1,'C',1);

	

	$pdf->SetFont('Arial','B',12);
	for ($i=0; $i < sizeof($vari) ; $i++) { 
		$queryMTP="SELECT m.nombreMarca as marca, tp.descripcion as tProducto FROM marcas as m
		JOIN tiposproductos_marcas as tpm  on tpm.idMarca= m.idMarca 
		JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto
		where tpm.idTpMarca=$vari[$i]";
		$resultMTP=mysqli_query($conexion,$queryMTP);
		while ($r=mysqli_fetch_array($resultMTP)) {
			$pdf->Ln(2);
			$pdf->Cell(70,6,$r['tProducto'],0,0,'C',0);
			$pdf->Cell(70,6,$r['marca'],0,0,'C',0);
			$pdf->Cell(30,6,$_POST['cant'][$i],0,1,'C',0);


		}
	};
	$pdf->Output('F','PedidosCreados/'.$filename.'.pdf');
	header("location:index.php");
}
?>