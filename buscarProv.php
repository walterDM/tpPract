
 <?php 
 if(isset($_POST['buscar']) && !empty($_POST['buscar'])){
  if(!isset($_GET['pagina'])){
    header("location:buscarProv.php?pagina=1");
  }
  require("header.php");
  require("conexion.php");    
  ?>
 
   <div class="row">
    <div class="col-md-12" align="center" style="padding-top:20px">
      <form action="buscarProv.php?pagina=1" method="POST">
       <div class="input-group mb-3">
        <input id="empresa" name="empresa" style="width:70%" type="text" class="form-control" aria-label="Text input with dropdown button" placeholder="Ingrese el proveedor o empresa" required>
        <div class="input-group-append">
         <button name="buscar" value="buscar" style="border-color: #e0e0e0;background:white" class="btn btn-outline-warning" id="button-addon2"><i class="fas fa-search"></i></button>
       </div>
     </div>
   </form>
 </div>
 <br><br>
 <div class="col-md-12">
  <?php if (isset($_GET['pagina'])) {
    $dato=$_POST['empresa'];
    $consulta=mysqli_query($conexion,"SELECT empresa FROM proveedores WHERE idProveedor='$dato'"); 
    while($r=mysqli_fetch_array($consulta)){$user=$r['empresa'];}
    $sql =mysqli_query($conexion,"SELECT * FROM proveedores WHERE (empresa LIKE'$dato%') ");
    $usuarios_x_pag = 2;
    $total_usuarios = mysqli_num_rows($sql);
    $paginas = $total_usuarios / $usuarios_x_pag;
    $paginas = ceil($paginas);
    $iniciar = ($_GET['pagina'] - 1) * $usuarios_x_pag;
    $select = mysqli_query($conexion, "SELECT * FROM proveedores WHERE (empresa LIKE'$dato%') limit $iniciar,$usuarios_x_pag");

    //$select2 = mysqli_query($conexion, "SELECT descripcion FROM contactosProveedores WHERE (empresa LIKE'$dato%') limit $iniciar,$usuarios_x_pag");
    ?>
    <div id="result" style="border: 1px solid white;overflow-y: scroll;background:#fafafa;padding-top:15px">
     <table class="table striped" style="background:#fafafa;height:300px">
       <thead>
         <th>Empresa</th>
         <th>Direccion</th>
         <th>Cuit</th>
         <th>Descripcion</th>
         <th>Telefono</th>
         <th>Email</th>
         <th></th>
         <th></th>
       </thead>
       <tbody>
        <?php 
        while($row=mysqli_fetch_array($select)){
         $idProveedor=$row['idProveedor'];
         // $select2=mysqli_query($conexion,"SELECT descripcion FROM contactosProveedores WHERE idProveedor={$row['idProveedor']}");
        $consulta="SELECT * FROM proveedores WHERE idProveedor='$idProveedor'";
        $sql1=mysqli_query($conexion,"SELECT idTipoContacto FROM tiposcontactos WHERE descripcion='email'");
        while($r=mysqli_fetch_array($sql1)){$idTipoMail=$r['idTipoContacto'];}
                                   $consulta1=mysqli_query($conexion,"SELECT descripcion FROM contactosproveedores WHERE idProveedor=$idProveedor AND idTipoContacto=$idTipoMail");
                                   while($r=mysqli_fetch_array($consulta1)){
                                    $Mail=$r['descripcion'];
                                  }
                                   $sql2=mysqli_query($conexion,"SELECT idTipoContacto FROM tiposcontactos WHERE descripcion='telefono'");
                                   while($r=mysqli_fetch_array($sql2)){
                                    $idTipoTelefono=$r['idTipoContacto'];
                                  }
                                   $consulta2=mysqli_query($conexion,"SELECT descripcion FROM contactosproveedores WHERE idTipoContacto=$idTipoTelefono AND idProveedor=$idProveedor");
                                   while($r=mysqli_fetch_array($consulta2)){
                                    $Telefono=$r['descripcion'];}

        $consulta4=mysqli_query($conexion,"SELECT pc.descripcion FROM contactosProveedores AS pc,proveedores AS p WHERE cp.idProveedor=$idProveedor AND cp.idTipoContacto=$idTipoTelefono");
     

         $select3=mysqli_query($conexion,"SELECT g.nombreGrupo FROM grupos AS g,gruposusuarios AS gp WHERE g.idGrupo=gp.idGrupo AND gp.idPersona={$row['idProveedor']}");
         ?>
         <tr>
          <td style="padding-top:30px"><?php echo $row['empresa'];?></td>
          <td style="padding-top:30px"><?php echo $row['direccion'];?></td>
          <td style="padding-top:30px"><?php echo $row['cuit'];?></td>
          <td style="padding-top:30px"><?php echo $row['descripcion'];?></td>
   
          
          <td style="padding-top:30px"><?php if (!empty($Telefono)) {
            echo $Telefono;
          }else{echo "no posee";}?>
          </td>
          <td style="padding-top:30px"><?php if(!empty($Mail)){echo $Mail;} else{echo "no posee";}?>
          </td>
       



          <?php                     
          $grupo=mysqli_query($conexion,"SELECT p.nombrePermiso FROM permisos AS p, grupospermisos AS up WHERE (p.nombrePermiso='buscar proveedor' OR p.nombrePermiso='baja proveedor' OR p.nombrePermiso='modificar proveedor') AND p.idPermiso=up.idPermiso AND up.idGrupo='$idGrupo'");
          while($r=mysqli_fetch_array($grupo)){
            $nombrePermiso=$r['nombrePermiso'];
            if($nombrePermiso=="baja proveedor"){
              ?>
              <td><a href="#" style="border-radius:30px;font-size:20px" class="btn btn-light" data-toggle="modal" data-target="#info<?php echo $idProveedor; ?>"><i class="fas fa-trash-alt"></i></a></td>
            <?php                           }
            if($nombrePermiso=="modificar proveedor"){
             $select4=mysqli_query($conexion,"SELECT g.nombreGrupo FROM grupos AS g,gruposusuarios AS gp WHERE g.nombreGrupo!='PROVEEDOR' AND g.idGrupo=gp.idGrupo AND gp.idProveedor={$row['idProveedor']}");
               //while($r=mysqli_fetch_array($select4)){
             ?>
             <td>
               <form method="POST" action="modificarProveedor.php">
                <button style="border-radius:30px;font-size:20px" type="submit" name="idProveedor" value="<?php echo $row['idProveedor'];?>" class="btn btn-light"><i class="fas fa-pencil-alt"></i></button>
              </form>
            </td>
            <?php                               
          }
                }

        ?>
      </tr>
      <div data-backdrop="static"  class="modal fade" id="info<?php echo $idProveedor;?>">
       <div class="col-md-12 modal-dialog" >
         <div class="modal-content">
          <div class="modal-header">
           <h4 class="modal-title">Baja Usuario</h4>
           <button type="button" class="close" data-dismiss="modal">X</button>
         </div>
         <div class="col-md-12" style="background:#e0e0e0">
           <div class="modal-body" >
            <h5 align="center">Estas seguro que deseas eliminar el siguiente usuario:</h5>
            <h6 align="center"><?php echo $row['empresa'];?></h6>
            <div align="center">
             <form method="POST" action="ABMProv.php">
              <input type="text" class="form-control" name="idProveedor" id="idProveedor" value="<?php echo $row['idProveedor'];?>" hidden>
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
   <th colspan="9">Cantidad de registros encontrados: <?php echo $total_usuarios?></th>
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
                        <form action="buscarProv.php?pagina=<?php echo $_GET['pagina'] - 1 ?>" method="POST">
                                  <input id="empresa" name="empresa" value="<?php echo $dato;?>" style="width:70%" type="text" class="form-control" aria-label="Text input with dropdown button" hidden>
                                      <button name="buscar" value="buscar" class="page-link" id="button-addon2">Anteriror</button>
                                 
                            </form>
                     </li>
                        <?php for ($i = 1; $i <= $paginas; $i++) : ?>
                                 <li class="<?php echo $_GET['pagina'] == $i ? 'active' : '' ?>">
                                     <form action="buscarProv.php?pagina=<?php echo $i ?>" method="POST">
                                        <input id="empresa" name="empresa" value="<?php echo $dato;?>" style="width:70%" type="text" class="form-control" aria-label="Text input with dropdown button" hidden>
                                        <button name="buscar" value="buscar" class="page-link" id="button-addon2"><?php echo $i ?></button>
                                     </form>
                                 </li>
                        <?php endfor ?>
                                 <li class="page-item <?php echo $_GET['pagina'] >= $paginas ? 'disabled' : '' ?>">
                                     <form action="buscarProv.php?pagina=<?php echo $_GET['pagina'] + 1 ?>" method="POST">
                                        <input id="empresa" name="empresa" value="<?php echo $dato;?>" style="width:70%" type="text" class="form-control" aria-label="Text input with dropdown button" hidden>
                                        <button name="buscar" value="buscar" class="page-link" id="button-addon2">Siguiente</button>
                                      </form>
                                 </li>
                </ul>
            </nav>
        </div>
</div>

<?php }else{
  header("location:buscarProveedor.php");
  }?>                           
  

<?php require 'footer.php'; ?>