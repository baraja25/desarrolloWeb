<?php 
function rellenarArray() {
    $array = [];
    for ($i = 0; $i < 10; $i++) {
        $array[] = $i;
    }
    return $array;
}

$listaOrdenada = rellenarArray();

if (isset($_POST['mezclar'])) {
    shuffle($listaOrdenada);
} elseif (isset($_POST['ordenar'])) {
    rsort($listaOrdenada);
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
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <table border="2">
            <tr>
                <?php foreach ($listaOrdenada as $numero): ?>
                    <tr>
                    <td style="width: 50px;"><?php echo $numero; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tr>
        </table>
        <input type="submit" value="Mezclar" name="mezclar">
        <input type="submit" value="Ordenar" name="ordenar">
    </form>
</body>
</html>