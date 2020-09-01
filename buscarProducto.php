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
           header("location:buscarProducto.php?busqueda=''$&pagina=1");
         }
    
      }
      require("header.php");
      $grupo=mysqli_query($conexion,"SELECT p.nombrePermiso,up.idPermiso FROM permisos AS p, grupospermisos AS up WHERE p.idPermiso=up.idPermiso AND up.idGrupo='$idGrupo'");
      $consulta=mysqli_query($conexion,"SELECT * FROM productos WHERE descripcion='%".$buscar."%'");
      /*while($r=mysqli_fetch_array($consulta)){
        $idTipoProducto=$r['idTipoProducto'];
      }
      $consulta2 = mysqli_query($conexion, "SELECT p.* from productos as p 
                                            join productostpmarcas as pp on pp.idProducto=p.idProducto
                                            join tiposproductos_marcas as tpm on tpm.idTpMarca = pp.idTpMarca
                                            where tpm.idTipoProducto=$idTipoProducto 
                                            and p.estado='Activo'");*/
      $productos_x_pag = 4;
     
      $total_productos = mysqli_num_rows($consulta);
      $paginas = $total_productos / $productos_x_pag;
      $paginas = ceil($paginas);
   ?>
   <div class="container">
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
                    /*$consulta1=mysqli_query($conexion,"SELECT idTipoProducto FROM tiposproductos WHERE descripcion='$categoria'");
                    while($r=mysqli_fetch_array($consulta1)){$idTipoProducto=$r['idTipoProducto'];}*/
                    $iniciar = ($_GET['pagina'] - 1) * $productos_x_pag;
                    $consulta3 = mysqli_query($conexion, "SELECT p.* from productos as p where p.descripcion='$buscar'
                                                          and p.estado='Activo' limit $iniciar,$productos_x_pag");?>
                    <div class="row">
                   <?php while ($r = mysqli_fetch_array($consulta3)) { ?>
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
                    <!-- <div class="container" style="padding-top:40px">
                        <nav arial-label="page navigation">
                            <ul class="pagination justify-content-center">
                                <li class="page-item <?php //echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>"><a class="page-link" href="peliculas.php?genero=<?php //echo $peliculas; ?>&pagina=<?php //echo $_GET['pagina'] - 1 ?>">Anterior</a></li>
                               <?php //for ($i = 1; $i <= $paginas; $i++) : ?>
                                    <li class="<?php //echo $_GET['pagina'] == $i ? 'active' : '' ?>"><a class="page-link" href="peliculas.php?genero=<?php //echo $peliculas; ?>&pagina=<?php //echo $i ?>"><?php// echo $i ?></a></li>
                                <?php// endfor ?>
                                <li class="page-item <?php// echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>"><a class="page-link" href="peliculas.php?genero=<?php// echo $peliculas; ?>&pagina=<?php //echo $_GET['pagina'] + 1 ?>">Siguiente</a></li>
                            </ul>
                        </nav>
                    </div>
                    <?php
                    //if (isset($_GET['eliminado']) && $_GET['eliminado'] == 1) {
                       // echo "<script>alert('la pelicula ha sido eliminada');</script>";
                    }
                   // if (isset($_GET['estado']) && $_GET['estado'] == 1) {
                      //  echo "<script>alert('datos guardados');</script>";
                    //}
                   // if (isset($_GET['estado']) && $_GET['estado'] == 2) {
                      //  echo "<script>alert('datos modificados');</script>";
                    //}
                    //if (isset($_GET['estado']) && $_GET['estado'] == 3) {
                      //  echo "<script>alert('no se pudo cargar la pelicula con ese titulo porque ya existe');</script>";
                  //  }
                   // if (isset($_GET['id_pelicula']) && (isset($_GET['estado']) && $_GET['estado'] == 4)) {
                      //  $idPelicula = $_GET['id_pelicula'];
                       // $prod = mysqli_query($conexion, "select * from usuarios_movies where id_usuario='$idUser' and id_pelicula='$idPelicula'");
                        //if (mysqli_num_rows($prod) > 0) {
                        //    echo "<script>alert('no puede agregar una pelicula que ya se encuentra en la lista');</script>";
                 //       } //else {
                            //$insertar = mysqli_query($conexion, "insert into usuarios_movies(id_usuario,id_pelicula)values('$idUser','$idPelicula')");
                            //echo "<script>alert('pelicula agregada');</script>";
                     //   }
                  //  } 
                //}
            
?> -->
          </div>
      </div>
   </body>
</html>