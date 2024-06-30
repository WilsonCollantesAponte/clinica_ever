<?php
$conexion = mysqli_connect("localhost", "root", "", "clinica", 3306);

if (!$conexion) {
    die("Conexión con la base de datos interrumpida: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $dni = $_POST['dni'];
    $tipoDocumento = $_POST['tipoDocumento'] ?? "";
    $fechaAtencion = $_POST['fechaAtencion'] ?? "";
    $horaAtencion = $_POST['horaAtencion'] ?? "";
    $primerNombre = $_POST['primerNombre'] ?? "";
    $segundoNombre = $_POST['segundoNombre'] ?? "";
    $apellidoPaterno = $_POST['apellidoPaterno'] ?? "";
    $apellidoMaterno = $_POST['apellidoMaterno'] ?? "";
    $edad = $_POST['edad'] ?? "";
    $sexo = $_POST['sexo'] ?? "";
    $fechaNacimiento = $_POST['fechaNacimiento'] ?? "";
    $estadoCivil = $_POST['estadoCivil'] ?? "";
    $departamento = $_POST['departamento'] ?? "";
    $provincia = $_POST['provincia'] ?? "";
    $distrito = $_POST['distrito'] ?? "";
    $localidad = $_POST['localidad'] ?? "";
    $direccion = $_POST['direccion'] ?? "";
    $tipoAtencion = $_POST['tipoAtencion'] ?? "";
    $servicio = $_POST['servicio'] ?? "";
    $tiempoEnfermedad = $_POST['tiempoEnfermedad'] ?? "";
    $sintomas = $_POST['sintomas'] ?? "";
    $relato = $_POST['relato'] ?? "";
    $antecedentes = $_POST['antecedentes'] ?? "";
    $frecuenciaCardiaca = $_POST['frecuenciaCardiaca'] ?? "";
    $frecuenciaRespiratoria = $_POST['frecuenciaRespiratoria'] ?? "";
    $temperatura = $_POST['temperatura'] ?? "";
    $presionArterial = $_POST['presionArterial'] ?? "";
    $saturacionOxigeno = $_POST['saturacionOxigeno'] ?? "";
    $diagnostico = $_POST['diagnostico'] ?? "";
    $tipoDX = $_POST['tipoDX'] ?? "";
    $cie10 = $_POST['cie10'] ?? "";
    $tratamiento = $_POST['tratamiento'] ?? "";
    $nombrePrimerAcomp = $_POST['nombrePrimerAcomp'] ?? "";
    $nombreSegundoAcomp = $_POST['nombreSegundoAcomp'] ?? "";
    $apellidoPaternoAcomp = $_POST['apellidoPaternoAcomp'] ?? "";
    $apellidoMaternoAcomp = $_POST['apellidoMaternoAcomp'] ?? "";
    $dniAcompanante = $_POST['dniAcompanante'] ?? "";
    $parentesco = $_POST['parentesco'] ?? "";
    $destinoPaciente = $_POST['destinoPaciente'] ?? "";
    $establecimientoReferencia = $_POST['establecimientoReferencia'] ?? "";
    $evolucion = $_POST['evolucion'] ?? "";
    $fechaEgreso = $_POST['fechaEgreso'] ?? "";
    $horaEgreso = $_POST['horaEgreso'] ?? "";
    $nombreResponsableAlta = $_POST['nombreResponsableAlta'] ?? "";
    $firma = $_POST['firma'] ?? "";
    $idPersonalMedico = $_POST['idPersonalMedico'] ?? 0;

    $query = "UPDATE historia_clinica SET 
              dni = '$dni', tipoDocumento = '$tipoDocumento', fechaAtencion = '$fechaAtencion', horaAtencion = '$horaAtencion', 
              primerNombre = '$primerNombre', segundoNombre = '$segundoNombre', apellidoPaterno = '$apellidoPaterno', 
              apellidoMaterno = '$apellidoMaterno', edad = '$edad', sexo = '$sexo', fechaNacimiento = '$fechaNacimiento', 
              estadoCivil = '$estadoCivil', departamento = '$departamento', provincia = '$provincia', distrito = '$distrito', 
              localidad = '$localidad', direccion = '$direccion', tipoAtencion = '$tipoAtencion', servicio = '$servicio', 
              tiempoEnfermedad = '$tiempoEnfermedad', sintomas = '$sintomas', relato = '$relato', antecedentes = '$antecedentes', 
              frecuenciaCardiaca = '$frecuenciaCardiaca', frecuenciaRespiratoria = '$frecuenciaRespiratoria', temperatura = '$temperatura', 
              presionArterial = '$presionArterial', saturacionOxigeno = '$saturacionOxigeno', diagnostico = '$diagnostico', 
              tipoDX = '$tipoDX', cie10 = '$cie10', tratamiento = '$tratamiento', nombrePrimerAcomp = '$nombrePrimerAcomp', 
              nombreSegundoAcomp = '$nombreSegundoAcomp', apellidoPaternoAcomp = '$apellidoPaternoAcomp', apellidoMaternoAcomp = '$apellidoMaternoAcomp', 
              dniAcompanante = '$dniAcompanante', parentesco = '$parentesco', destinoPaciente = '$destinoPaciente', 
              establecimientoReferencia = '$establecimientoReferencia', evolucion = '$evolucion', fechaEgreso = '$fechaEgreso', 
              horaEgreso = '$horaEgreso', nombreResponsableAlta = '$nombreResponsableAlta', firma = '$firma', idPersonalMedico = '$idPersonalMedico' 
              WHERE id = '$id'";

    if (mysqli_query($conexion, $query)) {
        echo "Historia clínica actualizada exitosamente.";
    } else {
        echo "Error al actualizar la historia clínica: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}
?>
