<?php
function editar($id_turno, $fecha, $hora)
{
    include "./database/conexion.php";
    $sql = "UPDATE turnos SET fecha='$fecha', hora='$hora' WHERE id = '$id_turno'";
    $result = mysqli_query($conexion, $sql);
}

session_start();

if (isset($_GET['id'])) {
    $id_turno = $_GET['id'];
    // Ejecutar la función de eliminación
    if (isset($_POST['boton'])) {

        editar($id_turno, $fecha, $hora);
        header("location:  views/administrador/turnos.php");
    }
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
    <link rel="stylesheet" href="./css/bootstrap.min.css">
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
    </style>

</head>

<body>

    <div class="col-lg-8 mx-auto p-4 py-md-5 ">


        <main>

            <div class="container-fluid d-flex justify-content-center align-items-center flex-row">
                <div class="container">
                    <h1>Turnos Integra</h1>
                    <p class="fs-5 col-md-8">Centro de Rehabilitación Integral</p>
                </div>
                <img src="logointegra2.png" alt="" style="width:170px">
            </div>
            <div class="mb-5 d-flex">
                <a href="./views/administrador/turnos.php" class="btn btn-primary btn-lg px-4 mx-3" style="background-color: #905597;border-color: #8e8db7;">Volver a la sección turnos</a>
                
            </div>

            <hr class="col-3 col-md-2 mb-5">

            <div class="row container-fluid d-flex justify-content-center align-items-center flex-row">
                <?php
                include "./database/conexion.php";
                $sql = "SELECT * FROM turnos WHERE id= '$id_turno'";
                $resultado = mysqli_query($conexion, $sql);
                if (mysqli_num_rows($resultado) > 0) {
                    while ($row = mysqli_fetch_assoc($resultado)) {
                        $dni = $row['paciente'];
                        $matricula = $row['medico'];
                        $fecha = $row['fecha'];
                        $hora = $row['hora'];
                    }
                }
                echo '<form method="post">';
                echo '<div class="form-floating my-1">
                <input type="text" class="form-control" id="floatingInput" name="dni" value="' . $dni . '" disabled>
                <label for="floatingInput">DNI del Paciente</label>
            </div>';
                echo '<div class="form-floating my-1">
                <input type="text" class="form-control" id="floatingInput" name="matricula" id="matricula" value="' . $matricula . '" disabled>
                <label for="floatingInput">Matricula del profesional</label>
            </div>';
                echo '<div class="form-floating my-1">
            <input type="text" class="form-control" id="floatingInput" name="fecha" id="fecha" value="' . $fecha . '" required>
            <label for="floatingInput">FECHA</label>
        </div>';
                echo '<div class="form-floating my-1">
                <input type="text" class="form-control" id="floatingInput" name="hora" id="hora" value="' . $hora . '" required>
                <label for="floatingInput">HORA</label>
            </div>';

                if (isset($_POST['botonEditar'])) {

                        $fecha1 = $_POST['fecha'];
                        $hora1 = $_POST['hora'];
                        $sql = "UPDATE turnos SET paciente='$dni', medico='$matricula', fecha='$fecha1', hora='$hora1' WHERE id = '$id_turno'";
                        $resultado = mysqli_query($conexion, $sql);
                        echo "Turno editado con exito. <a href='/views/administrador/turnos.php'>Ver turnos</a>";
                    
                }

                echo '<div class="container-fluid d-flex justify-content-center align-items-center flex-column">
                <button class="btn btn-lg btn-primary w-75 m-1" type="submit" name="botonEditar" style="background-color: #905597;border-color: #8e8db7;">Confirmar edición</button>    
                <a href="../pacientes/index.php" class="btn btn-lg btn-primary w-75 m-1" type="submit" name="botonVolver" style="background-color: white; border:2px solid #f2dc23;color: black;">Ir a la sección Especialidades</a>
                </div>';
                echo '</form>';
                ?>

            </div>

        </main>
        <footer class="pt-5 my-5 text-muted border-top">
            Todos los derechos reservados - Centro Integra &middot; &copy; 2023
        </footer>
    </div>


    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>