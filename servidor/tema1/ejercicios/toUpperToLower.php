<html>

<body>
    <?php
    $ope = 1;
    $convertida = "";
    $Letras = array();
    $Letras['a'] = "A";
    $Letras['b'] = "B";
    $Letras['c'] = "C";
    $Letras['d'] = "D";
    $Letras['e'] = "E";
    $Letras['f'] = "F";
    $Letras['g'] = "G";
    $Letras['h'] = "H";
    $Letras['i'] = "I";
    $Letras['j'] = "J";
    $Letras['k'] = "K";
    $Letras['l'] = "L";
    $Letras['m'] = "M";
    $Letras['n'] = "N";
    $Letras['ñ'] = "Ñ";
    $Letras['o'] = "O";
    $Letras['p'] = "P";
    $Letras['q'] = "Q";
    $Letras['r'] = "R";
    $Letras['s'] = "S";
    $Letras['t'] = "T";
    $Letras['u'] = "U";
    $Letras['v'] = "V";
    $Letras['w'] = "W";
    $Letras['x'] = "X";
    $Letras['y'] = "Y";
    $Letras['z'] = "Z";


    function convertirArray($cadena)
    {
        $cadenaArray = array();

        for ($i = 0; $i < strlen($cadena); $i++) {
            $cadenaArray[] = $cadena[$i];
        }
        return $cadenaArray;
    }

    function toUpper($cadena)
    {
        global $Letras, $convertida;

        for ($i = 0; $i < strlen($cadena); $i++) {

            if (array_key_exists($cadena[$i], $Letras)) { //si la clave esta en el array accede al valor de esa posicion y concatena el valor
                $convertida .= $Letras[$cadena[$i]];
            } else {
                $convertida .= $cadena[$i]; //si no es minuscula se deja como esta
            }
        }
    }


    function toLower($cadena)
    {
        global $Letras, $convertida;

        for ($i = 0; $i < strlen($cadena); $i++) {

            $clave = array_search($cadena[$i], $Letras);

            if ($clave === false) {

                $convertida .= $cadena[$i];
            } else {
                $convertida .= $clave; //si no es mayuscula se deja como esta
            }
        }
    }

    ?>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
        <label for="cadena">Introduce una frase: </label>
        <input type="text" name="cadena" id="cadena">
        <?php

        $opciones = array(1 => "Mayusculas", 2 => "Minusculas");

        foreach ($opciones as $key => $value) {
            echo $value, "<input type='radio' name='Operacion' id='Operacion' value='$key'";

            if ($key == $ope) {
                echo "checked";
            }
            echo ">";
        }
        ?>
        <input type="text" name="convertida" id="convertida" value=" <?php echo $convertida ?>">
        <input type="submit" value="Convertir" name="Convertir">
        <?php

        if (isset($_GET['Convertir'])) {
            $cadena = $_GET['cadena'];
            $ope = $_GET['Operacion'];

            if ($ope == 1) {
                $cadena = toUpper($cadena);
            }

            if ($ope == 2) {
                $cadena = toLower($cadena);
            }
        }

        ?>
    </form>
</body>

</html>