<?php

$horariosMiercolesGros = ['09:00:00', '09:45:00', '10:30:00', '11:15:00','14:45:00', '15:30:00', '16:15:00', '17:00:00', '17:45:00'];

echo '<select name="horariosMiercolesGrosSelect" id="horariosMiercolesGrosSelect" class="form-select form-select-lg mb-4" style="display: none;"><option value="no">Horario</option>';

foreach ($horariosMiercolesGros as $horario) {

        echo '<option value="' . $horario . '">' . $horario . '</option>';
}
echo '</select>';