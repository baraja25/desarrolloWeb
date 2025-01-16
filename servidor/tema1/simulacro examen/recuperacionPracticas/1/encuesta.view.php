<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Encuesta</title>
</head>
<body>
<form action="<?php echo $_SERVER["PHP_SELF"] ?>">

    <input type="radio" name="Genero" id="Genero" value="Masculino">
    <label for="Genero">Masculino</label>
    <input type="radio" name="Genero" id="Genero" value="Femenino">
    <label for="Genero">Femenino</label>
    <input type="radio" name="Genero" id="Genero" value="No especificar">
    <label for="Genero">No especificar</label>
</form>
</body>
</html>
