<?php
date_default_timezone_set('America/Lima');

$conexion = mysqli_connect("localhost", "root", "", "clinica", 3306);

if (!$conexion) {
    die("Conexión con la base de datos interrumpida: " . mysqli_connect_error());
}

$datosUsuario = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['document_number'])) {
    $dni = $_POST['document_number'];

    $query = "SELECT * FROM historia_clinica WHERE dni = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "s", $dni);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($resultado) > 0) {
        $datosUsuario = mysqli_fetch_assoc($resultado);
    } else {
        echo '<script>alert("No se encontraron resultados para el DNI ingresado.");</script>';
    }
}

mysqli_close($conexion);
?>

<link rel="stylesheet" href="../estilos/styleem.css">

<h1>Editar Historia Clínica</h1>

<div style="display: flex; flex-direction: column; align-items: center; justify-content: center; margin-bottom: 20px;">
    <form id="searchForm" action="EditarHistoriaClinica.php" method="post" style="display: flex; flex-direction: column; align-items: center;">
        <input type="text" id="document_number" name="document_number" required placeholder="Ingrese el DNI" style="width: 250px; padding: 10px; border: 2px solid #ccc; border-radius: 25px; font-size: 16px; outline: none; margin-bottom: 10px;">
        <button id="search-button" type="submit" style="padding: 10px 20px; border: 2px solid #007bff; background-color: #007bff; color: white; font-size: 16px; border-radius: 25px; cursor: pointer; outline: none;">Buscar</button>
    </form>
</div>

