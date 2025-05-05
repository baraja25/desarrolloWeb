<?php
require_once 'CochesDao.php';

$cochesDao = new CochesDao();
$cochesDao->listarCoches();

$coches = $cochesDao->coches;

$selectedMatricula = isset($_POST['matriculaSelect']) ? $_POST['matriculaSelect'] : '';
$mostrarForm = false;

if (isset($_POST['enviar'])) {
    $mostrarForm = true;
    $matriculaSeleccionada = $_POST['matriculaSelect'];
    $coche = $cochesDao->seleccionarCoche($matriculaSeleccionada);
    $nombre = $coche['nombre'];
    $marca = $coche['marca'];
    $modelo = $coche['modelo'];
    $precio = $coche['precio'];
    $anio = $coche['anio'];
    $foto = base64_encode($coche['foto']);
    $matricula = $coche['matricula'];
}



if (isset($_POST['actualizar'])) {
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $precio = $_POST['precio'];
    $anio = $_POST['anio'];
    $matricula = $_POST['matricula'];

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $foto = file_get_contents($_FILES['foto']['tmp_name']);
    } else {
        $foto = null; // O manejar el error de otra manera
    }

    // Actualizar el coche en la base de datos
    $cochesDao->actualizarCoche($selectedMatricula, $nombre, $marca, $modelo, $precio, $anio, $foto);
    // Redirigir o mostrar un mensaje de éxito
    header("Location: " . $_SERVER["PHP_SELF"]);
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3 dao</title>
</head>

<body>
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">
        <label for="matricula">Selecciona: </label>
        <select name="matriculaSelect" id="matricula">
            <option value=""></option>
            <?php foreach ($cochesDao->coches as $coche) : ?>
                <option value="<?php echo $coche->__get('matricula') ?>"
                    <?php echo ($coche->__get('matricula') === $selectedMatricula) ? 'selected' : ''; ?>>
                    <?php echo $coche->__get('matricula') ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Enviar" name="enviar">
        <br><br>
        <?php if ($mostrarForm) : ?>
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre" id="nombre" value="<?php echo $nombre ?>"><br><br>
            <label for="marca">Marca: </label>
            <input type="text" name="marca" id="marca" value="<?php echo $marca ?>"><br><br>
            <label for="modelo">Modelo: </label>
            <input type="text" name="modelo" id="modelo" value="<?php echo $modelo ?>"><br><br>
            <label for="precio">Precio: </label>
            <input type="number" name="precio" id="precio" value="<?php echo $precio ?>"><br><br>
            <label for="anio">Año: </label>
            <input type="number" name="anio" id="anio" value="<?php echo $anio; ?>"><br><br>
            <label for="foto">Foto: </label>
            <input type="file" name="foto" id="foto" accept="image/*"><br><br>
            <img src="data:image/jpeg;base64,<?php echo $foto ?>" alt="Coche" width="100"><br><br>
            <label for="matricula">Matricula: </label>
            <input type="text" name="matricula" id="matricula" value="<?php echo $matricula ?>"><br><br>
            <input type="submit" value="Actualizar" name="actualizar"><br><br>
        <?php endif; ?>
    </form>
</body>

</html>