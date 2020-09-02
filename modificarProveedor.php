<?php 
require("conexion.php");
require("header.php");
if(isset($_SESSION['login'])){
$idGrupo=$_SESSION['grupo'];
$grupo=mysqli_query($conexion,"SELECT p.nombrePermiso FROM permisos AS p, grupospermisos AS up WHERE p.nombrePermiso='modificar proveedor' AND p.idPermiso=up.idPermiso AND up.idGrupo='$idGrupo'");
}

$select2=mysqli_query($conexion,"SELECT * FROM grupos");

?>
<!DOCTYPE html>
<html>
   <head>
      <title>Inicio</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="estilos.css">
   </head>
   <body style="background:#ffe0b2;font-weight:bold;">
      <div class="container">
          <div class="row">
        <?php 
            if(isset($_SESSION['login'])){
              if(isset($_POST['idProveedor'])){
                  $idProveedor=$_POST['idProveedor'];
                  $consulta="SELECT * FROM proveedores WHERE idProveedor='$idProveedor'";
                  $resultado=mysqli_query($conexion,$consulta);
                  $datos=mysqli_fetch_assoc($resultado);
                  

          $consulta2=mysqli_query($conexion,"SELECT idTipoContacto FROM tiposcontactos WHERE descripcion='email'");
          while($r=mysqli_fetch_array($consulta2)){$idTipoMail=$r['idTipoContacto'];}
          $consulta3=mysqli_query($conexion,"SELECT cp.descripcion FROM contactosproveedores AS cp,proveedores AS p WHERE cp.idProveedor=$idProveedor AND cp.idTipoContacto=$idTipoMail");
          $datoMail=mysqli_fetch_assoc($consulta3);
          $consulta4=mysqli_query($conexion,"SELECT idTipoContacto FROM tiposcontactos WHERE descripcion='telefono'");
          while($r=mysqli_fetch_array($consulta4)){$idTipoTelefono=$r['idTipoContacto'];}
          $consulta5=mysqli_query($conexion,"SELECT cp.descripcion FROM contactosproveedores AS cp,proveedores AS p WHERE cp.idProveedor=$idProveedor AND cp.idTipoContacto=$idTipoTelefono");
          $datoTelefono=mysqli_fetch_assoc($consulta5);
        ?>
                 <div class="col-md-12" style="padding-top:10px">
                   <form  method="POST" action="ABMProv.php" >
                    <input type="hidden" name="idProveedor" value="<?php echo$idProveedor?>">
                    <div class="row">
                     <div class="col-md-6">
                       <div class="form-group">
                         <label>Empresa</label>
                         <input type="text" class="form-control" name="empresa" id="empresa" value="<?php echo $datos['empresa'];?>">
                       </div>
                     </div>

                     <div class="col-md-6">
                       <div class="form-group">
                         <label>Dirección</label>
                         <input type="text" class="form-control" name="direccion" id="direccion" value="<?php echo $datos['direccion'];?>" placeholder="Ingrese la dirección">
                       </div>
                     </div>

                     <div class="col-md-6">
                      <div class="form-group">
                       <label>Cuit</label>
                       <input type="text" class="form-control" name="cuit" id="cuit" value="<?php echo $datos['cuit'];?>" placeholder="Ingrese el cuit">
                     </div>
                   </div>
                
                   <div class="col-md-6">
                    <div class="form-group">
                     <label>Telefono</label>
                     <input type="text" class="form-control" name="telefono" id="telefono" value="<?php echo $datoTelefono['descripcion'];?>"  placeholder="Ingrese el telefono">
                     <input type="text" class="form-control" name="idProveedor" id="idProveedor" value="<?php echo $idProveedor;?>" hidden>
                   </div>
                 </div>
                  <div class="col-md-6">
                    <div class="form-group">
                     <label>Email</label>
                     <input type="email" class="form-control" name="correo" id="correo" value="<?php echo $datoMail['descripcion'];?>" placeholder="Ingrese el Email">
                   </div>
                 </div>
               
               <div class="col-md-6">
                 <div class="form-group">
                   <label>Descripción</label>
                   <input type="text" class="form-control" name="descripcion" id="descripcion" value="<?php echo $datos['descripcion'];?>" placeholder="Descripción">
                 </div>
               </div>

             </div>

             <div class="col-md-12" align="center">
               <div class="form-group">
                 <button name="modificarProveedor" id="modificarProveedor" value="modificarProveedor" class="btn btn-light"  style="width:50%">modificar Proveedor</button>
                 <button name="registrado" value="registrado" id="btn2" class="btn btn-light"  style="width:50%">Cancelar</button>
               </div>
             </div>
           </div>
         </form>
       </div>
   <?php }
            }
    ?>
</div>
</div>
       </script>
   </body>
</html>