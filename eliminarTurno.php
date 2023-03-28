<?php
function eliminar($id_turno)
{
    include "./database/conexion.php";
    $sql = "DELETE FROM turnos WHERE id = '$id_turno'";
    $result = mysqli_query($conexion, $sql);

}

session_start();

if (isset($_GET['id'])) {
    $id_turno = $_GET['id'];
    // Ejecutar la función de eliminación
    eliminar($id_turno);
    header("location:  views/pacientes/turnos.php");
}
