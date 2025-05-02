<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = null;
}
require_once 'Database.php';

$database = new Database();
$coche = $database->query("SELECT * FROM coche WHERE id = :id", [':id' => $id])->fetch(PDO::FETCH_ASSOC);

if ($coche) {
    $coche['foto'] = base64_encode($coche['foto']);
}

$primero = $database->query("SELECT id FROM coche LIMIT 1")->fetchColumn();
$ultimo = $database->query("SELECT id FROM coche ORDER BY id DESC LIMIT 1")->fetchColumn();
$anterior = $database->query("SELECT id FROM coche WHERE id < :id ORDER BY id DESC LIMIT 1", [':id' => $id])->fetchColumn();
$siguiente = $database->query("SELECT id FROM coche WHERE id > :id ORDER BY id ASC LIMIT 1", [':id' => $id])->fetchColumn();

if ($anterior === false) {
    $anterior = $primero;
}
if ($siguiente === false) {
    $siguiente = $ultimo;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">
        <?php if ($id): ?>
            <div>
                ID: <input type="text" name="id" readonly value="<?php echo $coche['id']; ?>">
                <br>
                Nombre: <input type="text" name="nombre" value="<?php echo $coche['nombre']; ?>">
                <br>
                Marca: <input type="text" name="marca" value="<?php echo $coche['marca']; ?>">
                <br>
                Modelo: <input type="text" name="modelo" value="<?php echo $coche['modelo']; ?>">
                <br>
                Precio: <input type="text" name="precio" value="<?php echo $coche['precio']; ?>">
                <br>
                Matricula: <input type="text" name="matricula" value="<?php echo $coche['matricula']; ?>">
                <br>
                Año: <input type="text" name="ano" value="<?php echo $coche['anio']; ?>">
                <br>
                Foto: <img src="data:image/jpeg;base64,<?php echo $coche['foto']; ?>" alt="Foto de coche" style="width:100px;height:auto;">
                <input type="file" name="foto" accept="image/*">
                <br>
                <a href="listar.php?id=<?php echo $primero ?>"><<</a>
                <a href="listar.php?id=<?php echo $anterior ?>"><</a>
                <a href="listar.php?id=<?php echo $siguiente ?>">></a>
                <a href="listar.php?id=<?php echo $ultimo ?>">>></a>
            </div>
        <?php else: ?>
            <p>No hay imagen seleccionada.</p>
        <?php endif; ?>
    </form>
</body>

</html>