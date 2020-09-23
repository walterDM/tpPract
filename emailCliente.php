<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'conexion.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
$user=$_POST['usuario'];
$asunto=$_POST['asunto'];
$msg=$_POST['mensaje'];
$mensaje="recupere su clave";

if (isset($_POST['send'])&& !empty($_POST['send'])) {
	$consulta=mysqli_query($conexion,"SELECT idPersona FROM personascontactos WHERE descripcion='$user'");
	if($r=mysqli_fetch_array($consulta)){
		$idPersona=$r['idPersona'];
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
		    $mail->addAddress($user);     // Add a recipient
		    //$mail->addAddress('ellen@example.com');               // Name is optional
		    

		    // Attachments
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		    // Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = $asunto;
		    $mensajeHtml = nl2br($mensaje);
		    $mail->Body  = "<html> 
		    <head>
		    <meta charset='utf-8'>
		    </head>
		    <body> 
		    <h1 align='center'>GestiStock</h1>
		    <div style='background:black;color:white;padding:20px'><h2>$asunto</h2></div>
		    <p>mensaje: $msg</p>
		    </body> 
		    </html>
		    <br />";
		    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		    $mail->send();
		    header("location:listarClientes.php?enviado=1");
		} catch (Exception $e) {
		    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			header("location:listarClientes.php?enviado=2");
			exit();
		}

		
	}else{
		header("location:listarClientes.php?enviado=3");
	}
}//termina if del 

?>