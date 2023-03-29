<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// getcomposer.org
// composer update
// Load Composer's autoloader
require 'vendor/autoload.php';


$email = $_GET['email'];
$paciente = $_GET['paciente'];
$fecha = $_GET['fecha'];
$hora = $_GET['hora'];

$verifcode = sha1(microtime(true));
$to      = $email;
$subject = 'Nuevo turno';
$msg = "<html>
Tenes un nuevo turno para el: ".$fecha."
<br>Con el paciente: ".$paciente."
<br>A la hora: ".$hora."
</html>";

mail_me($to, $subject, $msg);

function mail_me($to, $subject, $message) {

$headers = [
        'From' => 'agustin no-reply@turnero-integra.com.ar',
    'content-type' => 'text/html',
    'MIME-Version' => '1.0',
    'Date' => date('r'),
    'Message-ID' => '<'.sha1(microtime(true)).'@turnero-integra.com.ar>'
];
    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();  
        $mail->SMTPDebug = 0;
        $mail->Host = 'smtp.sendgrid.net';
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'apikey';
        $mail->Password = '';
        $mail->SMTPSecure = 'tls';//PHPMailer::ENCRYPTION_STARTTLS; Enable TLS encryption,
        $mail->Port = 587; // TCP port to connect to
        $mail->CharSet = 'UTF-8';
        $mail->isHTML(true); // Set email format to HTML

        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->setFrom('no-reply@turnero-integra.com.ar', 'agustin');
        $mail->addAddress($to); // Add a recipient
        $mail->send();
       echo 'Message has been sent';
    } catch (Exception $e) {
       echo "{$mail->ErrorInfo}";
    }
}
