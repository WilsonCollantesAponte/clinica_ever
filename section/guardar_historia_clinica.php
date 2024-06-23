<?php
$conexion = mysqli_connect("localhost", "root", "", "clinica", 3306);

if (!$conexion) {
    die("Conexión con la base de datos interrumpida: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fechaAtencion = $_POST['fechaAtencion'];
    $horaAtencion = $_POST['horaAtencion'];
    $primerNombre = $_POST['primerNombre'];
    $segundoNombre = $_POST['segundoNombre'];
    $apellidoPaterno = $_POST['apellidoPaterno'];
    $apellidoMaterno = $_POST['apellidoMaterno'];
    $dni = $_POST['dni'];
    $edad = $_POST['edad'];
    $sexo = $_POST['sexo'];
    $fechaNacimiento = $_POST['fechaNacimiento'];
    $estadoCivil = $_POST['estadoCivil'];
    $departamento = $_POST['departamento'];
    $provincia = $_POST['provincia'];
    $distrito = $_POST['distrito'];
    $localidad = $_POST['localidad'];
    $direccion = $_POST['direccion'];
    $idPersonalmedico = $_POST['idPersonalmedico'];

    // Validar que idPersonalmedico existe en la tabla personal_medico
    $queryValidarPersonal = "SELECT id FROM personal_medico WHERE id = '$idPersonalmedico'";
    $resultValidarPersonal = mysqli_query($conexion, $queryValidarPersonal);

    if (mysqli_num_rows($resultValidarPersonal) == 0) {
        echo "Error: El ID del personal médico proporcionado no existe.";
        mysqli_close($conexion);
        exit;
    }

    // Insertar datos en la tabla persona
    $queryPersona = "INSERT INTO persona (nombrePrimer, nombreSegundo, apellidoPaterno, apellidoMaterno, documentoIdentidad, fechaNacimiento, sexo) 
                     VALUES ('$primerNombre', '$segundoNombre', '$apellidoPaterno', '$apellidoMaterno', '$dni', '$fechaNacimiento', '$sexo')";
    $resultPersona = mysqli_query($conexion, $queryPersona);

    if ($resultPersona) {
        $idPersona = mysqli_insert_id($conexion);

        // Insertar datos en la tabla paciente
        $queryPaciente = "INSERT INTO paciente (estadoCivil, historialMedico, idPersona) 
                          VALUES ('$estadoCivil', '', '$idPersona')";
        $resultPaciente = mysqli_query($conexion, $queryPaciente);

        if ($resultPaciente) {
            $idPaciente = mysqli_insert_id($conexion);

            // Insertar datos en la tabla domicilio_paciente
            $queryDomicilio = "INSERT INTO domicilio_paciente (departamento, provincia, distrito, localidad, direccion) 
                               VALUES ('$departamento', '$provincia', '$distrito', '$localidad', '$direccion')";
            $resultDomicilio = mysqli_query($conexion, $queryDomicilio);

            if ($resultDomicilio) {
                $idDomicilioPaciente = mysqli_insert_id($conexion);

                // Insertar datos en la tabla atencionobservacion
                $evolucion = $_POST['evolucion'];
                $queryObservacion = "INSERT INTO atencionobservacion (fechaIngreso, horaIngreso, evolucion) 
                                     VALUES ('$fechaAtencion', '$horaAtencion', '$evolucion')";
                $resultObservacion = mysqli_query($conexion, $queryObservacion);

                if ($resultObservacion) {
                    $idObservacion = mysqli_insert_id($conexion);

                    // Insertar datos en la tabla diagnosticoalta
                    $diagnosticoAlta = isset($_POST['diagnosticoAlta']) ? $_POST['diagnosticoAlta'] : '';
                    $tipoDxAlta = isset($_POST['tipoDxAlta']) ? $_POST['tipoDxAlta'] : '';
                    $cie10Alta = isset($_POST['cie10Alta']) ? $_POST['cie10Alta'] : '';
                    $fechaEgreso = $_POST['fechaEgreso'];
                    $horaEgreso = $_POST['horaEgreso'];
                    $nombreResponsableAlta = $_POST['nombreResponsableAlta'];
                    $firma = isset($_POST['firma']) ? $_POST['firma'] : '';
                    $queryAlta = "INSERT INTO diagnosticoalta (idObservacion, descripcion, tipoDX, cie10, fechaEgreso, horaEgreso, nombreResponsableAlta, firma) 
                                  VALUES ('$idObservacion', '$diagnosticoAlta', '$tipoDxAlta', '$cie10Alta', '$fechaEgreso', '$horaEgreso', '$nombreResponsableAlta', '$firma')";
                    $resultAlta = mysqli_query($conexion, $queryAlta);

                    if ($resultAlta) {
                        $idDiagnosticoAlta = mysqli_insert_id($conexion);

                        // Insertar datos en la tabla examenfisico
                        $frecuenciacardiaca = $_POST['frecuenciacardiaca'];
                        $frecurespiratoria = $_POST['frecurespiratoria'];
                        $temperatura = $_POST['temperatura'];
                        $presionarterial = $_POST['presionarterial'];
                        $saturacion = $_POST['saturacion'];
                        $queryExamenFisico = "INSERT INTO examenfisico (frecuenciaCardiaca, frecuenciaRespiratoria, temperatura, presionArterial, saturacionOxigeno) 
                                              VALUES ('$frecuenciacardiaca', '$frecurespiratoria', '$temperatura', '$presionarterial', '$saturacion')";
                        $resultExamenFisico = mysqli_query($conexion, $queryExamenFisico);

                        if ($resultExamenFisico) {
                            $idExamenFisico = mysqli_insert_id($conexion);

                            // Insertar datos en la tabla anamnesis
                            $tiempoEnfermedad = $_POST['tiempoEnfermedad'];
                            $sintomas = $_POST['sintomas'];
                            $relato = $_POST['relato'];
                            $antecedentes = $_POST['antecedentes'];
                            $queryAnamnesis = "INSERT INTO anamnesis (idExamenFisico, TiempoEnfermedad, SintomasPrincipales, Relato, Antecedentes) 
                                               VALUES ('$idExamenFisico', '$tiempoEnfermedad', '$sintomas', '$relato', '$antecedentes')";
                            $resultAnamnesis = mysqli_query($conexion, $queryAnamnesis);

                            if ($resultAnamnesis) {
                                $idAnamnesis = mysqli_insert_id($conexion);

                                // Insertar datos en la tabla destinopaciente
                                $destinoPaciente = $_POST['destinoPaciente'];
                                $establecimientoReferencia = $_POST['establecimiento'];
                                $nombreResponsableAtencion = $_POST['nombreResponsableAlta']; // Si corresponde al mismo nombre
                                $queryDestino = "INSERT INTO destinopaciente (destinoPaciente, establecimientoReferencia, nombreResponsableAtencion) 
                                                 VALUES ('$destinoPaciente', '$establecimientoReferencia', '$nombreResponsableAtencion')";
                                $resultDestino = mysqli_query($conexion, $queryDestino);

                                if ($resultDestino) {
                                    $idDestinoPaciente = mysqli_insert_id($conexion);

                                    // Insertar datos en la tabla historia_clinica
                                    $tipoAtencion = $_POST['tipoAtencion'];
                                    $servicio = $_POST['servicio'];
                                    $queryHistoriaClinica = "INSERT INTO historiaclinica (fechaIngreso, horaIngreso, edad, tipoSeguro, tipoServicio, idPaciente, idPersonalmedico, idDomicilioPaciente, idDiagnosticoAlta, idAnamnesis, idDestinoPaciente, idAtencionObservacion, idExamenFisico) 
                                                             VALUES ('$fechaAtencion', '$horaAtencion', '$edad', '$tipoAtencion', '$servicio', '$idPaciente', '$idPersonalmedico', '$idDomicilioPaciente', '$idDiagnosticoAlta', '$idAnamnesis', '$idDestinoPaciente', '$idObservacion', '$idExamenFisico')";
                                    $resultHistoriaClinica = mysqli_query($conexion, $queryHistoriaClinica);

                                    if ($resultHistoriaClinica) {
                                        $idHistoriaClinica = mysqli_insert_id($conexion);

                                        // Insertar datos en la tabla impresiondiagnostica
                                        $diagnostico = $_POST['diagnostico'];
                                        $tipo = $_POST['tipo'];
                                        $cie10 = $_POST['cie10'];
                                        $queryDiagnostica = "INSERT INTO impresiondiagnostica (descripcion, tipoDX, cie10, examenesAuxiliares, tratamiento) 
                                                             VALUES ('$diagnostico', '$tipo', '$cie10', '', '')";
                                        $resultDiagnostica = mysqli_query($conexion, $queryDiagnostica);

                                        // Insertar datos en la tabla acompañante
                                        $parentesco = $_POST['parentesco'];
                                        $queryAcompanante = "INSERT INTO acompanante (parentesco, idPersona) 
                                                             VALUES ('$parentesco', '$idPersona')";
                                        $resultAcompanante = mysqli_query($conexion, $queryAcompanante);

                                        echo "Historia clínica guardada exitosamente.";
                                    } else {
                                        echo "Error al guardar la historia clínica: " . mysqli_error($conexion);
                                    }
                                } else {
                                    echo "Error al guardar el destino del paciente: " . mysqli_error($conexion);
                                }
                            } else {
                                echo "Error al guardar la anamnesis: " . mysqli_error($conexion);
                            }
                        } else {
                            echo "Error al guardar el examen físico: " . mysqli_error($conexion);
                        }
                    } else {
                        echo "Error al guardar el diagnóstico de alta: " . mysqli_error($conexion);
                    }
                } else {
                    echo "Error al guardar la observación: " . mysqli_error($conexion);
                }
            } else {
                echo "Error al guardar el domicilio: " . mysqli_error($conexion);
            }
        } else {
            echo "Error al guardar el paciente: " . mysqli_error($conexion);
        }
    } else {
        echo "Error al guardar la persona: " . mysqli_error($conexion);
    }
}

mysqli_close($conexion);
?>
