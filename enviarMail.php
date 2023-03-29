<?php
// Uncomment next line if you're not using a dependency loader (such as Composer)
require_once './sendgrid-php/sendgrid-php.php';

use SendGrid\Mail\Mail;

$email = new Mail();
$email->setFrom("no-reply@centrointegra.com", "Integra");
$email->setSubject("PRUEBA A A A ");
$email->addTo("agustinpluto@gmail.com", "Agustin");
$email->addContent("text/plain", "  HOLAAAAAAA ");
$email->addContent(
    "text/html", "<strong>PRUEBA EXITOSA</strong>"
);
$sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '.  $e->getMessage(). "\n";
}