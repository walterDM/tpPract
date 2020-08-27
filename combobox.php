 
<?php require('header.php');
	require ('conexion.php');
	
	$query = "SELECT idTipoProducto, descripcion FROM tiposproductos ORDER BY descripcion ASC";
	$resultado=$conexion->query($query);
?>

<head>
	<script language="javascript" src="jquery-3.1.1.min.js"></script>
	<script language="javascript">
			$(document).ready(function(){
				$("#cbxTipoProducto").change(function () {	
					$("#cbxTipoProducto option:selected").each(function () {
						id_estado = $(this).val();
						$.post("includes/getMarcar.php", { id_estado: id_estado }, function(data){
							$("#cbxMarca").html(data);
						});            
					});
				})
			});
	</script>
	
</head>

<body>
	<form id="comboProd" name="comboProd" action="guarda.php" method="POST">
		<div>tipo Productos
			<select id="cbxTipoProducto" name="cbxTipoProducto"> 
				<option value="0">seleccionar tipo Producto</option>
				<?php while ($rsTP = $resultado->fetch_assoc()) {?>
					<?php //echo $rsTP['idTipoProducto'] ?>
					<option value="<?php echo $rsTP['idTipoProducto']; ?>"><?php echo $rsTP['descripcion']; ?></option>
				<?php } ?>	
				</select></div>

		<div> seleccione Marca :
			<select  id="cbxMarca" name="cbxMarca"><option>seleccione Marca</option></select>
		</div>

	</form>
</body>