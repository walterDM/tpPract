<?php
if(isset($_POST['comprar'])){
    require("conexion.php");
    require("header.php");
    $idPersona=$_SESSION['login'];
    $total=$_SESSION['total'];
    $select=mysqli_query($conexion,"SELECT idTipoDomicilio FROM direcciones WHERE idPersona=$idPersona");
    $select3=mysqli_query($conexion,"SELECT idPais,nombrePais FROM paises ORDER BY nombrePais ASC");
    $select4=mysqli_query($conexion,"SELECT idProvincia,nombreProvincia FROM provincias ORDER BY nombreProvincia ASC");
    $select5=mysqli_query($conexion,"SELECT idTipoDomicilio,descripcion FROM tiposdomicilios ORDER BY descripcion ASC");  
?>
<script language="javascript">
 	$(document).ready(function(){
 		$("#cbxpais").change(function () {	
 			$("#cbxpais option:selected").each(function () {
 				id_estado = $(this).val();
 				$.post("includes/getProvincia.php", { id_estado: id_estado }, function(data){
 					$("#cbxprovincia").html(data);
 				});            
 			});
 		});
     $("#cbxprovincia").change(function () {	
 			$("#cbxprovincia option:selected").each(function () {
 				id_ciudad = $(this).val();
 				$.post("includes/getCiudad.php", { id_ciudad: id_ciudad }, function(data){
 					$("#cbxciudad").html(data);
 				});            
 			});
 		});
 	});
 	
	
	
 </script>
 <style>
     td {border: 4px #ffb74d solid; padding: 5px;}
     th {border: 4px #ffb74d solid; padding: 5px;}

  </style>
   <div class="container">
       <div class="row">
          <?php 
             
                   $consulta=mysqli_query($conexion,"SELECT * FROM direcciones WHERE idPersona=$idPersona");
          ?>
                   
                   <div class="col-md-12" style="padding-top:60px">
                      <h3 align="center">Enviar pedido a la siguiente dirección:</h3>
                   </div>
                      <table class="table striped">
                      <thead>
                        <th>Ciudad</th>
                        <th>Calle</th>
                        <th>Altura</th>
                        <th>Piso</th>
                        <th>Depto</th>
                        <th></th>
                      </thead>
                      <tbody class="l1s">
                      <?php while($r=mysqli_fetch_array($consulta)){
                         $consulta2=mysqli_query($conexion,"SELECT nombreCiudad FROM ciudades WHERE idCiudad='{$r['idCiudad']}'");
                      ?>
                        <tr>
                           <td><?php while($rs=mysqli_fetch_array($consulta2)){ echo $rs['nombreCiudad']; } ?></td>
                           <td><?php echo $r['calle'];?></td>
                           <td><?php echo $r['altura'];?></td>
                           <td><?php echo $r['piso'];?></td>
                           <td><?php echo $r['dpto'];?></td>
                           <td><a class="btn btn-light" href="#" data-toggle="modal" data-target="#seleccionar<?php echo $r['idDireccion'];?>">Seleccionar</a></td>
                        </tr>
                        <div data-backdrop="static" class="modal" id="seleccionar<?php echo $r['idDireccion']; ?>">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header" style="background:#ffb74d;color:white">
                              <h4 class="modal-title">Direccion seleccionada</h4>
                              <button type="button" class="close" data-dismiss="modal">X</button>
                            </div>
                            <div class="modal-body" style="background:#ffb74d;color:white">
                                 <?php $sql=mysqli_query($conexion,"SELECT * FROM direcciones WHERE idDireccion={$r['idDireccion']}");
                                       $datos=mysqli_fetch_assoc($sql);
                                       echo "<h4>¿Estás seguro que deseas recibir el pedido en la siguiente direccion?</h4><br>";
                                       echo "<h4 align='center'>".$datos['calle']."  ".$datos['altura']."</h4>";
                                       $_SESSION['calle']=$datos['calle'];
                                       $_SESSION['altura']=$datos['altura'];
                                 ?>
                                 <div align="center">
                                     <form action="tarjetaCompra.php" method="POST">
                                         <button class="btn btn-light" name="tarjetas" value="tarjetas">Aceptar</button>
                                     </form>
                                     <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                                 </div>
                            </div>
                        </div>
                      </div>
                    </div>
                      <?php }?>
                     </tbody>
                  </table>
                  <div class="col-md-12" align="center">
                       <a href="altadireccion.php" class="btn btn-light">Agregar otra direccion</a>
                   </div>
      
       </div>
   </div>
<?php
}else{
   header("location:index.php");
}
?>