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

<main class="form-signin w-50 m-auto">

    <div class="container-fluid d-flex">

        <div class="container-fluid d-flex justify-content-center align-items-center">
            <h1 class="h3 mb-3 fw-normal">Turnos para Psicología - <?php
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
        <form method="post">


            <?php
            include "../../funciones/repetido.php";
            function obtenerDni($id_usuario)
            {
                include "../../database/conexion.php";
                $sql = "SELECT * FROM pacientes WHERE id_usuario='$id_usuario'";
                $resultado = mysqli_query($conexion, $sql);
                while ($row = mysqli_fetch_assoc($resultado)) {
                    $dni = $row['dni'];
                }
                return $dni;
            }

            echo '<div class="form-floating my-5">
                    <input type="text" class="form-control" id="dni" name="dni" value="' . $dni . '" disabled>
                    <label for="dni">Tu DNI</label>
                </div>';

                
                include "../selects/psicologia.php";
                //BALSAMO
                include "../selects/balsamo/imagenBalsamo.php";
                include "../selects/balsamo/diasBalsamoSelect.php";
                
                include "../selects/balsamo/horariosBalsamoJuevesSelect.php";
                //CANO
                include "../selects/cano/imagenCano.php";
                include "../selects/cano/diasCanoSelect.php";
                
                include "../selects/cano/horariosMiercolesCanoSelect.php";
                //GONZALEZ
                include "../selects/gonzalez/imagenGonzalez.php";
                include "../selects/gonzalez/diasGonzalezSelect.php";
                
                include "../selects/gonzalez/horariosMiercolesGonzalezSelect.php";
                include "../selects/gonzalez/horariosJuevesGonzalezSelect.php";
                //MOLINA
                include "../selects/molina/imagenMolina.php";
                include "../selects/molina/diasMolinaSelect.php";
                
                include "../selects/molina/horariosMartesMolinaSelect.php";
                include "../selects/molina/horariosJuevesMolinaSelect.php";
                //HERRERA
                include "../selects/herrera/imagenHerrera.php";
                include "../selects/herrera/diasHerreraSelect.php";
                include "../selects/herrera/horariosMartesHerreraSelect.php";
                include "../selects/herrera/horariosMiercolesHerreraSelect.php";

            if (isset($_POST['botonRegistro'])) {

                if ($_POST['psicologiaSelect'] != 'no') {
                    include "../../database/conexion.php";

                    include "../../funciones/getNombre.php";

                    
                    $apellido_medico = $_POST['psicologiaSelect'];

                    $dias = [$_POST['diasBalsamoSelect'], $_POST['diasCanoSelect'], $_POST['diasGonzalezSelect'], $_POST['diasMolinaSelect'], $_POST['diasHerreraSelect']];

                    $apellido_p = getApellidoPaciente($dni, $conexion);
                    $apellido_m = getMatricula($apellido_medico, $conexion);

                    if ($apellido_medico == "Bálsamo") {
                        $fecha = $_POST["diasBalsamoSelect"];
                        $dia_de_la_semana = date("l", strtotime($fecha));
                        if ($dia_de_la_semana == 'Thursday') {
                            $jueves = $_POST['horariosBalsamoJuevesSelect'];
                            if (repetido($conexion, $apellido_m, $fecha, $jueves)) {
                                echo "<br><div class='alert alert-danger'>HORARIO NO DISPONIBLE</div><br>";
                            } else {
                                $sql = "INSERT INTO turnos (paciente, medico, fecha, hora) VALUES('$dni', '$apellido_m', '$fecha', '$jueves')";
                                $resultado = mysqli_query($conexion, $sql);
                                echo "<br><div class='alert alert-success'>TURNO AGENDADO</div><br>";
                            }
                        }
                    } elseif ($apellido_medico == "Cano") {
                        $fecha = $_POST["diasCanoSelect"];
                        $dia_de_la_semana = date("l", strtotime($fecha));
                        if ($dia_de_la_semana == 'Wednesday') {

                            $miercoles = $_POST['horariosMiercolesGonzalezSelect'];
                            if (repetido($conexion, $apellido_m, $fecha, $miercoles)) {
                                echo "<br><div class='alert alert-danger'>HORARIO NO DISPONIBLE</div><br>";
                            } else {
                                $sql = "INSERT INTO turnos (paciente, medico, fecha, hora) VALUES('$dni', '$apellido_m', '$fecha', '$miercoles')";
                                $resultado = mysqli_query($conexion, $sql);
                                echo "<br><div class='alert alert-success'>TURNO AGENDADO</div><br>";
                            }
                        }
                    } elseif ($apellido_medico == "Gonzalez") {
                        $fecha = $_POST["diasGonzalezSelect"];
                        $dia_de_la_semana = date("l", strtotime($fecha));
                        if ($dia_de_la_semana == 'Thursday') {

                            $jueves = $_POST['horariosJuevesGonzalezSelect'];
                            if (repetido($conexion, $apellido_m, $fecha, $jueves)) {
                                echo "<br><div class='alert alert-danger'>HORARIO NO DISPONIBLE</div><br>";
                            } else {
                                $sql = "INSERT INTO turnos (paciente, medico, fecha, hora) VALUES('$dni', '$apellido_m', '$fecha', '$jueves')";
                                $resultado = mysqli_query($conexion, $sql);
                                echo "<br><div class='alert alert-success'>TURNO AGENDADO</div><br>";
                            }
                        } elseif ($dia_de_la_semana == 'Wednesday') {

                            $miercoles = $_POST['horariosMiercolesGonzalezSelect'];
                            if (repetido($conexion, $apellido_m, $fecha, $miercoles)) {
                                echo "<br><div class='alert alert-danger'>HORARIO NO DISPONIBLE</div><br>";
                            } else {
                                $sql = "INSERT INTO turnos (paciente, medico, fecha, hora) VALUES('$dni', '$apellido_m', '$fecha', '$miercoles')";
                                $resultado = mysqli_query($conexion, $sql);
                                echo "<br><div class='alert alert-success'>TURNO AGENDADO</div><br>";
                            }
                        }
                    } elseif ($apellido_medico == "Molina") {
                        $fecha = $_POST["diasMolinaSelect"];
                        $dia_de_la_semana = date("l", strtotime($fecha));
                        if ($dia_de_la_semana == 'Thursday') {
                            $jueves = $_POST['horariosJuevesMolinaSelect'];
                            if (repetido($conexion, $apellido_m, $fecha, $jueves)) {
                                echo "<br><div class='alert alert-danger'>HORARIO NO DISPONIBLE</div><br>";
                            } else {
                                $sql = "INSERT INTO turnos (paciente, medico, fecha, hora) VALUES('$dni', '$apellido_m', '$fecha', '$jueves')";
                                $resultado = mysqli_query($conexion, $sql);
                                echo "<br><div class='alert alert-success'>TURNO AGENDADO</div><br>";
                            }
                        } elseif ($dia_de_la_semana == 'Tuesday') {
                            $martes = $_POST['horariosMartesMolinaSelect'];
                            if (repetido($conexion, $apellido_m, $fecha, $martes)) {
                                echo "<br><div class='alert alert-danger'>HORARIO NO DISPONIBLE</div><br>";
                            } else {
                                $sql = "INSERT INTO turnos (paciente, medico, fecha, hora) VALUES('$dni', '$apellido_m', '$fecha', '$martes')";
                                $resultado = mysqli_query($conexion, $sql);
                                echo "<br><div class='alert alert-success'>TURNO AGENDADO</div><br>";
                            }
                        }
                    } elseif ($apellido_medico == "Herrera") {
                        $fecha = $_POST["diasHerreraSelect"];
                        $dia_de_la_semana = date("l", strtotime($fecha));
                        if ($dia_de_la_semana == 'Wednesday') {
                            $miercoles = $_POST['horariosMiercolesHerreraSelect'];
                            if (repetido($conexion, $apellido_m, $fecha, $miercoles)) {
                                echo "<br><div class='alert alert-danger'>HORARIO NO DISPONIBLE</div><br>";
                            } else {
                                $sql = "INSERT INTO turnos (paciente, medico, fecha, hora) VALUES('$dni', '$apellido_m', '$fecha', '$miercoles')";
                                $resultado = mysqli_query($conexion, $sql);
                                echo "<br><div class='alert alert-success'>TURNO AGENDADO</div><br>";
                            }
                        } elseif ($dia_de_la_semana == 'Tuesday') {
                            $martes = $_POST['horariosMartesHerreraSelect'];
                            if (repetido($conexion, $apellido_m, $fecha, $martes)) {
                                echo "<br><div class='alert alert-danger'>HORARIO NO DISPONIBLE</div><br>";
                            } else {
                                $sql = "INSERT INTO turnos (paciente, medico, fecha, hora) VALUES('$dni', '$apellido_m', '$fecha', '$martes')";
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
                <a href="../pacientes/index.php" class="btn btn-lg btn-primary w-75 m-1" 
                type="submit" name="botonRegistro" style="background-color: white; border:2px solid #f2dc23;color: black;">Volver</a>
            </div>
        </form>
    </main>
    <footer class="pt-5 my-5 text-muted border-top">
        Todos los derechos reservados - Centro Integra &middot; &copy; 2023
    </footer>
    </div>
    <script>
        var psicologiaSelect = document.getElementById('psicologiaSelect');
        horariosBalsamoJuevesSelect.style.display = "none"
        horariosMiercolesCanoSelect.style.display = "none"
        horariosMiercolesGonzalezSelect.style.display = "none"
        horariosJuevesGonzalezSelect.style.display = "none"

        psicologiaSelect.addEventListener("change", function() {

            var diasBalsamoSelect = document.getElementById('diasBalsamoSelect')
            var diasCanoSelect = document.getElementById('diasCanoSelect')
            var diasGonzalezSelect = document.getElementById('diasGonzalezSelect')
            var diasMolinaSelect = document.getElementById('diasMolinaSelect')

            var apellido = psicologiaSelect.value;
            console.log(apellido)

            if (apellido == 'Bálsamo') {
                diasBalsamoSelect.style.display = "block"
                diasCanoSelect.style.display = "none"
                diasGonzalezSelect.style.display = "none"
                diasMolinaSelect.style.display = "none"
                diasHerreraSelect.style.display = "none"
                horariosBalsamoJuevesSelect.style.display = "block"
                horariosMiercolesCanoSelect.style.display = "none"
                horariosMiercolesGonzalezSelect.style.display = "none"
                horariosJuevesGonzalezSelect.style.display = "none"
                horariosMartesMolinaSelect.style.display = "none"
                horariosJuevesMolinaSelect.style.display = "none"
                horariosMartesHerreraSelect.style.display = "none"
                horariosMiercolesHerreraSelect.style.display = "none"
                imagenBalsamo.style.display = "block"
                imagenCano.style.display = "none"
                imagenGonzalez.style.display = "none"
                imagenMolina.style.display = "none"
                imagenHerrera.style.display = "none"


            } else if (apellido == 'Cano') {
                diasBalsamoSelect.style.display = "none"
                diasCanoSelect.style.display = "block"
                diasGonzalezSelect.style.display = "none"
                diasMolinaSelect.style.display = "none"
                diasHerreraSelect.style.display = "none"
                horariosBalsamoJuevesSelect.style.display = "none"
                horariosMiercolesCanoSelect.style.display = "block"
                horariosMiercolesGonzalezSelect.style.display = "none"
                horariosJuevesGonzalezSelect.style.display = "none"
                horariosMartesMolinaSelect.style.display = "none"
                horariosJuevesMolinaSelect.style.display = "none"
                horariosMartesHerreraSelect.style.display = "none"
                horariosMiercolesHerreraSelect.style.display = "none"
                imagenBalsamo.style.display = "none"
                imagenCano.style.display = "block"
                imagenGonzalez.style.display = "none"
                imagenMolina.style.display = "none"
                imagenHerrera.style.display = "none"


            } else if (apellido == 'Gonzalez') {
                diasBalsamoSelect.style.display = "none"
                diasCanoSelect.style.display = "none"
                diasGonzalezSelect.style.display = "block"
                diasMolinaSelect.style.display = "none"
                diasHerreraSelect.style.display = "none"
                horariosBalsamoJuevesSelect.style.display = "none"
                horariosMiercolesCanoSelect.style.display = "none"
                horariosMiercolesGonzalezSelect.style.display = "none"
                horariosJuevesGonzalezSelect.style.display = "none"
                horariosMartesMolinaSelect.style.display = "none"
                horariosJuevesMolinaSelect.style.display = "none"
                horariosMartesHerreraSelect.style.display = "none"
                horariosMiercolesHerreraSelect.style.display = "none"
                imagenBalsamo.style.display = "none"
                imagenCano.style.display = "none"
                imagenGonzalez.style.display = "block"
                imagenMolina.style.display = "none"
                imagenHerrera.style.display = "none"


            } else if (apellido == 'Molina') {
                diasBalsamoSelect.style.display = "none"
                diasCanoSelect.style.display = "none"
                diasGonzalezSelect.style.display = "none"
                diasMolinaSelect.style.display = "block"
                diasHerreraSelect.style.display = "none"
                horariosBalsamoJuevesSelect.style.display = "none"
                horariosMiercolesCanoSelect.style.display = "none"
                horariosMiercolesGonzalezSelect.style.display = "none"
                horariosJuevesGonzalezSelect.style.display = "none"
                horariosMartesMolinaSelect.style.display = "none"
                horariosJuevesMolinaSelect.style.display = "none"
                horariosMartesHerreraSelect.style.display = "none"
                horariosMiercolesHerreraSelect.style.display = "none"
                imagenBalsamo.style.display = "none"
                imagenCano.style.display = "none"
                imagenGonzalez.style.display = "none"
                imagenMolina.style.display = "block"
                imagenHerrera.style.display = "none"


            } else if (apellido == 'Herrera') {
                diasBalsamoSelect.style.display = "none"
                diasCanoSelect.style.display = "none"
                diasGonzalezSelect.style.display = "none"
                diasMolinaSelect.style.display = "none"
                diasHerreraSelect.style.display = "block"
                horariosBalsamoJuevesSelect.style.display = "none"
                horariosMiercolesCanoSelect.style.display = "none"
                horariosMiercolesGonzalezSelect.style.display = "none"
                horariosJuevesGonzalezSelect.style.display = "none"
                horariosMartesMolinaSelect.style.display = "none"
                horariosJuevesMolinaSelect.style.display = "none"
                horariosMartesHerreraSelect.style.display = "none"
                horariosMiercolesHerreraSelect.style.display = "none"
                imagenBalsamo.style.display = "none"
                imagenCano.style.display = "none"
                imagenGonzalez.style.display = "none"
                imagenMolina.style.display = "none"
                imagenHerrera.style.display = "block"

            }


            diasGonzalezSelect.addEventListener("change", function() {
                var dia = new Date(diasGonzalezSelect.value).getDay()

                if (dia == 2) {
                    horariosMiercolesGonzalezSelect.style.display = "block"
                    horariosJuevesGonzalezSelect.style.display = "none"
                } else if (dia == 3) {
                    horariosMiercolesGonzalezSelect.style.display = "none"
                    horariosJuevesGonzalezSelect.style.display = "block"
                }

            })
            diasMolinaSelect.addEventListener("change", function() {
                var dia = new Date(diasMolinaSelect.value).getDay()

                if (dia == 1) {
                    horariosMartesMolinaSelect.style.display = "block"
                    horariosJuevesMolinaSelect.style.display = "none"
                } else if (dia == 3) {
                    horariosMartesMolinaSelect.style.display = "none"
                    horariosJuevesMolinaSelect.style.display = "block"
                }

            })
            diasHerreraSelect.addEventListener("change", function() {
                var dia = new Date(diasHerreraSelect.value).getDay()

                if (dia == 1) {
                    horariosMartesHerreraSelect.style.display = "block"
                    horariosMiercolesHerreraSelect.style.display = "none"
                } else if (dia == 2) {
                    horariosMartesHerreraSelect.style.display = "none"
                    horariosMiercolesHerreraSelect.style.display = "block"
                }

            })
        })
    </script>

</body>

</html>