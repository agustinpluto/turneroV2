<?php

function getApellidoPaciente($dni, $conexion)
{   
    
    $sql_paciente = "SELECT * FROM pacientes WHERE dni = '$dni'";
    $resultado_paciente = mysqli_query($conexion, $sql_paciente);
    while ($row = mysqli_fetch_assoc($resultado_paciente)) {
        $apellido = $row['apellido'];
        return $apellido;
    }
    
}
function getNombrePaciente($dni, $conexion)
{   
    
    $sql_paciente = "SELECT * FROM pacientes WHERE dni = '$dni'";
    $resultado_paciente = mysqli_query($conexion, $sql_paciente);
    while ($row = mysqli_fetch_assoc($resultado_paciente)) {
        $nombre = $row['nombre'];
        return $nombre;
    }
    
}
function getMatricula($apellido, $conexion)
{   
    $matricula = null;
    $sql_medico = "SELECT * FROM medicos WHERE apellido = '$apellido'";
    $resultado_medico = mysqli_query($conexion, $sql_medico);

    while ($row = mysqli_fetch_assoc($resultado_medico)) {
        $matricula = $row['matricula'];
        return $matricula;
    }
    
}

function getMail($apellido, $conexion)
{   
    $email = null;
    $sql_medico = "SELECT * FROM medicos WHERE apellido = '$apellido'";
    $resultado_medico = mysqli_query($conexion, $sql_medico);

    while ($row = mysqli_fetch_assoc($resultado_medico)) {
        $email = $row['email'];
        return $email;
    }
    
}
