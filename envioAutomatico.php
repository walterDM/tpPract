<?php  	
require 'conexion.php';	
require 'phpExcel.php';
?>
<script type="text/javascript">
	function totalEP(){
		var total=0;
		<?php 
		$select ="SELECT * from estadospedidos where idEstado=1";
		$queryTEP=mysqli_query($conexion,$select);

		$cantidadEP = mysqli_num_rows($queryTEP);
		?>
		total='<?php echo $cantidadEP ?>';
		total= parseInt(total);
		return total;
	}

	var ejecutar=setInterval(enviar, 20000);
	var cantidadTEP=  totalEP();




	function enviar(){


		<?php
		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\Exception;

		require 'phpmailer/Exception.php';
		require 'phpmailer/PHPMailer.php';
		require 'phpmailer/SMTP.php';


		$selectEP="SELECT ep.idPedidoProveedor, ep.idContactoProveedor from estadospedidos as ep where idEstado=1 limit 0,3";
		$queryEP=mysqli_query($conexion,$selectEP);
		while ($row=mysqli_fetch_array($queryEP)) {
			$idPedido=$row['idPedidoProveedor'];
			$idCP=$row['idContactoProveedor'];

			//llamar Funcion Export la cual se encarga de crear el excel a enviar
			export($idPedido);

			$selectCP="SELECT cp.idProveedor, cp.descripcion from contactosproveedores as cp where idContactoProveedor=$idCP";
			$queryCP=mysqli_query($conexion,$selectCP);
			while ($rs=mysqli_fetch_array($queryCP)) {
				$idProveedor=$rs['idProveedor'];
				$emailProv=$rs['descripcion'];
			}

// Instantiation and passing `true` enables exceptions
			$mail = new PHPMailer(true);

//$sql=mysqli_query($conexion,"INSERT INTO fechas VALUES(00,'$fecha_inicio')");
			try {
			//Server settings
			$mail->SMTPDebug = 0;                      // Enable verbose debug output
			$mail->isSMTP();                                            // Send using SMTP
			$mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
			$mail->Username   = 'tuspelisfc@gmail.com';                     // SMTP username
			$mail->Password   = 'Pelisfc_1997';                             // SMTP password
			$mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);                              
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
			$mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

		 //Recipients
			$mail->setFrom('tuspelisfc@gmail.com', 'noReply');
			$mail->addAddress($emailProv);     // Add a recipient
		//$mail->addAddress('ellen@example.com');               // Name is optional


		 // Attachments
			$mail->addAttachment('archivos/Pedido__'.$idPedido.'.xlsx');         // Add attachments
			// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		// Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'Solicitud de Pedido GestiStock';
			$mensajeHtml = nl2br('¨Pedido');
			$mail->Body  = "<html> 
			<head>
			<meta charset='utf-8'>
			</head>
			<body> 
			<h1 align='center'>GestiStock</h1>
			<div style='background:black;color:white;padding:20px'><h2>Solicitud de Pedido GestiStock</h2></div>
			<p>Buenos dias se le deja adjunto PDF con los productos solicitados para reponer nuestro Stock. ATTE: Gesti Stock </p>

			</body> 
			</html>
			<br />";
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			$mail->send();

		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";

			exit();
		}
		if ($mail) {
			$alterEP="UPDATE `estadospedidos` SET `idEstado`=2 WHERE idPedidoProveedor=$idPedido";
			$queryAEP=mysqli_query($conexion,$alterEP);
			borrarArchivo($idPedido);
			
		}

}//end while

?>
if (cantidadTEP==0) {
	clearInterval(ejecutar);
}
cantidadTEP=cantidadTEP-1;
if (cantidadTEP<0) {
	cantidadTEP=0;
}
}
</script>


