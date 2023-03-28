<?php

$horariosJuevesMazolla = ['14:45:00', '15:30:00', '16:15:00', '17:00:00', '17:45:00', '18:30:00'];

echo '<select name="horariosJuevesMazzolaSelect" id="horariosJuevesMazzolaSelect" class="form-select form-select-lg mb-4" style="dispay: none;"><option value="no">Horario</option>';

foreach ($horariosJuevesMazolla as $horario) {

        echo '<option value="' . $horario . '">' . $horario . '</option>';
}
echo '</select>';
