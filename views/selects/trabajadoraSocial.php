<?php

$apellidosTrabajadoraSocial = ['Rondine'];
$nombresTrabajadoraSocial = ['Julieta'];


echo '<select name="trabajadoraSocialSelect" id="trabajadoraSocialSelect" class="form-select form-select-lg mb-4"><option>Profesional</option>';
$var = -1;
foreach ($apellidosTrabajadoraSocial as $apellido) {
    $var++;
    echo '<option value="' . $apellido . '">' . ucfirst($apellido).' '. ucfirst($nombresTrabajadoraSocial[$var]) . '</option>';

}


echo '</select>';