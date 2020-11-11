
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
function imagen(){
    if (isset($_POST['Modificar'])) {
        $id=$_POST['id'];
        $conexion=conectar();
        $consulta= "SELECT imagen from productos where idProductos='$id'";
        $query=mysqli_query($conexion,$consulta);
       //     $imgBD=$query->fetch_array(MYSQL_ASSOC);
        
        if (empty($_FILES['imagen'])) {
            return $imgBD['imagen'];
        }else{
            if (isset($_FILES['imagen']) && !empty($_FILES['imagen']['name'])) {
                
                $errores=array();
                $file_name=$_FILES['imagen']['name'];
                $file_size=$_FILES['imagen']['size'];
                $file_tmp=$_FILES['imagen']['tmp_name'];
                $file_type=$_FILES['imagen']['type'];
                $file_ext=$_FILES['imagen']['name'];
                $file_ext=explode('.',$file_ext);
                $file_ext=end($file_ext);
                $file_ext=strtolower($file_ext);
                
                $extencionPermitidas= array("jpeg","jpg","png","gif","bmp");
                if (in_array($file_ext, $extencionPermitidas)==false) {
                    $errores[]='archivo no permitido,selecione una imagen...';
                }
                if ($file_size >=2897152) {
                    $errores[]='el archivo debe ser menor a 2Mb..';
                }
                if (empty($errores)==true) {
                    move_uploaded_file($file_tmp, "Imagenes/".$file_name);
                    return $file_name;
                }
                else{
                    
                    print_r($errores);
                    
                }
            }
            
            
        }
    }
    if (isset($_FILES['imagen']) && !empty($_FILES['imagen']['name'])) {
        $errores=0;
        $file_name=$_FILES['imagen']['name'];
        $file_size=$_FILES['imagen']['size'];
        $file_tmp=$_FILES['imagen']['tmp_name'];
        $file_type=$_FILES['imagen']['type'];
        $file_ext=$_FILES['imagen']['name'];
        $file_ext=explode('.',$file_ext);
        $file_ext=end($file_ext);
        $file_ext=strtolower($file_ext);
        
        $extencionPermitidas= array("jpeg","jpg","png","gif","bmp");
        if (in_array($file_ext, $extencionPermitidas)==false) {
            $errores+=1;
            header("location:altaProducto.php?imgEstado=$errores");
        }
        if ($file_size >=2897152) {
            $errores+=2;
            header("location:altaProducto.php?imgEstado=$errores");
        }
        if (empty($errores)==true) {
            move_uploaded_file($file_tmp, "Imagenes/".$file_name);
            return $file_name;
        }
        else{
            print_r($errores);
        }
    }
}

//se procede a guardar en la base de datos la informacion cargada
if (isset($_POST['guardar'] )&& !empty($_POST['guardar'])) {
	$conexion=conectar();
	$nombre=$_POST['descripcion'];
    $lote=$_POST['lote'];
    $idTipoProducto=$_POST['cbxTipoProducto'];//trae el id del tipo de producto
    //echo $idTipoProducto."<br>";
    $idMarca=$_POST['cbxMarca'];
    

    $fechaCaducidad=$_POST['fechaCaducidad'];
    $cantidad=$_POST['cantidadProd'];
    $precio=$_POST['precio'];
    $estado=$_POST['estado'];
   // $estante=$_POST['estante'];
    $idPuestoFisico=$_POST['idPuestoFisico'];
   // $fila=$_POST['fila'];
  //  $columna=$_POST['columna'];
    $nombreImg=imagen();
    $idprov=$_POST['idProveedor'];
    $consultaIdTpM="SELECT idTpMarca from tiposproductos_marcas where idTipoProducto='$idTipoProducto' and idMarca='$idMarca'";
    $consultaTpm=mysqli_query($conexion,$consultaIdTpM);
 
    while($r=mysqli_fetch_array($consultaTpm)){
        $idTpM=$r['idTpMarca'];
    }
    //$Insert=mysqli_query($conexion,"INSERT INTO filacolumna VALUES($idPuestoFisico,$fila,$columna)");
    $Insert2=mysqli_query($conexion,"INSERT INTO productos values (00,'$nombre',$idPuestoFisico,'$nombreImg','$lote','$fechaCaducidad',$cantidad,$precio,'$estado')");
    $ultimoRegistro="SELECT MAX(idProducto) AS id FROM productos";
    $consultaUltReg=mysqli_query($conexion,$ultimoRegistro);
  
    while ($r=mysqli_fetch_array($consultaUltReg)) {
        $id=$r['id'];
    }
    
   
    $Insert3=mysqli_query($conexion,"INSERT INTO productostpmarcas values($id,$idprov,$idTpM,$precio)");
 
        header("location:altaProducto.php?estado=1");

    

}

