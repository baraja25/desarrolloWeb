<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta alumno</title>
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
        <label for="nif">NIF: </label>
        <input type="text" name="nif" id="nif">
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" id="nombre">
        <label for="apellido1">Primer apellido: </label>
        <input type="text" name="apellido1" id="apellido1">
        <label for="apellido2">Segundo apellido: </label>
        <input type="text" name="apellido2" id="apellido2">
        <label for="telefono">Telefono: </label>
        <input type="text" name="telefono" id="telefono">
        <input type="submit" value="Introducir datos" name="insertar">
        <?php
        if (isset($_GET['insertar'])) {
            $nif = $_GET['nif'];
            $nombre = $_GET['nombre'];
            $apellido1 = $_GET['apellido1'];
            $apellido2 = $_GET['apellido2'];
            $telefono = $_GET['telefono'];
            $tfnlen = strlen($telefono);
            $niflen = strlen($nif);

            // insertar datos en la base de datos
            $host = "localhost";

            $user = "root";

            $pass = "";

            $base = "tema2";

            $consulta = "";

            $db = mysqli_connect($host, $user, $pass, $base); // Conexion al servidor de base de datos y devuelve el decriptor de conexion

            if ($niflen != 9) {
                echo "EL tamaño del nif tiene que ser 9";
            } elseif ($tfnlen != 9) {
                echo "Por favor introduce un numero valido";
            } else {
                $consulta = "INSERT INTO alumnos VALUES('$nif','$nombre', '$apellido1', '$apellido2','$telefono')";
            }



            $resultado = mysqli_query($db, $consulta);

            if ($resultado == false) {
                echo "Error al hacer la consulta" . mysqli_error($db);
            }

            mysqli_close($db);
        }

        ?>
    </form>
</body>

</html>