<?php
    session_start();
    if (!isset($_SESSION['usuario'])) {
        header('Location: login1.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantenimiento de Productos</title>
</head>
<body>
    <h1>Operaciones de Mantenimiento de Productos</h1>
    <ul>
        <li><a href="alta.php">Alta de Producto</a></li>
        <li><a href="buscar.php">Buscar Producto</a></li>
        <li><a href="modificar.php">Modificar Producto</a></li>
        <li><a href="borrar.php">Borrar Producto</a></li>
    </ul>
</body>
</html>