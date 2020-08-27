<!DOCTYPE html>
<html>
   <head>
      <title>Inicio</title>

   </head>
   <body>
   <?php require("header.php");
		 require("conexion.php");
		 $select=mysqli_query($conexion,"SELECT * FROM tiposproductos");

	
    ?>
   <div class="container">
      <div class="row">
          <div class="col-md-12" style="padding-top:50px">
          <?php 
                 if (isset($_POST['idProductos'])) {
                      $id=$_POST['idProductos'];
                      $consulta="SELECT * FROM productos WHERE idProducto='$id'";
                      $resultado=mysqli_query($conexion,"SELECT * FROM productos WHERE idProducto='$id'");
                      $datos=mysqli_fetch_assoc($resultado);
                     $idTipoProducto="";
                     $idMarca="";
                      $idPuestoFisico=$datos['idPuestoFisico'];
                      $consulta2=mysqli_query($conexion,"SELECT tp.* FROM tiposproductos as tp 
														join tiposproductos_marcas as tpm on tpm.idTipoProducto=tp.idTipoProducto 
														join productostpmarcas as pm on pm.idTpMarca=tpm.idTpMarca 
														where pm.idProducto=$id");
                      while($r=mysqli_fetch_array($consulta2)){
                      	$idTipoProducto=$r['idTipoProducto'];
                      	$descripcion_tipo=$r['descripcion'];
                      
                      }
                      
                     $consulta4=mysqli_query($conexion,"SELECT m.* FROM marcas as m 
															join tiposproductos_marcas as tpm on tpm.idMarca=m.idMarca 
															join productostpmarcas as pm on pm.idTpMarca=tpm.idTpMarca 
															where pm.idProducto=$id");
                      while($r=mysqli_fetch_array($consulta4)){
                      	$idMarca=$r['idMarca'];
                      	$nombreMarca=$r['nombreMarca'];
                      }
                      $consulta5=mysqli_query($conexion,"SELECT DISTINCT  m.idMarca, m.nombreMarca FROM marcas as m inner join  tiposproductos_marcas as tpm on  tpm.idTipoProducto='$idTipoProducto' and tpm.idMarca=m.idMarca ORDER BY m.nombreMarca ASC");
                      $consulta6=mysqli_query($conexion,"SELECT * FROM puestofisico");
                  ?>
                        <script language="javascript">
					      	$(document).ready(function(){
									$("#cbxTipoProducto").change(function () {
										
										$('#cbxMarca').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
										
										$("#cbxTipoProducto option:selected").each(function () {
											id_estado = $(this).val();
											$.post("includes/getMarcar.php", { id_estado: id_estado }, function(data){
												$("#cbxMarca").html(data);
											});            
										});
									})
								});

								$(document).ready(function(){
									$("#cbxTipoProducto").change(function () {	
										$("#cbxTipoProducto option:selected").each(function () {
											id_estado = $(this).val();
											$.post("includes/getMarcar.php", { id_estado: id_estado }, function(data){
												$("#cbxMarca").html(data);
											});            
										});
									})
								});
						</script>
          <form  method="POST" action="ABM.php" enctype="multipart/form-data" autocomplete="off"  onsubmit="return valida2(this)">
		               	<div class="row">
		               	 <div class="col-md-6">
		          		   <div class="form-group">
		            		   <label>Nombre</label>
		            		   <input type="text" class="form-control" name="descripcion" id="descripcion" value="<?php echo $datos['descripcion'];?>" placeholder="ingrese nombre del producto">
		        	  	   </div>
		        	  	   <div class="form-group">
						       <label>LOTE</label>
                               <input type="text" class="form-control" name="lote" id="lote" value="<?php echo $datos['Lote'];?>" placeholder="ingrese lote">
                               <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                             </div>
                             <div class="form-group">
						       <label>Tipo de producto</label>
						       <select id="cbxTipoProducto" name="cbxTipoProducto" class="form-control" >
						       	<option value="0">seleccion</option>
								 <?php $consulta3=mysqli_query($conexion,"SELECT idTipoProducto, descripcion FROM tiposproductos ORDER BY descripcion ASC");
								   while($r=mysqli_fetch_array($consulta3)){?>
								 	
								  <option value="<?php echo $r['idTipoProducto'];?>" <?php  if($idTipoProducto==$r['idTipoProducto']){ echo'selected';}?>><?php echo $r['descripcion'];?></option>
								<?php }?>
							   </select>
                             </div>
                             <div class="form-group">
							   <label>Marca</label>
						         <select id="cbxMarca" name="cbxMarca"  class="form-control">
						         	<option value="0">seleccion marca</option>
								 <?php  while($r=mysqli_fetch_array($consulta5)){?>
								  <option value="<?php echo $r['idMarca'] ?>"<?php if($idMarca==$r['idMarca']) echo 'Selected'?>><?php echo $r['nombreMarca'];?></option>
								 <?php }?>
							    </select>
                             </div>
					  	  </div>
					  	  <div class="col-md-6">
                            <div class="form-group">
						       <label>Fecha de caducidad</label>
						       <input type="date" class="form-control" name="fechaCaducidad" id="fechaCaducidad" value="<?php echo $datos['fechaCaducidad'];?>">
							 </div>
							 <div class="row">
								<div class="col-md-6">
					  	           <div class="form-group">
						               <label>Cantidad</label>
						               <input type="text" class="form-control" name="cantidadProd" id="cantidadProd" value="<?php echo $datos['cantidadProd'];?>" placeholder="ingrese cantidad">
									 </div>
								</div>
								<div class="col-md-6">
					  	           <div class="form-group">
						               <label>Precio</label>
						               <input type="text" class="form-control" name="precio" id="precio" value="<?php echo $datos['precio'];?>" placeholder="ingrese precio">
									 </div>
								</div>
							 </div>
					  	   <div class="form-group">
						       <label>Estado</label>
						       <select class="form-control" id="estado" name="estado">
								  <option <?php if($datos['estado']=="Activo") echo 'Selected'?>>Activo</option>
								  <option <?php if($datos['estado']=="Inactivo") echo 'Selected'?>>Inactivo</option>
							   </select>
							 </div>
							 <div class="row">
								 <div class="col-md-12">
								 <div class="form-group">
						       <label>Estante</label>
						       <select class="form-control" id="idPuestoFisico" name="idPuestoFisico">
								 <?php  while($r=mysqli_fetch_array($consulta6)){?>
								  <option <?php if($idPuestoFisico==$r['idPuestoFisico']) echo 'Selected'?> value="<?php echo $r['idPuestoFisico']?>"><?php echo $r['estante']."-".$r['fila']."-".$r['columna'];?></option>
								<?php }?>
							   </select>
							 </div>
								 </div>
							 </div>
							</div>
							<div class="col-md-6">
							  <div class="form-group">
			                    <div class="contenido"><label for="imagen">imagen</label>
			                    <input type="file" name="imagen" class="form-control" id="imagen" ></div>
			                  </div>
                            </div>
                            <div class="col-md-6">
                            <img src="<?php echo "imagenes/". $datos["imagen"]; ?>" width =100>
                            </div>
					  	  <div class="col-md-12" align="center">
					  	   <div class="form-group">
		          			   <button style="background:orange;color:white;width:30%;margin-top:10%" type="submit" name="Modificar" value="Modificar" id="btn2" class="btn btn-light">Actualizar Producto</button>
		            	   </div>
		            	  </div>
		            	</div>
                       </form>
    <?php }?>
          </div>
      </div>
   </body>
</html>