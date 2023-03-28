<?php
echo '<select name="diasJoverSelect" id="diasJoverSelect" class="form-select form-select-lg mb-4" style="display: none"><option value="no">Día</option>';

$fechaActual = date('Y-m-d');
$fechaDentroDeUnMes = date('Y-m-d', strtotime('+1 month'));
$fechaLunes = strtotime('next Monday', strtotime($fechaActual));
$fechaMiercoles = strtotime('next Wednesday', strtotime($fechaActual));

while ($fechaLunes <= strtotime('next Monday', strtotime($fechaDentroDeUnMes))) {
    $fechaLunes_str = date('Y-m-d', $fechaLunes);
    $fechaLunes_fmt = date('l, d F', $fechaLunes);
    echo "<option value=\"$fechaLunes_str\">$fechaLunes_fmt</option>";
    $fechaLunes = strtotime('+1 week', $fechaLunes);
}

while ($fechaMiercoles <= strtotime('next Wednesday', strtotime($fechaDentroDeUnMes))) {
    $fechaMiercoles_str = date('Y-m-d', $fechaMiercoles);
    $fechaMiercoles_fmt = date('l, d F', $fechaMiercoles);
    echo "<option value=\"$fechaMiercoles_str\">$fechaMiercoles_fmt</option>";
    $fechaMiercoles = strtotime('+1 week', $fechaMiercoles);
}

echo '</select>';