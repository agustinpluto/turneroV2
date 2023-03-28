<?php

echo '<select name="diasMichelloudSelect" id="diasMichelloudSelect" class="form-select form-select-lg mb-4"> <option value="no">Día</option>';

// Establecer la configuración regional en español
setlocale(LC_TIME, 'es_ES.UTF-8');

// Definir la fecha actual y la fecha límite (30 días después)
$hoy = new DateTime();
$limite = new DateTime('+30 days');

// Generar opciones para los martes y jueves hasta la fecha límite
while ($hoy <= $limite) {
    $dia_semana = $hoy->format('w');
    if ($dia_semana == 4) {
        echo '<option value="' . $hoy->format('Y-m-d') . '">' . ucfirst(strftime('%A, %d %B %Y', $hoy->getTimestamp())) . '</option>';
    }
    $hoy->modify('+1 day');
}