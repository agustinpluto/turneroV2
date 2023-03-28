<?php

$horariosCacciavillani = ['10:00:00'];

echo '<select name="horariosCacciavillaniSelect" id="horariosCacciavillaniSelect" class="form-select form-select-lg mb-4" style="dispay: none;"><option value="no">Horario</option>';

foreach ($horariosCacciavillani as $horario) {

        echo '<option value="' . $horario . '">Por la mañana</option>';
}
echo '</select>';
