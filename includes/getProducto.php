<?php
	
	require ('../conexion.php');
	
	$id_estado = $_POST['id_estado'];
	
	$queryM = "SELECT DISTINCT  p.idProducto,p.descripcion FROM productos as p 
               inner join  productostpmarcas as ptm on  ptm.idProducto=p.idProducto 
               inner join  tiposproductos_marcas as tpm on tpm.idTpMarca = ptm.idTpMarca
               and tpm.idMarca=$id_estado ORDER BY p.descripcion ASC";
	$resultadoM = $conexion->query($queryM);
	
	$html= "<option value='0'>Seleccionar producto</option>";
	
	while($rowM = $resultadoM->fetch_assoc())
	{
		$html.= "<option value='".$rowM['idProducto']."'>".$rowM['descripcion']."</option>";
	}
	
	echo $html;