
<?php 
      require("header.php");
      require("conexion.php");
      
?>
<div class="container">
        <div class="row">
              <div class="col-md-12" style="padding-top:60px;">
                   <form action="permisos.php" method="post" class="permisos">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Crear grupo</label>
                                <input type="text" name="nombreGrupo">
                                <a style="float:right;width:15%" href="listarPermisos.php" class="btn botonpermisos">Listar</a>
                            </div>
                            <div class="col-md-12" style="padding-top:30px;">
                                <?php   
                                    $agrupamiento=mysqli_query($conexion,"SELECT idGestiones, nombreGestion FROM gestiones ORDER BY idGestiones ASC");
                                    while($PermisosGestiones=mysqli_fetch_array($agrupamiento)){
                                ?>
                            </div>
                            <div class="col-md-6 gestiones">
                                    <p><?php echo $PermisosGestiones['nombreGestion']?></p>
                                    <?php   
                                            $permisos=mysqli_query($conexion,"SELECT p.idpermiso, p.nombrePermiso FROM gestiones AS g, gestiones_permisos AS gp,permisos AS p
                                                                            WHERE g.idGestiones = gp.idGestiones
                                                                            AND gp.idpermiso=p.idpermiso
                                                                            AND g.idGestiones=" . $PermisosGestiones['idGestiones']);
                                                                            
                                            while($r=mysqli_fetch_array($permisos)){?>
                                                <input type="checkbox" name="nombrePermiso[]" value="<?php echo $r['nombrePermiso']?>"><?php echo $r['nombrePermiso']?><br>
                                   <?php    }
                                    }      
                                   ?>
                            </div>
                            <div class="col-md-12" align="center" style="padding-top:30px">
                                <button type="submit" class="btn botonpermisos"  name="alta" value="alta">Asignar</button>
                            </div>
                        </div>
                   </form>
             </div>
        </div>
 </div>
 <?php if(isset($_GET['estado']) && $_GET['estado']==1){
           echo "<script>alert('grupo creado con exito')</script>";
       }
 ?>