<form id="editForm" action="actualizar_historia_clinica.php" method="post">
    <fieldset>
        <legend>Datos Generales</legend>
        <div class="row">
            <label for="fechaAtencion">Fecha de Atención:</label>
            <input type="date" id="fechaAtencion" name="fechaAtencion" value="<?php echo isset($datosUsuario['fechaAtencion']) ? $datosUsuario['fechaAtencion'] : ''; ?>">
            <label for="horaAtencion">Hora de Atención:</label>
            <input type="time" id="horaAtencion" name="horaAtencion" value="<?php echo isset($datosUsuario['horaAtencion']) ? $datosUsuario['horaAtencion'] : ''; ?>">
        </div>
        <div class="row">
            <label for="primerNombre">Primer Nombre:</label>
            <input type="text" id="primerNombre" name="primerNombre" value="<?php echo isset($datosUsuario['primerNombre']) ? $datosUsuario['primerNombre'] : ''; ?>">
            <label for="segundoNombre">Segundo Nombre:</label>
            <input type="text" id="segundoNombre" name="segundoNombre" value="<?php echo isset($datosUsuario['segundoNombre']) ? $datosUsuario['segundoNombre'] : ''; ?>">
        </div>
        <div class="row">
            <label for="apellidoPaterno">Apellido Paterno:</label>
            <input type="text" id="apellidoPaterno" name="apellidoPaterno" value="<?php echo isset($datosUsuario['apellidoPaterno']) ? $datosUsuario['apellidoPaterno'] : ''; ?>">
            <label for="apellidoMaterno">Apellido Materno:</label>
            <input type="text" id="apellidoMaterno" name="apellidoMaterno" value="<?php echo isset($datosUsuario['apellidoMaterno']) ? $datosUsuario['apellidoMaterno'] : ''; ?>">
        </div> 
        <div class="row">
            <label for="dni">DNI:</label>
            <input type="text" id="dni" name="dni" value="<?php echo isset($datosUsuario['dni']) ? $datosUsuario['dni'] : ''; ?>">
            <label for="edad">Edad:</label>
            <input type="number" id="edad" name="edad" value="<?php echo isset($datosUsuario['edad']) ? $datosUsuario['edad'] : ''; ?>">
        </div>
        <div class="row">
            <label for="sexo">Sexo:</label>
            <select id="sexo" name="sexo">
                <option value="" selected="selected">- selecciona -</option>
                <option value="M" <?php echo isset($datosUsuario['sexo']) && strtoupper($datosUsuario['sexo']) == 'M' ? 'selected' : ''; ?>>Masculino</option>
                <option value="F" <?php echo isset($datosUsuario['sexo']) && strtoupper($datosUsuario['sexo']) == 'F' ? 'selected' : ''; ?>>Femenino</option>
            </select>
            <label for="fechaNacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fechaNacimiento" name="fechaNacimiento" value="<?php echo isset($datosUsuario['fechaNacimiento']) ? $datosUsuario['fechaNacimiento'] : ''; ?>">
        </div>
        <div class="row">
            <label for="estadoCivil">Estado Civil:</label>
            <select id="estadoCivil" name="estadoCivil">
                <option value="" selected="selected">- selecciona -</option>
                <option value="soltero" <?php echo (isset($datosUsuario['estadoCivil']) && strtolower($datosUsuario['estadoCivil']) == 'soltero') ? 'selected' : ''; ?>>Soltero</option>
                <option value="casado" <?php echo (isset($datosUsuario['estadoCivil']) && strtolower($datosUsuario['estadoCivil']) == 'casado') ? 'selected' : ''; ?>>Casado</option>
                <option value="viudo" <?php echo (isset($datosUsuario['estadoCivil']) && strtolower($datosUsuario['estadoCivil']) == 'viudo') ? 'selected' : ''; ?>>Viudo</option>
                <option value="divorciado" <?php echo (isset($datosUsuario['estadoCivil']) && strtolower($datosUsuario['estadoCivil']) == 'divorciado') ? 'selected' : ''; ?>>Divorciado</option>
            </select>
        </div>
        <div class="row">
            <label for="departamento">Departamento:</label>
            <input type="text" id="departamento" name="departamento" value="<?php echo isset($datosUsuario['departamento']) ? $datosUsuario['departamento'] : ''; ?>">
            <label for="provincia">Provincia:</label>
            <input type="text" id="provincia" name="provincia" value="<?php echo isset($datosUsuario['provincia']) ? $datosUsuario['provincia'] : ''; ?>">
        </div>
        <div class="row">
            <label for="distrito">Distrito:</label>
            <input type="text" id="distrito" name="distrito" value="<?php echo isset($datosUsuario['distrito']) ? $datosUsuario['distrito'] : ''; ?>">
            <label for="localidad">Localidad:</label>
            <input type="text" id="localidad" name="localidad" value="<?php echo isset($datosUsuario['localidad']) ? $datosUsuario['localidad'] : ''; ?>">
        </div>
        <div class="row">
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" value="<?php echo isset($datosUsuario['direccion']) ? $datosUsuario['direccion'] : ''; ?>">
        </div>
    </fieldset>

    <fieldset>
        <legend>Tipo de Atención y Servicio</legend>
        <div class="row">
            <label for="tipoAtencion">Tipo de Atención:</label>
            <select id="tipoAtencion" name="tipoAtencion">
                <option value="" selected="selected">- selecciona -</option>
                <option value="Sin Seguro" <?php echo isset($datosUsuario['tipoAtencion']) && $datosUsuario['tipoAtencion'] == 'Sin Seguro' ? 'selected' : ''; ?>>Sin Seguro</option>
                <option value="AUS" <?php echo isset($datosUsuario['tipoAtencion']) && $datosUsuario['tipoAtencion'] == 'AUS' ? 'selected' : ''; ?>>AUS</option>
                <option value="SOAT" <?php echo isset($datosUsuario['tipoAtencion']) && $datosUsuario['tipoAtencion'] == 'SOAT' ? 'selected' : ''; ?>>SOAT</option>
                <option value="Otros" <?php echo isset($datosUsuario['tipoAtencion']) && $datosUsuario['tipoAtencion'] == 'Otros' ? 'selected' : ''; ?>>Otros</option>
            </select>
        </div>
        <div class="row">
            <label for="servicio">Servicio:</label>
            <select id="servicio" name="servicio">
                <option value="" selected="selected">- selecciona -</option>
                <option value="Medicina" <?php echo isset($datosUsuario['servicio']) && $datosUsuario['servicio'] == 'Medicina' ? 'selected' : ''; ?>>Medicina</option>
                <option value="Otros" <?php echo isset($datosUsuario['servicio']) && $datosUsuario['servicio'] == 'Otros' ? 'selected' : ''; ?>>Otros</option>
            </select>
        </div>
    </fieldset>

    <fieldset>
        <legend>Anamnesis</legend>
        <div class="row">
            <label for="tiempoEnfermedad">Tiempo de Enfermedad:</label>
            <input type="text" id="tiempoEnfermedad" name="tiempoEnfermedad" value="<?php echo isset($datosUsuario['tiempoEnfermedad']) ? $datosUsuario['tiempoEnfermedad'] : ''; ?>">
        </div>
        <div class="row">
            <label for="sintomas">Síntomas principales:</label>
            <textarea id="sintomas" name="sintomas"><?php echo isset($datosUsuario['sintomas']) ? $datosUsuario['sintomas'] : ''; ?></textarea>
        </div>
        <div class="row">
            <label for="relato">Relato:</label>
            <textarea id="relato" name="relato"><?php echo isset($datosUsuario['relato']) ? $datosUsuario['relato'] : ''; ?></textarea>
        </div>
        <div class="row">
            <label for="antecedentes">Antecedentes:</label>
            <textarea id="antecedentes" name="antecedentes"><?php echo isset($datosUsuario['antecedentes']) ? $datosUsuario['antecedentes'] : ''; ?></textarea>
        </div>
        <div class="row">
            <label for="frecuenciaCardiaca">Frecuencia Cardíaca:</label>
            <input type="text" id="frecuenciaCardiaca" name="frecuenciaCardiaca" value="<?php echo isset($datosUsuario['frecuenciaCardiaca']) ? $datosUsuario['frecuenciaCardiaca'] : ''; ?>">
            <label for="frecuenciaRespiratoria">Frecuencia Respiratoria:</label>
            <input type="text" id="frecuenciaRespiratoria" name="frecuenciaRespiratoria" value="<?php echo isset($datosUsuario['frecuenciaRespiratoria']) ? $datosUsuario['frecuenciaRespiratoria'] : ''; ?>">
        </div>
        <div class="row">
            <label for="temperatura">Temperatura:</label>
            <input type="text" id="temperatura" name="temperatura" value="<?php echo isset($datosUsuario['temperatura']) ? $datosUsuario['temperatura'] : ''; ?>">
            <label for="presionArterial">Presión Arterial:</label>
            <input type="text" id="presionArterial" name="presionArterial" value="<?php echo isset($datosUsuario['presionArterial']) ? $datosUsuario['presionArterial'] : ''; ?>">
        </div>
        <div class="row">
            <label for="saturacion">Saturación de Oxígeno:</label>
            <input type="text" id="saturacion" name="saturacion" value="<?php echo isset($datosUsuario['saturacion']) ? $datosUsuario['saturacion'] : ''; ?>">
        </div>
    </fieldset>

    <fieldset>
        <legend>Impresión Diagnóstica</legend>
        <div class="row">
            <label for="diagnostico">Diagnóstico:</label>
            <input type="text" id="diagnostico" name="diagnostico" value="<?php echo isset($datosUsuario['diagnostico']) ? $datosUsuario['diagnostico'] : ''; ?>">
            <label for="tipoDX">Tipo de DX:</label>
            <select id="tipoDX" name="tipoDX">
                <option value="" selected="selected">- selecciona -</option>
                <option value="presuntivo" <?php echo isset($datosUsuario['tipoDX']) && $datosUsuario['tipoDX'] == 'presuntivo' ? 'selected' : ''; ?>>Presuntivo</option>
                <option value="definitivo" <?php echo isset($datosUsuario['tipoDX']) && $datosUsuario['tipoDX'] == 'definitivo' ? 'selected' : ''; ?>>Definitivo</option>
                <option value="repetido" <?php echo isset($datosUsuario['tipoDX']) && $datosUsuario['tipoDX'] == 'repetido' ? 'selected' : ''; ?>>Repetido</option>
            </select>
            <label for="cie10">CIE-10:</label>
            <input type="text" id="cie10" name="cie10" value="<?php echo isset($datosUsuario['cie10']) ? $datosUsuario['cie10'] : ''; ?>">
        </div>
    </fieldset>

    <fieldset>
        <legend>Exámenes Auxiliares</legend>
        <div class="row">
            <label for="examenAuxiliares">Exámenes Auxiliares:</label>
            <textarea id="examenAuxiliares" name="examenAuxiliares"><?php echo isset($datosUsuario['examenAuxiliares']) ? $datosUsuario['examenAuxiliares'] : ''; ?></textarea>
        </div>
    </fieldset>

    <fieldset>
        <legend>Tratamiento</legend>
        <div class="row">
            <label for="tratamiento">Tratamiento:</label>
            <textarea id="tratamiento" name="tratamiento"><?php echo isset($datosUsuario['tratamiento']) ? $datosUsuario['tratamiento'] : ''; ?></textarea>
        </div>
    </fieldset>

    <fieldset>
        <legend>Datos del Acompañante del Paciente</legend>
        <div class="row">
            <label for="nombrePrimerAcomp">Primer Nombre:</label>
            <input type="text" id="nombrePrimerAcomp" name="nombrePrimerAcomp" value="<?php echo isset($datosUsuario['nombrePrimerAcomp']) ? $datosUsuario['nombrePrimerAcomp'] : ''; ?>">
            <label for="nombreSegundoAcomp">Segundo Nombre:</label>
            <input type="text" id="nombreSegundoAcomp" name="nombreSegundoAcomp" value="<?php echo isset($datosUsuario['nombreSegundoAcomp']) ? $datosUsuario['nombreSegundoAcomp'] : ''; ?>">
        </div>
        <div class="row">
            <label for="apellidoPaternoAcomp">Apellido Paterno:</label>
            <input type="text" id="apellidoPaternoAcomp" name="apellidoPaternoAcomp" value="<?php echo isset($datosUsuario['apellidoPaternoAcomp']) ? $datosUsuario['apellidoPaternoAcomp'] : ''; ?>">
            <label for="apellidoMaternoAcomp">Apellido Materno:</label>
            <input type="text" id="apellidoMaternoAcomp" name="apellidoMaternoAcomp" value="<?php echo isset($datosUsuario['apellidoMaternoAcomp']) ? $datosUsuario['apellidoMaternoAcomp'] : ''; ?>">
        </div> 
        <div class="row">
            <label for="dniAcompanante">DNI del Acompañante:</label>
            <input type="text" id="dniAcompanante" name="dniAcompanante" value="<?php echo isset($datosUsuario['dniAcompanante']) ? $datosUsuario['dniAcompanante'] : ''; ?>">
            <label for="parentesco">Parentesco:</label>
            <input type="text" id="parentesco" name="parentesco" value="<?php echo isset($datosUsuario['parentesco']) ? $datosUsuario['parentesco'] : ''; ?>">
        </div>
    </fieldset>

    <fieldset>
        <legend>Destino del Paciente</legend>
        <div class="row">
            <label for="destinoPaciente">Destino del Paciente:</label>
            <select id="destinoPaciente" name="destinoPaciente">
                <option value="" selected="selected">- selecciona -</option>
                <option value="Domicilio" <?php echo isset($datosUsuario['destinoPaciente']) && $datosUsuario['destinoPaciente'] == 'Domicilio' ? 'selected' : ''; ?>>Domicilio</option>
                <option value="Referido" <?php echo isset($datosUsuario['destinoPaciente']) && $datosUsuario['destinoPaciente'] == 'Referido' ? 'selected' : ''; ?>>Referido</option>
                <option value="Defunción" <?php echo isset($datosUsuario['destinoPaciente']) && $datosUsuario['destinoPaciente'] == 'Defunción' ? 'selected' : ''; ?>>Defunción</option>
                <option value="Fuga" <?php echo isset($datosUsuario['destinoPaciente']) && $datosUsuario['destinoPaciente'] == 'Fuga' ? 'selected' : ''; ?>>Fuga</option>
                <option value="Observación" <?php echo isset($datosUsuario['destinoPaciente']) && $datosUsuario['destinoPaciente'] == 'Observación' ? 'selected' : ''; ?>>Observación</option>
            </select>
            <label for="establecimientoReferencia">Especificar Establecimiento:</label>
            <textarea id="establecimientoReferencia" name="establecimientoReferencia"><?php echo isset($datosUsuario['establecimientoReferencia']) ? $datosUsuario['establecimientoReferencia'] : ''; ?></textarea>
        </div>
    </fieldset>

    <fieldset>
        <legend>Datos de Atención en Observación</legend>
        <div class="row">
            <label for="fechaAtencionObs">Fecha de Ingreso:</label>
            <input type="date" id="fechaAtencionObs" name="fechaAtencionObs" value="<?php echo isset($datosUsuario['fechaAtencionObs']) ? $datosUsuario['fechaAtencionObs'] : ''; ?>">
            <label for="horaAtencionObs">Hora de Ingreso:</label>
            <input type="time" id="horaAtencionObs" name="horaAtencionObs" value="<?php echo isset($datosUsuario['horaAtencionObs']) ? $datosUsuario['horaAtencionObs'] : ''; ?>">
        </div>
        <div class="row">
            <label for="evolucion">Evolución:</label>
            <textarea id="evolucion" name="evolucion"><?php echo isset($datosUsuario['evolucion']) ? $datosUsuario['evolucion'] : ''; ?></textarea>
        </div>
        <div class="row">
            <label for="diagnosticoObs">Diagnóstico:</label>
            <input type="text" id="diagnosticoObs" name="diagnosticoObs" value="<?php echo isset($datosUsuario['diagnosticoObs']) ? $datosUsuario['diagnosticoObs'] : ''; ?>">
            <label for="tipoDXObs">Tipo de DX:</label>
            <select id="tipoDXObs" name="tipoDXObs">
                <option value="" selected="selected">- selecciona -</option>
                <option value="presuntivo" <?php echo isset($datosUsuario['tipoDXObs']) && $datosUsuario['tipoDXObs'] == 'presuntivo' ? 'selected' : ''; ?>>Presuntivo</option>
                <option value="definitivo" <?php echo isset($datosUsuario['tipoDXObs']) && $datosUsuario['tipoDXObs'] == 'definitivo' ? 'selected' : ''; ?>>Definitivo</option>
                <option value="repetido" <?php echo isset($datosUsuario['tipoDXObs']) && $datosUsuario['tipoDXObs'] == 'repetido' ? 'selected' : ''; ?>>Repetido</option>
            </select>
            <label for="cie10Obs">CIE-10:</label>
            <input type="text" id="cie10Obs" name="cie10Obs" value="<?php echo isset($datosUsuario['cie10Obs']) ? $datosUsuario['cie10Obs'] : ''; ?>">
        </div>
    </fieldset>

    <fieldset>
        <legend>Alta del Paciente</legend>
        <div class="row">
            <label for="fechaEgreso">Fecha de Egreso:</label>
            <input type="date" id="fechaEgreso" name="fechaEgreso" value="<?php echo isset($datosUsuario['fechaEgreso']) ? $datosUsuario['fechaEgreso'] : ''; ?>">
            <label for="horaEgreso">Hora de Egreso:</label>
            <input type="time" id="horaEgreso" name="horaEgreso" value="<?php echo isset($datosUsuario['horaEgreso']) ? $datosUsuario['horaEgreso'] : ''; ?>">
        </div>
        <div class="row">
            <label for="nombreResponsableAlta">Responsable de Alta:</label>
            <input type="text" id="nombreResponsableAlta" name="nombreResponsableAlta" value="<?php echo isset($datosUsuario['nombreResponsableAlta']) ? $datosUsuario['nombreResponsableAlta'] : ''; ?>">
            <label for="firma">Firma:</label>
            <input type="file" id="firma" name="firma" value="<?php echo isset($datosUsuario['firma']) ? $datosUsuario['firma'] : ''; ?>">
        </div>
    </fieldset>

    <div class="row">
        <button type="submit">Editar Historia Clínica</button>
    </div>
</form>

<script>
$(document).ready(function(){
    $('#searchForm').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            url: 'EditarHistoriaClinica.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response){
                $('#content').html(response);
            }
        });
    });

    $('#editForm').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            url: 'actualizar_historia_clinica.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response){
                alert(response);
            }
        });
    });
});
</script>