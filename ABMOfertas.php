
<?php
require('conexion.php');
function conectar(){
  $conexion= mysqli_connect("127.0.0.1","root","","tppract");
  if (!$conexion) {
     echo "Error al conectar base";
 } 
 return $conexion;
}
conectar();


//se procede a guardar en la base de datos la informacion cargada
if (isset($_POST['guardar'] )&& !empty($_POST['guardar'])) {
	$conexion=conectar();
	$nombre=$_POST['descripcion'];
    $idProducto=$_POST['cbxProducto'];//trae el id del tipo de producto
    $cantidad=$_POST['cantidadProd'];
    $descuento=$_POST['descuento'];
    
   
    $Insert3=mysqli_query($conexion,"INSERT INTO ofertas values(00,$cantidad,$descuento,$idProducto)");
 
        //header("location:altaProducto.php?estado=1");
        echo "<script>alert('fue dado de alta con exito');</script>";
    

}
if (isset($_POST['Actualizar'] )&& !empty($_POST['Actualizar'])) {
	$conexion=conectar();
	$nombre=$_POST['descripcion'];
    $idProducto=$_POST['cbxProducto'];//trae el id del tipo de producto
    $cantidad=$_POST['cantidadProd'];
    $descuento=$_POST['descuento'];
    
   
    $Insert3=mysqli_query($conexion,"UPDATE ofertas SET cantidad='$cantidad', descuento='$descuento'
                                     WHERE idProducto=$idProducto");
 
        //header("location:altaProducto.php?estado=1");
        echo "<script>alert('Oferta modificada');</script>";
    

}
if(isset($_POST['delete']) && !empty($_POST['delete'])){ 
   /*$conexion=conectar();
    $idoferta=$_POST['id'];
    $pagina=$_POST['pag'];
    $delete=mysqli_query($conexion,"DELETE FROM ofertas WHERE idOferta=$idoferta");*/
    
    echo "hola";
}


?>