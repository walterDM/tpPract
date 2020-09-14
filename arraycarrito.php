<?php
   session_start();
   require("conexion.php");
   $categoria=$_GET['categoria'];
   $pagina=$_GET['pagina'];
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
			$cantidadProd=0;
        	$registro=mysqli_query($conexion,"select * from productos where idProducto=".$_GET['idProducto'])or die("Problemas en el select:".mysqli_error($conexion));;
        	while ($r=mysqli_fetch_array($registro)) {
        		$nombre=$r['descripcion'];
				$precio=$r['precio'];
				$cantidadProd=$r['cantidadProd'];
        		$img=$r['imagen'];
        	}
        	$prodNuevo=array('IdProducto'=>$_GET['idProducto'],
                           'Descripcion'=>$nombre,
						   'Precio'=>$precio,
						   'CantidadProd'=>$cantidadProd,
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
			$cantidadProd=0;
            $img="";
        	$registro=mysqli_query($conexion,"select * from productos where idProducto=".$_GET['idProducto'])or die("Problemas en el select:".mysqli_error($conexion));;
        	while ($r=mysqli_fetch_array($registro)) {
        		$nombre=$r['descripcion'];
				$precio=$r['precio'];
				$cantidadProd=$r['cantidadProd'];
        		$img=$r['imagen'];
        	}
        	$arreglo[]=array('IdProducto'=>$_GET['idProducto'],
                           'Descripcion'=>$nombre,
						   'Precio'=>$precio,
						   'CantidadProd'=>$cantidadProd,
                           'Imagen'=>$img,
                           'Cantidad'=>1);
            $_SESSION['carrito']=$arreglo;
        }
    }
    header("location:productos.php?categoria=$categoria&pagina=$pagina");
?>