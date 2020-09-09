<?php 
require 'conexion.php';
if (isset($_GET['seleccionado']) && !empty($_GET['seleccionado'])) {
	foreach ($_GET['seleccionado'] as $s) {
		$queryMTP="SELECT m.nombreMarca, tp.descripcion FROM marcas as m
					JOIN tiposproductos_marcas as tpm  on tpm.idMarca= m.idMarca 
					JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto
					where tpm.idTpMarca=$s";
		$resultMTP=mysqli_query($conexion,$queryMTP);
		while ($r=mysqli_fetch_array($resultMTP)) {
			echo "TIPO PRODUCTO: ".$r['descripcion']."<br>";
			echo "Marca: ".$r['nombreMarca']."<br>";
		}
	};
}
?>