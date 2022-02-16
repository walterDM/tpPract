
<?php
require("conexion.php");
if(isset($_POST['Modificar']) && !empty($_POST['Modificar'])){
    $nombreGrupo=$_POST['nombreGrupo'];
	$idGrupo=$_POST['idGrupo'];
	$update=mysqli_query($conexion,"UPDATE grupos SET nombreGrupo = '$nombreGrupo' WHERE idGrupo=$idGrupo");
	$delete=mysqli_query($conexion,"DELETE FROM grupospermisos WHERE idGrupo=$idGrupo");    
	foreach($_POST['idPermiso'] as $selected){
		$insert=mysqli_query($conexion,"INSERT INTO grupospermisos VALUES($idGrupo,$selected)");
	}
    echo "<script>alert('datos modificados con exito');</script>";
}
if(isset($_POST['delete']) && !empty($_POST['delete'])){
	$idGrupo=$_POST['id'];
	$pagina=$_POST['pag'];
	$delete1=mysqli_query($conexion,"DELETE FROM grupospermisos WHERE idGrupo=$idGrupo");
	$delete2=mysqli_query($conexion,"DELETE FROM gruposusuarios WHERE idGrupo=$idGrupo");
	$delete3=mysqli_query($conexion,"DELETE FROM grupos WHERE idGrupo=$idGrupo");
		  
	echo "<script>window.location.href ='listarGrupos.php?pagina=$pagina';</script>";
}
?>