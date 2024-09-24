<?php
//crear una pagina que haga lo siguiente: la pagina creara 2 array al azar con numeros aleatorios entre el 1 y el 20 luego un despegable con las opciones union, interseccion y diferencia y luego un boton mostrar resultado
//union: unir los dos arrays
//interseccion: sacar los que coincidan
//diferencia: eliminar del primer array todo lo que este en el segundo
?>

<html>

<body>
    <?php
    $lista1 = array();
    $lista2 = array();
    $ope = ""; //inicializar variable operacion
    $nume1 = "";
    $nume2 = "";

    if (isset($_GET['operar'])) {
        $ope = $_GET['operar'];

        $nume1 = $_GET['nume1'];
        $nume2 = $_GET['nume2'];
    }

    if (isset($_GET['Enviar'])) {
    } else {
        for ($i = 0; $i < 20; $i++) {
            $lista1[] = rand(1, 20);
            echo "$lista1[$i] ";
        }
        echo "<br>";

        for ($i = 0; $i < 20; $i++) {
            $lista2[] = rand(1, 20);
            echo "$lista2[$i] ";
        }
    }

    echo "<br>";

    $nume1 = implode(",", $lista1); //variable que va a guardar el array serializado
    echo "<br>";
    echo "Numeros 1 <input type='text' name='nume1' value='$nume1'";

    $nume2 = implode(",", $lista2); //variable que va a guardar el array serializado
    echo "<br>";
    echo "Numeros 2 <input type='text' name='nume2' value='$nume2'";




    ?>

    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="get">
        operacion <select name="operar">
            <option value=""></option>
            <?php
            $operaciones = array();
            $operaciones[1] = "Union";
            $operaciones[2] = "Interseccion";
            $operaciones[3] = "Diferencia";

            foreach ($operaciones as $key => $value) {
                echo "<option value='$key ' ";
                if ($key == $ope) {
                    echo "selected";
                }
                echo ">$value</option>";
            }
            ?>


            <input type="submit" name="Enviar" value="Mostrar resultado">

            <?php

            if ($ope != "") {;
                $lista1 = explode(",", $nume1);
                $lista2 = explode(", ", $nume2);
            }
            if ($ope == 1) {
                $union = array();

                foreach ($lista1 as $key => $value) { //volcar todos los elementos del primer array
                    if (!in_array($value, $union)) {
                        $union[] = $value;
                    }
                }

                foreach ($lista2 as $key => $value) {
                    if (!in_array($value, $union)) {
                        $union[] = $value;
                    }
                }
                
                echo "Resultado de la operacion: ";

                foreach ($union as $key => $value) {
                    echo "$value ";
                }

                

            }



            ?>
    </form>
</body>

</html>