<?php 
require("conexion.php");
require("header.php");
if(isset($_SESSION['login'])){
  $idGrupo=$_SESSION['grupo'];
  $grupo=mysqli_query($conexion,"SELECT p.nombrePermiso FROM permisos AS p, grupospermisos AS up WHERE p.nombrePermiso='alta usuario' AND p.idPermiso=up.idPermiso AND up.idGrupo='$idGrupo'");
}
$select=mysqli_query($conexion,"SELECT * FROM tiposdocumentos");
while ($r=mysqli_fetch_array($select)) {
  $descripcion=$r['descripcion'];
}
$select2=mysqli_query($conexion,"SELECT * FROM grupos WHERE nombreGrupo!='CLIENTE'");

?>

<div class="row">
  
  <?php 
  if(isset($_SESSION['login'])){
    if($r=mysqli_fetch_array($grupo)){
      $nombrePermiso=$r['nombrePermiso'];
      if($nombrePermiso=="alta usuario"){?>
       <div class="col-md-12" style="padding-top:10px">
         <form  method="POST" action="ABMusuario.php"  onsubmit="return form(this)">
          <div class="row">
           <div class="col-md-6">
             <div class="form-group">
               <label>Legajo</label>
               <input type="text" class="form-control" name="legajo" id="legajo"  placeholder="ingrese su nombre">
             </div>
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
             <div class="row">
               <div class="form-group col-md-6">
                 <label>E-mail</label>
                 <input type="email" class="form-control" name="mail" id="mail" placeholder="example@example.com" required>
               </div>
               <div class="form-group col-md-6">
                 <label>Repetir E-mail</label>
                 <input type="email" class="form-control" id="mail2" placeholder="example@example.com" required>
               </div>
             </div>
             <div class="form-group">
               <label>Usuario</label>
               <input type="text" class="form-control" name="usuario" id="usuario" placeholder="ingrese su usuario">
             </div>
           </div>
           <div class="col-md-6">
            <div class="form-group">
             <label>Fecha de nacimiento</label>
             <input type="date" class="form-control" name="fechaNac" id="fechaNac">
           </div>
           <div class="form-group">
             <label>Apellido</label>
             <input type="text" class="form-control" name="apellido" id="apellido" placeholder="ingrese su apellido">
           </div>
           <div class="form-group">
             <label>Numero de documento</label>
             <input type="text" class="form-control" name="numDocumento" id="numDocumento" placeholder="ingrese numero de documento">
           </div>
           <div class="form-group">
             <label>Numero de telefono</label>
             <input type="text" class="form-control" name="telefono" id="telefono" placeholder="ingrese numero de telefono" required>
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
        <div class="col-md-12">
          <div class="form-group">
           <label>Nombre de grupo</label>
           <select class="form-control" id="nombreGrupo" name="nombreGrupo">
             <?php while ($r=mysqli_fetch_array($select2)) {?>
               <option><?php echo $r['nombreGrupo'];;?></option>
             <?php }?>
           </select>
         </div>
       </div>
       <div class="col-md-12" align="center">
         <div class="form-group">
           <button style="width: 50%;" name="guardarUsuario" value="guardarUsuario" id="btn2" class="btn btn-light" onclick="form()">registrar usuario</button>
           <button style="width: 50%;" class="btn btn-dark"><a style="text-decoration: none;color:white" href="javascript:history.go(-1)"><i class="fas fa-ban"></i> Cancelar</a></button>
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
if (isset($_GET['error'])&& $_GET['error']==5) {
  echo "<script type='text/javascript'>alert('ERROR AL REGISTRAR: el email ingresado ya existe');</script>";
}
?>
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

</script>
<?php require 'footer.php'; ?>