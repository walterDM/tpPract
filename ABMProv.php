
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

    if (isset($_POST['guardarProveedor'] )&& !empty($_POST['guardarProveedor'])) {
    $db=conectar();
    $empresa=$_POST['empresa'];
    $direccion=$_POST['direccion'];
    $cuit=$_POST['cuit'];
    $telefono=$_POST['telefono'];
    $email=$_POST['correo'];
    $descripcion=$_POST['descripcion'];

    $verificarEmpresa=mysqli_query($db,"SELECT empresa FROM proveedores WHERE empresa='$empresa'");
    $verificarCuit=mysqli_query($db,"SELECT cuit FROM proveedores WHERE cuit='$cuit'");
    if(mysqli_num_rows($verificarEmpresa)>0 || mysqli_num_rows($verificarCuit)>0){
    	 if(mysqli_num_rows($verificarEmpresa)>0){
            header("location:altaProveedor.php?error=2");
        }
        if(mysqli_num_rows($verificarCuit)>0){
           header("location:altaProveedor.php?error=3");
        }
           

    }else{

      $insert1=mysqli_query($db, "INSERT INTO proveedores VALUES (00,'$empresa','$direccion','$cuit','$descripcion') ");

      $consulta1=mysqli_query($db,"SELECT idTipoContacto FROM tiposcontactos WHERE descripcion='email'");
        while ($r=mysqli_fetch_array($consulta1)) {
            $idTipoMail=$r['idTipoContacto'];
        }
        $consulta2=mysqli_query($db,"SELECT idTipoContacto FROM tiposcontactos WHERE descripcion='telefono'");
        while ($r=mysqli_fetch_array($consulta2)) {
          $idTipoTelefono=$r['idTipoContacto'];
        }
        $consulta3=mysqli_query($db,"SELECT idProveedor FROM proveedores WHERE empresa='$empresa'");
        while($r=mysqli_fetch_array($consulta3)){$idProveedor=$r['idProveedor'];}
        $insert2=mysqli_query($db,"INSERT INTO contactosproveedores VALUES (00,$idProveedor,$idTipoMail,
            '$email')");
        $insert3=mysqli_query($db,"INSERT INTO contactosproveedores VALUES (00,$idProveedor,$idTipoTelefono,'$telefono')");
         header("location:altaProveedor.php?registrado=1");
     }
   }


   if (isset($_POST['modificarProveedor'] )&& !empty($_POST['modificarProveedor'])) {
        $db=conectar();

        $idProveedor=$_POST['idProveedor'];
        $empresa=$_POST['empresa'];
        $direccion=$_POST['direccion'];
        $cuit=$_POST['cuit'];
        $telefono=$_POST['telefono'];
        $email=$_POST['correo'];
        $descripcion=$_POST['descripcion'];
   /* $consultabd=mysqli_query($db,"SELECT * from proveedores where idProveedor=$idProveedor")
    while ($r=mysqli_fetch_array($consultabd)) {
        $empresaBD=$r['empresa'];
        $direccion=
    }*/
        /*$query="UPDATE proveedores SET 
                            empresa='$empresa',
                            direccion='$direccion',
                            cuit='$cuit',
                            descripcion='$descripcion'
                        WHERE idProveedor=$idProveedor";*/
        $updateProv=mysqli_query($conexion,"UPDATE proveedores SET 
                            empresa='$empresa',
                            direccion='$direccion',
                            cuit='$cuit',
                            descripcion='$descripcion'
                        WHERE idProveedor=$idProveedor");
    
        $queryCPtel="UPDATE contactosproveedores SET 
                            descripcion=$telefono;
                            where idProveedor=$idProveedor and idTipoContacto=2";
        $updateCPtel=mysqli_query($db,$queryCPtel);
        $queryCPmail="UPDATE contactosproveedores SET 
                            descripcion=$email;
                            where idProveedor=$idProveedor and idTipoContacto=1";
            $updateCPmail=mysqli_query($db,$queryCPmail);
        if ($updateProv && $updateCPmail && $updateCPtel) {
            header("location:buscarProveedor.php?pagina=1&mod=1");
        }else{
    //echo $idProveedor;
           header("location:buscarProveedor.php?pagina=1&error=2");
        }
    }
?>