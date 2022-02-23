<?php 
require("conexion.php");
 if(!isset($_GET['pagina'])){
   header("location:index.php?pagina=1");
 }

require("header.php");

$grupo=mysqli_query($conexion,"SELECT p.nombrePermiso,up.idPermiso FROM permisos AS p, grupospermisos AS up WHERE p.idPermiso=up.idPermiso AND up.idGrupo='$idGrupo'");


  $consulta1=mysqli_query($conexion,"SELECT idTipoProducto FROM tiposproductos");
  while($r=mysqli_fetch_array($consulta1)){$idTipoProducto=$r['idTipoProducto'];}
  $mesActual = date('Y-m-d');
  $mesAnterior=date('Y-m-d',strtotime('-1 month', strtotime($mesActual)));
  $consulta = mysqli_query($conexion, "SELECT DISTINCT p.*,o.cantidad,o.descuento FROM productos AS p
                                    JOIN ofertas AS o ON o.idProducto=p.idProducto
                                    WHERE p.cantidadProd > 0");
$productos_x_pag = 4;

$total_productos = mysqli_num_rows($consulta);
$paginas = $total_productos / $productos_x_pag;
$paginas = ceil($paginas);
?>
<nav class="navbar navbar-expand-lg navbar-light" >

<?php while($r=mysqli_fetch_array($grupo)){
          $nombrePermiso=$r['nombrePermiso'];?>
<?php     if($nombrePermiso=="alta oferta"){?>
                <a class="btn btn-warning" style="color:white" href="altaOferta.php"><i class="far fa-arrow-alt-circle-up"></i>Nueva Oferta</a>
<?php     }
      }
?>     
</nav>

<div class="row">
  <div class="col-md-12">
  <h2 align="center">Ofertas</h2>

<div class="col-md-12">
  <?php if (isset($_GET['pagina'])) {
    $iniciar = ($_GET['pagina'] - 1) * $productos_x_pag;
    $consulta3 = mysqli_query($conexion, "SELECT DISTINCT p.*,o.cantidad,o.descuento,o.idOferta FROM productos AS p
    JOIN ofertas AS o ON o.idProducto=p.idProducto
    WHERE p.cantidadProd > 0 limit $iniciar,$productos_x_pag");
      ?>
      <div class="row">
       <?php while ($r = mysqli_fetch_array($consulta3)) { 
              $consulta4=mysqli_query($conexion,"SELECT * FROM ofertas WHERE idProducto={$r['idProducto']}");
        ?>
        <div align="center" class="col-md-3" style="padding:1%;">
          <div class="card" style="width: 12.5rem;background:#ffb74d;color:white">
            <img src="imagenes/<?php echo $r['imagen']; ?>" class="card-img-top" width="620px">
            <div class="card-body" style="height:150px">
             <p align="center" class="card-text"><?php echo $r['descripcion'];?></p>
             <?php 
               if(mysqli_num_rows($consulta4)>0){  
                   while($rs = mysqli_fetch_array($consulta4)){
                      $calculo=($r['precio']*$rs['descuento'])/100;
                      $restoTotal=$r['precio'] - $calculo;
                      if($rs['cantidad']>1){  
                        $total=$restoTotal*$rs['cantidad'];
              ?>
                         <p align="center" class="card-text"><?php echo "$".$r['precio']; ?></p>
                         <p align="center" class="card-text">LLeva <?php echo $rs['cantidad'].", $".$total; ?></p>
              <?php
                       }else{
              ?>
                          <del align="center" class="card-text"><?php echo "$".$r['precio']; ?></del>
                          <p align="center" class="card-text"><?php echo "$".$restoTotal; ?></p>
              <?php    }
                    }
                }else{
              ?>
                   <p align="center" class="card-text"><?php echo "$".$r['precio'];?></p>
              <?php
                }
              ?>
            </div>
            <?php if (isset($_SESSION['login'])) {
                   $grupo=mysqli_query($conexion,"SELECT p.nombrePermiso,up.idPermiso FROM permisos AS p, grupospermisos AS up WHERE p.idPermiso=up.idPermiso AND up.idGrupo='$idGrupo'");
                   while($rs=mysqli_fetch_array($grupo)){
                      $nombrePermiso=$rs['nombrePermiso'];
                      switch($nombrePermiso) {
                         case "alta carrito":
            ?>
                              <a style="float: left;margin: 5px;border-radius:30px" class="btn btn-light" href="#" data-toggle="modal" data-target="#carrito<?php echo $r['idProducto']; ?>"><i class="fas fa-cart-plus"></i> Añadir a carrito</a>
            <?php        break;
                      }
                    }
                  } ?>
             <div data-backdrop="static" class="modal" id="carrito<?php echo $r['idProducto']; ?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background:#ffb74d;color:white">
              <h4 class="modal-title">informacion</h4>
              <button type="button" class="close" data-dismiss="modal">X</button>
            </div>
            <div class="modal-body" style="background:#ffb74d;color:white">
              <div class="row">
                <div class="col-md-6">
                  <img src="imagenes/<?php echo $r['imagen']; ?>" style="width:70%"><br>
                </div>
                <div class="col-md-6">
                  <?php 
                        $vencimiento = date("d-m-Y", strtotime($r['fechaCaducidad']));
                  ?>
                  <h6><strong>producto: </strong><?php echo $r['descripcion']; ?></h6>
                  <h6><strong>precio: $</strong><?php echo $r['precio']; ?></h6>
                  <h6><strong>cantidad de stock: </strong><?php echo $r['cantidadProd']; ?></h6>
                  <h6><strong>lote: </strong><?php echo $r['Lote']; ?></h6>
                  <h6><strong>vencimiento: </strong><?php echo $vencimiento; ?></h6>
                </div>
            </div>
            <div class="row" style="padding-top:20px">
               <div class="col-md-12">
                  <form action="ArraycariitoInicio-1.php" method="GET" onsubmit="return stock(this)">
                     <label>Cantidad</label>
                     <input type="number" MIN="1" MAX="<?php echo $r['cantidadProd'];?>" id="cantidad" name="cantidad" VALUE="1">
                     <input type="text" name="pagina" id="pagina" value="<?php echo $_GET['pagina'];?>" hidden>
                     <input type="text" id="cantstock" value="<?php echo $r['cantidadProd'];?>" hidden>
                 
                     <button class="btn btn-light" name="idProducto" value="<?php echo $r['idProducto']?>" onclick="stock();"><i class="fas fa-cart-plus"></i> Añadir a carrito</button>
                  </form>  
               </div>
            </div>
          </div>

        </div>
      </div>
    </div>
             <div>
             
              <?php
              if (isset($_SESSION['login'])) {

               $grupo=mysqli_query($conexion,"SELECT p.nombrePermiso,up.idPermiso FROM permisos AS p, grupospermisos AS up WHERE p.idPermiso=up.idPermiso AND up.idGrupo='$idGrupo'");
               while($rs=mysqli_fetch_array($grupo)){
                $nombrePermiso=$rs['nombrePermiso'];
                switch($nombrePermiso) {
                  case "modificar oferta":
                  ?>
                  <form method="POST" action="modOferta.php">
                    <button style="float: left;margin: 5px;border-radius:30px" type="submit" name="idOferta" id="idOferta" value="<?php echo $r['idOferta']; ?>" class="btn btn-light"><i class="fas fa-pencil-alt"></i></button>
                  </form>
                  <?php break; 
                  case "baja oferta":
                  
                   
                  ?>
                  <input type="text" name="pag" id="pag" value="<?php echo $_GET['pagina'];?>" hidden>
                
                  <input type="text" name="eliminarOferta" id="eliminarOferta" value="eliminarOferta" hidden>
                  <a style="text-decoration:underline;cursor:pointer; float: left;margin-right:5px;border-radius:30px;margin-top: 2%" class="btn btn-light card-text" href="#" onclick="eliminarDato(<?php echo $r['idOferta']?>,<?php echo $_GET['pagina']?>)"><i class="fas fa-trash-alt"></i></a>
                  <div id="result"></div>
                  <?php break;
                }
              }
            }?>
            
            <a title="más informacion" style="float: right;margin-right:5px;border-radius:30px;margin-top: 2%" class="btn btn-light card-text" href="#" data-toggle="modal" data-target="#info<?php echo $r['idProducto']; ?>"><i class="fas fa-info-circle"></i></a>
            
          </div>
        </div>
      </div>
      <div data-backdrop="static" class="modal" id="info<?php echo $r['idProducto']; ?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="background:#ffb74d;color:white">
              <h4 class="modal-title">informacion</h4>
              <button type="button" class="close" data-dismiss="modal">X</button>
            </div>
            <div class="modal-body" style="background:#ffb74d;color:white">
              <div class="row">
                <div class="col-md-6">
                  <img src="imagenes/<?php echo $r['imagen']; ?>" style="width:70%"><br>
                </div>
                <div class="col-md-6">
                  <h6><strong>producto: </strong><?php echo $r['descripcion']; ?></h6>
                  <h6><strong>precio: $</strong><?php echo $r['precio']; ?></h6>
                  <h6><strong>cantidad de stock: </strong><?php echo $r['cantidadProd']; ?></h6>
                  <h6><strong>lote: </strong><?php echo $r['Lote']; ?></h6>
                  <h6><strong>vencimiento: </strong><?php echo $r['fechaCaducidad']; ?></h6>
                </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  <?php } 
}
?>
</div>

<div class="container" style="padding-top:40px">
  <nav arial-label="page navigation">
    <ul class="pagination justify-content-center">
      <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>"><a class="page-link" href="index.php?pagina=<?php echo $_GET['pagina'] - 1 ?>">Anterior</a></li>
      <?php for ($i = 1; $i <= $paginas; $i++) : ?>
        <li class="<?php echo $_GET['pagina'] == $i ? 'active' : '' ?>"><a class="page-link" href="index.php?pagina=<?php echo $i ?>"><?php echo $i ?></a></li>
      <?php endfor ?>
      <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>"><a class="page-link" href="index.php?pagina=<?php echo $_GET['pagina'] + 1 ?>">Siguiente</a></li>
    </ul>
  </nav>
</div>

            
            
                  
                  </div>
                </div>
                </div>
                
               
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
 <script type="text/javascript" src="js/ABMofertas.js"></script>