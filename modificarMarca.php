<?php require("header.php");
require("conexion.php"); 
$selectMarcas= "SELECT idMarca, nombreMarca as marca FROM marcas";
$qMarcas= mysqli_query($conexion,$selectMarcas);?>
<div class="row" style="padding: 2%;">
	<div class="col-md-3">
		<!-- Button trigger modal -->
		<button type="button"  class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">
		  agregar Marca
		</button>

		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Agregar Marca</h5>
		        
		      </div>
		      <div class="modal-body">
		       	<form action="ABMmarcas.php" method="POST">
		       		<label>nombre Marca</label>
		       		<input type="text" name="newMarca" id="newMarca" placeholder="Escriba nombre de la marca">
		      </div>
		      <div class="modal-footer">
		        <button type="submit" class="btn btn-primary">guardar</button>
		      </div>
		      	</form>
		    </div>
		  </div>
		</div>
	</div>	

	<!--<div class="col-md-3">
		
		<button type="button"  class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">
		  agregar Tipo Producto
		</button>

	
		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Tipo Producto</h5>
		        
		      </div>
		      <div class="modal-body">
		       	<form action="ABMtipoProducto.php" method="POST">
		       		<label>tipo Producto</label>
		       		<input type="text" name="newTP" id="newTP" placeholder="Escriba nombre de la marca">
		      </div>
		      <div class="modal-footer">
		        <button type="submit" class="btn btn-primary">guardar</button>
		      </div>
		      	</form>
		    </div>
		  </div>
		</div>
	</div>	-->
</div>
<div class="row justify-content-center">
	<div class="col">
		<table class="table striped" style="background:#fafafa;white:70%">
				<tr>
					<th>Marcas</th>		
					<th>Tipo Producto</th>	
				</tr>
				<?php while($r=$qMarcas->fetch_assoc()){ ?>
					<tr>
					<td><?php  echo $r["marca"];?></td>
					<td>
					<?php 
					$id=$r["idMarca"];
					$tpMarcas="SELECT tp.descripcion 
						FROM tiposproductos as tp 
						join tiposproductos_marcas as tpm on tpm.idTipoProducto=tp.idTipoProducto 
						where tpm.idMarca=$id";
					$qtpMarcas=mysqli_query($conexion,$tpMarcas);

					while ($rtp=$qtpMarcas->fetch_assoc()) {?>
						<?php echo $rtp["descripcion"];} ?>
					<?php } ?>
					</td>
					</tr>
				
				

			</table>
	</div>
</div>

<?php 
if (isset($_GET['estadoM']) &&$_GET['estadoM']==1) {
	echo "<script type='text/javascript'>alert('La marca se añado exitosamente');</script>";
}
if (isset($_GET['estadoM']) &&$_GET['estadoM']==2) {
	echo "<script type='text/javascript'>alert('La marca ya existe');</script>";
}
if (isset($_GET['estadoM']) &&$_GET['estadoM']==3) {
	echo "<script type='text/javascript'>alert('el tipo de producto se creo correctamente');</script>";
}
if (isset($_GET['estadoM']) &&$_GET['estadoM']==4) {
	echo "<script type='text/javascript'>alert('el tipo de producto ya existe');</script>";
}


 ?>	

<?php require("footer.php"); ?>