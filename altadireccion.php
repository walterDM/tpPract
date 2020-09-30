<?php 
   require("header.php");
   require("conexion.php");
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
<div class="container" style="padding-top:30px">
    <div class="row" style="background:#ffb74d;color:white;border-radius:50px;padding:50px">
         <div class="col-md-12" style="padding-top:60px">
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
                   <div class="col-md-12" align="center">
                      <form method="POST" action="domicilioCompra.php">
                         <button style="width: 50%;" class="btn btn-light" name="comprar" value="comprar">Volver</button>
                      </form>
                   </div>
  </div>
</div>
<?php 
if(isset($_GET['agregado']) && $_GET['agregado']==1){
    echo "<script>alert('direccion agregada');</script>";
}

require("footer.php");
?>