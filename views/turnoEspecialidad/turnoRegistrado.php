<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// getcomposer.org
// composer update
// Load Composer's autoloader
require '../../vendor/autoload.php';


$email = $_GET['email'];
$paciente = $_GET['paciente'];
$fecha = $_GET['fecha'];
$hora = $_GET['hora'];

$verifcode = sha1(microtime(true));
$to      = $email;
$subject = 'Nuevo turno';
$msg = "<html>Tenes un nuevo turno para: ".$fecha."<br>Con el paciente: ".$paciente."</html>";

mail_me($to, $subject, $msg, $headers);

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
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.108.0">
  <title>Inicio</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/starter-template/">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <script src="./js/bootstrap.min.js"></script>


  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .b-example-divider {
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
      flex-shrink: 0;
      width: 1.5rem;
      height: 100vh;
    }

    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
    }

    .nav-scroller .nav {
      display: flex;
      flex-wrap: nowrap;
      padding-bottom: 1rem;
      margin-top: -1px;
      overflow-x: auto;
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }

    .float {
      position: fixed;
      width: 60px;
      height: 60px;
      bottom: 40px;
      right: 40px;
      background-color: #25d366;
      color: #FFF;
      border-radius: 50px;
      text-align: center;
      font-size: 30px;
      box-shadow: 2px 2px 3px #999;
      z-index: 100;
    }

    .float:hover {
      text-decoration: none;
      color: #25d366;
      background-color: #fff;
    }

    .my-float {
      margin-top: 16px;
    }
  </style>

</head>

<body>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <a href="https://api.whatsapp.com/send/?phone=543513138666&text&type=phone_number&app_absent=0" class="float" target="_blank">
    <i class="fa fa-whatsapp my-float"></i>
  </a>
  <div class="col-lg-8 mx-auto p-4 py-md-5 ">


    <main>

      <div class="container-fluid d-flex justify-content-center align-items-center flex-row">
        <div class="container-fluid d-flex flex-column px-2 justify-content-center align-items-center" style="background-color: #90559730">
          <h1 class="m-2">TURNOS INTEGRA</h1>
          <p>Centro de Rehabilitación Integral</p>
        </div>
        <div class="container-fluid d-flex justify-content-end">
          <img src="../logointegra2.png" alt="" style="width:250px">
        </div>
      </div>
      <div class="container">
        TURNO AGENDADO CON EXITO
      </div>

    </main>
    <footer class="pt-5 my-5 text-muted border-top">
      Todos los derechos reservados - Centro Integra &middot; &copy; 2023
    </footer>
  </div>


  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>