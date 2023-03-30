<?php
session_start();
$id = $_SESSION["id"];
$rol = $_SESSION["rol"];
$dni  = $_SESSION["dni"];
if ($rol != 2 || empty($id)) {

    header("location: ../../index.php");
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <title>Inicio</title>
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <a href="https://api.whatsapp.com/send/?phone=543513138666&text&type=phone_number&app_absent=0" class="float" target="_blank">
        <i class="fa fa-whatsapp my-float"></i>
    </a>

    <div class="col-lg-8 mx-auto p-4 py-md-5">


        <main>
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
                <form method="post">

                    <img class="mb-4" src="../../integra.png" alt="" width="80">
                    <h1 class="h3 mb-3 fw-normal">Mi perfil</h1>



                    <?php
                    include "../../database/conexion.php";
                    $sql = "SELECT * FROM pacientes WHERE id_usuario='$id'";
                    $resultado = mysqli_query($conexion, $sql);
                    while ($row = mysqli_fetch_row($resultado)) {
                        $nombre = $row['nombre'];
                        $apellido = $row['apellido'];
                        $dni = $row['dni'];
                        $apodo = $row['apodo'];
                        $celular = $row['celular'];
                    }

                    echo '<form method="POST">
                <p>Nombre<p>
                <input type="text" name="nombre" id="" value="' . $nombre . '">
                <p>Apellido<p>
                <input type="text" name="apellido" id="" value="' . $apellido . '">
                <p>DNI<p>
                <input type="text" name="dni" id="" value="' . $dni . '" disabled>
                <p>Como quiero que me llamen<p>
                <input type="text" name="apodo" id="" value="' . $apodo . '">
                <p>Celular/Teléfono<p>
                <input type="text" name="celular" id="" value="' . $celular . '">
                <input type="submit" value="Cambiar datos">

            </form>';



                    if (isset($_POST['button'])) {

                        $nombre = $_POST['nombre'];
                        $apellido = $_POST['apellido'];
                        $apodo = $_POST['apodo'];
                        $celular = $_POST['celular'];
                        $consulta = $conexion->query("UPDATE pacientes SET nombre = '$nombre', apellido = '$apellido', apodo = '$apodo', celular = '$celular' WHERE dni ='$dni'");
                    }

                    ?>



            </main>
    </div>
    <footer class="pt-5 my-5 text-muted border-top">
        Todos los derechos reservados - Centro Integra &middot; &copy; 2023
    </footer>
    </div>
    <script>



    </script>

</body>

</html>