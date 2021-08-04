<?php 
$id=$_POST['idtipo'];
$fd = date("Y-m-d", strtotime($_POST['fDesde']));
$fh = date("Y-m-d", strtotime($_POST['fHasta']));


header("location:reportesCaducidad.php?id=$id&fDesde=$fd&fHasta=$fh&pagina=1");
?>