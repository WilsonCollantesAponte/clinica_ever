<?php
date_default_timezone_set('America/Lima');

function buscarIncidencias($dni) {
    $conexion = mysqli_connect("localhost", "root", "", "clinica", 3306);

    if (!$conexion) {
        die("Conexión con la base de datos interrumpida: " . mysqli_connect_error());
    }

    $datosUsuario = [];
    $query = "SELECT id, dni, primerNombre, segundoNombre, apellidoPaterno, apellidoMaterno, fechaAtencion, diagnostico FROM historia_clinica WHERE dni = '$dni'";
    $resultado = mysqli_query($conexion, $query);

    if (mysqli_num_rows($resultado) > 0) {
        while ($row = mysqli_fetch_assoc($resultado)) {
            $datosUsuario[] = $row;
        }
    }
    
    mysqli_close($conexion);
    return $datosUsuario;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['document_number'])) {
    $dni = $_POST['document_number'];
    $datosUsuario = buscarIncidencias($dni);
    echo json_encode($datosUsuario);
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Busqueda de Incidencias</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<h1 style="text-align: center; font-family: Arial, sans-serif;">Busqueda de Incidencias</h1>
<div style="display: flex; flex-direction: column; align-items: center; justify-content: center; margin-bottom: 20px;">
    <form id="searchForm" style="display: flex; flex-direction: column; align-items: center;">
        <input type="text" id="document_number" name="document_number" required placeholder="Ingrese el DNI" style="width: 250px; padding: 10px; border: 2px solid #ccc; border-radius: 25px; font-size: 16px; outline: none; margin-bottom: 10px;">
        <button id="search-button" type="button" style="padding: 10px 20px; border: 2px solid #007bff; background-color: #007bff; color: white; font-size: 16px; border-radius: 25px; cursor: pointer; outline: none;">Buscar</button>
    </form>
</div>
<div id="resultados" style="display: flex; flex-direction: column; align-items: center; justify-content: center;"></div>

<script>
$(document).ready(function() {
    $('#search-button').click(function() {
        var dni = $('#document_number').val();
        $.ajax({
            type: 'POST',
            url: 'BusquedaIncidencias.php',
            data: { document_number: dni },
            success: function(response) {
                var datosUsuario = JSON.parse(response);
                if (datosUsuario.length > 0) {
                    var table = '<h2 style="font-family: Arial, sans-serif;">Resultados de la búsqueda</h2>';
                    table += '<table border="1" style="border-collapse: collapse; width: 80%; text-align: left; font-family: Arial, sans-serif;"><thead><tr>';
                    table += '<th style="padding: 12px; background-color: #b0b0b0; color: white;">ID</th>';
                    table += '<th style="padding: 12px; background-color: #b0b0b0; color: white;">DNI</th>';
                    table += '<th style="padding: 12px; background-color: #b0b0b0; color: white;">Primer Nombre</th>';
                    table += '<th style="padding: 12px; background-color: #b0b0b0; color: white;">Segundo Nombre</th>';
                    table += '<th style="padding: 12px; background-color: #b0b0b0; color: white;">Apellido Paterno</th>';
                    table += '<th style="padding: 12px; background-color: #b0b0b0; color: white;">Apellido Materno</th>';
                    table += '<th style="padding: 12px; background-color: #b0b0b0; color: white; width: 160px;">Fecha de Atención</th>';
                    table += '<th style="padding: 12px; background-color: #b0b0b0; color: white;">Diagnóstico</th>';
                    table += '</tr></thead><tbody>';

                    $.each(datosUsuario, function(index, usuario) {
                        table += '<tr>';
                        table += '<td style="padding: 12px; border: 1px solid #ddd; background-color: #fff;">' + (usuario.id || '') + '</td>';
                        table += '<td style="padding: 12px; border: 1px solid #ddd; background-color: #fff;">' + (usuario.dni || '') + '</td>';
                        table += '<td style="padding: 12px; border: 1px solid #ddd; background-color: #fff;">' + (usuario.primerNombre || '') + '</td>';
                        table += '<td style="padding: 12px; border: 1px solid #ddd; background-color: #fff;">' + (usuario.segundoNombre || '') + '</td>';
                        table += '<td style="padding: 12px; border: 1px solid #ddd; background-color: #fff;">' + (usuario.apellidoPaterno || '') + '</td>';
                        table += '<td style="padding: 12px; border: 1px solid #ddd; background-color: #fff;">' + (usuario.apellidoMaterno || '') + '</td>';
                        table += '<td style="padding: 12px; border: 1px solid #ddd; background-color: #fff;">' + (usuario.fechaAtencion || '') + '</td>';
                        table += '<td style="padding: 12px; border: 1px solid #ddd; background-color: #fff;">' + (usuario.diagnostico || '') + '</td>';
                        table += '</tr>';
                    });

                    table += '</tbody></table>';
                    $('#resultados').html(table);
                } else {
                    alert("No se encontraron resultados para el DNI ingresado.");
                }
            }
        });
    });
});
</script>
</body>
</html>
