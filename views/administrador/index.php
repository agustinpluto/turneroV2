<?php
session_start();
$id = $_SESSION["id"];
$rol = $_SESSION["rol"];

if ($rol != 1 || empty($id)) {
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


    <main>
      <div class="container-fluid d-flex justify-content-center align-items-center flex-row">
        <div class="container-fluid d-flex flex-column px-2 justify-content-center align-items-center" style="background-color: #90559730">
          <h1 class="m-2">TURNOS INTEGRA</h1>
          <p>Centro de Rehabilitación Integral</p>
        </div>
        <div class="container-fluid d-flex justify-content-end">
          <img src="../../logointegra2.png" alt="" style="width:220px">
        </div>
      </div>

      <div class="container-fluid">
            <div class="d-flex justify-content-center flex-wrap">
                <a href="./index.php" class="btn btn-primary btn-lg flex-grow-1 my-1 mx-1" style="background-color: #905597;border-color: #8e8db7;">Inicio</a>
                <a href="./turnos.php" class="btn btn-primary btn-lg flex-grow-1 my-1 mx-1" style="background-color: #905597;border-color: #8e8db7;">Turnos</a>
                <a href="./pagos.php" class="btn btn-primary btn-lg flex-grow-1 my-1 mx-1" style="background-color: #905597;border-color: #8e8db7;">Pagos</a>
                <a href="../../funciones/logout.php" class="btn btn-primary btn-lg flex-grow-1 my-1 mx-1" style="background-color: #905597;border-color: #8e8db7;">Cerrar sesión</a>
            </div>
        </div>

      <hr class="col-2 col-md-2 mb-5">
      <div class="row g-5 d-flex flex-column justify-content-center align-items-center">

        <form method="get" class="mt- d-flex justify-content-center align-items-center flex-row">
          <input class="form-controls" name="busqueda" placeholder="Apellido del paciente" type="text">
          <input class="btn btn-warning m-1" type="submit" name="button" value="Buscar datos">
        </form>

        <?php
        include "../../database/conexion.php";

        if (isset($_GET['button'])) {
          $busqueda = $_GET['busqueda'];
          $consulta = $conexion->query("SELECT * FROM pacientes WHERE apellido LIKE '%$busqueda'");
          while ($row = $consulta->fetch_array()) {
            echo '<div class="container-fluid text-center">';
            echo 'Nombre:    ' . strtoupper($row['nombre']) . '<br>';
            echo 'Apellido:    ' . strtoupper($row['apellido']) . '<br>';
            echo 'DNI:    ' . $row['dni'] . '<br>';
            echo 'Quiero que me llamen:    ' . $row['apodo'] . '<br>';
            echo 'Celular/Teléfono:    ' . $row['celular'] . '<br>';
            echo '</div>';
          }
        }

        ?>
        <div class="col">
          <div class="row">
            <div class="col">
              <div class="card m-1">
                <a href="../turnoEspecialidad/fisiatriaTurnos.php" class="card-body">
                  <h3 class="card-title">Fisiatría</h3>
                  <p class="card-text">Presionar para turno</p>
                </a>
              </div>
            </div>
            <div class="col">
              <div class="card m-1">
                <a href="../turnoEspecialidad/fonoaudiologiaTurnos.php" class="card-body">
                  <h3 class="card-title">Fonoaudiología</h3>
                  <p class="card-text">Presionar para turno</p>
                </a>
              </div>
            </div>
            <div class="col">
              <div class="card m-1">
                <a href="../turnoEspecialidad/kinesiologiaTurnos.php" class="card-body">
                  <h3 class="card-title">Kinesiología</h3>
                  <p class="card-text">Presionar para turno</p>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row g-5 d-flex justify-content-center align-items-center">
        <div class="col">
          <div class="row">
            <div class="col">
              <div class="card m-1">
                <a href="../turnoEspecialidad/neurologiaTurnos.php" class="card-body">
                  <h3 class="card-title">Neurología</h3>
                  <p class="card-text">Presionar para turno</p>
                </a>
              </div>
            </div>
            <div class="col">
              <div class="card m-1">
                <a href="../turnoEspecialidad/nutricionTurnos.php" class="card-body">
                  <h3 class="card-title">Nutrición</h3>
                  <p class="card-text">Presionar para turno</p>
                </a>
              </div>
            </div>
            <div class="col">
              <div class="card m-1">
                <a href="../turnoEspecialidad/psicologiaTurnos.php" class="card-body">
                  <h3 class="card-title">Psicología</h3>
                  <p class="card-text">Presionar para turno</p>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row g-5 d-flex justify-content-center align-items-center">
        <div class="col">
          <div class="row">
            <div class="col">
              <div class="card m-1">
                <a href="../turnoEspecialidad/psicomotricidadTurnos.php" class="card-body">
                  <h3 class="card-title">Psicomotricidad</h3>
                  <p class="card-text">Presionar para turno</p>
                </a>
              </div>
            </div>
            <div class="col">
              <div class="card m-1">
                <a href="../turnoEspecialidad/psicopedagogiaTurnos.php" class="card-body">
                  <h3 class="card-title">Psicopedagogía</h3>
                  <p class="card-text">Presionar para turno</p>
                </a>
              </div>
            </div>
            <div class="col">
              <div class="card m-1">
                <a href="../turnoEspecialidad/psiquiatriaTurnos.php" class="card-body">
                  <h3 class="card-title">Psiquiatría</h3>
                  <p class="card-text">Presionar para turno</p>
                </a>
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class="row g-5 d-flex justify-content-center align-items-center">
        <div class="col">
          <div class="row">
            <div class="col">
              <div class="card m-1">
                <a href="../turnoEspecialidad/terapiaOcupacionalTurnos.php" class="card-body">
                  <h3 class="card-title">Terapia Ocupacional</h3>
                  <p class="card-text">Presionar para turno</p>
                </a>
              </div>
            </div>
            <div class="col">
              <div class="card m-1">
                <a href="../turnoEspecialidad/trabajadoraSocialTurnos.php" class="card-body">
                  <h3 class="card-title">Trabajadora Social</h3>
                  <p class="card-text">Presionar para turno</p>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card m-1">
          <a href="../turnoEspecialidad/depto1A.php" class="card-body">
            <h3 class="card-title">Departamento de Evaluaciones</h3>
            <p class="card-text">- Evaluaciones Neurocognitivas(ADOS - ADIR)</p>
            <p class="card-text">- Evaluaciones Perfil Sensorial</p>
            <p class="card-text">- Evaluaciones Neuromotoras(Kinesiología)</p>
            <p class="card-text">Presionar para turno</p>
          </a>
        </div>
      </div>
      <div class="col">
        <div class="card m-1">
          <a href="../turnoEspecialidad/depto2A.php" class="card-body">
            <h3 class="card-title">Departamento de Coordinación, Supervisión de Maestras de Apoyo y Acompañantes Terapéuticas</h3>
            <p class="card-text">Presionar para turno</p>
          </a>
        </div>
      </div>
      <div class="col">
        <div class="card m-1">
          <a href="../turnoEspecialidad/depto3A.php" class="card-body">
            <h3 class="card-title">Departamento de Selectividad y Aprehensión Alimentaria</h3>
            <p class="card-text">Presionar para turno</p>
          </a>
        </div>
      </div>

    </main>
    <footer class="pt-5 my-5 text-muted border-top text-center">
      Todos los derechos reservados - Centro Integra &middot; &copy; 2023
    </footer>
  </div>


  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>