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
            <a href="../../funciones/logout.php" class="btn btn-primary btn-lg px-4 mx-3 " style="background-color: #905597;border-color: #8e8db7;">Cerrar sesión</a>
            <a href="./turnos.php" class="btn btn-primary btn-lg px-4 mx-3 mb-1" style="background-color: #905597;border-color: #8e8db7;">Mis turnos</a>
            <a href="./perfil.php" class="btn btn-primary btn-lg px-4 mx-3 mb-1" style="background-color: #905597;border-color: #8e8db7;">Mis datos</a>
            <a href="./abonar.php" class="btn btn-primary btn-lg px-4 mx-3 mb-1" style="background-color: #905597;border-color: #8e8db7;">Abonar seña</a>
            <a href="./pagos.php" class="btn btn-primary btn-lg px-4 mx-3 mb-1" style="background-color: #905597;border-color: #8e8db7;">Mis pagos</a>
        </div>
      <div>
        <?php
        include "../../database/conexion.php";
        $dni = $_SESSION['dni'];
        $sql = "SELECT * FROM pacientes WHERE dni='$dni'";
        $resultado = mysqli_query($conexion, $sql);

        while ($row = mysqli_fetch_assoc($resultado)) {
          $celular = $row['celular'];
          $apodo = $row['apodo'];
          if ($apodo == null || $celular == null) {

            echo "<div class='alert alert-warning'>
            <strong>Por favor, terminá de completar tus datos, nos encantaría saber como te gusta que se dirijan hacia vos!</strong>
          </div>";
          }
        }


        ?>



      </div>
      <hr class="col-2 col-md-2 mb-5">
      <div class="row  d-flex justify-content-center align-items-center">
        <div class="container-fluid text-center my-2">

        </div>
        <div class="container-fluid">
          <div class="row">
            <div class="col">
              <div class="card m-1">
                <a href="../turnoEspecialidad/fisiatriaTurnosPaciente.php" class="card-body">
                  <h3 class="card-title">Fisiatría</h3>
                  <p class="card-text">Persionar para turno</p>
                </a>
              </div>
            </div>
            <div class="col">
              <div class="card m-1">
                <a href="../turnoEspecialidad/fonoaudiologiaTurnosPaciente.php" class="card-body">
                  <h3 class="card-title">Fonoaudiología</h3>
                  <p class="card-text">Persionar para turno</p>
                </a>
              </div>
            </div>
            <div class="col">
              <div class="card m-1">
                <a href="../turnoEspecialidad/kinesiologiaTurnosPaciente.php" class="card-body">
                  <h3 class="card-title">Kinesiología</h3>
                  <p class="card-text">Persionar para turno</p>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row  d-flex justify-content-center align-items-center">
        <div class="col">
          <div class="row">
            <div class="col">
              <div class="card m-1">
                <a href="../turnoEspecialidad/neurologiaTurnosPaciente.php" class="card-body">
                  <h3 class="card-title">Neurología</h3>
                  <p class="card-text">Persionar para turno</p>
                </a>
              </div>
            </div>
            <div class="col">
              <div class="card m-1">
                <a href="../turnoEspecialidad/nutricionTurnosPaciente.php" class="card-body">
                  <h3 class="card-title">Nutrición</h3>
                  <p class="card-text">Persionar para turno</p>
                </a>
              </div>
            </div>
            <div class="col">
              <div class="card m-1">
                <a href="../turnoEspecialidad/psicologiaTurnosPaciente.php" class="card-body">
                  <h3 class="card-title">Psicología</h3>
                  <p class="card-text">Persionar para turno</p>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row  d-flex justify-content-center align-items-center">
        <div class="col">
          <div class="row">
            <div class="col">
              <div class="card m-1">
                <a href="../turnoEspecialidad/psicomotricidadTurnosPaciente.php" class="card-body">
                  <h3 class="card-title">Psicomotricidad</h3>
                  <p class="card-text">Persionar para turno</p>
                </a>
              </div>
            </div>
            <div class="col">
              <div class="card m-1">
                <a href="../turnoEspecialidad/psicopedagogiaTurnosPaciente.php" class="card-body">
                  <h3 class="card-title">Psicopedagogía</h3>
                  <p class="card-text">Persionar para turno</p>
                </a>
              </div>
            </div>
            <div class="col">
              <div class="card m-1">
                <a href="../turnoEspecialidad/psiquiatriaTurnosPaciente.php" class="card-body">
                  <h3 class="card-title">Psiquiatría</h3>
                  <p class="card-text">Persionar para turno</p>
                </a>
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class="row  d-flex justify-content-center align-items-center">
        <div class="col">
          <div class="row">
            <div class="col">
              <div class="card m-1">
                <a href="../turnoEspecialidad/terapiaOcupacionalTurnosPaciente.php" class="card-body">
                  <h3 class="card-title">Terapia Ocupacional</h3>
                  <p class="card-text">Persionar para turno</p>
                </a>
              </div>
            </div>
            <div class="col">
              <div class="card m-1">
                <a href="../turnoEspecialidad/trabajadoraSocialTurnosPaciente.php" class="card-body">
                  <h3 class="card-title">Trabajadora Social</h3>
                  <p class="card-text">Persionar para turno</p>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card m-1">
          <a href="../turnoEspecialidad/depto1.php" class="card-body">
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
          <a href="../turnoEspecialidad/depto2.php" class="card-body">
            <h3 class="card-title">Departamento de Coordinación, Supervisión de Maestras de Apoyo y Acompañantes Terapéuticas</h3>
            <p class="card-text">Persionar para turno</p>
          </a>
        </div>
      </div>
      <div class="col">
        <div class="card m-1">
          <a href="../turnoEspecialidad/depto3.php" class="card-body">
            <h3 class="card-title">Departamento de Selectividad y Aprehensión Alimentaria</h3>
            <p class="card-text">Persionar para turno</p>
          </a>
        </div>
      </div>
  </div>
  </div>
  </div>
  </div>


  </main>
  <footer class="pt-5 my-5 text-muted border-top">
    Todos los derechos reservados - Centro Integra &middot; &copy; 2023
  </footer>
  </div>


  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>