<!DOCTYPE html>
<html>
   <head>
      <title>Productos</title>
      <style>
          .pagination li a{
                background:white;
                color:#ffb74d;
            }
            .pagination li a:hover{
                background:white;
                color:#ffb74d;
            }
            .pagination .active a{
                background:#ffb74d;
                color:white;
            }
      </style>
   </head>
   <body>
   <?php 
      require("conexion.php");
      if (isset($_GET['busqueda']) && !empty($_GET['busqueda'])) {
         $buscar = $_GET['busqueda'];
         if(!isset($_GET['pagina'])){
           header("location:buscarProducto.php?busqueda=$buscar&pagina=1");
         }
      }


      require("header.php");
      $grupo=mysqli_query($conexion,"SELECT p.nombrePermiso,up.idPermiso FROM permisos AS p, grupospermisos AS up WHERE p.idPermiso=up.idPermiso AND up.idGrupo='$idGrupo'");
      $consulta=mysqli_query($conexion,"SELECT * FROM productos WHERE (descripcion like '%$buscar%') and estado='activo' order by descripcion asc");
      $productos_x_pag = 4; 
       $total_productos=mysqli_num_rows($consulta);
      
      $paginas = $total_productos / $productos_x_pag;
      $paginas = ceil($paginas);?>
    <div class="container">
        <div class=row>
     
          <div class="col-md-12">
          <?php if (isset($_GET['pagina'])) {
                    /*$consulta1=mysqli_query($conexion,"SELECT idTipoProducto FROM tiposproductos WHERE descripcion='$categoria'");
                    while($r=mysqli_fetch_array($consulta1)){$idTipoProducto=$r['idTipoProducto'];}*/
                    $iniciar = ($_GET['pagina'] - 1) * $productos_x_pag;
                    $consulta2=mysqli_query($conexion,"SELECT * FROM productos WHERE (descripcion like '%$buscar%') and estado='activo' order by descripcion asc LIMIT $iniciar,$productos_x_pag");?>
                    <div class="row">
                   <?php
                     if(mysqli_num_rows($consulta2)>0){
                       while ($r = mysqli_fetch_array($consulta2)) { ?>
                        <div align="center" class="col-md-3" style="padding:1%;">
                            <div class="card" style="width: 12.5rem;background:#ffb74d;color:white">
                                <img src="imagenes/<?php echo $r['imagen']; ?>" class="card-img-top" style="height:250px">
                                <div class="card-body" style="height:90px">
                                    <p align="center" class="card-text"><?php echo $r['descripcion']."<br>$".$r['precio']; ?></p>
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
                                                    <a style="float: left;margin: 5px;border-radius:30px" class="btn btn-light" href="#" data-toggle="modal" data-target="#info<?php echo $r['idProducto']; ?>"><i class="fas fa-trash-alt"></i></a>
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
                                            <?php if (isset($_SESSION['login']) && $_SESSION['login'] > 0) {
                                      
                                      $grupo=mysqli_query($conexion,"SELECT p.nombrePermiso,up.idPermiso FROM permisos AS p, grupospermisos AS up WHERE p.idPermiso=up.idPermiso AND up.idGrupo='$idGrupo'");
                                      while($rs=mysqli_fetch_array($grupo)){
                                        $nombrePermiso=$rs['nombrePermiso'];
                                        switch($nombrePermiso) {
                                            case "baja producto":?>
                                            <div class="col-md-6">
                                               <br>
                                                   <form method="POST" action="ABM.php">
                                                        <input type="text" name="categoria" id="categoria" value="<?php echo $categoria;?>" hidden>
                                                        <button style="margin-left: 35px;" type="submit" name="idProductos" value="<?php echo $r['idProducto']; ?>" class="btn btn-light">Eliminar</button>

                                                    </form>
                                            </div>
                                      <?php }
                                       }
                                      }
                                      ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                    <div class="container" style="padding-top:40px">
                        <nav arial-label="page navigation">
                            <ul class="pagination justify-content-center">
                                <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>"><a class="page-link" href="buscarProducto.php?busqueda=<?php echo $buscar; ?>&pagina=<?php echo $_GET['pagina'] - 1 ?>">Anterior</a></li>
                               <?php for ($i = 1; $i <= $paginas; $i++) : ?>
                                    <li class="<?php echo $_GET['pagina'] == $i ? 'active' : '' ?>"><a class="page-link" href="buscarProducto.php?busqueda=<?php echo $buscar; ?>&pagina=<?php echo $i ?>"><?php echo $i ?></a></li>
                                <?php endfor ?>
                                <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>"><a class="page-link" href="buscarProducto.php?busqueda=<?php echo $buscar; ?>&pagina=<?php echo $_GET['pagina'] + 1 ?>">Siguiente</a></li>
                            </ul>
                        </nav>
                    </div>
        
                    <?php
                     }else{
                        echo '<div class="col-md-12" style="padding-top:10px">
                        <div class="alert alert-warning" role="alert">
                            <h2 align="center">Producto no encontrado</h2>
                        </div>
                    </div>';
                     }
                    }
                    ?>
          </div>
      </div>
   </body>
</html>
