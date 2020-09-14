<?php 
require 'conexion.php';
if (isset($_POST['seleccionado']) && !empty($_POST['seleccionado']) && isset($_POST['cant'])) {
	require 'Classes/PHPExcel.php';
	$vari=$_POST['seleccionado'];
	$cant[]=$_POST['cant'];
	$idFactura=2;
	$filename="Factura__".$idFactura;//id Factura
	$objExcel=new PHPExcel();

	$objExcel->getProperties()
	->setCreator("empleado")
	->setTitle("exportación")
	;

	$objExcel->setActiveSheetIndex(0);
	$objExcel->getActiveSheet()->setTitle("Pedido");

	$objExcel->getActiveSheet()->setCellValue("A1","Producto");
	$objExcel->getActiveSheet()->setCellValue("B1","Cantidad");
	$objExcel->getActiveSheet()->setCellValue("C1","Precio");

	for ($i=0; $i < sizeof($vari) ; $i++) { 
		$queryMTP="SELECT m.nombreMarca as marca, tp.descripcion as tProducto FROM marcas as m
		JOIN tiposproductos_marcas as tpm  on tpm.idMarca= m.idMarca 
		JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto
		where tpm.idTpMarca=$vari[$i]";
		$resultMTP=mysqli_query($conexion,$queryMTP);
		while ($r=mysqli_fetch_array($resultMTP)) {
			$objExcel->getActiveSheet()->setCellValue('A'.($i+2),$r['tProducto']);
			$objExcel->getActiveSheet()->setCellValue('B'.($i+2),$r['marca']);
			$objExcel->getActiveSheet()->setCellValue('C'.($i+2),$_POST['cant'][$i]);

		}
	};

	header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
	header('Content-Disposition: attachment;filename="Productos.xlsx"');
	header('Cache-Control: max-age=0');;

	$objWriter= new PHPExcel_Writer_Excel2007($objExcel);
	$objWriter->save('php://output');
}
?>