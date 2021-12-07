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
   echo '<div class="container">
   <div class="row">
         <div class="col-md-12" style="padding-top:60px;">
              <form action="ABMusuario.php" method="post" class="permisos">
                   <div class="row">
                       <div class="col-md-12">
                           <label>Crear grupo</label>
                           <input type="text" name="nombreGrupo" value='.$grupo.'>
                           <input type="text" name="idGrupo" value='.$idgrupo.' hidden>
                           <a style="float:right;width:15%" href="listarPermisos.php" class="btn botonpermisos">Listar</a>
                       </div>
                       <div class="col-md-12" style="padding-top:30px;">';
                            $agrupamiento=mysqli_query($conexion,"SELECT idGestiones, nombreGestion FROM gestiones ORDER BY nombreGestion");
                            
                        
                            while($PermisosGestiones=mysqli_fetch_array($agrupamiento)){
                              
                 echo '</div>
                       <div class="col-md-6 gestiones">
                          <p>'.$PermisosGestiones["nombreGestion"].'</p>';   
                               $permisos=mysqli_query($conexion,"SELECT p.idPermiso, p.nombrePermiso FROM permisos AS p, gestiones AS g,gestiones_permisos AS gp
                                                                 WHERE gp.idGestiones = g.idGestiones
                                                                   AND gp.idPermiso=p.idPermiso
                                                                   AND g.idGestiones=" . $PermisosGestiones['idGestiones']);

                               
                                                         
                               while($r=mysqli_fetch_array($permisos)){
                                $permisoschek=mysqli_query($conexion,"SELECT p.nombrePermiso FROM permisos AS p, grupospermisos AS gp
                                WHERE gp.idPermiso=p.idPermiso
                                  AND gp.idGrupo=$idgrupo");
                                  echo '<input type="checkbox" name="idPermiso[]" value="'.$r["idPermiso"].'"';
                                  while($rs=mysqli_fetch_array($permisoschek)){$perm=$rs['nombrePermiso'];
                                     
                                       if($r['nombrePermiso']==$perm){ echo 'checked'; }
                                  }
                                  echo '>'.$r["nombrePermiso"].'<br>';
                               }
                            
                            }      
                 echo '</div>
                       <div class="col-md-12" align="center" style="padding-top:30px">
                            <button type="submit" class="btn botonpermisos"  name="modificarGrupo" value="modificarGrupo">Modificar</button>
                       </div>
                   </div>
            </form>    
   </div>
</div>';
}

?>