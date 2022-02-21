
<?php
require("conexion.php");
$idCt = $_POST['idct'];
$descripcion      = $_POST['descripcion'];


$update = ("UPDATE personascontactos 
	SET 
	descripcion  ='" .$descripcion. "' 

WHERE idPersonaContacto='" .$idCt. "'
");
$result_update = mysqli_query($conexion, $update);

echo "<script type='text/javascript'>
        window.location='perfilUsuario.php';
    </script>";


?>
