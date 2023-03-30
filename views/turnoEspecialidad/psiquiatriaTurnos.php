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
        <div class="container-fluid d-flex">

            <div class="container-fluid d-flex justify-content-center align-items-center">
                <h1 class="h3 mb-3 fw-normal">Turnos para Psiquiatría - <?php
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
                <label for="floatingInput">DNI del Psiquiatría</label>
            </div>

            <?php
            include "../../funciones/repetido.php";
            include "../selects/psiquiatria.php";
            //CASTELARI
            include "../selects/castelari/imagenCastelari.php";
            include "../selects/castelari/diasCastelariSelect.php";

            include "../selects/castelari/horariosMiercolesCastelariSelect.php";


            //REYNOLDS
            include "../selects/reynolds/imagenReynolds.php";
            include "../selects/reynolds/diasReynoldsSelect.php";
            include "../selects/reynolds/horariosMartesReynoldsSelect.php";

            if (isset($_POST['botonRegistro'])) {

                if ($_POST['psiquiatriaSelect'] != 'no') {
                    include "../../database/conexion.php";

                    include "../../funciones/getNombre.php";
                    $dni = $_POST['dni'];

                    $apellido_medico = $_POST['psiquiatriaSelect'];
                    $apellido_m = getMatricula($apellido_medico, $conexion);

                    if ($apellido_medico == "Castelari") {
                        $fecha = $_POST["diasCastelariSelect"];
                        $dia_de_la_semana = date("l", strtotime($fecha));
                        if ($dia_de_la_semana == 'Wednesday') {
                            $miercoles = $_POST['horariosMiercolesCastelariSelect'];
                            if (repetido($conexion, $apellido_m, $fecha, $miercoles)) {
                                echo "<br><div class='alert alert-danger'>HORARIO NO DISPONIBLE</div><br>";
                            } else {
                                $sql = "INSERT INTO turnos (paciente, medico, fecha, hora) VALUES('$dni', '$apellido_m', '$fecha', '$miercoles')";
                                $resultado = mysqli_query($conexion, $sql);
                                 $nombre_paciente = strtoupper(getNombrePaciente($dni, $conexion));
                                $apellido_paciente = strtoupper(getApellidoPaciente($dni, $conexion));
                                $email_medico = getMail($apellido_m, $conexion);
                                echo "<script>window.location='https://turnero-integra.com.ar/enviarMail.php?email=centrointegracba@gmail.com&paciente=" . $nombre_paciente . ", " . $apellido_paciente . "&fecha=" . $fecha . "&hora=" . $miercoles . "'</script>";
                            }
                        }
                    } elseif ($apellido_medico == "Reynolds") {
                        $fecha = $_POST["diasReynoldsSelect"];
                        $dia_de_la_semana = date("l", strtotime($fecha));
                        if ($dia_de_la_semana == 'Tuesday') {
                            $martes = $_POST['horariosMartesReynoldsSelect'];
                            if (repetido($conexion, $apellido_m, $fecha, $martes)) {
                                echo "<br><div class='alert alert-danger'>HORARIO NO DISPONIBLE</div><br>";
                            } else {
                                $sql = "INSERT INTO turnos (paciente, medico, fecha, hora) VALUES('$dni', '$apellido_m', '$fecha', '$martes')";
                                $resultado = mysqli_query($conexion, $sql);
                                 $nombre_paciente = strtoupper(getNombrePaciente($dni, $conexion));
                                $apellido_paciente = strtoupper(getApellidoPaciente($dni, $conexion));
                                $email_medico = getMail($apellido_m, $conexion);
                                echo "<script>window.location='https://turnero-integra.com.ar/enviarMail.php?email=centrointegracba@gmail.com&paciente=" . $nombre_paciente . ", " . $apellido_paciente . "&fecha=" . $fecha . "&hora=" . $martes . "'</script>";
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
        var psiquiatriaSelect = document.getElementById('psiquiatriaSelect');
        var diasCastelariSelect = document.getElementById('diasCastelariSelect')
        var diasReynoldsSelect = document.getElementById('diasReynoldsSelect')

        horariosMartesReynoldsSelect.style.display = "none"
        horariosMiercolesCastelariSelect.style.display = "none"

        psiquiatriaSelect.addEventListener("change", function() {

            var apellido = psiquiatriaSelect.value;

            if (apellido == 'Castelari') {
                diasReynoldsSelect.style.display = "none"
                horariosMartesReynoldsSelect.style.display = "none"
                diasCastelariSelect.style.display = "block"
                horariosMiercolesCastelariSelect.style.display = "block"
                imagenCastelari.style.display = "block"
                imagenReynolds.style.display = "none"

            } else if (apellido == 'Reynolds') {

                diasReynoldsSelect.style.display = "block"
                horariosMartesReynoldsSelect.style.display = "block"
                diasCastelariSelect.style.display = "none"
                horariosMiercolesCastelariSelect.style.display = "none"
                imagenCastelari.style.display = "none"
                imagenReynolds.style.display = "block"
            }
        })
    </script>

</body>

</html>