<?php
$dir = opendir('./');
$ficheros = array();
while ($archivo = readdir($dir)) {
    $campos = explode(".", $archivo);
    if ($campos[1] == "txt") {
        $ficheros[] = $archivo;
    }
}

if (isset($_POST['mostrar'])) {
    $fichero = $_POST['fichero'];
    $fd = fopen($fichero, "r");
    while (!feof($fd)) {
        $linea = fgets($fd);
        echo $linea . "<br>";
    }
    fclose($fd);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio 5 clase</title>
</head>

<body>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Nombre del archivo</th>
                <th>Contenido</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ficheros as $fichero): ?>
                <tr>
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                        <td><?php echo $fichero; ?></td>
                        <td><input type="submit" value="Mostrar contenido" name="mostrar"></td>
                        <input type="hidden" name="fichero" value="<?php echo $fichero; ?>">
                    </form>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>