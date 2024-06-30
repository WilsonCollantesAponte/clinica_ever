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

<h1>Busqueda de Incidencias</h1>

<div style="display: flex; flex-direction: column; align-items: center; justify-content: center; margin-bottom: 20px;">
    <form id="searchForm" action="EditarHistoriaClinica.php" method="post" style="display: flex; flex-direction: column; align-items: center;">
        <input type="text" id="document_number" name="document_number" required placeholder="Ingrese el DNI" style="width: 250px; padding: 10px; border: 2px solid #ccc; border-radius: 25px; font-size: 16px; outline: none; margin-bottom: 10px;">
        <button id="search-button" type="submit" style="padding: 10px 20px; border: 2px solid #007bff; background-color: #007bff; color: white; font-size: 16px; border-radius: 25px; cursor: pointer; outline: none;">Buscar</button>
    </form>
</div>
