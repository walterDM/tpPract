<?php
	
	require ('../conexion.php');
	if(isset($_GET['id'])){
	$id_estado = $_GET['id'];
	
	$queryStocktp="SELECT tpm.idTipoProducto as tproducto, p.descripcion as prod, p.cantidadProd as cant, p.lote, pf.estante, 
	pf.fila, pf.columna, tp.descripcion as tprod, m.nombreMarca as marca, m.idMarca as idmarca
	from productos as p
	JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico
	JOIN productostpmarcas as pm on pm.idProducto=p.idProducto
	JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca
	JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto
	JOIN marcas as m on tpm.idMarca=m.idMarca
	WHERE tpm.idMarca=$id_estado";
	$resultadoM = $conexion->query($queryStocktp);
	
	while ($rs = mysqli_fetch_array($resultadoM)){
    $idMarca=$rs['idmarca'];
    $idProducto=$rs['tproducto'];
  }
  header("location: ../reportesStock.php?id=$idProducto&idMarca=$idMarca&pagina=1");
  }
  if(isset($_GET['idCaducidad'])){
	$id_estado = $_GET['idCaducidad'];
	
	$queryStocktp="SELECT tpm.idTipoProducto as tproducto, p.descripcion as prod, p.cantidadProd as cant, p.lote, pf.estante, 
	pf.fila, pf.columna, tp.descripcion as tprod, m.nombreMarca as marca, m.idMarca as idmarca
	from productos as p
	JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico
	JOIN productostpmarcas as pm on pm.idProducto=p.idProducto
	JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca
	JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto
	JOIN marcas as m on tpm.idMarca=m.idMarca
	WHERE tpm.idMarca=$id_estado";
	$resultadoM = $conexion->query($queryStocktp);
	
	while ($rs = mysqli_fetch_array($resultadoM)){
    $idMarca=$rs['idmarca'];
    $idProducto=$rs['tproducto'];
  }
  header("location: ../reportesCaducidad.php?id=$idProducto&idMarca=$idMarca&fDesde=0000-00-00&fHasta=0000-00-00&pagina=1");
  }
