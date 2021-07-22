<?php
	
	require ('../conexion.php');
	
	$id_estado = $_POST['id_estado'];
	
	$queryStocktp="SELECT p.descripcion as prod, p.cantidadProd as cant, p.lote, pf.estante, 
	pf.fila, pf.columna, tp.descripcion as tprod, m.nombreMarca as marca
	from productos as p
	JOIN puestofisico as pf on p.idPuestoFisico=pf.idPuestoFisico
	JOIN productostpmarcas as pm on pm.idProducto=p.idProducto
	JOIN tiposproductos_marcas as tpm on pm.idTpMarca=tpm.idTpMarca
	JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto
	JOIN marcas as m on tpm.idMarca=m.idMarca
	WHERE tpm.idTipoProducto=$id_estado";
	$resultadoM = $conexion->query($queryStocktp);
  
	
	$html= '<div class="row justify-content-center">
	           <div class="col-md-12">
		          <div style="background: white">
		             <table class="table striped" style="background:#fafafa;white:70%">
			             <tr>
                            <th>Producto</th>		
                            <th>Tipo Producto</th>
                            <th>Marca</th>
                            <th>lote</th>
                            <th>Puesto</th>
                            <th>Cantidad</th>
			              </tr>';
	
    while ($rs=mysqli_fetch_array($resultadoM))
    {
        $html.="<tr>
                <td>".$rs['prod']."</td>
                <td>".$rs['tprod']."</td>
                <td>".$rs['marca']."</td>
                <td>".$rs['lote']."</td>
                <td>".$rs['estante']."-".$rs['fila']."-".$rs['columna']."</td>
                <td>".$rs['cant']."</td>
               </tr>";
    }
    
    $html.='</table>
      </div>
   </div>
 </div>';

 echo $html;

