<?php 
session_start();
require 'conexion.php';
include 'includes/plantillaStock.php';

if(isset($_POST['exportPDF']) && !empty($_POST['exportPDF']) && $_POST['tMarca']==0){
	
	$queryStocktp="SELECT p.descripcion as prod, p.cantidadProd as cant, p.lote, pf.estante, 
	pf.fila, pf.columna, tp.descripcion as tprod, m.nombreMarca as marca
	from productos as p
	JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico
	JOIN productostpmarcas as pm on pm.idProducto=p.idProducto
	JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca
	JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto
	JOIN marcas as m on tpm.idMarca=m.idMarca
	WHERE tpm.idTipoProducto={$_POST['tProducto']}";
	$rsStockTp = $conexion->query($queryStocktp);

$idPersona=$_SESSION['login'];


$queryEmpleado="SELECT LegajoEmpleado as legajo,idPersona as persona FROM empleados where idPersona=$idPersona";
$resultEMP=mysqli_query($conexion,$queryEmpleado);
while ($r=mysqli_fetch_array($resultEMP)) {
	$legajoEmp=$r['legajo'];
	$idpersona=$r['persona'];
}
$queryPersonas="SELECT nombre,apellido FROM personas where idPersona=$idpersona";
$resultPER=mysqli_query($conexion,$queryPersonas);
while ($r=mysqli_fetch_array($resultPER)) {
	$nombre=$r['nombre'];
	$apellido=$r['apellido'];
}
$fechaBase=date('Y-m-d');

$fechaActual = date('d-m-Y');
	$filename="reporteStock__".$fechaActual.$_POST['tProducto'];//id Factura
	

	$pdf= new PDF();
	
	$pdf->AddPage();
	$pdf->AliasNbPages();

	
	$y= $pdf->GetY();
	$pdf->SetXY(150,$y+5);
	$pdf->Cell(5,3,utf8_decode('Legajo: '.$legajoEmp),0,0,'C',0);
	$y= $pdf->GetY();
	$pdf->SetXY(150,$y+5);
	$pdf->Cell(40,3,utf8_decode('Empleado: '.$apellido." ".$nombre),0,0,'C',0);
	$y= $pdf->GetY();
	$pdf->SetXY(150,$y+5);
	$pdf->Cell(12,3,utf8_decode('Fecha: '.$fechaActual),0,0,'C',0);
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
	
	$pdf->Output('I',"reportesCreados/ReportesStock/".$filename.'.pdf');
	$pdf->Output('D',"reportesCreados/ReportesStock/".$filename.'.pdf');
	header("location:index.php?Reporte=1");
}
if(isset($_POST['exportPDF']) && !empty($_POST['exportPDF']) && $_POST['tMarca']>0){
	$queryStocktp="SELECT p.descripcion as prod, p.cantidadProd as cant, p.lote, pf.estante, 
	pf.fila, pf.columna, tp.descripcion as tprod, m.nombreMarca as marca
	from productos as p
	JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico
	JOIN productostpmarcas as pm on pm.idProducto=p.idProducto
	JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca
	JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto
	JOIN marcas as m on tpm.idMarca=m.idMarca
	WHERE tpm.idMarca={$_POST['tMarca']}";
	$rsStockTp = $conexion->query($queryStocktp);

$idPersona=$_SESSION['login'];


$queryEmpleado="SELECT LegajoEmpleado as legajo,idPersona as persona FROM empleados where idPersona=$idPersona";
$resultEMP=mysqli_query($conexion,$queryEmpleado);
while ($r=mysqli_fetch_array($resultEMP)) {
	$legajoEmp=$r['legajo'];
	$idpersona=$r['persona'];
}
$queryPersonas="SELECT nombre,apellido FROM personas where idPersona=$idpersona";
$resultPER=mysqli_query($conexion,$queryPersonas);
while ($r=mysqli_fetch_array($resultPER)) {
	$nombre=$r['nombre'];
	$apellido=$r['apellido'];
}
$fechaBase=date('Y-m-d');

$fechaActual = date('d-m-Y');
	$filename="reporteStock__".$fechaActual.$_POST['tMarca'];//id Factura
	

	$pdf= new PDF();
	
	$pdf->AddPage();
	$pdf->AliasNbPages();

	
	$y= $pdf->GetY();
	$pdf->SetXY(150,$y+5);
	$pdf->Cell(5,3,utf8_decode('Legajo: '.$legajoEmp),0,0,'C',0);
	$y= $pdf->GetY();
	$pdf->SetXY(150,$y+5);
	$pdf->Cell(40,3,utf8_decode('Empleado: '.$apellido." ".$nombre),0,0,'C',0);
	$y= $pdf->GetY();
	$pdf->SetXY(150,$y+5);
	$pdf->Cell(12,3,utf8_decode('Fecha: '.$fechaActual),0,0,'C',0);
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
	
	$pdf->Output('I',"reportesCreados/ReportesStock/".$filename.'.pdf');
	$pdf->Output('D',"reportesCreados/ReportesStock/".$filename.'.pdf');
	header("location:index.php?Reporte=1");
}
	?>