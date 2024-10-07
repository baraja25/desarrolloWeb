<?php

function reverseString($cadena) {
    $invertida="";
    for ($i=strlen($cadena) - 1; $i >= 0 ; $i--) { 
        $invertida .= $cadena[$i];
    }
    return $invertida;
}


function esPalindroma($cadena) {
    $nuevo="";
    $separar = explode(" ", strtolower($cadena));

    foreach ($separar as $palabra) {
        trim($palabra);
        $nuevo .= $palabra;
    }

    if ($nuevo === reverseString($nuevo)) {
        echo "Es palindroma";
    } else {
        echo "No es palindroma";
    }
}

?>
<html>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
        <input type="text" name="principal" id="principal">
        <input type="submit" value="Buscar" name="Buscar">
        <?php
        if (isset($_GET['Buscar'])) {
            $palabra = $_GET['principal'];
            esPalindroma($palabra);
        }


        ?>
    </form>
</body>

</html>