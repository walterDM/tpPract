<?php require("header.php");
 require("conexion.php");

 $select=mysqli_query($conexion,"SELECT idTipoProducto, descripcion FROM tiposproductos ORDER BY descripcion ASC");
 $selectProv=mysqli_query($conexion,"SELECT idProveedor, empresa FROM proveedores where idEstado=1 ORDER BY empresa ASC");
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
         $("#cbxMarca").change(function () {	
 			$("#cbxMarca option:selected").each(function () {
 				id_estado = $(this).val();
 				$.post("includes/getProducto.php", { id_estado: id_estado }, function(data){
 					$("#cbxProducto").html(data);
 				});            
 			});
 		});
 	});
 </script>
 <div class="container">
 <div class="row">
 	<div class="col-md-12" style="padding-top:50px">
	    <form enctype="multipart/form-data" id="fupForm" >
 			<div class="row">
 				<div class="col-md-12">
                  <div class="row">	
 					<div class="form-group col-md-4" >
 						<label>Tipo de producto</label>
 						<select class="form-control" id="cbxTipoProducto" name="cbxTipoProducto">
 							<option value="0">seleccionar tipo Producto</option>
 							<?php while ($rsTP = $select->fetch_assoc()) {?>
 								<option value="<?php echo $rsTP['idTipoProducto']; ?>"><?php echo $rsTP['descripcion']; ?>
 							</option>
 						<?php } ?>
 					    </select>
 				    </div>
                    <div class="form-group col-md-4">
                        <label>Marca</label>
                        <select class="form-control" id="cbxMarca" name="cbxMarca">
                            <option>seleccione Marca</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Producto</label>
                        <select class="form-control" id="cbxProducto" name="cbxProducto">
                            <option>seleccione producto</option>
                        </select>
                    </div>
                   </div>
 			    </div>
 			    <div class="col-md-12">
 				  <div class="row">
 					<div class="col-md-6">
 						<div class="form-group">
 							<label>Cantidad</label>
 							<input type="text" class="form-control" name="cantidadProd" id="cantidadProd" placeholder="ingrese cantidad">
 						</div>
 					</div>
 					<div class="col-md-6">
 						<div class="form-group">
 							<label>Descuento en porcentaje</label>
 							<input type="text" class="form-control" name="descuento" id="descuento" placeholder="ingrese descuento">
							 <input type="text" class="form-control" name="guardar" id="guardar" value="guardar" hidden>
 						</div>
 					</div>
 				</div>
 				
 			</div>
 			
 		<div class="col-md-12" align="center">
 			<div class="form-group">
 				<button style="background:orange;color:white;width:30%" type="submit" class="btn btn-light submitBtn">guardar producto</button>
 			</div>
 		</div>
 	</div>
   </form>
</div>
</div>
<?php require 'footer.php'; ?>
<script type="text/javascript" src="js/ABMofertas.js"></script>
