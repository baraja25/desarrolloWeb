<!DOCTYPE html>
<html lang="en">
<?php 
$opc = "";

if (isset($_POST['opcion'])) {
    $opc = $_POST['opcion'];
}



?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadisticas</title>
</head>

<body>
    <fieldset>
        <legend>Seleccione alumno</legend>

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

        </form>
    </fieldset>
</body>

</html>