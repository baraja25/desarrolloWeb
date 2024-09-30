hacer una pagina con un despegable que pida numero de filas y columnas del 1 al 10, con un boton de rellenar. Se rellenara la tabla con numeros al azar del 1 al 50.

para mañana crear un campo de texto que busque el numero dentro de la matriz y que diga en la posicion en la que esta, hay que guardar la matriz

<html>
<?php 
$ini=0;
$fin=0;
if (isset($_GET['Rellenar'])) {
    $columna=$_GET["ini"];
    $row=$_GET["fin"];
}


?>
<body>
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="get">
        <select name="ini">
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
        <select name="fin">
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
        <input type="submit" value="Rellenar">
    </form>
        <table border="2">
    <?php 
    
    
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