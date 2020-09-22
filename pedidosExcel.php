<?php
session_start();
require 'conexion.php';
include 'plantillaPDF.php'; 
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


    $queryProv="SELECT empresa from proveedores where idProveedor=$idProv";
    $queryP=mysqli_query($conexion,$queryProv);
    while($rs=mysqli_fetch_array($queryP)){
        $empresa=$rs['empresa'];
    }
    
    $name="Pedido__".$idPedido;//id Factura
    $fechaActual = date('d-m-Y');


    
    $filename = $name . ".csv";  
    
    //set column headers
            echo ";".";".";"."nro Legajo Empleado: ".$legajoEmp."\n";
            echo ";".";".";"."Empresa: ".$empresa."\n";
            echo ";".";".";"."Fecha Pedido: ".$fechaActual."\n";
            echo ";"."GestiStock"."\n";
            echo "tipo Producto".";";
            echo "Marca" .";";
            echo  "Cantidad"."\n";
            
 for ($i=0; $i < sizeof($vari) ; $i++) { 
        $queryMTP="SELECT m.nombreMarca as marca, tp.descripcion as tProducto FROM marcas as m
        JOIN tiposproductos_marcas as tpm  on tpm.idMarca= m.idMarca 
        JOIN tiposproductos as tp on tpm.idTipoProducto=tp.idTipoProducto
        where tpm.idTpMarca=$vari[$i]";
        $resultMTP=mysqli_query($conexion,$queryMTP);
        while ($r=mysqli_fetch_array($resultMTP)) {
        
            echo $r['tProducto'].";";
            echo $r['marca'].";";
            echo $_POST['cant'][$i]."\n";
        
    }
}
    
    //move back to beginning of file
   
   
    //set headers to download file rather than displayed
    header('Content-Type: application/csv');
    
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    
    //output all remaining data on a file pointer
   

exit;
}
?>
