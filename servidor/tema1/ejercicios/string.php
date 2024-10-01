<!-- hacer una pagina que reciba una cadena de texto, un boton ordenar. Que devuelva las letras ordenadas alfabeticamente. -->
que reciba una cadena con un boton radio que convierta a mayus o minus.

<html>

<body>
    <?php
    function convertirArray($cadena)
    {
        $cadenaArray = array();

        for ($i = 0; $i < strlen($cadena); $i++) {
            $cadenaArray[] = $cadena[$i];
        }
        return $cadenaArray;
    }



    ?>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
        <label for="cadena">Introduce una frase: </label>
        <input type="text" name="cadena" id="cadena">
        <input type="submit" value="Ordenar" name="Ordenar">
        <?php
        $cadena = "";
        if (isset($_GET['Ordenar'])) {
            $cadena = $_GET['cadena'];


            $cadenaArray = convertirArray($cadena);
            sort($cadenaArray);

            $cadenaOrdenada = implode("", $cadenaArray);

            echo "$cadenaOrdenada";
        }



        ?>
    </form>
</body>

</html>