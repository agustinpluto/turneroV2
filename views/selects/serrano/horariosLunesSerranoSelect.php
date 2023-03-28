<?php

$horariosLunesSerrano = ['09:00:00', '09:45:00', '10:30:00', '11:15:00'];

echo '<select name="horariosLunesSerranoSelect" id="horariosLunesSerranoSelect" class="form-select form-select-lg mb-4" style="display: none;"><option value="no">Horario</option>';

foreach ($horariosLunesSerrano as $horario) {

        echo '<option value="' . $horario . '">' . $horario . '</option>';
}
echo '</select>';
