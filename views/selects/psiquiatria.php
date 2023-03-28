<?php

$apellidosPsiquiatria = ['Castelari','Reynolds'];
$nombresPsiquiatria = ['Natalia','Carolina'];


echo '<select name="psiquiatriaSelect" id="psiquiatriaSelect" class="form-select form-select-lg mb-4"><option>Profesional</option>';
$var = -1;
foreach ($apellidosPsiquiatria as $apellido) {
    $var++;
    echo '<option value="' . $apellido . '">' . ucfirst($apellido).' '. ucfirst($nombresPsiquiatria[$var]) . '</option>';

}


echo '</select>';