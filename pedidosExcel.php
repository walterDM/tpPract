<?php require 'ClassesExcel/PHPExcel.php'; 
	  require 'conexion.php';
echo $_POST['tp']."<br>".
	 $_POST['marca']."<br>".
	 "ESTA ES LA CANTIDAD: ". $_POST['cant'][0];
$pedido=1;

$objExcel= new PHPExcel();
$objExcel->getProperties()->setCreator("GestiStock")->setDescription("Pedido");

$objExcel->setActiveSheet(0);
$objExcel->getActiveSheet()->setTitle(utf8_decode("pedido N°: ").$pedido);

$objExcel->getActiveSheet()->setCellValue("A1","Tipo Producto");
$objExcel->getActiveSheet()->setCellValue("B1","Marca");
$objExcel->getActiveSheet()->setCellValue("C1","Cantidad");

?>
