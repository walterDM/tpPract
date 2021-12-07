<?php

require("header.php");
require("conexion.php");
$grupos=mysqli_query($conexion,"SELECT * FROM grupos ORDER BY nombreGrupo ASC");
if (isset($_GET['eliminado'])&& $_GET['eliminado']==1) {
    echo "<script type='text/javascript'>alert('fue eliminado con exito');</script>";
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
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
                                    <td><a href="#" style="border-radius:30px;font-size:20px" class="btn btn-light" data-toggle="modal" data-target="#info<?php echo $r['idGrupo']; ?>"><i class="fas fa-trash-alt"></i></a></td>
                        <?php       }
                                    if($nombrePermiso=="modificar grupo"){?>
        
                                    <td>
                                        <form method="POST" action="modificarGrupo.php">
                                            <input type="text" name="idGrupo" id="idGrupo" value="<?php echo $r['idGrupo'];?>" hidden>
                                            <button style="border-radius:30px;font-size:20px" type="submit" name="Modificar" value="Modificar" class="btn btn-light"><i class="fas fa-pencil-alt"></i></button>
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