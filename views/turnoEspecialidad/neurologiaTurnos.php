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
            <h1 class="h3 mb-3 fw-normal">Turnos para Neurología - <?php
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
            include "../selects/neurologia.php";
            include "../selects/ros/imagenRos.php";
            include "../selects/ros/diasRosSelect.php";
            include "../selects/ros/horariosViernesRosSelect.php";
            if (isset($_POST['botonRegistro'])) {
                if ($_POST['kinesiologiaSelect'] != 'no') {
                    include "../../database/conexion.php";
                    include "../../funciones/repetido.php";
                    include "../../funciones/getNombre.php";

                    $dni = $_POST['dni'];

                    $apellido_medico = $_POST['kinesiologiaSelect'];

                    $dias = $_POST['diasRosSelect'];

                    $apellido_m = getMatricula($apellido_medico, $conexion);

                    if ($apellido_medico = "Ros") {
                        $fecha = $_POST["diasRosSelect"];
                        $dia_de_la_semana = date("l", strtotime($fecha));
                        if ($dia_de_la_semana == 'Friday') {
                            $viernes = $_POST['horariosViernesRosSelect'];
                            if (repetido($conexion, $apellido_m, $fecha, $viernes)) {
                                echo "<br><div class='alert alert-danger'>HORARIO NO DISPONIBLE</div><br>";
                            } else {
                                $sql = "INSERT INTO turnos (paciente, medico, fecha, hora) VALUES('$dni', '$apellido_m', '$fecha', '$viernes')";
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
                <a href="../administrador/index.php" class="btn btn-lg btn-primary w-75 m-1" 
                type="submit" name="botonRegistro" style="background-color: white; border:2px solid #f2dc23;color: black;">Volver</a>
            </div>
        </form>
    </main>
    <footer class="pt-5 my-5 text-muted border-top">
        Todos los derechos reservados - Centro Integra &middot; &copy; 2023
    </footer>
    </div>
    <script>
        var neurologiaSelect = document.getElementById('neurologiaSelect');
        horariosViernesRosSelect.style.display = "none"
        neurologiaSelect.addEventListener("change", function() {
            var diasRos = document.getElementById('diasRosSelect')
            var apellido = neurologiaSelect.value;

            if (apellido == 'Ros') {
                diasRos.style.display = "block"
                horariosViernesRosSelect.style.display = "block"
                imagenRos.style.display ="block"
            }
        })
    </script>

</body>

</html>