<?php 
// Esta es la parte que se ve de la pagina, hay que cargar el moverArea.php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio Recuperacion Tema 1</title>
</head>

<body>
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
        <table border="2">
            <tr>
                <th>Seleccionar</th>
                <th>ID</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Algo</th>
                <th>Precio</th>
            </tr>

            <?php
            // Poner los datos sobre la tabla
            foreach ($productos as $producto) {

                $productoString = implode(":", $producto);

                echo "<tr>";
                // Se que esta mal poner value al checkbox y deberia poner en el name algo como seleccionado[id] y a partir de ahi obtener los datos, pero no recuerdo exactamente como se hacia.
                echo "<td><input type='checkbox' name='seleccionado[]' value='$productoString'></td>";
                foreach ($producto as $key => $value) {
                    echo "<td>$value</td>";
                }
                echo "</tr>";
            }
            ?>
        </table>

        <label><input type="radio" name="Area" value="moverArea1" checked>Area1</label>

        <label><input type="radio" name="Area" value="moverArea2">Area2</label>

        <label><input type="radio" name="Area" value="moverArea3">Area3</label>

        <br>
        <input type="submit" value="Mover" name="mover">
        <br>
        <label for="area1">Area 1</label>
        <br>
        <textarea name="area1" cols="30" rows="10" placeholder="Introduce un texto..."><?php echo $valor1 ?></textarea>
        <br>
        <label for="area1">Area 2</label>
        <br>
        <textarea name="area2" cols="30" rows="10" placeholder="Introduce un texto..."><?php echo $valor2 ?></textarea>
        <br>
        <label for="area1">Area 3</label>
        <br>
        <textarea name="area3" cols="30" rows="10" placeholder="Introduce un texto..."><?php echo $valor3 ?></textarea>
    </form>
</body>

</html>