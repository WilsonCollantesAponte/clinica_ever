<?php
$conexion = mysqli_connect("localhost", "root", "", "clinica", 3306);

if (!$conexion) {
    die("Conexión con la base de datos interrumpida: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['dni'])) {
        $dni = $_POST['dni'] ?? '';
        $primerNombre = $_POST['primerNombre'] ?? '';
        $segundoNombre = $_POST['segundoNombre'] ?? '';
        $apellidoPaterno = $_POST['apellidoPaterno'] ?? '';
        $apellidoMaterno = $_POST['apellidoMaterno'] ?? '';
        $fechaNacimiento = $_POST['fechaNacimiento'] ?? '';
        $edad = $_POST['edad'] ?? 0;
        $sexo = $_POST['sexo'] ?? '';
        $estadoCivil = $_POST['estadoCivil'] ?? '';
        $grupoSanguineo = $_POST['grupoSanguineo'] ?? '';
        $fechaAtencion = $_POST['fechaAtencion'] ?? '';
        $horaAtencion = $_POST['horaAtencion'] ?? '';
        $departamento = $_POST['departamento'] ?? '';
        $provincia = $_POST['provincia'] ?? '';
        $distrito = $_POST['distrito'] ?? '';
        $localidad = $_POST['localidad'] ?? '';
        $direccion = $_POST['direccion'] ?? '';
        $tipoAtencion = $_POST['tipoAtencion'] ?? '';
        $servicio = $_POST['servicio'] ?? '';
        $tiempoEnfermedad = $_POST['tiempoEnfermedad'] ?? '';
        $sintomas = $_POST['sintomas'] ?? '';
        $relato = $_POST['relato'] ?? '';
        $antecedentes = $_POST['antecedentes'] ?? '';
        $frecuenciaCardiaca = $_POST['frecuenciaCardiaca'] ?? '';
        $frecuenciaRespiratoria = $_POST['frecuenciaRespiratoria'] ?? '';
        $temperatura = $_POST['temperatura'] ?? '';
        $presionArterial = $_POST['presionArterial'] ?? '';
        $saturacionOxigeno = $_POST['saturacionOxigeno'] ?? '';
        $diagnostico = $_POST['diagnostico'] ?? '';
        $tipoDX = $_POST['tipoDX'] ?? '';
        $cie10 = $_POST['cie10'] ?? '';
        $tratamiento = $_POST['tratamiento'] ?? '';
        $nombrePrimerAcomp = $_POST['nombrePrimerAcomp'] ?? '';
        $nombreSegundoAcomp = $_POST['nombreSegundoAcomp'] ?? '';
        $apellidoPaternoAcomp = $_POST['apellidoPaternoAcomp'] ?? '';
        $apellidoMaternoAcomp = $_POST['apellidoMaternoAcomp'] ?? '';
        $dniAcompanante = $_POST['dniAcompanante'] ?? '';
        $parentesco = $_POST['parentesco'] ?? '';
        $destinoPaciente = $_POST['destinoPaciente'] ?? '';
        $establecimientoReferencia = $_POST['establecimientoReferencia'] ?? '';
        $evolucion = $_POST['evolucion'] ?? '';
        $fechaEgreso = $_POST['fechaEgreso'] ?? '';
        $horaEgreso = $_POST['horaEgreso'] ?? '';
        $nombreResponsableAlta = $_POST['nombreResponsableAlta'] ?? '';
        $idPersonalmedico = $_POST['idPersonalmedico'] ?? 0;
        $firma = $_POST['firma'] ?? '';

        // Actualizar datos en la tabla historia_clinica
        $query = "UPDATE historia_clinica SET 
            primerNombre=?, segundoNombre=?, apellidoPaterno=?, apellidoMaterno=?, fechaNacimiento=?, edad=?, sexo=?, estadoCivil=?, grupoSanguineo=?,
            fechaAtencion=?, horaAtencion=?, departamento=?, provincia=?, distrito=?, localidad=?, direccion=?, tipoAtencion=?, servicio=?, tiempoEnfermedad=?,
            sintomas=?, relato=?, antecedentes=?, frecuenciaCardiaca=?, frecuenciaRespiratoria=?, temperatura=?, presionArterial=?, saturacionOxigeno=?,
            diagnostico=?, tipoDX=?, cie10=?, tratamiento=?, nombrePrimerAcomp=?, nombreSegundoAcomp=?, apellidoPaternoAcomp=?, apellidoMaternoAcomp=?,
            dniAcompanante=?, parentesco=?, destinoPaciente=?, establecimientoReferencia=?, evolucion=?, fechaEgreso=?, horaEgreso=?, nombreResponsableAlta=?, 
            idPersonalMedico=?, firma=?
            WHERE dni=?";
        
        $stmt = mysqli_prepare($conexion, $query);

        if (!$stmt) {
            echo "<script>alert('Error en mysqli_prepare: " . mysqli_error($conexion) . "'); window.history.back();</script>";
            exit();
        }

        mysqli_stmt_bind_param($stmt, 'sssssssssssssssssssssssssssssssssssssssssssss',
            $primerNombre, $segundoNombre, $apellidoPaterno, $apellidoMaterno, $fechaNacimiento, $edad, $sexo, $estadoCivil, $grupoSanguineo,
            $fechaAtencion, $horaAtencion, $departamento, $provincia, $distrito, $localidad, $direccion, $tipoAtencion, $servicio, $tiempoEnfermedad,
            $sintomas, $relato, $antecedentes, $frecuenciaCardiaca, $frecuenciaRespiratoria, $temperatura, $presionArterial, $saturacionOxigeno,
            $diagnostico, $tipoDX, $cie10, $tratamiento, $nombrePrimerAcomp, $nombreSegundoAcomp, $apellidoPaternoAcomp, $apellidoMaternoAcomp,
            $dniAcompanante, $parentesco, $destinoPaciente, $establecimientoReferencia, $evolucion, $fechaEgreso, $horaEgreso, $nombreResponsableAlta,
            $idPersonalmedico, $firma, $dni);

        $resultado = mysqli_stmt_execute($stmt);

        if ($resultado) {
            echo "<script>alert('Historia clínica actualizada exitosamente.'); window.location.href = '../section/bienvenida.php';</script>";
        } else {
            echo "<script>alert('Error al actualizar la historia clínica: " . mysqli_stmt_error($stmt) . "'); window.history.back();</script>";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Error: DNI no proporcionado.'); window.history.back();</script>";
    }

    mysqli_close($conexion);
}
?>
