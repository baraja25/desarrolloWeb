<?php

function sigDia($inicio)
{
    $sigDia = $inicio + (86400 + 1); //86400 segundos en un día
    return $sigDia;
}


function diasMes($mes, $year)
{
    $mesInicio = $mes;
    $contadorDias = 0;
    $inicio = mktime(0, 0, 0, $mes, 1, $year);

    while ($mes == $mesInicio) {
        
        $contadorDias++;
        $inicio = sigDia($inicio);

        $campos = getdate($inicio);
        $mes = $campos['mon'];
    }
    return $contadorDias; 
}


if (isset($_POST['enviar'])) {
    $mes = $_POST['mes'];
    $year = $_POST['year'];

    $dias = diasMes($mes, $year);
    //$dias = cal_days_in_month(CAL_GREGORIAN, $mes, $year);
    echo "El mes $mes del año $year tiene $dias días.";
} else {
    echo "Introduce un mes y un año.";
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4 clase</title>
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="text" name="mes" placeholder="mes (1-12)">
        <input type="text" name="year" placeholder="yyyy">

        <input type="submit" value="Enviar" name="enviar">
    </form>
</body>

</html>