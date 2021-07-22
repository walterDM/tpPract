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
 				$.post("includes/getTablaStock.php", { id_estado: id_estado }, function(data){
 					$("#datostabla").html(data);
 				});            
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
 				$.post("includes/getMarcasTabla.php", { id_estado: id_estado }, function(data){
 					$("#datostabla").html(data);
 				});            
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
<form action="stockPDF.php" method="POST">
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
	<button name="exportPDF" value="export" style="border-color: #e0e0e0;background:white" class="btn btn-outline-warning" id="button-addon2">EXPORTAR PDF</button>
</form>

	





<?php require 'footer.php'; ?>