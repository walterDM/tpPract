 <?php
 require("conexion.php");
 if (isset($_REQUEST['registrado']) && !empty($_REQUEST['registrado'])) {
    $nombre=$_REQUEST['nombre'];
    $apellido=$_REQUEST['apellido'];
    $tipodoc=$_REQUEST['tipodoc'];
    $num=$_REQUEST['numDocumento'];
    $fecha=$_REQUEST['fechaNac'];
    $user=$_REQUEST['usuario'];
    $email=$_POST['mail'];
    $telefono=$_POST['telefono'];
    $pass=sha1($_REQUEST['contrasenia']);
    $grupo=mysqli_query($conexion,"SELECT idGrupo FROM grupos WHERE nombreGrupo='CLIENTE'");
    $estado=mysqli_query($conexion,"SELECT idEstado FROM estados WHERE descripcion='Activo'");
    while($r=mysqli_fetch_array($estado)){$idEstado=$r['idEstado'];}
    while($r=mysqli_fetch_array($grupo)){$idGrupo=$r['idGrupo'];}
    $consulta1=mysqli_query($conexion,"SELECT idTipoContacto FROM tiposcontactos WHERE descripcion='email'");
    while($r=mysqli_fetch_array($consulta1)){$idTipoMail=$r['idTipoContacto'];}
    $consulta2=mysqli_query($conexion,"SELECT idTipoContacto FROM tiposcontactos WHERE descripcion='telefono'");
    while($r=mysqli_fetch_array($consulta2)){$idTipoTelefono=$r['idTipoContacto'];}
    $select=mysqli_query($conexion,"SELECT idTipoDocumento FROM tiposdocumentos WHERE descripcion='$tipodoc'");
    while ($r=mysqli_fetch_array($select)) {
        $idTipoDocumento=$r['idTipoDocumento'];
    }
    $verificarDni=mysqli_query($conexion,"SELECT numDocumento FROM personas WHERE numDocumento='$num'");
    $verificarUsuario=mysqli_query($conexion,"SELECT usuario FROM personas WHERE usuario='$user'");
    $verificarMail=mysqli_query($conexion,"SELECT descripcion FROM personascontactos WHERE descripcion='$email'");
    if(mysqli_num_rows($verificarDni)>0 || mysqli_num_rows($verificarUsuario)>0 || mysqli_num_rows($verificarMail)>0){
        if(mysqli_num_rows($verificarDni)>0){
            header("location:index.php?error=2");
        }
        if(mysqli_num_rows($verificarUsuario)>0){
            header("location:index.php?error=3");
        }
        if(mysqli_num_rows($verificarMail)>0){
            header("location:index.php?error=4");
        }
    }
    else{
        $insertar=mysqli_query($conexion,"INSERT INTO personas VALUES (00,$num,$idTipoDocumento,'$nombre','$apellido','$fecha','$user','$pass',$idEstado)");
        $select3=mysqli_query($conexion,"SELECT idPersona FROM personas WHERE numDocumento='$num'");
        while($r=mysqli_fetch_array($select3)){
            $idPersona=$r['idPersona'];
        }
        $insertar2=mysqli_query($conexion,"INSERT INTO gruposusuarios VALUES($idPersona,$idGrupo)");
        $insert3=mysqli_query($conexion,"INSERT INTO personascontactos VALUES(00,$idPersona,$idTipoMail,'$email')");
        $insert4=mysqli_query($conexion,"INSERT INTO personascontactos VALUES(00,$idPersona,$idTipoTelefono,'$telefono')");
        header("location:index.php?registrado=1");
    }
}

?>