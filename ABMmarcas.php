<?php require ("conexion.php");
	$marca=$_POST['newMarca']; 
	$select= "SELECT nombreMarca from marcas where nombreMarca='$marca'";
	$qMarca= mysqli_query($conexion,$select);
	$yaExiste=mysqli_num_rows($qMarca);
	
	if ($yaExiste==0) {
			//agregarlo a la BD
			
		}
	
	if ($yaExiste==0 && $marca!= "") {
		//Agregar a la BD
		 $insert="INSERT INTO marcas values (00,'$marca')";
		 $qInsert=mysqli_query($conexion,$insert);
		//notificacion exitosa de marca Agregada
		header("location:modificarMarca.php?estadoM=1");
			}
	else{
		
		header("location:modificarMarca.php?estadoM=2");
	}
?>