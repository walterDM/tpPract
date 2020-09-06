<?php require 'header.php' ?>
<br>
<form action="buscarlistaPP.php" method="POST">
	<div class="row justify-content-center">
		<div class="col-md-4">
			<label>Buscar Por:</label>
			<select>
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

<?php require 'footer.php' ?>