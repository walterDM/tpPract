<?php
	
	require ('../conexion.php');
	$html="<option>seleccione provincia</option>";
	$id_estado = $_POST['id_estado'];
    $select=mysqli_query($conexion,"SELECT idPais FROM paises WHERE nombrePais='$id_estado'");
    while($r=mysqli_fetch_array($select)){
        $idPais=$r['idPais'];
    }
	$queryM = "SELECT DISTINCT  idProvincia, nombreProvincia FROM provincias WHERE idPais=$idPais ORDER BY nombreProvincia ASC";
	$resultadoM = $conexion->query($queryM);
	
	
	while($rowM = $resultadoM->fetch_assoc())
	{
		$html.= "<option value='".$rowM['idProvincia']."'>".$rowM['nombreProvincia']."</option>";
	}
	
    echo $html;
    ?>
 