<?php 
//
require 'vendor/autoload.php';
require 'conexion.php';

//load phpspreadsheet class using namespaces
use PhpOffice\PhpSpreadsheet\Spreadsheet;
//call iofactory instead of xlsx writer
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
function export($pedido){
	require 'conexion.php';
		
	$idPedido=$pedido;
	$reader= IOFactory::createReader('Xlsx');
	$sheet=$reader->load("archivos/template.xlsx");

//seteos de celdas
	$sheetContent=$sheet->getActiveSheet();
	$sheetContent->getStyle('A:D')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

	$sheetContent->getColumnDimension('A')
	->setAutoSize(true);
	$sheetContent->getColumnDimension('B')
	->setAutoSize(true);
	$sheetContent->getColumnDimension('D')
	->setAutoSize(true);	

//styling arrays
//table head style
	$tableHead = [
		'font'=>[
			'color'=>[
				'rgb'=>'000000'
			],
			'bold'=>true,
			'size'=>16
		],

	];
//even row
	$evenRow = [
		'font'=>[
			'color'=>[
				'rgb'=>'ffffff'
			],
			'size'=>14

		],
		'fill'=>[
			'fillType' => Fill::FILL_SOLID,
			'startColor' => [
				'rgb' => 'f59d62'
			],
		],

	];
//odd row
	$oddRow = [
		'font'=>[
			'color'=>[
				'rgb'=>'ffffff'
			],
			'size'=>14
		],
		'fill'=>[
			'fillType' => Fill::FILL_SOLID,
			'startColor' => [
				'rgb' => 'f5873d'
			],
		],

	];

//styling arrays end
//seteo de fecha
	$fechaActual = date('d-m-Y');

	$sheetContent->setCellValue('D1','Fecha: '.$fechaActual);
	$sheetContent->getStyle('D1')->applyFromArray($tableHead);
	$fila=5;

//ingresos de datos
	//modificar query
	/*$queryPE="SELECT ep.idPedidoProveedor, ep.idContactoProveedor FROM estadospedidos as ep where idEstado=$pedido";
	$resultPE=mysqli_query($conexion,$queryPE);
	while($r=mysqli_fetch_array($resultPE)){
		$idPedido=$r['idPedidoProveedor'];
		$idCP=$r['idContactoProveedor'];
	}*/
	//no se utiliza mas ↑ se canbia por query que traiga datos con respecto al id recibido


	$filename="Archivos/pedido__".$idPedido.".xlsx";
	$queryDP="SELECT dp.cantidad as cant, m.nombreMarca as marca, tp.descripcion as tp 
	FROM detallespedidos as dp 
	JOIN productos as p on p.idProducto=dp.idProducto
	JOIN productostpmarcas as pm on pm.idProducto=p.idProducto
	JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca
	JOIN marcas as m on m.idMarca=tpm.idMarca
	JOIN tiposproductos as tp on tp.idTipoProducto=tpm.idTipoProducto
	where idPedidoProveedor=$idPedido";
	$sheetContent->setCellValue('D3','Pedido N°:  '.$idPedido);
	$sheetContent->getStyle('D3')->applyFromArray($tableHead);
	$resultDP=mysqli_query($conexion,$queryDP);
	while($rs=mysqli_fetch_array($resultDP)){
		$sheetContent->setCellValue('A'.$fila,$rs['tp']);
		$sheetContent->setCellValue('B'.$fila,$rs['marca']);
		$sheetContent->setCellValue('C'.$fila,$rs['cant']);

		if ($fila % 2==0) {
			$sheetContent->getStyle('A'.$fila .':C'.$fila)->applyFromArray($evenRow);
		}else{
			$sheetContent->getStyle('A'.$fila.':C'.$fila)->applyFromArray($oddRow);
		}
		$sheetContent->getStyle('A'.$fila.':B'.$fila)->getFill()
		->setFillType(Fill::FILL_SOLID);
		$fila++;

	}
	$fila=5;
	//create IOFactory object
	$writer = IOFactory::createWriter($sheet, 'Xlsx');
//save into php output
	$writer->save($filename);
	


}

function borrarArchivo($pedido){
	unlink('Archivos/pedido__'.$pedido.'.xlsx');
}


?>