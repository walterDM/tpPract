<?php     
function conectar(){
    $conexion= mysqli_connect("127.0.0.1","root","","tppract");
    if (!$conexion) {
      echo "Error al conectar base";
    } 
    return $conexion;
  }
  $id_usuario=0;
  $idGrupo=0;
  $nombre_usuario="";
  session_start();
      if (isset($_SESSION['login'])) {
        $id_usuario=$_SESSION['login'];
        $nombre_usuario=$_SESSION['usuario'];
        $idGrupo=$_SESSION['grupo'];
        }

  function killSession(){
    if (isset($_POST['borrarSesion'])) {
      session_destroy();
      $id_usuario=0;
      $nombre_usuario="";
      header("location:index.php");
    }
  }

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="estilos.css">
  
  <style>
    .menu li a{
    color:white;
    font-size:15px
}
.dropdown-item{
  color:#ffa726;
}
.dropdown-item:hover{
  color:white;
  background:#ffa726;
}
  </style>
</head>
<body style="background:#D7EEEE">
<?php 
require("conexion.php");?>

  
                    <?php $grupo=mysqli_query($conexion,"SELECT p.nombrePermiso,up.idPermiso FROM permisos AS p, grupospermisos AS up WHERE p.idPermiso=up.idPermiso AND up.idGrupo='$idGrupo'");
                    $grupo2=mysqli_query($conexion,"SELECT p.nombrePermiso,up.idPermiso FROM permisos AS p, grupospermisos AS up WHERE p.idPermiso=up.idPermiso AND up.idGrupo='$idGrupo'");
                    $grupo3=mysqli_query($conexion,"SELECT p.nombrePermiso,up.idPermiso FROM permisos AS p, grupospermisos AS up WHERE p.idPermiso=up.idPermiso AND up.idGrupo='$idGrupo'");
                    $grupo4=mysqli_query($conexion,"SELECT p.nombrePermiso,up.idPermiso FROM permisos AS p, grupospermisos AS up WHERE p.idPermiso=up.idPermiso AND up.idGrupo='$idGrupo'");
                         
           
                            
                    
                  
     
  $select=mysqli_query($conexion,"SELECT * FROM tiposdocumentos");
  $select2=mysqli_query($conexion,"SELECT * FROM tiposproductos");
