<?php
if (!isset($_GET['id'])) {
    header('Location: listar.php');
    exit;
} else {
    $id = $_GET['id'];
    echo "<h1>Detalle del coche con ID: $id</h1>";
}
require_once 'DaoCoche.php';

$dao = new CochesDao();
$coche = $dao->buscarPorId($id);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 v2</title>
</head>
<body>
    <?php if ($coche): ?>
        <h2><?php echo $coche->__get('nombre'); ?></h2>
        <p><strong>Marca:</strong> <?php echo $coche->__get('marca'); ?></p>
        <p><strong>Modelo:</strong> <?php echo $coche->__get('modelo'); ?></p>
        <p><strong>Precio:</strong> <?php echo $coche->__get('precio'); ?></p>
        <p><strong>Año:</strong> <?php echo $coche->__get('anio'); ?></p>
        <p><strong>Matrícula:</strong> <?php echo $coche->__get('matricula'); ?></p>
        <img src="data:image/jpeg;base64,<?php echo $coche->__get('foto'); ?>" alt="Coche" width="300" height="200">
    <?php else: ?>
        <p>No se encontró el coche con ID: <?php echo $id; ?></p>
    <?php endif; ?>
</body>
</html>