<?php

$apellidosFisiatria = ['Michelloud'];
$nombresFisiatria = ['Anabella'];

echo '<select name="fisiatriaSelect" id="fisiatriaSelect" class="form-select form-select-lg mb-4">  <option value="" selected>Profesional</option>';
$var = -1;
foreach ($apellidosFisiatria as $apellido) {
    $var++;
        echo '<option value="' . $apellido . '">' . ucfirst($apellido) . ' ' .ucfirst($nombresFisiatria[$var]) . '</option>';
}
echo '</select>';
