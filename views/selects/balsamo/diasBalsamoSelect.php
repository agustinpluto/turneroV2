<?php
echo '';
echo '<select name="diasBalsamoSelect" id="diasBalsamoSelect" class="form-select form-select-lg mb-4" style="display: none"><option value="no">Día</option>';
$fechaActual = date('Y-m-d');
$fechaDentroDeUnMes = date('Y-m-d', strtotime('+1 month'));
$fecha = strtotime('next Thursday', strtotime($fechaActual));

while ($fecha <= strtotime('next Thursday', strtotime($fechaDentroDeUnMes))) {
    $fecha_str = date('Y-m-d', $fecha);
    $fecha_fmt = date('l, d F', $fecha);
    echo "<option value=\"$fecha_str\">$fecha_fmt</option>";
    $fecha = strtotime('+1 week', $fecha);
}
echo '</select>';
