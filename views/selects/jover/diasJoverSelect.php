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

setlocale(LC_TIME, "es_AR.UTF-8");
$fecha_actual = time();
$fecha_limite = strtotime('+1 month', $fecha_actual);
$lunes = strtotime('next monday', $fecha_actual);

$miercoles = strtotime('next Wednesday', $fecha_actual);


while ($lunes <= $fecha_limite) {
    
    $lunes_es = strftime('%A %d/%m', $lunes);

    echo '<option value="' . date('Y-m-d', $lunes) . '">' . ucfirst($lunes_es) . '</option>';

    $lunes = strtotime('+1 week', $lunes);
}



while ($miercoles <= $fecha_limite) {
    
    $miercoles_es = strftime('%A %d/%m', $miercoles);

    echo '<option value="' . date('Y-m-d', $miercoles) . '">' . ucfirst($miercoles_es) . '</option>';

    $miercoles = strtotime('+1 week', $miercoles);
}


echo '</select>';
