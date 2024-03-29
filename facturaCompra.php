<?php 
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php'; 
require 'conexion.php';
include 'includes/plantillaF.php';
if (isset($_SESSION['factura']) && !empty($_SESSION['factura'])) {
	$idFactura=$_SESSION['factura'];
	$fechaP=date('d/m/Y');
	$pdf= new PDF();	
	$pdf->AddPage();
	$pdf->AliasNbPages();
//declaracion de numero de Factura	
	$querynFact="SELECT df.numFactura n,tf.descripcion as t
	FROM `datosfacturas` as df
	JOIN tiposfacturas as tf on tf.idTipoFactura=df.idTipoFactura
	WHERE idFactura = (
	SELECT MAX(idFactura) 
	FROM `datosfacturas` )";
	$rsnFact=mysqli_query($conexion,$querynFact);
	
	while ($rn=mysqli_fetch_array($rsnFact)) {
		$nFact=$rn['n'];
		$tFact=$rn['t'];
		$numFactura= "001-".$nFact;
		$filename='FacturaVenta_n°_'.$numFactura;
	}
	$cliente=$_SESSION['login'];
$nombreC=mysqli_query($conexion,"SELECT p.nombre, p.apellido,pc.descripcion from personas AS p
                                 JOIN personascontactos AS pc ON pc.idPersona = p.idPersona
                                 WHERE pc.idTipoContacto=1
								   AND p.idPersona=$cliente");
while ($r=mysqli_fetch_array($nombreC)) {
	$ncliente=$r['nombre']." ".$r['apellido'];
	$email=$r['descripcion'];
};
$calle=$_SESSION['calle'];
$altura=$_SESSION['altura'];
	$pdf->SetFillColor(255,255,255);
	

	
	

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(75,5,'Cliente: '.$ncliente,0,0,'i',1);
	$pdf->Cell(20,5,'',0,0,'C',1);
	$pdf->Cell(10,5,'',0,0,'C',1);
	$pdf->Cell(70,5,'Nro Factura: '.$numFactura,0,1,'i',1);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(75,5,'Domicilio: '.$calle." ".$altura,0,0,'i',1);
	$pdf->Cell(20,5,'',0,0,'C',1);
	$pdf->Cell(10,5,'',0,0,'C',1);
	$pdf->Cell(70,5,"Tipo Factura : ".$tFact,0,1,'i',1);
	

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(75,5,'',0,0,'C',1);
	$pdf->Cell(20,5,'',0,0,'C',1);
	$pdf->Cell(10,5,'',0,0,'C',1);
	$pdf->Cell(70,5,'Fecha de emision: '.$fechaP,0,1,'i',0);
	

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(75,5,'',0,0,'C',1);
	$pdf->Cell(20,5,'',0,0,'C',1);
	$pdf->Cell(10,5,'',0,0,'C',1);
	$pdf->Cell(70,5,'C.U.I.T: 30688980478',0,1,'i',0);
	

	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(75,5,'',0,0,'C',1);
	$pdf->Cell(20,5,'',0,0,'C',1);
	$pdf->Cell(10,5,'',0,0,'C',1);
	$pdf->Cell(70,5,'Inicio de actividades: 10/03/2020',0,1,'i',0);
	$pdf->SetFillColor(0,0,0);
  

	


//$pdf->Cell(33,6,"Tipo Factura : ".$tFact,0,0,'C',0);
//Datos Cliente

/*$y= $pdf->GetY();
$pdf->setXY(15,50);
$pdf->SetFillColor(232,232,232);
$pdf->Cell(45,6,"Cliente : ".$ncliente,0,0,'C',0);
//Dirreccion de entrega
$calle=$_SESSION['calle'];
$altura=$_SESSION['altura'];

$y=$pdf->GetY();
$pdf->Ln(6);
$pdf->SetFillColor(232,232,232);
$pdf->Cell(78,6,"Domicilio de Entrega : ".$calle." ".$altura,0,0,'C',0);*/

$pdf->Ln(10);
$pdf->SetFillColor(255, 175, 0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(75,10,'Producto',0,0,'C',1);
$pdf->Cell(10,10,'Cant.',0,0,'C',1);
$pdf->Cell(20,10,'Precio',0,0,'C',1);
$pdf->Cell(30,10,'Descuento',0,0,'C',1);
$pdf->Cell(40,10,'Importe',0,0,'C',1);



$pdf->Ln(12);
$totalC=0;
$queryFD="SELECT p.descripcion d,fd.precioUnitario pu,fd.cantidad c,p.idProducto,p.precio from facturadetalles fd JOIN productos as p on p.idProducto=fd.idProducto where idFactura=$idFactura";
$rsFD=mysqli_query($conexion,$queryFD);

while($rf=mysqli_fetch_array($rsFD)){ 
	$consulta=mysqli_query($conexion,"SELECT * FROM ofertas WHERE idProducto={$rf['idProducto']}");
	$subtotal=0;
	$subtotal2=0;
	$subtotales=0;
	$totalCant=0;
	$cantRest=0;
	$descuento=0;
	$cantidad=0;
	if(mysqli_num_rows($consulta)>0){  
	 while($rs = mysqli_fetch_array($consulta)){
		
		$calculo=($rf['pu']*$rs['descuento'])/100;
		$restoTotal=$rf['pu'] - $calculo;
		
		   for ($j=1; $j<=$rf['c'];$j++) {
			  if ($j % $rs['cantidad']==0){ 
				  for($k=1;$k<=100;$k++){
					if($rs['cantidad']*$k<=$rf['c']){
					   $cantRest=$rs['cantidad']*$k;
					   $subtotal=$restoTotal*$cantRest;
					}
			  }  }
		   }
		
		if ($rf['c'] % $rs['cantidad']!=0){
		   $totalCant=$rf['c'] - $cantRest;


			   $subtotal2=($totalCant*$rf['pu']);
		  
		}
		$subtotales = $subtotal+$subtotal2;
		$descuento=$rs['descuento'];
		$cantidad=$rs['cantidad'];
	    $cantDescuento=$restoTotal*$cantidad;
		
	 }
	}else{
	 $subtotales=$rf['c']*$rf['pu'];
	 
	
	}
	$select=mysqli_query($conexion,"SELECT * FROM ofertas WHERE idProducto={$rf['idProducto']}");
	$precio=number_format((float)$rf['pu'], 2, '.', '');
	$subTotal=number_format((float)$rf['c']*$rf['pu'], 2, '.', '');
	$pdf->Ln(4);
	$pdf->SetFillColor(255,255,255);
	$pdf->SetFont('Arial','B',8);
    $pdf->Cell(75,10,utf8_decode($rf['d']),0,0,'C',1);
	$pdf->Cell(10,10,$rf['c'],0,0,'C',1);
    $pdf->Cell(20,10,'$'.$precio,0,0,'C',1);
	if(mysqli_num_rows($select)>0){ 
	    $pdf->Cell(30,10,$cantidad.' X $'.$cantDescuento,0,0,'C',1);
	}else{
		$pdf->Cell(30,10,'Sin descuento',0,0,'C',1);
	}
    $pdf->Cell(40,10,'$'.$subtotales,0,0,'C',1);

$totalC+=$subtotales;
$pdf->Ln(4);
}
$pdf->Ln(5);


$pdf->Cell(75,10,'',0,0,'C',1);
$pdf->Cell(10,10,'',0,0,'C',1);
$pdf->Cell(20,10,'',0,0,'C',1);
$pdf->Cell(30,10,"subtotal",0,0,'C',1);
$pdf->Cell(40,10,'$'.number_format((float)$totalC, 2, '.', ''),0,0,'C',1);
$pdf->Ln(7);
$IVA=number_format((float)($totalC*21)/100, 2, '.', '');
$pdf->Cell(75,10,'',0,0,'C',1);
$pdf->Cell(10,10,'',0,0,'C',1);
$pdf->Cell(20,10,'',0,0,'C',1);
$pdf->Cell(30,10,"IVA 21.0%",0,0,'C',1);
$pdf->Cell(40,10,'$'.$IVA,0,0,'C',1);
$pdf->Ln(9);
$total=number_format((float)$totalC+$IVA, 2, '.', '');
$pdf->Cell(75,10,'',0,0,'C',1);
$pdf->Cell(10,10,'',0,0,'C',1);
$pdf->Cell(20,10,'',0,0,'C',1);
$pdf->Cell(30,10,"Total",0,0,'C',1);
$pdf->Cell(40,10,'$'.$total,0,0,'C',1);
$pdf->Ln(16);
$pdf->Cell(175,0,'',1,0,'C',1);


$doc=$pdf->Output('','S');
$mail = new PHPMailer(true);
$mensaje="recupere su clave";
try {
	//Server settings
	$mail->SMTPDebug = 0;                      // Enable verbose debug output
	$mail->isSMTP();                                            // Send using SMTP
	$mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
	$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
	$mail->Username   = 'Gestistock21@gmail.com';                     // SMTP username
	$mail->Password   = 'GestiStock_2021';                             // SMTP password
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
	$mail->setFrom('Gestistock21@gmail.com', 'noReply');
	$mail->addAddress($email);     // Add a recipient
	//$mail->addAddress('ellen@example.com');               // Name is optional
	

	// Attachments
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
   // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

	// Content
	$mail->isHTML(true);                                  // Set email format to HTML
	$mail->Subject = 'formulario de reestablecimiento de contraseña para GestiStock';
	$mensajeHtml = nl2br($mensaje);
	$mail->Body  = "<html> 
	<head>
	<meta charset='utf-8'>
	</head>
	<body> 
	<h1 style='background:#ffe0b2;color:white;' align='center'>GestiStock</h1>

	<p>Se adjunta pdf de la compra realizada</p>

	</body> 
	</html>
	<br />";
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
	$mail->AddStringAttachment($doc, $filename.'.pdf', 'base64', 'application/pdf');

	$mail->send();
	$pdf->Output('i',$filename.'.pdf');
} catch (Exception $e) {
	// echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	header("location:index.php?recuperar=2");
	exit();
}
	//header("location:index.php");
}
?>