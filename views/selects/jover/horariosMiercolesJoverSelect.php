<?php

$horariosMiercolesJover = ['09:00:00'];

echo '<select name="horariosMiercolesJoverSelect" id="horariosMiercolesJoverSelect" class="form-select form-select-lg mb-4" style="display: none;">v<option value="no">Horario</option>';

foreach ($horariosMiercolesJover as $horario) {

        echo '<option value="' . $horario . '">' . $horario . '</option>';
}
echo '</select>';
