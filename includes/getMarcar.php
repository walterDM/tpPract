 <?php
	
	require ('../conexion.php');
	
	$id_estado = $_POST['id_estado'];
	
	$queryM = "SELECT DISTINCT  m.idMarca, m.nombreMarca FROM marcas as m inner join  tiposproductos_marcas as tpm on  tpm.idTipoProducto='$id_estado' and tpm.idMarca=m.idMarca ORDER BY m.nombreMarca ASC";
	$resultadoM = $conexion->query($queryM);
	
	$html= "<option value='0'>Seleccionar marca</option>";
	
	while($rowM = $resultadoM->fetch_assoc())
	{
		$html.= "<option value='".$rowM['idMarca']."'>".$rowM['nombreMarca']."</option>";
	}
	
	echo $html;