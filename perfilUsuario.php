<?php require 'header.php';
$id=$_SESSION['login'];

$queryDP="SELECT p.numDocumento as dni, p.nombre, p.apellido, p.fechaNac as fn, p.usuario from personas as p where idPersona='$id'";
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

<div class="row">
    <div class="col-md-3">
        <label>DNI</label>
        <div>
            <input type="text"  disabled value=<?php echo $rs['dni']; ?> >
        </div>
    </div>
    <div class="col-md-3">
        <label>Nombre</label>
        <div>
            <input type="text" value=<?php echo $rs['nombre']; ?>>
        </div>
    </div>
    <div class="col-md-3">
        <label>apellido</label>
        <div>
            <input type="text" value=<?php echo $rs['apellido']; ?>>
        </div>
    </div>       
    <div class="col-md-3">
        <label>fecha Nac.</label>
        <div>
            <input type="text" disabled placeholder=<?php echo $fecha; ?>>
        </div>
    </div>
   
</div>
<?php }?>
<br>
<div class="row">
    <div class="col-md-3">
        <h3><u>Direcciones</u></h3>
    </div>
</div>

<br>
    <div class="row justify-content-center">
			<div class="col-md-12">
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
?>