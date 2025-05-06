<?php 
require_once 'CochesDao.php';

$cochesDao = new CochesDao();
$coches = array();
$cochesDao->listarCoches();
$coches = $cochesDao->coches;




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4 Dao</title>
</head>
<body>
    <form action="detalle.php" method="get" enctype="multipart/form-data">
        <table border="1">
            <tr>
                <th>Seleccionar</th>
                <th>Foto</th>
            </tr>
            <?php foreach ($coches as $coche): ?>
            <tr>
                <td><input type="checkbox" name="cochesSeleccionados[<?php echo $coche->id ?>]"></td>
                <td><img src="data:image/jpeg;base64,<?php echo $coche->foto; ?>" alt="Coche" width="100"></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <input type="submit" value="Ver Detalle">
    </form>
</body>
</html>