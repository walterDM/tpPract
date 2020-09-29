<?php
if(isset($_POST['comprar']) && !empty($_POST['comprar'])){
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
   <div class="container">
       <div class="row">
          <?php if(mysqli_num_rows($select)<1){?>
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
                   $datos=mysqli_fetch_assoc($consulta);
                   $consulta2=mysqli_query($conexion,"SELECT nombreCiudad FROM ciudades WHERE idCiudad='{$datos['idCiudad']}'");
                   $ciudad=mysqli_fetch_assoc($consulta2);?>
                   <div class="col-md-12" style="padding-top:60px">
                      <h3 align="center">Enviar pedido a la siguiente dirección:</h3>
                   </div>
                   <div class="col-md-12" style="background:#ffb74d;color:white;border-radius:50px;padding:50px">
                      <div class="row">
                          <div class="col-md-2">
                             <h4><?php echo "Ciudad <br><br>".$ciudad['nombreCiudad'];?></h4>
                          </div>
                          <div class="col-md-2">
                             <h4><?php echo "Calle <br><br>".$datos['calle'];?></h4>
                          </div>
                          <div class="col-md-2">
                             <h4> <?php echo "Altura <br><br>".$datos['altura'];?></h4>
                          </div>
                          <div class="col-md-2">
                             <h4><?php echo "Piso <br><br>".$datos['piso'];?></h4>
                          </div>
                          <div class="col-md-2">
                             <h4><?php echo "Depto <br><br>".$datos['dpto'];?></h4>
                          </div>
                      </div>
                      <div class="row" style="padding-top:40px">
                         <div class="col-md-12">
                             <h4>
                             <div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
  <label class="form-check-label" for="inlineRadio1">Usar esta dirección</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
  <label class="form-check-label" for="inlineRadio2">Otra</label>
</div>
                             </h4>
                         </div>
                      </div>
                   </div>
          <?php }?> 
       </div>
   </div>
<?php
}else{
    header("location:index.php");
}
?>