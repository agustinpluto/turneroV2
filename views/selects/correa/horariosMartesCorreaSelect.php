<?php

$horariosMartesCorrea = ['09:00:00', '09:45:00'];

echo '<select name="horariosMartesCorreaSelect" id="horariosMartesCorreaSelect" class="form-select form-select-lg mb-4"><option value="no">Horario</option>';

foreach ($horariosMartesCorrea as $horario) {

        echo '<option value="' . $horario . '">' . $horario . '</option>';
}
echo '</select>';