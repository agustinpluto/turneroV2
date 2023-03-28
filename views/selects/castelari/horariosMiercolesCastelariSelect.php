<?php

$horariosMiercolesCastelari = ['16:00:00', '17:00:00', '18:00:00', '19:00:00'];

echo '<select name="horariosMiercolesCastelariSelect" id="horariosMiercolesCastelariSelect" class="form-select form-select-lg mb-4" style="display: none"><option value="no">Horario</option>';

foreach ($horariosMiercolesCastelari as $horario) {

        echo '<option value="' . $horario . '">' . $horario . '</option>';
}
echo '</select>';
