<?php
date_default_timezone_set('America/Lima');

$conexion = mysqli_connect("localhost", "root", "", "clinica", 3306);

if (!$conexion) {
    die("Conexión con la base de datos interrumpida: " . mysqli_connect_error());
}

$datosUsuario = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['document_number'])) {
    $dni = $_POST['document_number'];

    $query = "SELECT id, dni, primerNombre, segundoNombre, apellidoPaterno, apellidoMaterno FROM historia_clinica WHERE dni = '$dni'";
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

<link rel="stylesheet" href="../estilos/styleem.css">

<h1>Busqueda de Incidencias</h1>

<div style="display: flex; flex-direction: column; align-items: center; justify-content: center; margin-bottom: 20px;">
    <form id="searchForm" action="BusquedaIncidencias.php" method="post" style="display: flex; flex-direction: column; align-items: center;">
        <input type="text" id="document_number" name="document_number" required placeholder="Ingrese el DNI" style="width: 250px; padding: 10px; border: 2px solid #ccc; border-radius: 25px; font-size: 16px; outline: none; margin-bottom: 10px;">
        <button id="search-button" type="submit" style="padding: 10px 20px; border: 2px solid #007bff; background-color: #007bff; color: white; font-size: 16px; border-radius: 25px; cursor: pointer; outline: none;">Buscar</button>
    </form>
</div>

<?php if (!empty($datosUsuario)): ?>
    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
        <h2>Resultados de la búsqueda</h2>
        <table border="1" style="border-collapse: collapse; width: 80%; text-align: left;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>DNI</th>
                    <th>Primer Nombre</th>
                    <th>Segundo Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datosUsuario as $usuario): ?>
                    <tr>
                        <td><?php echo $usuario['id']; ?></td>
                        <td><?php echo $usuario['dni']; ?></td>
                        <td><?php echo $usuario['primerNombre']; ?></td>
                        <td><?php echo $usuario['segundoNombre']; ?></td>
                        <td><?php echo $usuario['apellidoPaterno']; ?></td>
                        <td><?php echo $usuario['apellidoMaterno']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
