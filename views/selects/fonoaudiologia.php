<?php

$apellidosFonoaudiologia = ['Correa','Jover', 'Mazzola', 'Serrano'];
$nombresFonoaudiologia = ['Lis','Lorena','Ludmila','Nerina'];


echo '<select name="fonoaudiologiaSelect" id="fonoaudiologiaSelect" class="form-select form-select-lg mb-4"> <option value="no">Profesional</option>';
$var = -1;
foreach ($apellidosFonoaudiologia as $apellido) {
    $var++;
    echo '<option value="' . $apellido . '">' . ucfirst($apellido).' '. ucfirst($nombresFonoaudiologia[$var]) . '</option>';

}


echo '</select>';



