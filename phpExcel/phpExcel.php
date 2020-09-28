<?php 
require 'vendor/autoload.php';
require 'conexion.php';

//load phpspreadsheet class using namespaces
use PhpOffice\PhpSpreadsheet\Spreadsheet;
//call iofactory instead of xlsx writer
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;

$reader= IOFactory::createReader('Xlsx');
$sheet=$reader->load("template.xlsx");

$sheetContent=$sheet->getActiveSheet();
$fila=3;
$queryPE="SELECT ep.idPedidoProveedor, ep.idContactoProveedor FROM estadospedidos as ep where idEstado=1 LIMIT 0,2";
$resultPE=mysqli_query($conexion,$queryPE);
while($r=mysqli_fetch_array($resultPE)){
	$idPedido[]=$r['idPedidoProveedor'];
	$idCP[]=$r['idContactoProveedor'];
}
for($i=0; $i<sizeof($idPedido);$i++) {
	$idped=intval($idPedido[$i]);
	echo $idped.'<br>';
	echo $idCP[$i].'<br>';
	$filename="Archivos/pedido__".$idPedido[$i].".xlsx";
	$queryDP="SELECT dp.idProducto, dp.cantidad FROM detallespedidos as dp where idPedidoProveedor=$idped";
	$resultDP=mysqli_query($conexion,$queryDP);
	while($rs=mysqli_fetch_array($resultDP)){
		$sheetContent->setCellValue('A'.$fila,$rs['idProducto']);
		$sheetContent->setCellValue('C'.$fila,$rs['cantidad']);
		$sheetContent->setCellValue('D'.$fila,$idPedido[$i]);
		$fila++;
	}
$fila=3;
	//create IOFactory object
$writer = IOFactory::createWriter($sheet, 'Xlsx');
//save into php output
$writer->save($filename);
}
unlink('Archivos/pedido__1.xlsx');






?>