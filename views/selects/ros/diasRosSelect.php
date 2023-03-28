<?php
echo '';
echo '<select name="diasRosSelect" id="diasRosSelect" class="form-select form-select-lg mb-4" style="display: none"> <option value="no">Dia</option>';
$fechaActual = date('Y-m-d');
$fechaDentroDeUnMes = date('Y-m-d', strtotime('+1 month'));
$fecha = strtotime('next Friday', strtotime($fechaActual));

while ($fecha <= strtotime('next Friday', strtotime($fechaDentroDeUnMes))) {
    $fecha_str = date('Y-m-d', $fecha);
    $fecha_fmt = date('l, d F', $fecha);
    echo "<option value=\"$fecha_str\">$fecha_fmt</option>";
    $fecha = strtotime('+1 week', $fecha);
}
echo '</select>';

setlocale(LC_TIME, "es_AR.UTF-8");
$fecha_actual = time();
$fecha_limite = strtotime('+1 month', $fecha_actual);

$viernes = strtotime('next Friday', $fecha_actual);


while ($viernes <= $fecha_limite) {
    
    $viernes_es = strftime('%A %d/%m', $viernes);

    echo '<option value="' . date('Y-m-d', $viernes) . '">' . ucfirst($viernes_es) . '</option>';

    $viernes = strtotime('+1 week', $viernes);
}

echo '</select>';
