<?php
     echo $_POST['idDireccion'];
?>
<?php 
   require("header.php");
   require("conexion.php");
   $idPersona=$_SESSION['login'];
   $idDireccion=$_POST['idDireccion'];
  
   $consultaDir="SELECT d.idDireccion, d.calle, d.altura, d.piso, d.dpto, p.nombrePais pais, pr.nombreProvincia prov, c.nombreCiudad ciudad, td.descripcion tdd FROM direcciones d
                JOIN tiposdomicilios td ON d.idTipoDomicilio=td.idTipoDomicilio 
                JOIN ciudades c on d.idCiudad=c.idCiudad 
                JOIN provincias pr on pr.idProvincia=c.idProvincia 
                JOIN paises p on p.idPais=pr.idPais 
                where d.idPersona= $idPersona and d.idDireccion=$idDireccion ";
     $selectDir1=mysqli_query($conexion,$consultaDir);
?>

<div class="row justify-content-center">
     <div class="col-md-2">
          <h3><u>Dirección Anterior</u></h3>
     </div>
</div>
<div class="row justify-content-center">
			<div class="col-md-10">
			   <div style="background: white">
				  <table class="table striped" style="background:#fafafa;white:70%">
					<tr>
						 <th>Tipo Domicilio</th>
						 <th>calle y altura</th>
						 <th>piso</th>
						 <th>departamento</th>
						 <th>País</th>
						 <th>Provincia</th>
                         <th>Ciudad</th>
                         
					</tr>
                    <?php while ($rs=mysqli_fetch_array($selectDir1)) {?>
                    
                        <tr>
                            <td><?php echo $rs['tdd']?></td>
                            <td><?php echo $rs['calle']."  ".$rs['altura']?></td>
                            <td><?php echo $rs['piso']?></td>
                            <td><?php echo $rs['dpto']?></td>
                            <td><?php echo $rs['pais']?></td>
                            <td><?php echo $rs['prov']?></td>
                            <td><?php echo $rs['ciudad']?></td>
                        </tr>

                        <?php }?>
                  </table>  
                </div>  
            </div>
     </div>
     <br>
     <?php
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
<div class="row justify-content-center">
     <div class="col-md-2     ">
          <h3><u>Nueva Dirección</u></h3>
     </div>
</div>

<div class="container" style="padding-top:30px">
    <div class="row" style="background:#ffb74d;color:white;border-radius:50px;padding:50px">  
         <div class="col-md-12" style="padding-top:60px">
                      <form action="updateDireccion.php" method="POST">
                           <input type="text" name="direccion" id="direccion" value="<?php echo $idDireccion ?>" hidden>
                           <input type="text" name="idpersona" id="idpersona" value="<?php echo $idPersona ?>" hidden>
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
                              <button style="width: 50%;" name="direcciones" value="direcciones" id="btn2" class="btn btn-light">Guardar Modificación</button>
                            </div>
                         </div> 
                      </form>
                   </div>
                   <div class="col-md-12" align="center">
                      <form method="POST" action="perfilUsuario.php">
                         <button style="width: 50%;" class="btn btn-light" name="comprar" value="comprar">Volver</button>
                      </form>
                   </div>
  </div>
</div>
<?php 
if(isset($_GET['modificado']) && $_GET['modificado']==1){
     echo "<script>alert('direccion modificada');</script>";
 }

require("footer.php");
?>