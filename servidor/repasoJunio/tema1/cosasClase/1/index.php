<?php
if (isset($_POST['enviar'])) {
    $altura = $_POST['altura'];
    $anchura = $_POST['anchura'];
    $texto = $_POST['texto'];
} else {
    $altura = 0;
    $anchura = 0;
    $texto = '';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 clase</title>
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="altura">Altura: </label>
        <input type="text" name="altura" id="altura">
        <br>
        <label for="anchura">Anchura: </label>
        <input type="text" name="anchura" id="anchura">
        <br>
        <label for="texto">Texto: </label>
        <input type="text" name="texto" id="texto">
        <br>

        <table border="1">
            <?php for ($i = 0; $i < $altura; $i++): ?>
                <tr>
                    <?php for ($j = 0; $j < $anchura; $j++): ?>
                        <td><?php echo $texto; ?></td>
                    <?php endfor; ?>
                </tr>
            <?php endfor; ?>
        </table>
        <input type="submit" value="Enviar" name="enviar">
    </form>
</body>

</html>