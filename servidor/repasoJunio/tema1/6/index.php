<?php
if (isset($_POST['calcular'])) {
    // Obtener las fechas del formulario
    $fecha1 = strtotime($_POST['fecha1']);
    $fecha2 = strtotime($_POST['fecha2']);
    // 172800 = 2 días
    // Asegurarse que la fecha1 sea mas antigua que la fecha2
    if ($fecha1 > $fecha2) {
        list($fecha1, $fecha2) = array($fecha2, $fecha1);
    }
    
    $dias_habiles = 0;

    for ($i = $fecha1; $i <= $fecha2; $i += 86400) {
        // obtener el da de la semana (0 = domingo 6 = sabado)
        $dia_semana = date('w', $i);

        if ($dia_semana > 0 && $dia_semana < 6) {
            // Si no es fin de semana, mostrar la fecha
            $dias_habiles++;
        }
    }

    // Mostrar el resultado
    echo "<h2>Días hábiles entre " . date('d-m-Y', $fecha1) . " y " . date('d-m-Y', $fecha2) . ": $dias_habiles</h2>";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="fecha1">Primera fecha: </label>
        <input type="text" name="fecha1" id="fecha1" placeholder="aaaammdd"><br><br>
        <label for="fecha2">Segunda fecha: </label>
        <input type="text" name="fecha2" id="fecha2" placeholder="aaaammdd"><br><br>
        <input type="submit" name="calcular" value="Calcular diferencia">

    </form>
</body>
</html>