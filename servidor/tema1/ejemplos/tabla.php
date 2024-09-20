<html>
<?php
/*
crear 3 campos
primer campo pide palabra
segundo campo tamaño del 1 al 10
tercer campo direccion que sea un radio para elegir entre filas o columnas
*/
//iniciar las variables a vacio
$size = 0;
$word = "";
$direction = 1;

//obtener valores al pulsar el boton de enviar
if (isset($_GET['Enviar'])) {
    $size = $_GET['size'];
    $word = $_GET['palabra'];
    $direction = $_GET['direction'];
}




?>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">

    <input type="text" name="palabra">

    tamaño <select name="size">
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
        <input type="radio" name="direction" value="1" checked>Filas
        <input type="radio" name="direction" value="0">Columnas
        <input type="submit" value="Enviar">

</form>

</html>
