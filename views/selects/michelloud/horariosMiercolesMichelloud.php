<?php

$horariosMiercolesMichelloud = ['10:00:00'];

echo '<select name="horariosMiercolesMichelloudSelect" id="horariosMiercolesMichelloudSelect" class="form-select form-select-lg mb-4"><option>Horario</option>';

foreach ($horariosMiercolesMichelloud as $horario) {

        echo '<option value="' . $horario . '">' . $horario . '</option>';
}
echo '</select></div>';
