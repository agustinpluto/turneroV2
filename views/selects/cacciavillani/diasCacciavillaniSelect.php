<?php
echo '';
echo '<select name="diasCacciavillaniSelect" id="diasCacciavillaniSelect" class="form-select form-select-lg mb-4" style="display: none"> <option value="no">Dia</option>';

setlocale(LC_TIME, "es_AR.UTF-8");
$fecha_actual = time();
$fecha_limite = strtotime('+1 month', $fecha_actual);
$martes = strtotime('next tuesday', $fecha_actual);


while ($martes <= $fecha_limite) {
    
    $martes_es = strftime('%A %d/%m', $martes);

    echo '<option value="' . date('Y-m-d', $martes) . '">' . ucfirst($martes_es) . '</option>';

    $martes = strtotime('+1 week', $martes);
}



echo '</select>';
