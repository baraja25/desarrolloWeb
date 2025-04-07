<?php
require_once 'fileManager.php';

$fileManager = new FileManager('imagenes');

if (isset($_POST['subir'])) {
    
    $nombreArchivo = $_FILES['imagen']['name'];
    $rutaTemporal = $_FILES['imagen']['tmp_name'];
    $fileManager->subirArchivo($nombreArchivo);
    $fileManager->guardarNombre($nombreArchivo);
    
}

if (isset($_POST['mostrar'])) {

    

    $lineas = file('datos.txt', FILE_IGNORE_NEW_LINES);
    foreach ($lineas as $linea) {
        $linea = explode(";", $linea);
        $nombreArchivo = $linea[0];
        $rutaDestino = 'imagenes/' . $nombreArchivo;
        if (file_exists($rutaDestino)) {
            echo "<img src='$rutaDestino' alt='$nombreArchivo' style='width: 200px; height: 500px;'>";
        } else {
            echo "La imagen $nombreArchivo no existe.";
        }
    }
    
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 9</title>
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
        <label for="imagen">Subir imagen: </label>
        <input type="file" name="imagen" id="imagen">
        <input type="submit" value="Subir imagen" name="subir">
        <input type="submit" value="Mostrar imagen" name="mostrar">
    </form>
</body>

</html>