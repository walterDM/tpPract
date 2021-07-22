<?php 



require 'header.php';
$tipo=0;
////////////Variable del combo/////////////



$queryTp="SELECT tp.descripcion, tp.idTipoProducto from tiposproductos as tp";
$queryTp2="SELECT tm.nombreMarca, tm.idMarca from marcas as tm";
$rsTp=mysqli_query($conexion,$queryTp);
$rsTp2=mysqli_query($conexion,$queryTp2);

?>

<script language="javascript">
	
 	$(document).ready(function(){
	
 		$("#tProducto").change(function () {	
 			$("#tProducto option:selected").each(function () {
 				id_estado = $(this).val();
			
 				window.location.href="reportesStock.php?id="+id_estado+"&pagina=1";
 			            
 			});
			 
 		});
		 $("#tProducto").change(function () {	
 			$("#tProducto option:selected").each(function () {
 				id_estado = $(this).val();
 				$.post("includes/getMarcar.php", { id_estado: id_estado }, function(data){
 					$("#tMarca").html(data);
 				});            
 			});
 		});

		 $("#tMarca").change(function () {	
 			$("#tMarca option:selected").each(function () {
 				id_estado = $(this).val();
 				window.location.href="includes/getMarcasTabla.php?id="+id_estado;           
 			});
 		});
		
 	});
 </script>
<div class="row">
		<div class="col-md-12">
			<h2>Reporte de Stock</h2>
		</div>
	</div>
<br>

	<div class="row justify-content-center">
		
		<div class="col-md-3">
			<label for="tProducto">Tipo Producto</label>
			<select name="tProducto" id="tProducto">
				<option value='0'>Todos</option>
				<?php while($rs=mysqli_fetch_array($rsTp)){?>
					<option value="<?php echo $rs['idTipoProducto'] ?>" <?php if($tipo==$rs['idTipoProducto']) echo 'Selected'?>><?php echo $rs['descripcion'];?></option>
				<?php }; ?>

			</select>
			<label for="tMarca">Marca</label>
			<select name="tMarca" id="tMarca">
			     <option>seleccione Marca</option>
				 <?php while($rs=mysqli_fetch_array($rsTp2)){?>
					<option value="<?php echo $rs['idMarca'] ?>" <?php if($tipo==$rs['idMarca']) echo 'Selected'?>><?php echo $rs['nombreMarca'];?></option>
				 <?php }; ?>
			</select>
			
			
		</div>
		<div class="col-md-6">
		
	</div>
	<div class="col-md-12" id="datostabla"></div>
	</div>
	
