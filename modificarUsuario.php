<?php 
//un cambio
require("conexion.php");
require("header.php");
if(isset($_SESSION['login'])){
  $idGrupo=$_SESSION['grupo'];
  $grupo=mysqli_query($conexion,"SELECT p.nombrePermiso FROM permisos AS p, grupospermisos AS up WHERE p.nombrePermiso='modificar usuario' AND p.idPermiso=up.idPermiso AND up.idGrupo='$idGrupo'");
}
$select=mysqli_query($conexion,"SELECT * FROM tiposdocumentos");
while ($r=mysqli_fetch_array($select)) {
  $descripcion=$r['descripcion'];
}
$select2=mysqli_query($conexion,"SELECT * FROM grupos");

?>

<div class="row">
  <?php 
  if(isset($_SESSION['login'])){
    if(isset($_POST['idPersona'])){
      $idPersona=$_POST['idPersona'];
      $consulta="SELECT * FROM personas WHERE idPersona='$idPersona'";
      $resultado=mysqli_query($conexion,$consulta);
      $datos=mysqli_fetch_assoc($resultado);
      $dni=$datos['idTipoDocumento'];
      $consulta2=mysqli_query($conexion,"SELECT descripcion FROM tiposdocumentos WHERE idTipoDocumento=$dni");
      while($r=mysqli_fetch_array($consulta2)){
        $tipo_dni=$r['descripcion'];
      }
      $consulta3=mysqli_query($conexion,"SELECT descripcion FROM tiposdocumentos");
      
      $consulta4=mysqli_query($conexion,"SELECT idGrupo FROM gruposusuarios WHERE idPersona=$idPersona");
      while($r=mysqli_fetch_array($consulta4)){
       $id_grupo=$r['idGrupo'];
     }
     $consulta5=mysqli_query($conexion,"SELECT nombreGrupo FROM grupos WHERE idGrupo=$id_grupo");
     while($r=mysqli_fetch_array($consulta5)){
      $nombre_grupo=$r['nombreGrupo'];
    }
    $consulta6=mysqli_query($conexion,"SELECT nombreGrupo FROM grupos WHERE nombreGrupo!='CLIENTE'");
    $consulta7=mysqli_query($conexion,"SELECT LegajoEmpleado FROM empleados WHERE idPersona='$idPersona'");
    $consulta8=mysqli_query($conexion,"SELECT idTipoContacto FROM tiposcontactos WHERE descripcion='email'");
    while($r=mysqli_fetch_array($consulta8)){$idTipoMail=$r['idTipoContacto'];}
    $consulta9=mysqli_query($conexion,"SELECT pc.descripcion FROM personascontactos AS pc,personas AS p WHERE pc.idPersona=$idPersona AND pc.idTipoContacto=$idTipoMail");
    $datoMail=mysqli_fetch_assoc($consulta9);
    $consulta10=mysqli_query($conexion,"SELECT idTipoContacto FROM tiposcontactos WHERE descripcion='telefono'");
    while($r=mysqli_fetch_array($consulta10)){$idTipoTelefono=$r['idTipoContacto'];}
    $consulta11=mysqli_query($conexion,"SELECT pc.descripcion FROM personascontactos AS pc,personas AS p WHERE pc.idPersona=$idPersona AND pc.idTipoContacto=$idTipoTelefono");
    $datoTelefono=mysqli_fetch_assoc($consulta11);
    $datoLegajo=mysqli_fetch_assoc($consulta7);
    if($r=mysqli_fetch_array($grupo)){
      $nombrePermiso=$r['nombrePermiso'];
      if($nombrePermiso=="modificar usuario"){?>
       <div class="col-md-12" style="padding-top:10px">
         <form  method="POST" action="ABMusuario.php" onsubmit="return form(this)">
          <div class="row">
           <div class="col-md-6">
             <div class="form-group">
               <label>Legajo</label>
               <input type="text" class="form-control" name="legajo" id="legajo" value="<?php echo $datoLegajo['LegajoEmpleado'];?>" placeholder="ingrese su legajo">
               <input type="text" class="form-control" name="idPersona" id="idPersona" value="<?php echo $idPersona;?>" hidden>
               <input type="text" class="form-control" name="legajoAnterior" id="legajoAnterior" value="<?php echo $datoLegajo['LegajoEmpleado'];?>" hidden>
               <input type="text" class="form-control" name="numDocumentoAnterior" id="numDocumentoAnterior" value="<?php echo $datos['numDocumento'];?>" hidden>
               <input type="text" class="form-control" name="usuarioAnterior" id="usuarioAnterior" value="<?php echo $datos['usuario'];?>" hidden>
               <input type="text" class="form-control" name="mailAnterior" id="mailAnterior" value="<?php echo $datoMail['descripcion'];?>" hidden>
             </div>
             <div class="form-group">
               <label>Nombre</label>
               <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $datos['nombre'];?>"  placeholder="ingrese su nombre">
             </div>
             
             <div class="form-group">
               <label>Tipo de documento</label>
               <select class="form-control" id="tipodoc" name="tipodoc">
                 <?php while($r=mysqli_fetch_array($consulta3)){?>
                   <option <?php if($tipo_dni==$r['descripcion']) echo 'Selected'?>><?php echo $r['descripcion'];?></option>
                 <?php }?>
               </select>
             </div>
             <div class=row>
               <div class="form-group col-md-6">
                 <label>E-mail</label>
                 <input type="email" class="form-control" name="mail" id="mail" value="<?php echo $datoMail['descripcion'];?>" placeholder="ingrese su usuario">
               </div>
               <div class="form-group col-md-6">
                 <label>Repetir E-mail</label>
                 <input type="email" class="form-control" id="mail2" value="<?php echo $datoMail['descripcion'];?>" placeholder="ingrese su usuario">
               </div>
             </div>
             <div class="form-group">
               <label>Usuario</label>
               <input type="text" class="form-control" name="usuario" id="usuario" value="<?php echo $datos['usuario'];?>" placeholder="ingrese su usuario" <?php echo "disabled";?>>
             </div>
           </div>
           <div class="col-md-6">
            <div class="form-group">
             <label>Fecha de nacimiento</label>
             <input type="date" class="form-control" name="fechaNac" value="<?php echo $datos['fechaNac'];?>" id="fechaNac">
           </div>
           <div class="form-group">
             <label>Apellido</label>
             <input type="text" class="form-control" name="apellido" id="apellido" value="<?php echo $datos['apellido'];?>" placeholder="ingrese su apellido">
           </div>
           <div class="form-group">
             <label>Numero de documento</label>
             <input type="text" class="form-control" name="numDocumento" id="numDocumento" value="<?php echo $datos['numDocumento'];?>" placeholder="ingrese numero de documento">
           </div>
           <div class="form-group">
             <label>Numero de telefono</label>
             <input type="text" class="form-control" name="telefono" id="telefono" value="<?php echo $datoTelefono['descripcion'];?>" placeholder="ingrese su telefono">
           </div>
           <div class="form-group">
             <label>Contraseña</label>
             <input type="text" class="form-control" name="contrasenia" id="contr" value="<?php echo sha1($datos['contrasenia']);?>" placeholder="ingrese su contraseña" <?php echo "disabled";?>>
           </div>
         </div>
         <div class="col-md-12">
          <div class="form-group">
           <label>Nombre de grupo</label>
           <select class="form-control" id="nombreGrupo" name="nombreGrupo">
             <?php while($r=mysqli_fetch_array($consulta6)){?>
               <option <?php if($nombre_grupo==$r['nombreGrupo']) echo 'Selected'?>><?php echo $r['nombreGrupo'];?></option>
             <?php }?>
           </select>
         </div>
       </div>
       <div class="col-md-12" align="center">
         <div class="form-group">
           <button name="modificarUsuario" value="modificarUsuario" id="btn2" class="btn btn-light" onclick="form()" style="width:50%">Actualizar usuario</button>
           
         </div>
       </div>
     </div>
   </form>
 </div>
<?php }

}else{?>
  <div class="col-md-12" style="padding-top:10px">
    <div class="alert alert-warning" role="alert">
     <h2 align="center">ACCESO DENEGADO</h2>

   </div>
 </div>
<?php }
}
}else{?>
  <div class="col-md-12" style="padding-top:10px">
    <div class="alert alert-warning" role="alert">
     <h2 align="center">ACCESO DENEGADO</h2>

   </div>
 </div>
<?php }?>
</div>

<?php 
if (isset($_GET['registrado'])&& $_GET['registrado']==1) {
  echo "<script type='text/javascript'>alert('fue registrado con exito');</script>";
}
if (isset($_GET['error'])&& $_GET['error']==2) {
  echo "<script type='text/javascript'>alert('ERROR AL REGISTRAR: el legajo ingresado ya existe');</script>";
}
if (isset($_GET['error'])&& $_GET['error']==3) {
  echo "<script type='text/javascript'>alert('ERROR AL REGISTRAR: el numero de documento ingresado ya existe');</script>";
}
if (isset($_GET['error'])&& $_GET['error']==4) {
  echo "<script type='text/javascript'>alert('ERROR AL REGISTRAR: el nombre de usuario ingresado ya existe');</script>";
}
?>
<script>
 function form(v){
  ok=true;
  msg="ERROR: \n";
  
  if(v.elements['mail'].value != v.elements['mail2'].value){
    msg+="El E-mail no coincide";
    ok=false;
  }
  if (ok==false) {
    alert(msg);
    return ok;
  }
}
</script>
<?php require 'footer.php'; ?>