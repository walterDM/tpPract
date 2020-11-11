<?php require 'header.php';
$tipo=0;
////////////Variable del combo/////////////

if (isset($_GET['tProducto'])) {
	$tipo=$_GET['tProducto'];
	
}


	

//////trae los productos sin filtro///////
if (!isset($_GET['tProducto'])||(isset($_GET['tProducto'])&&$_GET['tProducto']==0)) {
$queryStocktp="SELECT p.descripcion as prod, p.cantidadProd as cant, p.lote, pf.estante, 
	pf.fila, pf.columna, tp.descripcion as tprod, m.nombreMarca as marca
from productos as p
JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico
JOIN productostpmarcas as pm on pm.idProducto=p.idProducto
JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca
JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto
JOIN marcas as m on tpm.idMarca=m.idMarca";

}
//////trae los productos filtrados//////
if (isset($_GET['tProducto']) && $_GET['tProducto']!=0) {
	$queryStocktp="SELECT p.descripcion as prod, p.cantidadProd as cant, p.lote, pf.estante, 
	pf.fila, pf.columna, tp.descripcion as tprod, m.nombreMarca as marca
	from productos as p
	JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico
	JOIN productostpmarcas as pm on pm.idProducto=p.idProducto
	JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca
	JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto
	JOIN marcas as m on tpm.idMarca=m.idMarca
	WHERE tpm.idTipoProducto=$tipo";
	
}

$queryTp="SELECT tp.descripcion, tp.idTipoProducto from tiposproductos as tp";
$rsTp=mysqli_query($conexion,$queryTp);

?>
<<<<<<< HEAD
<br>
<h2>Reporte Stock</h2>
=======
>>>>>>> 2c0a76c1833afcfa5db1923a859130c6abfd961e

<div class="row">
		<div class="col-md-12">
			<h2>Reporte de Stock</h2>
		</div>
	</div>
<br>
<form action="stockPDF.php" method="GET">
	<div class="row justify-content-center">
		
		<div class="col-md-3">
			<label for="tProducto">Tipo Producto</label>
			<select name="tProducto" id="tProducto">
				<option value='0'>Todos</option>
				<?php while($rs=mysqli_fetch_array($rsTp)){?>
					<option value="<?php echo $rs['idTipoProducto'] ?>" <?php if($tipo==$rs['idTipoProducto']) echo 'Selected'?>><?php echo $rs['descripcion'];?></option>
				<?php }; ?>

			</select>
			<button name="buscar" value="0" style="border-color:#e0e0e0;background:white" class="btn btn-outline-warning" id="button-addon2"><i class="fas fa-search"></i></button>
			
		</div>
		<div class="col-md-6">
		
	</div>
	
	</div>

	

<br>


<div class="row justify-content-center">
	<div class="col-md-12">
		<div style="background: white">
		<table class="table striped" style="background:#fafafa;">
			<tr>
				<th>Producto</th>		
				<th>Tipo Producto</th>
				<th>Marca</th>
				<th>lote</th>
				<th>Puesto</th>
				<th>Cantidad</th>
			</tr>
			<?php 
          			///////si se realizo algun filtro///////
			//p.descripcion as prod, p.cantidadProd, p.lote, pf.estante, pf.fila, pf.columna, tp.descripcion as tprod
			if(isset($_GET['tProducto'])):
				$rsStockTp=mysqli_query($conexion,$queryStocktp);
				while ($rs1=mysqli_fetch_array($rsStockTp)){?>
					<tr>
					<td><?php echo $rs1['prod']; ?></td>
					<td><?php echo $rs1['tprod']; ?></td>
					<td><?php echo $rs1['marca']; ?></td>
					<td><?php echo $rs1['lote']; ?></td>
					<td><?php echo $rs1['estante'].'-'.$rs1['fila'].'-'.$rs1['columna']; ?></td>
					<td><?php echo $rs1['cant']; ?></td>
					</tr>
					
				<?php };
			endif ?>


			<?php
          			///////si no se utiliza algun filtro///////
			if(!isset($_GET['tProducto'])|| $_GET['tProducto']==0):
				$rsStockTp=mysqli_query($conexion,$queryStocktp);
				while ($rs=mysqli_fetch_array($rsStockTp)):?>
					<tr>
					<td><?php echo $rs['prod']; ?></td>
					<td><?php echo $rs['tprod']; ?></td>
					<td><?php echo $rs['marca']; ?></td>
					<td><?php echo $rs['lote']; ?></td>
					<td><?php echo $rs['estante'].'-'.$rs['fila'].'-'.$rs['columna']; ?></td>
					<td><?php echo $rs['cant']; ?></td>
					</tr>
				<?php endwhile;
			endif ?>
		</table>
		</div>
	</div>
</div>

<button name="exportPDF" value="export" style="border-color: #e0e0e0;background:white" class="btn btn-outline-warning" id="button-addon2">EXPORTAR PDF</button>

</form>



<?php require 'footer.php'; ?>