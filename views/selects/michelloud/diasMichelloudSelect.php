<?php

echo '<select name="diasMichelloudSelect" id="diasMichelloudSelect" class="form-select form-select-lg mb-4"> <option value="no">Día</option>';

// KK echo '';
// KK $fechaActual = date('Y-m-d');
// KK $fechaDentroDeUnMes = date('Y-m-d', strtotime('+1 month'));
// KK $fecha = strtotime('next Wednesday', strtotime($fechaActual));
// KK 
// KK while ($fecha <= strtotime('next Wednesday', strtotime($fechaDentroDeUnMes))) {
// KK     $fecha_str = date('Y-m-d', $fecha);
// KK     $fecha_fmt = date('l, d F', $fecha);
// KK     echo "<option value=\"$fecha_str\">$fecha_fmt</option>";
// KK     $fecha = strtotime('+1 week', $fecha);
// KK }
setlocale(LC_TIME, "es_AR.UTF-8");
// Definimos la fecha actual
$fecha_actual = time();

// Definimos la fecha límite (un mes a partir de la fecha actual)
$fecha_limite = strtotime('+1 month', $fecha_actual);

// Inicializamos la fecha en el primer miércoles a partir de la fecha actual
$fecha = strtotime('next Wednesday', $fecha_actual);

// Recorremos las fechas hasta la fecha límite
while ($fecha <= $fecha_limite) {
    // Mostramos la fecha en el formato deseado (día de la semana y día del mes en español)
    $fecha_es = strftime('%A, %d de %B', $fecha);

    // Mostramos la opción del select
    echo '<option value="' . date('Y-m-d', $fecha) . '">' . strtoupper($fecha_es) . '</option>';

    // Avanzamos a la siguiente semana
    $fecha = strtotime('+1 week', $fecha);
}

echo '</select>';
