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
		$usuario=$_POST['usuario'];
		$password=sha1($_POST['contrasenia']);
			$db=conectar();
			$consulta= mysqli_query($db,"SELECT * FROM personas where usuario='$usuario' and contrasenia='$password'"); 
			if($p=mysqli_fetch_assoc($consulta)){
		  		$idPersona=$p['idPersona'];
		  		if ($p['usuario']==$usuario && $p['contrasenia']==$password) {
					$id=$p['idPersona'];
					$select=mysqli_query($db,"SELECT idGrupo FROM gruposusuarios WHERE idPersona=$id");
					while($r=mysqli_fetch_array($select)){$idGrupo=$r['idGrupo'];}
		  			  $_SESSION['login']=$p['idPersona'];
					  $_SESSION['usuario']=$p['usuario'];
					  $_SESSION['grupo']=$idGrupo;
                    header("location:index.php");
		  		}
		  		
			}else{
				header("location:index.php?error=1");
			}
 ?>