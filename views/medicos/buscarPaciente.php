<?php
include "../../database/conexion.php";

$apellido = $_GET['apellido'];

$sql = "SELECT * FROM pacientes WHERE apellido = '$apellido'";
$result = mysqli_query($conexion, $sql);

while ($row=mysqli_fetch_assoc($result)){
    echo $row['nombre'];
}