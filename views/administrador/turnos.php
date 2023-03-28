<?php
session_start();
$id = $_SESSION["id"];
$rol = $_SESSION["rol"];
if ($rol != 1 || empty($id)){

  header("location: ../../index.php");

}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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
    <div class="col mx-auto p-4 py-md-5">
        <main class="form-signin w-50 m-auto">
            <form method="post">

                <img class="mb-4" src="../../integra.png" alt="" width="80">
                <h1 class="h3 mb-3 fw-normal">Turnos Integra</h1>

                <?php
                include "../../database/conexion.php";

                function traerApellidoMedico($matricula)
                {
                    include "../../database/conexion.php";

                    include "../../database/conexion.php";
                    
                    $sql = "SELECT * FROM medicos WHERE matricula = '$matricula'";
                    $resultado = mysqli_query($conexion, $sql);
                    
                    if (mysqli_num_rows($resultado) > 0) {
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            $apellido = $fila["apellido"];
                        }
                    } 
                    return $apellido;
                }

                function traerNombreMedico($matricula)
                {
                    include "../../database/conexion.php";

                    include "../../database/conexion.php";
                    
                    $sql = "SELECT * FROM medicos WHERE matricula = '$matricula'";
                    $resultado = mysqli_query($conexion, $sql);
                    
                    if (mysqli_num_rows($resultado) > 0) {
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            $nombre = $fila["nombre"];
                        }
                    } 
                    return $nombre;
                }

                function traerNombrePaciente($dni)
                {
                    include "../../database/conexion.php";
                    
                    $sql = "SELECT * FROM pacientes WHERE dni = '$dni'";
                    $resultado = mysqli_query($conexion, $sql);
                    
                    if (mysqli_num_rows($resultado) > 0) {
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            $nombre = $fila["nombre"];
                        }
                    } 
                    return $nombre;
                    } 
                    
                function traerApellidoPaciente($dni)
                {
                    include "../../database/conexion.php";
                    
                    $sql = "SELECT * FROM pacientes WHERE dni = '$dni'";
                    $resultado = mysqli_query($conexion, $sql);
                    
                    if (mysqli_num_rows($resultado) > 0) {
                        
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            $apellido = $fila["apellido"]; 
                        }
                    } 
                    return $apellido;
                }

                
                $sql = "SELECT * FROM turnos";
                $result = mysqli_query($conexion, $sql);

                if (mysqli_num_rows($result) > 0) {

                    // Mostrar los resultados
                    echo '
                    <table class="table table-warning">
                    <thead>
                        <tr>
                            
                            <th>Apellido, Nombre</th>
                            <th>Profesional</th>
                            <th>Fecha | Hora</th>
                            <th>Acciones</th>
                            
                        </tr>
                    </thead>
                    <tbody>';
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id_turno = $row['id'];
                        $dni = $row['paciente'];
                        $sql3 = "SELECT * FROM pacientes WHERE dni = '$dni'";
                        $matricula = $row['medico'];
                        $nombreMedico = strtoupper(traerNombreMedico($matricula));
                        $apellidoMedico = strtoupper(traerApellidoMedico($matricula));
                        
                        $hora = date('H:i', strtotime($row['hora']));
                        $fecha = $row['fecha'];

                        $nombrePaciente = strtoupper(traerNombrePaciente($dni));
                        $apellidoPaciente = strtoupper(traerApellidoPaciente($dni));
                        

                        echo '<tr>
                                
                                <td>' . $apellidoPaciente .', '.$nombrePaciente. ' </td>
                                <td> ' . $apellidoMedico .', '.$nombreMedico. ' </td>
                                <td> ' . $fecha .' | '.$hora. ' </td>
                                <th><a href="http://localhost:8000/eliminarTurnoAdmin.php?id=' . $id_turno . '" class="btn btn-danger btn-sm" name="eliminar"><span class="material-symbols-outlined">
                                delete
                                </span></a>
                                <a href="http://localhost:8000/editarTurnoAdmin.php?id=' . $id_turno . '" class="btn btn-success btn-sm" name="eliminar"><span class="material-symbols-outlined">
                                edit
                                </span></a></th>
                                
                                </th>
                            </tr>';
                    }
                    echo '</tbody></table>';

                    // Paso 5: cerrar la conexión
                    mysqli_close($conexion);
                } else {
                    echo '<br><div class="alert alert-warning" role="alert">No hay turnos pendientes</div>';
                }

                ?>
                <div class="container-fluid d-flex justify-content-center align-items-center flex-column">
                
                <a href="./index.php" class="btn btn-lg btn-primary m-1 text-center w-75" type="submit" name="botonRegistro" style="background-color: #905597;border-color: #8e8db7;">Volver al inicio</a>
                
            </div>

            </form>
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