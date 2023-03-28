<?php

$apellidosTerapiaOcupacional = ['Barroso','Del Río','Martínez'];
$nombresTerapiaOcupacional = ['Yanina','Federica','Daniela'];


echo '<select name="terapiaOcupacionalSelect" id="terapiaOcupacionalSelect" class="form-select form-select-lg mb-4"><option value="no">Profesional</option>';
$var = -1;
foreach ($apellidosTerapiaOcupacional as $apellido) {
    $var++;
    echo '<option value="' . $apellido . '">' . ucfirst($apellido).' '. ucfirst($nombresTerapiaOcupacional[$var]) . '</option>';

}


echo '</select>';