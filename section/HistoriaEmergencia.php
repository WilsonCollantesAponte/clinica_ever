<?php
date_default_timezone_set('America/Lima');

$conexion = mysqli_connect("localhost", "root", "", "clinica", 3306);

if (!$conexion) {
    die("Conexión con la base de datos interrumpida: " . mysqli_connect_error());
}

$datosUsuario = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['document_number']) && isset($_POST['id'])) {
    $dni = $_POST['document_number'];
    $id = $_POST['id'];

    $query = "SELECT * FROM historia_clinica WHERE dni = ? AND id = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "si", $dni, $id);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($resultado) > 0) {
        $datosUsuario = mysqli_fetch_assoc($resultado);
    } else {
        echo '<script>alert("No se encontraron resultados para el DNI y ID ingresados.");</script>';
    }
}

$fechaActual = date('Y-m-d');
$horaActual = date('H:i');

mysqli_close($conexion);
?>

<link rel="stylesheet" href="../estilos/styleem.css">

<h1>Registros de Incidencias</h1>

<div style="display: flex; flex-direction: column; align-items: center; justify-content: center; margin-bottom: 20px;">
    <form id="searchForm" action="HistoriaEmergencia.php" method="post" style="display: flex; flex-direction: column; align-items: center;">
        <input type="text" id="document_number" name="document_number" required placeholder="Ingrese el DNI" style="width: 300px; padding: 10px; border: 2px solid #ccc; border-radius: 25px; font-size: 16px; outline: none; margin-bottom: 10px;">
        <input type="text" id="id" name="id" required placeholder="Identificador(id) de la incidencia" style="width: 300px; padding: 10px; border: 2px solid #ccc; border-radius: 25px; font-size: 16px; outline: none; margin-bottom: 10px;">
        <button id="search-button" type="submit" style="padding: 10px 30px; border: 2px solid #007bff; background-color: #007bff; color: white; font-size: 16px; border-radius: 25px; cursor: pointer; outline: none;">Buscar</button>
    </form>
</div>

