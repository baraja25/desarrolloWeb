<?php
 if (isset($_GET['altura']) && isset($_GET['anchura']) && isset($_GET['texto'])) {
    $altura = $_GET['altura'];
    $anchura = $_GET['anchura'];
    $texto = $_GET['texto'];
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
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
        <input type="submit" value="Enviar">
    </form>
</body>
</html>