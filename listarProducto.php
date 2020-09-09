<?php 
require 'header.php';
require 'conexion.php';
$grupo=mysqli_query($conexion,"SELECT p.nombrePermiso FROM permisos AS p, grupospermisos AS up WHERE (p.nombrePermiso='buscar proveedor' OR p.nombrePermiso='baja proveedor' OR p.nombrePermiso='modificar proveedor') AND p.idPermiso=up.idPermiso AND up.idGrupo='$idGrupo'"); 
$consultaProv="SELECT * from proveedores";
$query=mysqli_query($conexion,$consultaProv);
$queryBP="SELECT p.idProducto,p.descripcion,pr.empresa, tpp.idTpMarca,tpp.precio, m.nombreMarca,tp.descripcion as tipoProducto FROM productos p 
JOIN productostpmarcas tpp on p.idProducto=tpp.idProducto
JOIN proveedores pr on tpp.idProveedor=pr.idProveedor
JOIN tiposproductos_marcas tpm on tpm.idTpMarca=tpp.idTpMarca
JOIN marcas m on m.idMarca= tpm.idMarca
JOIN tiposproductos tp on tp.idTipoProducto=tpm.idTipoProducto
WHERE pr.empresa LIKE '%zink%'";
$resultBP=mysqli_query($conexion,$queryBP);
$totalProductos=mysqli_num_rows($resultBP);
?>
<?php if ($r=mysqli_fetch_array($grupo)) {?>
	<br>
	<form action="listarProducto.php" method="GET">
		<div class="row justify-content-center">
			<div class="col-md-2" >
				<label for="cbxProv">Seleccione Proveedor</label>
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
<div class="col-md-12">
	<div id="result" style="border: 1px solid white;overflow-y: scroll;background:#fafafa;padding-top:15px">
		<table class="table striped" style="background:#fafafa;height:300px">
			<thead>
				<th style="text-align: center;">Producto</th>
				<th style="text-align: center;">Proveedor</th>
				<th style="text-align: center;">Tipo Producto</th>
				<th style="text-align: center;">Marca</th>
				<!--<th>Proveedor</th>-->
				<th style="text-align: center;">ultimo Precio</th>
				<th style="text-align: center;">Email Proveedor</th>
				<th style="text-align: center;">Tel Proveedor</th>
				<th></th>
				<th></th>
				<th></th>
			</thead>
			<tbody>
				<?php while ($row=mysqli_fetch_array($resultBP)): ?>
					<tr>

						<td style="text-align: center"><?php echo $row['descripcion'];?></td>
						<td style="text-align: center"><?php echo $row['empresa'];?></td>
						<td style="text-align: center"><?php echo $row['tipoProducto'];?></td>
						<td style="text-align: center"><?php echo $row['nombreMarca']; //while($r=mysqli_fetch_array($select2)){ echo $r['descripcion'];}?></td>
						<td style="text-align: center"><?php echo $row['precio'];?></td>
						
						<td style="text-align: center"><?php// echo $Telefono;?></td>
						<td></td>
						<td></td>

					
							<td><a href="#" style="border-radius:30px;font-size:20px" class="btn btn-light" data-toggle="modal" data-target="#info<?php echo $idPersona; ?>"><i class="fas fa-trash-alt"></i></a></td>
						
								<td>
									<form method="POST" action="modificarUsuario.php">
										<button style="border-radius:30px;font-size:20px" type="submit" name="idPersona" value="<?php echo $row['idPersona'];?>" class="btn btn-light"><i class="fas fa-pencil-alt"></i></button>
									</form>
								</td>
							
					</tr>
				<?php endwhile ?>
				<div data-backdrop="static"  class="modal fade" id="info<?php //echo $idPersona;?>">
					<div class="col-md-12 modal-dialog" >
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Baja Usuario</h4>
								<button type="button" class="close" data-dismiss="modal">X</button>
							</div>
							<div class="col-md-12" style="background:#e0e0e0">
								<div class="modal-body" >
									<h5 align="center">Estas seguro que deseas eliminar el siguiente usuario:</h5>
									<h6 align="center"><?php echo $row['usuario'];?></h6>
									<div align="center">
										<form method="POST" action="ABMusuario.php">
											<input type="text" class="form-control" name="idPersona" id="idPersona" value="<?php echo $row['idPersona'];?>" hidden>
											<button  type="submit" name="eliminarUsuario" value="eliminarUsuario" class="btn btn-light">Eliminar</button>
										</form>
										<button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
									</div>
								</div>
							</div>	
						</div>
					</div>
				</div>
				<?php             
				//} 
				?>  
			</tbody>
			<tfoot>
				<tr align="center">
					<th colspan="12">Cantidad de registros encontrados: <?php echo $totalProductos?></th>
				</tr>
			</tfoot>
		</table>
	</div>
</div>










<?php }else{?>
	<div class="col-md-12" style="padding-top:10px">
		<div class="alert alert-warning" role="alert">
			<h2 align="center">ACCESO DENEGADO</h2>
		</div>
	</div>
<?php } ?>
<?php require 'footer.php'; ?>