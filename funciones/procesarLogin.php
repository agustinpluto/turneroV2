<?php
session_start();
if (isset($_POST['botonRegistro'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    include "../database/conexion.php";

    if (!empty($email) && !empty($password)) {

        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $result = mysqli_query($conexion, $sql);

        if ($row = $result->fetch_object()) {
            $password_db = $row->password;
            $id_usuario = $row->id;
            $rol = $row->rol;

            if (password_verify($password, $password_db)) {
                $_SESSION["id"] = $id_usuario;
                $_SESSION["rol"] = $rol;

                if ($rol == 1) {
                    header("location: ../views/administrador/index.php");
                } elseif ($rol == 2) {
                    header("location: ../views/pacientes/index.php");
                    $_SESSION["dni"] = getDni($id_usuario);
                } elseif ($rol == 3) {
                    header("location: ../views/medicos/index.php");
                    $_SESSION["matricula"] = getMatricula($id_usuario);
                }
            } else {
                echo "<div class='alert alert-danger m-4'>Contraseña incorrecta</div>";
            }
        } else {
            echo "<div class='alert alert-danger m-4'>E-mail incorrecto</div>";
        }
    } else {
        echo "<div class='alert alert-danger m-4'>Complete todos los campos</div>";
    }
}

function getDni($id_usuario){
    include "../database/conexion.php";
    $sql = "SELECT dni FROM pacientes WHERE id_usuario = '$id_usuario'";
    $resultado = mysqli_query($conexion, $sql);
    $registro = mysqli_fetch_assoc($resultado);
    $dni = $registro['dni'];
    return $dni;
}

function getMatricula($id_usuario){
    include "../database/conexion.php";
    $sql = "SELECT matricula FROM medicos    WHERE id_usuario = '$id_usuario'";
    $resultado = mysqli_query($conexion, $sql);
    $registro = mysqli_fetch_assoc($resultado);
    $matricula = $registro['matricula'];
    return $matricula;
}
