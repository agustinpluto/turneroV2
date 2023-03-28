<?php

$horariosMartesReynolds = ['08:00:00', '09:00:00', '10:00:00', '11:00:00', '12:00:00', '13:00:00', '14:00:00', '15:00:00', '16:00:00'];

echo '<select name="horariosMartesReynoldsSelect" id="horariosMartesReynoldsSelect" class="form-select form-select-lg mb-4" style="display: none"><option value="no">Horario</option>';

foreach ($horariosMartesReynolds as $horario) {

        echo '<option value="' . $horario . '">' . $horario . '</option>';
}
echo '</select>';
