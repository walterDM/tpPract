<?php 
session_start();
require 'conexion.php';
include 'plantillaPDF.php'; 
if (isset($_POST['seleccionado']) && !empty($_POST['seleccionado']) && isset($_POST['cant'])) {

	$idPersona=$_SESSION['login'];
	$idProv=$_POST['idProveedor'];
	$idContacto=$_POST['idCP'];
	$vari=$_POST['seleccionado'];
	$prod=$_POST['idProducto'];
	$cant=$_POST['cant'];

	$queryEmpleado="SELECT LegajoEmpleado as legajo FROM empleados where idPersona=$idPersona";
	$resultEMP=mysqli_query($conexion,$queryEmpleado);
	while ($r=mysqli_fetch_array($resultEMP)) {
		$legajoEmp=$r['legajo'];
	}
	$fechaBase=date('Y-m-d');
	$insertPedido="INSERT INTO `pedidosproveedores`(`idProveedor`, `LegajoEmpleado`, `FechaPedido`) VALUES ($idProv,$legajoEmp,now())";
	$insertar=mysqli_query($conexion,$insertPedido);
	$idPedido=mysqli_insert_id($conexion);
	for ($i=0; $i <sizeof($vari) ; $i++) { 
		
		$InsertDP="INSERT INTO `detallespedidos`(`idPedidoProveedor`, `idProducto`, `Cantidad`) VALUES ($idPedido,$prod[$i],$cant[$i])";
		$queryDP=mysqli_query($conexion,$InsertDP);
	}
	$insertEP="INSERT INTO `estadospedidos`(`idPedidoProveedor`, `idContactoProveedor`, `idEstado`) VALUES ($idPedido,$idContacto,1)";
	$queryEP=mysqli_query($conexion,$insertEP);


	$queryProv="SELECT empresa from proveedores where idProveedor=$idProv";
	$queryP=mysqli_query($conexion,$queryProv);
	while($rs=mysqli_fetch_array($queryP)){
		$empresa=$rs['empresa'];
	}
	
	$filename="Pedido__".$idPedido;//id Factura
	$fechaActual = date('d-m-Y');

	$pdf= new PDF();
	
	$pdf->AddPage();
	$pdf->AliasNbPages();

	$pdf->SetXY(150,5);
	$pdf->Cell(70,6,utf8_decode('Pedido N°: '.$idPedido),0,0,'C',0);
	$y= $pdf->GetY();
	$pdf->SetXY(150,$y+5);
	$pdf->Cell(70,6,utf8_decode('Empresa: '.$empresa),0,0,'C',0);
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
	header("location:index.php?pedido=1");
}
?>