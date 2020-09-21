<?php require 'ClassesExcel/PHPExcel.php'; 
require 'conexion.php';
/*echo $_POST['tp']."<br>".
	 $_POST['marca']."<br>".
	 "ESTA ES LA CANTIDAD: ". $_POST['cant'][0];*/

	 $pedido=1;
	 $fila=2;

	 $objExcel= new PHPExcel();
	 $objExcel->getProperties()->setCreator("GestiStock")->setDescription("Pedido");

	 $objExcel->setActiveSheetIndex(0);
	 $objExcel->getActiveSheet()->setTitle("pedido N°-".$pedido)
	 ->setCellValue("A1","Tipo Producto")
	 ->setCellValue("B1","Marca")
	 ->setCellValue("C1","Cantidad");

	/* for ($i=0; $i <count($_POST['tp']) ; $i++) { 
	 	$objExcel->getActiveSheet()->setCellValue("A".$fila,"Tipo Producto");
	 	$objExcel->getActiveSheet()->setCellValue("B".$fila,"Marca");
	 	$objExcel->getActiveSheet()->setCellValue("C".$fila,"Cantidad");


	 	$fila++;
	 }*/

	 header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	 header('Content-Disposition: attachment;filename="pedido.xls"');
	 header('Cache-Control: max-age=0');

	 $objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel2007');
	 $objWriter->save('php://output');
	 exit;

	 ?>
