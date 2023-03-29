<?php

$apellidosPsicologia = ['Bálsamo','Cano', 'Gonzalez', 'Herrera','Molina', 'Paradelo'];
$nombresPsicologia = ['Viviana','Patricia','Iris','Lucas','Romina', 'Constanza'];


echo '<select name="psicologiaSelect" id="psicologiaSelect" class="form-select form-select-lg mb-4"><option>Profesional</option>';
$var = -1;
foreach ($apellidosPsicologia as $apellido) {
    $var++;
    echo '<option value="' . $apellido . '">' . ucfirst($apellido).' '. ucfirst($nombresPsicologia[$var]) . '</option>';

}


echo '</select>';
