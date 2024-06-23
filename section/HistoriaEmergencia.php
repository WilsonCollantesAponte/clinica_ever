<?php
// Configurar la zona horaria a la de Lima, Perú
date_default_timezone_set('America/Lima');

// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "clinica", 3306);

if (!$conexion) {
    die("Conexión con la base de datos interrumpida: " . mysqli_connect_error());
}

$datosUsuario = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['document_number'])) {
    $dni = $_POST['document_number'];

    // Consulta a la base de datos para obtener los datos del usuario
    $query = "SELECT p.nombrePrimer AS primerNombre, p.nombreSegundo AS segundoNombre, 
                     p.apellidoPaterno, p.apellidoMaterno, p.documentoIdentidad AS dni,
                     TIMESTAMPDIFF(YEAR, p.fechaNacimiento, CURDATE()) AS edad,
                     p.sexo, p.fechaNacimiento, pa.estadoCivil
              FROM clinica.persona p
              LEFT JOIN clinica.paciente pa ON p.id = pa.idPersona
              WHERE p.documentoIdentidad = '$dni'";

    $resultado = mysqli_query($conexion, $query);

    if (mysqli_num_rows($resultado) > 0) {
        $datosUsuario = mysqli_fetch_assoc($resultado);
    } else {
        echo '<script>alert("No se encontraron resultados para el DNI ingresado.");</script>';
    }
}

// Obtener la fecha y hora actuales en la zona horaria de Lima, Perú
$fechaActual = date('Y-m-d');
$horaActual = date('H:i');

mysqli_close($conexion);
?>

<link rel="stylesheet" href="../estilos/styleem.css">

<h1>Historia Clínica de Emergencia</h1>

<div class="search-container">
    <form id="searchForm" action="../section/HistoriaEmergencia.php" method="post">
        <input type="text" id="document_number" name="document_number" required placeholder="Ingrese el DNI">
        <button id="search-button" type="submit">Buscar</button>
    </form>
</div>

<form id="emergencyForm">
    <!-- Información General -->
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
            <label for="dni">Tipo de Documento:</label>
            <input type="text" id="dni" name="dni" value="<?php echo isset($datosUsuario['dni']) ? $datosUsuario['dni'] : ''; ?>">
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

   <!-- Botón de Enviar -->
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
            url: '../section/HistoriaEmergencia.php',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response){
                $('#content').html(response);
            }
        });
    });
});
</script>
