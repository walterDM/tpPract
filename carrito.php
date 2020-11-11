<?php 
      require("header.php");
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
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th></th>
                       </thead>
                       <tbody class="carrito">
                        <?php for ($i=0; $i<count($datos);$i++) {?>
                        <tr>
                 	    	<td style="padding-top:30px"><?php echo $datos[$i]['Descripcion'];?></span>
                 	    	<td style="padding-top:30px"><?php echo "$".$datos[$i]['Precio'];?></span>
                 	    	<td style="padding-top:30px">
                           <input id="cant" type="number" MIN="1" MAX="<?php echo $datos[$i]['CantidadProd'];?>" data-cantidad="<?php echo $datos[$i]['CantidadProd'];?>" value="<?php echo $datos[$i]['Cantidad']; ?>"
                           data-precio="<?php echo $datos[$i]['Precio'];?>"
                           data-id="<?php echo $datos[$i]['IdProducto'];?>"
                           class="cantidad">
                     
                        </td>
                 	    	   <td style="padding-top:30px" class="subtotal"><?php echo "$".$datos[$i]['Precio']*$datos[$i]['Cantidad'];?></td>
                           <td><a href="#" style="border-radius:30px;font-size:20px" class="btn btn-light eliminar" data-id="<?php echo $datos[$i]['IdProducto'];?>"><i class="fas fa-trash-alt"></i></a></td>
                           <?php    	
                  $total=($datos[$i]['Cantidad']*$datos[$i]['Precio'])+$total;
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
              var cantidad=$(this).val();
              if(cantidad<1){
                  alert("cantidad no disponible");
              }
              if(cantidad>cantstock){
                 alert("cantidad no disponible");
              }else{
              $(this).parentsUntil('.carrito').find('.subtotal').text('$'+(precio*cantidad));
              $.post('modificarCarrito.php',{
                  IdProducto:id,
                  Precio:precio,
                  Cantidad:cantidad
              },function(e){
                  $('#total').text('Total: '+e);
              });
              }
            }
         });
         $('.eliminar').click(function(e){
             e.preventDefault();
             var id=$(this).attr('data-id');
             $(this).parentsUntil('.carrito').remove();
             $.post('eliminarCarrito.php',{
                  IdProducto:id
              },function(a){
                 if(a=='0'){
                    location.href="carrito.php";
                 }
              });
         });
      </script>
  </body>
</html>