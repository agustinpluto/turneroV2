<?php
echo '<br>';
echo '<select name="modoCastelari" id="modoCastelari" class="form-select form-select-lg mb-4" style="display:none" required>
<option value="no" selected>Modalidad</option>
<option value="virtual">Virtual</option>
<option value="presencial">Presencial</option>
</select>';

echo '<select name="tipoCastelari" id="tipoCastelari" class="form-select form-select-lg mb-4" style="display:none" required>
<option value="no" selected>Servicio</option>
<option value="consulta">Consulta Presencial</option>
<option value="informe">Informe (Resumen de Historia Clínica)</option>
<option value="receta">Recetas</option>

</select>';
echo '';
echo '<select name="diasCastelariSelect" id="diasCastelariSelect" class="form-select form-select-lg mb-4" style="display: none"><option value="no">Día</option><br>';



setlocale(LC_TIME, "es_AR.UTF-8");
$fecha_actual = time();
$fecha_limite = strtotime('+1 month', $fecha_actual);

$miercoles = strtotime('next Wednesday', $fecha_actual);




while ($miercoles <= $fecha_limite) {
    
    $miercoles_es = strftime('%A %d/%m', $miercoles);

    echo '<option value="' . date('Y-m-d', $miercoles) . '">' . ucfirst($miercoles_es) . '</option>';

    $miercoles = strtotime('+1 week', $miercoles);
}


echo '</select>';
