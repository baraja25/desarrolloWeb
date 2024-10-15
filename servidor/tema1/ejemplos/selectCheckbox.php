<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"> <!-- Establece la codificación de caracteres a UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Configura la vista para dispositivos móviles -->
    <title>Document</title> <!-- Título del documento -->
</head>

<body>
    <!-- Formulario que se enviará a la misma página -->
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="get">
        <?php
        // Definición de un arreglo con las aficiones disponibles
        $aficiones = array("futbol", "tenis", "cine", "teatro", "golf");

        // Itera sobre el arreglo de aficiones para crear casillas de verificación
        foreach ($aficiones as $key => $value) {
            // Crea una casilla de verificación para cada afición
            echo "<input type='checkbox' name='Aficiones[$key]'>$value<br>";
        }
        ?>
        <!-- Botón de envío del formulario -->
        <input type="submit" value="enviar" name="enviar">
    </form>

    <?php
    // Verifica si el formulario ha sido enviado y si se han seleccionado aficiones
    if (isset($_GET["enviar"]) && (isset($_GET["Aficiones"]))) {
        // Almacena las aficiones seleccionadas en una variable
        $susAficiones = $_GET["Aficiones"];

        // Itera sobre las aficiones seleccionadas para mostrarlas
        foreach ($susAficiones as $key => $value) {
            // Muestra el nombre de cada afición seleccionada
            echo "Afición seleccionada: $value<br>";
        }
    }
    ?>

</body>

</html>