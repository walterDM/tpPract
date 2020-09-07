<?php
	
	require ('../conexion.php');
	
	$id_ciudad = $_POST['id_ciudad'];
    /*$select=mysqli_query($conexion,"SELECT idProvincia FROM provincias WHERE nombreProvincia='$id_ciudad'");
    while($r=mysqli_fetch_array($select)){
        $idProvincia=$r['idProvincia'];
    }*/
	$queryM = "SELECT DISTINCT  idCiudad, nombreCiudad FROM ciudades WHERE idProvincia=$id_ciudad ORDER BY nombreCiudad ASC";
	$resultadoM = $conexion->query($queryM);
	
	$html= "<option value='0'>Seleccionar provincia</option>";
	
	while($rowM = $resultadoM->fetch_assoc())
	{
		$html.= "<option value='".$rowM['idCiudad']."'>".$rowM['nombreCiudad']."</option>";
	}
	
	echo $html;
	?>