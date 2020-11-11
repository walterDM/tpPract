<?php require 'header.php';
if (isset($_SESSION['grupo']) && ($_SESSION['grupo']==18 || $_SESSION['grupo']==20)):

//////trae los productos sin filtro///////
	if (!isset($_GET['fHasta'])|| !isset($_GET['fDesde'])) {
		$queryFacturasIni="SELECT f.idFacturaVenta as nFact, f.totalApagar as total, f.fechaPedido as fp, p.nombre,p.apellido from facturas as f JOIN personas as p on p.idPersona=f.idPersona";
		$rsFacturasIni=mysqli_query($conexion,$queryFacturasIni);
	}
	if (isset($_GET['fDesde']) && isset($_GET['fHasta'])) {
		$fd = date("Y-m-d", strtotime($_GET['fDesde']));
		$fh = date("Y-m-d", strtotime($_GET['fHasta']));


		$queryFechatp="SELECT f.idFacturaVenta as nFact, f.totalApagar as total, f.fechaPedido as fp, p.nombre,p.apellido 
		from facturas as f 
		JOIN personas as p on p.idPersona=f.idPersona

		WHERE f.fechaPedido BETWEEN '$fd' AND '$fh'";
		

		$rsFechaTp=mysqli_query($conexion,$queryFechatp);
	}

	function formatFecha($fecha){
		$rs=date("Y-m-d", strtotime($fecha) );
		return $rs;
	} ?>
<<<<<<< HEAD

	<h2>Reporte Ventas</h2>

=======
	<div class="row">
		<div class="col-md-12">
			<h2>Reportes de Ventas</h2>
		</div>
	</div>
>>>>>>> 2c0a76c1833afcfa5db1923a859130c6abfd961e
	<form action="ventasPDF.php" method="POST">
		<div class="row justify-content-center">
			<div class="col-md-1"></div>		
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
							<th>Factura</th>		
							<th>Cliente</th>
							<th>Fecha Factura</th>
							<th>Total Factura</th>

						</tr>
						<?php 
          			///////si se realizo algun filtro///////
			//p.descripcion as prod, p.cantidadProd, p.lote, pf.estante, pf.fila, pf.columna, tp.descripcion as tprod
						if(isset($_GET['fHasta'])):
							$totalV=0;
							while ($rs1=mysqli_fetch_array($rsFechaTp)){?>
								<tr>
									<td><?php echo $rs1['nFact']; ?></td>
									<td><?php echo $rs1['nombre']." ".$rs1['apellido']; ?></td>
									<td><?php echo $rs1['fp']; ?></td>
									<td><?php echo $rs1['total']; ?></td>
									<?php  $totalV+=$rs1['total']?>
								</tr>
								
							<?php };?>
								<tr class="ftable">
								<td></td>
								<td></td>
								<td ><?php echo "TOTAL VENDIDO EN EL PERIODO = ".$totalV ?></td>
							</tr>
						<?php endif ?>


						<?php
          			///////si no se utiliza algun filtro///////
						if(!isset($_GET['fHasta'])):
							$totalV=0;
							while ($rs=mysqli_fetch_array($rsFacturasIni)):?>
								<tr >
									<td><?php echo $rs['nFact']; ?></td>
									<td><?php echo $rs['nombre']." ".$rs['apellido']; ?></td>
									<td><?php echo $rs['fp']; ?></td>
									<td><?php echo $rs['total']; ?></td>
									<?php  $totalV+=$rs['total'];?>
								</tr>


							<?php endwhile;?>
							<tr class="ftable">
								<td></td>
								<td></td>
								<td ><?php echo "TOTAL VENDIDO EN EL PERIODO = ".$totalV ?></td>
							</tr>
						<?php endif ?>
					</table>
				</div>
			</div>
		</div>

		<button name="exportPDF" value="export" style="border-color: #e0e0e0;background:white" class="btn btn-outline-warning" id="button-addon2">EXPORTAR PDF</button>

	</form>

	<?php 	
endif;
require 'footer.php'; ?>