<?php 
require("conexion.php");
require("header.php");

// $select2=mysqli_query($conexion,"SELECT * FROM grupos");

?>
<!DOCTYPE html>
<html>
   <head>
      <title>Inicio</title>
        
        
   </head>
   <body>
    <div class="container ">
      <div class="row" align="center" style="padding-top:20px">
       <div class="col-md-12 info formContacto">
         <form  method="POST" action="enviarEmail.php"  onsubmit="return valida2(this)">
         
             <div class="form-group">
               <label>Nombre</label>
               <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese su nombre">
             </div>
          

           <!-- <div class="col-md-6"> -->
             <div class="form-group">
               <label>Email</label>
               <input type="email" class="form-control" name="correo" id="correo" placeholder="Ingrese su email">
             </div>
         

           
             <div class="form-group">
               <label>Mensaje</label>
                <textarea class="form-control" name="mensaje"></textarea>
             </div>
         

         
            
               <div class="form-group" align="center">
                 <button name="enviarEmail" value="enviarEmail" id="btn2" class="btn btn-light" onclick="valida2()">Enviar</button>
                 <button name="enviar" value="enviar" id="btn2" class="btn btn-light" onclick="valida2()">Cancelar</button>
               </div>
             
         </form>
       </div>
 

</div>
</div> 
<?php 
        if (isset($_GET['enviar'])&& $_GET['enviar']==1) {
          echo "<script type='text/javascript'>alert('fue enviado');</script>";
        }
        if (isset($_GET['error'])&& $_GET['error']==1) {
          echo "<script type='text/javascript'>alert('no enviado');</script>";
        }

      
       
       ?>
   </body>
</html>