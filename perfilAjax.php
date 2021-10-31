<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
require("conexion.php");
   $idPersona=$_SESSION['login'];
   $select=mysqli_query($conexion,"SELECT idTipoTarjeta,descripcion FROM tipostarjetas WHERE idPersona=$idPersona");
   $select5=mysqli_query($conexion,"SELECT idTipoTarjeta,descripcion FROM tipostarjetas ORDER BY descripcion ASC");
if ($_REQUEST['cod']==2){
  echo "<strong>Aries:</strong> Hoy los cambios serán físicos, personales, de carácter, Te sentirás impulsivo y tomarás  iniciativas. Período en donde considerarás unirte a agrupaciones de beneficencia, o de ayuda a los demás.";
}
if ($_REQUEST['cod']==1){
  echo '<form action="altaTarjetaCliente.php" method="POST">
  <div class="row">
     <div class="col-md-12">
     <div class="form-group">
           <label>Tipo de tarjeta</label>
           <select class="form-control" id="tipotarjetas" name="tipotarjetas">';
              while ($rsTP = $select5->fetch_assoc()){
                echo '<option value="'.$rsTP['idTipoTarjeta'].'">'.$rsTP['descripcion'].'</option>';
              }
           echo '</select>
        </div>
     
       <div class="row">
         <div class="form-group col-md-12">
           <label>Numero Tarjeta</label>
           <input type="text" class="form-control" name="numTarjeta" id="numTarjeta"  placeholder="ingrese el numero Tarjeta">
         </div>
         <div class="form-group col-md-12">
           <label>Fecha vencimiento</label>
           <input type="date" class="form-control" name="fechaVencimiento" id="fechaVencimiento"  placeholder="ingrese fecha vencimiento">

           <input type="text" class="form-control" name="idPersona" id="idPersona" value="<?php echo $idPersona;?>" hidden>
         </div>
     
       </div>
     
        <div class="row">
           <div class="form-group col-md-12">
              <label>Codigo de seguridad</label>
              <input type="text" class="form-control" name="codBanco" id="codBanco"  placeholder="ingrese el codigo">
           </div>
         
        </div>
     </div>
     <div class="col-md-12" align="center">
       <button style="width: 50%;" id="btn2" name="tarjetascliente" value="tarjetascliente" class="btn btn-light">Agregar tarjeta </button>
     </div>
  </div> 
</form>';
}
if ($_REQUEST['cod']==3){
  echo "<strong>Géminis:</strong> Los asuntos de hoy tienen que ver con las amistades, reuniones, actividades con ellos. Día esperanzado, ilusiones. Mucha energía sexual y fuerza emocional. Deseos difíciles de controlar.";
}
if ($_REQUEST['cod']==4){
  echo "<strong>Cancer:</strong> Este día la profesión y las relaciones con superiores y con tu madre serán de importancia. Actividad en relación a estos temas. Momentos positivos con compañeros de trabajo. Actividad laboral agradable.";
}
?>