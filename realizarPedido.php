<?php 
require 'header.php';
require 'conexion.php';
$grupo=mysqli_query($conexion,"SELECT p.nombrePermiso FROM permisos AS p, grupospermisos AS up WHERE (p.nombrePermiso='buscar proveedor' OR p.nombrePermiso='baja proveedor' OR p.nombrePermiso='modificar proveedor') AND p.idPermiso=up.idPermiso AND up.idGrupo='$idGrupo'"); 
$consultaProv="SELECT * from proveedores where idEstado=1";
$query=mysqli_query($conexion,$consultaProv);

?>
<?php if ($r=mysqli_fetch_array($grupo)) {?>
	<br>
	<form action="listarProducto.php" method="GET">
		<div class="row justify-content-center">
			<div class="col-md-3">
				<label>Seleccione Proveedor</label>
			</div>
			<div class="col-md-5">
				<select class="form-control" id="cbxProv" name="cbxProv">
					<option>seleccione proveedor</option>
					<?php while ($r=mysqli_fetch_array($query)):?>
						<option value="<?php echo $r['idProveedor']; ?>"> <?php echo $r['empresa']; ?></option>
					<?php endwhile ?>
				</select>
			</div>
			<div class="col-md-2 bList">
				<button type="submit"><i class="fas fa-search"></i></i></button>
			</div>
		</div>

	</form>
	<br>
	
	<div class="row">
		<div class="col-md-12">
			 <div id="result" style="border: 1px solid white;height:300px; overflow-y: scroll;background:#fafafa"></div>
		</div>
	</div>





<?php }else{?>
	<div class="col-md-12" style="padding-top:10px">
		<div class="alert alert-warning" role="alert">
			<h2 align="center">ACCESO DENEGADO</h2>
		</div>
	</div>
<?php } ?>





<?php require 'footer.php' ?>
<?php 
	if (isset($_GET['pedido'])&&$_GET['pedido']==1) {
		echo "<script>alert('pedido Creado');</script>";
	}
	if (isset($_GET['pedido'])&&$_GET['pedido']==0) {
		echo "<script>alert('No se Pudo Crear el pedido');</script>";
	}
	?>