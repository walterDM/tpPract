<?php 
require("header.php");
require("conexion.php");
$select=mysqli_query($conexion,"SELECT * FROM tiposproductos");


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
     <?php 
		if (isset($_POST['idOferta'])) {
			$id=$_POST['idOferta'];
			$consulta="SELECT DISTINCT p.*,o.cantidad,o.descuento,o.idOferta FROM productos AS p
            JOIN ofertas AS o ON o.idProducto=p.idProducto
            WHERE p.cantidadProd > 0 AND o.idOferta='$id'";
			$resultado=mysqli_query($conexion,$consulta);
			$datos=mysqli_fetch_assoc($resultado); 
            $consulta2=mysqli_query($conexion,"SELECT tp.* FROM tiposproductos as tp 
				join tiposproductos_marcas as tpm on tpm.idTipoProducto=tp.idTipoProducto 
				join productostpmarcas as pm on pm.idTpMarca=tpm.idTpMarca 
                join productos as p on p.idProducto = pm.idProducto
                join ofertas as o on o.idProducto=p.idProducto
				where o.idOferta=$id");
			while($r=mysqli_fetch_array($consulta2)){
				$idTipoProducto=$r['idTipoProducto'];
				$descripcion_tipo=$r['descripcion'];
				
			}
            $consulta4=mysqli_query($conexion,"SELECT m.*,p.idProducto FROM marcas as m 
				join tiposproductos_marcas as tpm on tpm.idMarca=m.idMarca 
				join productostpmarcas as pm on pm.idTpMarca=tpm.idTpMarca 
				join productos as p on p.idProducto = pm.idProducto
                join ofertas as o on o.idProducto=p.idProducto
				where o.idOferta=$id");
			while($r=mysqli_fetch_array($consulta4)){
				$idMarca=$r['idMarca'];
				$nombreMarca=$r['nombreMarca'];
                $idProducto=$r['idProducto'];
			}
            $consulta5=mysqli_query($conexion,"SELECT DISTINCT  m.idMarca, m.nombreMarca FROM marcas as m inner join  tiposproductos_marcas as tpm on  tpm.idTipoProducto='$idTipoProducto' and tpm.idMarca=m.idMarca ORDER BY m.nombreMarca ASC");
            $consulta6=mysqli_query($conexion,"SELECT * FROM productos");?>
	    <form enctype="multipart/form-data" id="fupForm" >
 			<div class="row">
 				<div class="col-md-12">
                  <div class="row">	
 					<div class="form-group col-md-4" >
 						<label>Tipo de producto</label>
 						<select class="form-control" id="cbxTipoProducto" name="cbxTipoProducto">
 							<option value="0">seleccionar tipo Producto</option>
 							<?php $consulta3=mysqli_query($conexion,"SELECT idTipoProducto, descripcion FROM tiposproductos ORDER BY descripcion ASC");
									while($r=mysqli_fetch_array($consulta3)){?>
										
										<option value="<?php echo $r['idTipoProducto'];?>" <?php  if($idTipoProducto==$r['idTipoProducto']){ echo'selected';}?>><?php echo $r['descripcion'];?></option>
									<?php }?>
 						
 					    </select>
 				    </div>
                    <div class="form-group col-md-4">
                        <label>Marca</label>
                        <select class="form-control" id="cbxMarca" name="cbxMarca">
                            <option>seleccione Marca</option>
                            <?php  while($r=mysqli_fetch_array($consulta5)){?>
										<option value="<?php echo $r['idMarca'] ?>"<?php if($idMarca==$r['idMarca']) echo 'Selected'?>><?php echo $r['nombreMarca'];?></option>
									<?php }?>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Producto</label>
                        <select class="form-control" id="cbxProducto" name="cbxProducto">
                            <option>seleccione producto</option>
                            <?php  while($r=mysqli_fetch_array($consulta6)){?>
										<option value="<?php echo $r['idProducto'] ?>"<?php if($idProducto==$r['idProducto']) echo 'Selected'?>><?php echo $r['descripcion'];?></option>
									<?php }?>
                        </select>
                    </div>
                   </div>
 			    </div>
 			    <div class="col-md-12">
 				  <div class="row">
 					<div class="col-md-6">
 						<div class="form-group">
 							<label>Cantidad</label>
 							<input type="text" class="form-control" name="cantidadProd" id="cantidadProd" value="<?php echo $datos['cantidad'];?>" placeholder="ingrese cantidad">
 						</div>
 					</div>
 					<div class="col-md-6">
 						<div class="form-group">
 							<label>Descuento en porcentaje</label>
 							<input type="text" class="form-control" name="descuento" id="descuento" value="<?php echo $datos['descuento'];?>" placeholder="ingrese descuento">
							 <input type="text" class="form-control" name="Actualizar" id="Actualizar" value="Actualizar" hidden>
 						</div>
 					</div>
 				</div>
 				
 			</div>
 			
 		<div class="col-md-12" align="center">
 			<div class="form-group">
 				<button style="background:orange;color:white;width:30%" type="submit" class="btn btn-light submitBtn">Actualizar</button>
 			</div>
 		</div>
 	</div>
   </form>
   <?php } ?>
</div>
</div>
</div>
<?php require 'footer.php'; ?>
<script type="text/javascript" src="js/ABMofertas.js"></script>

		