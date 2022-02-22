
<?php
require("conexion.php");
$idPersona=$_POST['idpersona'];
$idDireccion=$_POST['direccion'];
$idCiudad=$_POST['cbxciudad'];
$calle=$_POST['calle'];
$altura=$_POST['altura'];
$dpto=$_POST['dpto'];
$piso=$_POST['piso'];
$idTipoDomicilio=$_POST['tipodomicilio']; 



$update = ("UPDATE direcciones 
SET 
idCiudad=$idCiudad,
idTipoDomicilio=$idTipoDomicilio,
calle='". $calle ."',
altura=$altura,
dpto='". $dpto ."',
piso=$piso 
WHERE idDireccion=$idDireccion and idPersona=$idPersona"
);
$result_update = mysqli_query($conexion, $update);

header ("location:perfilUsuario.php?modificado=1");


?>
