<?php

echo '<select name="diasGrosSelect" id="diasGrosSelect" class="form-select form-select-lg mb-4" style="display:none" style="display:none"><option value="no">Dia</option>';

$fechaActual = date('Y-m-d');
$fechaDentroDeUnMes = date('Y-m-d', strtotime('+1 month'));
$fechaLunes = strtotime('next Monday', strtotime($fechaActual));
$fechaMiercoles = strtotime('next Wednesday', strtotime($fechaActual));
$fechaJueves = strtotime('next Thursday', strtotime($fechaActual));

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

while ($fechaJueves <= strtotime('next Thursday', strtotime($fechaDentroDeUnMes))) {
    $fechaJueves_str = date('Y-m-d', $fechaJueves);
    $fechaJueves_fmt = date('l, d F', $fechaJueves);
    echo "<option value=\"$fechaJueves_str\">$fechaJueves_fmt</option>";
    $fechaJueves = strtotime('+1 week', $fechaJueves);
}

echo '</select>';