<?php

$horariosJuevesZabala = ['15:30:00', '16:15:00', '17:00:00', '17:45:00', '18:30:00'];

echo '<select name="horariosJuevesZabalaSelect" id="horariosJuevesZabalaSelect" class="form-select form-select-lg mb-4" style="dispay: none;"><option value="no">Horario</option>';

foreach ($horariosJuevesZabala as $horario) {

    echo '<option value="' . $horario . '">'.$horario.'</option>';
}
echo '</select>';
