<?php 
require 'header.php';
require 'conexion.php';
$grupo=mysqli_query($conexion,"SELECT p.nombrePermiso FROM permisos AS p, grupospermisos AS up WHERE (p.nombrePermiso='buscar proveedor' OR p.nombrePermiso='baja proveedor' OR p.nombrePermiso='modificar proveedor') AND p.idPermiso=up.idPermiso AND up.idGrupo='$idGrupo'"); 
$consultaProv="SELECT * from proveedores";
$query=mysqli_query($conexion,$consultaProv);
if (isset($_GET['cbxProv']) && !empty($_GET['cbxProv'])) {
	$idProv=$_GET['cbxProv'];
	$queryBP="SELECT p.idProducto,p.descripcion,pr.empresa, tpp.idTpMarca,tpp.precio, m.nombreMarca,tp.descripcion as tipoProducto FROM productos p 
	JOIN productostpmarcas tpp on p.idProducto=tpp.idProducto
	JOIN proveedores pr on tpp.idProveedor=pr.idProveedor
	JOIN tiposproductos_marcas tpm on tpm.idTpMarca=tpp.idTpMarca
	JOIN marcas m on m.idMarca= tpm.idMarca
	JOIN tiposproductos tp on tp.idTipoProducto=tpm.idTipoProducto
	WHERE pr.idProveedor=$idProv";
	$resultBP=mysqli_query($conexion,$queryBP);
	$totalProductos=mysqli_num_rows($resultBP);
	$queryCT="SELECT descripcion from contactosproveedores where idProveedor=$idProv and idTipoContacto=2";
	$resultCT=mysqli_query($conexion,$queryCT);
	$queryCE="SELECT descripcion from contactosproveedores where idProveedor=$idProv and idTipoContacto=1";
	$resultCE=mysqli_query($conexion,$queryCE);
}
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
						<option value="<?php echo $r['idProveedor'];?>" 
							<?php if($r['idProveedor']==$idProv){echo 'Selected';}?>> <?php echo $r['empresa']; ?></option>
						<?php endwhile ?>
					</select>
				</div>
				<div class="col-md-2 bList">
					<button type="submit"><i class="fas fa-search"></i></i></button>
				</div>
			</div>
		</form>

		<br>
		
		<form action="enviarPedido.php" method="GET">
			<div class="row justify-content-center">
				<div class="col-md-12">.
					<div class="form-group">	
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
											<td style="text-align: center"><?php echo $row['nombreMarca'];?></td>
											<td style="text-align: center"><?php echo $row['precio'];?></td>
											<td style="text-align: center"><?php while($r=mysqli_fetch_array($resultCE)){ echo $r['descripcion'];}?></td>
											<td style="text-align: center"><?php while($rs=mysqli_fetch_array($resultCT)){ echo $rs['descripcion'];}?></td>
											<td><input type="checkbox" name="seleccionado[]" value="<?php echo $row['idTpMarca']?>"></td>
											<td></td>
										</tr>
									<?php endwhile ?>
									
								</tbody>
								<tfoot>
									<tr align="center">
										<th colspan="12">Cantidad de registros encontrados: <?php echo $totalProductos?></th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6" align="center">
					<div class="form-group">
						<button style="background:orange;color:white;width:30%;" type="submit"  id="btn2" class="btn btn-light">Enviar Pedido</button>
					</div>
				</div>
			</div>

		</form>
		










	<?php }else{?>
		<div class="col-md-12" style="padding-top:10px">
			<div class="alert alert-warning" role="alert">
				<h2 align="center">ACCESO DENEGADO</h2>
			</div>
		</div>
	<?php } ?>
	<?php require 'footer.php'; ?>