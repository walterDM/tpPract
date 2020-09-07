<?php
	
	require ('../conexion.php');
	
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
    <script>
        $(document).ready(function(){
        $("#cbxprovincia").change(function () {	
 			$("#cbxprovincia option:selected").each(function () {
 				id = $(this).val();
 				$.post("includes/getCiudad.php", { id: id }, function(data){
 					$("#cbxciudad").html(data);
 				});            
 			});
 		});
    });
    </script>