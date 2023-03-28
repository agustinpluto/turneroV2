<?php

$horariosJuevesCorrea = ['08:15:00','09:00:00', '09:45:00','10:30:00' ];

echo '<select name="horariosJuevesCorreaSelect" id="horariosJuevesCorreaSelect" class="form-select form-select-lg mb-4" style="display: none"><option value="no">Horario</option>';

foreach ($horariosJuevesCorrea as $horario) {

        echo '<option value="' . $horario . '">' . $horario . '</option>';
}
echo '</select>';