<?php

echo '<select name="diasHerreraSelect" id="diasHerreraSelect" class="form-select form-select-lg mb-4" style="display:none" style="display:none"><option value="no">Día</option>';

$fechaActual = date('Y-m-d');
$fechaDentroDeUnMes = date('Y-m-d', strtotime('+1 month'));
$fechaMiercoles = strtotime('next Wednesday', strtotime($fechaActual));
$fechaMartes = strtotime('next Tuesday', strtotime($fechaActual));

while ($fechaMiercoles <= strtotime('next Wednesday', strtotime($fechaDentroDeUnMes))) {
    $fechaMiercoles_str = date('Y-m-d', $fechaMiercoles);
    $fechaMiercoles_fmt = date('l, d F', $fechaMiercoles);
    echo "<option value=\"$fechaMiercoles_str\">$fechaMiercoles_fmt</option>";
    $fechaMiercoles = strtotime('+1 week', $fechaMiercoles);
}

while ($fechaMartes <= strtotime('next Tuesday', strtotime($fechaDentroDeUnMes))) {
    $fechaMartes_str = date('Y-m-d', $fechaMartes);
    $fechaMartes_fmt = date('l, d F', $fechaMartes);
    echo "<option value=\"$fechaMartes_str\">$fechaMartes_fmt</option>";
    $fechaMartes = strtotime('+1 week', $fechaMartes);
}

echo '</select>';