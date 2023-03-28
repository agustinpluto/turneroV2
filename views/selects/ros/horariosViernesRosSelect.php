<?php

$horariosViernesRos = ['10:00:00'];

echo '<select name="horariosViernesRosSelect" id="horariosViernesRosSelect" class="form-select form-select-lg mb-4" style="dispay: none;"><option value="no">Horario</option>';

foreach ($horariosViernesRos as $horario) {

        echo '<option value="' . $horario . '">Por la mañana</option>';
}
echo '</select>';
