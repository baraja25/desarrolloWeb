<?php 
$aficiones = ["tenis", "futbol", "baloncesto"];
$genero = isset($_POST['genero']) ? $_POST['genero'] : "";
$textoArea = isset($_POST['textoArea']) ? $_POST['textoArea'] : "";
$aficion = isset($_POST['aficion']) ? $_POST['aficion'] : [];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intro 1</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="radio" name="genero" value=1> Masculino
        <input type="radio" name="genero" value=2> Femenino
        <input type="radio" name="genero" value=3> No especificar
        <br>
        
        <textarea name="textoArea">Escribe tu opinion</textarea>
        <br>
        <?php 

        foreach ($aficiones as $key => $value) {
            $checked = in_array($value, $aficion) ? 'checked' : '';
            echo "<input type='checkbox' name='aficion[]' value='$value' $checked> $value<br>";
        }
        
        
        ?>
        <input type="submit" value="Mostrar" name="mostrar">
        <br>
        <?php 
        if (isset($_POST['mostrar'])) {
            echo $genero;
            echo "<br>";
            echo $textoArea;
            echo "<br>";
            foreach ($aficion as $aficionString) {
                echo "<br>";
                echo $aficionString;
            }
        }
        
        ?>
    </form>
</body>
</html>