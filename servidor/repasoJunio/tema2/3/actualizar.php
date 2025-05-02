<?php 
require_once "Database.php";
$db = new Database();

$matriculas = $db->query("SELECT matricula FROM coche")->fetchAll(PDO::FETCH_COLUMN, 0);

$mostrarFormulario = false;
$matriculaSeleccionada = "";

if (isset($_POST["matricula"]) ) {
    $matriculaSeleccionada = $_POST["matricula"];  
} 

if (isset($_POST["seleccionar"])) {
    $mostrarFormulario = true;
    $coche = $db->query("SELECT * FROM coche WHERE matricula = ?", [$matriculaSeleccionada])->fetch(PDO::FETCH_ASSOC);
    $marca = $coche["marca"];
    $modelo = $coche["modelo"];
    $precio = $coche["precio"];
    $year = $coche["anio"];
    $nombre = $coche["nombre"];
    $foto = base64_encode($coche["foto"]);
    $matricula = $coche["matricula"];
}

if (isset($_POST["actualizar"])) {
    $marca = $_POST["marca"];
    $modelo = $_POST["modelo"];
    $precio = $_POST["precio"];
    $year = $_POST["year"];
    $nombre = $_POST["nombre"];
    $foto = $_FILES["foto"]["tmp_name"] ? file_get_contents($_FILES["foto"]["tmp_name"]) : null;
    
    if ($foto) {
        $db->query("UPDATE coche SET marca = ?, modelo = ?, precio = ?, anio = ?, nombre = ?, foto = ? WHERE matricula = ?", [$marca, $modelo, $precio, $year, $nombre, $foto, $matriculaSeleccionada]);
    } else {
        $db->query("UPDATE coche SET marca = ?, modelo = ?, precio = ?, anio = ?, nombre = ? WHERE matricula = ?", [$marca, $modelo, $precio, $year, $nombre, $matriculaSeleccionada]);
    }
    
    header("Location: " . $_SERVER["PHP_SELF"]);
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
</head>
<body>
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">
        <select name="matricula" >
            <option value=""></option>
            <?php foreach ($matriculas as $matricula): ?>
                <option value="<?php echo $matricula ?>" <?php echo ($matricula == $matriculaSeleccionada) ? 'selected' : '' ?>>
                    <?php echo $matricula ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Seleccionar" name="seleccionar">
        <?php if ($mostrarFormulario): ?>
            <br>
            Marca: <input type="text" name="marca" value="<?php echo $marca ?>" placeholder="Marca">
            <br>
            Modelo: <input type="text" name="modelo" value="<?php echo $modelo ?>" placeholder="Modelo">
            <br>
            Precio: <input type="number" name="precio" value="<?php echo $precio ?>" placeholder="Precio">
            <br>
            Año: <input type="number" name="year" value="<?php echo $year ?>" placeholder="Año">
            <br>
            Nombre: <input type="text" name="nombre" value="<?php echo $nombre ?>" placeholder="Nombre">
            <br>
            Foto: <img src="data:image/jpeg;base64,<?php echo $foto ?>" alt="Foto" width="100" height="100">
            <br>
            <input type="file" name="foto">
            <br>
            <input type="submit" value="Actualizar" name="actualizar">
        <?php endif; ?>
    </form>
</body>
</html>