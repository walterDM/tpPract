<?php
require "conexion.php";
$id=$_POST['id'];
$selectPass= "SELECT contrasenia FROM personas where idPersona=$id";
$consultaPass=mysqli_query($conexion,$selectPass);
while($rs=mysqli_fetch_array($consultaPass)){
    $password=$rs['contrasenia'];
}
if (isset($_POST['btnMod']) && $_POST['btnMod']==1) {
        $passAnt=$_POST['passAnt'];
        $passN=$_POST['newP'];
        $passRN=$_POST['newRP'];
        $passNs=SHA1($passN);
        echo $passNs;
      /*  if (($passAnt!=$passN)&&($passN==$passRN)&& !empty($_POST['newP'])) {
            echo "hola";
            $datosPer='UPDATE personas 
            SET nombre ="walter", 
            apellido = "martiner",
            usuario = "Waltermartinez", 
            contrasenia = SHA1("1234") 
            WHERE idPersona = 11 ';
            $updateUser=mysqli_query($conexion,$datosPer);
            header("location:perfilUsuario.php?mod=1");
        }
        if (empty($_POST['newP']) && empty($_POST['newRP'])) {

            $datosPer="UPDATE personas 
            SET 
            nombre='".$_POST['nombre']."',
            apellido='".$_POST['apellido']."',
            usuario='".$_POST['user']."', 
            WHERE idpPersona=$id";
            $updateUser=mysqli_query($conexion,$datosPer);
            
            header("location:perfilUsuario.php");
        }
        if ($_POST['newP'] != $_POST['newRP']) {
            header("location:perfilUsuario.php?passD=1");
        }*/

}

?>