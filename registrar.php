 <?php
 require("conexion.php");
 $grupo=mysqli_query($conexion,"SELECT idGrupo FROM grupos WHERE nombreGrupo='CLIENTE'");
 while($r=mysqli_fetch_array($grupo)){$idGrupo=$r['idGrupo'];}
        $nombre=$_REQUEST['nombre'];
        $apellido=$_REQUEST['apellido'];
        $tipodoc=$_REQUEST['tipodoc'];
        $num=$_REQUEST['numDocumento'];
        $fecha=$_REQUEST['fechaNac'];
        $user=$_REQUEST['usuario'];
        $pass=sha1($_REQUEST['contrasenia']);
        $select=mysqli_query($conexion,"SELECT idTipoDocumento FROM tiposdocumentos WHERE descripcion='$tipodoc'");
        while ($r=mysqli_fetch_array($select)) {
          $idTipoDocumento=$r['idTipoDocumento'];
        }
        if (isset($_REQUEST['registrado']) && !empty($_REQUEST['registrado'])) {
          
          if (!empty($nombre) && !empty($apellido) && !empty($user) && !empty($pass)) {
            $registros=mysqli_query($conexion,"select usuario from personas where usuario='$user'")or die("error de base de datos");
                        if(mysqli_num_rows($registros)>0){
                            header("location:index.php?estado=2");
                        }else{$insertar=mysqli_query($conexion,"insert into personas values 
                           (00,$num,$idTipoDocumento,'$nombre','$apellido','$fecha','$user','$pass')");
                        }
           if ($insertar==1) {
                 $consulta=mysqli_query($conexion,"SELECT idPersona FROM personas WHERE numDocumento=$num");
                 while ($r=mysqli_fetch_array($consulta)) {$idPersona=$r['idPersona'];}
                 $insert2=mysqli_query($conexion,"insert into gruposusuarios values($idPersona,$idGrupo)");
                 header("location:index.php?estado=$insertar");
            }
           }
         }
           
  ?>