<form id="emergencyForm" action="guardar_historia_clinica.php" method="post">
    <fieldset>
        <legend>Datos Generales</legend>
        <div class="row">
            <label for="fechaAtencion">Fecha de Atención:</label>
            <input type="date" id="fechaAtencion" name="fechaAtencion" value="<?php echo $fechaActual; ?>">
            <label for="horaAtencion">Hora de Atención:</label>
            <input type="time" id="horaAtencion" name="horaAtencion" value="<?php echo $horaActual; ?>">
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
            <input type="hidden" id="id" name="id" value="<?php echo isset($datosUsuario['id']) ? $datosUsuario['id'] : ''; ?>">
            <label for="edad">Edad:</label>
            <input type="number" id="edad" name="edad" value="<?php echo isset($datosUsuario['edad']) ? $datosUsuario['edad'] : ''; ?>">
        </div>
        <div class="row">
            <label for="sexo">Sexo:</label>
            <select id="sexo" name="sexo" readonly>
                <option value="" selected="selected">- selecciona -</option>
                <option value="M" <?php echo isset($datosUsuario['sexo']) && strtoupper($datosUsuario['sexo']) == 'M' ? 'selected' : ''; ?>>Masculino</option>
                <option value="F" <?php echo isset($datosUsuario['sexo']) && strtoupper($datosUsuario['sexo']) == 'F' ? 'selected' : ''; ?>>Femenino</option>
            </select>
            <label for="fechaNacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fechaNacimiento" name="fechaNacimiento" value="<?php echo isset($datosUsuario['fechaNacimiento']) ? $datosUsuario['fechaNacimiento'] : ''; ?>">
        </div>
        <div class="row">
            <label for="estadoCivil">Estado Civil:</label>
            <select id="estadoCivil" name="estadoCivil" readonly>
                <option value="" selected="selected">- selecciona -</option>
                <option value="soltero" <?php echo (isset($datosUsuario['estadoCivil']) && strtolower($datosUsuario['estadoCivil']) == 'soltero') ? 'selected' : ''; ?>>Soltero</option>
                <option value="casado" <?php echo (isset($datosUsuario['estadoCivil']) && strtolower($datosUsuario['estadoCivil']) == 'casado') ? 'selected' : ''; ?>>Casado</option>
                <option value="viudo" <?php echo (isset($datosUsuario['estadoCivil']) && strtolower($datosUsuario['estadoCivil']) == 'viudo') ? 'selected' : ''; ?>>Viudo</option>
                <option value="divorciado" <?php echo (isset($datosUsuario['estadoCivil']) && strtolower($datosUsuario['estadoCivil']) == 'divorciado') ? 'selected' : ''; ?>>Divorciado</option>
            </select>
        </div>
    </fieldset>

    <fieldset>
        <legend>Domicilio</legend>
        <div class="row">
            <label for="departamento">Departamento:</label>
            <input type="text" id="departamento" name="departamento">
        </div>
        <div class="row">
            <label for="provincia">Provincia:</label>
            <input type="text" id="provincia" name="provincia">
            <label for="distrito">Distrito:</label>
            <input type="text" id="distrito" name="distrito">
        </div>
        <div class="row">
            <label for="localidad">Localidad:</label>
            <input type="text" id="localidad" name="localidad">
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion">
        </div>
    </fieldset>

    <fieldset>
        <legend>Tipo de Atención y Servicio</legend>
        <div class="row">
            <label for="tipoAtencion">Tipo de Atención:</label>
            <select id="tipoAtencion" name="tipoAtencion">
                <option value="" selected="selected">- selecciona -</option>
                <option value="Sin Seguro">Sin Seguro</option>
                <option value="AUS">AUS</option>
                <option value="SOAT">SOAT</option>
                <option value="Otros">Otros</option>
            </select>
        </div>
        <div class="row">
            <label for="servicio">Servicio:</label>
            <select id="servicio" name="servicio">
                <option value="" selected="selected">- selecciona -</option>
                <option value="Medicina">Medicina</option>
                <option value="Otros">Otros</option>
            </select>
        </div>
    </fieldset>

    <fieldset>
        <legend>Anamnesis</legend>
        <div class="row">
            <label for="tiempoEnfermedad">Tiempo de Enfermedad:</label>
            <input type="text" id="tiempoEnfermedad" name="tiempoEnfermedad">
        </div>
        <div class="row">
            <label for="sintomas">Síntomas principales:</label>
            <textarea id="sintomas" name="sintomas"></textarea>
        </div>
        <div class="row">
            <label for="relato">Relato:</label>
            <textarea id="relato" name="relato"></textarea>
        </div>
        <div class="row">
            <label for="antecedentes">Antecedentes:</label>
            <textarea id="antecedentes" name="antecedentes"></textarea>
        </div>
    </fieldset>

    <fieldset>
        <legend>Examen Físico</legend>
        <div class="row">
            <label for="frecuenciaCardiaca">Frecuencia Cardíaca:</label>
            <input type="text" id="frecuenciaCardiaca" name="frecuenciaCardiaca">
            <label for="frecuenciaRespiratoria">Frecuencia Respiratoria:</label>
            <input type="text" id="frecuenciaRespiratoria" name="frecuenciaRespiratoria">
        </div>
        <div class="row">
            <label for="temperatura">Temperatura:</label>
            <input type="text" id="temperatura" name="temperatura">
            <label for="presionArterial">Presión Arterial:</label>
            <input type="text" id="presionArterial" name="presionArterial">
        </div>
        <div class="row">
            <label for="saturacion">Saturación de Oxígeno:</label>
            <input type="text" id="saturacion" name="saturacion">
        </div>
  

    <fieldset>
        <legend>Exámenes Auxiliares</legend>
        <div class="row">
            <label for="examenAuxiliares">Exámenes Auxiliares:</label>
            <textarea id="examenAuxiliares" name="examenAuxiliares"></textarea>
        </div>
    </fieldset>

    <fieldset>
        <legend>Tratamiento</legend>
        <div class="row">
            <label for="tratamiento">Tratamiento:</label>
            <textarea id="tratamiento" name="tratamiento"></textarea>
        </div>
    </fieldset>

    <fieldset>
        <legend>Datos del Acompañante del Paciente</legend>
        <div class="row">
            <label for="nombrePrimerAcomp">Primer Nombre:</label>
            <input type="text" id="nombrePrimerAcomp" name="nombrePrimerAcomp">
            <label for="nombreSegundoAcomp">Segundo Nombre:</label>
            <input type="text" id="nombreSegundoAcomp" name="nombreSegundoAcomp">
        </div>
        <div class="row">
            <label for="apellidoPaternoAcomp">Apellido Paterno:</label>
            <input type="text" id="apellidoPaternoAcomp" name="apellidoPaternoAcomp">
            <label for="apellidoMaternoAcomp">Apellido Materno:</label>
            <input type="text" id="apellidoMaternoAcomp" name="apellidoMaternoAcomp">
        </div> 
        <div class="row">
            <label for="dniAcompanante">DNI:</label>
            <input type="text" id="dniAcompanante" name="dniAcompanante">
            <label for="parentesco">Parentesco:</label>
            <input type="text" id="parentesco" name="parentesco">
        </div>
    </fieldset>

    <fieldset>
        <legend>Destino del Paciente</legend>
        <div class="row">
            <label for="destinoPaciente">Destino del Paciente:</label>
            <select id="destinoPaciente" name="destinoPaciente">
                <option value="" selected="selected">- selecciona -</option>
                <option value="Domicilio">Domicilio</option>
                <option value="Referido">Referido</option>
                <option value="Defunción">Defunción</option>
                <option value="Fuga">Fuga</option>
                <option value="Observación">Observación</option>
            </select>
            <label for="establecimiento">Especificar Establecimiento:</label>
            <textarea id="establecimiento" name="establecimiento"></textarea>
        </div>
    </fieldset>

    <fieldset>
        <legend>Datos de Atención en Observación</legend>
        <div class="row">
            <label for="fechaAtencionObs">Fecha de Ingreso:</label>
            <input type="date" id="fechaAtencionObs" name="fechaAtencionObs" value="<?php echo isset($datosUsuario['fechaAtencion']) ? $datosUsuario['fechaAtencion'] : ''; ?>">
            <label for="horaAtencionObs">Hora de Ingreso:</label>
            <input type="time" id="horaAtencionObs" name="horaAtencionObs" value="<?php echo isset($datosUsuario['horaAtencion']) ? $datosUsuario['horaAtencion'] : ''; ?>">
        </div>
        <div class="row">
            <label for="evolucion">Evolución:</label>
            <textarea id="evolucion" name="evolucion"></textarea>
        </div>
    </fieldset>

    </fieldset>

