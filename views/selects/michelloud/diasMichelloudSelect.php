<?php

echo '<select name="diasMichelloudSelect" id="diasMichelloudSelect" class="form-select form-select-lg mb-4"> <option value="no">Día</option>';

setlocale(LC_TIME, "es_AR.UTF-8");
$fecha_actual = time();
$fecha_limite = strtotime('+1 month', $fecha_actual);
$fecha = strtotime('next Wednesday', $fecha_actual);

while ($fecha <= $fecha_limite) {
    
    $fecha_es = strftime('%A %d/%m', $fecha);

    echo '<option value="' . date('Y-m-d', $fecha) . '">' . ucfirst($fecha_es) . '</option>';

    $fecha = strtotime('+1 week', $fecha);
}

echo '</select>';
