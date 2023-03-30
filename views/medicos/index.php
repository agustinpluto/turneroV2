<?php
session_start();
$id = $_SESSION["id"];
$rol = $_SESSION["rol"];

if ($rol != 3 || empty($id)) {
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
  </style>

</head>

<body>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <a href="https://api.whatsapp.com/send/?phone=543513138666&text&type=phone_number&app_absent=0" class="float" target="_blank">
    <i class="fa fa-whatsapp my-float"></i>
  </a>
  <main class="form-signin w-50 m-auto">
    <div class="container-fluid d-flex justify-content-center align-items-center flex-row">
      <div class="container">
        <h1>Turnos Integra</h1>
        <p class="fs-5 col-md-8">Centro de Rehabilitación Integral</p>
      </div>
      <img src="../../logointegra2.png" alt="" style="width:170px">
    </div>
    <div class="mb-5">
      <a href="../../funciones/logout.php" class="btn btn-primary btn-lg px-4 mx-3" style="background-color: #905597;border-color: #8e8db7;">Cerrar sesión</a>
      
    </div>
    <hr class="col-3 col-md-2 mb-5">

    <div class="row g-5 d-flex">

        <div class="mb-6">
          <input type="text" class="form-control" name="busqueda" id="busqueda" placeholder="Buscar por apellido">
          <a name="button" id="button" class="btn btn-primary" href="#" role="button">Button</a>
        </div>

      <?php
      include "../../database/conexion.php";

      if (isset($_GET['button'])){
          $boton = $_GET['button'];
          header("location: ./buscarPaciente.php?=".$boton."");
      }

      function traerNombrePaciente($dni)
      {
        include "../../database/conexion.php";
        $nombre = null;
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
        $apellido = null;
        $sql = "SELECT * FROM pacientes WHERE dni = '$dni'";
        $resultado = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($resultado) > 0) {

          while ($fila = mysqli_fetch_assoc($resultado)) {
            $apellido = $fila["apellido"];
          }
        }
        return $apellido;
      }

      $matricula = $_SESSION['matricula'];

      $sql = "SELECT * FROM turnos WHERE medico = '$matricula'";
      $result = mysqli_query($conexion, $sql);


      if (mysqli_num_rows($result) > 0) {

        echo '<br><div class="d-flex">
                            <table class="table table-warning">
                            <thead>
                                <tr>
                                    <th>Paciente</th>
                                    <th>Modo</th>
                                    <th>Tipo</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>

                                </tr>
                            </thead>
                            <tbody>';
        while ($row = mysqli_fetch_assoc($result)) {
          $id_turno = $row['id'];
          $nombre = strtoupper(traerNombrePaciente($row['paciente']));
          $apellido = strtoupper(traerApellidoPaciente($row['paciente']));
          $fecha = $row['fecha'];
          $hora = $row['hora'];
          $sql_turno = "SELECT * FROM turnost WHERE id_turno = '$id_turno'";
          $result1 = mysqli_query($conexion, $sql_turno);
          while ($row = mysqli_fetch_assoc($result1)) {

            echo '<tr>    
                <td>' .  $apellido . ', ' . $nombre . '</td>
                <td>' .  strtoupper($row['modo']) . '</td>
                <td>' .  strtoupper($row['tipo']) . '</td>
                <td> ' . $fecha . ' </td>
                <td> ' . $hora . ' </td>

            </tr>';
          }
        }
        echo '</tbody></table></div>';

        // Paso 5: cerrar la conexión
        mysqli_close($conexion);
      } else {
        echo '<br><div class="alert alert-warning text-center" role="alert">
                                <strong>¡</strong> No tenes turnos registrados <strong>!</strong> 
                            </div>';
      }
      ?>

    </div>
  </main>
  <footer class="pt-5 my-5 text-center border-top">
    Todos los derechos reservados - Centro Integra &middot; &copy; 2023
  </footer>



  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>