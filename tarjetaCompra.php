<?php
if(isset($_POST['tarjetas'])){
    require("conexion.php");
    require("header.php");
    $idPersona=$_SESSION['login'];
    $total=$_SESSION['total'];
    $calle=$_SESSION['calle'];
    $altura=$_SESSION['altura'];
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
                         $consulta2=mysqli_query($conexion,"SELECT  * FROM tarjetasCliente WHERE idTarjetaCliente='{$r['idTarjetaCliente']}'");

                          $consul=mysqli_query($conexion,"SELECT  descripcion FROM tipostarjetas WHERE idTipoTarjeta='{$r['idTipoTarjeta']}'");
                          $fechaVenc= date("d-m-Y", strtotime($r['fechaVencimiento']));
                          
                      ?>
                        <tr>
                           <td><?php 
                           $numTarjetaFin="************";
                           while($rs=mysqli_fetch_array($consulta2)){ 
                             $numTarjeta=$rs['numTarjeta'];
                            }
                            $numTarjeta= strval($numTarjeta);
                            $numTarjetaFin= $numTarjetaFin . substr($numTarjeta, -4, 4);
                   
                             echo $numTarjetaFin;  ?></td>
                            <td><?php while($rs=mysqli_fetch_array($consul)){
                               echo $rs['descripcion']; 
                               } ?></td>

                           <td><?php echo $fechaVenc;?></td>
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
                                     <form action="altaFactura.php" method="POST">
                                         <button class="btn btn-light" >Aceptar</button>
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
                       <a href="tarjetaCliente.php" class="btn btn-light">Agregar otra Tarjeta</a>
                   </div>
       
       </div>
   </div>
  <?php
  }else{
     header("location:index.php");
  }


      
  ?>        