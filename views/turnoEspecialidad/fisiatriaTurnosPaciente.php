<?php
session_start();
$id = $_SESSION["id"];
$rol = $_SESSION["rol"];
$dni = $_SESSION['dni'];
if ($rol != 2 || empty($id)) {

    header("location: ../../index.php");
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
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <script src="../js/bootstrap.min.js"></script>
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
    </style>

</head>

<body class="text-center">
    <script src="https://sdk.mercadopago.com/js/v2"></script>
    <main class="form-signin w-50 m-auto">

        <form method="post">
            <div class="container-fluid d-flex">

                <div class="container-fluid d-flex justify-content-center align-items-center">
                    <h1 class="h3 mb-3 fw-normal">Turnos para Fisiatría - <?php
                                                                            function obtenerNombre($id_usuario)
                                                                            {
                                                                                include "../../database/conexion.php";
                                                                                $sql = "SELECT * FROM pacientes WHERE id_usuario='$id_usuario'";
                                                                                $resultado = mysqli_query($conexion, $sql);
                                                                                while ($row = mysqli_fetch_assoc($resultado)) {
                                                                                    $nombre = $row['nombre'];
                                                                                }
                                                                                return strtoupper($nombre);
                                                                            }
                                                                            echo obtenerNombre($id); ?></h1>

                </div>
                <div class="container-fluid d-flex justify-content-center align-items-center">
                    <img src="../../lineas.png" class="justify-content-end mt-1" alt="" style="width:170px">
                </div>
            </div>

            <?php


            echo '<div class="form-floating my-5">
                    <input type="text" class="form-control" id="dni" name="dni" value="' . $dni . '" disabled>
                    <label for="dni">Tu DNI</label>
                </div>';


            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\Exception;

            require 'vendor/autoload.php';

            function enviarEmail($medico, $paciente, $fecha, $hora)
            {
                $verifcode = sha1(microtime(true));
                $to      =  $medico;
                $subject = 'Nuevo turno';
                $msg = "<html>Tenes un nuevo turno para: " . $fecha . "<br>Con el paciente: " . $paciente . "<br>A la hora: " . $hora . "</html>";

                mail_me($to, $subject, $msg);

                function mail_me($to, $subject, $message)
                {

                    $headers = [
                        'From' => 'agustin no-reply@turnero-integra.com.ar',
                        'content-type' => 'text/html',
                        'MIME-Version' => '1.0',
                        'Date' => date('r'),
                        'Message-ID' => '<' . sha1(microtime(true)) . '@turnero-integra.com.ar>'
                    ];
                    try {
                        $mail = new PHPMailer(true);
                        $mail->isSMTP();
                        $mail->SMTPDebug = 0;
                        $mail->Host = 'smtp.sendgrid.net';
                        $mail->SMTPAuth = true; // Enable SMTP authentication
                        $mail->Username = 'apikey';
                        $mail->Password = '';
                        $mail->SMTPSecure = 'tls'; //PHPMailer::ENCRYPTION_STARTTLS; Enable TLS encryption,
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
            }


            include "../selects/fisiatria.php";
            include "../selects/michelloud/imagenMichelloud.php";
            include "../selects/michelloud/diasMichelloudSelect.php";
            include "../selects/michelloud/horariosMiercolesMichelloud.php";

            include "../../funciones/repetido.php";

            if (isset($_POST['botonRegistro'])) {


                if (isset($_POST['botonRegistro'])) {


                    if ($_POST['diasMichelloudSelect'] != 'no') {
                        include "../../database/conexion.php";

                        include "../../funciones/getNombre.php";

                        $apellido_medico = $_POST['fisiatriaSelect'];
                        $dia_seleccionado = $_POST['diasMichelloudSelect'];
                        $horario_seleccionado = $_POST['horariosMiercolesMichelloudSelect'];
                        $timeObj = date("H:i:s", strtotime($horario_seleccionado));
                        $dateObj = date("Y:m:d", strtotime($dia_seleccionado));
                        $apellido_p = getApellidoPaciente($dni, $conexion);
                        $apellido_m = getMatricula($apellido_medico, $conexion);

                        if (repetido($conexion, $apellido_m, $dateObj, $timeObj)) {
                            echo "<br><div class='alert alert-danger'>HORARIO NO DISPONIBLE</div><br>";
                        } else {
                            $sql = "INSERT INTO turnos (paciente, medico, fecha, hora) VALUES('$dni', '$apellido_m', '$dateObj', '$timeObj')";
                            $sql2 = "SELECT * FROM medicos WHERE matricula = '$apellido_m'";

                            $resultado = mysqli_query($conexion, $sql);

                            $resultado2 = mysqli_query($conexion, $sql2);
                            while ($row = mysqli_fetch_assoc($resultado2)) {
                                $id_usuario = $row['id_usuario'];
                            }

                            $sql3 = "SELECT * FROM usuarios WHERE id='$id_usuario'";
                            $resultado3 = mysqli_query($conexion, $sql3);
                            while ($row = mysqli_fetch_assoc($resultado3)) {
                                $email = $row['email'];
                            }
                            enviarEmail($email, $dni, $fecha, $hora);

                            echo "<br><div class='alert alert-success'>TURNO AGENDADO</div><br>";
                        }
                    }
                }
            }



            ?>



            <div class="container-fluid d-flex justify-content-center align-items-center flex-column">
                <button class="btn btn-lg btn-primary w-75 m-1" type="submit" name="botonRegistro" style="background-color: #905597;border-color: #8e8db7;">Agendar turno</button>
                <a href="../pacientes/index.php" class="btn btn-lg btn-primary w-75 m-1" type="submit" name="botonRegistro" style="background-color: white; border:2px solid #f2dc23;color: black;">Volver</a>
            </div>
        </form>
    </main>
    <footer class="pt-5 my-5 text-muted border-top">
        Todos los derechos reservados - Centro Integra &middot; &copy; 2023
    </footer>
    </div>
    <script>
        var fisiatriaSelect = document.getElementById('fisiatriaSelect');

        diasMichelloudSelect.style.display = "none";
        imagenMichelloud.style.display = "none";
        horariosMiercolesMichelloudSelect.style.display = "none";

        fisiatriaSelect.addEventListener("change", function() {

            var apellido = fisiatriaSelect.value;
            if (apellido == 'Michelloud') {
                diasMichelloudSelect.style.display = "block";
                imagenMichelloud.style.display = "block";
                horariosMiercolesMichelloudSelect.style.display = "block";
            }
        })
    </script>

</body>

</html>