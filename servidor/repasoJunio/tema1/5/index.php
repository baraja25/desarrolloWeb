<?php
//buscar todos los archivos .txt en el directorio actual
$files = glob('*.txt');

if (isset($_POST['mostrar'])) {
    // Obtener el nombre del archivo seleccionado
    $fileName = $_POST['fileName'];
    // Comprobar si el archivo existe
    if (file_exists($fileName)) {
        // Leer el contenido del archivo
        $content = file_get_contents($fileName);
        // Mostrar el contenido en una nueva página
        echo "<h2>Contenido de $fileName:</h2>";
        echo "<pre>$content</pre>";
    } else {
        echo "<p>El archivo no existe.</p>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Archivos</title>
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
            <?php foreach ($files as $file): ?>
                <tr>
                    <td><?php echo $file; ?></td>
                    <td>
                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                            <input type="hidden" name="fileName" value="<?php echo $file; ?>">
                            <input type="submit" name="mostrar" value="Mostrar Contenido">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>



</body>

</html>