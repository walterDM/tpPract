<?php
   require("header.php");
   require("conexion.php");
   if(isset($_SESSION['carrito'])){

   	   if(isset($_GET['idProducto'])){
   	    $arreglo=$_SESSION['carrito'];
   	    $encontro=false;
   	    $numero=0;
   	    for ($i=0; $i<count($arreglo) ; $i++) { 
   	    	if ($arreglo[$i]['IdProducto']==$_GET['idProducto']) {
   	    		$encontro=true;
   	    		$numero=$i;
   	    	}
   	    }
   	    if ($encontro==true) {
   	    	$arreglo[$numero]['Cantidad']=$arreglo[$numero]['Cantidad']+1;
   	    	$_SESSION['carrito']=$arreglo;
   	    }else{
   	    	$nombre="";
            $precio=0;
            $img="";
        	$registro=mysqli_query($conexion,"select * from productos where idProducto=".$_GET['idProducto'])or die("Problemas en el select:".mysqli_error($conexion));;
        	while ($r=mysqli_fetch_array($registro)) {
        		$nombre=$r['descripcion'];
        		$precio=$r['precio'];
        		$img=$r['imagen'];
        	}
        	$prodNuevo=array('idProducto'=>$_GET['idProducto'],
                           'Descripcion'=>$nombre,
                           'Precio'=>$precio,
                           'Imagen'=>$img,
                           'Cantidad'=>1);
        	array_push($arreglo, $prodNuevo);
        	$_SESSION['carrito']=$arreglo;
   	    }
   	}
   }else{
        if(isset($_GET['idProducto'])){
        	$nombre="";
            $precio=0;
            $img="";
        	$registro=mysqli_query($conexion,"select * from productos where idProducto=".$_GET['idProducto'])or die("Problemas en el select:".mysqli_error($conexion));;
        	while ($r=mysqli_fetch_array($registro)) {
        		$nombre=$r['descripcion'];
        		$precio=$r['precio'];
        		$img=$r['imagen'];
        	}
        	$arreglo[]=array('IdProducto'=>$_GET['idProducto'],
                           'Descripcion'=>$nombre,
                           'Precio'=>$precio,
                           'Imagen'=>$img,
                           'Cantidad'=>1);
            $_SESSION['carrito']=$arreglo;
        }
    }
   

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Carrito de compras</title>

  </head>
  <body>
      <div class="row">
        <div class="col-md-12">
         <?php
        
    	     $total=0;
    	     if(isset($_SESSION['carrito'])){
                  $datos=$_SESSION['carrito'];
                  $total=0;
                  for ($i=0; $i<count($datos);$i++) { 
          ?>
                 <div class="producto" style="padding: 2%;margin-left:60px;margin-top: 20px">
                 	    <center>
                 	    	<a href="detalle.php?idProducto=<?php echo $datos[$i]['IdProducto']; ?>"><img style="width: 200px;height: 200px" src="imagenes/<?php echo $datos[$i]['Imagen'];?>"></a><br>
                 	    	<span><?php echo $datos[$i]['Descripcion'];?></span><br>
                 	    	<span><?php echo "$".$datos[$i]['Precio'];?></span><br>
                 	    	<span><input type="text" value="<?php echo "cantidad: ".$datos[$i]['Cantidad']; ?>"></span>
                 	    	<h6>subtotal: <?php echo "$".$datos[$i]['Precio']*$datos[$i]['Cantidad'];?></h6>
                 	    </center>
                 </div>
          <?php    	
                  $total=($datos[$i]['Cantidad']*$datos[$i]['Precio'])+$total;
                  }
    	     }else{
    	     	echo '<div style="padding: 5%; margin-left:400px"><h2>el carrito de compras esta vacio</h2></div>';
    	     }
    	    ?>
        </div>
      </div>
      <hr>
      <h3 align="center" style="color: green">total: <?php echo "$".$total;?></h3>
      <?php
         require("footer.php");
      ?>
      <script src="jquery-3.3.1.min.js"></script>
      <script src="bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
      <script src="fontawesome-free-5.11.2-web/js/all.min.js"></script>
  </body>
</html>