<?php require 'header.php';
$id=$_SESSION['login'];

$queryDP="SELECT p.numDocumento as dni, p.nombre, p.apellido, p.fechaNac as fn, p.usuario from personas as p where idPersona='$id'";
$consultaDP= mysqli_query($conexion,$queryDP);

$select3=mysqli_query($conexion,"SELECT idPais,nombrePais FROM paises ORDER BY nombrePais ASC");
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
    
       
    <?php while ($rs=mysqli_fetch_array($consultaDP)) { 
        $fecha=date('d/m/Y',strtotime($rs['fn']));?>
        <div class="col-md-2"></div>
        <div class="col-md-10">
            <div class="row justify-content-center">
                <div class="col-md-2">
                    <label>DNI</label>
                    <div>
                    <input type="text"  disabled value=<?php echo $rs['dni']; ?> >
                    </div>
                </div>
                <div class="col-md-2">
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
            <br>
        </div>
        <div class="row justify-content-center">
            
         </div>

   <?php } ?>
   <br>


   <!-- <div class="row justify-content-center">
        <div class="col-md-4">
        <div class="form-group">
            <label>Pais</label>
            <select class="form-control" id="cbxpais" name="cbxpais">
                    <option>Seleecione Pais</option>
                    <?php //while ($rsTP = $select3->fetch_assoc()){?>
                        <option><?php //echo $rsTP['nombrePais'];?></option>
                        <?php //} ?>
            </select>
        </div>
        <div class="form-group">
            <label>Ciudad</label>
            <select class="form-control" id="cbxciudad" name="cbxciudad">
                <option>Seleccione ciudad</option>
            </select>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label>Calle</label>
                    <input type="text" class="form-control" name="calle" id="calle"  placeholder="ingrese calle">
                </div>
                <div class="form-group col-md-4">
                    <label>Altura</label>
                    <input type="text" class="form-control" name="altura" id="altura"  placeholder="ingrese altura">
                    <input type="text" class="form-control" name="idPersona" id="idPersona" value="<?php echo $idPersona;?>" hidden>
                </div>
            </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Provincia</label>
                    <select class="form-control" id="cbxprovincia" name="cbxprovincia">
                        <option>seleccione provincia</option>
                    </select>
                </div>
         <  /div>
        </div> -->
        <div>

    </div>












<script language="javascript">
    $(document).ready(function(){
        $("#cbxpais").change(function () {  
            $("#cbxpais option:selected").each(function () {
                id_estado = $(this).val();
                $.post("includes/getProvincia.php", { id_estado: id_estado }, function(data){
                    $("#cbxprovincia").html(data);
                });            
            });
        });
     $("#cbxprovincia").change(function () {    
            $("#cbxprovincia option:selected").each(function () {
                id_ciudad = $(this).val();
                $.post("includes/getCiudad.php", { id_ciudad: id_ciudad }, function(data){
                    $("#cbxciudad").html(data);
                });            
            });
        });
    });
    
    
    
 </script>
<?php require 'footer.php'; ?>
