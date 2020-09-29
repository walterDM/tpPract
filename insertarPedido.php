<?php
session_start();
require 'conexion.php'; 
if (isset($_POST['seleccionado']) && !empty($_POST['seleccionado']) && isset($_POST['cant'])) {

    $idPersona=$_SESSION['login'];
    $idProv=$_POST['idProveedor'];
    $idContacto=$_POST['idCP'];
    $vari=$_POST['seleccionado'];
    $prod=$_POST['idProducto'];
    $cant=$_POST['cant'];

    $queryEmpleado="SELECT LegajoEmpleado as legajo FROM empleados where idPersona=$idPersona";
    $resultEMP=mysqli_query($conexion,$queryEmpleado);
    while ($r=mysqli_fetch_array($resultEMP)) {
        $legajoEmp=$r['legajo'];
    }
    $fechaBase=date('Y-m-d');
    $insertPedido="INSERT INTO `pedidosproveedores`(`idProveedor`, `LegajoEmpleado`, `FechaPedido`) VALUES ($idProv,$legajoEmp,now())";
    $insertar=mysqli_query($conexion,$insertPedido);
    $idPedido=mysqli_insert_id($conexion);
    for ($i=0; $i <sizeof($vari) ; $i++) { 
        
        $InsertDP="INSERT INTO `detallespedidos`(`idPedidoProveedor`, `idProducto`, `Cantidad`) VALUES ($idPedido,$prod[$i],$cant[$i])";
        $queryDP=mysqli_query($conexion,$InsertDP);
    }
    $insertEP="INSERT INTO `estadospedidos`(`idPedidoProveedor`, `idContactoProveedor`, `idEstado`) VALUES ($idPedido,$idContacto,1)";
    $queryEP=mysqli_query($conexion,$insertEP);
    if ($queryEP) {
        header('location:http://localhost/tppract/realizarPedido.php?pedido=1');
    }else{
        header('location:http://localhost/tppract/realizarPedido.php?pedido=0');
    }
    
}
?>
