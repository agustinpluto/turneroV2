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
                    <h1 class="h3 mb-3 fw-normal">Turnos para Fonoaudiología - <?php
                                                                                $id = $id_usuario;
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

            include "../selects/fonoaudiologia.php";
            // CORREA
            include "../selects/correa/imagenCorrea.php";
            include "../selects/correa/diasCorreaSelect.php";
            include "../selects/correa/horariosMartesCorreaSelect.php";
            include "../selects/correa/horariosJuevesCorreaSelect.php";
            // JOVER
            include "../selects/jover/imagenJover.php";
            include "../selects/jover/diasJoverSelect.php";
            include "../selects/jover/horariosLunesJoverSelect.php";
            include "../selects/jover/horariosMiercolesJoverSelect.php";
            // MAZZOLA
            include "../selects/mazzola/imagenMazzola.php";
            include "../selects/mazzola/diasMazzolaSelect.php";
            include "../selects/mazzola/horariosJuevesMazzolaSelect.php";
            // SERRANO
            include "../selects/serrano/imagenSerrano.php";
            include "../selects/serrano/diasSerranoSelect.php";
            include "../selects/serrano/horariosLunesSerranoSelect.php";
            include "../selects/serrano/horariosMiercolesSerranoSelect.php";
            include "../selects/serrano/horariosJuevesSerranoSelect.php";



            if (isset($_POST['botonRegistro'])) {

                if ($_POST['fonoaudiologiaSelect'] != 'no') {
                    include "../../database/conexion.php";
                    include "../../funciones/repetido.php";
                    include "../../funciones/getNombre.php";

                    $dni = $_POST['dni'];

                    $apellido_medico = $_POST['fonoaudiologiaSelect'];

                    $dias = [$_POST['diasCorreaSelect'], $_POST['diasJoverSelect'], $_POST['diasMazzolaSelect'], $_POST['diasSerranoSelect']];

                    $apellido_p = getApellidoPaciente($dni, $conexion);
                    $apellido_m = getMatricula($apellido_medico, $conexion);

                    if ($apellido_medico == "Correa") {
                        $fecha = $_POST['diasCorreaSelect'];
                        $dia_de_la_semana = date("l", strtotime($fecha));
                        if ($dia_de_la_semana == 'Tuesday') {

                            $martes = $_POST['horariosMartesCorreaSelect'];
                            if (repetido($conexion, $apellido_m, $fecha, $martes)) {
                                echo "<br><div class='alert alert-danger'>HORARIO NO DISPONIBLE</div><br>";
                            } else {
                                $sql = "INSERT INTO turnos (paciente, medico, fecha, hora) VALUES('$dni', '$apellido_m', '$fecha', '$martes')";
                                $resultado = mysqli_query($conexion, $sql);
                                echo "<br><div class='alert alert-success'>TURNO AGENDADO</div><br>";
                            }
                        } elseif ($dia_de_la_semana == 'Thursday') {

                            $jueves = $_POST['horariosJuevesCorreaSelect'];
                            if (repetido($conexion, $apellido_m, $fecha, $jueves)) {
                                echo "<br><div class='alert alert-danger'>HORARIO NO DISPONIBLE</div><br>";
                            } else {
                                $sql = "INSERT INTO turnos (paciente, medico, fecha, hora) VALUES('$dni', '$apellido_m', '$fecha', '$jueves')";
                                $resultado = mysqli_query($conexion, $sql);
                                echo "<br><div class='alert alert-success'>TURNO AGENDADO</div><br>";
                            }
                        }
                    } elseif ($apellido_medico == "Jover") {
                        $fecha = $_POST['diasJoverSelect'];
                        $dia_de_la_semana = date("l", strtotime($fecha));
                        if ($dia_de_la_semana == 'Monday') {
                            $lunes = $_POST['horariosLunesJoverSelect'];
                            if (repetido($conexion, $apellido_m, $fecha, $lunes)) {
                                echo "<br><div class='alert alert-danger'>HORARIO NO DISPONIBLE</div><br>";
                            } else {
                                $sql = "INSERT INTO turnos (paciente, medico, fecha, hora) VALUES('$dni', '$apellido_m', '$fecha', '$lunes')";
                                $resultado = mysqli_query($conexion, $sql);
                                echo "<br><div class='alert alert-success'>TURNO AGENDADO</div><br>";
                            }
                        } elseif ($dia_de_la_semana == 'Wednesday') {
                            $miercoles = $_POST['horariosMiercolesJoverSelect'];
                            if (repetido($conexion, $apellido_m, $fecha, $miercoles)) {
                                echo "<br><div class='alert alert-danger'>HORARIO NO DISPONIBLE</div><br>";
                            } else {
                                $sql = "INSERT INTO turnos (paciente, medico, fecha, hora) VALUES('$dni', '$apellido_m', '$fecha', '$miercoles')";
                                $resultado = mysqli_query($conexion, $sql);
                                echo "<br><div class='alert alert-success'>TURNO AGENDADO</div><br>";
                            }
                        }
                    } elseif ($apellido_medico == "Mazzola") {
                        $fecha = $_POST['diasMazzolaSelect'];
                        $dia_de_la_semana = date("l", strtotime($fecha));
                        if ($dia_de_la_semana == 'Thursday') {
                            $jueves = $_POST['horariosJuevesMazzolaSelect'];
                            if (repetido($conexion, $apellido_m, $fecha, $jueves)) {
                                echo "<br><div class='alert alert-danger'>HORARIO NO DISPONIBLE</div><br>";
                            } else {
                                $sql = "INSERT INTO turnos (paciente, medico, fecha, hora) VALUES('$dni', '$apellido_m', '$fecha', '$jueves')";
                                $resultado = mysqli_query($conexion, $sql);
                                echo "<br><div class='alert alert-success'>TURNO AGENDADO</div><br>";
                            }
                        }
                    } elseif ($apellido_medico == "Serrano") {
                        $fecha = $_POST['diasSerranoSelect'];
                        $dia_de_la_semana = date("l", strtotime($fecha));
                        if ($dia_de_la_semana == 'Monday') {
                            $lunes = $_POST['horariosLunesSerranoSelect'];

                            if (repetido($conexion, $apellido_m, $fecha, $lunes)) {
                                echo "<br><div class='alert alert-danger'>HORARIO NO DISPONIBLE</div><br>";
                            } else {
                                $sql = "INSERT INTO turnos (paciente, medico, fecha, hora) VALUES('$dni', '$apellido_m', '$fecha', '$lunes')";
                                $resultado = mysqli_query($conexion, $sql);
                                echo "<br><div class='alert alert-success'>TURNO AGENDADO</div><br>";
                            }
                        } elseif ($dia_de_la_semana == 'Wednesday') {

                            $miercoles = $_POST['horariosMiercolesSerranoSelect'];
                            if (repetido($conexion, $apellido_m, $fecha, $miercoles)) {
                                echo "<br><div class='alert alert-danger'>HORARIO NO DISPONIBLE</div><br>";
                            } else {
                                $sql = "INSERT INTO turnos (paciente, medico, fecha, hora) VALUES('$dni', '$apellido_m', '$fecha', '$miercoles')";
                                $resultado = mysqli_query($conexion, $sql);
                                echo "<br><div class='alert alert-success'>TURNO AGENDADO</div><br>";
                            }
                        } elseif ($dia_de_la_semana == 'Thursday') {

                            $jueves = $_POST['horariosJuevesSerranoSelect'];
                            if (repetido($conexion, $apellido_m, $fecha, $jueves)) {
                                echo "<br><div class='alert alert-danger'>HORARIO NO DISPONIBLE</div><br>";
                            } else {
                                $sql = "INSERT INTO turnos (paciente, medico, fecha, hora) VALUES('$dni', '$apellido_m', '$fecha', '$jueves')";
                                $resultado = mysqli_query($conexion, $sql);
                                echo "<br><div class='alert alert-success'>TURNO AGENDADO</div><br>";
                            }
                        }
                    }
                }
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
        var fonoaudiologiaSelect = document.getElementById('fonoaudiologiaSelect');
        var diasCorreaSelect = document.getElementById('diasCorreaSelect')
        var diasJoverSelect = document.getElementById('diasJoverSelect')
        var diasMazzolaSelect = document.getElementById('diasMazzolaSelect')
        var diasSerranoSelect = document.getElementById('diasSerranoSelect')

        horariosJuevesMazzolaSelect.style.display = "none"
        horariosMartesCorreaSelect.style.display = "none"
        horariosJuevesCorreaSelect.style.display = "none"
        horariosLunesJoverSelect.style.display = "none"
        horariosMiercolesJoverSelect.style.display = "none"
        imagenCorrea.style.display = "none";
        imagenJover.style.display = "none";
        imagenMazzola.style.display = "none";
        imagenSerrano.style.display = "none";

        fonoaudiologiaSelect.addEventListener("change", function() {

            var diasCorreaSelect = document.getElementById('diasCorreaSelect')
            var apellido = fonoaudiologiaSelect.value;

            if (apellido == 'Correa') {
                diasCorreaSelect.style.display = "block"
                diasJoverSelect.style.display = "none"
                diasMazzolaSelect.style.display = "none"
                diasSerranoSelect.style.display = "none"
                horariosJuevesMazzolaSelect.style.display = "none"
                horariosLunesJoverSelect.style.display = "none"
                horariosMiercolesJoverSelect.style.display = "none"
                horariosLunesSerranoSelect.style.display = "none"
                horariosMiercolesSerranoSelect.style.display = "none"
                horariosJuevesSerrano.style.display = "none"
                imagenCorrea.style.display = "block";
                imagenJover.style.display = "none";
                imagenMazzola.style.display = "none";
                imagenSerrano.style.display = "none";

            } else if (apellido == "Jover") {
                diasJoverSelect.style.display = "block"
                diasCorreaSelect.style.display = "none"
                diasMazzolaSelect.style.display = "none"
                diasSerranoSelect.style.display = "none"
                horariosJuevesMazzolaSelect.style.display = "none"
                horariosMartesCorreaSelect.style.display = "none"
                horariosJuevesCorreaSelect.style.display = "none"
                horariosLunesSerranoSelect.style.display = "none"
                horariosMiercolesSerranoSelect.style.display = "none"
                horariosJuevesSerrano.style.display = "none"
                imagenCorrea.style.display = "none";
                imagenJover.style.display = "block";
                imagenMazzola.style.display = "none";
                imagenSerrano.style.display = "none";

            } else if (apellido == "Mazzola") {
                diasMazzolaSelect.style.display = "block"
                diasCorreaSelect.style.display = "none"
                diasJoverSelect.style.display = "none"
                diasSerranoSelect.style.display = "none"
                horariosMartesCorreaSelect.style.display = "none"
                horariosJuevesCorreaSelect.style.display = "none"
                horariosLunesJoverSelect.style.display = "none"
                horariosMiercolesJoverSelect.style.display = "none"
                horariosLunesSerranoSelect.style.display = "none"
                horariosMiercolesSerranoSelect.style.display = "none"
                horariosJuevesSerrano.style.display = "none"
                imagenCorrea.style.display = "none";
                imagenJover.style.display = "none";
                imagenMazzola.style.display = "block";
                imagenSerrano.style.display = "none";


            } else if (apellido == "Serrano") {
                diasSerranoSelect.style.display = "block"
                diasMazzolaSelect.style.display = "none"
                diasCorreaSelect.style.display = "none"
                diasJoverSelect.style.display = "none"
                horariosJuevesMazzolaSelect.style.display = "none"
                horariosMartesCorreaSelect.style.display = "none"
                horariosJuevesCorreaSelect.style.display = "none"
                horariosLunesJoverSelect.style.display = "none"
                horariosMiercolesJoverSelect.style.display = "none"
                imagenCorrea.style.display = "none";
                imagenJover.style.display = "none";
                imagenMazzola.style.display = "none";
                imagenSerrano.style.display = "block";


            }

        })
        diasCorreaSelect.addEventListener("change", function() {

            var horariosMartesCorreaSelect = document.getElementById('horariosMartesCorreaSelect')
            var horariosJuevesCorreaSelect = document.getElementById('horariosJuevesCorreaSelect')
            var dia = new Date(diasCorreaSelect.value).getDay()

            if (dia == 1) {
                horariosMartesCorreaSelect.style.display = "block"
                horariosJuevesCorreaSelect.style.display = "none"
            } else if (dia == 3) {
                horariosMartesCorreaSelect.style.display = "none"
                horariosJuevesCorreaSelect.style.display = "block"
            }
        })
        diasJoverSelect.addEventListener("change", function() {

            var horariosLunesJoverSelect = document.getElementById('horariosLunesJoverSelect')
            var horariosMiercolesJoverSelect = document.getElementById('horariosMiercolesJoverSelect')
            var dia = new Date(diasJoverSelect.value).getDay()

            if (dia == 0) {
                horariosLunesJoverSelect.style.display = "block"
                horariosMiercolesJoverSelect.style.display = "none"
            } else if (dia == 2) {
                horariosLunesJoverSelect.style.display = "none"
                horariosMiercolesJoverSelect.style.display = "block"
            }
        })
        diasMazzolaSelect.addEventListener("change", function() {
            var horariosJuevesMazzolaSelect = document.getElementById('horariosJuevesMazzolaSelect')
            var dia = new Date(diasMazzolaSelect.value).getDay()
            horariosJuevesMazzolaSelect.style.display = "none"
            if (dia == 3) {
                horariosJuevesMazzolaSelect.style.display = "block"
                horariosLunesSerranoSelect.style.display = "none"
                horariosMiercolesSerranoSelect.style.display = "none"
                horariosJuevesSerrano.style.display = "block"
                horariosMartesCorreaSelect.style.display = "none"
                horariosJuevesCorreaSelect.style.display = "none"

            }
        })
        diasSerranoSelect.addEventListener("change", function() {

            var horariosLunesSerranoSelect = document.getElementById('horariosLunesSerranoSelect')
            var horariosMiercolesSerranoSelect = document.getElementById('horariosMiercolesSerranoSelect')
            var horariosJuevesSerrano = document.getElementById('horariosJuevesSerranoSelect')
            var dia = new Date(diasSerranoSelect.value).getDay()

            if (dia == 0) {
                horariosLunesSerranoSelect.style.display = "block"
                horariosMiercolesSerranoSelect.style.display = "none"
                horariosJuevesSerrano.style.display = "none"
                horariosMartesCorreaSelect.style.display = "none"
                horariosJuevesCorreaSelect.style.display = "none"
                horariosJuevesMazzolaSelect.style.display = "none"
            } else if (dia == 2) {
                horariosLunesSerranoSelect.style.display = "none"
                horariosMiercolesSerranoSelect.style.display = "block"
                horariosJuevesSerrano.style.display = "none"
                horariosMartesCorreaSelect.style.display = "none"
                horariosJuevesCorreaSelect.style.display = "none"
                horariosJuevesMazzolaSelect.style.display = "none"
            } else if (dia == 3) {
                horariosLunesSerranoSelect.style.display = "none"
                horariosMiercolesSerranoSelect.style.display = "none"
                horariosJuevesSerrano.style.display = "block"
                horariosMartesCorreaSelect.style.display = "none"
                horariosJuevesCorreaSelect.style.display = "none"
                horariosJuevesMazzolaSelect.style.display = "none"

            }
        })
    </script>

</body>

</html>