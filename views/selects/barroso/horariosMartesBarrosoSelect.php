<?php

$horariosBarrosoMartes = ['10:00:00', '10:45:00', '11:30:00', '12:15:00', '15:30:00', '16:15:00', '17:00:00', '17:45:00', '18:30:00', '19:15:00'];

echo '<select name="horariosMartesBarrosoSelect" id="horariosMartesBarrosoSelect" class="form-select form-select-lg mb-4" style="display: none;"><option value="no">Horario</option>';

foreach ($horariosBarrosoMartes as $horario) {

        echo '<option value="' . $horario . '">' . $horario . '</option>';
}
echo '</select>';
