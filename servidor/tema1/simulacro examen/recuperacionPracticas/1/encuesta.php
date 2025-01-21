<!--1. Crea una página PHP que permita procesar las respuestas de una encuesta.-->
<!--El formulario debe incluir:-->
<!--- Una pregunta con opciones de tipo radio para seleccionar el género-->
<!--(Masculino/Femenino/No especificar).-->
<!--- Una pregunta con un campo textarea para comentar sobre el servicio.-->
<!--- Una lista de preferencias (checkbox) con al menos tres opciones.-->
<!--El script debe procesar las respuestas:-->
<!--1. Validar que se seleccionó un género y al menos una preferencia.-->
<!--2. Analizar el comentario del textarea y mostrar:-->
<!--- Cantidad de palabras.-->
<!--- Palabras más largas encontradas.-->
<!--3. Guardar las respuestas en un array asociativo y mostrarlas formateadas.-->
<?php
if (isset($_POST['enviar'])) {
    // Validar género
    if (!isset($_POST['Genero'])) {
        echo "<h3>Por favor, selecciona tu género.</h3>";
        return;
    }

    // Validar preferencias
    if (!isset($_POST['Aficiones'])) {
        echo "<h3>Por favor, selecciona al menos una afición.</h3>";
        return;
    }

    // Validar comentarios
    $opinion = trim($_POST['Opinion'] ?? '');
    if ($opinion === '') {
        echo "<h3>Por favor, escribe tu opinión sobre el servicio.</h3>";
        return;
    }

    // Procesar datos
    $genero = $_POST['Genero'];
    $aficiones = $_POST['Aficiones'];
    $palabras = array_filter(explode(" ", $opinion)); // Quitar palabras vacías
    $cantidadPalabras = count($palabras);
    $palabrasLargas = array_filter($palabras, fn($palabra) => strlen($palabra) >= 5);

    // Mostrar resultados
    echo "<h3>Resultados de la encuesta:</h3>";
    echo "<strong>Género:</strong> $genero<br>";
    echo "<strong>Aficiones seleccionadas:</strong> " . implode(", ", $aficiones) . "<br>";
    echo "<strong>Comentarios:</strong> $opinion<br>";
    echo "<strong>Cantidad de palabras:</strong> $cantidadPalabras<br>";
    echo "<strong>Palabras largas (5+ letras):</strong> " . implode(", ", $palabrasLargas) . "<br>";
}
?>



