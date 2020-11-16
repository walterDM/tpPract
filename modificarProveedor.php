<?php 
require("conexion.php");
require("header.php");
if(isset($_SESSION['login'])){
  $idGrupo=$_SESSION['grupo'];
  $grupo=mysqli_query($conexion,"SELECT p.nombrePermiso FROM permisos AS p, grupospermisos AS up WHERE p.nombrePermiso='modificar proveedor' AND p.idPermiso=up.idPermiso AND up.idGrupo='$idGrupo'");
}

$select2=mysqli_query($conexion,"SELECT * FROM grupos");

$select2=mysqli_query($conexion,"SELECT * FROM grupos WHERE nombreGrupo!='CLIENTE'");
$select3=mysqli_query($conexion,"SELECT idPais,nombrePais FROM paises ORDER BY nombrePais ASC");
$select4=mysqli_query($conexion,"SELECT idProvincia,nombreProvincia FROM provincias ORDER BY nombreProvincia ASC");
$select5=mysqli_query($conexion,"SELECT idTipoDomicilio,descripcion FROM tiposdomicilios ORDER BY descripcion ASC");

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

      $select3=mysqli_query($conexion,"SELECT * FROM direccionesprov WHERE idProveedor=$idProveedor");
      while($r=mysqli_fetch_array($select3)){
        $idCiudad=$r['idCiudad'];
        $idTipoDomicilio=$r['idTipoDomicilio'];
        $calle=$r['calle'];
        $altura=$r['altura'];
        $depto=$r['depto'];
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
           <label>Cuit</label>
           <input type="text" class="form-control" name="cuit" id="cuit" value="<?php echo $datos['cuit'];?>" placeholder="Ingrese el cuit">
         </div>
       </div>

       <div class="col-md-6">
        <div class="form-group">
         <label>Pais</label>
         <select class="form-control" id="cbxpais" name="cbxpais">
           <?php while ($rsTP = $select7->fetch_assoc()){?>
             <option <?php if($nombrePais==$rsTP['nombrePais']) echo 'Selected'?>><?php echo $rsTP['nombrePais'];?></option>
           <?php } ?>
         </select>
       </div>
     </div>
     <div class="col-md-6">
       <div class="form-group">
         <label>Ciudad</label>
         <select class="form-control" id="cbxciudad" name="cbxciudad">
           <?php while ($rsTP = $select9->fetch_assoc()){?>
             <option value="<?php echo $rsTP['idCiudad'];?>" <?php if($nombreCiudad==$rsTP['nombreCiudad']) echo 'Selected'?>><?php echo $rsTP['nombreCiudad'];?></option>
           <?php } ?>
         </select>
       </div>
     </div>

     <div class="col-md-6">
       <div class="form-group">
         <label>Provincia</label>
         <select class="form-control" id="cbxprovincia" name="cbxprovincia">
           <?php while ($rsTP = $select8->fetch_assoc()){?>
            <option value="<?php echo $rsTP['idProvincia'];?>" <?php if($nombreProvincia==$rsTP['nombreProvincia']) echo 'Selected'?>><?php echo $rsTP['nombreProvincia'];?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    
    <div class="col-md-6">
     <div class="form-group">
       <label>tipo de domicilio</label>
       <select class="form-control" id="tipodomicilio" name="tipodomicilio">
         <?php while ($rsTP = $select11->fetch_assoc()){?>
           <option value="<?php echo $rsTP['idTipoDomicilio'];?>" <?php if($TipoDomicilio==$rsTP['descripcion']) echo 'Selected'?>><?php echo $rsTP['descripcion'];?></option>
         <?php } ?>
       </select>
     </div>
   </div>
   <!--   <div class="row"> -->
    <div class="form-group col-md-6">
     <label>Calle</label>
     <input type="text" class="form-control" name="calle" id="calle" value="<?php echo $calle;?>" placeholder="ingrese calle">
   </div>
   <div class="form-group col-md-6">
     <label>Altura</label>
     <input type="text" class="form-control" name="altura" id="altura" value="<?php echo $altura;?>" placeholder="ingrese altura">
   </div>
   <!-- </div> -->
   <!--   <div class="row"> -->
    <div class="form-group col-md-6">
     <label>Depto</label>
     <input type="text" class="form-control" name="depto" id="depto" value="<?php echo $depto;?>"  placeholder="ingrese departamento">
   </div>

   <div class="form-group col-md-6">
     <label>Piso</label>
     <input type="text" class="form-control" name="piso" id="piso" value="<?php echo $piso;?>" placeholder="ingrese piso">
   </div>
   <!--  </div> -->

   
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

<div class="col-md-12">
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

</form>
</div>
<?php }
}
?>
</div>
<?php require 'footer.php'; ?>