<?php

$apellidosNutricion = ['Cacciavillani'];
$nombresNutricion = ['María José'];

echo '<select name="nutricionSelect" id="nutricionSelect" class="form-select form-select-lg mb-4"><option value="no">Profesional</option>';
foreach ($apellidosNutricion as $apellido) {
    foreach ($nombresNutricion as $nombre){
        echo '<option value="'.$apellido.'">' . ucfirst($apellido).' '.ucfirst($nombre) . '</option>';
    }
}
echo '</select>';

