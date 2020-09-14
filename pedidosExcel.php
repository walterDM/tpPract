<?php 
	require 'PHPExcel/Classes/PHPExcel.php';

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
 ?>