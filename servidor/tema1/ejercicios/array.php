<html>

<body>

<?php
$elementos = array();
$mayor = 0;
$ini="";
//obtener valores al pulsar el boton de enviar
if (isset($_GET['Enviar'])) {
    $ini = $_GET['tama'];
    $limite = $_GET['limite'];
}


?>
<form action="array.php" method="get" name="f1">
    numero de elementos <select name="tama">

        <option value=""></option>

        <?php

        for ($i = 10; $i <= 20; $i++) {
            echo "<option value='$i' ";
            if ($i == $ini) {
                echo " selected ";
            }
            echo ">$i</option>";
        }
        ?>

    </select>

    limite superior <input type="number" name="limite" placeholder="1-30">
    <?php

    if (isset($_GET['Enviar'])) {

        //rellenar el array
        for ($i = 0; $i < $ini; $i++) {
            $elementos[] = rand(1, $limite);
        }
        //mostrar el array
        for ($i = 0; $i < $ini; $i++) {
            echo $elementos[$i] . ",";

            if ($elementos[$i] > $mayor) {
                $mayor = $elementos[$i];
            }
        }
    }


    ?>

    mayor elemento <input type="number" name="mayor" value="<?php echo $mayor; ?>">

    <input type="submit" name="Enviar" value="Buscar mayor">
</form>
</body>

</html>