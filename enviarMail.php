<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// getcomposer.org
// composer update
// Load Composer's autoloader
require 'vendor/autoload.php';

$verifcode = sha1(microtime(true));
$to      = 'agustinpluto.sv@gmail.com';
$subject = 'Verificar Cuenta para Turnero';
$msg = "<html>Hola, hace click aca: https://lalala/verify/$verifcode</html>";

mail_me($to, $subject, $msg, $headers);

function mail_me($to, $subject, $message) {

$headers = [
        'From' => 'AGUS <no-reply@em1753.turnero-integra.com.ar>',
    'content-type' => 'text/html',
    'MIME-Version' => '1.0',
    'Date' => date('r'),
    'Message-ID' => '<'.sha1(microtime(true)).'@em1753.turnero-integra.com.ar>'
];
    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();  
        $mail->SMTPDebug = 0;
        $mail->Host = 'smtp.sendgrid.net';
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'centrointegra2023';
        $mail->Password = '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';
        $mail->SMTPSecure = 'tls';//PHPMailer::ENCRYPTION_STARTTLS; Enable TLS encryption,
        $mail->Port = 587; // TCP port to connect to
        $mail->CharSet = 'UTF-8';
        $mail->isHTML(true); // Set email format to HTML

        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->setFrom('<no-reply@em1753.turnero-integra.com.ar>', 'AGUS');
        $mail->addAddress($to); // Add a recipient
        $mail->send();
       echo 'Message has been sent';
    } catch (Exception $e) {
       echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
