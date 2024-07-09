<?php

include "conexion_be.php";

$errores = [];

// Validar campos en el servidor por seguridad
function validarCampo($campo) {
    return isset($campo) && trim($campo) !== '';
}

// Validar que el campo solo contiene letras
function validarSoloLetras($campo) {
    return preg_match('/^[a-zA-Z]+$/', $campo);
}

// Validar campos
if (!validarCampo($_POST['primerNombre'])) {
    $errores[] = "El primer nombre no puede estar vacío o contener solo espacios.";
} elseif (!validarSoloLetras($_POST['primerNombre'])) {
    $errores[] = "El primer nombre solo puede contener letras.";
}

if (!validarCampo($_POST['apellidoPaterno'])) {
    $errores[] = "El apellido paterno no puede estar vacío o contener solo espacios.";
} elseif (!validarSoloLetras($_POST['apellidoPaterno'])) {
    $errores[] = "El apellido paterno solo puede contener letras.";
}

if (!validarSoloLetras($_POST['segundoNombre'])) {
    $errores[] = "El segundo nombre solo puede contener letras.";
}

if (!validarCampo($_POST['apellidoMaterno'])) {
    $errores[] = "El apellido materno no puede estar vacío o contener solo espacios.";
} elseif (!validarSoloLetras($_POST['apellidoMaterno'])) {
    $errores[] = "El apellido materno solo puede contener letras.";
}

if (!validarCampo($_POST['tipoDocumento'])) {
    $errores[] = "El tipo de documento no puede estar vacío o contener solo espacios.";
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

// Validar fecha de nacimiento
$fechaNacimiento = $_POST['fecha'];
$fechaActual = date('Y-m-d');
if ($fechaNacimiento > $fechaActual) {
    $errores[] = "La fecha de nacimiento no puede ser una fecha futura.";
}

// Validar documento de identidad según el tipo seleccionado
$tipodocumento = $_POST['tipoDocumento'];
$documentoIdentidad = $_POST['documentoIdentidad'];

if ($tipodocumento === 'dni' && !preg_match('/^[0-9]{8}$/', $documentoIdentidad)) {
    $errores[] = "El DNI debe tener 8 números positivos.";
} elseif ($tipodocumento === 'carnet' && !preg_match('/^[0-9]{1,20}$/', $documentoIdentidad)) {
    $errores[] = "El Carnet de Extranjería debe tener entre 1 y 20 dígitos.";
} elseif ($tipodocumento === 'pasaporte' && !preg_match('/^[A-Za-z]{3}[0-9]{6}$/', $documentoIdentidad)) {
    $errores[] = "El Pasaporte debe tener tres letras seguidas de seis dígitos.";
}

// Si hay errores, mostrar mensajes de error y regresar al formulario
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
$tipodocumento = $_POST["tipoDocumento"];
$documentoIdentidad = $_POST["documentoIdentidad"];
$estadoCivil = $_POST["estadoCivil"];
$fecha = $_POST["fecha"];
$generoForm = $_POST["genero"];
$historial = $_POST["historial"];
$genero = $generoForm == "masculino" ? "M" : "F";

// Preparar consulta SQL
$query = "INSERT INTO historia_clinica (tipoDocumento, dni, primerNombre, segundoNombre, apellidoPaterno, apellidoMaterno, fechaNacimiento, sexo, grupoSanguineo, estadoCivil) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Preparar declaración
$stmt = mysqli_prepare($conexion, $query);

if (!$stmt) {
    echo "Error en mysqli_prepare: " . mysqli_error($conexion);
    exit();
}

// Vincular parámetros
mysqli_stmt_bind_param($stmt, "ssssssssss", $tipodocumento, $documentoIdentidad, $primer, $segundo, $paterno, $materno, $fecha, $genero, $grupoSanguineo, $estadoCivil);

// Ejecutar declaración
$resultado = mysqli_stmt_execute($stmt);

if ($resultado) {
    $nuevoId = mysqli_insert_id($conexion);
    echo '<script>';
    echo 'alert("Registro exitoso. ID del nuevo registro: ' . $nuevoId . '");';
    echo 'window.location="../section/bienvenida.php";';
    echo '</script>';
} else {
    echo "Error al registrar: " . mysqli_stmt_error($stmt);
}

mysqli_close($conexion);
?>
