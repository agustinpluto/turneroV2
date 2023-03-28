<?php
echo '';
echo '<select name="diasRondineSelect" id="diasRondineSelect" class="form-select form-select-lg mb-4" style="display: none"><option value="no">Día</option>';

setlocale(LC_TIME, "es_AR.UTF-8");
$fecha_actual = time();
$fecha_limite = strtotime('+1 month', $fecha_actual);

$jueves = strtotime('next Thursday', $fecha_actual);


while ($jueves <= $fecha_limite) {
    
    $jueves_es = strftime('%A %d/%m', $jueves);

    echo '<option value="' . date('Y-m-d', $jueves) . '">' . ucfirst($jueves_es) . '</option>';

    $jueves = strtotime('+1 week', $jueves);
}


echo '</select>';
