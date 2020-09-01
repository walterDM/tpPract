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
  <link rel="stylesheet" type="text/css" href="bootstrap-4.3.1-dist/css/estilos.css">
  

</head>
<body >
<div class="container">
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
<div class="row" style="background:#ffb74d">
	<div class="col-md-3"><a class="navbar-brand" href="index.php"><img src="imagenes/logo.jpeg" style="width:200px;height: 50px;border-radius: 50px"></a></div>
	<div class="col-md-5" >
    <div id="posBuscador">
		  <form id="busquador" action="buscarProducto.php" method="GET">
		  	<label for="busqueda">Buscar</label>
		    <input type="text" name="busqueda" id="busqueda">
        <button  type="submit"><i class="fas fa-search"></i></i></button>
		  </form>
    </div>
	</div>
 <div class="col-md-4">  
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
    	
	    
   </div> 
 </div><!--termina color del header--> 	
 <div class="row justify-content-center">
    <div class="col-md-12" style="background:#ffb74d">
    <nav <?php if ($id_usuario==0) {echo 'id="posMenu"';}elseif ($id_usuario>0) {echo 'id="posMenu1"';} ?> class="navbar navbar-expand-lg navbar-light nav1"> 
        <div class="collapse navbar-collapse menustyle" id="navbarSupportedContent">
           <ul class="nav menu">
                <li class="nav-item">
                   <a id="inicio" class="nav-link" href="index.php">Inicio</a>
                </li>
                <li class="nav-item dropdown">
                  <a id="productos" href="#" style="color:white" class="btn  dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Productos</a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <?php while($r=mysqli_fetch_array($select2)){?>
                        <form id="altaProveedor" action="productos.php?categoria=<?php echo $r['descripcion']?>" method="POST">
                          <button type="submit" class="dropdown-item submenu"><?php echo $r['descripcion']?></button>
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
                                               <button type="submit" class="dropdown-item submenu">Alta producto</button>
                                            </form>
                                        <?php break;
                                        case "buscar producto":
                                            echo "<script>document.getElementById('gestiprod').hidden=false;</script>";?>
                                            <form id="buscarProducto" action="" method="POST">
                                               <button type="submit" class="dropdown-item submenu">Buscar producto</button>
                                            </form>
                                        <?php break;
                                        case "realizar envios":
                                            echo "<script>document.getElementById('gestiprod').hidden=false;</script>";?>
                                            <form id="realizarEnvio" action="" method="POST">
                                               <button type="submit" class="dropdown-item submenu">Realizar envios</button>
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
                        <form id="altaProveedor" action="altaProveedor.php" method="POST">
                          <button type="submit" class="dropdown-item submenu">Alta proveedor</button>
                        </form>
                          <?php break;
                          case "buscar proveedores":
                            echo "<script>document.getElementById('gestiproveedores').hidden=false;</script>";?>
                        <form id="buscarProveedor" action="buscarProveedor.php" method="POST">
                          <button type="submit" class="dropdown-item submenu">Buscar proveedor</button>
                        </form>
                          <?php break;
                           case "realizar pedidos":
                              echo "<script>document.getElementById('gestiproveedores').hidden=false;</script>";?>
                        <form id="realizarPedidos" action="" method="POST">
                          <button type="submit" class="dropdown-item submenu">Realizar pedidos</button>
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
                        <form id="altaUsuario" action="altaUsuario.php" method="POST">
                          <button type="submit" class="dropdown-item submenu">Alta usuario</button>
                        </form>
                          <?php break;
                          case "buscar usuarios":
                          echo "<script>document.getElementById('gestiusuarios').hidden=false;</script>";?>

                        <form id="buscarUsuario" action="buscarUsuarios.php" method="POST">
                          <button type="submit" class="dropdown-item submenu">Buscar usuarios</button>
                        </form>
                        <?php break;
                          case "asignar permisos":
                          echo "<script>document.getElementById('gestiusuarios').hidden=false;</script>";?>
                        <form id="asignarPermisos" action="asignarPermisos.php" method="POST">
                          <button type="submit" class="dropdown-item submenu">Asignar permisos</button>
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
                          <button type="submit" class="dropdown-item submenu">Reportes de ventas</button>
                        </form>
                          <?php break;
                          case "reportes de stock":
                            echo "<script>document.getElementById('reportes').hidden=false;</script>";?> 
                        <form id="Rstock" action="" method="POST">
                          <button type="submit" class="dropdown-item submenu">Reportes de stock</button>
                        </form>
                        <?php break;
                          case "reportes de caducidad":
                            echo "<script>document.getElementById('reportes').hidden=false;</script>";?>
                        <form id="Rcaducidad" action="" method="POST">
                          <button type="submit" class="dropdown-item submenu">Reportes de caducidad</button>
                        </form>
                          <?php break;
                          }
                        }?>
                      </div>
                </li>
            </ul>
        </div>
    </nav>
    	</div><!--termina col-->	
