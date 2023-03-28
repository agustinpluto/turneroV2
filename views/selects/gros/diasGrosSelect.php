<?php

echo '<select name="diasGrosSelect" id="diasGrosSelect" class="form-select form-select-lg mb-4" style="display:none" style="display:none"><option value="no">Dia</option>';

echo '</select>';
setlocale(LC_TIME, "es_AR.UTF-8");
$fecha_actual = time();
$fecha_limite = strtotime('+1 month', $fecha_actual);
$lunes = strtotime('next monday', $fecha_actual);

$miercoles = strtotime('next Wednesday', $fecha_actual);
$jueves = strtotime('next Thursday', $fecha_actual);


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

while ($jueves <= $fecha_limite) {
    
    $jueves_es = strftime('%A %d/%m', $jueves);

    echo '<option value="' . date('Y-m-d', $jueves) . '">' . ucfirst($jueves_es) . '</option>';

    $jueves = strtotime('+1 week', $jueves);
}


echo '</select>';

