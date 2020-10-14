<?php require 'header.php';
////////////Variable del combo/////////////
$tipo=$_POST['tProducto'];



/*$queryStock="SELECT p.descripcion, p.cantidadProd, p.lote, pf.estante, pf.fila, pf.columna 
		  from productos as p
		  JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico
		  JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca
          JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto
          WHERE tpm.idTipoProducto=$tipo ";*/
$queryTp="SELECT tp.descripcion, tp.idTipoProducto from tiposproductos as tp";
$rsTp=mysqli_query($conexion,$queryTp);

?>
<div class="row justify-content-center">
 <form action="#" method="POST">
	  <div class="col-md-4">
	   <label for="fDesde">Tipo Producto</label>
		   <select name="tProducto" id="tProducto">
		    <option value='0'>Todos</option>
		    <?php while($rs=mysqli_fetch_array($rsTp)){
		     echo "<option value=".$rs['idTipoProducto'].">".$rs['descripcion']."</option>";
		    }; ?>
		   </select>
	  </div>
 </form>
</div>
<?php require 'footer.php'; ?>