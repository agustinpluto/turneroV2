<?php
echo '';
echo '<select name="diasRondineSelect" id="diasRondineSelect" class="form-select form-select-lg mb-4" style="display: none"><option value="no">Día</option>';
$fechaActual = date('Y-m-d');
$fechaDentroDeUnMes = date('Y-m-d', strtotime('+1 month'));

$fechaJueves = strtotime('next Thursday', strtotime($fechaActual));

while ($fechaJueves <= strtotime('next Thursday', strtotime($fechaDentroDeUnMes))) {
    $fechaJueves_str = date('Y-m-d', $fechaJueves);
    $fechaJueves_fmt = date('l, d F', $fechaJueves);
    echo "<option value=\"$fechaJueves_str\">$fechaJueves_fmt</option>";
    $fechaJueves = strtotime('+1 week', $fechaJueves);
}

echo '</select>';
