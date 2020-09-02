<!DOCTYPE html>
<html>
<head>
    <title>USUARIOS</title>
</head>
<body>
   <?php 
   if(isset($_POST['buscar']) && !empty($_POST['buscar'])){
      if(!isset($_GET['pagina'])){
        header("location:buscarUser.php?pagina=1");
      }
      require("header.php");
      require("conexion.php");    
   ?>
   <div class="container-fluid">
       <div class="row">
          <div class="col-md-12" align="center" style="padding-top:20px">
              <form action="buscarUser.php?pagina=1" method="POST">
                 <div class="input-group mb-3">
                    <input id="usuario" name="usuario" style="width:70%" type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="ingrese la pelicula a buscar">
                    <div class="input-group-append">
                       <button name="buscar" value="buscar" style="border-color: #e0e0e0;background:white" class="btn btn-outline-warning" id="button-addon2"><i class="fas fa-search"></i></button>
                    </div>
                 </div>
              </form>
          </div>
          <br><br>
          <div class="col-md-12">
          <?php if (isset($_GET['pagina'])) {
                 
                    $dato=$_POST['usuario'];
                    $consulta=mysqli_query($conexion,"SELECT usuario FROM personas WHERE idPersona='$id_usuario'"); 
                    while($r=mysqli_fetch_array($consulta)){$user=$r['usuario'];}
                    $sql =mysqli_query($conexion,"SELECT * FROM personas WHERE (usuario LIKE'$dato%') AND usuario!='$user'");
                    $usuarios_x_pag = 2;
                    $total_usuarios = mysqli_num_rows($sql);
                    $paginas = $total_usuarios / $usuarios_x_pag;
                    $paginas = ceil($paginas);
                    $iniciar = ($_GET['pagina'] - 1) * $usuarios_x_pag;
                    $select = mysqli_query($conexion, "SELECT * FROM personas WHERE (usuario LIKE'$dato%') AND usuario!='$user' limit $iniciar,$usuarios_x_pag");
          ?>
                    <div id="result" style="border: 1px solid white;overflow-y: scroll;background:#fafafa;padding-top:15px">
                       <table class="table striped" style="background:#fafafa;height:300px">
                         <thead>
                             <th>Nombre</th>
                             <th>Apellido</th>
                             <th>Tipo de documento</th>
                             <th>Nº Documento</th>
                             <th>Fecha de nacimiento</th>
                             <th>Telefono</th>
                             <th>E-mail</th>
                             <th>Usuario</th>
                             <th>Grupo</th>
                             <th></th>
		                     <th></th>
                         </thead>
                         <tbody>
            <?php 
                              while($row=mysqli_fetch_array($select)){
                                   $idPersona=$row['idPersona'];
                                   $verificar=mysqli_query($conexion,"SELECT g.nombreGrupo FROM grupos AS g,gruposusuarios AS gp WHERE g.nombreGrupo!='CLIENTE' AND g.idGrupo=gp.idGrupo AND gp.idPersona={$row['idPersona']}");
                                   $select2=mysqli_query($conexion,"SELECT descripcion FROM tiposdocumentos WHERE idTipoDocumento={$row['idTipoDocumento']}");
                                   $select3=mysqli_query($conexion,"SELECT g.nombreGrupo FROM grupos AS g,gruposusuarios AS gp WHERE g.idGrupo=gp.idGrupo AND gp.idPersona={$row['idPersona']}");
                                   $sql1=mysqli_query($conexion,"SELECT idTipoContacto FROM tiposcontactos WHERE descripcion='email'");
                                   while($r=mysqli_fetch_array($sql1)){$idTipoMail=$r['idTipoContacto'];}
                                   $consulta1=mysqli_query($conexion,"SELECT descripcion FROM personascontactos WHERE idPersona=$idPersona AND idTipoContacto=$idTipoMail");
                                   while($r=mysqli_fetch_array($consulta1)){$Mail=$r['descripcion'];}
                                   $sql2=mysqli_query($conexion,"SELECT idTipoContacto FROM tiposcontactos WHERE descripcion='telefono'");
                                   while($r=mysqli_fetch_array($sql2)){$idTipoTelefono=$r['idTipoContacto'];}
                                   $consulta2=mysqli_query($conexion,"SELECT descripcion FROM personascontactos WHERE idTipoContacto=$idTipoTelefono AND idPersona=$idPersona");
                                   while($r=mysqli_fetch_array($consulta2)){$Telefono=$r['descripcion'];}
                                   
            ?>
                                   <tr>
                                    
				                          <td style="padding-top:30px"><?php echo $row['nombre'];?></td>
	                                   <td style="padding-top:30px"><?php echo $row['apellido'];?></td>
                                      <td style="padding-top:30px"><?php while($r=mysqli_fetch_array($select2)){ echo $r['descripcion'];}?></td>
                                      <td style="padding-top:30px"><?php echo $row['numDocumento'];?></td>
                                      <td style="padding-top:30px"><?php echo $row['fechaNac'];?></td>
                                      <td style="padding-top:30px"><?php echo $Telefono;?></td>
                                      <td style="padding-top:30px"><?php echo $Mail;?></td>
				                          <td style="padding-top:30px"><?php echo $row['usuario'];?></td>
                                      <td style="padding-top:30px"><?php while($r=mysqli_fetch_array($select3)){ echo $r['nombreGrupo'];}?></td>
            <?php                     $grupo=mysqli_query($conexion,"SELECT p.nombrePermiso FROM permisos AS p, grupospermisos AS up WHERE (p.nombrePermiso='buscar usuario' OR p.nombrePermiso='baja usuario' OR p.nombrePermiso='modificar usuario') AND p.idPermiso=up.idPermiso AND up.idGrupo='$idGrupo'");
                                      while($r=mysqli_fetch_array($grupo)){
                                            $nombrePermiso=$r['nombrePermiso'];
                                            if($nombrePermiso=="baja usuario"){
            ?>
				                               <td><a href="#" style="border-radius:30px;font-size:20px" class="btn btn-light" data-toggle="modal" data-target="#info<?php echo $idPersona; ?>"><i class="fas fa-trash-alt"></i></a></td>
            <?php                           }
                                            if($nombrePermiso=="modificar usuario"){
                                               $select4=mysqli_query($conexion,"SELECT g.nombreGrupo FROM grupos AS g,gruposusuarios AS gp WHERE g.nombreGrupo!='CLIENTE' AND g.idGrupo=gp.idGrupo AND gp.idPersona={$row['idPersona']}");
                                               while($r=mysqli_fetch_array($select4)){
            ?>
                                                  <td>
                                                     <form method="POST" action="modificarUsuario.php">
                                                        <button style="border-radius:30px;font-size:20px" type="submit" name="idPersona" value="<?php echo $row['idPersona'];?>" class="btn btn-light"><i class="fas fa-pencil-alt"></i></button>
                                                     </form>
                                                  </td>
            <?php                               }
                                             }
                                      }
            ?>
                                   </tr>
                                   <div data-backdrop="static"  class="modal fade" id="info<?php echo $idPersona;?>">
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
                                                     <form method="POST" action="ABMusuario.php">
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
            <?php             
                              } 
            ?>  
                         </tbody>
                         <tfoot>
                             <tr align="center">
                                 <th colspan="12">Cantidad de registros encontrados: <?php echo $total_usuarios?></th>
                             </tr>
                         </tfoot>
                       </table>
                   </div>
       <?php 
            }
       ?>
        </div> 
        <div class="container" style="padding-top:40px">
            <nav arial-label="page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?php echo $_GET['pagina'] <= 1 ? 'disabled' : '' ?>">
                        <form action="buscarUser.php?pagina=<?php echo $_GET['pagina'] - 1 ?>" method="POST">
                                  <input id="usuario" name="usuario" value="<?php echo $dato;?>" style="width:70%" type="text" class="form-control" aria-label="Text input with dropdown button" hidden>
                                      <button name="buscar" value="buscar" class="page-link" id="button-addon2">Anteriror</button>
                                 
                            </form>
                     </li>
                        <?php for ($i = 1; $i <= $paginas; $i++) : ?>
                                 <li class="<?php echo $_GET['pagina'] == $i ? 'active' : '' ?>">
                                     <form action="buscarUser.php?pagina=<?php echo $i ?>" method="POST">
                                        <input id="usuario" name="usuario" value="<?php echo $dato;?>" style="width:70%" type="text" class="form-control" aria-label="Text input with dropdown button" hidden>
                                        <button name="buscar" value="buscar" class="page-link" id="button-addon2"><?php echo $i ?></button>
                                     </form>
                                 </li>
                        <?php endfor ?>
                                 <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>">
                                     <form action="buscarUser.php?pagina=<?php echo $_GET['pagina'] + 1 ?>" method="POST">
                                        <input id="usuario" name="usuario" value="<?php echo $dato;?>" style="width:70%" type="text" class="form-control" aria-label="Text input with dropdown button" hidden>
                                        <button name="buscar" value="buscar" class="page-link" id="button-addon2">Siguiente</button>
                                      </form>
                                 </li>
                </ul>
            </nav>
        </div>
    </div>
  </div>
<?php }else{
        header("location:buscarUsuarios.php");
      }
?>                           
</body>
</html>
<?php require 'footer.php'; ?>