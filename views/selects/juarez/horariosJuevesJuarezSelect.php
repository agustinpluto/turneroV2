<?php

$horariosJuevesJuarez =["9:00:00", "9:45:00", "14:45:00", "15:30:00", "16:15:00", "17:00:00", "17:45:00", "18:30:00"];


echo '<select name="horariosJuevesJuarezSelect" id="horariosJuevesJuarezSelect" class="form-select form-select-lg mb-4" style="display: none;"><option value="no">Horario</option>';

foreach ($horariosJuevesJuarez as $horario) {

        echo '<option value="' . $horario . '">' . $horario . '</option>';
}
echo '</select>';
