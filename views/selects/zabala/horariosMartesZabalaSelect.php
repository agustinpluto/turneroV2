<?php

$horariosMartesZabala = ['17:45:00', '18:30:00', '19:15:00'];

echo '<select name="horariosMartesZabalaSelect" id="horariosMartesZabalaSelect" class="form-select form-select-lg mb-4" style="dispay: none;"><option value="no">Horario</option>';

foreach ($horariosMartesZabala as $horario) {

    echo '<option value="' . $horario . '">'.$horario.'</option>';
}
echo '</select>';
