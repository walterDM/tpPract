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
    <h2 align="center">Ofertas</h2>
    <?php 
        $consulta1=mysqli_query($conexion,"SELECT idTipoProducto FROM tiposproductos");
        while($r=mysqli_fetch_array($consulta1)){$idTipoProducto=$r['idTipoProducto'];}
        $mesActual = date('Y-m-d');
        $mesAnterior=date('Y-m-d',strtotime('-1 month', strtotime($mesActual)));
        $consulta = mysqli_query($conexion, "SELECT DISTINCT p.*,o.cantidad,o.descuento FROM productos AS p
                                          JOIN ofertas AS o ON o.idProducto=p.idProducto");
    ?>
    <div class="row">
       <?php 
           while ($r = mysqli_fetch_array($consulta)) { ?>
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
                         <?php 
                           }
                         ?>
                     </div>
                     <?php 
                         if (isset($_SESSION['login'])) {
                             $grupo=mysqli_query($conexion,"SELECT p.nombrePermiso,up.idPermiso FROM permisos AS p, grupospermisos AS up WHERE p.idPermiso=up.idPermiso AND up.idGrupo='$idGrupo'");
                             while($rs=mysqli_fetch_array($grupo)){
                                 $nombrePermiso=$rs['nombrePermiso'];
                                 switch($nombrePermiso) {
                                     case "alta carrito":
                     ?>
                                         <a style="float: left;margin: 5px;border-radius:30px" class="btn btn-light" href="#" data-toggle="modal" data-target="#carrito<?php echo $r['idProducto']; ?>"><i class="fas fa-cart-plus"></i> Añadir a carrito</a>
                     <?php           break;
                                 }
                             }
                         } 
                     ?>
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
                                          <form action="arraycarrito.php" method="GET" onsubmit="return stock(this)">
                                            <label>Cantidad</label>
                                            <input type="number" MIN="1" MAX="<?php echo $r['cantidadProd'];?>" id="cantidad" name="cantidad" VALUE="1">
                                            <input type="text" name="pagina" id="pagina" value="<?php echo $_GET['pagina'];?>" hidden>
                                            <input type="text" id="cantstock" value="<?php echo $r['cantidadProd'];?>" hidden>
                                            <input type="text" name="categoria" id="categoria" value="<?php echo $categoria;?>" hidden>
                                            <button class="btn btn-light" name="idProducto" value="<?php echo $r['idProducto']?>" onclick="stock();"><i class="fas fa-cart-plus"></i> Añadir a carrito</button>
                                          </form>  
                                       </div>
                                   </div>
                               </div>
                            </div>
                      </div>
                     </div>
                     
                     <?php
              if (isset($_SESSION['login'])) {

               $grupo=mysqli_query($conexion,"SELECT p.nombrePermiso,up.idPermiso FROM permisos AS p, grupospermisos AS up WHERE p.idPermiso=up.idPermiso AND up.idGrupo='$idGrupo'");
               while($rs=mysqli_fetch_array($grupo)){
                $nombrePermiso=$rs['nombrePermiso'];
                switch($nombrePermiso) {
                  case "modificar producto":
                  ?>
                  <form method="POST" action="modProducto.php">
                    <button style="float: left;margin: 5px;border-radius:30px;" type="submit" name="idProductos" id="idProductos" value="<?php echo $r['idProducto']; ?>" class="btn btn-light"><i class="fas fa-pencil-alt"></i></button>
                  </form>
                  <?php break; 
                  case "baja producto":
                  
                   
                  ?>
                  
                  <input type="text" name="categ" id="categ" value="<?php echo $categoria;?>" hidden>
                  <input type="text" name="eliminarProducto" id="eliminarProducto" value="eliminarProducto" hidden>
                  <a style="text-decoration:underline;cursor:pointer; float: left;margin-right:5px;border-radius:30px;margin-top: 2%" class="btn btn-light card-text" href="#" onclick="eliminarDato(<?php echo $r['idProducto']?>)"><i class="fas fa-trash-alt"></i></a>
                  <div id="result"></div>
                  <?php break;
                }
              }
            }?>
                     <a title="más informacion" style="float: right;margin-right:5px;border-radius:30px;margin-top: 2%" class="btn btn-light card-text" href="#" data-toggle="modal" data-target="#info<?php echo $r['idProducto']; ?>"><i class="fas fa-info-circle"></i></a>
                  
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
        <?php 
           } 
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