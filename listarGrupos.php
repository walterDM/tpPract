<?php


require("conexion.php");
if(!isset($_GET['pagina'])){
    header("location:listarGrupos.php?pagina=1");
    }
$Selectgrupos=mysqli_query($conexion,"SELECT * FROM grupos ORDER BY nombreGrupo ASC");
$grupos_x_pag = 2;

$total_grupos = mysqli_num_rows($Selectgrupos);
$paginas = $total_grupos / $grupos_x_pag;
$paginas = ceil($paginas);
if (isset($_GET['eliminado'])&& $_GET['eliminado']==1) {
    echo "<script type='text/javascript'>alert('fue eliminado con exito');</script>";
}

          if (isset($_GET['pagina'])) {
            require("header.php");
            $iniciar = ($_GET['pagina'] - 1) * $grupos_x_pag;
            $grupos=mysqli_query($conexion,"SELECT * FROM grupos ORDER BY nombreGrupo ASC limit $iniciar,$grupos_x_pag");
        ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="asignarPermisos.php" style="border-radius:30px;font-size:20px;float:right" class="btn btn-light">Nuevo</a>
            <div id="result" style="border: 1px solid white;overflow-y: scroll;background:#fafafa;padding-top:15px">
                <table class="table striped" style="background:#fafafa;height:300px">
                    <thead>
                        <tr>
                            <th>Grupo</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($r=mysqli_fetch_array($grupos)){ ?>
                                <tr>
                                    <td style="padding-top:30px"><?php echo $r['nombreGrupo'];?></td>
                                
                        <?php 
                                $grupo=mysqli_query($conexion,"SELECT p.nombrePermiso,up.idPermiso FROM permisos AS p, grupospermisos AS up WHERE p.idPermiso=up.idPermiso AND up.idGrupo=$idGrupo");
                                while($rs=mysqli_fetch_array($grupo)){
                                    $nombrePermiso=$rs['nombrePermiso'];
                                    if($nombrePermiso=="baja grupo"){
                        ?>
                                    <td>
                                        <input type="text" name="pagina" id="pagina" value="<?php echo $_GET['pagina'];?>" hidden>
                                        <input type="text" name="eliminarGrupo" id="eliminarGrupo" value="eliminarGrupo" hidden>
                                        <a style="text-decoration:underline;cursor:pointer; float: left;margin-right:5px;border-radius:30px;margin-top: 2%" class="btn btn-light card-text" href="#" onclick="eliminarDato(<?php echo $r['idGrupo']?>,<?php echo $_GET['pagina'];?>)"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                        <?php       }
                                    if($nombrePermiso=="modificar grupo"){?>
        
                                    <td>
                                        <form method="POST" action="Modgrupo.php">
                                            <input type="text" name="idGrupo" id="idGrupo" value="<?php echo $r['idGrupo'];?>" hidden>
                                            <button style="text-decoration:underline;cursor:pointer; float: left;margin-right:5px;border-radius:30px;margin-top: 2%" name="Modificar" value="Modificar" class="btn btn-light"><i class="fas fa-pencil-alt"></i></button>
                                        </form>
                                       
                                    </td>
                        <?php       }
                                }
                        ?>
                                </tr>
                                <div data-backdrop="static"  class="modal fade" id="info<?php echo $r['idGrupo'];?>">
                                <div class="col-md-12 modal-dialog" >
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h4 class="modal-title">Baja grupo</h4>
                                            <button type="button" class="close" data-dismiss="modal">X</button>
                                        </div>
                                        <div class="col-md-12" style="background:#e0e0e0">
                                            <div class="modal-body" >
                                            <h5 align="center">Estas seguro que deseas eliminar el siguiente grupo:</h5>
                                            <h6 align="center"><?php echo $r['nombreGrupo'];?></h6>
                                            <div align="center">
                                                <form method="POST" action="ABMusuario.php">
                                                    <input type="text" class="form-control" name="idGrupo" id="idGrupo" value="<?php echo $r['idGrupo'];?>" hidden>
                                                    <button  type="submit" name="eliminarGrupo" value="eliminarGrupo" class="btn btn-light">Eliminar</button>
                                                </form>
                                                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                                            </div>
                                        </div>
                                </div>	
                                </div>

    <?php             
    } 
    ?>
                    </tbody>
                </table>
        </div>
    </div>
</div>
<?php } ?>
 <div class="container" style="padding-top:40px">
  <nav arial-label="page navigation">
    <ul class="pagination justify-content-center">
      <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>"><a class="page-link" href="listarGrupos.php?pagina=<?php echo $_GET['pagina'] - 1 ?>">Anterior</a></li>
      <?php for ($i = 1; $i <= $paginas; $i++) : ?>
        <li class="<?php echo $_GET['pagina'] == $i ? 'active' : '' ?>"><a class="page-link" href="listarGrupos.php?pagina=<?php echo $i ?>"><?php echo $i ?></a></li>
      <?php endfor ?>
      <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>"><a class="page-link" href="listarGrupos.php?pagina=<?php echo $_GET['pagina'] + 1 ?>">Siguiente</a></li>
    </ul>
  </nav>
</div>
<script type="text/javascript" src="js/ABMgrupos.js"></script>