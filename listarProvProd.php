<?php require ('header.php'); 

if (isset($_GET['listarPP']) && !empty($_GET['listarPP'])) {
	$buscar =$_GET['listarPP'];
	/*if(!isset($_GET['pagina'])){
		header("location:listaProvProd.php?listarPP=$buscar&pagina=1");
	}*/
}
$consulta=
?>
<br>
<form action="listarProvProd.php" method="GET">
	<div class="row justify-content-center">
		<div class="col-md-4">
			<label>Buscar Por:</label>
			<select id="tpConsulta" name="tpConsulta">
				<option value="0">
					seleccione tipo de busqueda
				</option>
				<option value="1">
					Proveedor
				</option>
				<option value="2">
					Producto
				</option>
			</select>
		</div>
		<div class="col-md-6">
			<input type="text" name="listarPP" id="listarPP">	
			<button type="submit"><i class="fas fa-search"></i></i></button>
		</div>
	</div>
</form>

<div class="col-md-12">
	<div id="result" style="border: 1px solid white;overflow-y: scroll;background:#fafafa;padding-top:15px">
		<table class="table striped" style="background:#fafafa;height:300px">
			<thead>
				<th>Producto</th>
				<th>Tipo Producto</th>
				<th>Marca</th>
				<!--<th>Proveedor</th>-->
				<th>ultimo Precio</th>
				<th>Email Proveedor</th>
				<th>Tel Proveedor</th>

				<th></th>
				<th></th>
			</thead>
			<tbody>

				<tr>

					<td style="padding-top:30px"><?php //echo $row['nombre'];?></td>
					<td style="padding-top:30px"><?php// echo $row['apellido'];?></td>
					<td style="padding-top:30px"><?php //while($r=mysqli_fetch_array($select2)){ echo $r['descripcion'];}?></td>
					<td style="padding-top:30px"><?php// echo $row['numDocumento'];?></td>
					<td style="padding-top:30px"><?php// echo $row['fechaNac'];?></td>
					<td style="padding-top:30px"><?php// echo $Telefono;?></td>

					<?php/* $grupo=mysqli_query($conexion,"SELECT p.nombrePermiso FROM permisos AS p, grupospermisos AS up WHERE (p.nombrePermiso='buscar usuario' OR p.nombrePermiso='baja usuario' OR p.nombrePermiso='modificar usuario') AND p.idPermiso=up.idPermiso AND up.idGrupo='$idGrupo'");
					while($r=mysqli_fetch_array($grupo)){
						$nombrePermiso=$r['nombrePermiso'];
						if($nombrePermiso=="baja usuario"){
							*/?>
							<td><a href="#" style="border-radius:30px;font-size:20px" class="btn btn-light" data-toggle="modal" data-target="#info<?php echo $idPersona; ?>"><i class="fas fa-trash-alt"></i></a></td>
						<?php   /*                    }
						if($nombrePermiso=="modificar usuario"){
							$select4=mysqli_query($conexion,"SELECT g.nombreGrupo FROM grupos AS g,gruposusuarios AS gp WHERE g.nombreGrupo!='CLIENTE' AND g.idGrupo=gp.idGrupo AND gp.idPersona={$row['idPersona']}");
							while($r=mysqli_fetch_array($select4)){
								*/?>
								<td>
									<form method="POST" action="modificarUsuario.php">
										<button style="border-radius:30px;font-size:20px" type="submit" name="idPersona" value="<?php echo $row['idPersona'];?>" class="btn btn-light"><i class="fas fa-pencil-alt"></i></button>
									</form>
								</td>
							<?php /*                              }
						}
					}*/
					?>
				</tr>
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
					<th colspan="12">Cantidad de registros encontrados: <?php// echo $total_usuarios?></th>
				</tr>
			</tfoot>
		</table>
	</div>
</div>

<?php require 'footer.php'; ?>