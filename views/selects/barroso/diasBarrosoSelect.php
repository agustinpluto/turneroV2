<?php
echo '';
echo '<select name="diasBarrosoSelect" id="diasBarrosoSelect" class="form-select form-select-lg mb-4" style="display: none"><option value="no">Día</option>';
echo '<br>';
echo '<select name="modoBarroso" id="modoBarroso" class="form-select form-select-lg mb-4" style="display:none" required>
<option value="no" selected>Modalidad</option>
<option value="virtual">Virtual</option>
<option value="presencial">Presencial</option>
</select>';
echo '<select name="tipoBarroso" id="tipoBarroso" class="form-select form-select-lg mb-4" style="display:none" required>
<option value="no" selected>Servicio</option>
<option value="admisión">Entrevista inivial - Admisión (Virtual)</option>
<option value="evaluacion">Evaluación de Perfil Sensorial</option>
<option value="intervision">Intervisión/Supervisión de Caso Clínico</option>
<option value="coordinacion">Coordinación de Equipos</option>
<option value="asesoria">Asesoría de Terapia Ocupacional</option>
</select>';


setlocale(LC_TIME, "es_AR.UTF-8");
$fecha_actual = time();
$fecha_limite = strtotime('+1 month', $fecha_actual);

$martes = strtotime('next Tuesday', $fecha_actual);

$jueves = strtotime('next Thursday', $fecha_actual);



while ($martes <= $fecha_limite) {
    
    $martes_es = strftime('%A %d/%m', $martes);

    echo '<option value="' . date('Y-m-d', $martes) . '">' . ucfirst($martes_es) . '</option>';

    $martes = strtotime('+1 week', $martes);
}



while ($jueves <= $fecha_limite) {
    
    $jueves_es = strftime('%A %d/%m', $jueves);

    echo '<option value="' . date('Y-m-d', $jueves) . '">' . ucfirst($jueves_es) . '</option>';

    $jueves = strtotime('+1 week', $jueves);
}


echo '</select>';
