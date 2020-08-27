<!DOCTYPE html>
<html>
<head>
    <title>Inicio</title>
</head>
<body style="background:#ffe0b2">
   <?php 
      require("header.php");
      require("conexion.php");  
      $grupo=mysqli_query($conexion,"SELECT p.nombrePermiso FROM permisos AS p, grupospermisos AS up WHERE (p.nombrePermiso='buscar usuario' OR p.nombrePermiso='baja usuario' OR p.nombrePermiso='modificar usuario') AND p.idPermiso=up.idPermiso AND up.idGrupo='$idGrupo'"); 
   ?>
   <div class="container-fluid">
       <div class="row">
       <div class="col-md-12">
               <?php 
               if($r=mysqli_fetch_array($grupo)){
                $nombrePermiso=$r['nombrePermiso'];
                if($nombrePermiso=="alta usuario" || $nombrePermiso=="baja usuario" || $nombrePermiso=="modificar usuario" || $nombrePermiso=="buscar usuarioS"){?>
               
           </div>
		</div>
		<div class="row" style="padding-top:40px">
			<div class="col s12">
				<input style="width:100%" type="text" id="dato" autofocus="true" placeholder="Ingerse el nombre de usuario" onkeyup="buscar()">
            </div>
            <br><br>
		</div>
        <div id="result" style="border: 1px solid white; height: 300px; overflow-y: scroll;background:#fafafa"></div>
      
              <?php 
            }
         }else{?>
                <div class="col-md-12" style="padding-top:10px">
                <div class="alert alert-warning" role="alert">
                     <h2 align="center">ACCESO DENEGADO</h2>

</div>
            </div>
                  <?php }?>
     
     </div>
   </div>
   <br><br><br><br><br>
   <?php 
        if (isset($_GET['actualizado'])&& $_GET['actualizado']==1) {
          echo "<script type='text/javascript'>alert('fue actualizado con exito');</script>";
        }
        if (isset($_GET['error'])&& $_GET['error']==2) {
          echo "<script type='text/javascript'>alert('ERROR AL REGISTRAR: el legajo ingresado ya existe');</script>";
        }
        if (isset($_GET['error'])&& $_GET['error']==3) {
          echo "<script type='text/javascript'>alert('ERROR AL REGISTRAR: el numero de documento ingresado ya existe');</script>";
        }
        if (isset($_GET['error'])&& $_GET['error']==4) {
            echo "<script type='text/javascript'>alert('ERROR AL REGISTRAR: el email ingresado ya existe');</script>";
          }
        if (isset($_GET['eliminado'])&& $_GET['eliminado']==1) {
            echo "<script type='text/javascript'>alert('el usuario fue eliminado');</script>";
          }
       ?>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/2be8605e79.js"></script>
	<script>
		function buscar(){
			if(document.getElementById('dato').value.length>0){
    
				$.ajax({
					url: 'buscarUser.php',
					type: 'POST',
					data: { 
						dato: document.getElementById('dato').value, 
					},
				})
				.done(function(response){
					$("#result").html(response);
				})
				.fail(function(jqXHR){
					console.log(jqXHR.statusText);
				});
			}else{
                
			}
		}
        function init(){
               $('#GestionarUsuarios').attr("class","");
               $('#GestionarUsuarios').attr("class","btn btn-danger");
           }
           window.onload = function () {
             init();
           }
    </script>

 </body>
</html>
