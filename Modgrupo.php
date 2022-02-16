
<?php 

require("conexion.php");
require("header.php");
if(isset($_POST['Modificar']) && !empty($_POST['Modificar'])){
   $idgrupo=$_POST['idGrupo'];
   $select=mysqli_query($conexion,"SELECT idGrupo,nombreGrupo FROM grupos WHERE idGrupo=$idgrupo");
   while($r=mysqli_fetch_array($select)){
       $idgrupo=$r['idGrupo'];
       $grupo = $r['nombreGrupo'];
   }
      
?>
<div class="container">
        <div class="row">
              <div class="col-md-12" style="padding-top:60px;">
                    <form enctype="multipart/form-data" id="fupForm" class="permisos">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Crear grupo</label>
                                <input type="text" name="nombreGrupo" value="<?php echo $grupo;?>">
                                <input type="text" class="form-control" name="Modificar" id="Modificar" value="Modificar" hidden>
                                <input type="text" class="form-control" name="idGrupo" id="idGrupo" value="<?php echo $idgrupo;?>" hidden>
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
                                                                            
                                            while($r=mysqli_fetch_array($permisos)){
                                                $permisoschek=mysqli_query($conexion,"SELECT p.nombrePermiso FROM grupospermisos AS gp, permisos AS p 
                                                WHERE gp.idPermiso=p.idPermiso
                                                AND gp.idGrupo=$idgrupo");
                                                echo '<input type="checkbox" name="idPermiso[]" value="'.$r["idpermiso"].'"';
                                                while($rs=mysqli_fetch_array($permisoschek)){
                                                    $perm=$rs['nombrePermiso'];
                                     
                                                   if($r['nombrePermiso']==$perm){ echo 'checked'; }
                                                }
                                                echo '>'.$r["nombrePermiso"].'<br>';
                                            }
                                                
                                        }
                                          
                                   ?>
                            </div>
                            <div class="col-md-12" align="center" style="padding-top:30px">
                                 <button type="submit" class="btn botonpermisos" >Modificar</button>
                            </div>
                        </div>
                   </form>
             </div>
        </div>
 </div>
 <?php } ?>
 <script type="text/javascript" src="js/ABMgrupos.js"></script>
 <?php if(isset($_GET['estado']) && $_GET['estado']==1){
           echo "<script>alert('grupo creado con exito')</script>";
       }
 ?>