if(isset($_POST['Modificar']) && !empty($_POST['Modificar'])){
    $conexion=conectar();
    $nombre=$_POST['descripcion'];
    $lote=$_POST['lote'];
    $idTipoProducto=$_POST['cbxTipoProducto'];
    $select=mysqli_query($conexion,"SELECT descripcion FROM tiposproductos WHERE idTipoProducto=$idTipoProducto");
    while($r=mysqli_fetch_array($select)){
        $descripcion=$r['descripcion'];
    };
    $idMarca=$_POST['cbxMarca'];
    $fechaCaducidad=$_POST['fechaCaducidad'];
    $cantidad=$_POST['cantidadProd'];
    $precio=$_POST['precio'];
    $estado=$_POST['estado'];
    $estante=$_POST['idPuestoFisico'];
    
    $idPuestoFisico=$_POST['idPuestoFisico'];
    $nombreImg=imagen();
    $id=$_POST['id'];
    
    $selecttpm= "SELECT idTpMarca from tiposproductos_marcas where idTipoProducto=$idTipoProducto and idMarca=$idMarca";
    $querytpm=mysqli_query($conexion,$selecttpm);
    while ($r=mysqli_fetch_array($querytpm)) {
        $idTpMarca=$r['idTpMarca'];
    }
    
    if (!is_null($nombreImg)) {	
     $actualizar="UPDATE productos SET 
     descripcion='$nombre',
     idPuestoFisico=$idPuestoFisico,
     imagen='$nombreImg',
     Lote='$lote',
     fechaCaducidad='$fechaCaducidad',
     cantidadProd=$cantidad,
     precio=$precio,
     estado='$estado' WHERE idProducto='$id'";
     $enviar=mysqli_query($conexion,$actualizar);
     $actualizartp="UPDATE productostpmarcas SET idTpMarca=$idTpMarca where idProducto=$id";
     $enviartpm=mysqli_query($conexion,$actualizartp);
     header("location:productos.php?categoria=$descripcion&pagina=1");
 }else{
     $actualizar="UPDATE productos SET 
     descripcion='$nombre',
     idPuestoFisico=$idPuestoFisico,
     Lote='$lote',
     fechaCaducidad='$fechaCaducidad',
     cantidadProd=$cantidad,
     precio=$precio,
     estado='$estado' WHERE idProducto=$id";
     $enviar=mysqli_query($conexion,$actualizar);
     $actualizartp="UPDATE productostpmarcas SET idTpMarca=$idTpMarca where idProducto=$id";
     $enviartpm=mysqli_query($conexion,$actualizartp);
     header("location:productos.php?categoria=$descripcion&pagina=1");

 }
}

if(isset($_POST['Altaestante']) && !empty($_POST['Altaestante'])){
    $conexion=conectar();
    $estante=$_POST['estante'];
    $categoria=$_POST['categoria'];
    $fila=$_POST['fila'];
    $columna=$_POST['columna'];
    for($i=1;$i<=$fila;$i++){
        for($j=1;$j<=$columna;$j++){
            $insert=mysqli_query($conexion,"INSERT INTO puestofisico VALUES(00,'$estante',$i,$j)");
        }
    }
    header("location:productos.php?categoria=$categoria&pagina=1");
}
if(isset($_POST['idProductos']) && !empty($_POST['idProductos'])){
    $conexion=conectar();
    $idProductos=$_POST['idProductos'];
    $categoria=$_POST['categoria'];
    $actualizar="UPDATE productos SET estado='Inactivo' WHERE idProductos='$idProductos'";
    $enviar=mysqli_query($conexion,$actualizar);
    header("location:productos.php?categoria=$categoria&pagina=1");
}

?>