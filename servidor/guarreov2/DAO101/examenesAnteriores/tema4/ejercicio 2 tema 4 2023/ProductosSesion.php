<?php
session_start();

require_once 'Database.php';

$db = new Database("tienda");

if (!isset($_SESSION['productos'])) {
    $_SESSION['productos'] = [];
}

if (isset($_POST['Alta'])) {
    $producto = [
        'codigo' => $_POST['codigo'],
        'nombre' => $_POST['nombre'],
        'pvp' => $_POST['pvp'],
        'familia' => $_POST['familia']
    ];
    $_SESSION['productos'][] = $producto;
}

if (isset($_POST['Buscar'])) {
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $pvp = $_POST['pvp'];
    $familia = $_POST['familia'];

    $resultados = array_filter($_SESSION['productos'], function($producto) use ($codigo, $nombre, $pvp, $familia) {
        return ($codigo === '' || $producto['codigo'] === $codigo) &&
               ($nombre === '' || $producto['nombre'] === $nombre) &&
               ($pvp === '' || $producto['pvp'] === $pvp) &&
               ($familia === '' || $producto['familia'] === $familia);
    });
}

if (isset($_POST['Volcar'])) {
    foreach ($_SESSION['productos'] as $producto) {
        $consulta = "INSERT INTO producto (cod, nombre, PVP, familia) VALUES (:codigo, :nombre, :pvp, :familia)";
        $param = [
            ':codigo' => $producto['codigo'],
            ':nombre' => $producto['nombre'],
            ':pvp' => $producto['pvp'],
            ':familia' => $producto['familia']
        ];
        $db->query($consulta, $param);
    }
    $_SESSION['productos'] = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Productos Sesión</title>
</head>
<body>
    <form method="post" action="">
        <label for="codigo">Código:</label>
        <input type="text" name="codigo" id="codigo">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre">
        <label for="pvp">PVP:</label>
        <input type="text" name="pvp" id="pvp">
        <label for="familia">Familia:</label>
        <input type="text" name="familia" id="familia">
        <input type="submit" name="Alta" value="Alta">
        <input type="submit" name="Buscar" value="Buscar">
        <input type="submit" name="Volcar" value="Volcar">
    </form>

    <?php if (isset($resultados)): ?>
        <table border="1">
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>PVP</th>
                <th>Familia</th>
            </tr>
            <?php foreach ($resultados as $producto): ?>
                <tr>
                    <td><?php echo htmlspecialchars($producto['codigo']); ?></td>
                    <td><?php echo htmlspecialchars($producto['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($producto['pvp']); ?></td>
                    <td><?php echo htmlspecialchars($producto['familia']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>