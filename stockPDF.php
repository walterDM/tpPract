<?php 
session_start();
require 'conexion.php';
include 'includes/plantillaStock.php';
$tipo=0;
if (isset($_GET['tProducto'])&& isset($_GET['buscar'])) {
	$tipo=$_GET['tProducto'];
	header("location:reportesStock.php?tProducto=$tipo");
}

if (isset($_GET['exportPDF']) && !empty($_GET['exportPDF']) && $_GET['tProducto']!=0) {

	echo $_GET['tProducto'];
	$tipo=$_GET['tProducto'];
	$queryStocktp="SELECT p.descripcion as prod, p.cantidadProd as cant, p.lote, pf.estante, 
	pf.fila, pf.columna, tp.descripcion as tprod, m.nombreMarca as marca
	from productos as p
	JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico
	JOIN productostpmarcas as pm on pm.idProducto=p.idProducto
	JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca
	JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto
	JOIN marcas as m on tpm.idMarca=m.idMarca
	WHERE tpm.idTipoProducto=$tipo";

	$rsStockTp=mysqli_query($conexion,$queryStocktp);
}else if(isset($_GET['exportPDF']) && !empty($_GET['exportPDF']) && $_GET['tProducto']==0){
	$queryStockIni="SELECT p.descripcion as prod, p.cantidadProd as cant, p.lote, pf.estante, 
	pf.fila, pf.columna, tp.descripcion as tprod, m.nombreMarca as marca
	from productos as p
	JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico
	JOIN productostpmarcas as pm on pm.idProducto=p.idProducto
	JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca
	JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto
	JOIN marcas as m on tpm.idMarca=m.idMarca";
	$rsStockTp=mysqli_query($conexion,$queryStockIni);
}



$idPersona=$_SESSION['login'];


$queryEmpleado="SELECT LegajoEmpleado as legajo FROM empleados where idPersona=$idPersona";
$resultEMP=mysqli_query($conexion,$queryEmpleado);
while ($r=mysqli_fetch_array($resultEMP)) {
	$legajoEmp=$r['legajo'];
}
$fechaBase=date('Y-m-d');

$fechaActual = date('d-m-Y');
	$filename="reporteStock__".$fechaActual.$tipo;//id Factura
	

	$pdf= new PDF();
	
	$pdf->AddPage();
	$pdf->AliasNbPages();

	
	$y= $pdf->GetY();
	$pdf->SetXY(150,$y+5);
	$pdf->Cell(70,6,utf8_decode('Empleado: '.$legajoEmp),0,0,'C',0);
	$y= $pdf->GetY();
	$pdf->SetXY(150,$y+5);
	$pdf->Cell(70,6,utf8_decode('Fecha: '.$fechaActual),0,0,'C',0);
	$y= $pdf->GetY();
	$pdf->SetY($y+25);
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(35,10,'Producto',1,0,'C',1);
	$pdf->Cell(30,10,'Lote',1,0,'C',1);
	$pdf->Cell(35,10,'Tipo Producto',1,0,'C',1);
	$pdf->Cell(30,10,'Marca',1,0,'C',1);
	$pdf->Cell(30,10,'Estante',1,0,'C',1);
	$pdf->Cell(20,10,'Cant.',1,0,'C',1);
	$pdf->Ln(7);

	

	$pdf->SetFont('Arial','B',12);
	$cont=0;
	while ($r=mysqli_fetch_array($rsStockTp)) {
		$pdf->Ln(3);
		if ($cont %2) {	
			$pdf->Cell(35,6,$r['prod'],0,0,'C',1);
			$pdf->Cell(30,6,$r['lote'],0,0,'C',1);
			$pdf->Cell(35,6,$r['tprod'],0,0,'C',1);
			$pdf->Cell(30,6,$r['marca'],0,0,'C',1);
			$pdf->Cell(30,6,$r['estante'].'-'.$r['fila'].'-'.$r['columna'],0,0,'C',1);
			$pdf->Cell(20,6,$r['cant'],0,1,'C',1);
			
			$cont++;
		}else{
			$pdf->Cell(35,6,$r['prod'],0,0,'C',0);
			$pdf->Cell(30,6,$r['lote'],0,0,'C',0);
			$pdf->Cell(35,6,$r['tprod'],0,0,'C',0);
			$pdf->Cell(30,6,$r['marca'],0,0,'C',0);
			$pdf->Cell(30,6,$r['estante'].'-'.$r['fila'].'-'.$r['columna'],0,0,'C',0);
			$pdf->Cell(20,6,$r['cant'],0,1,'C',0);
			$cont++;
		}

	}
	
	$pdf->Output('I',$filename.'.pdf');
	//header("location:index.php?Reporte=1");

	?>