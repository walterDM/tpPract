
<!DOCTYPE html>
<html>
<head>
    <title>Cambiar contraseña</title>
    <style>
       .form{
          padding-top:100px;
       }
       .form label{
          float:left;
       }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body style="background:black;color:white">
   <?php 
      require("conexion.php");   
   ?>
   <div class="container">
       <div class="row">
        <?php if(isset($_GET['token'])){
            $token=$_GET['token'];
            $select=mysqli_query($conexion,"SELECT * FROM personas WHERE token='$token'");
            if($r=mysqli_fetch_array($select)){
                  $update=mysqli_query($conexion,"UPDATE personas SET token= null WHERE idPersona={$r['idPersona']}");?>
                  <div class="col-md-12" align="center"><h3><?php echo "bienvenido ".$r['usuario'];?></h3></div>
                  <div class="col-md-12 form" align="center">
                       <form action="recuperar.php?idPersona=<?php echo $r['idPersona'];?>&cambiar" method="POST" onsubmit="return form(this)" style="width:50%" class="rp">
                            <div class="form-row">
                               <div class="form-group col-md-12">
                                  <label for="inputEmail4">Contraseña nueva</label>
                                  <input type="password" class="form-control" name="contr" id="contr" placeholder="ingrese su contraseña nueva">
                               </div>
                               <div class="form-group col-md-12">
                                  <label for="inputPassword4">Repetir contraseña</label>
                                  <input type="password" class="form-control" id="contr2" placeholder="Repetir contraseña">
                               </div>
                            </div>
                            <button  class="btn btn-dark" style="width: 100%;" onclick="form()"><i class="fas fa-save"></i> Restablecer contraseña</button>
                       </form>
                  </div>
        <?php
          } 
        }
        ?>
      </div>
   </div>
   <?php 
         if(isset($_GET['idPersona']) && isset($_GET['cambiar'])){
            $id=$_GET['idPersona'];
            $password=sha1($_POST['contr']);
            $actualizar=mysqli_query($conexion,"UPDATE personas SET contrasenia='$password',token=null WHERE idPersona='$id'"); 
            header("location:index.php?cambiar=1");
         }?>
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/2be8605e79.js"></script>
   <script>
       function form(v){
        ok=true;
                msg="falta llenar campos: \n";
                if (v.elements["contr"].value=="") {
                   msg+="contraseña nueva\n";
                   ok=false;
                }
                if (v.elements["contr2"].value=="") {
                   msg+="Repetir contraseña\n";
                   ok=false;
                }
                if(v.elements['contr'].value != v.elements['contr2'].value){
                    msg="las contraseñas no coinciden";
                    ok=false;
                }
                if (ok==false) {
                      alert(msg);
                      return ok;
                }
       }
   </script>
 </body>
</html>
