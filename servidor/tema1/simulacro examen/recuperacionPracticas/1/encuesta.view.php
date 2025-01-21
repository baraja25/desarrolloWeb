<!DOCTYPE html>
<html>
<head>
    <title>Encuesta</title>
</head>
<body>
<h2>Encuesta de Satisfacción</h2>
<form method="POST" action=" <?php echo $_SERVER["PHP_SELF"] ?>" name="f1">
    <!-- Pregunta de género -->
    <h3>Selecciona tu género:</h3>
    <label><input type="radio" name="Genero" value="Masculino" checked> Masculino</label><br>
    <label><input type="radio" name="Genero" value="Femenino"> Femenino</label><br>
    <label><input type="radio" name="Genero" value="No especificar"> No especificar</label><br>

    <!-- Comentarios -->
    <h3>¿Qué opinas sobre el servicio?</h3>
    <textarea name="Opinion" rows="4" cols="50" placeholder="Escribe tu opinión aquí..."></textarea><br>

    <!-- Preferencias -->
    <h3>¿Cuáles son tus aficiones?</h3>
    <label><input type="checkbox" name="Aficiones[]" value="Leer"> Leer</label><br>
    <label><input type="checkbox" name="Aficiones[]" value="Deportes"> Deportes</label><br>
    <label><input type="checkbox" name="Aficiones[]" value="Viajar"> Viajar</label><br>

    <!-- Botón enviar -->
    <button type="submit" name="enviar">Enviar Encuesta</button>
    <?php
    require "encuesta.php";
    ?>
</form>
</body>
</html>
