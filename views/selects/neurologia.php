<?php

$apellidosNeurologia = ['Ros'];
$nombresNeurologia = ['Lucas Nicolás'];

echo '<select name="neurologiaSelect" id="neurologiaSelect" class="form-select form-select-lg mb-4"> <option value="no">Profesional</option>';
foreach ($apellidosNeurologia as $apellido) {
    foreach ($nombresNeurologia as $nombre){
        echo '<option value="'.$apellido.'">' . ucfirst($apellido).' '.ucfirst($nombre) . '</option>';
    }
}
echo '</select>';

