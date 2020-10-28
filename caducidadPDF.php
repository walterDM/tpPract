<?php 
session_start();
require 'conexion.php';
include 'includes/plantillaCad.php';
if (isset($_POST['buscar'])) {
	$fh=$_POST['fHasta'];
	$fd=$_POST['fDesde'];
	header("location:reportesCaducidad.php?fDesde=$fd&fHasta=$fh");
}

if (isset($_POST['exportPDF']) && !empty($_POST['exportPDF'])) {

	echo $_POST['fHasta'];}
	/*$tipo=$_POST['tProducto'];
	$queryStocktp="SELECT p.descripcion as prod, p.cantidadProd as cant, p.lote, pf.estante, 
	pf.fila, pf.columna, tp.descripcion as tprod, m.nombreMarca as marca
	from productos as p
	JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico
	JOIN productostpmarcas as pm on pm.idProducto=p.idProducto
	JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca
	JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto
	JOIN marcas as m on tpm.idMarca=m.idMarca
	WHERE tpm.idTipoProducto=5";

	$rsStockTp=mysqli_query($conexion,$queryStocktp);
}*/
/*
	echo '<table class="table striped" style="background:#fafafa;">';
	
	while ($rs1=mysqli_fetch_array($rsStockTp)){?>
					<tr>
					<td><?php echo $rs1['prod']; ?></td>
					<td><?php echo $rs1['tprod']; ?></td>
					<td><?php echo $rs1['cantidadProd']; ?></td>
					<td><?php echo $rs1['lote']; ?></td>
					<td><?php echo $rs1['estante'].'-'.$rs1['fila'].'-'.$rs1['columna']; ?></td>
					</tr>
					
				<?php };
				echo "</table>";*/


			/*	$idPersona=$_SESSION['login'];


				$queryEmpleado="SELECT LegajoEmpleado as legajo FROM empleados where idPersona=$idPersona";
				$resultEMP=mysqli_query($conexion,$queryEmpleado);
				while ($r=mysqli_fetch_array($resultEMP)) {
					$legajoEmp=$r['legajo'];
				}
				$fechaBase=date('Y-m-d');

				$fechaActual = date('d-m-Y');
	$filename="reporte__".$fechaActual;//id Factura
	

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
	
	$pdf->Output('F','reportesCreados/'.$filename.'.pdf');
	header("location:index.php?Reporte=1");*/

	?>