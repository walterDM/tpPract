<?php 	
session_start();
function conectar(){
	$conexion= mysqli_connect("127.0.0.1","root","","tppract");
	if (!$conexion) {
		echo "Error al conectar base";
	} 
	return $conexion;
}
conectar();
$usuario=$_REQUEST['us'];
$password=sha1($_REQUEST['contrasenia']);
$db=conectar();
$consulta= mysqli_query($db,"SELECT * FROM personas where usuario='$usuario' and contrasenia='$password'"); 
if($p=mysqli_fetch_assoc($consulta)){
	$idPersona=$p['idPersona'];
	if ($p['usuario']==$usuario && $p['contrasenia']==$password) {
		$select=mysqli_query($db,"SELECT idGrupo FROM gruposusuarios WHERE idPersona=$idPersona");
		while($r=mysqli_fetch_array($select)){
			$idGrupo=$r['idGrupo'];
			$_SESSION['grupo']=$idGrupo;
		}
		$_SESSION['login']=$p['idPersona'];
		$_SESSION['usuario']=$p['usuario'];
		echo '<div class="msjB">Bienvenido</div>';
		//echo "<script>window.location.href='index.php'</script>";
		echo "<script>window.location.reload();</script>";
	}
	
}else{
	echo '<div class="msj">Usuario o contraseña incorrecta</div>';
}
?>