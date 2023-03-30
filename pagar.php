<?php
session_start();
$dni = $_SESSION["dni"];

$payment = $_GET['payment_id'];
$status = $_GET['status'];
$payment_type = $_GET['payment_type'];
$order_id = $_GET['merchant_order_id'];
$fecha_hora = date("Y-m-d H:i:s");

include "./database/conexion.php";
$sql = "INSERT INTO pagos (ID_pago, ID_orden, Estado, ID_paciente, Fecha_Hora) VALUES('$payment','$order_id','$status','$dni','$fecha_hora')";
$resultado = mysqli_query($conexion, $sql);
if ($resultado){
    echo "Pago guardado";
}

CREATE TABLE pagos (
    ID INT NOT NULL AUTO_INCREMENT,
    ID_pago INT NOT NULL,
    ID_orden INT NOT NULL,
    Estado VARCHAR(50) NOT NULL,
    ID_paciente VARCHAR(8),
    Fecha_Hora DATETIME NOT NULL,
    PRIMARY KEY (ID)
  );
  