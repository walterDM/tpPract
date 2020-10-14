<?php require 'header.php';
$tipo=0;
////////////Variable del combo/////////////

if (isset($_POST['buscar'])) {
	$tipo=$_POST['tProducto'];
}


	

//////trae los productos sin filtro///////
$queryStockIni="SELECT p.descripcion as prod, p.cantidadProd, p.lote, pf.estante, pf.fila, pf.columna, tp.descripcion as tprod
from productos as p
JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico
JOIN productostpmarcas as pm on pm.idProducto=p.idProducto
JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca
JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto";
$rsStockIni=mysqli_query($conexion,$queryStockIni);

//////trae los productos filtrados//////
if (isset($_POST['buscar'])) {
	$queryStocktp="SELECT p.descripcion as prod, p.cantidadProd, p.lote, pf.estante, pf.fila, pf.columna, tp.descripcion as tprod
	from productos as p
	JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico
	JOIN productostpmarcas as pm on pm.idProducto=p.idProducto
	JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca
	JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto
	WHERE tpm.idTipoProducto=$tipo";
	
}

$queryTp="SELECT tp.descripcion, tp.idTipoProducto from tiposproductos as tp";
$rsTp=mysqli_query($conexion,$queryTp);

?>
<br>

<form action="#" method="POST">
	<div class="row justify-content-center">
		<?php echo $tipo; ?>
		<div class="col-md-3">
			<label for="tProducto">Tipo Producto</label>
			<select name="tProducto" id="tProducto">
				<option value='0'>Todos</option>
				<?php while($rs=mysqli_fetch_array($rsTp)){?>
					<option value="<?php echo $rs['idTipoProducto'] ?>" <?php if($tipo==$rs['idTipoProducto']) echo 'Selected'?>><?php echo $rs['descripcion'];?></option>
				<?php }; ?>

			</select>
			<button name="buscar" value="buscar" style="border-color: #e0e0e0;background:white" class="btn btn-outline-warning" id="button-addon2"><i class="fas fa-search"></i></button>
			
		</div>
		<div class="col-md-6">
		
	</div>
	
	</div>

	
</form>

<br>

<form action="stockPDF.php" method="GET">
<div class="row justify-content-center">
	<div class="col-md-12">
		<div style="background: white">
		<table class="table striped" style="background:#fafafa;">
			<tr>
				<th>Producto</th>		
				<th>Tipo Producto</th>
				<th>Cantidad</th>
				<th>lote</th>
				<th>Puesto</th>

			</tr>
			<?php 
          			///////si se realizo algun filtro///////
			//p.descripcion as prod, p.cantidadProd, p.lote, pf.estante, pf.fila, pf.columna, tp.descripcion as tprod
			if(isset($_POST['buscar'])):
				$rsStockTp=mysqli_query($conexion,$queryStocktp);
				while ($rs1=mysqli_fetch_array($rsStockTp)){?>
					<tr>
					<td><?php echo $rs1['prod']; ?></td>
					<td><?php echo $rs1['tprod']; ?></td>
					<td><?php echo $rs1['cantidadProd']; ?></td>
					<td><?php echo $rs1['lote']; ?></td>
					<td><?php echo $rs1['estante'].'-'.$rs1['fila'].'-'.$rs1['columna']; ?></td>
					</tr>
				<?php };
			endif ?>


			<?php
          			///////si no se utiliza algun filtro///////
			if(!isset($_POST['buscar'])|| $_POST['tProducto']==0):
				while ($rs=mysqli_fetch_array($rsStockIni)):?>
					<tr>
					<td><?php echo $rs['prod']; ?></td>
					<td><?php echo $rs['tprod']; ?></td>
					<td><?php echo $rs['cantidadProd']; ?></td>
					<td><?php echo $rs['lote']; ?></td>
					<td><?php echo $rs['estante'].'-'.$rs['fila'].'-'.$rs['columna']; ?></td>
					</tr>

				<?php endwhile;
			endif ?>
		</table>
		</div>
	</div>
</div>
<input type="hidden" name="idTP" value="<?php echo $tipo; ?>">
<button name="exportPDF" value="export" style="border-color: #e0e0e0;background:white" class="btn btn-outline-warning" id="button-addon2">Exportar PDF</button>

</form>



<?php require 'footer.php'; ?>