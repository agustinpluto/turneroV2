<?php

$horariosParadeloSelect = ['10:00:00'];

echo '<select name="horariosParadeloSelect" id="horariosParadeloSelect" class="form-select form-select-lg mb-4"><option>Horario</option>';

foreach ($horariosParadeloSelect as $horario) {

        echo '<option value="' . $horario . '">' . $horario . '</option>';
}
echo '</select></div>';
