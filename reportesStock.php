<?php require 'header.php';
////////////Variable del combo/////////////
if (isset($POST['buscar'])) {
	$tipo=$_POST['tProducto'];
	}





$queryStockIni="SELECT p.descripcion, p.cantidadProd, p.lote, pf.estante, pf.fila, pf.columna, tp.descripcion
		  from productos as p
		  JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico
          JOIN productostpmarcas as pm on pm.idProducto=p.idProducto
		  JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca
          JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto";
$rsStockIni=mysqli_query($conexion,$queryStockIni);
/*$queryStocktp="SELECT p.descripcion, p.cantidadProd, p.lote, pf.estante, pf.fila, pf.columna, tp.descripcion
		  from productos as p
		  JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico
          JOIN productostpmarcas as pm on pm.idProducto=p.idProducto
		  JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca
          JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto
          WHERE tpm.idTipoProducto=$tipo ";
$rsStockTp=mysqli_query($conexion,$queryStocktp);*/
$queryTp="SELECT tp.descripcion, tp.idTipoProducto from tiposproductos as tp";
$rsTp=mysqli_query($conexion,$queryTp);

?>
<div class="row justify-content-center">
 <form action="#" method="POST">
	  <div class="col-md-12">
	   <label for="fDesde">Tipo Producto</label>
		   <select name="tProducto" id="tProducto">
		    <option value='0'>Todos</option>
		    <?php while($rs=mysqli_fetch_array($rsTp)){
		     echo "<option value=".$rs['idTipoProducto'].">".$rs['descripcion']."</option>";
		    }; ?>
		   </select>
	  </div>
	  <button name="buscar" value="buscar" style="border-color: #e0e0e0;background:white" class="btn btn-outline-warning" id="button-addon2"><i class="fas fa-search"></i></button>
 </form>
</div>
<div class="row justify-content-center">
	<div class="col-md-12">
		<table>
			<?php if(isset($_POST['buscar'])) {
				while ($rs=mysqli_fetch_array($)):

			}else{
				while ($rs=mysqli_fetch_array($)):
				
			} ?>
		</table>
	</div>
</div>
<?php require 'footer.php'; ?>