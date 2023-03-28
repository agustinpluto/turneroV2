<?php

$apellidosPsicopedagogia = ['De Uña','Fernandez'];
$nombresPsicopedagogia = ['Guadalupe','Ariel'];


echo '<select name="psicopedagogiaSelect" id="psicopedagogiaSelect" class="form-select form-select-lg mb-4"><option value="no">Profesional</option>';
$var = -1;
foreach ($apellidosPsicopedagogia as $apellido) {
    $var++;
    echo '<option value="' . $apellido . '">' . ucfirst($apellido).' '. ucfirst($nombresPsicopedagogia[$var]) . '</option>';

}


echo '</select>';