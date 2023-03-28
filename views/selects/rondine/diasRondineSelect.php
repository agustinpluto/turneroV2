<?php
echo '';
echo '<select name="diasRondineSelect" id="diasRondineSelect" class="form-select form-select-lg mb-4" style="display: none"><option value="no">Día</option>';
$fechaActual = date('Y-m-d');
$fechaDentroDeUnMes = date('Y-m-d', strtotime('+1 month'));

$fechaJueves = strtotime('next Thursday', strtotime($fechaActual));

while ($fechaJueves <= strtotime('next Thursday', strtotime($fechaDentroDeUnMes))) {
    $fechaJueves_str = date('Y-m-d', $fechaJueves);
    $fechaJueves_fmt = date('l, d F', $fechaJueves);
    echo "<option value=\"$fechaJueves_str\">$fechaJueves_fmt</option>";
    $fechaJueves = strtotime('+1 week', $fechaJueves);
}

echo '</select>';

setlocale(LC_TIME, "es_AR.UTF-8");
$fecha_actual = time();
$fecha_limite = strtotime('+1 month', $fecha_actual);

$jueves = strtotime('next Thursday', $fecha_actual);


while ($jueves <= $fecha_limite) {
    
    $jueves_es = strftime('%A %d/%m', $jueves);

    echo '<option value="' . date('Y-m-d', $jueves) . '">' . ucfirst($jueves_es) . '</option>';

    $jueves = strtotime('+1 week', $jueves);
}


echo '</select>';
