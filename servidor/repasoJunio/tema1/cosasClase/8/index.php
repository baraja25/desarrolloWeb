<?php
if (isset($_POST['enviar'])) {
    $nif = $_POST['nif'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];

    if (empty($nif) || empty($nombre) || empty($correo)) {
        echo "Por favor, completa todos los campos.";
    }

    $salto = "\r\n";
    $linea = "$nif $nombre $correo" . $salto;
    $fichero = fopen("datos.txt", "a+") or die("No se puede abrir el fichero");
    fputs($fichero, $linea);
    fclose($fichero);
}

if (isset($_POST['buscar'])) {
    
    $nif = $_POST['nif'];
    $fichero = fopen("datos.txt", "r") or die("No se puede abrir el fichero");
    $encontrado = false;
    while (!feof($fichero)) {
        $linea = fgets($fichero);
        $datos = explode(" ", trim($linea));
        if ($datos[0] == $nif) {
            $encontrado = true;
            echo "NIF: " . $datos[0] . "<br>";
            echo "Nombre: " . $datos[1] . "<br>";
            echo "Correo: " . $datos[2] . "<br>";
            break;
        }
    }

    fclose($fichero);

    if (!$encontrado) {
        echo "No se encontraron datos para el NIF: $nif";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 8 clase</title>
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        NIF: <input type="text" name="nif">
        <br>
        Nombre: <input type="text" name="nombre">
        <br>
        Correo: <input type="text" name="correo">
        <br>
        <input type="submit" value="Enviar" name="enviar">
        <input type="submit" value="buscar" name="buscar">
    </form>
</body>

</html>