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
<script language="javascript">
 	$(document).ready(function(){
 		$("#cbxpais").change(function () {	
 			$("#cbxpais option:selected").each(function () {
 				id_estado = $(this).val();
 				$.post("includes/getProvincia.php", { id_estado: id_estado }, function(data){
 					$("#cbxprovincia").html(data);
 				});            
 			});
 		});
     $("#cbxprovincia").change(function () {	
 			$("#cbxprovincia option:selected").each(function () {
 				id_ciudad = $(this).val();
 				$.post("includes/getCiudad.php", { id_ciudad: id_ciudad }, function(data){
 					$("#cbxciudad").html(data);
 				});            
 			});
 		});
 	});
 </script>
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
      $select3=mysqli_query($conexion,"SELECT * FROM direcciones WHERE idPersona=$idPersona");
      while($r=mysqli_fetch_array($select3)){
        $idCiudad=$r['idCiudad'];
        $idTipoDomicilio=$r['idTipoDomicilio'];
        $calle=$r['calle'];
        $altura=$r['altura'];
        $dpto=$r['dpto'];
        $piso=$r['piso'];
      }
      $select4=mysqli_query($conexion,"SELECT idProvincia,nombreCiudad FROM ciudades WHERE idCiudad=$idCiudad");
      while($r=mysqli_fetch_array($select4)){
        $idProvincia=$r['idProvincia'];
        $nombreCiudad=$r['nombreCiudad'];
      }
      $select5=mysqli_query($conexion,"SELECT nombreProvincia,idPais FROM provincias WHERE idProvincia=$idProvincia");
      while($r=mysqli_fetch_array($select5)){
        $nombreProvincia=$r['nombreProvincia'];
        $idPais=$r['idPais'];
      }
      $select6=mysqli_query($conexion,"SELECT nombrePais FROM paises WHERE idPais=$idPais");
      while($r=mysqli_fetch_array($select6)){
        $nombrePais=$r['nombrePais'];
      }
      $select7=mysqli_query($conexion,"SELECT idPais,nombrePais FROM paises ORDER BY nombrePais ASC");
      $select8=mysqli_query($conexion,"SELECT idProvincia,nombreProvincia FROM provincias WHERE idPais=$idPais ORDER BY nombreProvincia ASC");
      $select9=mysqli_query($conexion,"SELECT idCiudad,nombreCiudad FROM ciudades WHERE idProvincia=$idProvincia ORDER BY nombreCiudad ASC");
      $select10=mysqli_query($conexion,"SELECT descripcion FROM tiposdomicilios WHERE idTipoDomicilio=$idTipoDomicilio");
      while($r=mysqli_fetch_array($select10)){
        $TipoDomicilio=$r['descripcion'];
      }
      $select11=mysqli_query($conexion,"SELECT idTipoDomicilio,descripcion FROM tiposdomicilios ORDER BY descripcion ASC");
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
             <div class="form-group">
               <label>Pais</label>
               <select class="form-control" id="cbxpais" name="cbxpais">
               	<option>Seleecione Pais</option>
                 <?php while ($rsTP = $select7->fetch_assoc()){?>
                 <option <?php if($nombrePais==$rsTP['nombrePais']) echo 'Selected'?>><?php echo $rsTP['nombrePais'];?></option>
                 <?php } ?>
               </select>
             </div>
             <div class="form-group">
               <label>Ciudad</label>
               <select class="form-control" id="cbxciudad" name="cbxciudad">
               <?php while ($rsTP = $select9->fetch_assoc()){?>
                 <option value="<?php echo $rsTP['idCiudad'];?>" <?php if($nombreCiudad==$rsTP['nombreCiudad']) echo 'Selected'?>><?php echo $rsTP['nombreCiudad'];?></option>
                 <?php } ?>
               </select>
             </div>
             <div class="row">
                <div class="form-group col-md-6">
                   <label>Calle</label>
                   <input type="text" class="form-control" name="calle" id="calle" value="<?php echo $calle;?>"  placeholder="ingrese calle">
                </div>
                <div class="form-group col-md-6">
                   <label>Altura</label>
                   <input type="text" class="form-control" name="altura" id="altura" value="<?php echo $altura;?>"  placeholder="ingrese altura">
                </div>
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
               <label>Provincia</label>
               <select class="form-control" id="cbxprovincia" name="cbxprovincia">
               <?php while ($rsTP = $select8->fetch_assoc()){?>
                <option value="<?php echo $rsTP['idProvincia'];?>" <?php if($nombreProvincia==$rsTP['nombreProvincia']) echo 'Selected'?>><?php echo $rsTP['nombreProvincia'];?></option>
               <?php } ?>
               </select>
           </div>
           <div class="form-group">
               <label>tipo de domicilio</label>
               <select class="form-control" id="tipodomicilio" name="tipodomicilio">
               <?php while ($rsTP = $select11->fetch_assoc()){?>
                 <option value="<?php echo $rsTP['idTipoDomicilio'];?>" <?php if($TipoDomicilio==$rsTP['descripcion']) echo 'Selected'?>><?php echo $rsTP['descripcion'];?></option>
                 <?php } ?>
               </select>
           </div>
           <div class="row">
                <div class="form-group col-md-6">
                   <label>Depto</label>
                   <input type="text" class="form-control" name="dpto" id="dpto" value="<?php echo $dpto;?>"  placeholder="ingrese departamento">
                </div>
                <div class="form-group col-md-6">
                   <label>Piso</label>
                   <input type="text" class="form-control" name="piso" id="piso" value="<?php echo $piso;?>" placeholder="ingrese piso">
                </div>
             </div>
           <div class="form-group">
             <label>Numero de telefono</label>
             <input type="text" class="form-control" name="telefono" id="telefono" value="<?php echo $datoTelefono['descripcion'];?>" placeholder="ingrese su telefono">
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