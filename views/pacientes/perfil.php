<?php
session_start();
$id = $_SESSION["id"];
$rol = $_SESSION["rol"];

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
    <link rel="stylesheet" href="../../css/custom.css">
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

        .card-body {
            border: 3px solid #f6ba62;
            background-color: white;
            color: black;
            transition: 0.5s background-color ease, 0.5s color ease;
        }

        .card-body:hover {
            background-color: #905597;
        }

        a {
            text-decoration: none;
        }
    </style>

</head>

<body>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <a href="https://api.whatsapp.com/send/?phone=543513138666&text&type=phone_number&app_absent=0" class="float" target="_blank">
        <i class="fa fa-whatsapp my-float"></i>
    </a>

    <div class="col-lg-8 mx-auto p-4 py-md-5">


        <div class="container-fluid d-flex justify-content-center align-items-center flex-row">
            <div class="container-fluid d-flex flex-column px-2 justify-content-center align-items-center" style="background-color: #90559730">
                <h1 class="m-2">TURNOS INTEGRA</h1>
                <p>Centro de Rehabilitación Integral</p>
            </div>
            <div class="container-fluid d-flex justify-content-end">
                <img src="../../logointegra2.png" alt="" style="width:250px">
            </div>
        </div>

        <div class="mb-5">
            <a href="../../funciones/logout.php" class="btn btn-primary btn-lg px-4 mx-3" style="background-color: #905597;border-color: #8e8db7;">Cerrar sesión</a>
            <a href="./turnos.php" class="btn btn-primary btn-lg px-4 mx-3" style="background-color: #905597;border-color: #8e8db7;">Mis turnos</a>
            <a href="./perfil.php" class="btn btn-primary btn-lg px-4 mx-3" style="background-color: #905597;border-color: #8e8db7;">Mis datos</a>
        </div>
        <main class="form-signin w-50 m-auto">
            <hr class="col-2 col-md-2 mb-5">
            <div class="row  d-flex justify-content-center align-items-center">
                <div class="container-fluid text-center my-2">

                </div>
                <?php

                include "../../database/conexion.php";

                $sql = "SELECT * FROM pacientes WHERE id_usuario='$id'";
                $resultado = mysqli_query($conexion, $sql);
                while ($row = mysqli_fetch_assoc($resultado)) {
                    $nombre = $row['nombre'];
                    $apellido = $row['apellido'];
                    $dni = $row['dni'];
                    $apodo = $row['apodo'];
                    $celular = $row['celular'];
                }

                ?>
            </div>
            <form method="POST">
                <p>Nombre
                <p>
                    <input type="text" class="form-control" name="nombre" id="" value="<?php echo strtoupper($nombre) ?>">
                <p>Apellido
                <p>
                    <input type="text" class="form-control" name="apellido" id="" value="<?php echo strtoupper($apellido) ?>">
                <p>DNI
                <p>
                    <input type="text" class="form-control" name="dni" id="" value="<?php echo $dni ?>">
                <p>Obra Social
                <p>
                    <input type="text" class="form-control" name="obra" id="" value="<?php echo $obra ?>">
                <p>Como quiero que me llamen
                <p>
                    <input type="text" class="form-control" name="apodo" id="" value="<?php echo strtoupper($apodo) ?>">
                <p>Celular/Teléfono
                <p>
                    <input type="text" class="form-control" name="celular" id="" value="<?php echo $celular ?>">
                    <br>
                <div class="container-fluid d-flex justify-content-center align-items-center">

                    <button class="btn btn-lg btn-primary w-75 m-1" type="submit" name="button" style="background-color: #905597;border-color: #8e8db7;">Cambiar datos</button>
                </div>
                <div class="container-fluid d-flex justify-content-center align-items-center">
                    <a href="../pacientes/index.php" class="btn btn-lg btn-primary w-75 m-1" style="background-color: white; border:2px solid #f2dc23;color: black;">Volver</a>
                </div>

            </form>



            <?php
            if (isset($_POST['button'])) {

                if (!empty($_POST['button'])) {
                    $nombre = $_POST['nombre'];
                    $apellido = $_POST['apellido'];
                    $apodo = $_POST['apodo'];
                    $celular = $_POST['celular'];
                    $obra = $_POST['obra'];

                    $sql = "UPDATE pacientes SET nombre='$nombre',apellido='$apellido',apodo='$apodo',celular='$celular', obra='$obra' WHERE dni='$dni'";
                    $result = mysqli_query($conexion, $sql);
                }
            }

            ?>


        </main>
        <footer class="pt-5 my-5 text-muted border-top">
            Todos los derechos reservados - Centro Integra &middot; &copy; 2023
        </footer>
    </div>


    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>