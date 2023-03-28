<?php

$horariosMartesHerrera = ['14:00:00', '14:45:00', '15:30:00', '16:15:00', '17:00:00', '17:45:00', '18:30:00', '19:15:00'];

echo '<select name="horariosMartesHerreraSelect" id="horariosMartesHerreraSelect" class="form-select form-select-lg mb-4" style="display: none"><option value="no">Horario</option>';

foreach ($horariosMartesHerrera as $horario) {

        echo '<option value="' . $horario . '">' . $horario . '</option>';
}
echo '</select>';

