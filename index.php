<!--agregue un comentario-->
<?php 
//header("location:carrito.php");
require("header.php"); 

$db=conectar();
$consulta=mysqli_query($db,"SELECT * FROM productos where idEstado=1 limit 0, 5");
$grupo=mysqli_query($conexion,"SELECT p.nombrePermiso,up.idPermiso FROM permisos AS p, grupospermisos AS up WHERE p.idPermiso=up.idPermiso AND up.idGrupo='$idGrupo'");
$total_productos=mysqli_num_rows($consulta);
if (isset($_SESSION['login']) && !empty($_SESSION['login'])) {
  $idgrupo=$_SESSION['grupo'];
}
?>
<div class="container-fluid" style="padding-top:20px">
            <div class="row">
                <div class="col-sm-12">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="imagenes/banner.jpg" class="d-block w-100" alt="bootstrap" 
                                width="220px">
                            </div>
                            
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light" >

            <?php while($r=mysqli_fetch_array($grupo)){
                      $nombrePermiso=$r['nombrePermiso'];?>
            <?php     if($nombrePermiso=="alta oferta"){?>
                        
                            <a class="btn btn-warning" style="color:white" href="altaOferta.php"><i class="far fa-arrow-alt-circle-up"></i>Nueva Oferta</a>
                       
            <?php     }
                  }
            ?>
         
 </nav>

           <div class="col-md-12" style="padding-top:20px">
                <h2 align="center">Destacados del mes</h2>
                <?php $consulta1=mysqli_query($conexion,"SELECT idTipoProducto FROM tiposproductos");
    while($r=mysqli_fetch_array($consulta1)){$idTipoProducto=$r['idTipoProducto'];}
    $mesActual = date('Y-m-d');
    $mesAnterior=date('Y-m-d',strtotime('-1 month', strtotime($mesActual)));
  
    $consulta = mysqli_query($conexion, "SELECT DISTINCT p.*,o.cantidad,o.descuento FROM productos AS p
                                          JOIN ofertas AS o ON o.idProducto=p.idProducto");?>
      <div class="row">
       <?php while ($r = mysqli_fetch_array($consulta)) { ?>
        <div align="center" class="col-md-3" style="padding:1%;">
          <div class="card" style="width: 12.5rem;background:#ffb74d;color:white">
            <img src="imagenes/<?php echo $r['imagen']; ?>" class="card-img-top" width="620px" height="250px">
            <div class="card-body" style="height:150px">
              <p align="center" class="card-text"><?php echo $r['descripcion']; ?></p>
              <?php 
                    $calculo=($r['precio']*$r['descuento'])/100;
                    $restoTotal=$r['precio'] - $calculo;
                    if($r['cantidad']>1){  
                        $total=$r['precio'] + $restoTotal;
              ?>
                        <p align="center" class="card-text"><?php echo "$".$r['precio']; ?></p>
                        <p align="center" class="card-text">LLeva <?php echo $r['cantidad'].", $".$total; ?></p>
              <?php
                    }else{
                         ?>
                        <del align="center" class="card-text"><?php echo "$".$r['precio']; ?></del>
                        <p align="center" class="card-text"><?php echo "$".$restoTotal; ?></p>
              <?php }
              ?>
            </div>
           
            </div>
            </div>
  <?php } 

?>

           </div>
        </div>


<?php
if (isset($_GET['registrado'])&& $_GET['registrado']==1) {
 echo "<script type='text/javascript'>alert('fue registrado con exito');</script>";
}
if (isset($_GET['error'])&& $_GET['error']==2) {
 echo "<script type='text/javascript'>alert('ERROR AL REGISTRAR: el dni ingresado ya existe');</script>";
}
if (isset($_GET['error'])&& $_GET['error']==3) {
 echo "<script type='text/javascript'>alert('ERROR AL REGISTRAR: el nombre de usuario ingresado ya existe');</script>";
}
if (isset($_GET['error'])&& $_GET['error']==4) {
 echo "<script type='text/javascript'>alert('ERROR AL REGISTRAR: el email ingresado ya existe');</script>";
} 
if (isset($_GET['recuperar'])&& $_GET['recuperar']==1){
 echo '<script> alert("se ha enviado un mail a su correo con el link de restablecer contraseña");</script>';
 
}
if (isset($_GET['recuperar'])&& $_GET['recuperar']==2){
 echo '<script> alert("Hubo problemas con el envio");</script>';
 
}
if (isset($_GET['recuperar'])&& $_GET['recuperar']==3){
 echo '<script> alert("el usuario no existe");</script>';
 
}
if(isset($_GET['cambiar']) && $_GET['cambiar']==1){
  
  
}
?>


<?php require 'footer.php' ?>
<?php 
if (isset($_GET['Reporte']) && !empty($_GET['Reporte']) && $_GET['Reporte']=1) {
  echo '<script> alert("Se ha Exportado satisfactoriamente el reporte deseado");</script>';
}

 ?>