<?php if(isset($_GET['id']) && !isset($_GET['idMarca'])){
        $queryStocktp="SELECT p.descripcion as prod, p.cantidadProd as cant, p.lote, pf.estante, 
		pf.fila, pf.columna, tp.descripcion as tprod, m.nombreMarca as marca
		from productos as p
		JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico
		JOIN productostpmarcas as pm on pm.idProducto=p.idProducto
		JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca
		JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto
		JOIN marcas as m on tpm.idMarca=m.idMarca
		WHERE tpm.idTipoProducto={$_GET['id']}";
		$resultadoM = $conexion->query($queryStocktp);
	    $productos_x_pag = 1;
	
	    $total_productos = mysqli_num_rows($resultadoM);
	    $paginas = $total_productos / $productos_x_pag;
	    $paginas = ceil($paginas);
		if (isset($_GET['pagina'])) {
			$iniciar = ($_GET['pagina'] - 1) * $productos_x_pag;
			$consulta1=mysqli_query($conexion,"SELECT p.descripcion as prod, p.cantidadProd as cant, p.lote, pf.estante, 
			pf.fila, pf.columna, tp.descripcion as tprod, m.nombreMarca as marca
			from productos as p
			JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico
			JOIN productostpmarcas as pm on pm.idProducto=p.idProducto
			JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca
			JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto
			JOIN marcas as m on tpm.idMarca=m.idMarca
			WHERE tpm.idTipoProducto={$_GET['id']} limit $iniciar,$productos_x_pag");
			$html= '<div class="row justify-content-center">
			<div class="col-md-12">
			   <div style="background: white">
				  <table class="table striped" style="background:#fafafa;white:70%">
					  <tr>
						 <th>Producto</th>		
						 <th>Tipo Producto</th>
						 <th>Marca</th>
						 <th>lote</th>
						 <th>Puesto</th>
						 <th>Cantidad</th>
					   </tr>';
			while ($rs = mysqli_fetch_array($consulta1)) 
			{
				$html.="<tr>
						<td>".$rs['prod']."</td>
						<td>".$rs['tprod']."</td>
						<td>".$rs['marca']."</td>
						<td>".$rs['lote']."</td>
						<td>".$rs['estante']."-".$rs['fila']."-".$rs['columna']."</td>
						<td>".$rs['cant']."</td>
					   </tr>";
			}
			$html.='</table>
      </div>
   </div>
 </div>';

 echo $html;?>
 <form action="stockPDF.php" method="POST">
	
	<input id="tProducto" name="tProducto" value="<?php echo $_GET['id'];?>" hidden>	
	<input id="tMarca" name="tMarca" value="0" hidden>
	<button name="exportPDF" value="export" style="border-color: #e0e0e0;background:white" class="btn btn-outline-warning" id="button-addon2">EXPORTAR PDF</button>
</form>
	<?php	}?>
			
			<div class="container" style="padding-top:40px">
  <nav arial-label="page navigation">
    <ul class="pagination justify-content-center">
      <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>"><a class="page-link" href="reportesStock.php?id=<?php echo $_GET['id']; ?>&pagina=<?php echo $_GET['pagina'] - 1 ?>">Anterior</a></li>
      <?php for ($i = 1; $i <= $paginas; $i++) : ?>
        <li class="<?php echo $_GET['pagina'] == $i ? 'active' : '' ?>"><a class="page-link" href="reportesStock.php?id=<?php echo $_GET['id']; ?>&pagina=<?php echo $i ?>"><?php echo $i ?></a></li>
      <?php endfor ?>
      <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>"><a class="page-link" href="reportesStock.php?id=<?php echo $_GET['id']; ?>&pagina=<?php echo $_GET['pagina'] + 1 ?>">Siguiente</a></li>
    </ul>
  </nav>
</div>
     <?php }
	 
     if(isset($_GET['id']) && isset($_GET['idMarca'])){
        $queryStocktp="SELECT p.descripcion as prod, p.cantidadProd as cant, p.lote, pf.estante, 
		pf.fila, pf.columna, tp.descripcion as tprod, m.nombreMarca as marca
		from productos as p
		JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico
		JOIN productostpmarcas as pm on pm.idProducto=p.idProducto
		JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca
		JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto
		JOIN marcas as m on tpm.idMarca=m.idMarca
		WHERE tpm.idMarca={$_GET['idMarca']}";
		$resultadoM = $conexion->query($queryStocktp);
	    $productos_x_pag = 1;
	
	    $total_productos = mysqli_num_rows($resultadoM);
	    $paginas = $total_productos / $productos_x_pag;
	    $paginas = ceil($paginas);
		if (isset($_GET['pagina'])) {s
			$iniciar = ($_GET['pagina'] - 1) * $productos_x_pag;
			$consulta1=mysqli_query($conexion,"SELECT p.descripcion as prod, p.cantidadProd as cant, p.lote, pf.estante, 
			pf.fila, pf.columna, tp.descripcion as tprod, m.nombreMarca as marca
			from productos as p
			JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico
			JOIN productostpmarcas as pm on pm.idProducto=p.idProducto
			JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca
			JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto
			JOIN marcas as m on tpm.idMarca=m.idMarca
			WHERE tpm.idMarca={$_GET['idMarca']} limit $iniciar,$productos_x_pag");
			$html= '<div class="row justify-content-center">
			<div class="col-md-12">
			   <div style="background: white">
				  <table class="table striped" style="background:#fafafa;white:70%">
					  <tr>
						 <th>Producto</th>		
						 <th>Tipo Producto</th>
						 <th>Marca</th>
						 <th>lote</th>
						 <th>Puesto</th>
						 <th>Cantidad</th>
					   </tr>';
			while ($rs = mysqli_fetch_array($consulta1)) 
			{
				$html.="<tr>
						<td>".$rs['prod']."</td>
						<td>".$rs['tprod']."</td>
						<td>".$rs['marca']."</td>
						<td>".$rs['lote']."</td>
						<td>".$rs['estante']."-".$rs['fila']."-".$rs['columna']."</td>
						<td>".$rs['cant']."</td>
					   </tr>";
			}
			$html.='</table>
      </div>
   </div>
 </div>';

 echo $html;?>
 <form action="stockPDF.php" method="POST">
	
	<input id="tProducto" name="tProducto" value="<?php echo $_GET['id'];?>" hidden>	
	<input id="tMarca" name="tMarca" value="<?php echo $_GET['idMarca'];?>" hidden>
	<button name="exportPDF" value="export" style="border-color: #e0e0e0;background:white" class="btn btn-outline-warning" id="button-addon2">EXPORTAR PDF</button>
</form>
	<?php	}?>
			
			<div class="container" style="padding-top:40px">
  <nav arial-label="page navigation">
    <ul class="pagination justify-content-center">
      <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>"><a class="page-link" href="reportesStock.php?id=<?php echo $_GET['id']; ?>&idMarca=<?php echo $_GET['idMarca'];?>&pagina=<?php echo $_GET['pagina'] - 1 ?>">Anterior</a></li>
      <?php for ($i = 1; $i <= $paginas; $i++) : ?>
        <li class="<?php echo $_GET['pagina'] == $i ? 'active' : '' ?>"><a class="page-link" href="reportesStock.php?id=<?php echo $_GET['id']; ?>&idMarca=<?php echo $_GET['idMarca'];?>&pagina=<?php echo $i ?>"><?php echo $i ?></a></li>
      <?php endfor ?>
      <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>"><a class="page-link" href="reportesStock.php?id=<?php echo $_GET['id']; ?>&idMarca=<?php echo $_GET['idMarca'];?>&pagina=<?php echo $_GET['pagina'] + 1 ?>">Siguiente</a></li>
    </ul>
  </nav>
</div>
     <?php }
	 
?>






<?php require 'footer.php'; ?>