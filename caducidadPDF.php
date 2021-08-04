<?php 
session_start();
require 'conexion.php';
include 'includes/plantillaCad.php';
if (isset($_POST['buscar']) && $_POST['buscar']==0) {
	$id=$_POST['idtipo'];
	$idMarca=$_POST['idmarca'];
	$fd = date("Y-m-d", strtotime($_POST['fDesde']));
	$fh = date("Y-m-d", strtotime($_POST['fHasta']));
	
	
	header("location:reportesCaducidad.php?id=$id&idMarca=$idMarca&fDesde=$fd&fHasta=$fh&pagina=1");
}
if (isset($_POST['buscar']) && $_POST['buscar']==0 && isset($_POST['fDesde']) && isset($_POST['fHasta'])&& empty($_POST['fHasta'])) {
	$id=$_POST['idtipo'];
	$idMarca=$_POST['idmarca'];
	$fd = date("Y-m-d", strtotime($_POST['fDesde']));
	$fh = date("Y-m-d");
	
	header("location:reportesCaducidad.php?id=$id&idMarca=$idMarca&fDesde=$fd&fHasta=$fh&pagina=1");
}
if(isset($_POST['exportPDF']) && !empty($_POST['exportPDF']) && $_POST['tMarca']==0 && $_POST['tProducto']>0 && $_POST['fDesde']=='0000-00-00' && $_POST['fHasta']='0000-00-00'){
	
		$queryFechatp="SELECT p.descripcion as prod,p.fechaCaducidad as venc, p.cantidadProd as cant, p.lote, pf.estante, pf.fila, pf.columna, tp.descripcion as tprod, m.nombreMarca as marca 
		from productos as p 
		JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico 
		JOIN productostpmarcas as pm on pm.idProducto=p.idProducto 
		JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca 
		JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto 
		JOIN marcas as m on tpm.idMarca=m.idMarca
		WHERE tpm.idTipoProducto={$_POST['tProducto']}";

	
	$rsFechaTp=mysqli_query($conexion,$queryFechatp);

}

