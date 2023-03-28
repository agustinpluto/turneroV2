<?php

$horariosMartesDeUna = ['09:00:00', '09:45:00', '10:30:00', '11:15:00'];

echo '<select name="horariosMartesDeUnaSelect" id="horariosMartesDeUnaSelect" class="form-select form-select-lg mb-4" style="display: none"><option value="no">Horario</option>';

foreach ($horariosMartesDeUna as $horario) {

        echo '<option value="' . $horario . '">' . $horario . '</option>';
}
echo '</select>';
