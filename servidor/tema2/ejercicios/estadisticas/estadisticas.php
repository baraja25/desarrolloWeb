<!DOCTYPE html>
<html lang="en">
<?php
$opc = "";
$cantidadAlumno = "";
$radioOpcion = "";
if (isset($_POST['opcion'])) {
    $opc = $_POST['opcion'];
}

if (isset($_POST['cantidadAlumnos'])) {
    $cantidadAlumno = $_POST['cantidadAlumnos'];
}

if (isset($_POST['elegirSuspenso'])) {
    $radioOpcion = $_POST['elegirSuspenso'];
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadisticas</title>
</head>

<body>
    <fieldset>
        <legend>Seleccione criterios</legend>

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">

            <select name="opcion" id="opcion">
                <option value=""></option>

                <?php
                $opciones = array(1 => "Mejores", 2 => "Peores");

                foreach ($opciones as $key => $value) {
                    echo "<option value='$key' ";

                    if ($opc == $key) {
                        echo " selected ";
                    }
                    echo ">$value</option>";
                }
                ?>
            </select>
            <select name="cantidadAlumnos">
                <option value=""></option>
                <?php
                for ($i = 1; $i <= 10; $i++) {
                    echo "<option value='$i' ";

                    if ($cantidadAlumno == $i) {
                        echo " selected ";
                    }
                    echo ">$i</option>";
                }
                ?>
            </select>

            <?php 
            $radioOpciones = array(1 => "Si", 2=> "No");
            foreach ($radioOpciones as $key => $value) {
                echo "$value<input type='radio' name='elegirSuspenso' value='$key' ";
                
                if ($radioOpcion == $key) {
                    echo " checked ";
                }

                echo " >";
            }
            ?>

            <input type="submit" value="Mostrar" name="mostrarResultado">
        </form>
    </fieldset>
</body>

</html>