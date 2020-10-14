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
                   <div class="col-md-12" style="background:#ffb74d;color:white;border-radius:50px;padding:50px">
                   <div class="row">
                      <div class="col-md-2">
                         <h4>Ciudad</h4>
                      </div>
                      <div class="col-md-2">
                         <h4>Calle</h4>
                      </div>
                      <div class="col-md-2">
                         <h4>Altura</h4>
                      </div>
                      <div class="col-md-2">
                         <h4>Piso</h4>
                      </div>
                      <div class="col-md-2">
                         <h4>Depto</h4>
                      </div>
                   </div>
                   <br>
                   <form id="formulario">
                   <?php while($r=mysqli_fetch_array($consulta)){
                         $consulta2=mysqli_query($conexion,"SELECT nombreCiudad FROM ciudades WHERE idCiudad='{$r['idCiudad']}'");
                   ?>
                      <div class="row">
                          <div class="col-md-2">
                           <?php while($rs=mysqli_fetch_array($consulta2)){?><h4><?php echo $rs['nombreCiudad'];?></h4><?php } ?>
                          </div>
                          <div class="col-md-2">
                             <h4><?php echo $r['calle'];?></h4>
                          </div>
                          <div class="col-md-2">
                             <h4> <?php echo $r['altura'];?></h4>
                          </div>
                          <div class="col-md-2">
                             <h4><?php echo $r['piso'];?></h4>
                          </div>
                          <div class="col-md-2">
                             <h4><?php echo $r['dpto'];?></h4>
                          </div>
                          <div class="col-md-2">
                             <h4>
                                <form method="POST" action="ModDomicilioCompra.php">
                                    <input type="text" name="idDireccion" id="idDireccion" value="<?php echo $r['idDireccion']?>" hidden>
                                    <button name="cambiar" value="cambiar" class="btn btn-light">Actualizar</button>
                                </form>
                              </h4>
                          </div>
                      </div>
                     <?php } ?>
                      <div class="row" style="padding-top:40px" align="center">
                         <div class="col-md-12">
                             <a style="width:20%" href="altadireccion.php" class="btn btn-light">Agregar otra dirección</a>
<<<<<<< HEAD
                             <button style="width:20%" type="submit" id="boton" class="btn btn-light">Continuar</button>
=======

                              <a style="width:20%" href="TarjetaCliente.php" class="btn btn-light">Continuar</a>



                            <!--  <input style="width:20%" type="button" id="boton" value="Enviar" class="btn btn-light"> -->
>>>>>>> 370091ef50e2e91ecee6085b37303288aeca0f18
                         </div>

                      </div>
                      </form>
                   </div>
                   <!--<script type="text/javascript">
	                     $(document).ready(function(){
		                     $("#boton").click(function () {	 
			                     if( $("#formulario input[name='inlineRadioOptions']:radio").is(':checked')) {  
				                     alert("Bien!!!, la edad seleccionada es: " + $('input:radio[name=inlineRadioOptions]:checked').val());
				                      $("#formulario").submit();  
				                  } else{  
					                  alert("Selecciona la edad por favor!!!");  
					               }  
		                     });
	                     });
                   </script>-->
                  
          <?php }?> 
       </div>
   </div>
<?php
}
?>