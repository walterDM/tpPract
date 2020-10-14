<?php
  if(isset($_POST['tarjetascliente']) && !empty($_POST['tarjetascliente'])){
    require("conexion.php");
    
    $numTarjeta=$_POST['numTarjeta'];
    $idTipoTarjeta=$_POST['tipotarjetas'];
    $fechaVencimiento=$_POST['fechaVencimiento'];
    $idPersona=$_POST['idPersona'];
    $codigo=$_POST['codigo']; 
    $insert=mysqli_query($conexion,"INSERT INTO tarjetascliente VALUES(00,$numTarjeta,$idTipoTarjeta,'$fechaVencimiento',$idPersona,'$codBanco')");
    header("location:TarjetaCliente.php?agregado=1");
  }
?>