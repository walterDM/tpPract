<?php 


if(!isset($_GET['pagina'])){
	header("location:reportesCaducidad.php?id=0&fDesde=0000-00-00&fHasta=0000-00-00&pagina=1");
  }
require 'header.php';
$tipo=0;
////////////Variable del combo/////////////



$queryTp="SELECT tp.descripcion, tp.idTipoProducto from tiposproductos as tp";
$queryTp2="SELECT tm.nombreMarca, tm.idMarca from marcas as tm";
$rsTp=mysqli_query($conexion,$queryTp);
$rsTp2=mysqli_query($conexion,$queryTp2);
if(isset($_GET['id']) && $_GET['id']>0){
	$id=$_GET['id'];
}else{
	$id=0;
}
?>

<script language="javascript">
	
 	$(document).ready(function(){
	
 		$("#tProducto").change(function () {	
 			$("#tProducto option:selected").each(function () {
 				id_estado = $(this).val();
			
 				window.location.href="reportesCaducidad.php?id="+id_estado+"&fDesde=0000-00-00&fHasta=0000-00-00&pagina=1";
 			            
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
 				window.location.href="includes/getMarcasTabla.php?idCaducidad="+id_estado;           
 			});
 		});
		
 	});
 </script>
<div class="row">
		<div class="col-md-12">
			<h2>Reporte de Caducidad</h2>
		</div>
	</div>
<br>

	<div class="row justify-content-center">
	    <div class="col-md-6">
		  <form action="caducidadPDF.php" method="POST">	

			<label for="fDesde">Desde</label>
			<input type="date" id="fDesde" name="fDesde" <?php if (isset($_GET['fDesde'])) {
				echo "value='".$_GET['fDesde']."'";
			} ?>>

            <?php if(isset($_GET['id']) && $_GET['id']>0){?>
				      <input type="text" id="idtipo" name="idtipo" value="<?php echo $_GET['id']?>" hidden>
		
			<?php     if(isset($_GET['idMarca'])){?>
				         <input type="text" id="idmarca" name="idmarca" value="<?php echo $_GET['idMarca']?>" hidden>
			<?php     }else{ ?>
				         <input type="text" id="idmarca" name="idmarca" value="0" hidden>
			<?php	  }
			      }
			      if(isset($_GET['id']) && $_GET['id']==0){?>
				      <input type="text" id="idtipo" name="idtipo" value="0" hidden>
			<?php }?>
			<label for="fHasta">Hasta</label>
			<input type="date" id="fHasta" name="fHasta" <?php if (isset($_GET['fHasta'])) {
				echo "value='".$_GET['fHasta']."'";
			}else{echo "value='".date("d-m-Y")."'";} ?>>
			

			<button name="buscar" value="0"  style="border-color: #e0e0e0;background:white" class="btn btn-outline-warning" id="button-addon2"><i class="fas fa-search"></i></button>
		  </form>  
		</div>	
		<div class="col-md-4">
			<label for="tProducto">Tipo Producto</label>
			<?php if(isset($_GET['id']) && $_GET['id']>0){
				        $queryM = "SELECT DISTINCT  tp.idTipoProducto, tp.descripcion FROM marcas as m inner join  tiposproductos_marcas as tpm on  tpm.idTipoProducto='{$_GET['id']}' and tpm.idMarca=m.idMarca ORDER BY m.nombreMarca ASC";
						$resultadoM = $conexion->query($queryM);?>
						<select name="tProducto" id="tProducto">
							<option value='0'>Todos</option>
							<?php while($rs=mysqli_fetch_array($rsTp)){?>
								<option value="<?php echo $rs['idTipoProducto'] ?>" <?php if($_GET['id']==$rs['idTipoProducto']) echo 'Selected'?>><?php echo $rs['descripcion'];?></option>
							<?php }; ?>
        
						</select>
			<?php  }else{ ?>
				<select name="tProducto" id="tProducto">
							<option value='0'>Todos</option>
							<?php while($rs=mysqli_fetch_array($rsTp)){?>
								<option value="<?php echo $rs['idTipoProducto'] ?>"><?php echo $rs['descripcion'];?></option>
							<?php }; ?>
        
						</select>
			<?php  } ?>					
			<label for="tMarca">Marca</label>
			<?php if(isset($_GET['id']) && $_GET['id']>0){
				        $queryM = "SELECT DISTINCT  m.idMarca, m.nombreMarca FROM marcas as m inner join  tiposproductos_marcas as tpm on  tpm.idTipoProducto='{$_GET['id']}' and tpm.idMarca=m.idMarca ORDER BY m.nombreMarca ASC";
						$resultadoM = $conexion->query($queryM);?>
						<select name="tMarca" id="tMarca">
							<option>seleccione Marca</option>
							<?php while($rs=mysqli_fetch_array($resultadoM)){?>
								<option value="<?php echo $rs['idMarca'] ?>" <?php if($tipo==$rs['idMarca']) echo 'Selected'?>><?php echo $rs['nombreMarca'];?></option>
							<?php }; ?>
						</select>
			<?php  }else{ ?>
				        <select name="tMarca" id="tMarca">
							<option>seleccione Marca</option>
							<?php while($rs=mysqli_fetch_array($rsTp2)){?>
								<option value="<?php echo $rs['idMarca'] ?>" <?php if($tipo==$rs['idMarca']) echo 'Selected'?>><?php echo $rs['nombreMarca'];?></option>
							<?php }; ?>
						</select>
			<?php  } ?>

			
			
		</div>
		<div class="col-md-6">
		
	</div>
	<div class="col-md-12" id="datostabla"></div>
	</div>
	
