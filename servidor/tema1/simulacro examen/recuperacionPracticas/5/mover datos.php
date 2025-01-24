<?php
$output = "";
$input = "";
if (isset($_POST['moverDerecha'])) {
    $input  = $_POST['input'];

}

if (isset($_POST['moverIzquierda'])) {
    $output  = $_POST['output'];
}

?>

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
    <textarea name="input" cols="30" rows="10" placeholder="Introduce un texto..."><?php echo $output ?></textarea>
    <input type="submit" value=">" name="moverDerecha">
    <input type="submit" value="<" name="moverIzquierda">
    <textarea name="output"  cols="30" rows="10" placeholder="Salida de texto..."><?php echo $input ?></textarea>
</form>
</body>
</html>