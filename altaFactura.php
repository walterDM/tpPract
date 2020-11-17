<?php 
session_start();
require 'conexion.php';
if ((isset($_SESSION['login'])&& !empty($_SESSION['login'])) && (isset($_SESSION['carrito']) && !empty($_SESSION['carrito']))) {
	$idPersona=$_SESSION['login'];
	$total=$_SESSION['total'];
	date_default_timezone_set('America/Argentina/Buenos_Aires');
	$fecha=date('Y-m-d');
	$fechaP=date('d-m-Y');
	$calle=$_SESSION['calle'];
	$altura=$_SESSION['altura'];
	$datos=$_SESSION['carrito'];

	echo $idPersona." ".$total." ".$calle." ";

//se carga Factura
	$insert=mysqli_query($conexion,"INSERT INTO facturas VALUES(00,$idPersona,$total,'$fecha')");
	$idFactura=mysqli_insert_id($conexion);
	echo "idFactura=".$idFactura;
//se cargan los datos de la factura (tipo y numFactura)
	$querynFact="SELECT df.numFactura n
	FROM `datosfacturas` as df
	WHERE idFactura = (
	SELECT MAX(idFactura) 
	FROM `datosfacturas`)";
$rsnFact=mysqli_query($conexion,$querynFact);
while ($rn=mysqli_fetch_array($rsnFact)) {
	$nFact=$rn['n']+1;
}

$insert=mysqli_query($conexion,"INSERT INTO datosfacturas (idFactura, numFactura)VALUES($idFactura,$nFact)");
//se insertan los detalles de la factura 
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
	}
	$_SESSION['factura']=$idFactura;
	unset($_SESSION['carrito']);
	header("location:facturaCompra.php");
}
?>