</div><!--termina row-->	


 <div data-backdrop="static"  class="modal fade" id="recuperar">
    <div class="col-md-12 modal-dialog" >
        <div class="modal-content">
            <div class="modal-header" style="background:#ffb74d;color:white">
                <h4 class="modal-title">Recuperar contraseña</h4>
                <button style="color:white" type="button" class="close" data-dismiss="modal" onclick="close()">X</button>
            </div>
            
              <div class="modal-body" style="background:#ffb74d;color:white">
                <form action="InicioRecuperar.php" method="POST">

                  <div class="form-row">
                    <div class="form-group col-md-12">
                      <label style="float:left" for="inputEmail4">ingrese su email</label>
                      <input class="form-control" type="email" name="usuario" id="usuario" required placeholder="ejemplo@ejemplo.com">
                    </div>
                  </div>
                  <div align="center">
                  <button type="submit" class="btn btn-light" name="send" value="send" style="width: 50%;">buscar</button>
                  </div>
                </form>
              </div>
            
        </div>
      </div>
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
                 <div align="center"><a style="color:black;text-decoration:none" href="#" data-toggle="modal" data-target="#recuperar" onclick="recup()">¿Olvidaste tu contraseña?</a></div>
					  	   <div align="center" class="form-group">
		          			   <button style="margin-top:7%;width:50%" type="submit" class="btn btn-light"  name="acept" value="acept">Ingresar</button>
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
                <form  method="POST" action="registrar.php"  onsubmit="return form(this)">
		               	<div class="row">
		               	 <div class="col-md-6">
                         
		          		   <div class="form-group">
		            		   <label>Nombre</label>
		            		   <input type="text" class="form-control" name="nombre" id="nombre"  placeholder="ingrese su nombre">
		        	  	   </div>
		        	  	    
                             <div class="form-group">
						       <label>Tipo de documento</label>
						       <select class="form-control" id="tipodoc" name="tipodoc">
							      <option><?php echo $descripcion;?></option>
							   </select>
                             </div>
                             <div class="form-group">
						       <label>Numero de telefono</label>
						       <input type="text" class="form-control" name="telefono" id="telefono" placeholder="ingrese numero de telefono" required>
                             </div>
                             <div class="form-group ">
						       <label>E-mail</label>
						       <input type="email" class="form-control" name="mail" id="mail" placeholder="example@example.com" required>
                 </div>
                             <div class="form-group">
						       <label>Usuario</label>
						       <input type="text" class="form-control" name="usuario" id="usuario" placeholder="ingrese su usuario">
					  	   </div>
					  	     </div>
					  	  <div class="col-md-6">
                <div class="form-group">
						       <label>Apellido</label>
						       <input type="text" class="form-control" name="apellido" id="apellido" placeholder="ingrese su apellido">
                             </div>
                             <div class="form-group">
						       <label>Numero de documento</label>
						       <input type="text" class="form-control" name="numDocumento" id="numDocumento" placeholder="ingrese numero de documento">
                             </div>
                            <div class="form-group">
						       <label>Fecha de nacimiento</label>
						       <input type="date" class="form-control" name="fechaNac" id="fechaNac">
                             </div>
                           
                             
                 <div class="form-group">
						       <label>Repetir E-mail</label>
						       <input type="email" class="form-control" id="mail2" placeholder="example@example.com" required>
                 </div>
                             
                             
                             
                             <div class="row">
                            
                             <div class="form-group col-md-6">
						                      <label>Contraseña</label>
						                       <input type="password" class="form-control" name="contrasenia" id="contr" placeholder="ingrese su contraseña" required>
                             </div>
                             <div class="form-group col-md-6">
						                      <label>Repetir Contraseña</label>
						                       <input type="password" class="form-control" id="contr2" placeholder="ingrese su contraseña" required>
                             </div>
                             </div>
                            </div>
                            
					  	  <div class="col-md-12" align="center">
					  	   <div class="form-group">
                                 <button style="width: 50%;" name="registrado" value="registrado" id="btn2" class="btn btn-light" onclick="form()">registrar usuario</button>
                                 <button style="width: 50%;" class="btn btn-dark" data-dismiss="modal"><i class="fas fa-ban"></i> Cancelar</button>
                           </div>
		            	  </div>
		            	</div>
		               </form>
		    		</div>
	    	   </div>	
	        </div>
	    </div>
</div>
	
</div><!--fin Container-->



<?php if (isset($_GET['estado'])&& $_GET['estado']==1) {
	echo "<script type='text/javascript'>
             setTimeout(function(){alert('fue registrado con exito!');},100,'JavaScript');
             window.onload = function () {
                  login();
             }
		    </script>";
}
if (isset($_GET['estado'])&& $_GET['estado']==2) {
  echo "<script type='text/javascript'>setTimeout(function(){alert('el mail ingresado ya existe, intente con otro.');},500,'JavaScript');</script>";
}
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
    <script src="bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/2be8605e79.js"></script>
    <script>
       function form(v){
        ok=true;
                msg="ERROR: \n";
                if(v.elements['contr'].value != v.elements['contr2'].value){
                    msg+="las contraseñas no coinciden \n";
                    ok=false;
                }
                if(v.elements['mail'].value != v.elements['mail2'].value){
                    msg+="El E-mail no coincide";
                    ok=false;
                }
                if (ok==false) {
                      alert(msg);
                      return ok;
                }
       }
       function recup(){
         document.getElementById('ingresar').hidden=true;
       }
       </script>  
       </body>
       </html>
