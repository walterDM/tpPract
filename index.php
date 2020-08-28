<!--agregue un comentario-->
<?php require("header.php"); 
$db=conectar();
$consulta=mysqli_query($db,"SELECT * FROM productos ");
$total_productos=mysqli_num_rows($consulta);
?>
<!DOCTYPE html>
<html>
   <head>
      <title>Inicio</title>
   </head>
   <body>

   <div class="container">
    
      	<div class="row justify-content-center">
			<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
					  <ol class="carousel-indicators">
						  <?php for($i=0;$i<$total_productos;$i++){ $active="active";?>
						    <li style="background:white" data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i;?>" class="<? echo $active;?>"></li>
						  <?php
						     $active="";
						  }
						   ?>
					  </ol>
				<div class="carousel-inner">
					  <?php $active="active";
					     while ($r=mysqli_fetch_array($consulta)) {?>
					  <div align="center" class="carousel-item <?php echo $active;?>">
					      <img src="imagenes/<?php echo $r['imagen'] ?>">
					    </div>
					    <?php 
					    $active="";
					  }
					  ?>
					  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
					    <span style="color:black" class="carousel-control-prev-icon" aria-hidden="true"></span>
					    <span class="sr-only">Previous</span>
					  </a>
					  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
					    <span class="carousel-control-next-icon" aria-hidden="true"></span>
					    <span class="sr-only">Next</span>
					  </a>
				</div>
			</div>
		
	  </div>
	  <?php
	     if (isset($_GET['registrado'])&& $_GET['registrado']==1) {
			echo "<script type='text/javascript'>alert('fue registrado con exito');</script>";
		  }
		  if (isset($_GET['error'])&& $_GET['error']==2) {
			echo "<script type='text/javascript'>alert('ERROR AL REGISTRAR: el dni ingresado ya existe');</script>";
		  }
		  if (isset($_GET['error'])&& $_GET['error']==3) {
			echo "<script type='text/javascript'>alert('ERROR AL REGISTRAR: el nombre de usuario ingresado ya existe');</script>";
		  }
		  if (isset($_GET['error'])&& $_GET['error']==4) {
			echo "<script type='text/javascript'>alert('ERROR AL REGISTRAR: el email ingresado ya existe');</script>";
		  } 
		  if (isset($_GET['recuperar'])&& $_GET['recuperar']==1){
			echo '<script> alert("se ha enviado un mail a su correo con el link de restablecer contraseña");</script>';
			
		}
		if (isset($_GET['recuperar'])&& $_GET['recuperar']==2){
			echo '<script> alert("Hubo problemas con el envio");</script>';
			
		}
		if (isset($_GET['recuperar'])&& $_GET['recuperar']==3){
			echo '<script> alert("el usuario no existe");</script>';
			
	    }
		  if(isset($_GET['cambiar']) && $_GET['cambiar']==1){
			 echo '<script> alert("su contraseña ha sido cambiada, ingrese con su contraseña nueva");</script>';
			 
		  }
	  ?>
	</div>
   </body>
</html>
