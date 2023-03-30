<?php
function eliminar($id_turno)
{
    include "./database/conexion.php";
    $sql = "DELETE FROM turnos WHERE id = '$id_turno'";
    $result = mysqli_query($conexion, $sql);
    $sql1 = "DELETE FROM turnost WHERE id_turno = '$id_turno'";
    $result1 = mysqli_query($conexion, $sql1);
}

session_start();

if (isset($_GET['id'])) {
    $id_turno = $_GET['id'];
    // Ejecutar la función de eliminación
    eliminar($id_turno);
    header("location:  views/administrador/turnos.php");
}