<fieldset>
    <legend>Impresión Diagnóstica</legend>
    <div class="row">
        <label for="diagnostico">Diagnóstico:</label>
        <input type="text" id="diagnostico" name="diagnostico">
        <label for="tipo">Tipo de DX:</label>
        <select id="tipo" name="tipo">
            <option value="" selected="selected">- selecciona -</option>
            <option value="presuntivo">Presuntivo</option>
            <option value="definitivo">Definitivo</option>
            <option value="repetido">Repetido</option>
        </select>
        <label for="cie10">CIE-10:</label>
        <input type="text" id="cie10" name="cie10">
    </div>
</fieldset> 

    <fieldset>
        <legend>Alta del Paciente</legend>
        <div class="row">
            <label for="fechaEgreso">Fecha de Egreso:</label>
            <input type="date" id="fechaEgreso" name="fechaEgreso">
            <label for="horaEgreso">Hora de Egreso:</label>
            <input type="time" id="horaEgreso" name="horaEgreso">
        </div>
        <div class="row">
            <label for="nombreResponsableAlta">Responsable de Alta:</label>
            <input type="text" id="nombreResponsableAlta" name="nombreResponsableAlta">
            <label for="firma">Firma:</label>
            <input type="file" id="firma" name="firma">
        </div>
    </fieldset>

    <div class="row">
        <button type="submit">Guardar Historia Clínica</button>
    </div>
</form>

<script>
$(document).ready(function(){
    $('#searchForm').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            url: '../section/HistoriaEmergencia.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response){
                $('#content').html(response);
            }
        });
    });

    $('#emergencyForm').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            url: 'guardar_historia_clinica.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response){
                alert(response);
            }
        });
    });
});
</script>