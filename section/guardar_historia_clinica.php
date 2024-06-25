<?php
$conexion = mysqli_connect("localhost", "root", "", "clinica", 3306);

if (!$conexion) {
    die("Conexión con la base de datos interrumpida: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dni = $_POST['dni'];
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
    $saturacionOxigeno = $_POST['saturacion'] ?? "";
    $diagnostico = $_POST['diagnostico'] ?? "";
    $tipoDX = $_POST['tipo'] ?? "";
    $cie10 = $_POST['cie10'] ?? "";
    $tratamiento = $_POST['tratamiento'] ?? "";
    $nombrePrimerAcomp = $_POST['nombrePrimerAcomp'] ?? "";
    $nombreSegundoAcomp = $_POST['nombreSegundoAcomp'] ?? "";
    $apellidoPaternoAcomp = $_POST['apellidoPaternoAcomp'] ?? "";
    $apellidoMaternoAcomp = $_POST['apellidoMaternoAcomp'] ?? "";
    $dniAcompanante = $_POST['dniAcompanante'] ?? "";
    $parentesco = $_POST['parentesco'] ?? "";
    $destinoPaciente = $_POST['destinoPaciente'] ?? "";
    $establecimientoReferencia = $_POST['establecimiento'] ?? "";
    $evolucion = $_POST['evolucion'] ?? "";
    $fechaEgreso = $_POST['fechaEgreso'] ?? "";
    $horaEgreso = $_POST['horaEgreso'] ?? "";
    $nombreResponsableAlta = $_POST['nombreResponsableAlta'] ?? "";
    $firma = $_POST['firma'] ?? "";
    $idPersonalMedico = $_POST['idPersonalmedico'] ?? 0;

    $query = "UPDATE historia_clinica SET 
              fechaAtencion = ?, horaAtencion = ?, primerNombre = ?, segundoNombre = ?, apellidoPaterno = ?, apellidoMaterno = ?, edad = ?, sexo = ?, fechaNacimiento = ?, estadoCivil = ?, departamento = ?, provincia = ?, distrito = ?, localidad = ?, direccion = ?, tipoAtencion = ?, servicio = ?, tiempoEnfermedad = ?, sintomas = ?, relato = ?, antecedentes = ?, frecuenciaCardiaca = ?, frecuenciaRespiratoria = ?, temperatura = ?, presionArterial = ?, saturacionOxigeno = ?, diagnostico = ?, tipoDX = ?, cie10 = ?, tratamiento = ?, nombrePrimerAcomp = ?, nombreSegundoAcomp = ?, apellidoPaternoAcomp = ?, apellidoMaternoAcomp = ?, dniAcompanante = ?, parentesco = ?, destinoPaciente = ?, establecimientoReferencia = ?, evolucion = ?, fechaEgreso = ?, horaEgreso = ?, nombreResponsableAlta = ?, firma = ?, idPersonalMedico = ? 
              WHERE dni = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "ssssssssssssssssssssssssssssssssssssssssssssi", $fechaAtencion, $horaAtencion, $primerNombre, $segundoNombre, $apellidoPaterno, $apellidoMaterno, $edad, $sexo, $fechaNacimiento, $estadoCivil, $departamento, $provincia, $distrito, $localidad, $direccion, $tipoAtencion, $servicio, $tiempoEnfermedad, $sintomas, $relato, $antecedentes, $frecuenciaCardiaca, $frecuenciaRespiratoria, $temperatura, $presionArterial, $saturacionOxigeno, $diagnostico, $tipoDX, $cie10, $tratamiento, $nombrePrimerAcomp, $nombreSegundoAcomp, $apellidoPaternoAcomp, $apellidoMaternoAcomp, $dniAcompanante, $parentesco, $destinoPaciente, $establecimientoReferencia, $evolucion, $fechaEgreso, $horaEgreso, $nombreResponsableAlta, $firma, $idPersonalMedico, $dni);

    $resultado = mysqli_stmt_execute($stmt);

    if ($resultado) {
        echo "Historia clínica guardada exitosamente.";
        // echo "<script>alert('Historia clínica guardada exitosamente.'); window.location.href = '../section/bienvenida.php';</script>";
    } else {
        echo "Error al guardar la historia clínica: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
}
?>
