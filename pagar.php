<?php
session_start();
$id = $_SESSION["id"];

$payment = $_GET['payment_id'];
$status = $_GET['status'];
$payment_type = $_GET['payment_type'];
$order_id = $_GET['merchant_order_id'];
$fecha_hora = date("Y-m-d H:i:s");

include "./database/conexion.php";
$sql = "INSERT INTO pagos (ID_pago, ID_orden, Estado, ID_paciente, Fecha_Hora) VALUES('$payment','$order_id','$status','$id','$fecha_hora')";
$resultado = mysqli_query($conexion, $sql);
if ($resultado){
    echo "Pago guardado";
}
