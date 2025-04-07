<?php 
require_once 'fileManager.php';
$fileManager = new FileManager('nombres.txt');

if (isset($_POST['enviar'])) {
    $nombre = $_POST['nombre'];
    $fileManager->guardarNombre($nombre);
}

if (isset($_POST['mostrar'])) {
    $nombres = $fileManager->mostrarNombres();
    echo "<h2>Nombres almacenados:</h2>";
    foreach ($nombres as $linea) {
        list($nombreGuardado, $contador) = explode(";", $linea);
        echo "$nombreGuardado: $contador veces<br>";
    }
}

if (isset($_POST['borrar'])) {
    $nombre = $_POST['nombre'];
    $fileManager->borrarNombre($nombre);
    echo "<h2>Nombre '$nombre' borrado.</h2>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 10</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="nombre">Introduce un nombre: </label>
        <input type="text" name="nombre" id="nombre">
        <input type="submit" value="Enviar" name="enviar">
        <input type="submit" value="Mostrar nombres" name="mostrar">
        <input type="submit" value="Borrar nombre" name="borrar">
    </form>
</body>
</html>