<?php 
session_start();
require 'conexion.php';
include 'includes/plantillaHC.php';

if (isset($_POST['buscar']) && $_POST['buscar']==0) {
	
	$fd = date("Y-m-d", strtotime($_POST['fDesde']));
	$fh = date("Y-m-d", strtotime($_POST['fHasta']));
	
	
	header("location:reportesVentas.php?fDesde=$fd&fHasta=$fh&pagina=1");
}
if (isset($_POST['buscar']) && $_POST['buscar']==0 && isset($_POST['fDesde']) && isset($_POST['fHasta']) && empty($_POST['fHasta'])) {
	
	$fd = date("Y-m-d", strtotime($_POST['fDesde']));
	$fh = date("Y-m-d");
	
	header("location:reportesVentas.php?fDesde=$fd&fHasta=$fh&pagina=1");
}


	
    if(isset($_POST['exportPDF']) && !empty($_POST['exportPDF']) && $_POST['fDesde']=='0000-00-00' && $_POST['fHasta']=='0000-00-00'){	
	    
		    $queryFechatp="SELECT p.idPersona, f.idFacturaVenta as nFact,df.numFactura,tf.descripcion, f.totalApagar as total, f.fechaPedido as fp, p.nombre,p.apellido 
		    FROM facturas as f 
			JOIN personas as p on p.idPersona = f.idPersona
			JOIN datosfacturas as df on df.idFactura = f.idFacturaVenta
			JOIN tiposfacturas as tf on tf.idTipoFactura = df.idTipoFactura";
			$rsFechaTp=mysqli_query($conexion,$queryFechatp);
	}
	if(isset($_POST['detallePDF']) && !empty($_POST['detallePDF']) && $_POST['fDesde']=='0000-00-00' && $_POST['fHasta']=='0000-00-00' && $_POST['fNumFact']>0){	
	    
		$queryFechatp="SELECT p.idPersona, f.idFacturaVenta as nFact,df.numFactura,tf.descripcion, f.totalApagar as total, f.fechaPedido as fp, p.nombre,p.apellido 
		FROM facturas as f 
		JOIN personas as p on p.idPersona = f.idPersona
		JOIN datosfacturas as df on df.idFactura = f.idFacturaVenta
		JOIN tiposfacturas as tf on tf.idTipoFactura = df.idTipoFactura
		WHERE df.numFactura={$_POST['fNumFact']}";
		$rsFechaTp=mysqli_query($conexion,$queryFechatp);
    }
	if(isset($_POST['detallePDF']) && !empty($_POST['detallePDF']) && $_POST['fDesde']!='0000-00-00' && $_POST['fHasta']!='0000-00-00' && $_POST['fNumFact']>0){	
	    
		$queryFechatp="SELECT p.idPersona, f.idFacturaVenta as nFact,df.numFactura,tf.descripcion, f.totalApagar as total, f.fechaPedido as fp, p.nombre,p.apellido 
		FROM facturas as f 
		JOIN personas as p on p.idPersona = f.idPersona
		JOIN datosfacturas as df on df.idFactura = f.idFacturaVenta
		JOIN tiposfacturas as tf on tf.idTipoFactura = df.idTipoFactura
		WHERE df.numFactura={$_POST['fNumFact']}
		  AND f.fechaPedido BETWEEN '{$_POST['fDesde']}' AND '{$_POST['fHasta']}'";
		$rsFechaTp=mysqli_query($conexion,$queryFechatp);
    }
	if(isset($_POST['exportPDF']) && !empty($_POST['exportPDF']) && $_POST['fDesde']!='0000-00-00' && $_POST['fHasta']!='0000-00-00'){	
	    
		$queryFechatp="SELECT p.idPersona, f.idFacturaVenta as nFact,df.numFactura,tf.descripcion, f.totalApagar as total, f.fechaPedido as fp, p.nombre,p.apellido 
		    FROM facturas as f 
			JOIN personas as p on p.idPersona = f.idPersona
			JOIN datosfacturas as df on df.idFactura = f.idFacturaVenta
			JOIN tiposfacturas as tf on tf.idTipoFactura = df.idTipoFactura
			WHERE f.fechaPedido BETWEEN '{$_POST['fDesde']}' AND '{$_POST['fHasta']}'";
			$rsFechaTp=mysqli_query($conexion,$queryFechatp);
	}
			$idPersona=$_SESSION['login'];
			$queryEmpleado="SELECT LegajoEmpleado as legajo FROM empleados 
			where idPersona=$idPersona";
			$resultEMP=mysqli_query($conexion,$queryEmpleado);
			while ($r=mysqli_fetch_array($resultEMP)) {
				$legajoEmp=$r['legajo'];
			}
			date_default_timezone_set('America/Argentina/Buenos_Aires');
			$fechaBase=date('Y-m-d');
			$fechaActual = date('d/m/Y');
			$filename="reporteVenta__".$fechaActual;//id Factura
			
		
			$pdf= new PDF();
			$pdf->AddPage();
			$pdf->AliasNbPages();
		
		
			$cont=0;
			$totalG=0;
			while($rs=mysqli_fetch_array($rsFechaTp)){

				$fechaCompra=date('d/m/Y',strtotime($rs['fp']));
				
				$totalV=0;
				
				$select="SELECT pr.descripcion,fd.precioUnitario,fd.cantidad, f.idFacturaVenta as nFact, f.totalApagar as total, f.fechaPedido as fp, p.nombre,p.apellido 
				FROM facturas as f 
				JOIN personas as p on p.idPersona = f.idPersona
				JOIN facturadetalles as fd on fd.idFactura=f.idFacturaVenta
				JOIN productos as pr on pr.idProducto=fd.idProducto
				JOIN datosfacturas as df on df.idFactura=fd.idFactura
				  AND fd.idFactura=".$rs['nFact']." AND f.idPersona=".$rs['idPersona'];
			    $detalle=mysqli_query($conexion,$select);
				$pdf->SetFillColor(255, 175, 0);
				$pdf->SetFont('Arial','B',10);
			 
				$pdf->Cell(90,6,utf8_decode('Cliente: '.$rs['nombre']." ".$rs['apellido']),1,0,'C',1);
			    
			    $pdf->Cell(90,6,utf8_decode('fecha compra: '.$fechaCompra),1,0,'C',1);
				$pdf->Ln(6);
				
				$pdf->Cell(90,6,utf8_decode('N° Factura: '.$rs['numFactura']),1,0,'C',1);
				$pdf->Cell(90,6,utf8_decode('Tipo: '.$rs['descripcion']),1,0,'C',1);
				$pdf->Ln(6);
				$pdf->Cell(180,6,utf8_decode('detalle:'),1,0,'C',1);
				
				$pdf->SetFont('Arial','B',10);
				$pdf->Ln(6);
				$pdf->Cell(45,7,'Producto',1,0,'C',1);
				$pdf->Cell(45,7,'Cantidad',1,0,'C',1);
				$pdf->Cell(45,7,'Precio',1,0,'C',1);
				$pdf->Cell(45,7,'Subtotal',1,0,'C',1);
				$pdf->Ln(5);
				$pdf->SetFillColor(232,232,232);
				$pdf->SetFont('Arial','B',8);
			while ($r=mysqli_fetch_array($detalle)) {
				$totalV+=$r['cantidad']*$r['precioUnitario'];
			    $pdf->Ln(2);
			
			
				
				if ($cont %2) {	
					
			
		
			
		
			
			
			
					$pdf->Cell(45,7,utf8_decode($r['descripcion']),1,0,'C',1);
					$pdf->Cell(45,7,$r['cantidad'],1,0,'C',1);
					
					$pdf->Cell(45,7,"$".$r['precioUnitario'],1,0,'C',1);
					$pdf->Cell(45,7,"$".$r['precioUnitario']*$r['cantidad'],1,0,'C',1);
		
					$pdf->Ln(4);
					
					$totalG+=$r['total'];
					$cont++;
				}else{
					
					$pdf->Cell(45,6,utf8_decode($r['descripcion']),1,0,'C',1);
					$pdf->Cell(45,6,$r['cantidad'],1,0,'C',1);
					
					$pdf->Cell(45,6,"$".$r['precioUnitario'],1,0,'C',1);
					$pdf->Cell(45,6,"$".($r['precioUnitario']*$r['cantidad']),1,0,'C',1);
					$pdf->Ln(4);
					
					$totalG+=$r['total'];
					$cont++;
				}
		
			}
			$pdf->Ln(2);
			$pdf->SetFillColor(255, 175, 0);
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(180,6,utf8_decode('TOTAL=$'.$totalV),1,0,'C',1);
		}
			
			
			$pdf->Output('I',"reportesCreados/ReportesVentas/".$filename.'.pdf');
			header("location:index.php?Reporte=1");
	
	
?>