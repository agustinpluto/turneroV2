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
                <h1 class="h3 mb-3 fw-normal">Turnos para Kinesiología - <?php
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
            echo '<div class="form-floating my-5">
                    <input type="text" class="form-control" id="id_compra" name="id_pago" value="" required>
                    <label for="ID_compra">Tu ID de Compra</label>
                </div>';

            include "../selects/kinesiologia.php";
            // GROS
            include "../selects/gros/imagenGros.php";
            include "../selects/gros/diasGrosSelect.php";

            include "../selects/gros/horariosLunesGrosSelect.php";
            include "../selects/gros/horariosMiercolesGrosSelect.php";
            include "../selects/gros/horariosJuevesGrosSelect.php";
            include "../../funciones/repetido.php";
            // JUAREZ
            include "../selects/juarez/imagenJuarez.php";
            include "../selects/juarez/diasJuarezSelect.php";

            include "../selects/juarez/horariosLunesJuarezSelect.php";
            include "../selects/juarez/horariosMartesJuarezSelect.php";
            include "../selects/juarez/horariosMiercolesJuarezSelect.php";
            include "../selects/juarez/horariosJuevesJuarezSelect.php";





            if (isset($_POST['botonRegistro'])) {

                if ($_POST['kinesiologiaSelect'] != 'no') {
                    include "../../database/conexion.php";

                    include "../../funciones/getNombre.php";
                    $id_pago = $_POST['id_pago'];
                    $sql_comprobar = "SELECT * FROM pagos WHERE ID_pago = '$id_pago'";
                    $comprobacion = mysqli_query($conexion, $sql_comprobar);
                    while ($row = mysqli_fetch_assoc($comprobacion)) {
                        $estado = $row['Estado'];
                    }

                    if ($estado == 'approved') {
                        $sql_actualizar = "UPDATE pagos SET Estado = 'USADO' WHERE ID_pago = '$id_pago'";
                        $actualizacion = mysqli_query($conexion, $sql_actualizar);


                        $apellido_medico = $_POST['kinesiologiaSelect'];

                        $dias = [$_POST['diasGrosSelect'], $_POST['diasJuarezSelect']];

                        $apellido_m = getMatricula($apellido_medico, $conexion);

                        if ($apellido_medico == "Gros") {
                            $fecha = $_POST["diasGrosSelect"];
                            $dia_de_la_semana = date("l", strtotime($fecha));
                            if ($dia_de_la_semana == 'Monday') {
                                $lunes = $_POST['horariosLunesGrosSelect'];
                                $tipoGros = $_POST['tipoGros'];
                                $modoGros = $_POST['modoGros'];
                                if (repetido($conexion, $apellido_m, $fecha, $lunes)) {
                                    echo "<br><div class='alert alert-danger'>HORARIO NO DISPONIBLE</div><br>";
                                } else {
                                    $sql = "INSERT INTO turnos (paciente, medico, fecha, hora) VALUES('$dni', '$apellido_m', '$fecha', '$lunes')";
                                    $resultado = mysqli_query($conexion, $sql);

                                    $sql_id = "SELECT * FROM turnos WHERE paciente='$dni' AND fecha='$fecha' AND hora='$lunes'";
                                    $buscarId = mysqli_query($conexion, $sql_id);
                                    while ($row = mysqli_fetch_assoc($buscarId)) {
                                        $id_turno = $row['id'];
                                    }

                                    $sql1 = "INSERT INTO turnost (id_turno, tipo, modo) VALUES('$id_turno', '$tipoGros', '$modoGros')";
                                    $resultado1 = mysqli_query($conexion, $sql1);

                                    $nombre_paciente = strtoupper(getNombrePaciente($dni, $conexion));
                                    $apellido_paciente = strtoupper(getApellidoPaciente($dni, $conexion));
                                    $email_medico = getMail($apellido_m, $conexion);
                                    echo "<script>window.location='https://turnero-integra.com.ar/enviarMail.php?email=centrointegracba@gmail.com&paciente=" . $nombre_paciente . ", " . $apellido_paciente . "&fecha=" . $fecha . "&hora=" . $lunes . "'</script>";
                                }
                            } elseif ($dia_de_la_semana == 'Wednesday') {
                                $miercoles = $_POST['horariosMiercolesGrosSelect'];
                                $tipoGros = $_POST['tipoGros'];
                                $modoGros = $_POST['modoGros'];
                                if (repetido($conexion, $apellido_m, $fecha, $miercoles)) {
                                    echo "<br><div class='alert alert-danger'>HORARIO NO DISPONIBLE</div><br>";
                                } else {
                                    $sql = "INSERT INTO turnos (paciente, medico, fecha, hora) VALUES('$dni', '$apellido_m', '$fecha', '$miercoles')";
                                    $resultado = mysqli_query($conexion, $sql);

                                    $sql_id = "SELECT * FROM turnos WHERE paciente='$dni' AND fecha='$fecha' AND hora='$miercoles'";
                                    $buscarId = mysqli_query($conexion, $sql_id);
                                    while ($row = mysqli_fetch_assoc($buscarId)) {
                                        $id_turno = $row['id'];
                                    }

                                    $sql1 = "INSERT INTO turnost (id_turno, tipo, modo) VALUES('$id_turno', '$tipoGros', '$modoGros')";
                                    $resultado1 = mysqli_query($conexion, $sql1);

                                    $nombre_paciente = strtoupper(getNombrePaciente($dni, $conexion));
                                    $apellido_paciente = strtoupper(getApellidoPaciente($dni, $conexion));
                                    $email_medico = getMail($apellido_m, $conexion);
                                    echo "<script>window.location='https://turnero-integra.com.ar/enviarMail.php?email=centrointegracba@gmail.com&paciente=" . $nombre_paciente . ", " . $apellido_paciente . "&fecha=" . $fecha . "&hora=" . $miercoles . "'</script>";
                                }
                            } elseif ($dia_de_la_semana == 'Thursday') {
                                $jueves = $_POST['horariosJuevesGrosSelect'];
                                $tipoGros = $_POST['tipoGros'];
                                $modoGros = $_POST['modoGros'];
                                if (repetido($conexion, $apellido_m, $fecha, $jueves)) {
                                    echo "<br><div class='alert alert-danger'>HORARIO NO DISPONIBLE</div><br>";
                                } else {
                                    $sql = "INSERT INTO turnos (paciente, medico, fecha, hora) VALUES('$dni', '$apellido_m', '$fecha', '$jueves')";
                                    $resultado = mysqli_query($conexion, $sql);

                                    $sql_id = "SELECT * FROM turnos WHERE paciente='$dni' AND fecha='$fecha' AND hora='$jueves'";
                                    $buscarId = mysqli_query($conexion, $sql_id);
                                    while ($row = mysqli_fetch_assoc($buscarId)) {
                                        $id_turno = $row['id'];
                                    }

                                    $sql1 = "INSERT INTO turnost (id_turno, tipo, modo) VALUES('$id_turno', '$tipoGros', '$modoGros')";
                                    $resultado1 = mysqli_query($conexion, $sql1);

                                    $nombre_paciente = strtoupper(getNombrePaciente($dni, $conexion));
                                    $apellido_paciente = strtoupper(getApellidoPaciente($dni, $conexion));
                                    $email_medico = getMail($apellido_m, $conexion);
                                    echo "<script>window.location='https://turnero-integra.com.ar/enviarMail.php?email=centrointegracba@gmail.com&paciente=" . $nombre_paciente . ", " . $apellido_paciente . "&fecha=" . $fecha . "&hora=" . $jueves . "'</script>";
                                }
                            }
                        } elseif ($apellido_medico == "Juarez") {
                            $fecha = $_POST["diasJuarezSelect"];
                            $dia_de_la_semana = date("l", strtotime($fecha));
                            if ($dia_de_la_semana == 'Monday') {
                                $lunes = $_POST['horariosLunesJuarezSelect'];
                                $tipoJuarez = $_POST['tipoJuarez'];
                                $modoJuarez = $_POST['modoJuarez'];
                                if (repetido($conexion, $apellido_m, $fecha, $lunes)) {
                                    echo "<br><div class='alert alert-danger'>HORARIO NO DISPONIBLE</div><br>";
                                } else {
                                    $sql = "INSERT INTO turnos (paciente, medico, fecha, hora) VALUES('$dni', '$apellido_m', '$fecha', '$lunes')";
                                    $resultado = mysqli_query($conexion, $sql);

                                    $sql_id = "SELECT * FROM turnos WHERE paciente='$dni' AND fecha='$fecha' AND hora='$lunes'";
                                    $buscarId = mysqli_query($conexion, $sql_id);
                                    while ($row = mysqli_fetch_assoc($buscarId)) {
                                        $id_turno = $row['id'];
                                    }

                                    $sql1 = "INSERT INTO turnost (id_turno, tipo, modo) VALUES('$id_turno', '$tipoJuarez', '$modoJuarez')";
                                    $resultado1 = mysqli_query($conexion, $sql1);

                                    $nombre_paciente = strtoupper(getNombrePaciente($dni, $conexion));
                                    $apellido_paciente = strtoupper(getApellidoPaciente($dni, $conexion));
                                    $email_medico = getMail($apellido_m, $conexion);
                                    echo "<script>window.location='https://turnero-integra.com.ar/enviarMail.php?email=centrointegracba@gmail.com&paciente=" . $nombre_paciente . ", " . $apellido_paciente . "&fecha=" . $fecha . "&hora=" . $lunes . "'</script>";
                                }
                            } elseif ($dia_de_la_semana == 'Tuesday') {
                                $martes = $_POST['horariosMartesJuarezSelect'];
                                $tipoJuarez = $_POST['tipoJuarez'];
                                $modoJuarez = $_POST['modoJuarez'];
                                if (repetido($conexion, $apellido_m, $fecha, $martes)) {
                                    echo "<br><div class='alert alert-danger'>HORARIO NO DISPONIBLE</div><br>";
                                } else {
                                    $sql = "INSERT INTO turnos (paciente, medico, fecha, hora) VALUES('$dni', '$apellido_m', '$fecha', '$martes')";
                                    $resultado = mysqli_query($conexion, $sql);

                                    $sql_id = "SELECT * FROM turnos WHERE paciente='$dni' AND fecha='$fecha' AND hora ='$martes'";
                                    $buscarId = mysqli_query($conexion, $sql_id);
                                    while ($row = mysqli_fetch_assoc($buscarId)) {
                                        $id_turno = $row['id'];
                                    }

                                    $sql1 = "INSERT INTO turnost (id_turno, tipo, modo) VALUES('$id_turno', '$tipoJuarez', '$modoJuarez')";
                                    $resultado1 = mysqli_query($conexion, $sql1);

                                    $nombre_paciente = strtoupper(getNombrePaciente($dni, $conexion));
                                    $apellido_paciente = strtoupper(getApellidoPaciente($dni, $conexion));
                                    $email_medico = getMail($apellido_m, $conexion);
                                    echo "<script>window.location='https://turnero-integra.com.ar/enviarMail.php?email=centrointegracba@gmail.com&paciente=" . $nombre_paciente . ", " . $apellido_paciente . "&fecha=" . $fecha . "&hora=" . $martes . "'</script>";
                                }
                            } elseif ($dia_de_la_semana == 'Wednesday') {
                                $miercoles = $_POST['horariosMiercolesJuarezSelect'];
                                $tipoJuarez = $_POST['tipoJuarez'];
                                $modoJuarez = $_POST['modoJuarez'];
                                if (repetido($conexion, $apellido_m, $fecha, $miercoles)) {
                                    echo "<br><div class='alert alert-danger'>HORARIO NO DISPONIBLE</div><br>";
                                } else {
                                    $sql = "INSERT INTO turnos (paciente, medico, fecha, hora) VALUES('$dni', '$apellido_m', '$fecha', '$miercoles')";
                                    $resultado = mysqli_query($conexion, $sql);

                                    $sql_id = "SELECT * FROM turnos WHERE paciente='$dni' AND fecha='$fecha' AND hora='$hora'";
                                    $buscarId = mysqli_query($conexion, $sql_id);
                                    while ($row = mysqli_fetch_assoc($buscarId)) {
                                        $id_turno = $row['id'];
                                    }

                                    $sql1 = "INSERT INTO turnost (id_turno, tipo, modo) VALUES('$id_turno', '$tipoJuarez', '$modoJuarez')";
                                    $resultado1 = mysqli_query($conexion, $sql1);

                                    $nombre_paciente = strtoupper(getNombrePaciente($dni, $conexion));
                                    $apellido_paciente = strtoupper(getApellidoPaciente($dni, $conexion));
                                    $email_medico = getMail($apellido_m, $conexion);
                                    echo "<script>window.location='https://turnero-integra.com.ar/enviarMail.php?email=centrointegracba@gmail.com&paciente=" . $nombre_paciente . ", " . $apellido_paciente . "&fecha=" . $fecha . "&hora=" . $miercoles . "'</script>";
                                }
                            } elseif ($dia_de_la_semana == 'Thursday') {
                                $jueves = $_POST['horariosJuevesJuarezSelect'];
                                $tipoJuarez = $_POST['tipoJuarez'];
                                $modoJuarez = $_POST['modoJuarez'];
                                if (repetido($conexion, $apellido_m, $fecha, $jueves)) {
                                    echo "<br><div class='alert alert-danger'>HORARIO NO DISPONIBLE</div><br>";
                                } else {
                                    $sql = "INSERT INTO turnos (paciente, medico, fecha, hora) VALUES('$dni', '$apellido_m', '$fecha', '$jueves')";
                                    $resultado = mysqli_query($conexion, $sql);

                                    $sql_id = "SELECT * FROM turnos WHERE paciente='$dni' AND fecha='$fecha' AND hora='$jueves'";
                                    $buscarId = mysqli_query($conexion, $sql_id);
                                    while ($row = mysqli_fetch_assoc($buscarId)) {
                                        $id_turno = $row['id'];
                                    }

                                    $sql1 = "INSERT INTO turnost (id_turno, tipo, modo) VALUES('$id_turno', '$tipoJuarez', '$modoJuarez')";
                                    $resultado1 = mysqli_query($conexion, $sql1);

                                    $nombre_paciente = strtoupper(getNombrePaciente($dni, $conexion));
                                    $apellido_paciente = strtoupper(getApellidoPaciente($dni, $conexion));
                                    $email_medico = getMail($apellido_m, $conexion);
                                    echo "<script>window.location='https://turnero-integra.com.ar/enviarMail.php?email=centrointegracba@gmail.com&paciente=" . $nombre_paciente . ", " . $apellido_paciente . "&fecha=" . $fecha . "&hora=" . $jueves . "'</script>";
                                }
                            }
                        }
                    } else {
                        echo "ID de Pago INVALIDO";
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
        var kinesiologiaSelect = document.getElementById('kinesiologiaSelect');
        var diasGros = document.getElementById('diasGrosSelect')
        var diasJuarez = document.getElementById('diasJuarezSelect')
        diasGros.style.display = "none"
        diasJuarez.style.display = "none"


        kinesiologiaSelect.addEventListener("change", function() {
            horariosLunesGrosSelect.style.display = "none";
            horariosMiercolesGrosSelect.style.display = "none";
            horariosJuevesGrosSelect.style.display = "none";

            horariosLunesJuarezSelect = "none";
            horariosMartesJuarezSelect = "none";
            horariosMiercolesJuarezSelect = "none";
            horariosJuevesJuarezSelect = "none";

            var apellido = kinesiologiaSelect.value;

            if (apellido == 'Gros') {
                diasGrosSelect.style.display = "block";
                diasJuarezSelect.style.display = "none";
                imagenGros.style.display = "block"
                imagenJuarez.style.display = "none"
                tipoJuarez.style.display = "none"
                modoJuarez.style.display = "none"
                tipoGros.style.display = "block"
                modoGros.style.display = "block"

            } else if (apellido == 'Juarez') {
                diasGrosSelect.style.display = "none";
                diasJuarezSelect.style.display = "block";
                imagenGros.style.display = "none"
                imagenJuarez.style.display = "block"
                tipoJuarez.style.display = "block"
                modoJuarez.style.display = "block"
                tipoGros.style.display = "none"
                modoGros.style.display = "none"

            }
        })

        diasGros.addEventListener("change", function() {
            var horariosLunesGrosSelect = document.getElementById('horariosLunesGrosSelect')
            var horariosMiercolesGrosSelect = document.getElementById('horariosMiercolesGrosSelect')
            var horariosJuevesGrosSelect = document.getElementById('horariosJuevesGrosSelect')
            var dia = new Date(diasGrosSelect.value).getDay()
            if (dia == 0) {
                horariosLunesGrosSelect.style.display = "block";
                horariosMiercolesGrosSelect.style.display = "none";
                horariosJuevesGrosSelect.style.display = "none";
            } else if (dia == 2) {
                horariosLunesGrosSelect.style.display = "none";
                horariosMiercolesGrosSelect.style.display = "block";
                horariosJuevesGrosSelect.style.display = "none";
            } else if (dia == 3) {
                horariosLunesGrosSelect.style.display = "none";
                horariosMiercolesGrosSelect.style.display = "none";
                horariosJuevesGrosSelect.style.display = "block";
            }

        })

        diasJuarez.addEventListener("change", function() {
            var horariosLunesJuarezSelect = document.getElementById('horariosLunesJuarezSelect')
            var horariosMartesJuarezSelect = document.getElementById('horariosMartesJuarezSelect')
            var horariosMiercolesJuarezSelect = document.getElementById('horariosMiercolesJuarezSelect')
            var horariosJuevesJuarezSelect = document.getElementById('horariosJuevesJuarezSelect')
            var dia = new Date(diasJuarezSelect.value).getDay()

            if (dia == 0) {
                horariosLunesJuarezSelect.style.display = "block";
                horariosMartesJuarezSelect.style.display = "none";
                horariosMiercolesJuarezSelect.style.display = "none";
                horariosJuevesJuarezSelect.style.display = "none";
            } else if (dia == 1) {
                horariosLunesJuarezSelect.style.display = "none";
                horariosMartesJuarezSelect.style.display = "block";
                horariosMiercolesJuarezSelect.style.display = "none";
                horariosJuevesJuarezSelect.style.display = "none";
            } else if (dia == 2) {
                horariosLunesJuarezSelect.style.display = "none";
                horariosMartesJuarezSelect.style.display = "none";
                horariosMiercolesJuarezSelect.style.display = "block";
                horariosJuevesJuarezSelect.style.display = "none";
            } else if (dia == 3) {
                horariosLunesJuarezSelect.style.display = "none";
                horariosMartesJuarezSelect.style.display = "none";
                horariosMiercolesJuarezSelect.style.display = "none";
                horariosJuevesJuarezSelect.style.display = "block";
            }

        })
    </script>

</body>

</html>