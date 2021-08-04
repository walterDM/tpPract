<!--agregue un comentario-->
<?php 
//header("location:carrito.php");
require("header.php"); 

$db=conectar();
$consulta=mysqli_query($db,"SELECT * FROM productos where idEstado=1 limit 0, 5");
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
      

           <div class="col-md-12" style="padding-top:20px">
                <h2 align="center">Destacados del mes</h2>
                <?php $consulta1=mysqli_query($conexion,"SELECT idTipoProducto FROM tiposproductos");
    while($r=mysqli_fetch_array($consulta1)){$idTipoProducto=$r['idTipoProducto'];}
    $mesActual = date('Y-m-d');
    $mesAnterior=date('Y-m-d',strtotime('-1 month', strtotime($mesActual)));
  
    $consulta3 = mysqli_query($conexion, "SELECT DISTINCT p.idProducto,p.descripcion,p.imagen,p.precio,p.cantidadProd,p.Lote,p.fechaCaducidad FROM facturas AS f
                                          JOIN facturadetalles AS fd ON fd.idFactura=f.idFacturaVenta
                                          JOIN productos AS p ON p.idProducto=fd.idProducto WHERE f.fechaPedido BETWEEN '$mesAnterior' AND '$mesActual'");?>
      <div class="row">
       <?php while ($r = mysqli_fetch_array($consulta3)) { ?>
        <div align="center" class="col-md-3" style="padding:1%;">
          <div class="card" style="width: 12.5rem;background:#ffb74d;color:white">
            <img src="imagenes/<?php echo $r['imagen']; ?>" class="card-img-top" width="620px" height="250px">
            <div class="card-body" style="height:90px">
              <p align="center" class="card-text"><?php echo $r['descripcion']."<br>$".$r['precio']; ?></p>
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