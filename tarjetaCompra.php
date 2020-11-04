<?php

    require("conexion.php");
    require("header.php");
    $idPersona=$_SESSION['login'];
    //  $select=mysqli_query($conexion,"SELECT idTipoTarjeta FROM tipostarjetas WHERE idPersona=$idPersona");
  
    // $select5=mysqli_query($conexion,"SELECT idTipoTarjeta,descripcion FROM tipostarjetas ORDER BY descripcion ASC"); 
 
   
?>
<style>
     td {border: 4px #ffb74d solid; padding: 5px;}
     th {border: 4px #ffb74d solid; padding: 5px;}

</style>
<div class="container">
       <div class="row">
          <?php 
         
         
                   $consulta=mysqli_query($conexion,"SELECT * FROM tarjetasCliente WHERE idPersona=$idPersona");
          ?>
                   
                   <div class="col-md-12" style="padding-top:60px">
                      <h3 align="center">Seleccionar tarjeta:</h3>
                   </div>
                      <table class="table striped">
                      <thead>
                        <th>Numero de tarjeta</th>
                        <th>Tipo de tarjeta</th>
                        <th>Fecha de vencimiento</th>
                        <th>Codigo</th>
                    
                        <th></th>
                      </thead>
                      <tbody class="l1s">
                      <?php while($r=mysqli_fetch_array($consulta)){
                         $consulta2=mysqli_query($conexion,"SELECT  *FROM tarjetasCliente WHERE idTarjetaCliente='{$r['idTarjetaCliente']}'");

                          $consul=mysqli_query($conexion,"SELECT  descripcion FROM tipostarjetas WHERE idTipoTarjeta='{$r['idTipoTarjeta']}'");
                      ?>
                        <tr>
                           <td><?php while($rs=mysqli_fetch_array($consulta2)){ echo $rs['numTarjeta']; } ?></td>
                            <td><?php while($rs=mysqli_fetch_array($consul)){ echo $rs['descripcion']; } ?></td>
                    
                           <td><?php echo $r['fechaVencimiento'];?></td>
                           <td><?php echo $r['codBanco'];?></td>
                      
                           <td><a class="btn btn-light" href="#" data-toggle="modal" data-target="#seleccionar<?php echo $r['idTarjetaCliente'];?>">Seleccionar</a></td>
                        </tr>
                        <div data-backdrop="static" class="modal" id="seleccionar<?php echo $r['idTarjetaCliente']; ?>">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header" style="background:#ffb74d;color:white">
                              <h4 class="modal-title">Tarjeta seleccionada</h4>
                              <button type="button" class="close" data-dismiss="modal">X</button>
                            </div>
                            <div class="modal-body" style="background:#ffb74d;color:white">
                                 <?php $sql=mysqli_query($conexion,"SELECT * FROM tarjetasCliente WHERE idTarjetaCliente={$r['idTarjetaCliente']}");
                                       $datos=mysqli_fetch_assoc($sql);
                                       echo "<h4>Realizar pago</h4><br>";
                                      
                                 ?>
                                 <div align="center">
                                     <a href="tarjetaCompra.php" class="btn btn-light" >Aceptar</a>
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
                       <a href="tarjetaCliente.php" class="btn btn-light">Agregar otra Tarjeta</a>
                   </div>
       
       </div>
   </div>
          