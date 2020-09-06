
<?php 
require("header.php");
require("conexion.php");  
$grupo=mysqli_query($conexion,"SELECT p.nombrePermiso FROM permisos AS p, grupospermisos AS up WHERE (p.nombrePermiso='buscar proveedor' OR p.nombrePermiso='baja proveedor' OR p.nombrePermiso='modificar proveedor') AND p.idPermiso=up.idPermiso AND up.idGrupo='$idGrupo'"); 
?>

<div class="row">
  <?php 
  if($r=mysqli_fetch_array($grupo)){
   $nombrePermiso=$r['nombrePermiso'];
   if($nombrePermiso=="alta proveedor" || $nombrePermiso=="baja proveedor" || $nombrePermiso=="modificar proveedor" || $nombrePermiso=="buscar proveedor"){
    ?>
    <div class="col-md-12" align="center" style="padding-top:20px">
      <form action="buscarProv.php?pagina=1" method="POST">
       <div class="input-group mb-3">
        <input id="empresa" name="empresa" style="width:70%" type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Ingrese el proveedor o empresa" required>
        <div class="input-group-append">
          <button name="buscar" value="buscar" style="border-color: #e0e0e0;background:white" class="btn btn-outline-warning" id="button-addon2"><i class="fas fa-search"></i></button>
        </div>
      </div>
    </form>
  </div>
  <div class="col-md-12">
   <div id="result" style="border: 1px solid white;height:300px; overflow-y: scroll;background:#fafafa"></div>
   
   <?php 
 }
}else{
  ?>
  <div class="col-md-12" style="padding-top:10px">
   <div class="alert alert-warning" role="alert">
     <h2 align="center">ACCESO DENEGADO</h2>
   </div>
 </div>
 <?php 
}
?>
</div>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/2be8605e79.js"></script>
<?php 
if (isset($_GET['mod']) && $_GET['mod']=1) {
 echo "<script type='text/javascript'>alert('fue modificado con exito');</script>";
}
if (isset($_GET['error']) && $_GET['error']=2) {
 echo "<script type='text/javascript'>alert('no fue modificado');</script>";
}
?>

<?php require 'footer.php'; ?>
