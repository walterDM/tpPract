<?php require 'header.php';
if (isset($_SESSION['grupo']) && ($_SESSION['grupo']==18 || $_SESSION['grupo']==20)):

//////trae los productos sin filtro///////
	if (!isset($_GET['fHasta'])|| !isset($_GET['fDesde'])) {
		
		$consulta=mysqli_query($conexion,"SELECT count(idFacturaVenta) as cantFact FROM facturas as f WHERE  f.fechaPedido");
		while($r=mysqli_fetch_array($consulta)){
			$cantFact=$r['cantFact'];
		}

		$facturas_x_pag = 5;
		$paginas = $cantFact / $facturas_x_pag;
		$paginas = ceil($paginas);
		$iniciar = ($_GET['pagina'] - 1) * $facturas_x_pag;

		$queryFacturasIni="SELECT f.totalApagar as total, f.fechaPedido as fp, p.nombre,p.apellido, dt.numFactura as nFact from facturas as f 
			JOIN personas as p on p.idPersona=f.idPersona 
			JOIN datosfacturas as dt on dt.idFactura=f.idFacturaVenta
			order by dt.numFactura limit $iniciar,$facturas_x_pag ";
		$rsFacturasIni=mysqli_query($conexion,$queryFacturasIni);
	}
	if (isset($_GET['fDesde']) && isset($_GET['fHasta'])) {
		$fd = date("Y-m-d", strtotime($_GET['fDesde']));
		$fh = date("Y-m-d", strtotime($_GET['fHasta']));
			
		$consulta=mysqli_query($conexion,"SELECT count(idFacturaVenta) as cantFact FROM facturas as f WHERE f.fechaPedido BETWEEN '$fd' AND '$fh'");
		while($r=mysqli_fetch_array($consulta)){
			$cantFact=$r['cantFact'];
		}

		$facturas_x_pag = 5;
		$paginas = $cantFact / $facturas_x_pag;
		$paginas = ceil($paginas);
		$iniciar = ($_GET['pagina'] - 1) * $facturas_x_pag;

		$queryFechatp="SELECT f.idFacturaVenta as nFact, f.totalApagar as total, f.fechaPedido as fp, p.nombre,p.apellido 
		from facturas as f 
		JOIN personas as p on p.idPersona=f.idPersona
		WHERE f.fechaPedido BETWEEN '$fd' AND '$fh' order by f.fechaPedido limit$iniciar,$facturas_x_pag";
		$rsFechaTp=mysqli_query($conexion,$queryFechatp);


	}

	function formatFecha($fecha){
		$rs=date("Y-m-d", strtotime($fecha) );
		return $rs;
	} 


	
	if (isset($_GET['fDesde']) && isset($_GET['fHasta'])) {
		$select = mysqli_query($conexion, "SELECT * FROM facturas as f WHERE f.fechaPedido BETWEEN '$fd' AND '$fh' limit $iniciar,$facturas_x_pag");
	}else{
		$select = mysqli_query($conexion, "SELECT * FROM facturas as f limit $iniciar,$facturas_x_pag ");
	}
	?>


	<div class="row">
		<div class="col-md-12">
			<h2>Reportes de Ventas</h2>
		</div>
	</div>

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
	<div class="container" style="padding-top:40px">
		<nav arial-label="page navigation">
			<ul class="pagination justify-content-center">
				<li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>">
					<form action="reportesVentas.php?pagina=<?php echo $_GET['pagina'] - 1 ?>" method="POST">
						<input id="empresa" name="empresa" value="<?php echo $dato;?>" style="width:70%" type="text" class="form-control" aria-label="Text input with dropdown button" hidden>
						<button name="buscar" value="buscar" class="page-link" id="button-addon2">Anteriror</button>

					</form>
				</li>
				<?php for ($i = 1; $i <= $paginas; $i++) : ?>
					<li class="<?php echo $_GET['pagina'] == $i ? 'active' : '' ?>">
						<form action="reportesVentas.php?pagina=<?php echo $i ?>" method="POST">
							<input id="empresa" name="empresa" value="<?php echo $dato;?>" style="width:70%" type="text" class="form-control" aria-label="Text input with dropdown button" hidden>
							<button name="buscar" value="buscar" class="page-link" id="button-addon2"><?php echo $i ?></button>
						</form>
					</li>
				<?php endfor ?>
				<li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>">
					<form action="reportesVentas.php?pagina=<?php echo $_GET['pagina'] + 1 ?>" method="POST">
						<input id="empresa" name="empresa" value="<?php echo $dato;?>" style="width:70%" type="text" class="form-control" aria-label="Text input with dropdown button" hidden>
						<button name="buscar" value="buscar" class="page-link" id="button-addon2">Siguiente</button>
					</form>
				</li>
			</ul>
		</nav>
	</div>
	<?php 	
endif;
require 'footer.php'; ?>