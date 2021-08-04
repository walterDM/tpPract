<?php 
if(!isset($_GET['pagina'])){
	header("location:reportesVentas.php?fDesde=0000-00-00&fHasta=0000-00-00&pagina=1");
  }
require 'header.php';


//////trae los productos sin filtro///////
if ((isset($_GET['fDesde']) && $_GET['fDesde']!='0000-00-00') && (isset($_GET['fHasta']) && $_GET['fHasta']!='0000-00-00')) {
			$fd = date("Y-m-d", strtotime($_GET['fDesde']));
			$fh = date("Y-m-d", strtotime($_GET['fHasta']));
			$consulta=mysqli_query($conexion,"SELECT count(idFacturaVenta) as cantFact FROM facturas as f WHERE f.fechaPedido BETWEEN '$fd' AND '$fh'");
			while($r=mysqli_fetch_array($consulta)){
				$cantFact=$r['cantFact'];
			}

			$facturas_x_pag = 5;
			$paginas = $cantFact / $facturas_x_pag;
			$paginas = ceil($paginas);
		
			if (isset($_GET['pagina'])) {
				$iniciar = ($_GET['pagina'] - 1) * $facturas_x_pag;
				$queryFacturasIni="SELECT f.totalApagar as total, f.fechaPedido as fp, p.nombre,p.apellido, dt.numFactura as nFact from facturas as f 
				JOIN personas as p on p.idPersona=f.idPersona 
				JOIN datosfacturas as dt on dt.idFactura=f.idFacturaVenta
				WHERE f.fechaPedido BETWEEN '$fd' AND '$fh' order by dt.numFactura limit $iniciar,$facturas_x_pag ";
			    $rsFacturasIni=mysqli_query($conexion,$queryFacturasIni);
			}
    }
	if ((isset($_GET['fDesde']) && $_GET['fDesde']=='0000-00-00') && (isset($_GET['fHasta']) && $_GET['fHasta']=='0000-00-00')) {
		$fd = date("Y-m-d", strtotime($_GET['fDesde']));
		$fh = date("Y-m-d", strtotime($_GET['fHasta']));
			
		$consulta=mysqli_query($conexion,"SELECT count(idFacturaVenta) as cantFact FROM facturas as f WHERE  f.fechaPedido");
			while($r=mysqli_fetch_array($consulta)){
				$cantFact=$r['cantFact'];
			}

			$facturas_x_pag = 5;
			$paginas = $cantFact / $facturas_x_pag;
			$paginas = ceil($paginas);
		
			if (isset($_GET['pagina'])) {
				$iniciar = ($_GET['pagina'] - 1) * $facturas_x_pag;
				$queryFacturasIni="SELECT f.totalApagar as total, f.fechaPedido as fp, p.nombre,p.apellido, dt.numFactura as nFact from facturas as f 
				JOIN personas as p on p.idPersona=f.idPersona 
				JOIN datosfacturas as dt on dt.idFactura=f.idFacturaVenta
				order by dt.numFactura limit $iniciar,$facturas_x_pag ";
			    $rsFacturasIni=mysqli_query($conexion,$queryFacturasIni);
			}

	}

	function formatFecha($fecha){
		$rs=date("Y-m-d", strtotime($fecha) );
		return $rs;
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
			}else{echo "value='".date("d-m-Y")."'";} ?>>


				<button name="buscar" value="0"  style="border-color: #e0e0e0;background:white" class="btn btn-outline-warning" id="button-addon2"><i class="fas fa-search"></i></button>

			</div>
			<div class="col-md-6">

			</div>

		</div>
		</form>


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
							<th></th>

						</tr>
						<?php 
          			///////si se realizo algun filtro///////
			//p.descripcion as prod, p.cantidadProd, p.lote, pf.estante, pf.fila, pf.columna, tp.descripcion as tprod
						
							$totalV=0;
							while ($rs1=mysqli_fetch_array($rsFacturasIni)){
								$fecha=date('d/m/Y',strtotime($rs1['fp']));?>
								<tr>
									<td><?php echo $rs1['nFact']; ?></td>
									<td><?php echo $rs1['nombre']." ".$rs1['apellido']; ?></td>
									<td><?php echo $fecha; ?></td>
									<td><?php echo "$".$rs1['total']; ?></td>
									<td>
										<form action="ventasPDF.php" method="POST">
											<input id="fDesde" name="fDesde" value="<?php echo $_GET['fDesde'];?>" hidden>	
											<input id="fHasta" name="fHasta" value="<?php echo $_GET['fHasta'];?>" hidden>
											<input id="fNumFact" name="fNumFact" value="<?php echo $rs1['nFact'];?>" hidden>	
											<button name="detallePDF" value="detalle" style="border-color: #e0e0e0;background:white" class="btn btn-outline-warning" id="button-addon2">ver detalle</button>
										</form>
									</td>
									<?php  $totalV+=$rs1['total']?>
								</tr>
		
							<?php };?>
							
							<tr align="center">
							   <th colspan="5"><?php echo "TOTAL VENDIDO EN EL PERIODO = ".$totalV ?></th>
							</tr>
							
					

					</table>
				</div>
			</div>
		</div>
		<form action="ventasPDF.php" method="POST">
			<input id="fDesde" name="fDesde" value="<?php echo $_GET['fDesde'];?>" hidden>	
			<input id="fHasta" name="fHasta" value="<?php echo $_GET['fHasta'];?>" hidden>
		
			<button name="exportPDF" value="export" style="border-color: #e0e0e0;background:white" class="btn btn-outline-warning" id="button-addon2">EXPORTAR PDF</button>

	    </form>
	<div class="container" style="padding-top:40px">
				<nav arial-label="page navigation">
					<ul class="pagination justify-content-center">
					<li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>"><a class="page-link" href="reportesVentas.php?fDesde=<?php echo $_GET['fDesde']; ?>&fHasta=<?php echo $_GET['fHasta'];?>&pagina=<?php echo $_GET['pagina'] - 1 ?>">Anterior</a></li>
					<?php for ($i = 1; $i <= $paginas; $i++) : ?>
						<li class="<?php echo $_GET['pagina'] == $i ? 'active' : '' ?>"><a class="page-link" href="reportesVentas.php?fDesde=<?php echo $_GET['fDesde']; ?>&fHasta=<?php echo $_GET['fHasta'];?>&pagina=<?php echo $i ?>"><?php echo $i ?></a></li>
					<?php endfor ?>
					<li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>"><a class="page-link" href="reportesVentas.php?fDesde=<?php echo $_GET['fDesde']; ?>&fHasta=<?php echo $_GET['fHasta'];?>&pagina=<?php echo $_GET['pagina'] + 1 ?>">Siguiente</a></li>
					</ul>
				</nav>
			</div>
	<?php 	

require 'footer.php'; ?>