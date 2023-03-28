<?php
function repetido($conexion, $matricula, $fecha, $hora)
{
    $sql = "SELECT * FROM turnos WHERE medico = '$matricula' AND fecha = '$fecha' AND hora = '$hora'";

    $resultado = mysqli_query($conexion, $sql);

    if (mysqli_num_rows($resultado) > 0) {
        return true;
    } else {
        return false;
    }
}
