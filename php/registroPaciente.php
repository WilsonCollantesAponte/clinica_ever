<?php

include "conexion_be.php";

// Función para validar campos de texto
function validarCampo($campo) {
    return isset($campo) && trim($campo) !== '';
}

$errores = [];

// Validar campos
if (!validarCampo($_POST['primerNombre'])) {
    $errores[] = "El primer nombre no puede estar vacío o contener solo espacios.";
}

if (!validarCampo($_POST['apellidoPaterno'])) {
    $errores[] = "El apellido paterno no puede estar vacío o contener solo espacios.";
}

if (!validarCampo($_POST['apellidoMaterno'])) {
    $errores[] = "El apellido materno no puede estar vacío o contener solo espacios.";
}

if (!validarCampo($_POST['documentoIdentidad'])) {
    $errores[] = "El documento de identidad no puede estar vacío o contener solo espacios.";
}

if (!validarCampo($_POST['historial'])) {
    $errores[] = "El historial médico no puede estar vacío o contener solo espacios.";
}

// Verificar si el campo fecha está presente
if (!isset($_POST['fecha'])) {
    $errores[] = "El campo fecha no está definido.";
}

// Si hay errores, mostrar mensajes de error con una alerta
if (!empty($errores)) {
    echo '<script>';
    echo 'alert("Se encontraron los siguientes errores: \n' . implode('\n', $errores) . '");';
    echo 'window.history.back();';
    echo '</script>';
    exit();
}

// Obtener valores del formulario
$primer = $_POST["primerNombre"];
$segundo = $_POST["segundoNombre"];
$paterno = $_POST["apellidoPaterno"];
$materno = $_POST["apellidoMaterno"];
$grupoSanguineo = $_POST["grupoSanguineo"];
$documentoIdentidad = $_POST["documentoIdentidad"];
$estadoCivil = $_POST["estadoCivil"];
$fecha = $_POST["fecha"];
$generoForm = $_POST["genero"];
$historial = $_POST["historial"];
$genero = $generoForm == "masculino" ? "M" : "F";

// Verificar si el documento de identidad ya está registrado
$verificar_documento = mysqli_query($conexion, "SELECT * FROM historia_clinica WHERE dni='$documentoIdentidad'");

if (!$verificar_documento) {
    echo "Error en la consulta de verificación: " . mysqli_error($conexion);
    exit();
}

if (mysqli_num_rows($verificar_documento) > 0) {
    echo '
      <script>
        alert("Este Documento de identidad ya está registrado. Por favor verifique que los datos sean correctos.");
        window.location="../section/bienvenida.php";
      </script>
    ';  
    exit();
}

// Preparar consulta SQL
$query = "INSERT INTO historia_clinica (dni, primerNombre, segundoNombre, apellidoPaterno, apellidoMaterno, fechaNacimiento, sexo, grupoSanguineo, estadoCivil) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Imprimir consulta SQL para depuración
echo "Consulta SQL: " . $query . "<br>";

// Preparar declaración
$stmt = mysqli_prepare($conexion, $query);

if (!$stmt) {
    echo "Error en mysqli_prepare: " . mysqli_error($conexion);
    exit();
}

// Vincular parámetros
mysqli_stmt_bind_param($stmt, "sssssssss", $documentoIdentidad, $primer, $segundo, $paterno, $materno, $fecha, $genero, $grupoSanguineo, $estadoCivil);

// Ejecutar declaración
$resultado = mysqli_stmt_execute($stmt);

if ($resultado) {
    echo "Registro exitoso.";
    // Redirigir a la página de bienvenida
    header("location:../section/bienvenida.php");
} else {
    echo "Error al registrar: " . mysqli_stmt_error($stmt);
}

mysqli_close($conexion);
?>
