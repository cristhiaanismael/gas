<?php
error_reporting(E_ALL);
require ('class.phpmailer.php');
include("class.smtp.php");

$mail = new PHPMailer();

$mail->SMTPDebug = SMTP::DEBUG_SERVER;
$mail->SMTPDebug = 4; //Alternative to above constant
//Luego tenemos que iniciar la validación por SMTP:
$mail->IsSMTP();
$mail->Host = "smtp.gmail.com"; // SMTP a utilizar. Por ej. smtp.elserver.com
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Username = "rpv.representante@gmail.com"; // Correo completo a utilizar
$mail->Password = "rpv123456789"; // Contraseña
$mail->Port = 465; // Puerto a utilizar

//Con estas pocas líneas iniciamos una conexión con el SMTP. Lo que ahora deberíamos hacer, es configurar el mensaje a enviar, el //From, etc.
$mail->From = "rpv.representante@gmail.com"; // Desde donde enviamos (Para mostrar)
$mail->FromName = "Nombre";

//Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: "From: Nombre <correo@dominio.com>") de //correo.
$mail->AddAddress("ismael_cristhian@hotmail.com"); // Esta es la dirección a donde enviamos
$mail->IsHTML(true); // El correo se envía como HTML
$mail->Subject = "Titulo"; // Este es el titulo del email.
$body = "Hola mundo. Esta es la primer línea<br />";
$body .= "Acá continuo el <strong>mensaje</strong>";
$mail->Body = $body; // Mensaje a enviar
$exito = $mail->Send(); // Envía el correo.

//También podríamos agregar simples verificaciones para saber si se envió:
if($exito){
echo "El correo fue enviado correctamente.";
}else{
	//echo 'Error de correo:'. $mail->ErrorInfo; 
	echo $exito;
echo "Hubo un inconveniente maldito. Contacta a un administrador.";
}


?>