<?php

if (isset($_POST['botonRegistro'])) {

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $dni = $_POST['dni'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hash = password_hash($password, PASSWORD_DEFAULT);

    if ($dni == '000') {
        $rol = '1';
    } elseif (strlen($dni) == 8) {
        $rol = '2';
    } elseif (strlen($dni) < 8) {
        $rol = '3';
    } else {
        echo "NO SE ASIGNO ROL";
    }

    include "../database/conexion.php";

    if (!empty($email) && !empty($password) && !empty($nombre) && !empty($apellido) && !empty($dni)) {
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $resultado = mysqli_query($conexion, $sql);
        if (mysqli_num_rows($resultado) > 0) {
            echo "<div class='alert alert-danger m-4'>Email en uso</div>";
        } else {
            $sql = "INSERT INTO usuarios (email, password, rol) VALUES('$email', '$hash', '$rol')";
            $resultado = mysqli_query($conexion, $sql);

            $sql2 = "SELECT id FROM usuarios WHERE email = '$email'";
            $stmt2 = mysqli_query($conexion, $sql2);

            if (mysqli_num_rows($stmt2) > 0) {
                while ($row = mysqli_fetch_assoc($stmt2)) {
                    $id_usuario = $row["id"];
                }
            }

            if ($rol == 1) {    /////////// ROL 1 = ADMIN
                $sql = "INSERT INTO admin (id_usuario, nombre, apellido) VALUES('$id_usuario','$nombre','$apellido')";
                $resultado = mysqli_query($conexion, $sql);
                echo "Registrado como ADMINISTRADOR";
            } elseif ($rol == 2) {    ///////////// ROL 2 = PACIENTE
                $sql = "INSERT INTO pacientes (id_usuario, nombre, apellido, dni) VALUES('$id_usuario','$nombre','$apellido','$dni' )";
                $resultado = mysqli_query($conexion, $sql);
                echo "Registrado como PACIENTE";
            } elseif ($rol == 3) {    ////////////// ROL 3 = MEDICOS
                $sql = "INSERT INTO medicos (id_usuario, nombre, apellido, matricula) VALUES('$id_usuario','$nombre','$apellido','$dni' )";
                $resultado = mysqli_query($conexion, $sql);
                echo "Registrado como PROFESIONAL";
            }
        }
    } else {
        echo "Campos invalidos, por favor complet de nuevo el registro";
    }
}
