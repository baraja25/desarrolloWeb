<?php
function rellenarArray(&$numerosArray, $num)
{
    for ($i = 0; $i < $num; $i++) {
        $numerosArray[] = rand(0, 9);
    }
    return $numerosArray;
}

function mostrarArray($numerosArray)
{
    echo "[ ";
    foreach ($numerosArray as $numero) {
        echo "$numero ";
    }
    echo " ]";
}

if (isset($_POST['numeros'])) {
    $numeros = $_POST['numeros'];
    $numerosArray = explode(",", $numeros);
    sort($numerosArray);
    mostrarArray($numerosArray);
    // Actualizar $numeros con el array ordenado
    $numeros = implode(",", $numerosArray);
} else {
    $numerosArray = array();
    $numerosArray = rellenarArray($numerosArray, 10);
    mostrarArray($numerosArray);
    $numeros = implode(",", $numerosArray);
}

echo "<br>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3 clase</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="submit" value="Ordenar" name="ordenar">
        <input type="hidden" name="numeros" value="<?php echo $numeros ?>">
    </form>
</body>
</html>