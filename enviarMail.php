<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// getcomposer.org
// composer update
// Load Composer's autoloader
require 'vendor/autoload.php';

$verifcode = sha1(microtime(true));
$to      = 'agustinpluto@gmail.com';
$subject = 'Verificar Cuenta para Turnero';
$msg = "<html>Hola, aaaaa</html>";

mail_me($to, $subject, $msg, $headers);

function mail_me($to, $subject, $message) {

$headers = [
        'From' => 'agustin noreply@turnero-integra.com.ar',
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
        $mail->Password = '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';
        $mail->SMTPSecure = 'tls';//PHPMailer::ENCRYPTION_STARTTLS; Enable TLS encryption,
        $mail->Port = 587; // TCP port to connect to
        $mail->CharSet = 'UTF-8';
        $mail->isHTML(true); // Set email format to HTML

        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->setFrom('noreply@turnero-integra.com.ar', 'agustin');
        $mail->addAddress($to); // Add a recipient
        $mail->send();
       echo 'Message has been sent';
    } catch (Exception $e) {
       echo "{$mail->ErrorInfo}";
    }
}
