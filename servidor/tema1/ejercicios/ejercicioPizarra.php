<?php
// ir añadiendo nombres con un boton guardar y mostrar los nombres en una tabla. 
?>

<?php
$agenda = "";

if (isset($_GET['agenda'])) {
    $agenda = $_GET['agenda'];
}

if (isset($_GET['guardarNombre'])) {

    $nombre = $_GET['nombre'];

    if ($agenda == "") {
        $agenda = $agenda . $nombre;
    } else {
        $agenda = $agenda . "," . $nombre;
    }
}
?>

<html>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">

        <label for="nombres">Nombre: </label>
        <input type="text" name="nombre" id="nombre">
        <?php
        echo "<input type='hidden' name='agenda' value=$agenda>";
        ?>
        <input type="submit" value="Guardar" name="guardarNombre">
        <input type="submit" value="Mostrar" name="MostrarTabla">

    </form>




</body>

</html>