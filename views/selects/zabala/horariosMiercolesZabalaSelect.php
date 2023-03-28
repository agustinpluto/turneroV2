<?php

$horariosMiercolesZabala = ['15:30:00', '16:15:00', '17:00:00', '17:45:00', '18:30:00'];

echo '<select name="horariosMiercolesZabalaSelect" id="horariosMiercolesZabalaSelect" class="form-select form-select-lg mb-4" style="dispay: none;"><option value="no">Horario</option>';

foreach ($horariosMiercolesZabala as $horario) {

        echo '<option value="' . $horario . '">'.$horario.'</option>';
}
echo '</select>';
