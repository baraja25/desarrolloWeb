<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 7</title>
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="frase">Introduce una frase: </label>
        <input type="text" name="frase" id="frase">
        <input type="submit" value="Enviar" name="enviar">

        <?php
        if (isset($_POST['enviar'])) {
            $frase = $_POST['frase'];
            $frase = strtolower($frase); // Convertir a minúsculas
            $frase = str_replace(" ", "", $frase); // Eliminar espacios
            $char = count_chars($frase, 1);
            foreach ($char as $key => $value) {
                echo "<table border='1' style='border-collapse: collapse;'>";
                echo "<th>Caracter</th>";
                echo "<th>Repeticiones</th>";
                echo "<tr>";
                echo "<td>" . chr($key) . "</td>";
                echo "<td>" . $value . "</td>";
                echo "</tr>";
                echo "</table>";
                
            }
        }

        ?>

    </form>
</body>

</html>