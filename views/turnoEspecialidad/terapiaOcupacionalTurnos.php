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
    <main class="form-signin w-50 m-auto">

        <form method="post">

            <div class="container-fluid d-flex">

                <div class="container-fluid d-flex justify-content-center align-items-center">
                    <h1 class="h3 mb-3 fw-normal">Turnos para Terapia Ocupacional - <?php
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
        <form method="post">

            <div class="form-floating my-5">
                <input type="text" class="form-control" id="floatingInput" name="dni" required>
                <label for="floatingInput">DNI del Paciente</label>
            </div>

            <?php
            include "../../funciones/repetido.php";
            include "../selects/terapiaOcupacional.php";

            //BARROSO 
            include "../selects/barroso/diasBarrosoSelect.php";
            include "../selects/barroso/horariosMartesBarrosoSelect.php";
            include "../selects/barroso/horariosJuevesBarrosoSelect.php";

            //DEL RIO
            include "../selects/delrio/diasDelRioSelect.php";
            include "../selects/delrio/horariosLunesDelRioSelect.php";
            include "../selects/delrio/horariosMartesDelRioSelect.php";
            include "../selects/delrio/horariosMiercolesDelRioSelect.php";
            include "../selects/delrio/horariosJuevesDelRioSelect.php";

            //MARTINEZ
            include "../selects/martinez/diasMartinezSelect.php";
            include "../selects/martinez/horariosLunesMartinezSelect.php";
            include "../selects/martinez/horariosMartesMartinezSelect.php";
            include "../selects/martinez/horariosMiercolesMartinezSelect.php";
            include "../selects/martinez/horariosJuevesMartinezSelect.php";

            if ($apellido_medico == "Barroso") {

                $fecha = $_POST["diasBarrosoSelect"];
                $dia_de_la_semana = date("l", strtotime($fecha));

                if ($dia_de_la_semana == 'Thursday') {
                    $jueves = $_POST['horariosBarrosoJuevesSelect'];
                    if (repetido($conexion, $apellido_m, $fecha, $jueves)) {
                        echo "<br><div class='alert alert-danger'>HORARIO NO DISPONIBLE</div><br>";
                    } else {
                        $sql = "INSERT INTO turnos (paciente, medico, fecha, hora) VALUES('$dni', '$apellido_m', '$fecha', '$jueves')";
                        $resultado = mysqli_query($conexion, $sql);
                        echo "<br><div class='alert alert-success'>TURNO AGENDADO</div><br>";
                    }
                } elseif ($dia_de_la_semana == 'Tuesday') {
                    $martes = $_POST['horariosMartesBarrosoSelect'];
                    if (repetido($conexion, $apellido_m, $fecha, $martes)) {
                        echo "<br><div class='alert alert-danger'>HORARIO NO DISPONIBLE</div><br>";
                    } else {
                        $sql = "INSERT INTO turnos (paciente, medico, fecha, hora) VALUES('$dni', '$apellido_m', '$fecha', '$martes')";
                        $resultado = mysqli_query($conexion, $sql);
                        echo "<br><div class='alert alert-success'>TURNO AGENDADO</div><br>";
                    }
                }
            } elseif ($apellido_medico == "Del Río") {

                $fecha = $_POST['diasDelRioSelect'];
                $dia_de_la_semana = date("l", strtotime($fecha));

                if ($dia_de_la_semana == 'Monday') {
                    $lunes = $_POST['horariosLunesDelRioSelect'];

                    if (repetido($conexion, $apellido_m, $fecha, $lunes)) {
                        echo "<br><div class='alert alert-danger'>HORARIO NO DISPONIBLE</div><br>";
                    } else {
                        $sql = "INSERT INTO turnos (paciente, medico, fecha, hora) VALUES('$dni', '$apellido_m', '$fecha', '$lunes')";
                        $resultado = mysqli_query($conexion, $sql);
                        echo "<br><div class='alert alert-success'>TURNO AGENDADO</div><br>";
                    }

                } elseif ($dia_de_la_semana == 'Tuesday') {
                    $martes = $_POST['horariosMartesDelRioSelect'];
                    if (repetido($conexion, $apellido_m, $fecha, $martes)) {
                        echo "<br><div class='alert alert-danger'>HORARIO NO DISPONIBLE</div><br>";
                    } else {
                        $sql = "INSERT INTO turnos (paciente, medico, fecha, hora) VALUES('$dni', '$apellido_m', '$fecha', '$martes')";
                        $resultado = mysqli_query($conexion, $sql);
                        echo "<br><div class='alert alert-success'>TURNO AGENDADO</div><br>";
                    }
                } elseif ($dia_de_la_semana == 'Wednesday') {
                    $miercoles = $_POST['horariosMiercolesDelRioSelect'];
                    if (repetido($conexion, $apellido_m, $fecha, $miercoles)) {
                        echo "<br><div class='alert alert-danger'>HORARIO NO DISPONIBLE</div><br>";
                    } else {
                        $sql = "INSERT INTO turnos (paciente, medico, fecha, hora) VALUES('$dni', '$apellido_m', '$fecha', '$miercoles')";
                        $resultado = mysqli_query($conexion, $sql);
                        echo "<br><div class='alert alert-success'>TURNO AGENDADO</div><br>";
                    }
                    echo "<br><div class='alert alert-success'>TURNO AGENDADO</div><br>";
                } elseif ($dia_de_la_semana == 'Thursday') {
                    $jueves = $_POST['horariosJuevesDelRioSelect'];
                    if (repetido($conexion, $apellido_m, $fecha, $lunes)) {
                        echo "<br><div class='alert alert-danger'>HORARIO NO DISPONIBLE</div><br>";
                    } else {
                        $sql = "INSERT INTO turnos (paciente, medico, fecha, hora) VALUES('$dni', '$apellido_m', '$fecha', '$lunes')";
                        $resultado = mysqli_query($conexion, $sql);
                        echo "<br><div class='alert alert-success'>TURNO AGENDADO</div><br>";
                    }
                }
            } elseif ($apellido_medico == "Martínez") {

                $fecha = $_POST['diasMartinezSelect'];
                $dia_de_la_semana = date("l", strtotime($fecha));

                if ($dia_de_la_semana == 'Monday') {
                    $lunes = $_POST['horariosLunesMartinezSelect'];
                    if (repetido($conexion, $apellido_m, $fecha, $lunes)) {
                        echo "<br><div class='alert alert-danger'>HORARIO NO DISPONIBLE</div><br>";
                    } else {
                        $sql = "INSERT INTO turnos (paciente, medico, fecha, hora) VALUES('$dni', '$apellido_m', '$fecha', '$lunes')";
                        $resultado = mysqli_query($conexion, $sql);
                        echo "<br><div class='alert alert-success'>TURNO AGENDADO</div><br>";
                    }
                } elseif ($dia_de_la_semana == 'Tuesday') {
                    $martes = $_POST['horariosMartesMartinezSelect'];
                    if (repetido($conexion, $apellido_m, $fecha, $martes)) {
                        echo "<br><div class='alert alert-danger'>HORARIO NO DISPONIBLE</div><br>";
                    } else {
                        $sql = "INSERT INTO turnos (paciente, medico, fecha, hora) VALUES('$dni', '$apellido_m', '$fecha', '$martes')";
                        $resultado = mysqli_query($conexion, $sql);
                        echo "<br><div class='alert alert-success'>TURNO AGENDADO</div><br>";
                    }
                } elseif ($dia_de_la_semana == 'Wednesday') {
                    $miercoles = $_POST['horariosMiercolesMartinezSelect'];
                    if (repetido($conexion, $apellido_m, $fecha, $miercoles)) {
                        echo "<br><div class='alert alert-danger'>HORARIO NO DISPONIBLE</div><br>";
                    } else {
                        $sql = "INSERT INTO turnos (paciente, medico, fecha, hora) VALUES('$dni', '$apellido_m', '$fecha', '$miercoles')";
                        $resultado = mysqli_query($conexion, $sql);
                        echo "<br><div class='alert alert-success'>TURNO AGENDADO</div><br>";
                    }
                } elseif ($dia_de_la_semana == 'Thursday') {
                    $jueves = $_POST['horariosJuevesMartinezSelect'];
                    if (repetido($conexion, $apellido_m, $fecha, $jueves)) {
                        echo "<br><div class='alert alert-danger'>HORARIO NO DISPONIBLE</div><br>";
                    } else {
                        $sql = "INSERT INTO turnos (paciente, medico, fecha, hora) VALUES('$dni', '$apellido_m', '$fecha', '$jueves')";
                        $resultado = mysqli_query($conexion, $sql);
                        echo "<br><div class='alert alert-success'>TURNO AGENDADO</div><br>";
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
        var terapiaOcupacionalSelect = document.getElementById('terapiaOcupacionalSelect');
        var diasBarrosoSelect = document.getElementById('diasBarrosoSelect')
        var diasDelRioSelect = document.getElementById('diasDelRioSelect')
        var diasMartinezSelect = document.getElementById('diasMartinezSelect')

        terapiaOcupacionalSelect.addEventListener("change", function() {

            var apellido = terapiaOcupacionalSelect.value;

            if (apellido == 'Barroso') {
                diasDelRioSelect.style.display = "none"
                diasBarrosoSelect.style.display = "block"
                diasMartinezSelect.style.display = "none"
                horariosMartesBarrosoSelect.style.display = "none"
                horariosBarrosoJuevesSelect.style.display = "none"
                horariosLunesDelRioSelect.style.display = "none"
                horariosMartesDelRioSelect.style.display = "none"
                horariosMiercolesDelRioSelect.style.display = "none"
                horariosJuevesDelRioSelect.style.display = "none"
                horariosLunesMartinezSelect.style.display = "none"
                horariosMartesMartinezSelect.style.display = "none"
                horariosMiercolesMartinezSelect.style.display = "none"
                horariosJuevesMartinezSelect.style.display = "none"
            } else if (apellido == 'Del Río') {

                diasDelRioSelect.style.display = "block"
                diasBarrosoSelect.style.display = "none"
                diasMartinezSelect.style.display = "none"
                horariosMartesBarrosoSelect.style.display = "none"
                horariosBarrosoJuevesSelect.style.display = "none"
                horariosLunesDelRioSelect.style.display = "none"
                horariosMartesDelRioSelect.style.display = "none"
                horariosMiercolesDelRioSelect.style.display = "none"
                horariosJuevesDelRioSelect.style.display = "none"
                horariosLunesMartinezSelect.style.display = "none"
                horariosMartesMartinezSelect.style.display = "none"
                horariosMiercolesMartinezSelect.style.display = "none"
                horariosJuevesMartinezSelect.style.display = "none"
            } else if (apellido == 'Martinez') {
                diasMartinezSelect.style.display = "block"
                diasBarrosoSelect.style.display = "none"
                diasDelRioSelect.style.display = "none"
                horariosMartesBarrosoSelect.style.display = "none"
                horariosBarrosoJuevesSelect.style.display = "none"
                horariosLunesDelRioSelect.style.display = "none"
                horariosMartesDelRioSelect.style.display = "none"
                horariosMiercolesDelRioSelect.style.display = "none"
                horariosJuevesDelRioSelect.style.display = "none"
                horariosLunesMartinezSelect.style.display = "none"
                horariosMartesMartinezSelect.style.display = "none"
                horariosMiercolesMartinezSelect.style.display = "none"
                horariosJuevesMartinezSelect.style.display = "none"
            }



            diasBarrosoSelect.addEventListener("change", function() {
                var dia = new Date(diasBarrosoSelect.value).getDay()

                if (dia == 1) {
                    horariosMartesBarrosoSelect.style.display = "block"
                    horariosBarrosoJuevesSelect.style.display = "none"
                } else if (dia == 3) {
                    horariosMartesBarrosoSelect.style.display = "none"
                    horariosBarrosoJuevesSelect.style.display = "block"
                }

            })
            diasDelRioSelect.addEventListener("change", function() {
                var dia = new Date(diasDelRioSelect.value).getDay()
                if (dia == 0) {
                    horariosLunesDelRioSelect.style.display = "block"
                    horariosMartesDelRioSelect.style.display = "none"
                    horariosMiercolesDelRioSelect.style.display = "none"
                    horariosJuevesDelRioSelect.style.display = "none"

                } else if (dia == 1) {
                    horariosLunesDelRioSelect.style.display = "none"
                    horariosMartesDelRioSelect.style.display = "block"
                    horariosMiercolesDelRioSelect.style.display = "none"
                    horariosJuevesDelRioSelect.style.display = "none"
                } else if (dia == 2) {
                    horariosLunesDelRioSelect.style.display = "none"
                    horariosMartesDelRioSelect.style.display = "none"
                    horariosMiercolesDelRioSelect.style.display = "block"
                    horariosJuevesDelRioSelect.style.display = "none"
                } else if (dia == 3) {
                    horariosLunesDelRioSelect.style.display = "none"
                    horariosMartesDelRioSelect.style.display = "none"
                    horariosMiercolesDelRioSelect.style.display = "none"
                    horariosJuevesDelRioSelect.style.display = "block"
                }
            })
            diasMartinezSelect.addEventListener("change", function() {
                var dia = new Date(diasMartinezSelect.value).getDay()
                if (dia == 0) {
                    horariosLunesMartinezSelect.style.display = "block"
                    horariosMartesMartinezSelect.style.display = "none"
                    horariosMiercolesMartinezSelect.style.display = "none"
                    horariosJuevesMartinezSelect.style.display = "none"
                } else if (dia == 1) {
                    horariosLunesMartinezSelect.style.display = "none"
                    horariosMartesMartinezSelect.style.display = "block"
                    horariosMiercolesMartinezSelect.style.display = "none"
                    horariosJuevesMartinezSelect.style.display = "none"
                } else if (dia == 2) {
                    horariosLunesMartinezSelect.style.display = "none"
                    horariosMartesMartinezSelect.style.display = "none"
                    horariosMiercolesMartinezSelect.style.display = "block"
                    horariosJuevesMartinezSelect.style.display = "none"
                } else if (dia == 3) {
                    horariosLunesMartinezSelect.style.display = "none"
                    horariosMartesMartinezSelect.style.display = "none"
                    horariosMiercolesMartinezSelect.style.display = "none"
                    horariosJuevesMartinezSelect.style.display = "block"
                }
            })

        })
    </script>

</body>

</html>