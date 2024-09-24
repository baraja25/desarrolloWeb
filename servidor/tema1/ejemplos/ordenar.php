<html>

<body>
    <?php
    $numeros = array(5, 7, 3, 1, 6, 9, 6, 5, 3, 2);

    echo "Antes de ordenar";
    foreach ($numeros as $key => $value) {
        echo " $value";
    }
    echo "<br>";
    sort($numeros); //ordenacion por valor ascendente


    echo "Ordenar ascendente";
    foreach ($numeros as $key => $value) {
        echo " $value";
    }
    echo "<br>";

    rsort($numeros);

    echo "ordenar descendente";
    foreach ($numeros as $key => $value) {
        echo " $value";
    }
    echo "<br>";

    ?>



</body>

</html>