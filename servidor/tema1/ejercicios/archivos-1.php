<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta alumno</title>
</head>
<body>
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="get">
        <label for="Nif">NIF: </label>
        <input type="text" name="Nif" id="Nif">
        <br>
        <label for="Nombre">Nombre: </label>
        <input type="text" name="Nombre" id="Nombre">
        <br>
        <label for="Apellido1">Apellido 1: </label>
        <input type="text" name="Apellido1" id="Apellido1">
        <br>
        <label for="Apellido2">Apellido 2: </label>
        <input type="text" name="Apellido2" id="Apellido2">
        <br>
        <label for="Edad">Edad: </label>
        <input type="number" name="Edad" id="Edad">
        <br>
        <label for="Telefono">Telefono: </label>
        <input type="text" name="Telefono" id="Telefono">
        <input type="submit" value="Enviar" name="Enviar">
        <?php

        function guardar($archivo, $linea)
        {
            $fd = fopen($archivo, "a+") or die("Error al crear el archivo");

            fputs($fd, $linea);

            fclose($fd);
        }

        if (isset($_GET['Enviar'])) {
            $nif = $_GET["Nif"];
            $nombre = $_GET["Nombre"];
            $ape1 = $_GET["Apellido1"];
            $ape2 = $_GET["Apellido2"];
            $edad = $_GET["Edad"];
            $tfn = $_GET["Telefono"];
            $salto = "\r\n";
            $archivo = "altaAlumno.txt";

            $linea = "$nif:$nombre:$ape1:$ape2:$edad:$tfn";
            $linea .= $salto;

            guardar($archivo, $linea);

            
        }



        ?>

    </form>
</body>

</html>