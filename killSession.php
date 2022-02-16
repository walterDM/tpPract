<?php 
if(isset($_POST['KillSession']) && !empty($_POST['KillSession'])){ 
    session_start();
    session_destroy();
    $id_usuario=0;
    $nombre_usuario="";
    
    
    
   echo "<script>window.location.href ='index.php';</script>";
}


?>