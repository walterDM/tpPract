<?php
require("conexion.php");
$nombreGrupo=$_POST['nombreGrupo'];
$nombrePermiso=$_POST['nombrePermiso'];
$insert=mysqli_query($conexion,"INSERT INTO grupos VALUES(00,'$nombreGrupo')");
$select=mysqli_query($conexion,"SELECT idGrupo FROM grupos WHERE nombreGrupo='$nombreGrupo'");
while($r=mysqli_fetch_array($select)){$idGrupo=$r['idGrupo'];}
if(!empty($nombrePermiso)){
    // Ciclo para mostrar las casillas checked checkbox.
	foreach($_POST['nombrePermiso'] as $selected){
		$select2=mysqli_query($conexion,"SELECT idPermiso FROM permisos WHERE nombrePermiso='$selected'");
		while($r=mysqli_fetch_array($select2)){$idPermiso=$r['idPermiso'];}
		$insert2=mysqli_query($conexion,"INSERT INTO grupospermisos VALUES($idGrupo,$idPermiso)");
	}
	header("location:asignarPermisos.php");
}
?>