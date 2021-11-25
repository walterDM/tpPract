<?php require ("conexion.php");
	$tp=$_POST['newTP']; 
	$select= "SELECT descripcion from tiposproductos where descripcion='$tp'";
	$qtp= mysqli_query($conexion,$select);
	$yaExiste=mysqli_num_rows($qtp);
	
	if ($yaExiste==0) {
			//agregarlo a la BD
			
		}
	
	if ($yaExiste==0) {
		//Agregar a la BD
		 $insert="INSERT INTO marcas values (00,'$marca')";
		 $qInsert=mysqli_query($conexion,$insert);
		//notificacion exitosa de marca Agregada
		header("location:modificarMarca.php?estadoM=3");
			}
	else{
		
		header("location:modificarMarca.php?estadoM=4");
	}
?>