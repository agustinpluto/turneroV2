<?php

echo '<select name="diasCorreaSelect" id="diasCorreaSelect" class="form-select form-select-lg mb-4" style="display:none" style="display:none"><option value="no">Dia</option>';

$fechaActual = date('Y-m-d');
$fechaDentroDeUnMes = date('Y-m-d', strtotime('+1 month'));
$fechaMartes = strtotime('next Tuesday', strtotime($fechaActual));
$fechaJueves = strtotime('next Thursday', strtotime($fechaActual));

while ($fechaMartes <= strtotime('next Wednesday', strtotime($fechaDentroDeUnMes))) {
    $fechaMartes_str = date('Y-m-d', $fechaMartes);
    $fechaMartes_fmt = date('l, d F', $fechaMartes);
    echo "<option value=\"$fechaMartes_str\">$fechaMartes_fmt</option>";
    $fechaMartes = strtotime('+1 week', $fechaMartes);
}
while ($fechaJueves <= strtotime('next Thursday', strtotime($fechaDentroDeUnMes))) {
    $fechaJueves_str = date('Y-m-d', $fechaJueves);
    $fechaJueves_fmt = date('l, d F', $fechaJueves);
    echo "<option value=\"$fechaJueves_str\">$fechaJueves_fmt</option>";
    $fechaJueves = strtotime('+1 week', $fechaJueves);
}
echo '</select>';