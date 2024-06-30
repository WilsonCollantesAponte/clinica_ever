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
        $saturacionOxigeno = $_POST['saturacion'] ?? '';
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
            primerNombre='$primerNombre', segundoNombre='$segundoNombre', apellidoPaterno='$apellidoPaterno', 
            apellidoMaterno='$apellidoMaterno', fechaNacimiento='$fechaNacimiento', edad='$edad', sexo='$sexo', 
            estadoCivil='$estadoCivil', grupoSanguineo='$grupoSanguineo', fechaAtencion='$fechaAtencion', 
            horaAtencion='$horaAtencion', departamento='$departamento', provincia='$provincia', distrito='$distrito', 
            localidad='$localidad', direccion='$direccion', tipoAtencion='$tipoAtencion', servicio='$servicio', 
            tiempoEnfermedad='$tiempoEnfermedad', sintomas='$sintomas', relato='$relato', antecedentes='$antecedentes', 
            frecuenciaCardiaca='$frecuenciaCardiaca', frecuenciaRespiratoria='$frecuenciaRespiratoria', 
            temperatura='$temperatura', presionArterial='$presionArterial', saturacionOxigeno='$saturacionOxigeno', 
            diagnostico='$diagnostico', tipoDX='$tipoDX', cie10='$cie10', tratamiento='$tratamiento', 
            nombrePrimerAcomp='$nombrePrimerAcomp', nombreSegundoAcomp='$nombreSegundoAcomp', 
            apellidoPaternoAcomp='$apellidoPaternoAcomp', apellidoMaternoAcomp='$apellidoMaternoAcomp', 
            dniAcompanante='$dniAcompanante', parentesco='$parentesco', destinoPaciente='$destinoPaciente', 
            establecimientoReferencia='$establecimientoReferencia', evolucion='$evolucion', fechaEgreso='$fechaEgreso', 
            horaEgreso='$horaEgreso', nombreResponsableAlta='$nombreResponsableAlta', idPersonalMedico='$idPersonalmedico', 
            firma='$firma' 
            WHERE dni='$dni'";

        $resultado = mysqli_query($conexion, $query);

        if ($resultado) {
            echo "Historia clínica actualizada exitosamente.";
        } else {
            echo "Error al actualizar la historia clínica: " . mysqli_error($conexion) . "";
        }

    } else {
        echo "Error: DNI no proporcionado.";
    }

    mysqli_close($conexion);
}
?>
