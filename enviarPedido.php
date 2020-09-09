<?php 
require 'conexion.php';
if (isset($_POST['seleccionado']) && !empty($_POST['seleccionado']) && isset($_POST['cant'])) {
	$vari=$_POST['seleccionado'];
	/*echo count($vari);
	foreach ($_POST['seleccionado'] as $s) */
		for ($i=0; $i < sizeof($vari) ; $i++) { 
			$queryMTP="SELECT m.nombreMarca, tp.descripcion FROM marcas as m
			JOIN tiposproductos_marcas as tpm  on tpm.idMarca= m.idMarca 
			JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto
			where tpm.idTpMarca=$vari[$i]";
			$resultMTP=mysqli_query($conexion,$queryMTP);
			while ($r=mysqli_fetch_array($resultMTP)) {
				echo "TIPO PRODUCTO: ".$r['descripcion']."<br>";
				echo "Marca: ".$r['nombreMarca']."<br>";
			}
		};
	}
	if (isset($_POST['idCP'])) {
		$idCP=$_POST['idCP'];
		$queryCP="SELECT descripcion from contactosproveedores where idContactoProveedor=$idCP";
		$resultCP=mysqli_query($conexion,$queryCP);
		while($r=mysqli_fetch_array($resultCP)){
			echo $r['descripcion'];
		}
	}else{
		echo "no se recibio variable";
	}
	?>