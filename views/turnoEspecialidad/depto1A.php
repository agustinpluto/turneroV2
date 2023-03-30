<?php
session_start();
$id = $_SESSION["id"];
if (empty($id)) {

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

    <main class="form-signin w-50 m-auto">

        <form method="post">

            <div class="container-fluid d-flex">

                <div class="container-fluid d-flex justify-content-center align-items-center">
                    <h1 class="h3 mb-3 fw-normal">Turnos para el Departamento de Evaluaciones - <?php
                                                                                                function obtenerNombre($id_usuario)
                                                                                                {
                                                                                                    include "../../database/conexion.php";
                                                                                                    $sql = "SELECT * FROM admin WHERE id_usuario='$id_usuario'";
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

            <div class="form-floating my-5">
                <input type="text" class="form-control" id="floatingInput" name="dni" required>
                <label for="floatingInput">DNI del Paciente</label>
            </div>

            <?php
            if (isset($_POST['botonRegistro'])) {
                include "../../database/conexion.php";
                $time = new DateTime();
                $date = new DateTime();
                $timezone = new DateTimeZone('America/Argentina/Buenos_Aires');
                $date->setTimezone($timezone);
                $formatted_date = $date->format('Y-m-d');
                $formatted_time = $time->format('H:i:s');
                $sql = "INSERT INTO turnosd (paciente, departamento, fecha, hora) VALUES('$dni', '1','$formatted_date','$formatted_time')";
                $resultado = mysqli_query($conexion, $sql);
            }

            ?>

            <div class="container-fluid d-flex justify-content-center align-items-center flex-column">
                <button class="btn btn-lg btn-primary w-75 m-1" type="submit" name="botonRegistro" style="background-color: #905597;border-color: #8e8db7;">Agendar turno</button>
                <a href="../administrador/index.php" class="btn btn-lg btn-primary w-75 m-1" type="submit" name="botonRegistro" style="background-color: white; border:2px solid #f2dc23;color: black;">Volver a las Especialidades</a>
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