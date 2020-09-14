<?php 
if (isset($_POST['seleccionado']) && !empty($_POST['seleccionado']) && isset($_POST['cant'])) {
	require 'PHPExcel/Classes/PHPExcel.php';

	$vari=$_POST['seleccionado'];
	/*echo count($vari);
	foreach ($_POST['seleccionado'] as $s) */
		for ($i=0; $i < sizeof($vari) ; $i++) { 
			$queryMTP="SELECT m.nombreMarca, tp.descripcion FROM marcas as m
			JOIN tiposproductos_marcas as tpm  on tpm.idMarca= m.idMarca 
			JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto
			where tpm.idTpMarca=$vari[$i]";
			$resultMTP=mysqli_query($conexion,$queryMTP);
			while ($r=mysqli_fetch_array($resultMTP)) {
				echo "TIPO PRODUCTO: ".$r['descripcion']."<br>";
				echo "Marca: ".$r['nombreMarca']."<br>";
				echo "camtidad: ". $_POST['cant'][$i]."<br>";

				$objExcel=new PHPExcel();

				$objExcel->getProperties()
				->setCreator("empleado")
				->setTitle("exportación")
				;

				$objExcel->setActiveSheetIndex(0);
				$objExcel->getActiveSheet()->setTitle("Pedido");

				$objExcel->getActiveSheet()->setCellValue("A1","Producto");
				$objExcel->getActiveSheet()->setCellValue("B1","Cantidad");
				$objExcel->getActiveSheet()->setCellValue("B1","Precio");

				header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
				header("Content-Disposition: attachment;filename=Prueba.xls");
				header('Cache-Control: max age=0');

				$objWriter= PHPExcel_IOFactory::createWriter($objExcel,'Excel2007');
				$objWriter->save('php://output');
			}
		};
	}
	?>