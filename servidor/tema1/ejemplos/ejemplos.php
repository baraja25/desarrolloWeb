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
</body>

</html>