if(isset($_POST['exportPDF']) && !empty($_POST['exportPDF'])){ 
  if($_POST['tMarca']==0 && $_POST['tProducto']>0 && $_POST['fDesde']=='0000-00-00' && $_POST['fHasta']=='0000-00-00'){
	
		$queryFechatp="SELECT p.descripcion as prod,p.fechaCaducidad as venc, p.cantidadProd as cant, p.lote, pf.estante, pf.fila, pf.columna, tp.descripcion as tprod, m.nombreMarca as marca 
		from productos as p 
		JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico 
		JOIN productostpmarcas as pm on pm.idProducto=p.idProducto 
		JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca 
		JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto 
		JOIN marcas as m on tpm.idMarca=m.idMarca
		WHERE tpm.idTipoProducto={$_POST['tProducto']}";
  }
  if($_POST['tMarca']==0 && $_POST['tProducto']>0 && $_POST['fDesde']!='0000-00-00' && $_POST['fHasta']!='0000-00-00'){
	
	$queryFechatp="SELECT p.descripcion as prod,p.fechaCaducidad as venc, p.cantidadProd as cant, p.lote, pf.estante, pf.fila, pf.columna, tp.descripcion as tprod, m.nombreMarca as marca 
	from productos as p 
	JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico 
	JOIN productostpmarcas as pm on pm.idProducto=p.idProducto 
	JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca 
	JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto 
	JOIN marcas as m on tpm.idMarca=m.idMarca
	WHERE tpm.idTipoProducto={$_POST['tProducto']}
	  AND p.fechaCaducidad BETWEEN '{$_POST['fDesde']}' AND '{$_POST['fHasta']}'";
  }
  if($_POST['tMarca']==0 && $_POST['tProducto']==0 && $_POST['fDesde']=='0000-00-00' && $_POST['fHasta']=='0000-00-00'){
	
	$queryFechatp="SELECT p.descripcion as prod,p.fechaCaducidad as venc, p.cantidadProd as cant, p.lote, pf.estante, pf.fila, pf.columna, tp.descripcion as tprod, m.nombreMarca as marca 
	from productos as p 
	JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico 
	JOIN productostpmarcas as pm on pm.idProducto=p.idProducto 
	JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca 
	JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto 
	JOIN marcas as m on tpm.idMarca=m.idMarca";
  }
  if($_POST['tMarca']==0 && $_POST['tProducto']==0 && $_POST['fDesde']!='0000-00-00' && $_POST['fHasta']!='0000-00-00'){
	
	$queryFechatp="SELECT p.descripcion as prod,p.fechaCaducidad as venc, p.cantidadProd as cant, p.lote, pf.estante, pf.fila, pf.columna, tp.descripcion as tprod, m.nombreMarca as marca 
	from productos as p 
	JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico 
	JOIN productostpmarcas as pm on pm.idProducto=p.idProducto 
	JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca 
	JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto 
	JOIN marcas as m on tpm.idMarca=m.idMarca
	WHERE p.fechaCaducidad BETWEEN '{$_POST['fDesde']}' AND '{$_POST['fHasta']}'";
  }
  if($_POST['tMarca']>0 && $_POST['tProducto']>0 && $_POST['fDesde']=='0000-00-00' && $_POST['fHasta']=='0000-00-00'){
	
	$queryFechatp="SELECT p.descripcion as prod,p.fechaCaducidad as venc, p.cantidadProd as cant, p.lote, pf.estante, pf.fila, pf.columna, tp.descripcion as tprod, m.nombreMarca as marca 
	from productos as p 
	JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico 
	JOIN productostpmarcas as pm on pm.idProducto=p.idProducto 
	JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca 
	JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto 
	JOIN marcas as m on tpm.idMarca=m.idMarca
	WHERE tpm.idMarca={$_POST['tMarca']}";
  }
  if($_POST['tMarca']>0 && $_POST['tProducto']>0 && $_POST['fDesde']!='0000-00-00' && $_POST['fHasta']!='0000-00-00'){
	
	$queryFechatp="SELECT p.descripcion as prod,p.fechaCaducidad as venc, p.cantidadProd as cant, p.lote, pf.estante, pf.fila, pf.columna, tp.descripcion as tprod, m.nombreMarca as marca 
	from productos as p 
	JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico 
	JOIN productostpmarcas as pm on pm.idProducto=p.idProducto 
	JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca 
	JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto 
	JOIN marcas as m on tpm.idMarca=m.idMarca
	WHERE tpm.idMarca={$_POST['tMarca']}
	  AND p.fechaCaducidad BETWEEN '{$_POST['fDesde']}' AND '{$_POST['fHasta']}'";
  }


$rsFechaTp=mysqli_query($conexion,$queryFechatp);




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
	date_default_timezone_set('America/Argentina/Buenos_Aires');
	$fechaBase=date('Y-m-d');

	$fechaActual = date('d/m/Y');
	$filename="reporteCaducidad__".$fechaActual;//id Factura
	

	$pdf= new PDF();
	
	$pdf->AddPage();
	$pdf->AliasNbPages();

	
	$y= $pdf->GetY();
	$pdf->SetXY(150,$y+5);
	$pdf->Cell(30,6,utf8_decode('Empleado: '.$apellido." ".$nombre),0,0,'C',0);
	$y= $pdf->GetY();
	$pdf->SetXY(150,$y+5);
	$pdf->Cell(2,6,utf8_decode('Fecha: '.$fechaActual),0,0,'C',0);
	
	if ((isset($_POST['fDesde']) && $_POST['fDesde']!='0000-00-00') && (isset($_POST['fHasta']) && $_POST['fHasta']!='0000-00-00')){
		$newfd=date("d/m/Y", strtotime($_POST['fDesde']));
		$newfh=date("d/m/Y", strtotime($_POST['fHasta']));
		$y= $pdf->GetY();
		$pdf->SetXY(20,$y+15);
		$pdf->Cell(70,6,utf8_decode('Desde: '.$newfd),0,0,'C',0);
		$y=$pdf->GetY();
		$x=$pdf->GetX();
		$pdf->SetXY($x+20,$y);
		$pdf->Cell(70,6,utf8_decode('Hasta: '.$newfh),0,0,'C',0);
	}else{
		$hoy=date("d/m/Y");
		$y= $pdf->GetY();
		$pdf->SetXY(20,$y+15);
		$pdf->Cell(70,6,utf8_decode('Productos Hasta: '.$hoy),0,0,'C',0);
	}
	//INICIA TABLA
	$y= $pdf->GetY();
	$pdf->SetY($y+15);
	$pdf->SetFillColor(255, 175, 0);
	$pdf->SetFont('Arial','B',10);
	
	$pdf->Cell(55,10,'Producto',1,0,'C',1);
	$pdf->Cell(20,10,'Lote',1,0,'C',1);
	$pdf->Cell(30,10,'Marca',1,0,'C',1);
	$pdf->Cell(30,10,'Vencimiento',1,0,'C',1);
	$pdf->Cell(30,10,'Estante',1,0,'C',1);
	$pdf->Cell(10,10,'Cant.',1,0,'C',1);
	$pdf->Ln(7);

	
    $pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',8);
	$cont=0;
	
	while ($r=mysqli_fetch_array($rsFechaTp)) {
		$pdf->Ln(4);
		$fecha=date('d/m/Y',strtotime($r['venc']));
		if ($cont %2) {	
			$pdf->Cell(55,6,utf8_decode($r['prod']),0,0,'C',1);
			$pdf->Cell(20,6,$r['lote'],0,0,'C',1);
			
			$pdf->Cell(30,6,$r['marca'],0,0,'C',1);
			$pdf->Cell(30,6,$fecha,0,0,'C',1);
			$pdf->Cell(30,6,$r['estante'].'-'.$r['fila'].'-'.$r['columna'],0,0,'C',1);
			$pdf->Cell(10,6,$r['cant'],0,1,'C',1);
			
			$cont++;
		}else{
			$pdf->Cell(55,6,utf8_decode($r['prod']),0,0,'C',1);
			$pdf->Cell(20,6,$r['lote'],0,0,'C',1);
			
			$pdf->Cell(30,6,$r['marca'],0,0,'C',1);
			$pdf->Cell(30,6,$fecha,0,0,'C',1);
			$pdf->Cell(30,6,$r['estante'].'-'.$r['fila'].'-'.$r['columna'],0,0,'C',1);
			$pdf->Cell(10,6,$r['cant'],0,1,'C',1);

			$cont++;
		}

	}
	
	$pdf->Output('I',"reportesCreados/ReportesCaducidad/".$filename.'.pdf');
	header("location:index.php?Reporte=1");
}
?>