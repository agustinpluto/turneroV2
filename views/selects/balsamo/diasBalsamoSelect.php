<?php

echo '<br>';
echo '<select name="modoBalsamo" id="modoBalsamo" class="form-select form-select-lg mb-4" style="display:none" required>
<option value="no" selected>Modalidad</option>
<option value="virtual">Virtual</option>
<option value="presencial">Presencial</option>
</select>';

echo '<select name="tipoBalsamo" id="tipoBalsamo" class="form-select form-select-lg mb-4" style="display:none" required>
<option value="no" selected>Servicio</option>
<option value="clinica">Clínica de Niños, Adolescentes y Adultos</option>
<option value="orientacion">Orientación a padres</option>
</select>';


echo '';
echo '<select name="diasBalsamoSelect" id="diasBalsamoSelect" class="form-select form-select-lg mb-4" style="display: none"><option value="no">Día</option>';

setlocale(LC_TIME, "es_AR.UTF-8");
$fecha_actual = time();
$fecha_limite = strtotime('+1 month', $fecha_actual);
$fecha = strtotime('next Thursday', $fecha_actual);

while ($fecha <= $fecha_limite) {
    
    $fecha_es = strftime('%A %d/%m', $fecha);

    echo '<option value="' . date('Y-m-d', $fecha) . '">' . ucfirst($fecha_es) . '</option>';

    $fecha = strtotime('+1 week', $fecha);
}

echo '</select>';