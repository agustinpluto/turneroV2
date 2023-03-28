<?php

echo '<select name="diasMichelloudSelect" id="diasMichelloudSelect" class="form-select form-select-lg mb-4"> <option value="no">Día</option>';


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
    $fecha_es = strftime('%A %d/%m', $fecha);

    // Mostramos la opción del select
    echo '<option value="' . date('Y-m-d', $fecha) . '">' . ucfirst($fecha_es) . '</option>';

    // Avanzamos a la siguiente semana
    $fecha = strtotime('+1 week', $fecha);
}

echo '</select>';
