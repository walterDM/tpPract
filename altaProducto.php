 <?php require("header.php");
 require("conexion.php");

 $select=mysqli_query($conexion,"SELECT idTipoProducto, descripcion FROM tiposproductos ORDER BY descripcion ASC");
 $selectProv=mysqli_query($conexion,"SELECT idProveedor, empresa FROM proveedores ORDER BY empresa ASC");
 $select3=mysqli_query($conexion,"SELECT * from puestofisico as pf where not exists (select idPuestoFisico from productos as p where p.idPuestoFisico = pf.idPuestoFisico)");
 ?>
 <script language="javascript">
 	$(document).ready(function(){
 		$("#cbxTipoProducto").change(function () {	
 			$("#cbxTipoProducto option:selected").each(function () {
 				id_estado = $(this).val();
 				$.post("includes/getMarcar.php", { id_estado: id_estado }, function(data){
 					$("#cbxMarca").html(data);
 				});            
 			});
 		});
 	});
 </script>
 <div class="row">
 	<div class="col-md-12" style="padding-top:50px">
 		<form  method="POST" action="ABMproductos.php" enctype="multipart/form-data" autocomplete="off"  onsubmit="return valida2(this)">
 			<div class="row">
 				<div class="col-md-6">
 					<div class="form-group">
 						<label>Nombre</label>
 						<input type="text" class="form-control" name="descripcion" id="descripcion"  placeholder="ingrese nombre del producto">
 					</div>
 					<div class="form-group">
 						<label>LOTE</label>
 						<input type="text" class="form-control" name="lote" id="lote" placeholder="ingrese lote">
 					</div>
 					<div class="form-group">
 						<label>Tipo de producto</label>
 						<select class="form-control" id="cbxTipoProducto" name="cbxTipoProducto">
 							<option value="0">seleccionar tipo Producto</option>
 							<?php while ($rsTP = $select->fetch_assoc()) {?>
 								<option value="<?php echo $rsTP['idTipoProducto']; ?>"><?php echo $rsTP['descripcion']; ?>
 							</option>
 						<?php } ?>
 					</select>

 				</div>
 				<div class="form-group">
 					<label>Marca</label>
 					<select class="form-control" id="cbxMarca" name="cbxMarca">
 						<option>seleccione Marca</option>
 					</select>
 				</div>
 			</div>
 			<div class="col-md-6">
 				<div class="form-group">
 					<label>Fecha de caducidad</label>
 					<input type="date" class="form-control" name="fechaCaducidad" id="fechaCaducidad">
 				</div>
 				<div class="row">
 					<div class="col-md-6">
 						<div class="form-group">
 							<label>Cantidad</label>
 							<input type="text" class="form-control" name="cantidadProd" id="cantidadProd" placeholder="ingrese cantidad">
 						</div>
 					</div>
 					<div class="col-md-6">
 						<div class="form-group">
 							<label>Precio</label>
 							<input type="text" class="form-control" name="precio" id="precio" placeholder="ingrese precio">
 						</div>
 					</div>
 				</div>
 				<div class="form-group">
 					<label>Estado</label>
 					<select class="form-control" id="estado" name="estado">
 						<option>Activo</option>
 						<option>Inactivo</option>
 					</select>
 				</div>
 				<div class="row">
 					<div class="col-md-12">
 						<div class="form-group">
 							<label>Estante-Fila-Columna</label>
 							<select class="form-control" id="idPuestoFisico" name="idPuestoFisico">
 								<?php  while($r=mysqli_fetch_array($select3)){?>
 									<option value="<?php echo $r['idPuestoFisico']?>"><?php echo $r['estante']."-".$r['fila']."-".$r['columna'];?></option>
 								<?php }?>
 							</select>
 						</div>
 					</div>
 				</div>
 			</div>
 			<div class="col-md-6">
 				<div class="form-group">
 					<label>Proveedor</label>
 					<select class="form-control" id="cbxProv" name="cbxProv">
 						<option value="0">seleccionar Proveedor</option>
 						<?php while ($rsProv = $selectProv->fetch_assoc()) {?>
 							<option value="<?php echo $rsProv['idProveedor']; ?>"><?php echo $rsProv['empresa']; ?>
 						</option>
 					<?php } ?>
 				</select>
 			</div>
 		</div>
 		<div class="col-md-6">
 			<div class="form-group">
 				<div class="contenido"><label for="imagen">imagen</label>
 					<input type="file" name="imagen" class="form-control" id="imagen" >
 				</div>
 			</div>
 		</div>
 		<div class="col-md-12" align="center">
 			<div class="form-group">
 				<button style="background:orange;color:white;width:30%" type="submit" name="guardar" value="guardar" id="btn2" class="btn btn-light">guardar producto</button>
 			</div>
 		</div>
 	</div>
 </form>
</div>
</div>
<?php require 'footer.php'; ?>