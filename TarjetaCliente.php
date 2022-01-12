<?php 
   require("header.php");
   require("conexion.php");
   $idPersona=$_SESSION['login'];
   //$select=mysqli_query($conexion,"SELECT idTipoTarjeta,descripcion FROM tipostarjetas WHERE idPersona=$idPersona");
   $select5=mysqli_query($conexion,"SELECT idTipoTarjeta,descripcion FROM tipostarjetas ORDER BY descripcion ASC");
  

?>

<div class="container" style="padding-top:30px">
    <div class="row" style="background:#ffb74d;color:white;border-radius:50px;padding:50px">
         <div class="col-md-12" style="padding-top:60px">
                      <form action="altaTarjetaCliente.php" method="POST">
                         <div class="row">
                            <div class="col-md-12">
                            <div class="form-group">
                                  <label>Tipo de tarjeta</label>
                                  <select class="form-control" id="tipotarjetas" name="tipotarjetas">
                                    <?php while ($rsTP = $select5->fetch_assoc()){?>
                                       <option value="<?php echo $rsTP['idTipoTarjeta']; ?>"><?php echo $rsTP['descripcion'];?></option>
                                    <?php } ?>
                                  </select>
                               </div>
                            
                              <div class="row">
                                <div class="form-group col-md-12">
                                  <label>Numero Tarjeta</label>
                                  <input type="number" class="form-control" name="numTarjeta" id="numTarjeta"  placeholder="ingrese el numero Tarjeta" min=16>
                                </div>
                                <div class="form-group col-md-12">
                                  <label>Fecha vencimiento</label>
                                  <input type="date" class="form-control" name="fechaVencimiento" id="fechaVencimiento"  placeholder="ingrese fecha vencimiento">

                                  <input type="text" class="form-control" name="idPersona" id="idPersona" value="<?php echo $idPersona;?>" hidden>
                                </div>
                            
                              </div>
                            
                               <div class="row">
                                  <div class="form-group col-md-12">
                                     <label>Codigo de seguridad</label>
                                     <input type="number" class="form-control" name="codBanco" id="codBanco"  placeholder="ingrese el codigo" min=3 >
                                  </div>
                                
                               </div>
                            </div>
                            <div class="col-md-12" align="center">
                              <button style="width: 50%;" id="btn2" name="tarjetascliente" value="tarjetascliente" class="btn btn-light">Agregar tarjeta </button>
                            </div>
                         </div> 
                      </form>
                   </div>

                   <div class="col-md-12" align="center">
                      <form method="POST" action="tarjetaCompra.php">
                         <button style="width: 50%;" class="btn btn-light" name="tarjetas" value="tarjetas">Volver</button>
                      </form>
                   </div>
                 </div>
               </div>


  </div>
</div>
<?php 
if(isset($_GET['agregado']) && $_GET['agregado']==1){
    echo "<script>alert('Tarjeta agregada');</script>";
}

require("footer.php");
?>