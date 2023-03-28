<?php
echo '';
echo '<select name="diasRosSelect" id="diasRosSelect" class="form-select form-select-lg mb-4" style="display: none"> <option value="no">Dia</option>';

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
