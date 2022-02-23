<?php 
require("conexion.php");
require("header.php");
if(isset($_SESSION['login'])){
  $idGrupo=$_SESSION['grupo'];
  $grupo=mysqli_query($conexion,"SELECT p.nombrePermiso FROM permisos AS p, grupospermisos AS up WHERE p.nombrePermiso='alta proveedor' AND p.idPermiso=up.idPermiso AND up.idGrupo='$idGrupo'");
}
$select=mysqli_query($conexion,"SELECT *FROM tiposcontactos");
while ($r=mysqli_fetch_array($select)) {
  $descripcion=$r['descripcion'];
}
// $select2=mysqli_query($conexion,"SELECT * FROM grupos");

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
    if($r=mysqli_fetch_array($grupo)){
      $nombrePermiso=$r['nombrePermiso'];
      if($nombrePermiso=="alta proveedor"){?>
       <div class="col-md-12" style="padding-top:10px">
         <form  method="POST" action="ABMProv.php"  onsubmit="return valida2(this)">
          <div class="row">
           <div class="col-md-6">
             <div class="form-group">
               <label>Empresa</label>
               <input type="text" class="form-control" name="empresa" id="empresa"  placeholder="Ingrese el nombre de la empresa">
             </div>
           </div>
            <div class="col-md-6">
            <div class="form-group">
             <label>Cuit</label>
             <input type="text" class="form-control" name="cuit" id="cuit" placeholder="Ingrese el cuit" required>
           </div>
         </div>
             <div class="col-md-6">
              <div class="form-group">
               <label>Pais</label>
               <select class="form-control" id="cbxpais" name="cbxpais">
                <option>Seleecione Pais</option>
                 <?php while ($rsTP = $select3->fetch_assoc()){?>
                 <option><?php echo $rsTP['nombrePais'];?></option>
                 <?php } ?>
               </select>
             </div>
           </div>
             <div class="col-md-6">
             <div class="form-group">
               <label>Ciudad</label>
               <select class="form-control" id="cbxciudad" name="cbxciudad">
                 <option>Seleccione ciudad</option>
               </select>
             </div>
           </div>

           <div class="col-md-6">
           <div class="form-group">
               <label>Provincia</label>
               <select class="form-control" id="cbxprovincia" name="cbxprovincia">
                   <option>seleccione provincia</option>
               </select>
           </div>
         </div>
        
          <div class="col-md-6">
           <div class="form-group">
               <label>tipo de domicilio</label>
               <select class="form-control" id="tipodomicilio" name="tipodomicilio">
               <?php while ($rsTP = $select5->fetch_assoc()){?>
                 <option value="<?php echo $rsTP['idTipoDomicilio']; ?>"><?php echo $rsTP['descripcion'];?></option>
               <?php } ?>
               </select>
           </div>
         </div>
          <!--   <div class="row"> -->
                <div class="form-group col-md-6">
                   <label>Calle</label>
                   <input type="text" class="form-control" name="calle" id="calle"  placeholder="ingrese calle" required>
                </div>
                <div class="form-group col-md-6">
                   <label>Altura</label>
                   <input type="text" class="form-control" name="altura" id="altura"  placeholder="ingrese altura" required>
                </div>
             <!-- </div> -->
          <!--   <div class="row"> -->
                <div class="form-group col-md-6">
                   <label>Depto</label>
                   <input type="text" class="form-control" name="dpto" id="dpto"  placeholder="ingrese departamento">
                </div>

                <div class="form-group col-md-6">
                   <label>Piso</label>
                   <input type="text" class="form-control" name="piso" id="piso"  placeholder="ingrese piso">
                </div>
            <!--  </div> -->

         
         <div class="col-md-6">
          <div class="form-group">
           <label>Telefono</label>
           <input type="text" class="form-control" name="telefono" id="contacto" placeholder="Ingrese el telefono">
         </div>
       </div>
       <div class="col-md-6">
        <div class="form-group">
         <label>Email</label>
         <input type="email" class="form-control" name="correo" id="contacto" placeholder="Ingrese el Email">
       </div>
     </div>
     
     <div class="col-md-12">
       <div class="form-group">
         <label>Descripción</label>
         <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="Descripción">
       </div>
     </div>

   </div>

   <div class="col-md-12" align="center">
     <div class="form-group">
       <button name="guardarProveedor" value="guardarProveedor" id="btn2" class="btn btn-light" onclick="valida2()" style="width:50%">Registrar Proveedor</button>
       <button name="registrado" value="registrado" id="btn2" class="btn btn-light" onclick="valida2()" style="width:50%">Cancelar</button>
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
  echo "<script type='text/javascript'>alert('ERROR AL REGISTRAR: la empresa ingresada ya existe');</script>";
}
if (isset($_GET['error'])&& $_GET['error']==3) {
  echo "<script type='text/javascript'>alert('ERROR AL REGISTRAR: el cuit ingresado ya existe');</script>";
}

?>
<?php require 'footer.php'; ?>