<?php 
session_start();
require 'conexion.php';
include 'includes/plantillaF.php';
$idPersona=$_SESSION['login'];
$total=$_SESSION['total'];
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha=date('Y-m-d');
$fechaP=date('d-m-Y');
$calle=$_SESSION['calle'];
$altura=$_SESSION['altura'];
$datos=$_SESSION['carrito'];

$insert=mysqli_query($conexion,"INSERT INTO facturas VALUES(00,$idPersona,$total,'$fecha')");
$idFactura=mysqli_insert_id($conexion);


echo $idPersona." ".$total." ".$fecha." ";
$insert=mysqli_query($conexion,"INSERT INTO facturas VALUES(00,$idPersona,$total,'$fecha',3)");
$idFactura=mysqli_insert_id($conexion);
//TRAIGO DATOS PARA EL ORIGEN DEL NUMERO DE FACTURA
$querynFact="SELECT df.numFactura n,tt.Abreviacion a
FROM `datosfacturas` as df
JOIN tipostransacciones as tt on tt.idTipoTransaccion=df.idTipoTransaccion
WHERE idFactura = (
              SELECT MAX(idFactura) 
              FROM `datosfacturas` 
             )";
$rsnFact=mysqli_query($conexion,$querynFact);

while ($rn=mysqli_fetch_array($rsnFact)) {
	$nFact=$rn['n']+1;
	$numFactura= "001-".$nFact;}
echo $numFactura;
$insert=mysqli_query($conexion,"INSERT INTO datosfacturas (idFactura, numFactura)VALUES($idFactura,$nFact)");
for ($i=0; $i<count($datos);$i++){ 
	$idProd=$datos[$i]['IdProducto'];
	$cant=$datos[$i]['Cantidad'];
	$precio=$datos[$i]['Precio'];

$insertDetalle=mysqli_query($conexion,"INSERT INTO `facturadetalles`(`idFactura`, `idProducto`, `cantidad`, `precioUnitario`) VALUES ($idFactura,$idProd,$cant,$precio)");
//se trae las cantidades con respecto a cada item del carrito y se le hace el update correspondiente
$queryProd="SELECT cantidadProd as cant from productos where idProducto = $idProd";
$rsProd= mysqli_query($conexion,$queryProd);
while ($rProd= mysqli_fetch_array($rsProd)) {
	$cantN=$rProd['cant']-$cant;
	$estado='Activo';
	if ($cantN==0) {
		$estado='Agotado';	}
}
$updateProd="UPDATE `productos` SET `cantidadProd`=$cantN,`estado`='$estado'
 WHERE idProducto=$idProd";
 $queryUpdate=mysqli_query($conexion, $updateProd);

$insertDetalle=mysqli_query($conexion,"INSERT INTO facturasdetalles VALUES($idFactura,$idProd,$cant,$precio");

}

//TRAIGO DATOS PARA EL ORIGEN DEL NUMERO DE FACTURA
$querynFact="SELECT df.numFactura n,tt.Abreviacion a,tf.descripcion as t
FROM `datosfacturas` as df
JOIN tipostransacciones as tt on tt.idTipoTransaccion=df.idTipoTransaccion
JOIN tiposfacturas as tf on tf.idTipoFactura=df.idTipoFactura
WHERE idFactura = (
              SELECT MAX(idFactura) 
              FROM `datosfacturas` 
             )";
$rsnFact=mysqli_query($conexion,$querynFact);

while ($rn=mysqli_fetch_array($rsnFact)) {
	
	$nFact=$rn['n']+1;
	$tFact=$rn['t'];
	$numFactura= "001-".$rn['a'].$nFact;
    $filename='FacturaVenta_n°_'.$numFactura;
}

$insert=mysqli_query($conexion,"INSERT INTO datosfacturas (idFactura, numFactura)VALUES($idFactura,$nFact)");



$cliente=$_SESSION['login'];
$nombreC=mysqli_query($conexion,"SELECT nombre, apellido from personas where idPersona=$cliente");
while ($r=mysqli_fetch_array($nombreC)) {
	$ncliente=$r['nombre']." ".$r['apellido'];
	}
	$pdf= new PDF();
	
	$pdf->AddPage();
	$pdf->AliasNbPages();

	
	$pdf->SetFont('Arial','B',14);
	$y=$pdf->GetY();
	$pdf->SetXY(140,$y-4);
	$pdf->Cell(70,6,utf8_decode('Factura N°: '.$numFactura),0,0,'C',0);
	$y= $pdf->GetY();

	$pdf->SetXY(140,$y+10);
	$pdf->Cell(70,6,utf8_decode('Fecha: '.$fechaP),0,0,'C',0);
	$pdf->setXY(10,35);
	$pdf->SetFillColor(232,232,232);
	$pdf->Cell(30,6,"Tipo Factura : ".$tFact,0,0,'C',0);

	$y= $pdf->GetY();
	$pdf->setXY(20,50);
	$pdf->SetFillColor(232,232,232);
	$pdf->Cell(30,6,"Cliente : ".$ncliente,0,0,'C',0);
	$y=$pdf->GetY();
	$pdf->setXY(30,$y+10);
	$pdf->SetFillColor(232,232,232);
	$pdf->Cell(30,6,"Domicilio de Entrega : ".$calle." ".$altura,0,0,'C',0);
	


	$y= $pdf->GetY();
	$pdf->SetY($y+25);
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(35,10,'Producto',1,0,'C',1);
	$pdf->Cell(30,10,'Cant.',1,0,'C',1);
	$pdf->Cell(50,10,'Precio Unitario',1,0,'C',1);
	$pdf->Cell(50,10,'Total Producto',1,0,'C',1);
	$pdf->Ln(7);
	$totalC=0;

	 for ($i=0; $i<count($datos);$i++){ 
	 	$subTotal=$datos[$i]['Cantidad']*$datos[$i]['Precio'];
	 	$pdf->Ln(4);
		$pdf->SetFillColor(232,232,232);
		$pdf->SetFont('Arial','B',14);
		$pdf->Cell(35,10,$datos[$i]['Descripcion'],1,0,'C',1);
		$pdf->Cell(30,10,$datos[$i]['Cantidad'],1,0,'C',1);
		$pdf->Cell(50,10,$precio,1,0,'C',1);
		$pdf->Cell(50,10,$subTotal,1,0,'C',1);
		$totalC+=$subTotal;
		$pdf->Ln(4);
	}
	$pdf->Ln(8);
	$pdf->SetFont('Arial','B',14);
	$pdf->SetFillColor(232,232,232);

	$pdf->Cell(165,6,"Total Compra : ".$totalC,1,0,'C',1);
	$pdf->Output('F',$filename.'.pdf');
	header("location:index.php");
?>