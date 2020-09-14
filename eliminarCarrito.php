<?php
 session_start();
        $arreglo=$_SESSION['carrito'];
   	    for ($i=0; $i<count($arreglo) ; $i++) { 
   	    	if ($arreglo[$i]['IdProducto']!=$_POST['IdProducto']) {
                $nuevoCarrito[]=array('IdProducto'=>$arreglo[$i]['IdProducto'],
                'Descripcion'=>$arreglo[$i]['Descripcion'],
                'Precio'=>$arreglo[$i]['Precio'],
                'CantidadProd'=>$arreglo[$i]['CantidadProd'],
                'Imagen'=>$arreglo[$i]['Imagen'],
                'Cantidad'=>$arreglo[$i]['Cantidad']);
   	    	}
        }
        if(isset($nuevoCarrito)){
            $_SESSION['carrito']=$nuevoCarrito;
        }else{
            unset($_SESSION['carrito']);
            echo '0';
        }
?>