while ($r=mysqli_fetch_array($select)) {
  $descripcion=$r['descripcion'];
}
?>
 <div style="background:#ffb74d">  
    <nav class="navbar navbar-expand-lg navbar-light nav1" style="float:right">
        <button style="background: white" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
           <ul class="navbar-nav mr-auto">
               <?php if ($id_usuario==0): ?>
               <li class="nav-item active">
                   <a class="btn btn-light" href="#" data-toggle="modal" data-target="#ingresar" onclick="ingresar();">Iniciar Sesion</a>
               </li>
               <li class="nav-item active">
                   <a class="btn btn-light" href="#" data-toggle="modal" data-target="#registrar" onclick="registrar();">Registrate</a>
               </li>
               <?php else: ?>
               <li class="nav-item dropdown">
                    <a class="dropdown-toggle btn btn-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <?php echo $nombre_usuario;?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <form action="index.php" method="POST">
                               <button  type="submit" class="dropdown-item" name="borrarSesion" onclick="<?php killSession();?>">Cerrar Sesión</button>
                            </form>
                    </div>
               </li>
               <?php endif ?> 
           </ul>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-light nav1">
    <a class="navbar-brand" href="index.php"><img src="imagenes/logo.jpeg" style="width:200px;height: 50px;border-radius: 50px"></a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
           <ul class="nav menu">
                <li class="nav-item">
                   <a id="inicio" class="nav-link" href="index.php">Inicio</a>
                </li>
                <li class="nav-item dropdown">
                  <a id="productos" href="#" style="color:white" class="btn  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Productos</a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <?php while($r=mysqli_fetch_array($select2)){?>
                        <form id="productos1" action="productos.php?categoria=<?php echo $r['descripcion']?>" method="POST">
                          <button type="submit" class="dropdown-item"><?php echo $r['descripcion']?></button>
                        </form>
                  <?php }?>
                      </div>
                </li>
                <li class="nav-item">
                     <a class="nav-link" href="contacto.php">Contacto</a>
                </li>

                <li class="nav-item dropdown">
                           
                            <a id="gestiprod" href="#" style="color:white" class="btn  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" <?php echo "hidden";?>>Gestionar productos</a>
                          
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              <?php 
                              while($r=mysqli_fetch_array($grupo)){ 
                                $nombrePermiso=$r['nombrePermiso'];
                              switch($nombrePermiso){
                                        case "alta producto":
                                             echo "<script>document.getElementById('gestiprod').hidden=false;</script>";?>
                                            <form id="altaProducto" action="altaProducto.php" method="POST">
                                               <button type="submit" class="dropdown-item">Alta producto</button>
                                            </form>
                                        <?php break;
                                        case "buscar producto":
                                            echo "<script>document.getElementById('gestiprod').hidden=false;</script>";?>
                                            <form id="buscarProducto" action="" method="POST">
                                               <button type="submit" class="dropdown-item">Buscar producto</button>
                                            </form>
                                        <?php break;
                                        case "realizar envios":
                                            echo "<script>document.getElementById('gestiprod').hidden=false;</script>";?>
                                            <form id="realizarEnvio" action="" method="POST">
                                               <button type="submit" class="dropdown-item">Realizar envios</button>
                                            </form>
                                  <?php break;
                                   }
                              }
                                ?>
                            </div>
                        </li>
          
                <li class="nav-item dropdown">
                  <a id="gestiproveedores" href="#" style="color:white" class="btn  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" <?php echo "hidden";?>>Gestionar proveedores</a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php 
                        while($r=mysqli_fetch_array($grupo2)){ 
                          $nombrePermiso=$r['nombrePermiso'];
                        switch($nombrePermiso){
                          case "alta proveedor":
                              echo "<script>document.getElementById('gestiproveedores').hidden=false;</script>";?>
                        <form id="altaProveedor" action="" method="POST">
                          <button type="submit" class="dropdown-item">Alta proveedor</button>
                        </form>
                          <?php break;
                          case "buscar proveedores":
                            echo "<script>document.getElementById('gestiproveedores').hidden=false;</script>";?>
                        <form id="buscarProveedor" action="" method="POST">
                          <button type="submit" class="dropdown-item">Buscar proveedor</button>
                        </form>
                          <?php break;
                           case "realizar pedidos":
                              echo "<script>document.getElementById('gestiproveedores').hidden=false;</script>";?>
                        <form id="realizarPedidos" action="" method="POST">
                          <button type="submit" class="dropdown-item">Realizar pedidos</button>
                        </form>
                           <?php break;
                           }
                          }?>
                      </div>
                </li>
                <li class="nav-item dropdown">
                  <a id="gestiusuarios" href="#" style="color:white" class="btn  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" <?php echo "hidden";?>>Gestionar usuarios</a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <?php 
                        while($r=mysqli_fetch_array($grupo3)){ 
                          $nombrePermiso=$r['nombrePermiso'];
                        switch($nombrePermiso){
                          case "alta usuario":
                              echo "<script>document.getElementById('gestiusuarios').hidden=false;</script>";?>
                        <form id="altaUsuario" action="" method="POST">
                          <button type="submit" class="dropdown-item">Alta usuario</button>
                        </form>
                          <?php break;
                          case "buscar usuarios":
                          echo "<script>document.getElementById('gestiusuarios').hidden=false;</script>";?>

                        <form id="buscarUsuario" action="" method="POST">
                          <button type="submit" class="dropdown-item">Buscar usuarios</button>
                        </form>
                        <?php break;
                          case "asignar permisos":
                          echo "<script>document.getElementById('gestiusuarios').hidden=false;</script>";?>
                        <form id="asignarPermisos" action="asignarPermisos.php" method="POST">
                          <button type="submit" class="dropdown-item">Asignar permisos</button>
                        </form>
                        <?php break;
                          case "listar cliente":
                          echo "<script>document.getElementById('gestiusuarios').hidden=false;</script>";?>
                        <form id="listarCliente" action="" method="POST">
                          <button type="submit" class="dropdown-item">Listar clientes</button>
                        </form>
                          <?php break;
                          }
                        }?>
                      </div>
                </li>
                <li class="nav-item dropdown">
                  <a id="reportes" href="#" style="color:white" class="btn  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" <?php echo "hidden";?>>Reportes</a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <?php 
                        while($r=mysqli_fetch_array($grupo4)){ 
                          $nombrePermiso=$r['nombrePermiso'];
                        switch($nombrePermiso){
                          case "reportes de ventas":
                              echo "<script>document.getElementById('reportes').hidden=false;</script>";?>
                        <form id="Rventas" action="" method="POST">
                          <button type="submit" class="dropdown-item">Reportes de ventas</button>
                        </form>
                          <?php break;
                          case "reportes de stock":
                            echo "<script>document.getElementById('reportes').hidden=false;</script>";?> 
                        <form id="Rstock" action="" method="POST">
                          <button type="submit" class="dropdown-item">Reportes de stock</button>
                        </form>
                        <?php break;
                          case "reportes de caducidad":
                            echo "<script>document.getElementById('reportes').hidden=false;</script>";?>
                        <form id="Rcaducidad" action="" method="POST">
                          <button type="submit" class="dropdown-item">Reportes de caducidad</button>
                        </form>
                          <?php break;
                          }
                        }?>
                      </div>
                </li>
            </ul>
        </div>
    </nav>
 </div>
    <div data-backdrop="static"  class="modal fade" id="ingresar">
	    <div class="col-md-12 modal-dialog" >
	        <div class="modal-content">
	            <div class="modal-header">
	                <h4 class="modal-title">Iniciar Sesión</h4>
	                <button type="button" class="close" data-dismiss="modal">X</button>
	            </div>
	            <div class="col-md-12" style="background:#e0e0e0">
		            <div class="modal-body" >
		               <form action="login.php" method="POST">
		          		   <div class="form-group" id="user-group">
		            		   <label for="user">Usuario</label>
		            		   <i class="fas fa-user"></i><input type="text" class="form-control" name="usuario" id="usuario"  placeholder="ingrese su e-mail">
		        	  	   </div>
		        	  	   <div class="form-group" id="password-group">
						       <label for="contra">Contraseña</label>
						       <i class="fas fa-lock"></i><input type="password" class="form-control" name="contrasenia" id="contrasenia" placeholder="ingrese su contraseña">
					  	   </div>
					  	   <div class="form-group">
		          			   <button type="submit" class="btn btn-light"  name="acept" value="acept">Ingresar</button>
		            	   </div>
		               </form>
		    		</div>
	    	   </div>	
	        </div>
	    </div>
    </div>
    <div data-backdrop="static"  class="modal fade" id="registrar">
	    <div class="col-md-12 modal-dialog modal-lg" >
	        <div class="modal-content">
	            <div class="modal-header">
	                <h4 class="modal-title">Registrate</h4>
	                <button type="button" class="close" data-dismiss="modal">X</button>
	            </div>
	            <div class="col-md-12" style="background:#e0e0e0">
		            <div class="modal-body" >
		               <form  method="POST" action="registrar.php"  onsubmit="return valida2(this)">
		               	<div class="row">
		               	 <div class="col-md-6">
		          		   <div class="form-group">
		            		   <label>Nombre</label>
		            		   <input type="text" class="form-control" name="nombre" id="nombre"  placeholder="ingrese su nombre">
		        	  	   </div>
		        	  	   <div class="form-group">
						       <label>Apellido</label>
						       <input type="text" class="form-control" name="apellido" id="apellido" placeholder="ingrese su apellido">
                             </div>
                             <div class="form-group">
						       <label>Tipo de documento</label>
						       <select class="form-control" id="tipodoc" name="tipodoc">
							      <option><?php echo $descripcion;?></option>
							   </select>
                             </div>
                             <div class="form-group">
						       <label>Numero de documento</label>
						       <input type="text" class="form-control" name="numDocumento" id="numDocumento" placeholder="ingrese numero de documento">
                             </div>
					  	  </div>
					  	  <div class="col-md-6">
                            <div class="form-group">
						       <label>Fecha de nacimiento</label>
						       <input type="date" class="form-control" name="fechaNac" id="fechaNac">
					  	   </div>
					  	   <div class="form-group">
						       <label>Usuario</label>
						       <input type="text" class="form-control" name="usuario" id="usuario" placeholder="ingrese su usuario">
					  	   </div>
					  	   <div class="form-group">
						       <label>Contraseña</label>
						       <input type="password" class="form-control" name="contrasenia" id="contr" placeholder="ingrese su contraseña">
					  	   </div>
					  	  </div>
					  	  <div class="col-md-12">
					  	   <div class="form-group">
		          			   <button name="registrado" value="registrado" id="btn2" class="btn btn-light" onclick="valida2()">registrate</button>
		            	   </div>
		            	  </div>
		            	</div>
		               </form>
		    		</div>
	    	   </div>	
	        </div>
	    </div>
</div>
<?php if (isset($_GET['estado'])&& $_GET['estado']==1) {
	echo "<script type='text/javascript'>
             setTimeout(function(){alert('fue registrado con exito!');},100,'JavaScript');
             window.onload = function () {
                  login();
             }
		    </script>";
}
if (isset($_GET['estado'])&& $_GET['estado']==2) {
  echo "<script type='text/javascript'>setTimeout(function(){alert('el mail ingresado ya existe, intente con otro.');},500,'JavaScript');</script>";}
if (isset($_GET['usuario'])&& $_GET['usuario']>0) {
  echo "<script type='text/javascript'>setTimeout(function(){alert('bienvenido $nombre_usuario!');},500,'JavaScript');</script>";}
if (isset($_GET['error'])&& $_GET['error']==1) {
  echo "<script type='text/javascript'>
           setTimeout(function(){alert('usuario o contraseña incorrecta');},100,'JavaScript');
           window.onload = function () {
                  login();
             }
      </script>";}
?>
    <script type="text/javascript" src="jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/2be8605e79.js"></script>
    <script type="text/javascript" src="login.js"></script>  
</body>
</html>