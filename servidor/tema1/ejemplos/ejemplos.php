<html>

<?php
//iniciar las variables a vacio
$ini = "";
$fin = "";

//obtener valores al pulsar el boton de enviar
if (isset($_GET['Enviar'])) {
    $ini = $_GET['Inicial'];

    $fin = $_GET['Final'];
}
?>

<body>
    <fieldset>
        <legend>
            <form action="ejemplos.php" method="get" name="f1">
                tabla inicial <select name="Inicial">
                    <option value=""></option>
                    <?php
                    for ($i = 0; $i <= 10; $i++) {
                        echo "<option value='$i' ";
                        if ($i == $ini) {
                            echo " selected ";
                        }
                        echo ">$i</option>";
                    }

                    ?>

                </select>
                tabla final <select name="Final">
                    <option value=""></option>
                    <?php
                    for ($i = 0; $i <= 10; $i++) {
                        echo "<option value='$i' ";
                        if ($i == $fin) {
                            echo " selected ";
                        }
                        echo ">$i</option>";
                    }
                    ?>
                </select>
                <input type="submit" name="Enviar">
            </form>
        </legend>
    </fieldset>
    <table>
        <?php
        if ($ini>$fin) {
            echo "El valor inicial no puede ser mayor que el numero final";
        }
        
        if (!empty($ini) && !empty($fin)) {
            for ($i = $ini; $i <= $fin; $i++) {
                echo "<table border='2'>";
                echo "<th colspan='2'>Tabla del $i</th>";
                echo "<tr><td>Operacion</td><td>Resultado</td></tr>";
                for ($j = 1; $j <= 10; $j++) {
                    echo "<tr><td>$i X $j = </td><td>" . ($i * $j) . "</td></tr>"; //imprimir resultados en cada row
                }
                echo "</table>";
            }
        } else {
            echo "Los valores no pueden estar vacios";
        }


        ?>
    </table>
</body>

</html>