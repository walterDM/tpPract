<?php require 'header.php';
if (isset($_SESSION['grupo']) && ($_SESSION['grupo']==18 || $_SESSION['grupo']==20)):
//////trae los productos sin filtro///////
if (!isset($_GET['fHasta'])|| !isset($_GET['fDesde'])) {
	$queryStockIni="SELECT p.descripcion as prod,p.fechaCaducidad as venc, p.cantidadProd as cant, p.lote, pf.estante, 
	pf.fila, pf.columna, tp.descripcion as tprod, m.nombreMarca as marca
	from productos as p
	JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico
	JOIN productostpmarcas as pm on pm.idProducto=p.idProducto
	JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca
	JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto
	JOIN marcas as m on tpm.idMarca=m.idMarca";
	$rsStockIni=mysqli_query($conexion,$queryStockIni);
}
if (isset($_GET['fDesde']) && isset($_GET['fHasta'])) {
	$fd = date("Y-m-d", strtotime($_GET['fDesde']));
	$fh = date("Y-m-d", strtotime($_GET['fHasta']));

	
	$queryFechatp="SELECT p.descripcion as prod,p.fechaCaducidad as venc, p.cantidadProd as cant, p.lote, pf.estante, pf.fila, pf.columna, tp.descripcion as tprod, m.nombreMarca as marca 
	from productos as p 
	JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico 
	JOIN productostpmarcas as pm on pm.idProducto=p.idProducto 
	JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca 
	JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto 
	JOIN marcas as m on tpm.idMarca=m.idMarca
	WHERE p.fechaCaducidad BETWEEN '$fd' AND '$fh'";
	

	$rsFechaTp=mysqli_query($conexion,$queryFechatp);
}

function formatFecha($fecha){
	$rs=date("Y-m-d", strtotime($fecha) );
	return $rs;
} ?>
<<<<<<< HEAD

<h2>Reportes Caducidad</h2>

=======
<div class="row">
		<div class="col-md-12">
			<h2>Reporte de Caducidad</h2>
		</div>
	</div>
>>>>>>> 2c0a76c1833afcfa5db1923a859130c6abfd961e
<form action="caducidadPDF.php" method="POST">
	<div class="row justify-content-center">
		
		<div class="col-md-6">
			

			<label for="fDesde">Desde</label>
			<input type="date" id="fDesde" name="fDesde" <?php if (isset($_GET['fDesde'])) {
				echo "value='".$_GET['fDesde']."'";
			} ?>>


			<label for="fHasta">Hasta</label>
			<input type="date" id="fHasta" name="fHasta" <?php if (isset($_GET['fHasta'])) {
				echo "value='".$_GET['fHasta']."'";
			} ?>>
			

			<button name="buscar" value="0"  style="border-color: #e0e0e0;background:white" class="btn btn-outline-warning" id="button-addon2"><i class="fas fa-search"></i></button>

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
						<th>Vencimiento</th>
						<th>lote</th>
						<th>Puesto</th>
						<th>Cantidad</th>

					</tr>
					<?php 
          			///////si se realizo algun filtro///////
			//p.descripcion as prod, p.cantidadProd, p.lote, pf.estante, pf.fila, pf.columna, tp.descripcion as tprod
					if(isset($_GET['fHasta'])):

						while ($rs1=mysqli_fetch_array($rsFechaTp)){?>
							<tr>
								<td><?php echo $rs1['prod']; ?></td>
								<td><?php echo $rs1['tprod']; ?></td>
								<td><?php echo $rs1['marca']; ?></td>
								<td><?php echo $rs1['venc']; ?></td>
								<td><?php echo $rs1['lote']; ?></td>
								<td><?php echo $rs1['estante'].'-'.$rs1['fila'].'-'.$rs1['columna']; ?></td>
								<td><?php echo $rs1['cant']; ?></td>
							</tr>

						<?php };
					endif ?>


					<?php
          			///////si no se utiliza algun filtro///////
					if(!isset($_GET['fHasta'])):
						while ($rs=mysqli_fetch_array($rsStockIni)):?>
							<tr>
								<td><?php echo $rs['prod']; ?></td>
								<td><?php echo $rs['tprod']; ?></td>
								<td><?php echo $rs['marca']; ?></td>
								<td><?php echo $rs['venc']; ?></td>
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

<?php 

endif;
require 'footer.php'; ?>