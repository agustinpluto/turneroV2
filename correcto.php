<?php

$id_transaccion = $_GET['payment_id'];
$estado = $_GET['status'];
$formaDePago = $_GET['payment_type'];
$order_id = $_GET['merchant_order_id'];


echo "<h3>Pago exitoso</h3>";