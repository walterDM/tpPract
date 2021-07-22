<?php 
require("class.phpmailer.php");
require("class.smtp.php");
require("conexion.php");
$email=$_POST['correo'];
$info=$_POST['mensaje'];
$msg=$_POST['cbxMensaje'];
$mensaje="consultas de gestistock";

    include("sendmail.php");//Mando a llamar la funcion que se encarga de enviar el correo electronico
//        $mail->SMTPOptions='ssl';
        $smtpHost = "smtp.gmail.com";  // Dominio alternativo brindado en el email de alta 
        $smtpUsuario = ("gestistock21@gmail.com");  // Mi cuenta de correo
        $smtpClave = "GestiStock_2021";  // Mi contraseña
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->Port = 587; 
        $mail->IsHTML(true); 
        $mail->CharSet = "utf-8";
   
        // VALORES A MODIFICAR //
        $mail->Host = $smtpHost; 
        $mail->Username = $smtpUsuario; 
        $mail->Password = $smtpClave;
        $mail->setFrom = $smtpUsuario;
        $mail->FromName= "tuspelisfc"; // Email desde donde envío el correo.
        $mail->AddAddress($smtpUsuario); // Esta es la dirección a donde enviamos los datos del formulario
        $mail->Subject = "consultas GestiStock"; // Este es el titulo del email.
        $mensajeHtml = nl2br($mensaje);
        $mail->Body = "<html> 
                           <body> 
                              <div style='padding:20px'>
                                <h1 style='background:#ffe0b2;color:white;' align='center'>GestiStock</h1>
                                <h2>consulta de incidencias</h2>
                                <p>email: {$email}</p>
                                <p>tipo de consulta: {$msg}</p>
                                <p>mensaje: {$info}</p>
                              </div>
                          
                           </body> 
                       </html>
                       <br />"; // Texto del email en formato HTML
        $mail->AltBody = "{$mensaje} \n\n "; // Texto sin formato HTML
        $mail->SMTPOptions = array(
        'ssl' => array(
           'verify_peer' => false,
           'verify_peer_name' => false,
           'allow_self_signed' => true
          )
        );
        $estadoEnvio = $mail->Send(); 
        if($estadoEnvio){              
            header("location:contacto.php?enviar=1");
        } else {
        
               header("location:contacto.php?error=1");
              exit();
        }

?>