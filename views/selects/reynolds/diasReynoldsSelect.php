<?php
echo '';
echo '<select name="diasReynoldsSelect" id="diasReynoldsSelect" class="form-select form-select-lg mb-4" style="display: none"><option value="no">Día</option><br>';

echo '<br>';
echo '<select name="modoReynolds" id="modoReynolds" class="form-select form-select-lg mb-4" style="display:none" required>
<option value="no" selected>Modalidad</option>
<option value="virtual">Virtual</option>
<option value="presencial">Presencial</option>
</select>';

echo '<select name="tipoReynolds" id="tipoReynolds" class="form-select form-select-lg mb-4" style="display:none" required>
<option value="no" selected>Servicio</option>
<option value="consulta">Consulta Presencial</option>
<option value="informe">Informe (Resumen de Historia Clínica)</option>
<option value="receta">Recetas</option>

</select>';

setlocale(LC_TIME, "es_AR.UTF-8");
$fecha_actual = time();
$fecha_limite = strtotime('+1 month', $fecha_actual);

$martes = strtotime('next Tuesday', $fecha_actual);


while ($martes <= $fecha_limite) {
    
    $martes_es = strftime('%A %d/%m', $martes);

    echo '<option value="' . date('Y-m-d', $martes) . '">' . ucfirst($martes_es) . '</option>';

    $martes = strtotime('+1 week', $martes);
}


echo '</select>';
