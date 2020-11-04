<?php 
session_start();
require 'conexion.php';
include 'includes/plantillaV.php';

if (isset($_POST['buscar']) && $_POST['buscar']==0 && isset($_POST['fDesde']) && isset($_POST['fHasta'])) {
	$fd = date("Y-m-d", strtotime($_POST['fDesde']));
	$fh = date("Y-m-d", strtotime($_POST['fHasta']));
	
	header("location:reportesVentas.php?fDesde=$fd&fHasta=$fh");
}
if (isset($_POST['buscar']) && $_POST['buscar']==0 && isset($_POST['fDesde']) && !isset($_POST['fHasta'])) {
	$fd = date("Y-m-d", strtotime($_POST['fDesde']));
	$fh = date("Y-m-d");
	
	header("location:reportesVentas.php?fDesde=$fd&fHasta=$fh");
}

if (isset($_POST['exportPDF'])&& isset($_POST['fDesde'])) {
	
	if ((empty($_POST['fDesde']) && empty($_POST['fHasta'])) ) {	
		
		$queryFechatp="SELECT f.idFacturaVenta as nFact, f.totalApagar as total, f.fechaPedido as fp, p.nombre,p.apellido from facturas as f JOIN personas as p on p.idPersona=f.idPersona";
	}
	if (!isset($_POST['fHasta']) && !empty($_POST['fDesde'])){
		
		$fd = date("Y-m-d", strtotime($_POST['fDesde']));
		$hoy= date("Y-m-d");
		$queryFechatp="SELECT f.idFacturaVenta as nFact, f.totalApagar as total, f.fechaPedido as fp, p.nombre,p.apellido 
		from facturas as f 
		JOIN personas as p on p.idPersona=f.idPersona

		WHERE f.fechaPedido BETWEEN '$fd' AND  '$hoy'";

	}
	elseif (isset($_POST['fDesde']) && isset($_POST['fHasta'])&&(!empty($_POST['fDesde']) && !empty($_POST['fHasta']))){
		
		$fd = date("Y-m-d", strtotime($_POST['fDesde']));
		$fh = date("Y-m-d", strtotime($_POST['fHasta']));
		$queryFechatp="SELECT f.idFacturaVenta as nFact, f.totalApagar as total, f.fechaPedido as fp, p.nombre,p.apellido 
		from facturas as f 
		JOIN personas as p on p.idPersona=f.idPersona

		WHERE f.fechaPedido BETWEEN '$fd' AND '$fh'";

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
	$filename="reporteVenta__".$fechaActual;//id Factura
	

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
	$pdf->SetX(30);
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(35,10,'Factura',1,0,'C',1);
	$pdf->Cell(50,10,'Cliente',1,0,'C',1);
	
	$pdf->Cell(35,10,'Fecha Factura',1,0,'C',1);
	$pdf->Cell(30,10,'Total Factura',1,0,'C',1);
	
	$pdf->Ln(7);

	

	$pdf->SetFont('Arial','B',12);

	$cont=0;
	$totalV=0;
	while ($r=mysqli_fetch_array($rsFechaTp)) {
		$pdf->Ln(4);
		if ($cont %2) {	
			$pdf->SetX(30);
			$pdf->Cell(35,6,$r['nFact'],0,0,'C',1);
			$pdf->Cell(50,6,$r['nombre']." ".$r['apellido'],0,0,'C',1);
			
			$pdf->Cell(35,6,$r['fp'],0,0,'C',1);
			$pdf->Cell(30,6,$r['total'],0,0,'C',1);

			$pdf->Ln(4);
			$totalV+=$r['total'];
			$cont++;
		}else{
			$pdf->SetX(30);
			$pdf->Cell(35,6,$r['nFact'],0,0,'C',1);
			$pdf->Cell(50,6,$r['nombre']." ".$r['apellido'],0,0,'C',1);
			
			$pdf->Cell(35,6,$r['fp'],0,0,'C',1);
			$pdf->Cell(30,6,$r['total'],0,0,'C',1);
			$pdf->Ln(4);
			$totalV+=$r['total'];
			$cont++;
		}

	}
	$pdf->Ln(4);
	$pdf->SetX(30);
	$pdf->Cell(150,6,"TOTAL VENDIDO PERIODO = ".$totalV,0,0,'C',1);
	
	$pdf->Output('F','reportesCreados/'.$filename.'.pdf');
	header("location:index.php?Reporte=1");
}
?>