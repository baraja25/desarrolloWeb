<?php 
$letras=array();

if (isset($_POST['enviar'])) {
    $frase = $_POST['frase'];
    
    for ($i = 0; $i < strlen($frase); $i++) {
        
        if (isset($letras[$frase[$i]])) {
            $letras[$frase[$i]]++;
        } else {
            $letras[$frase[$i]] = 1;
        
        }

    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 7 clase</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <textarea name="frase"></textarea>
        <br>
        <input type="submit" value="Enviar" name="enviar">
        <br>
        <table border="1" style="border-collapse: collapse;">
            <tr>
                <th>Caracter</th>
                <th>Repeticiones</th>
            </tr>
            <?php
            if (isset($_POST['enviar'])) {
                foreach ($letras as $key => $value) {
                    echo "<tr>";
                    echo "<td>" . $key . "</td>";
                    echo "<td>" . $value . "</td>";
                    echo "</tr>";
                }
            }
            ?>
    </form>
</body>
</html>