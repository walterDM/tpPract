<?php
if(isset($_POST['comprar'])){
    require("conexion.php");
    require("header.php");
    $idPersona=$_SESSION['login'];
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
            if(mysqli_num_rows($select)<1){?>
                   <div class="col-md-12" style="padding-top:120px">
                      <form action="direccionesClientes.php" method="POST">
                         <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Pais</label>
                                <select class="form-control" id="cbxpais" name="cbxpais">
               	                  <option>Seleecione Pais</option>
                                  <?php while ($rsTP = $select3->fetch_assoc()){?>
                                     <option><?php echo $rsTP['nombrePais'];?></option>
                                  <?php } ?>
                                </select>
                              </div>
                              <div class="form-group">
                                <label>Ciudad</label>
                                <select class="form-control" id="cbxciudad" name="cbxciudad">
                                   <option>Seleccione ciudad</option>
                                </select>
                              </div>
                              <div class="row">
                                <div class="form-group col-md-6">
                                  <label>Calle</label>
                                  <input type="text" class="form-control" name="calle" id="calle"  placeholder="ingrese calle">
                                </div>
                                <div class="form-group col-md-6">
                                  <label>Altura</label>
                                  <input type="text" class="form-control" name="altura" id="altura"  placeholder="ingrese altura">
                                  <input type="text" class="form-control" name="idPersona" id="idPersona" value="<?php echo $idPersona;?>" hidden>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                               <div class="form-group">
                                  <label>Provincia</label>
                                  <select class="form-control" id="cbxprovincia" name="cbxprovincia">
                                     <option>seleccione provincia</option>
                                  </select>
                               </div>
                               <div class="form-group">
                                  <label>tipo de domicilio</label>
                                  <select class="form-control" id="tipodomicilio" name="tipodomicilio">
                                    <?php while ($rsTP = $select5->fetch_assoc()){?>
                                       <option value="<?php echo $rsTP['idTipoDomicilio']; ?>"><?php echo $rsTP['descripcion'];?></option>
                                    <?php } ?>
                                  </select>
                               </div>
                               <div class="row">
                                  <div class="form-group col-md-6">
                                     <label>Depto</label>
                                     <input type="text" class="form-control" name="dpto" id="dpto"  placeholder="ingrese departamento">
                                  </div>
                                  <div class="form-group col-md-6">
                                     <label>Piso</label>
                                     <input type="text" class="form-control" name="piso" id="piso"  placeholder="ingrese piso">
                                  </div>
                               </div>
                            </div>
                            <div class="col-md-12" align="center">
                            <button style="width: 50%;" name="direcciones" value="direcciones" id="btn2" class="btn btn-light">agregar direccion</button>
                            </div>
                         </div> 
                      </form>
                   </div>
          <?php }else{ 
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
                                 ?>
                                 <div align="center">
                                     <a href="#" class="btn btn-light">Aceptar</a>
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
          <?php }?> 
       </div>
   </div>
<?php
}
?>