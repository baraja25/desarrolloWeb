<?php
require_once 'db.php';

$db = "concesionario";
$conexion = new DB($db);
$conexion->ConsultaDatos("SELECT * FROM marcascoches");
$marcas = $conexion->getFilas();
$idMarca = $_POST['marca_id']; 


function obtenerId() {
    global $marcas;
    global $idMarca; 
    foreach ($marcas as $key => $marca) {
        if ($marca['Id'] == $idMarca) {
            return $key;
        }
    }
}

$id = obtenerId();

if (isset($_POST['submit'])) {
    $imagen = $_FILES['imagen'];
    $nombreImagen = $imagen['name'];
    $tipoImagen = $imagen['type'];
    $tamanoImagen = $imagen['size'];
    $tempImagen = $imagen['tmp_name'];
    $errorImagen = $imagen['error'];

    $extensionImagen = pathinfo($nombreImagen, PATHINFO_EXTENSION);
    $extensionImagen = strtolower($extensionImagen);

    $extensionesPermitidas = array('jpg', 'jpeg', 'png', 'gif');

    if (in_array($extensionImagen, $extensionesPermitidas)) {
        if ($errorImagen === 0) {
            if ($tamanoImagen < 1000000) {
                $nombreImagenNuevo = uniqid('', true) . "." . $extensionImagen;
                $rutaImagen = 'coches/' . $nombreImagenNuevo;
                move_uploaded_file($tempImagen, $rutaImagen);
                $conexion->ConsultaSimple("UPDATE marcascoches SET Logo = '$nombreImagenNuevo' WHERE Id = $idMarca");
                
            } else {
                echo "La imagen es muy grande";
            }
        } else {
            echo "Hubo un error al subir la imagen";
        }
    } else {
        echo "Tipo de archivo no permitido";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Marca</title>
</head>
<body>
    <h1>Actualizar Logo de Marca</h1>
    <form action="actualizarMarca.php" method="post" enctype="multipart/form-data">
        <label for="marca_id">ID de la Marca:</label>
        <input type="text" name="marca_id" id="marca_id" required><br><br>
        <label for="imagen">Selecciona una imagen:</label>
        <input type="file" name="imagen" id="imagen" required><br><br>
        <img src="<?php echo 'coches/'.$marcas[$id]['Logo']; ?>" alt="Logo de la Marca"><br><br>
        <input type="submit" value="Actualizar Logo" name="submit">
    </form>
</body>
</html>