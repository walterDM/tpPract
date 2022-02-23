<?php require 'header.php';
$id=$_SESSION['login'];

$queryDP="SELECT p.numDocumento as dni, p.nombre, p.apellido, p.fechaNac as fn, p.usuario as user, p.contrasenia as pass from personas as p where idPersona='$id'";
$consultaDP= mysqli_query($conexion,$queryDP);

$consultaDir="SELECT d.idDireccion, d.calle, d.altura, d.piso, d.dpto, p.nombrePais pais, pr.nombreProvincia prov, c.nombreCiudad ciudad, td.descripcion tdd FROM direcciones d
                JOIN tiposdomicilios td ON d.idTipoDomicilio=td.idTipoDomicilio 
                JOIN ciudades c on d.idCiudad=c.idCiudad 
                JOIN provincias pr on pr.idProvincia=c.idProvincia 
                JOIN paises p on p.idPais=pr.idPais 
                where d.idPersona= $id ";
$selectDir=mysqli_query($conexion,$consultaDir);

$consultaContacto="SELECT pc.idPersonaContacto idPc, pc.descripcion pcd, tc.descripcion tcd FROM personascontactos pc 
                    JOIN tiposcontactos tc on tc.idTipoContacto=pc.idTipoContacto WHERE idpersona=$id";
$selectCt= mysqli_query($conexion,$consultaContacto);
 ?>

<div class="row justify-content-center">
    <div class="col-md-2">
        <h1><u>Perfil</u></h1>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-12">
        <h3><u>Datos Personales </u></h3>
    </div>
</div>
<br>
<?php while ($rs=mysqli_fetch_array($consultaDP)) { 
            $fecha=date('d/m/Y',strtotime($rs['fn']));?>
<form action="modUsuario.php" method="POST">
   <div class="row">
       <div class="col-md-3">
            <div class="form-group">
                <input type="text"  name="id" id="id" value=<?php echo $id?> hidden>
                <label for="dni">DNI</label>
                <input type="text" class="form-control" id="dni" name="dni" value="<?php echo $rs['dni']?>"disabled >
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="fn">Fecha de Nacimiento</label>
                <input type="text" class="form-control" id="fn" name="fn" value="<?php echo $fecha?>"disabled>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $rs['nombre']?>" require>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $rs['apellido']?>" require>
            </div>
        </div>
    </div> 
    <div class="row">
       <div class="col-md-3">
            <div class="form-group">
                <label for="user">Usuario</label>
                <input type="text" class="form-control" id="user" name="user" value="<?php echo $rs['user']?>"require>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="passAnt">Contraseña anterior</label>
                <input type="password" class="form-control" id="passAnt" name="passAnt">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="newP">contraseña nueva</label>
                <input type="password" class="form-control" id="newP" name="newP">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="newRP">Re-contraseña nueva</label>
                <input type="password" class="form-control" id="newRP" name="newRP">
            </div>
        </div>
    </div>
  <button type="submit" class="btn btn-primary" name="btnMod" value=1 id="btn2">Submit</button>
</form>
<?php }?>
<br>
<div class="row">
    <div class="col-md-3">
        <h3><u>Direcciones</u></h3>
    </div>
</div>

<br>
    <div class="row justify-content-center">
			<div class="col-md-10">
			   <div style="background: white">
				  <table class="table striped" style="background:#fafafa;white:70%">
					<tr>
						 <th>Tipo Domicilio</th>
						 <th>calle y altura</th>
						 <th>piso</th>
						 <th>departamento</th>
						 <th>País</th>
						 <th>Provincia</th>
                         <th>Ciudad</th>
                         <th>Acciones</th>
					</tr>
                    <?php while ($rs=mysqli_fetch_array($selectDir)) {?>
                       <?php
                            $idDireccion=$rs['idDireccion'];
                       ?>
                        <tr>
                            <td><?php echo $rs['tdd']?></td>
                            <td><?php echo $rs['calle']."  ".$rs['altura']?></td>
                            <td><?php echo $rs['piso']?></td>
                            <td><?php echo $rs['dpto']?></td>
                            <td><?php echo $rs['pais']?></td>
                            <td><?php echo $rs['prov']?></td>
                            <td><?php echo $rs['ciudad']?></td>
                            <td>
                                <form method="POST" action="modificarDireccion.php">
                                    <button style="border-radius:30px;font-size:20px" type="submit" name="idDireccion" value="<?php echo $idDireccion;?>" class="btn btn-light"><i class="fas fa-pencil-alt"></i></button>
                                </form>
                            </td>
                        </tr>

                        <?php }?>
                  </table>  
                </div>  
            </div>
     </div>   
<br>
<div class="row">
    <div class="col-md-3">
        <h3><u>Contacto</u></h3>
    </div>
</div>
<br>
<div class="row justify-content-center">
			<div class="col-md-8">
			   <div style="background: white">
				  <table class="table striped" style="background:#fafafa;white:70%">
					<tr>
						 <th>Tipo Contacto</th>
						 <th>Detalle</th>
                         <th>Acciones</th>
					</tr>
                    <?php while ($rs=mysqli_fetch_array($selectCt)) {?>
                       
                        <tr>
                            <td><?php echo $rs['tcd']?></td>
                            <td><?php echo $rs['pcd']?></td>
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editCt<?php echo $rs['idPc'];?>">
                                    Modificar
                                </button>
                            </td>
                        </tr>
                        <!--Ventana Modal para Actualizar--->
                        <?php  include('ModalEditarCt.php'); ?>
                        <?php }?>
                  </table>  
                </div>  
            </div>
     </div>   

<?php
     require 'footer.php';
     if (isset($_GET['passD'])&& $_GET['passD']==1) {
        echo "<script type='text/javascript'>alert('la nueva contraseña no coincide');</script>";
      }
      if (isset($_GET['passD'])&& $_GET['passD']==2) {
        echo "<script type='text/javascript'>alert('la nueva contraseña es igual a la antigua');</script>";
      }
      if (isset($_GET['mod'])&& ($_GET['mod']==1 || $_GET['mod']==2)) {
        echo "<script type='text/javascript'>alert('Datos modificados correctamente');</script>";
      }
?>