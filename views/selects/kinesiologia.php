<?php

$apellidosKinesiologia = ['Gros','Juarez'];
$nombresKinesiologia = ['Valeria','Verónica'];


echo '<select name="kinesiologiaSelect" id="kinesiologiaSelect" class="form-select form-select-lg mb-4"><option value="no">Profesional</option>';
$var = -1;
foreach ($apellidosKinesiologia as $apellido) {
    $var++;
    echo '<option value="' . $apellido . '">' . ucfirst($apellido).' '. ucfirst($nombresKinesiologia[$var]) . '</option>';

}


echo '</select>';