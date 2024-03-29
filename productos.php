
<?php 
require("conexion.php");
if (isset($_GET['categoria'])) {
 $categoria = $_GET['categoria'];
 if(!isset($_GET['pagina'])){
   header("location:productos.php?categoria=$categoria&pagina=1");
 }

}
require("header.php");

$grupo=mysqli_query($conexion,"SELECT p.nombrePermiso,up.idPermiso FROM permisos AS p, grupospermisos AS up WHERE p.idPermiso=up.idPermiso AND up.idGrupo='$idGrupo'");
$consulta=mysqli_query($conexion,"SELECT idTipoProducto FROM tiposproductos WHERE descripcion='$categoria'");
while($r=mysqli_fetch_array($consulta)){
  $idTipoProducto=$r['idTipoProducto'];
}
$consulta2 = mysqli_query($conexion, "SELECT p.* from productos as p 
  join productostpmarcas as pp on pp.idProducto=p.idProducto
  join tiposproductos_marcas as tpm on tpm.idTpMarca = pp.idTpMarca
  where tpm.idTipoProducto=$idTipoProducto 
  and p.idEstado=1 and cantidadProd >=1
  and p.fechaCaducidad>='2021-12-02'");
$productos_x_pag = 4;

$total_productos = mysqli_num_rows($consulta2);
$paginas = $total_productos / $productos_x_pag;
$paginas = ceil($paginas);
?>

<div class="row">
  <div class="col-md-12">
    <nav class="navbar navbar-expand-lg navbar-light" style="float:right">
      <ul class="navbar-nav mr-auto" style="padding-top:10px">
       <?php while($r=mysqli_fetch_array($grupo)){
        $nombrePermiso=$r['nombrePermiso'];?>
        <?php if($nombrePermiso=="crear estante"){?>
         <li class="nav-item">
           <a class="btn btn-warning" style="color:white" href="#" data-toggle="modal" data-target="#crearestante"><i class="far fa-arrow-alt-circle-up"></i>Alta estante</a>
         </li>
       <?php }
     }?>
   </ul>
 </nav>
 <div data-backdrop="static"  class="modal fade" id="crearestante">
  <div class="col-md-12 modal-dialog" >
    <div class="modal-content">
      <div class="modal-header" style="background:#ffb74d;color:white">
       <h4 class="modal-title">Alta estante</h4>
       <button style="color:white" type="button" class="close" data-dismiss="modal">X</button>
     </div>
     <div class="modal-body" style="background:#ffb74d;color:white">
      <form action="ABMproductos.php" method="POST">
        <div class="form-row">
          <div class="form-group col-md-12">
            <label style="float:left" for="inputEmail4">crear estante</label>
            <input class="form-control" type="text" name="estante" id="estante" required placeholder="nombre de estante">
            <input class="form-control" type="text" name="categoria" id="categoria" value="<?php echo $categoria;?>" hidden>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label style="float:left" for="inputEmail4">Fila</label>
            <input class="form-control" type="text" name="fila" id="fila" required placeholder="cantidad de filas">
          </div>
          <div class="form-group col-md-6">
            <label style="float:left" for="inputEmail4">Columna</label>
            <input class="form-control" type="text" name="columna" id="columna" required placeholder="cantidad de columnas">
          </div>
        </div>
        <div class="form-group" align="center">
         <button type="submit" class="btn btn-light" name="Altaestante" value="Altaestante" style="width:50%">Crear</button>
       </div>
     </form>
   </div>
 </div>
</div>
</div>
</div>
<div class="col-md-12">
  <?php if (isset($_GET['pagina'])) {
    $consulta1=mysqli_query($conexion,"SELECT idTipoProducto FROM tiposproductos WHERE descripcion='$categoria'");
    while($r=mysqli_fetch_array($consulta1)){$idTipoProducto=$r['idTipoProducto'];}
    $iniciar = ($_GET['pagina'] - 1) * $productos_x_pag;
    $consulta3 = mysqli_query($conexion, "SELECT p.* from productos as p 
      join productostpmarcas as pp on pp.idProducto=p.idProducto
      join tiposproductos_marcas as tpm on tpm.idTpMarca = pp.idTpMarca
      where tpm.idTipoProducto=$idTipoProducto 
      and p.idEstado=1 and cantidadProd>=1 and p.fechaCaducidad>='2021-12-02' limit $iniciar,$productos_x_pag");
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
             <div>
             
              <?php
              if (isset($_SESSION['login'])) {

               $grupo=mysqli_query($conexion,"SELECT p.nombrePermiso,up.idPermiso FROM permisos AS p, grupospermisos AS up WHERE p.idPermiso=up.idPermiso AND up.idGrupo='$idGrupo'");
               while($rs=mysqli_fetch_array($grupo)){
                $nombrePermiso=$rs['nombrePermiso'];
                switch($nombrePermiso) {
                  case "modificar producto":
                  ?>
                  <form method="POST" action="modProducto.php">
                    <button style="float: left;margin: 5px;border-radius:30px" type="submit" name="idProductos" id="idProductos" value="<?php echo $r['idProducto']; ?>" class="btn btn-light"><i class="fas fa-pencil-alt"></i></button>
                  </form>
                  <?php break; 
                  case "baja producto":
                  
                   
                  ?>
                  <input type="text" name="pag" id="pag" value="<?php echo $_GET['pagina'];?>" hidden>
                  <input type="text" name="categ" id="categ" value="<?php echo $categoria;?>" hidden>
                  <input type="text" name="eliminarProducto" id="eliminarProducto" value="eliminarProducto" hidden>
                  <a style="text-decoration:underline;cursor:pointer; float: left;margin-right:5px;border-radius:30px;margin-top: 2%" class="btn btn-light card-text" href="#" onclick="eliminarDato(<?php echo $r['idProducto']?>,<?php echo $_GET['pagina']?>)"><i class="fas fa-trash-alt"></i></a>
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
      <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>"><a class="page-link" href="productos.php?categoria=<?php echo $categoria; ?>&pagina=<?php echo $_GET['pagina'] - 1 ?>">Anterior</a></li>
      <?php for ($i = 1; $i <= $paginas; $i++) : ?>
        <li class="<?php echo $_GET['pagina'] == $i ? 'active' : '' ?>"><a class="page-link" href="productos.php?categoria=<?php echo $categoria; ?>&pagina=<?php echo $i ?>"><?php echo $i ?></a></li>
      <?php endfor ?>
      <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>"><a class="page-link" href="productos.php?categoria=<?php echo $categoria; ?>&pagina=<?php echo $_GET['pagina'] + 1 ?>">Siguiente</a></li>
    </ul>
  </nav>
</div>

            
            
                  
                  </div>
                </div>
                
                <?php require 'footer.php'; 
                      if(isset($_GET['estadocarrito'])&& $_GET['estadocarrito']==2){
                           echo "<script>alert('el producto ya fue agregado al carrito anteriormente');</script>";
                      }
                      if(isset($_GET['estadocarrito'])&& $_GET['estadocarrito']==1){
                        echo "<script>alert('el producto fue añadido exitosamente!');</script>";
                   }
                ?>
</div>
</div>
<script type="text/javascript" src="js/ABMproductos.js"></script>
