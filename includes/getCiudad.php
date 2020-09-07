<?php
	
	require ('../conexion.php');
	
	$id_estado = $_POST['id_estado'];
    $select=mysqli_query($conexion,"SELECT idProvincia FROM provincias WHERE nombreProvincia='$id_estado'");
    while($r=mysqli_fetch_array($select)){
        $idProvincia=$r['idProvincia'];
    }
	$queryM = "SELECT DISTINCT  idCiudad, nombreCiudad FROM ciudades WHERE idProvincia=$idProvincia ORDER BY nombreCiudad ASC";
	$resultadoM = $conexion->query($queryM);
	
	$html= "<option value='0'>Seleccionar provincia</option>";
	
	while($rowM = $resultadoM->fetch_assoc())
	{
		$html.= "<option value='".$rowM['idCiudad']."'>".$rowM['nombreCiudad']."</option>";
	}
	
	echo $html;