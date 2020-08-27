<?php 
session_start();
  $idGrupo = $_SESSION['grupo'];
  $id_usuario=$_SESSION['login'];
?>
<table class="table striped" style="background:#fafafa">
                <thead>
                <th>Nombre</th>
        <th>Apellido</th>
        <th>Tipo de documento</th>
        <th>Nº Documento</th>
		<th>Fecha de nacimiento</th>
        <th>Usuario</th>
        <th>Grupo</th>
        <th></th>
		<th></th>
                </thead>
                <tbody>
                <?php 
                $dato = strtoupper($_REQUEST['dato']);
                require("conexion.php");
                $cant = 0;
                $consulta=mysqli_query($conexion,"SELECT usuario FROM personas WHERE idPersona='$id_usuario'"); 
                while($r=mysqli_fetch_array($consulta)){$user=$r['usuario'];}
                $sql = "SELECT * FROM personas WHERE (usuario LIKE'$dato%') AND usuario!='$user'";
                $result = mysqli_query($conexion, $sql);       
                  while($row=mysqli_fetch_array($result)){
                  $select2=mysqli_query($conexion,"SELECT descripcion FROM tiposdocumentos WHERE idTipoDocumento={$row['idTipoDocumento']}");
                  $select3=mysqli_query($conexion,"SELECT g.nombreGrupo FROM grupos AS g,gruposusuarios AS gp WHERE g.idGrupo=gp.idGrupo AND gp.idPersona={$row['idPersona']}");?>
                    <tr>
				<td style="padding-top:30px">
					<?php echo $row['nombre'];?>
				</td>
				<td style="padding-top:30px">
					<?php echo $row['apellido'];?>
                </td>
                <td style="padding-top:30px">
					<?php while($r=mysqli_fetch_array($select2)){ echo $r['descripcion'];}?>
				</td>
                <td style="padding-top:30px">
					<?php echo $row['numDocumento'];?>
				</td>
                <td style="padding-top:30px">
					<?php echo $row['fechaNac'];?>
				</td>
				<td style="padding-top:30px">
					<?php echo $row['usuario'];?>
                </td>
                <td style="padding-top:30px">
					<?php while($r=mysqli_fetch_array($select3)){ echo $r['nombreGrupo'];}?>
				</td>
                <?php $grupo=mysqli_query($conexion,"SELECT p.nombrePermiso FROM permisos AS p, grupospermisos AS up WHERE (p.nombrePermiso='buscar usuario' OR p.nombrePermiso='baja usuario' OR p.nombrePermiso='modificar usuario') AND p.idPermiso=up.idPermiso AND up.idGrupo='$idGrupo'");
                 while($r=mysqli_fetch_array($grupo)){
                    $nombrePermiso=$r['nombrePermiso'];
                    if($nombrePermiso=="baja usuario"){?>
				<td>
                <a href="#" style="border-radius:30px;font-size:20px" class="btn btn-light" data-toggle="modal" data-target="#info<?php echo $row['idPersona']; ?>"><i class="fas fa-trash-alt"></i></a>
                </td>
                    <?php }
                    if($nombrePermiso=="modificar usuario"){
                        $select4=mysqli_query($conexion,"SELECT g.nombreGrupo FROM grupos AS g,gruposusuarios AS gp WHERE g.nombreGrupo!='CLIENTE' AND g.idGrupo=gp.idGrupo AND gp.idPersona={$row['idPersona']}");
                        while($r=mysqli_fetch_array($select4)){?>
                <td>
                    <form method="POST" action="modificarUsuario.php">
                        <button style="border-radius:30px;font-size:20px" type="submit" name="idPersona" value="<?php echo $row['idPersona'];?>" class="btn btn-light"><i class="fas fa-pencil-alt"></i></button>
                    </form>
                </td>
                    <?php }
                    }
                    }?>
            </tr>
            <div data-backdrop="static"  class="modal fade" id="info<?php echo $row['idPersona'];?>">
	    <div class="col-md-12 modal-dialog" >
	        <div class="modal-content">
	            <div class="modal-header">
	                <h4 class="modal-title">Baja Usuario</h4>
	                <button type="button" class="close" data-dismiss="modal">X</button>
	            </div>
	            <div class="col-md-12" style="background:#e0e0e0">
		            <div class="modal-body" >
                       <h5 align="center">Estas seguro que deseas eliminar el siguiente usuario:</h5>
                       <h6 align="center"><?php echo $row['usuario'];?></h6>
                       <div align="center">
                       <form method="POST" action="ABM.php">
                         <input type="text" class="form-control" name="idPersona" id="idPersona" value="<?php echo $row['idPersona'];?>" hidden>
                         <button  type="submit" name="eliminarUsuario" value="eliminarUsuario" class="btn btn-light">Eliminar</button>
                       </form>
                       <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                       </div>
		    		</div>
	    	   </div>	
	        </div>
	    </div>
    </div>
                <?php }
                ?>
                </tbody>
            </table>
            