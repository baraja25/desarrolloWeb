<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mover datos</title>
</head>
<body>
<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
    <textarea name="input" cols="30" rows="10" placeholder="Introduce un texto..."></textarea>
    <input type="submit" value=">" name="moverDerecha">
    <textarea name="ouput"  cols="30" rows="10" placeholder="Salida de texto..."><?php $input ?></textarea>
</form>
</body>
</html>