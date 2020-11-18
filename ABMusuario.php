<?php
function conectar(){
    $conexion= mysqli_connect("127.0.0.1","root","","tppract");
    if (!$conexion) {
        echo "Error al conectar base";
    } 
    return $conexion;
}
conectar();
if (isset($_POST['guardarUsuario'] )&& !empty($_POST['guardarUsuario'])) {
    $db=conectar();
    $legajo=$_POST['legajo'];
    $nombre=$_REQUEST['nombre'];
    $apellido=$_REQUEST['apellido'];
    $tipodoc=$_REQUEST['tipodoc'];
    $idCiudad=$_POST['cbxciudad'];
    $calle=$_POST['calle'];
    $altura=$_POST['altura'];
    $dpto=$_POST['dpto'];
    $piso=$_POST['piso'];
    $idTipoDomicilio=$_POST['tipodomicilio'];
    $num=$_REQUEST['numDocumento'];
    $fecha=$_REQUEST['fechaNac'];
    $user=$_REQUEST['usuario'];
    $email=$_POST['mail'];
    $telefono=$_POST['telefono'];
    $pass=sha1($_REQUEST['contrasenia']);
    $nombreGrupo=$_POST['nombreGrupo'];
    $estado=mysqli_query($db,"SELECT idEstado FROM estados WHERE descripcion='Activo'");
    while($r=mysqli_fetch_array($estado)){$idEstado=$r['idEstado'];}
    $consulta1=mysqli_query($db,"SELECT idTipoContacto FROM tiposcontactos WHERE descripcion='email'");
    while($r=mysqli_fetch_array($consulta1)){$idTipoMail=$r['idTipoContacto'];}
    $consulta2=mysqli_query($db,"SELECT idTipoContacto FROM tiposcontactos WHERE descripcion='telefono'");
    while($r=mysqli_fetch_array($consulta2)){$idTipoTelefono=$r['idTipoContacto'];}
    $select=mysqli_query($db,"SELECT idTipoDocumento FROM tiposdocumentos WHERE descripcion='$tipodoc'");
    while ($r=mysqli_fetch_array($select)) {
        $idTipoDocumento=$r['idTipoDocumento'];
    }
    $select2=mysqli_query($db,"SELECT idGrupo FROM grupos WHERE nombreGrupo='$nombreGrupo'");
    while ($r=mysqli_fetch_array($select2)) {
        $idGrupo=$r['idGrupo'];
    }
    $verificarLegajo=mysqli_query($db,"SELECT LegajoEmpleado FROM empleados WHERE LegajoEmpleado='$legajo'");
    $verificarDni=mysqli_query($db,"SELECT numDocumento FROM personas WHERE numDocumento='$num'");
    $verificarUsuario=mysqli_query($db,"SELECT usuario FROM personas WHERE usuario='$user'");
    $verificarMail=mysqli_query($db,"SELECT descripcion FROM personascontactos WHERE descripcion='$email'");
    if(mysqli_num_rows($verificarLegajo)>0 || mysqli_num_rows($verificarDni)>0 || mysqli_num_rows($verificarUsuario)>0 || mysqli_num_rows($verificarMail)>0){
        if(mysqli_num_rows($verificarLegajo)>0){
            header("location:altaUsuario.php?error=2");
        }
        if(mysqli_num_rows($verificarDni)>0){
            header("location:altaUsuario.php?error=3");
        }
        if(mysqli_num_rows($verificarUsuario)>0){
            header("location:altaUsuario.php?error=4");
        }
        if(mysqli_num_rows($verificarMail)>0){
            header("location:altaUsuario.php?error=5");
        }
    }
    else{
        $insertar=mysqli_query($db,"INSERT INTO personas VALUES (00,$num,$idTipoDocumento,'$nombre','$apellido','$fecha','$user','$pass',$idEstado)");
        $select3=mysqli_query($db,"SELECT idPersona FROM personas WHERE numDocumento='$num'");
        while($r=mysqli_fetch_array($select3)){
            $idPersona=$r['idPersona'];
        }
        $insertar2=mysqli_query($db,"INSERT INTO gruposusuarios VALUES($idPersona,$idGrupo)");
        $insertar3=mysqli_query($db,"INSERT INTO empleados VALUES($legajo,$idPersona)");
        $insert4=mysqli_query($db,"INSERT INTO personascontactos VALUES(00,$idPersona,$idTipoMail,'$email')");
        $insert5=mysqli_query($db,"INSERT INTO personascontactos VALUES(00,$idPersona,$idTipoTelefono,'$telefono')");
        $insert6=mysqli_query($db,"INSERT INTO direcciones VALUES(00,$idCiudad,$idPersona,$idTipoDomicilio,'$calle',$altura,'$dpto','$piso')");
        header("location:altaUsuario.php?registrado=1");
    }
}
if (isset($_POST['modificarUsuario'] )&& !empty($_POST['modificarUsuario'])) {
    $db=conectar();
    $legajo=$_POST['legajo'];
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $tipodoc=$_POST['tipodoc'];
    $num=$_POST['numDocumento'];
    $idCiudad=$_POST['cbxciudad'];
    $calle=$_POST['calle'];
    $altura=$_POST['altura'];
    $dpto=$_POST['dpto'];
    $piso=$_POST['piso'];
    $idTipoDomicilio=$_POST['tipodomicilio'];
    $fecha=$_POST['fechaNac'];
    $idPersona=$_POST['idPersona'];
    $numDocumentoAnterior=$_POST['numDocumentoAnterior'];
    $legajoAnterior=$_POST['legajoAnterior'];
    $usuarioAnterior=$_POST['usuarioAnterior'];
    $emailAnterior=$_POST['mailAnterior'];
    $email=$_POST['mail'];
    $telefono=$_POST['telefono'];
    $nombreGrupo=$_POST['nombreGrupo'];
    $consulta1=mysqli_query($db,"SELECT idTipoContacto FROM tiposcontactos WHERE descripcion='email'");
    while($r=mysqli_fetch_array($consulta1)){$idTipoMail=$r['idTipoContacto'];}
    $consulta2=mysqli_query($db,"SELECT idTipoContacto FROM tiposcontactos WHERE descripcion='telefono'");
    while($r=mysqli_fetch_array($consulta2)){$idTipoTelefono=$r['idTipoContacto'];}
    $select=mysqli_query($db,"SELECT idTipoDocumento FROM tiposdocumentos WHERE descripcion='$tipodoc'");
    while ($r=mysqli_fetch_array($select)) {
        $idTipoDocumento=$r['idTipoDocumento'];
    }
    $select2=mysqli_query($db,"SELECT idGrupo FROM grupos WHERE nombreGrupo='$nombreGrupo'");
    while ($r=mysqli_fetch_array($select2)) {
        $idGrupo=$r['idGrupo'];
    }
    
    $delete=mysqli_query($db,"DELETE FROM gruposusuarios WHERE idPersona=$idPersona");
    $insertar=mysqli_query($db,"INSERT INTO gruposusuarios VALUES($idPersona,$idGrupo)");
    $delete2=mysqli_query($db,"DELETE FROM empleados WHERE idPersona=$idPersona");
    $insertar2=mysqli_query($db,"INSERT INTO empleados VALUES($legajo,$idPersona)");
    $delete3=mysqli_query($db,"DELETE FROM personascontactos WHERE idPersona=$idPersona");
    $insertar3=mysqli_query($db,"INSERT INTO personascontactos VALUES(00,$idPersona,$idTipoMail,'$email')");
    $insertar4=mysqli_query($db,"INSERT INTO personascontactos VALUES(00,$idPersona,$idTipoTelefono,'$telefono')");
    $delete4=mysqli_query($db,"DELETE FROM direcciones WHERE idPersona=$idPersona");
    $insertar5=mysqli_query($db,"INSERT INTO direcciones VALUES(00,$idCiudad,$idPersona,$idTipoDomicilio,'$calle',$altura,'$dpto','$piso')");
    $actualizar="UPDATE personas SET numDocumento=$num,idTipoDocumento=$idTipoDocumento,nombre='$nombre',apellido='$apellido',fechaNac='$fecha' WHERE idPersona=$idPersona";
    $result=mysqli_query($db,$actualizar);
    $insertar5=mysqli_query($db,"INSERT INTO empleados VALUES($legajo,$idPersona)");
    header("location:buscarUsuarios.php?actualizado=1");
    
}
if(isset($_POST['eliminarUsuario']) && !empty($_POST['eliminarUsuario'])){
    $db=conectar();
    $select=mysqli_query($db,"SELECT idEstado FROM estados WHERE descripcion='Inactivo'");
    while($r=mysqli_fetch_array($select)){
        $idEstado=$r['idEstado'];
    }
    $id=$_POST['idPersona'];
    $update=mysqli_query($db,"UPDATE personas SET idEstado=$idEstado WHERE idPersona=$id");
    header("location:buscarUsuarios.php?eliminado=1");
}
?>