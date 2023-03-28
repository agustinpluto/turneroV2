<?php

$horariosLunesJover = [ '09:00:00'];

echo '<select name="horariosLunesJoverSelect" id="horariosLunesJoverSelect" class="form-select form-select-lg mb-4" style="display: none;"><option value="no">Horario</option>';

foreach ($horariosLunesJover as $horario) {

        echo '<option value="' . $horario . '">' . $horario . '</option>';
}
echo '</select>';
