<!-- ejercicio para buscar cadena dentro de una cadena y devuelva la posicion -->

<?php

function stringpos($aguja, $pajar)
{
    $longitudAguja = strlen($aguja);
    $longitudPajar = strlen($pajar);


    //recorrer la cadena principal
    for ($i = 0; $i <= ($longitudPajar); $i++) {
        $coincidencia = true;

        //comprueba que los caracteres coinciden
        for ($j = 0; $j < $longitudAguja; $j++) {
           // echo "Comparando letra $aguja[$j] de aguja con " . $pajar[($i + $j)] . " de pajar <br>";

            if ($aguja[$j] !== $pajar[$i + $j]) { //si los caracteres no coinciden sale del  bucle
                $coincidencia = false;
                break;
            }
        }
        if ($coincidencia) { //si la variable se mantiene en true devuelve la posicion
            return $i;
        }
    }
    // si no encuentra nada devuelve falso
    return false;
}

?>


<html>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
        <input type="text" name="principal" id="principal">
        <input type="text" name="contenida" id="contenida">
        <input type="submit" value="Buscar" name="Buscar">
        <?php
        if (isset($_GET['Buscar'])) {
            $palabra = $_GET['principal'];
            $buscar = $_GET['contenida'];
            $pos = stringpos($buscar, $palabra);
            echo "la palabra $buscar se encuentra en la posicion $pos";
        }


        ?>
    </form>
</body>

</html>