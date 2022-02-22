<?php 
      require("header.php");
      require("conexion.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Carrito de compras</title>

  </head>
  <body>
      <div class="row">
        
         <?php
        
    	     $total=0;
    	     if(isset($_SESSION['carrito'])){
                  $datos=$_SESSION['carrito'];
                  $total=0; 
          ?>
                 <div class="col-md-12" style="padding-top:90px">
                 <div id="result" style="border: 1px solid white;overflow-y: scroll;background:#fafafa;">
                    <table class="table striped" style="background:#fafafa;height:300px">
                       <thead>
                            <th>Descricion</th>
                            <th>Precio original</th>
                            <th>Descripcion descuento</th>
                            <th>Precio descuento</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th></th>
                       </thead>
                       <tbody class="carrito">
                        <?php for ($i=0; $i<count($datos);$i++) {
                                 $consulta=mysqli_query($conexion,"SELECT * FROM ofertas WHERE idProducto={$datos[$i]['IdProducto']}");?>
                        <tr>
                 	    	<td style="padding-top:30px"><?php echo $datos[$i]['Descripcion'];?></span>
                 	    	<td style="padding-top:30px"><?php echo "$".number_format((float)$datos[$i]['Precio'], 2, '.', '');?></span>
                           <td style="padding-top:30px">
                              <?php 
                                   $select=mysqli_query($conexion,"SELECT * FROM ofertas WHERE idProducto={$datos[$i]['IdProducto']}");
                                   $select2=mysqli_query($conexion,"SELECT * FROM productos WHERE idProducto={$datos[$i]['IdProducto']}");
                                   while($f = mysqli_fetch_array($select2)){$cantStock=$f['cantidadProd'];}
                                   if(mysqli_num_rows($select)>0){
                                       while($r = mysqli_fetch_array($select)){
                                          $descuento=$r['descuento'];
                                          $cantidadDes=$r['cantidad'];
                                    
                                       }
                                       echo $descuento.'% de descuento llevando '.$cantidadDes.' unidades';
                                   }else{
                                    echo 'No posee descuento';
                                   }
                              ?>
                           </td>
                           <td style="padding-top:30px">
                                 <?php
                                    $select2=mysqli_query($conexion,"SELECT * FROM ofertas WHERE idProducto={$datos[$i]['IdProducto']}");
                                    if(mysqli_num_rows($select2)>0){
                                        while($r = mysqli_fetch_array($select)){
                                          $descuento=$r['descuento'];
                                          $cantidadDes=$r['cantidad'];
                                    
                                        }
                                        $calculo=($datos[$i]['Precio']*$descuento)/100;
                                        $restoTotal=($datos[$i]['Precio'] - $calculo)*$cantidadDes;
                                        $restoTotal=number_format((float)$restoTotal, 2, '.', '');
                                        echo $cantidadDes.' X $'.$restoTotal;
                                    }
                                    else{
                                       echo 'No posee descuento';
                                    }
                                 ?>
                           </td>
                 	    	<td style="padding-top:30px">
                           <input id="cant" type="number" MIN="1" MAX="<?php echo $cantStock;?>" data-cantidad="<?php echo $cantStock;?>" value="<?php echo $datos[$i]['Cantidad']; ?>"
                           data-precio="<?php echo $datos[$i]['Precio'];?>"
                           data-id="<?php echo $datos[$i]['IdProducto'];?>"
                           data-subtotal="<?php 
                                            $select3=mysqli_query($conexion,"SELECT * FROM ofertas WHERE idProducto={$datos[$i]['IdProducto']}");
                                            $subtotal=0;
                                            $subtotal2=0;
                                            $subtotales=0;
                                            $totalCant=0;
                                            $cantRest=0;
                                            if(mysqli_num_rows($select3)>0){  
                                             while($rs = mysqli_fetch_array($select3)){
                                                
                                                $calculo=($datos[$i]['Precio']*$rs['descuento'])/100;
                                                $restoTotal=$datos[$i]['Precio'] - $calculo;
                                                
                                                   for ($j=1; $j<=$datos[$i]['Cantidad'];$j++) {
                                                      if ($j % $rs['cantidad']==0){ 
                                                          for($k=1;$k<=100;$k++){
                                                            if($rs['cantidad']*$k<=$datos[$i]['Cantidad']){
                                                               $cantRest=$rs['cantidad']*$k;
                                                               $subtotal=$restoTotal*$cantRest;
                                                            }
                                                      }  }
                                                   }
                                                
                                                if ($datos[$i]['Cantidad'] % $rs['cantidad']!=0){
                                                   $totalCant=$datos[$i]['Cantidad'] - $cantRest;
                                   
                                       
                                                       $subtotal2=($totalCant*$datos[$i]['Precio']);
                                                  
                                                }
                                                $subtotales = $subtotal+$subtotal2;
                                                $subtotales=number_format((float)$subtotales, 2, '.', '');
                                                echo $subtotales;
                                             }
                                            }else{
                                             $subtotales=$datos[$i]['Cantidad']*$datos[$i]['Precio'];
                                             $subtotales=number_format((float)$subtotales, 2, '.', '');
                                             echo $subtotales;
                                            } 
                           
                                          ?>"
                           class="cantidad">
                     
                        </td>
                 	    	   <td style="padding-top:30px" class="subtotal">
                              <?php 
                                $subtotal=0;
                                $subtotal2=0;
                                $subtotales=0;
                                $totalCant=0;
                                $cantRest=0;
                                if(mysqli_num_rows($consulta)>0){  
                                 while($rs = mysqli_fetch_array($consulta)){
                                    
                                    $calculo=($datos[$i]['Precio']*$rs['descuento'])/100;
                                    $restoTotal=$datos[$i]['Precio'] - $calculo;
                                    
                                       for ($j=1; $j<=$datos[$i]['Cantidad'];$j++) {
                                          if ($j % $rs['cantidad']==0){ 
                                              for($k=1;$k<=100;$k++){
                                                if($rs['cantidad']*$k<=$datos[$i]['Cantidad']){
                                                   $cantRest=$rs['cantidad']*$k;
                                                   $subtotal=$restoTotal*$cantRest;
                                                }
                                          }  }
                                       }
                                    
                                    if ($datos[$i]['Cantidad'] % $rs['cantidad']!=0){
                                       $totalCant=$datos[$i]['Cantidad'] - $cantRest;
                       
                           
                                           $subtotal2=($totalCant*$datos[$i]['Precio']);
                                      
                                    }
                                    $subtotales = $subtotal+$subtotal2;
                                    $subtotales=number_format((float)$subtotales, 2, '.', '');
                                    echo "$".$subtotales;
                                 }
                                }else{
                                 $subtotales=$datos[$i]['Cantidad']*$datos[$i]['Precio'];
                                 $subtotales=number_format((float)$subtotales, 2, '.', '');
                                 echo "$".$subtotales;
                                }
                              ?>
                           </td>
                           
                           <td><a href="#" style="border-radius:30px;font-size:20px" class="btn btn-light eliminar" data-id="<?php echo $datos[$i]['IdProducto'];?>"><i class="fas fa-trash-alt"></i></a></td>
                           <?php    	
                  $total=$subtotales+$total;
                  $_SESSION['total']=$total;
                  }?>
                  </tr>
                  </tbody>
                  </table>
                    </div>
                 </div>
    	    <?php }else{
    	     	echo '<div class="col-md-12"><h2 align="center">el carrito de compras esta vacio</h2></div>';
           }

    	    ?>
       
      </div>
      <br><br><br><br><br><br><br>
      <hr>
      <h3 align="center" style="color: green" id="total">total: $<?php echo $total;?></h3>
      <div align="center">
       <?php if($total!=0){?>
                  <form action="domicilioCompra.php" method="POST">
                
                     <button class="btn btn-light" name="comprar" value="comprar"> Comprar</button>
                  </form>
       <?php }?>
      </div>
      <?php
         require("footer.php");
      ?>
      <script>
         $(document).on("keypress", ".cantidad", function(e) {
             if (e.which == 13) {
              var inputVal = $(this).val();
              // alert("entered: " + inputVal);
              var id=$(this).attr('data-id');
              var precio=$(this).attr('data-precio');
              var cantstock=$(this).attr('data-cantidad');
              var subtotal=$(this).attr('data-subtotal');
              var cantidad=$(this).val();
              
              $(this).parentsUntil('.carrito').find('.subtotal').text("$"+subtotal);
              $.post('modificarCarrito.php',{
                  IdProducto:id,
                  Precio:precio,
                  Cantidad:cantidad
              },function(e){
                  $('#total').text('Total: '+e);
                  window.location.href="carrito.php";
              });
              
            }
         });
         $('.eliminar').click(function(e){
             e.preventDefault();
             var eliminar = confirm('De verdad desea eliminar este producto del carrito?');
             var id=$(this).attr('data-id');
             if(eliminar){
                  $(this).parentsUntil('.carrito').remove();
                  $.post('eliminarCarrito.php',{
                        IdProducto:id
                  },function(a){
                     if(a=='0'){
                        location.href="carrito.php";
                     }
                  });
               }
         });
      </script>
  </body>
</html>