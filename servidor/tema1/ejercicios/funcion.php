hacer una pagina con un despegable que pida numero de filas y columnas del 1 al 10, con un boton de rellenar. Se rellenara la tabla con numeros al azar del 1 al 50.

para mañana crear un campo de texto que busque el numero dentro de la matriz y que diga en la posicion en la que esta, hay que guardar la matriz

<html>
<?php
$filas = "";
$columnas = "";


?>

<body>
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="get">
        <label for="fila">Filas: </label>
        <select name="filas" id="filas">
            <option value=""></option>
            <?php
            for ($i = 0; $i <= 10; $i++) {
                echo "<option value='$i' ";
                if ($i == $filas) {
                    echo " selected ";
                }
                echo ">$i</option>";
            }
            ?>
        </select>
        <label for="columnas">Columnas: </label>
        <select name="columnas" id="columnas">
            <option value=""></option>
            <?php
            for ($i = 0; $i <= 10; $i++) {
                echo "<option value='$i' ";
                if ($i == $columnas) {
                    echo " selected ";
                }
                echo ">$i</option>";
            }
            ?>
        </select>
        <input type="submit" value="Rellenar" name="rellenar">
    </form>

    <?php

    if (isset($_GET['rellenar'])) {
        $filas = $_GET["filas"];
        $columnas = $_GET["columnas"];
        $matriz = [];


        //generar matriz y guardarla como cadena
        for ($i = 0; $i < $filas; $i++) {
            $fila = [];
            for ($j = 0; $j < $columnas; $j++) {
                $fila[] = rand(1, 50);
            }
            $matriz[] = implode(",", $fila);
        }
        $matrizString = implode(";", $matriz);


        //mostrar tabla

        echo "<table border='2'>";

        foreach ($matriz as $filaString) {
            echo "<tr>";
            $valores = explode(",", $filaString);
            foreach ($valores as $valor) {
                echo "<td>$valor</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
    ?>
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="get">
        <input type="hidden" name="matriz" value="<?php $matrizString  ?>">
        <label for="numero">Numero a buscar</label>
        <input type="number" name="numero" id="numero">
        <input type="submit" name="buscar" value="buscar numero">
    </form>
    <?php 
    if (isset($_GET['buscar'])) {
        $numero = $_GET['numero'];
        $matrizString = $_GET['matriz'];
        $encontrado = false;

        //dividir en filas
        $filas = explode(";", $matrizString);

        foreach ($filas as $i => $filaString) {
            $columnas = explode(",", $filaString);

            foreach ($columnas as $j => $valor) {
                if ($valor == $numero) {
                    echo "El numero se encuentra en la posicion $i, $j";
                    $encontrado = true;
                    break 2;
                }
            }
        }

    }
    
    
    
    ?>
</body>

</html>