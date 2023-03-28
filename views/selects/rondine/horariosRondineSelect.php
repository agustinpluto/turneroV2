<?php

$horariosRondine = ['17:45:00', '18:30:00'];

echo '<select name="horariosRondineSelect" id="horariosRondineSelect" class="form-select form-select-lg mb-4" style="display: none"><option value="no">Horario</option>';

foreach ($horariosRondine as $horario) {

        echo '<option value="' . $horario . '">' . $horario . '</option>';
}
echo '</select>';
