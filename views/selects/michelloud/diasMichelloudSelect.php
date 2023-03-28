<?php

echo '<select name="diasMichelloudSelect" id="diasMichelloudSelect" class="form-select form-select-lg mb-4"> <option value="no">Día</option>';

setlocale(LC_TIME, 'es_ES');
$fechaActual = strftime('%Y-%m-%d');
$fechaDentroDeUnMes = strftime('%Y-%m-%d', strtotime('+1 month'));
$fecha = strtotime('next Wednesday', strtotime($fechaActual));

while ($fecha <= strtotime('next Wednesday', strtotime($fechaDentroDeUnMes))) {
    $fecha_str = strftime('%Y-%m-%d', $fecha);
    $fecha_fmt = strftime('%A, %d de %B', $fecha);
    echo "<option value=\"$fecha_str\">$fecha_fmt</option>";
    $fecha = strtotime('+1 week', $fecha);
}
echo '</select>';