<?php
  if(isset($_POST['direcciones']) && !empty($_POST['direcciones'])){
    require("conexion.php");
    $idPersona=$_POST['idPersona'];
    $idCiudad=$_POST['cbxciudad'];
    $calle=$_POST['calle'];
    $altura=$_POST['altura'];
    $dpto=$_POST['dpto'];
    $piso=$_POST['piso'];
    $idTipoDomicilio=$_POST['tipodomicilio'];  
    $insert=mysqli_query($conexion,"INSERT INTO direcciones VALUES(00,$idCiudad,$idPersona,$idTipoDomicilio,'$calle',$altura,'$dpto','$piso')");
    header("location:altadireccion.php?agregado=1");
  }
?>