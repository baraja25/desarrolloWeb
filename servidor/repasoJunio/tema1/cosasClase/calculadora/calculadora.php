<?php

if (empty($_GET['num1']) || empty($_GET['num2'])) {
    echo "Introduce los números";
} elseif (!is_numeric($_GET['num1']) || !is_numeric($_GET['num2'])) {
    echo "Introduce números válidos";
    
} else {
    if (isset($_GET['sumar'])) {
        $resultado = $_GET['num1'] + $_GET['num2'];
    }
    
    if (isset($_GET['restar'])) {
        $resultado = $_GET['num1'] - $_GET['num2'];
    }
    
    if (isset($_GET['multiplicar'])) {
        $resultado = $_GET['num1'] * $_GET['num2'];
    }
    
    if (isset($_GET['dividir'])) {
    
        if ($_GET['num2'] == 0) {
            echo "No se puede dividir por 0";
            exit;
        }
    
        $resultado = $_GET['num1'] / $_GET['num2'];
    }
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
        <label for="num1">Número 1</label>
        <input type="number" name="num1" id="num1">
        <br>
        <label for="num2">Número 2</label>
        <input type="number" name="num2" id="num2">
        <br>
        <br>

        <input type="submit" value="Sumar" name="sumar">
        <input type="submit" value="Restar" name="restar">
        <input type="submit" value="Multiplicar" name="multiplicar">
        <input type="submit" value="Dividir" name="dividir">
        <br>
        <label for="resultado">Resultado</label>
        <input type="number" name="resultado" id="resultado" value="<?php echo $resultado; ?>" readonly>
        <br>
    </form>
</body>

</html>