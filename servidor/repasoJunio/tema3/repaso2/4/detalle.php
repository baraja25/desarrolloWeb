<?php
if (!isset($_POST['cocheSeleccionado'])) {
    echo "No se ha seleccionado ningún coche.";
    exit;
}

$cochesSeleccionados = $_POST['cocheSeleccionado'];
var_dump($cochesSeleccionados);
require_once 'DaoCoche.php';

$dao = new CochesDao();
$dao->listarCoches();
$cochesMostrar = [];
foreach ($dao->coches as $coche) {
    if (isset($cochesSeleccionados[$coche->__get('id')])) {
        $cochesMostrar[] = $coche;
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4 v2</title>
</head>
<body>
    <?php foreach ($cochesMostrar as $coche): ?>
        <h2><?php echo $coche->__get('nombre'); ?></h2>
        <p><strong>Marca:</strong> <?php echo $coche->__get('marca'); ?></p>
        <p><strong>Modelo:</strong> <?php echo $coche->__get('modelo'); ?></p>
        <p><strong>Precio:</strong> <?php echo $coche->__get('precio'); ?></p>
        <p><strong>Año:</strong> <?php echo $coche->__get('anio'); ?></p>
        <p><strong>Matrícula:</strong> <?php echo $coche->__get('matricula'); ?></p>
        <img src="data:image/jpeg;base64,<?php echo $coche->__get('foto'); ?>" alt="Coche" width="300" height="200">
        <hr>
    <?php endforeach; ?>
    <form action="listar.php" method="post">
        <input type="submit" value="Volver a la lista de coches">
    </form>
</body>
</html>