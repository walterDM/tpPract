<?php 
session_start();
require 'conexion.php';
include 'includes/plantillaCad.php';
if (isset($_POST['buscar']) && $_POST['buscar']==0 && isset($_POST['fDesde']) && isset($_POST['fHasta'])) {
	$fd = date("Y-m-d", strtotime($_POST['fDesde']));
	$fh = date("Y-m-d", strtotime($_POST['fHasta']));
	
	header("location:reportesCaducidad.php?fDesde=$fd&fHasta=$fh");
}
if (isset($_POST['buscar']) && $_POST['buscar']==0 && isset($_POST['fDesde']) && !isset($_POST['fHasta'])) {
	$fd = date("Y-m-d", strtotime($_POST['fDesde']));
	$fh = date("Y-m-d");
	
	header("location:reportesCaducidad.php?fDesde=$fd&fHasta=$fh");
}
if ($_POST['exportPDF']) {
	if (!isset($_POST['fDesde']) && !isset($_POST['fHasta']) && !empty($_POST['fDesde']) && !empty($_POST['fHasta']) ) {	
		$queryFechatp="SELECT p.descripcion as prod,p.fechaCaducidad as venc, p.cantidadProd as cant, p.lote, pf.estante, pf.fila, pf.columna, tp.descripcion as tprod, m.nombreMarca as marca 
		from productos as p 
		JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico 
		JOIN productostpmarcas as pm on pm.idProducto=p.idProducto 
		JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca 
		JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto 
		JOIN marcas as m on tpm.idMarca=m.idMarca";
	}
	if (isset($_POST['fDesde'])){
		$fd=$_POST['fDesde'];
		$fh= date("Y-m-d");
		$queryFechatp="SELECT p.descripcion as prod,p.fechaCaducidad as venc, p.cantidadProd as cant, p.lote, pf.estante, pf.fila, pf.columna, tp.descripcion as tprod, m.nombreMarca as marca 
		from productos as p 
		JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico 
		JOIN productostpmarcas as pm on pm.idProducto=p.idProducto 
		JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca 
		JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto 
		JOIN marcas as m on tpm.idMarca=m.idMarca
		WHERE p.fechaCaducidad BETWEEN '$fd' AND '$fh'";

	}
	$rsFechaTp=mysqli_query($conexion,$queryFechatp);




	$idPersona=$_SESSION['login'];


	$queryEmpleado="SELECT LegajoEmpleado as legajo FROM empleados where idPersona=$idPersona";
	$resultEMP=mysqli_query($conexion,$queryEmpleado);
	while ($r=mysqli_fetch_array($resultEMP)) {
		$legajoEmp=$r['legajo'];
	}
	$fechaBase=date('Y-m-d');

	$fechaActual = date('d-m-Y');
	$filename="reporteCaducidad__".$fechaActual;//id Factura
	

	$pdf= new PDF();
	
	$pdf->AddPage();
	$pdf->AliasNbPages();

	
	$y= $pdf->GetY();
	$pdf->SetXY(150,$y+5);
	$pdf->Cell(70,6,utf8_decode('Empleado: '.$legajoEmp),0,0,'C',0);
	$y= $pdf->GetY();
	$pdf->SetXY(150,$y+5);
	$pdf->Cell(70,6,utf8_decode('Fecha: '.$fechaActual),0,0,'C',0);
	
	if (isset($_POST['fDesde']) && isset($_POST['fHasta']) && !empty($_POST['fDesde']) && !empty($_POST['fHasta']) ){
		$newfd=date("d/m/Y", strtotime($fd));
		$newfh=date("d/m/Y", strtotime($fh));
		$y= $pdf->GetY();
		$pdf->SetXY(20,$y+15);
		$pdf->Cell(70,6,utf8_decode('Desde: '.$newfd),0,0,'C',0);
		$y=$pdf->GetY();
		$x=$pdf->GetX();
		$pdf->SetXY($x+20,$y);
		$pdf->Cell(70,6,utf8_decode('Desde: '.$newfh),0,0,'C',0);
	}else{
		$hoy=date("d/m/Y");
		$y= $pdf->GetY();
		$pdf->SetXY(20,$y+15);
		$pdf->Cell(70,6,utf8_decode('Productos Hasta: '.$hoy),0,0,'C',0);
	}
	//INICIA TABLA
	$y= $pdf->GetY();
	$pdf->SetY($y+15);
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(35,10,'Producto',1,0,'C',1);
	$pdf->Cell(30,10,'Lote',1,0,'C',1);
	$pdf->Cell(30,10,'Marca',1,0,'C',1);
	$pdf->Cell(30,10,'Vencimiento',1,0,'C',1);
	$pdf->Cell(30,10,'Estante',1,0,'C',1);
	$pdf->Cell(20,10,'Cant.',1,0,'C',1);
	$pdf->Ln(7);

	

	$pdf->SetFont('Arial','B',12);
	$cont=0;
	
	while ($r=mysqli_fetch_array($rsFechaTp)) {
		$pdf->Ln(3);
		if ($cont %2) {	
			$pdf->Cell(35,6,$r['prod'],0,0,'C',1);
			$pdf->Cell(30,6,$r['lote'],0,0,'C',1);
			
			$pdf->Cell(30,6,$r['marca'],0,0,'C',1);
			$pdf->Cell(30,6,$r['venc'],0,0,'C',1);
			$pdf->Cell(30,6,$r['estante'].'-'.$r['fila'].'-'.$r['columna'],0,0,'C',1);
			$pdf->Cell(20,6,$r['cant'],0,1,'C',1);
			
			$cont++;
		}else{
			$pdf->Cell(35,6,$r['prod'],0,0,'C',1);
			$pdf->Cell(30,6,$r['lote'],0,0,'C',1);
			
			$pdf->Cell(30,6,$r['marca'],0,0,'C',1);
			$pdf->Cell(30,6,$r['venc'],0,0,'C',1);
			$pdf->Cell(30,6,$r['estante'].'-'.$r['fila'].'-'.$r['columna'],0,0,'C',1);
			$pdf->Cell(20,6,$r['cant'],0,1,'C',1);

			$cont++;
		}

	}
	
	$pdf->Output('I',$filename.'.pdf');
	header("location:index.php?Reporte=1");
}
?>