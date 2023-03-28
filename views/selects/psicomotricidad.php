<?php

$apellidosPsicomotricidad = ['Zabala'];
$nombresPsicomotricidad = ['Laura'];

echo '<select name="psicomotricidadSelect" id="psicomotricidadSelect" class="form-select form-select-lg mb-4"> <option value="no">Profesional</option>';
foreach ($apellidosPsicomotricidad as $apellido) {
    foreach ($nombresPsicomotricidad as $nombre){
        echo '<option value="'.$apellido.'">' . ucfirst($apellido).' '.ucfirst($nombre) . '</option>';
    }
}
echo '</select>';