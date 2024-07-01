<?php
date_default_timezone_set('America/Lima');

$conexion = mysqli_connect("localhost", "root", "", "clinica", 3306);

if (!$conexion) {
    die("Conexión con la base de datos interrumpida: " . mysqli_connect_error());
}

$datosUsuario = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['document_number'])) {
    $dni = $_POST['document_number'];

    $query = "SELECT id, dni, primerNombre, segundoNombre, apellidoPaterno, apellidoMaterno, fechaAtencion FROM historia_clinica WHERE dni = '$dni'";
    $resultado = mysqli_query($conexion, $query);

    if (mysqli_num_rows($resultado) > 0) {
        while ($row = mysqli_fetch_assoc($resultado)) {
            $datosUsuario[] = $row;
        }
    } else {
        echo '<script>alert("No se encontraron resultados para el DNI ingresado.");</script>';
    }
}

mysqli_close($conexion);
?>

<h1 style="text-align: center; font-family: Arial, sans-serif;">Busqueda de Incidencias</h1>

<div style="display: flex; flex-direction: column; align-items: center; justify-content: center; margin-bottom: 20px;">
    <form id="searchForm" action="BusquedaIncidencias.php" method="post" style="display: flex; flex-direction: column; align-items: center;">
        <input type="text" id="document_number" name="document_number" required placeholder="Ingrese el DNI" style="width: 250px; padding: 10px; border: 2px solid #ccc; border-radius: 25px; font-size: 16px; outline: none; margin-bottom: 10px;">
        <button id="search-button" type="submit" style="padding: 10px 20px; border: 2px solid #007bff; background-color: #007bff; color: white; font-size: 16px; border-radius: 25px; cursor: pointer; outline: none;">Buscar</button>
    </form>
</div>

<?php if (!empty($datosUsuario)): ?>
    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
        <h2 style="font-family: Arial, sans-serif;">Resultados de la búsqueda</h2>
        <table border="1" style="border-collapse: collapse; width: 80%; text-align: left; font-family: Arial, sans-serif;">
            <thead>
                <tr>
                    <th style="padding: 8px; background-color: #f2f2f2;">ID</th>
                    <th style="padding: 8px; background-color: #f2f2f2;">DNI</th>
                    <th style="padding: 8px; background-color: #f2f2f2;">Primer Nombre</th>
                    <th style="padding: 8px; background-color: #f2f2f2;">Segundo Nombre</th>
                    <th style="padding: 8px; background-color: #f2f2f2;">Apellido Paterno</th>
                    <th style="padding: 8px; background-color: #f2f2f2;">Apellido Materno</th>
                    <th style="padding: 8px; background-color: #f2f2f2;">Fecha de Atención</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datosUsuario as $usuario): ?>
                    <tr>
                        <td style="padding: 8px;"><?php echo $usuario['id']; ?></td>
                        <td style="padding: 8px;"><?php echo $usuario['dni']; ?></td>
                        <td style="padding: 8px;"><?php echo $usuario['primerNombre']; ?></td>
                        <td style="padding: 8px;"><?php echo $usuario['segundoNombre']; ?></td>
                        <td style="padding: 8px;"><?php echo $usuario['apellidoPaterno']; ?></td>
                        <td style="padding: 8px;"><?php echo $usuario['apellidoMaterno']; ?></td>
                        <td style="padding: 8px;"><?php echo $usuario['fechaAtencion']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