<?php if((isset($_GET['id']) && $_GET['id']>0)  &&  !isset($_GET['idMarca']) && (isset($_GET['fDesde']) && $_GET['fDesde']=='0000-00-00') && (isset($_GET['fHasta']) && $_GET['fHasta']=='0000-00-00')){
        $queryStocktp="SELECT p.descripcion as prod,p.fechaCaducidad, p.cantidadProd as cant, p.lote, pf.estante, 
		pf.fila, pf.columna, tp.descripcion as tprod, m.nombreMarca as marca
		from productos as p
		JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico
		JOIN productostpmarcas as pm on pm.idProducto=p.idProducto
		JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca
		JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto
		JOIN marcas as m on tpm.idMarca=m.idMarca
		WHERE tpm.idTipoProducto={$_GET['id']}";
		$resultadoM = $conexion->query($queryStocktp);
	    $productos_x_pag = 4;
	
	    $total_productos = mysqli_num_rows($resultadoM);
	    $paginas = $total_productos / $productos_x_pag;
	    $paginas = ceil($paginas);
		if (isset($_GET['pagina'])) {
			$iniciar = ($_GET['pagina'] - 1) * $productos_x_pag;
			$consulta1=mysqli_query($conexion,"SELECT p.descripcion as prod,p.fechaCaducidad, p.cantidadProd as cant, p.lote, pf.estante, 
			pf.fila, pf.columna, tp.descripcion as tprod, m.nombreMarca as marca
			from productos as p
			JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico
			JOIN productostpmarcas as pm on pm.idProducto=p.idProducto
			JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca
			JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto
			JOIN marcas as m on tpm.idMarca=m.idMarca
			WHERE tpm.idTipoProducto={$_GET['id']} ORDER BY p.fechaCaducidad ASC limit $iniciar,$productos_x_pag");
			$html= '<div class="row justify-content-center">
			<div class="col-md-12">
			   <div style="background: white">
				  <table class="table striped" style="background:#fafafa;white:70%">
					  <tr>
						 <th>Producto</th>		
						 <th>Tipo Producto</th>
						 <th>Marca</th>
						 <th>Vencimiento</th>
						 <th>lote</th>
						 <th>Puesto</th>
						 <th>Cantidad</th>
					   </tr>';
			while ($rs = mysqli_fetch_array($consulta1)) 
			{
			$fecha=date('d/m/Y',strtotime($rs['fechaCaducidad']));
			
            $fecha_actual=date('Y-m-d');
			$fecha_prox_vencer=date("Y-m-d",strtotime($fecha_actual."+ 10 days"));
			if($rs['fechaCaducidad']<$fecha_actual){
				$html.="<tr style='background:red'>
						<td>".$rs['prod']."</td>
						<td>".$rs['tprod']."</td>
						<td>".$rs['marca']."</td>
						<td>".$fecha."</td>
						<td>".$rs['lote']."</td>
						<td>".$rs['estante']."-".$rs['fila']."-".$rs['columna']."</td>
						<td>".$rs['cant']."</td>
					   </tr>";
			}else if($rs['fechaCaducidad']>$fecha_actual && $rs['fechaCaducidad']<=$fecha_prox_vencer){
			    $html.="<tr style='background:yellow'>
						<td>".$rs['prod']."</td>
						<td>".$rs['tprod']."</td>
						<td>".$rs['marca']."</td>
						<td>".$fecha."</td>
						<td>".$rs['lote']."</td>
						<td>".$rs['estante']."-".$rs['fila']."-".$rs['columna']."</td>
						<td>".$rs['cant']."</td>
					   </tr>";	
			}else{
				$html.="<tr>
						<td>".$rs['prod']."</td>
						<td>".$rs['tprod']."</td>
						<td>".$rs['marca']."</td>
						<td>".$fecha."</td>
						<td>".$rs['lote']."</td>
						<td>".$rs['estante']."-".$rs['fila']."-".$rs['columna']."</td>
						<td>".$rs['cant']."</td>
					   </tr>";
			}
		    }
			$html.='</table>
      </div>
   </div>
 </div>';

 echo $html;?>
 <form action="caducidadPDF.php" method="POST">
	
	<input id="tProducto" name="tProducto" value="<?php echo $_GET['id'];?>" hidden>	
	<input id="tMarca" name="tMarca" value="0" hidden>
	<input id="fdesde" name="fDesde" value="0000-00-00" hidden>
	<input id="fHasta" name="fHasta" value="0000-00-00" hidden>
	<button name="exportPDF" value="export" style="border-color: #e0e0e0;background:white" class="btn btn-outline-warning" id="button-addon2">EXPORTAR PDF</button>
</form>
	<?php	}?>
			
			<div class="container" style="padding-top:40px">
  <nav arial-label="page navigation">
    <ul class="pagination justify-content-center">
      <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>"><a class="page-link" href="reportesCaducidad.php?id=<?php echo $_GET['id']; ?>&fDesde=<?php echo $_GET['fDesde']; ?>&fHasta=<?php echo $_GET['fHasta']; ?>&pagina=<?php echo $_GET['pagina'] - 1 ?>">Anterior</a></li>
      <?php for ($i = 1; $i <= $paginas; $i++) : ?>
        <li class="<?php echo $_GET['pagina'] == $i ? 'active' : '' ?>"><a class="page-link" href="reportesCaducidad.php?id=<?php echo $_GET['id']; ?>&fDesde=<?php echo $_GET['fDesde']; ?>&fHasta=<?php echo $_GET['fHasta']; ?>&pagina=<?php echo $i ?>"><?php echo $i ?></a></li>
      <?php endfor ?>
      <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>"><a class="page-link" href="reportesCaducidad.php?id=<?php echo $_GET['id']; ?>&fDesde=<?php echo $_GET['fDesde']; ?>&fHasta=<?php echo $_GET['fHasta']; ?>&pagina=<?php echo $_GET['pagina'] + 1 ?>">Siguiente</a></li>
    </ul>
  </nav>
</div>
     <?php }
	 if((isset($_GET['id']) && $_GET['id']>0)  &&  !isset($_GET['idMarca']) && (isset($_GET['fDesde']) && $_GET['fDesde']!='0000-00-00') && (isset($_GET['fHasta']) && $_GET['fHasta']!='0000-00-00')){
        $queryStocktp="SELECT p.descripcion as prod,p.fechaCaducidad, p.cantidadProd as cant, p.lote, pf.estante, 
		pf.fila, pf.columna, tp.descripcion as tprod, m.nombreMarca as marca
		from productos as p
		JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico
		JOIN productostpmarcas as pm on pm.idProducto=p.idProducto
		JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca
		JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto
		JOIN marcas as m on tpm.idMarca=m.idMarca
		WHERE tpm.idTipoProducto={$_GET['id']}
		  AND p.fechaCaducidad BETWEEN '{$_GET['fDesde']}' AND '{$_GET['fHasta']}'";
		$resultadoM = $conexion->query($queryStocktp);
	    $productos_x_pag = 4;
	
	    $total_productos = mysqli_num_rows($resultadoM);
	    $paginas = $total_productos / $productos_x_pag;
	    $paginas = ceil($paginas);
		if (isset($_GET['pagina'])) {
			$iniciar = ($_GET['pagina'] - 1) * $productos_x_pag;
			$consulta1=mysqli_query($conexion,"SELECT p.descripcion as prod,p.fechaCaducidad, p.cantidadProd as cant, p.lote, pf.estante, 
			pf.fila, pf.columna, tp.descripcion as tprod, m.nombreMarca as marca
			from productos as p
			JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico
			JOIN productostpmarcas as pm on pm.idProducto=p.idProducto
			JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca
			JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto
			JOIN marcas as m on tpm.idMarca=m.idMarca
			WHERE tpm.idTipoProducto={$_GET['id']} 
			AND p.fechaCaducidad BETWEEN '{$_GET['fDesde']}' AND '{$_GET['fHasta']}' ORDER BY p.fechaCaducidad ASC limit $iniciar,$productos_x_pag");
			$html= '<div class="row justify-content-center">
			<div class="col-md-12">
			   <div style="background: white">
				  <table class="table striped" style="background:#fafafa;white:70%">
					  <tr>
						 <th>Producto</th>		
						 <th>Tipo Producto</th>
						 <th>Marca</th>
						 <th>Vencimiento</th>
						 <th>lote</th>
						 <th>Puesto</th>
						 <th>Cantidad</th>
					   </tr>';
			while ($rs = mysqli_fetch_array($consulta1)) 
			{
			$fecha=date('d/m/Y',strtotime($rs['fechaCaducidad']));
			
            $fecha_actual=date('Y-m-d');
			$fecha_prox_vencer=date("Y-m-d",strtotime($fecha_actual."+ 10 days"));
			if($rs['fechaCaducidad']<$fecha_actual){
				$html.="<tr style='background:red'>
						<td>".$rs['prod']."</td>
						<td>".$rs['tprod']."</td>
						<td>".$rs['marca']."</td>
						<td>".$fecha."</td>
						<td>".$rs['lote']."</td>
						<td>".$rs['estante']."-".$rs['fila']."-".$rs['columna']."</td>
						<td>".$rs['cant']."</td>
					   </tr>";
			}else if($rs['fechaCaducidad']>$fecha_actual && $rs['fechaCaducidad']<=$fecha_prox_vencer){
			    $html.="<tr style='background:yellow'>
						<td>".$rs['prod']."</td>
						<td>".$rs['tprod']."</td>
						<td>".$rs['marca']."</td>
						<td>".$fecha."</td>
						<td>".$rs['lote']."</td>
						<td>".$rs['estante']."-".$rs['fila']."-".$rs['columna']."</td>
						<td>".$rs['cant']."</td>
					   </tr>";	
			}else{
				$html.="<tr>
						<td>".$rs['prod']."</td>
						<td>".$rs['tprod']."</td>
						<td>".$rs['marca']."</td>
						<td>".$fecha."</td>
						<td>".$rs['lote']."</td>
						<td>".$rs['estante']."-".$rs['fila']."-".$rs['columna']."</td>
						<td>".$rs['cant']."</td>
					   </tr>";
			}
		    }
			$html.='</table>
      </div>
   </div>
 </div>';

 echo $html;?>
 <form action="caducidadPDF.php" method="POST">
	
	<input id="tProducto" name="tProducto" value="<?php echo $_GET['id'];?>" hidden>	
	<input id="tMarca" name="tMarca" value="0" hidden>
	<input id="fdesde" name="fDesde" value="<?php echo $_GET['fDesde'];?>" hidden>
	<input id="fHasta" name="fHasta" value="<?php echo $_GET['fHasta'];?>" hidden>
	<button name="exportPDF" value="export" style="border-color: #e0e0e0;background:white" class="btn btn-outline-warning" id="button-addon2">EXPORTAR PDF</button>
</form>
	<?php	}?>
			
			<div class="container" style="padding-top:40px">
  <nav arial-label="page navigation">
    <ul class="pagination justify-content-center">
      <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>"><a class="page-link" href="reportesCaducidad.php?id=<?php echo $_GET['id']; ?>&fDesde=<?php echo $_GET['fDesde']; ?>&fHasta=<?php echo $_GET['fHasta']; ?>&pagina=<?php echo $_GET['pagina'] - 1 ?>">Anterior</a></li>
      <?php for ($i = 1; $i <= $paginas; $i++) : ?>
        <li class="<?php echo $_GET['pagina'] == $i ? 'active' : '' ?>"><a class="page-link" href="reportesCaducidad.php?id=<?php echo $_GET['id']; ?>&fDesde=<?php echo $_GET['fDesde']; ?>&fHasta=<?php echo $_GET['fHasta']; ?>&pagina=<?php echo $i ?>"><?php echo $i ?></a></li>
      <?php endfor ?>
      <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>"><a class="page-link" href="reportesCaducidad.php?id=<?php echo $_GET['id']; ?>&fDesde=<?php echo $_GET['fDesde']; ?>&fHasta=<?php echo $_GET['fHasta']; ?>&pagina=<?php echo $_GET['pagina'] + 1 ?>">Siguiente</a></li>
    </ul>
  </nav>
</div>
     <?php }
	  if((isset($_GET['id']) && $_GET['id']==0) && (isset($_GET['fDesde']) && $_GET['fDesde']=='0000-00-00') && (isset($_GET['fHasta']) && $_GET['fHasta']=='0000-00-00')){
        $queryStocktp="SELECT p.descripcion as prod,p.fechaCaducidad, p.cantidadProd as cant, p.lote, pf.estante, 
		pf.fila, pf.columna, tp.descripcion as tprod, m.nombreMarca as marca
		from productos as p
		JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico
		JOIN productostpmarcas as pm on pm.idProducto=p.idProducto
		JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca
		JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto
		JOIN marcas as m on tpm.idMarca=m.idMarca";
		$resultadoM = $conexion->query($queryStocktp);
	    $productos_x_pag = 4;
	
	    $total_productos = mysqli_num_rows($resultadoM);
	    $paginas = $total_productos / $productos_x_pag;
	    $paginas = ceil($paginas);
		if (isset($_GET['pagina'])) {
			$iniciar = ($_GET['pagina'] - 1) * $productos_x_pag;
			$consulta1=mysqli_query($conexion,"SELECT p.descripcion as prod,p.fechaCaducidad, p.cantidadProd as cant, p.lote, pf.estante, 
			pf.fila, pf.columna, tp.descripcion as tprod,m.nombreMarca as marca
			from productos as p
			JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico
			JOIN productostpmarcas as pm on pm.idProducto=p.idProducto
			JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca
			JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto
			JOIN marcas as m on tpm.idMarca=m.idMarca ORDER BY p.fechaCaducidad ASC limit $iniciar,$productos_x_pag");
			$html= '<div class="row justify-content-center">
			<div class="col-md-12">
			   <div style="background: white">
				  <table class="table striped" style="background:#fafafa;white:70%">
					  <tr>
						 <th>Producto</th>		
						 <th>Tipo Producto</th>
						 <th>Marca</th>
						 <th>Vencimiento</th>
						 <th>lote</th>
						 <th>Puesto</th>
						 <th>Cantidad</th>
					   </tr>';
			while ($rs = mysqli_fetch_array($consulta1)) 
			{
				$fecha=date('d/m/Y',strtotime($rs['fechaCaducidad']));
			
				$fecha_actual=date('Y-m-d');
				$fecha_prox_vencer=date("Y-m-d",strtotime($fecha_actual."+ 10 days"));
				if($rs['fechaCaducidad']<$fecha_actual){
					$html.="<tr style='background:red'>
							<td>".$rs['prod']."</td>
							<td>".$rs['tprod']."</td>
							<td>".$rs['marca']."</td>
							<td>".$fecha."</td>
							<td>".$rs['lote']."</td>
							<td>".$rs['estante']."-".$rs['fila']."-".$rs['columna']."</td>
							<td>".$rs['cant']."</td>
						   </tr>";
				}else if($rs['fechaCaducidad']>$fecha_actual && $rs['fechaCaducidad']<=$fecha_prox_vencer){
					$html.="<tr style='background:yellow'>
							<td>".$rs['prod']."</td>
							<td>".$rs['tprod']."</td>
							<td>".$rs['marca']."</td>
							<td>".$fecha."</td>
							<td>".$rs['lote']."</td>
							<td>".$rs['estante']."-".$rs['fila']."-".$rs['columna']."</td>
							<td>".$rs['cant']."</td>
						   </tr>";	
				}else{
					$html.="<tr>
							<td>".$rs['prod']."</td>
							<td>".$rs['tprod']."</td>
							<td>".$rs['marca']."</td>
							<td>".$fecha."</td>
							<td>".$rs['lote']."</td>
							<td>".$rs['estante']."-".$rs['fila']."-".$rs['columna']."</td>
							<td>".$rs['cant']."</td>
						   </tr>";
				}
			}
			$html.='</table>
      </div>
   </div>
 </div>';

 echo $html;?>
 <form action="caducidadPDF.php" method="POST">
	
	<input id="tProducto" name="tProducto" value="0" hidden>	
	<input id="tMarca" name="tMarca" value="0" hidden>
	<input id="fDesde" name="fDesde" value="0000-00-00" hidden>	
	<input id="fHasta" name="fHasta" value="0000-00-00" hidden>
	<button name="exportPDF" value="export" style="border-color: #e0e0e0;background:white" class="btn btn-outline-warning" id="button-addon2">EXPORTAR PDF</button>
</form>
	<?php	}?>
			
			<div class="container" style="padding-top:40px">
  <nav arial-label="page navigation">
    <ul class="pagination justify-content-center">
      <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>"><a class="page-link" href="reportesCaducidad.php?id=<?php echo $_GET['id']; ?>&fDesde=<?php echo $_GET['fDesde']; ?>&fHasta=<?php echo $_GET['fHasta']; ?>&pagina=<?php echo $_GET['pagina'] - 1 ?>">Anterior</a></li>
      <?php for ($i = 1; $i <= $paginas; $i++) : ?>
        <li class="<?php echo $_GET['pagina'] == $i ? 'active' : '' ?>"><a class="page-link" href="reportesCaducidad.php?id=<?php echo $_GET['id']; ?>&fDesde=<?php echo $_GET['fDesde']; ?>&fHasta=<?php echo $_GET['fHasta']; ?>&pagina=<?php echo $i ?>"><?php echo $i ?></a></li>
      <?php endfor ?>
      <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>"><a class="page-link" href="reportesCaducidad.php?id=<?php echo $_GET['id']; ?>&fDesde=<?php echo $_GET['fDesde']; ?>&fHasta=<?php echo $_GET['fHasta']; ?>&pagina=<?php echo $_GET['pagina'] + 1 ?>">Siguiente</a></li>
    </ul>
  </nav>
</div>
     <?php }
	 if((isset($_GET['id']) && $_GET['id']==0) && (isset($_GET['fDesde']) && $_GET['fDesde']!='0000-00-00') && (isset($_GET['fHasta']) && $_GET['fHasta']!='0000-00-00')){
        $queryStocktp="SELECT p.descripcion as prod,p.fechaCaducidad, p.cantidadProd as cant, p.lote, pf.estante, 
		pf.fila, pf.columna, tp.descripcion as tprod, m.nombreMarca as marca
		from productos as p
		JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico
		JOIN productostpmarcas as pm on pm.idProducto=p.idProducto
		JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca
		JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto
		JOIN marcas as m on tpm.idMarca=m.idMarca
		WHERE p.fechaCaducidad BETWEEN '{$_GET['fDesde']}' AND '{$_GET['fHasta']}'";
		$resultadoM = $conexion->query($queryStocktp);
	    $productos_x_pag = 4;
	
	    $total_productos = mysqli_num_rows($resultadoM);
	    $paginas = $total_productos / $productos_x_pag;
	    $paginas = ceil($paginas);
		if (isset($_GET['pagina'])) {
			$iniciar = ($_GET['pagina'] - 1) * $productos_x_pag;
			$consulta1=mysqli_query($conexion,"SELECT p.descripcion as prod,p.fechaCaducidad, p.cantidadProd as cant, p.lote, pf.estante, 
			pf.fila, pf.columna, tp.descripcion as tprod,m.nombreMarca as marca
			from productos as p
			JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico
			JOIN productostpmarcas as pm on pm.idProducto=p.idProducto
			JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca
			JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto
			JOIN marcas as m on tpm.idMarca=m.idMarca 
			WHERE p.fechaCaducidad BETWEEN '{$_GET['fDesde']}' AND '{$_GET['fHasta']}'
			ORDER BY p.fechaCaducidad ASC limit $iniciar,$productos_x_pag");
			$html= '<div class="row justify-content-center">
			<div class="col-md-12">
			   <div style="background: white">
				  <table class="table striped" style="background:#fafafa;white:70%">
					  <tr>
						 <th>Producto</th>		
						 <th>Tipo Producto</th>
						 <th>Marca</th>
						 <th>Vencimiento</th>
						 <th>lote</th>
						 <th>Puesto</th>
						 <th>Cantidad</th>
					   </tr>';
			while ($rs = mysqli_fetch_array($consulta1)) 
			{
				$fecha=date('d/m/Y',strtotime($rs['fechaCaducidad']));
			
				$fecha_actual=date('Y-m-d');
				$fecha_prox_vencer=date("Y-m-d",strtotime($fecha_actual."+ 10 days"));
				if($rs['fechaCaducidad']<$fecha_actual){
					$html.="<tr style='background:red'>
							<td>".$rs['prod']."</td>
							<td>".$rs['tprod']."</td>
							<td>".$rs['marca']."</td>
							<td>".$fecha."</td>
							<td>".$rs['lote']."</td>
							<td>".$rs['estante']."-".$rs['fila']."-".$rs['columna']."</td>
							<td>".$rs['cant']."</td>
						   </tr>";
				}else if($rs['fechaCaducidad']>$fecha_actual && $rs['fechaCaducidad']<=$fecha_prox_vencer){
					$html.="<tr style='background:yellow'>
							<td>".$rs['prod']."</td>
							<td>".$rs['tprod']."</td>
							<td>".$rs['marca']."</td>
							<td>".$fecha."</td>
							<td>".$rs['lote']."</td>
							<td>".$rs['estante']."-".$rs['fila']."-".$rs['columna']."</td>
							<td>".$rs['cant']."</td>
						   </tr>";	
				}else{
					$html.="<tr>
							<td>".$rs['prod']."</td>
							<td>".$rs['tprod']."</td>
							<td>".$rs['marca']."</td>
							<td>".$fecha."</td>
							<td>".$rs['lote']."</td>
							<td>".$rs['estante']."-".$rs['fila']."-".$rs['columna']."</td>
							<td>".$rs['cant']."</td>
						   </tr>";
				}
			}
			$html.='</table>
      </div>
   </div>
 </div>';

 echo $html;?>
 <form action="caducidadPDF.php" method="POST">
	
	<input id="tProducto" name="tProducto" value="0" hidden>	
	<input id="tMarca" name="tMarca" value="0" hidden>
	<input id="fDesde" name="fDesde" value="<?php echo $_GET['fDesde'];?>" hidden>	
	<input id="fHasta" name="fHasta" value="<?php echo $_GET['fHasta'];?>" hidden>
	
	<button name="exportPDF" value="export" style="border-color: #e0e0e0;background:white" class="btn btn-outline-warning" id="button-addon2">EXPORTAR PDF</button>
</form>
	<?php	}?>
			
			<div class="container" style="padding-top:40px">
  <nav arial-label="page navigation">
    <ul class="pagination justify-content-center">
      <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>"><a class="page-link" href="reportesCaducidad.php?id=<?php echo $_GET['id']; ?>&fDesde=<?php echo $_GET['fDesde']; ?>&fHasta=<?php echo $_GET['fHasta']; ?>&pagina=<?php echo $_GET['pagina'] - 1 ?>">Anterior</a></li>
      <?php for ($i = 1; $i <= $paginas; $i++) : ?>
        <li class="<?php echo $_GET['pagina'] == $i ? 'active' : '' ?>"><a class="page-link" href="reportesCaducidad.php?id=<?php echo $_GET['id']; ?>&fDesde=<?php echo $_GET['fDesde']; ?>&fHasta=<?php echo $_GET['fHasta']; ?>&pagina=<?php echo $i ?>"><?php echo $i ?></a></li>
      <?php endfor ?>
      <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>"><a class="page-link" href="reportesCaducidad.php?id=<?php echo $_GET['id']; ?>&fDesde=<?php echo $_GET['fDesde']; ?>&fHasta=<?php echo $_GET['fHasta']; ?>&pagina=<?php echo $_GET['pagina'] + 1 ?>">Siguiente</a></li>
    </ul>
  </nav>
</div>
     <?php }
	 
     if(isset($_GET['id']) && isset($_GET['idMarca']) && (isset($_GET['fDesde']) && $_GET['fDesde']=='0000-00-00') && (isset($_GET['fHasta']) && $_GET['fHasta']=='0000-00-00')){
        $queryStocktp="SELECT p.descripcion as prod,p.fechaCaducidad, p.cantidadProd as cant, p.lote, pf.estante, 
		pf.fila, pf.columna, tp.descripcion as tprod, m.nombreMarca as marca
		from productos as p
		JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico
		JOIN productostpmarcas as pm on pm.idProducto=p.idProducto
		JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca
		JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto
		JOIN marcas as m on tpm.idMarca=m.idMarca
		WHERE tpm.idMarca={$_GET['idMarca']}";
		$resultadoM = $conexion->query($queryStocktp);
	    $productos_x_pag = 4;
	
	    $total_productos = mysqli_num_rows($resultadoM);
	    $paginas = $total_productos / $productos_x_pag;
	    $paginas = ceil($paginas);
		if (isset($_GET['pagina'])) {
			$iniciar = ($_GET['pagina'] - 1) * $productos_x_pag;
			$consulta1=mysqli_query($conexion,"SELECT p.descripcion as prod,p.fechaCaducidad, p.cantidadProd as cant, p.lote, pf.estante, 
			pf.fila, pf.columna, tp.descripcion as tprod, m.nombreMarca as marca
			from productos as p
			JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico
			JOIN productostpmarcas as pm on pm.idProducto=p.idProducto
			JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca
			JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto
			JOIN marcas as m on tpm.idMarca=m.idMarca
			WHERE tpm.idMarca={$_GET['idMarca']} ORDER BY p.fechaCaducidad ASC limit $iniciar,$productos_x_pag");
			$html= '<div class="row justify-content-center">
			<div class="col-md-12">
			   <div style="background: white">
				  <table class="table striped" style="background:#fafafa;white:70%">
					  <tr>
						 <th>Producto</th>		
						 <th>Tipo Producto</th>
						 <th>Marca</th>
						 <th>Vencimiento</th>
						 <th>lote</th>
						 <th>Puesto</th>
						 <th>Cantidad</th>
					   </tr>';
			while ($rs = mysqli_fetch_array($consulta1)) 
			{
			$fecha=date('d/m/Y',strtotime($rs['fechaCaducidad']));
			
            $fecha_actual=date('Y-m-d');
			$fecha_prox_vencer=date("Y-m-d",strtotime($fecha_actual."+ 10 days"));
			if($rs['fechaCaducidad']<$fecha_actual){
				$html.="<tr style='background:red'>
						<td>".$rs['prod']."</td>
						<td>".$rs['tprod']."</td>
						<td>".$rs['marca']."</td>
						<td>".$fecha."</td>
						<td>".$rs['lote']."</td>
						<td>".$rs['estante']."-".$rs['fila']."-".$rs['columna']."</td>
						<td>".$rs['cant']."</td>
					   </tr>";
			}else if($rs['fechaCaducidad']>$fecha_actual && $rs['fechaCaducidad']<=$fecha_prox_vencer){
			    $html.="<tr style='background:yellow'>
						<td>".$rs['prod']."</td>
						<td>".$rs['tprod']."</td>
						<td>".$rs['marca']."</td>
						<td>".$fecha."</td>
						<td>".$rs['lote']."</td>
						<td>".$rs['estante']."-".$rs['fila']."-".$rs['columna']."</td>
						<td>".$rs['cant']."</td>
					   </tr>";	
			}else{
				$html.="<tr>
						<td>".$rs['prod']."</td>
						<td>".$rs['tprod']."</td>
						<td>".$rs['marca']."</td>
						<td>".$fecha."</td>
						<td>".$rs['lote']."</td>
						<td>".$rs['estante']."-".$rs['fila']."-".$rs['columna']."</td>
						<td>".$rs['cant']."</td>
					   </tr>";
			}
			}
			$html.='</table>
      </div>
   </div>
 </div>';

 echo $html;?>
 <form action="caducidadPDF.php" method="POST">
	
	<input id="tProducto" name="tProducto" value="<?php echo $_GET['id'];?>" hidden>	
	<input id="tMarca" name="tMarca" value="<?php echo $_GET['idMarca'];?>" hidden>
	<input id="fDesde" name="fDesde" value="0000-00-00" hidden>	
	<input id="fHasta" name="fHasta" value="0000-00-00" hidden>
	<button name="exportPDF" value="export" style="border-color: #e0e0e0;background:white" class="btn btn-outline-warning" id="button-addon2">EXPORTAR PDF</button>
</form>
	<?php	}?>
			
			<div class="container" style="padding-top:40px">
  <nav arial-label="page navigation">
    <ul class="pagination justify-content-center">
      <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>"><a class="page-link" href="reportesCaducidad.php?id=<?php echo $_GET['id']; ?>&idMarca=<?php echo $_GET['idMarca'];?>&fDesde=<?php echo $_GET['fDesde']; ?>&fHasta=<?php echo $_GET['fHasta']; ?>&pagina=<?php echo $_GET['pagina'] - 1 ?>">Anterior</a></li>
      <?php for ($i = 1; $i <= $paginas; $i++) : ?>
        <li class="<?php echo $_GET['pagina'] == $i ? 'active' : '' ?>"><a class="page-link" href="reportesCaducidad.php?id=<?php echo $_GET['id']; ?>&idMarca=<?php echo $_GET['idMarca'];?>&fDesde=<?php echo $_GET['fDesde']; ?>&fHasta=<?php echo $_GET['fHasta']; ?>&pagina=<?php echo $i ?>"><?php echo $i ?></a></li>
      <?php endfor ?>
      <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>"><a class="page-link" href="reportesCaducidad.php?id=<?php echo $_GET['id']; ?>&idMarca=<?php echo $_GET['idMarca'];?>&fDesde=<?php echo $_GET['fDesde']; ?>&fHasta=<?php echo $_GET['fHasta']; ?>&pagina=<?php echo $_GET['pagina'] + 1 ?>">Siguiente</a></li>
    </ul>
  </nav>
</div>
     <?php }
	 if((isset($_GET['id']) && $_GET['id']>0)  &&  isset($_GET['idMarca']) && (isset($_GET['fDesde']) && $_GET['fDesde']!='0000-00-00') && (isset($_GET['fHasta']) && $_GET['fHasta']!='0000-00-00')){
        $queryStocktp="SELECT p.descripcion as prod,p.fechaCaducidad, p.cantidadProd as cant, p.lote, pf.estante, 
		pf.fila, pf.columna, tp.descripcion as tprod, m.nombreMarca as marca
		from productos as p
		JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico
		JOIN productostpmarcas as pm on pm.idProducto=p.idProducto
		JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca
		JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto
		JOIN marcas as m on tpm.idMarca=m.idMarca
		WHERE tpm.idTipoProducto={$_GET['id']}
		  AND p.fechaCaducidad BETWEEN '{$_GET['fDesde']}' AND '{$_GET['fHasta']}'";
		$resultadoM = $conexion->query($queryStocktp);
	    $productos_x_pag = 4;
	
	    $total_productos = mysqli_num_rows($resultadoM);
	    $paginas = $total_productos / $productos_x_pag;
	    $paginas = ceil($paginas);
		if (isset($_GET['pagina'])) {
			$iniciar = ($_GET['pagina'] - 1) * $productos_x_pag;
			$consulta1=mysqli_query($conexion,"SELECT p.descripcion as prod,p.fechaCaducidad, p.cantidadProd as cant, p.lote, pf.estante, 
			pf.fila, pf.columna, tp.descripcion as tprod, m.nombreMarca as marca
			from productos as p
			JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico
			JOIN productostpmarcas as pm on pm.idProducto=p.idProducto
			JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca
			JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto
			JOIN marcas as m on tpm.idMarca=m.idMarca
			WHERE tpm.idTipoProducto={$_GET['id']} 
			AND p.fechaCaducidad BETWEEN '{$_GET['fDesde']}' AND '{$_GET['fHasta']}' ORDER BY p.fechaCaducidad ASC limit $iniciar,$productos_x_pag");
			$html= '<div class="row justify-content-center">
			<div class="col-md-12">
			   <div style="background: white">
				  <table class="table striped" style="background:#fafafa;white:70%">
					  <tr>
						 <th>Producto</th>		
						 <th>Tipo Producto</th>
						 <th>Marca</th>
						 <th>Vencimiento</th>
						 <th>lote</th>
						 <th>Puesto</th>
						 <th>Cantidad</th>
					   </tr>';
			while ($rs = mysqli_fetch_array($consulta1)) 
			{
			$fecha=date('d/m/Y',strtotime($rs['fechaCaducidad']));
			
            $fecha_actual=date('Y-m-d');
			$fecha_prox_vencer=date("Y-m-d",strtotime($fecha_actual."+ 10 days"));
			if($rs['fechaCaducidad']<$fecha_actual){
				$html.="<tr style='background:red'>
						<td>".$rs['prod']."</td>
						<td>".$rs['tprod']."</td>
						<td>".$rs['marca']."</td>
						<td>".$fecha."</td>
						<td>".$rs['lote']."</td>
						<td>".$rs['estante']."-".$rs['fila']."-".$rs['columna']."</td>
						<td>".$rs['cant']."</td>
					   </tr>";
			}else if($rs['fechaCaducidad']>$fecha_actual && $rs['fechaCaducidad']<=$fecha_prox_vencer){
			    $html.="<tr style='background:yellow'>
						<td>".$rs['prod']."</td>
						<td>".$rs['tprod']."</td>
						<td>".$rs['marca']."</td>
						<td>".$fecha."</td>
						<td>".$rs['lote']."</td>
						<td>".$rs['estante']."-".$rs['fila']."-".$rs['columna']."</td>
						<td>".$rs['cant']."</td>
					   </tr>";	
			}else{
				$html.="<tr>
						<td>".$rs['prod']."</td>
						<td>".$rs['tprod']."</td>
						<td>".$rs['marca']."</td>
						<td>".$fecha."</td>
						<td>".$rs['lote']."</td>
						<td>".$rs['estante']."-".$rs['fila']."-".$rs['columna']."</td>
						<td>".$rs['cant']."</td>
					   </tr>";
			}
		    }
			$html.='</table>
      </div>
   </div>
 </div>';

 echo $html;?>
 <form action="caducidadPDF.php" method="POST">
	
	<input id="tProducto" name="tProducto" value="<?php echo $_GET['id'];?>" hidden>	
	<input id="tMarca" name="tMarca" value="0" hidden>
	<input id="fDesde" name="fDesde" value="<?php echo $_GET['fDesde'];?>" hidden>	
	<input id="fHasta" name="fHasta" value="<?php echo $_GET['fHasta'];?>" hidden>
	<button name="exportPDF" value="export" style="border-color: #e0e0e0;background:white" class="btn btn-outline-warning" id="button-addon2">EXPORTAR PDF</button>
</form>
	<?php	}?>
			
			<div class="container" style="padding-top:40px">
  <nav arial-label="page navigation">
    <ul class="pagination justify-content-center">
      <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>"><a class="page-link" href="reportesCaducidad.php?id=<?php echo $_GET['id']; ?>&fDesde=<?php echo $_GET['fDesde']; ?>&fHasta=<?php echo $_GET['fHasta']; ?>&pagina=<?php echo $_GET['pagina'] - 1 ?>">Anterior</a></li>
      <?php for ($i = 1; $i <= $paginas; $i++) : ?>
        <li class="<?php echo $_GET['pagina'] == $i ? 'active' : '' ?>"><a class="page-link" href="reportesCaducidad.php?id=<?php echo $_GET['id']; ?>&fDesde=<?php echo $_GET['fDesde']; ?>&fHasta=<?php echo $_GET['fHasta']; ?>&pagina=<?php echo $i ?>"><?php echo $i ?></a></li>
      <?php endfor ?>
      <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>"><a class="page-link" href="reportesCaducidad.php?id=<?php echo $_GET['id']; ?>&fDesde=<?php echo $_GET['fDesde']; ?>&fHasta=<?php echo $_GET['fHasta']; ?>&pagina=<?php echo $_GET['pagina'] + 1 ?>">Siguiente</a></li>
    </ul>
  </nav>
</div>
     <?php }
	 
?>






<?php require 'footer.php'; ?>