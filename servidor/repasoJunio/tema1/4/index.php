<?php
//Obtener desde la URL el año y el mes o usar el mes actual si no se especifica
$year = isset($_GET['year']) ? $_GET['year'] : (int)date('Y');
$mes = isset($_GET['mes']) ? $_GET['mes'] : (int)date('n');

if ($mes < 1 || $mes > 12) {
    $mes = (int)date('n'); // Si el mes no es válido, se establece el mes actual
}

if ($year < 1900 || $year > 2100) {
    $year = (int)date('Y'); // Si el año no es válido, se establece el año actual
}


$diasMes = cal_days_in_month(CAL_GREGORIAN, $mes, $year); // Obtener el número de días del mes
$nombreMes = date('F', mktime(0, 0, 0, $mes, 1, $year)); // Obtener el nombre del mes

// array con los nombres de los días de la semana
$diasSemana = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Dia del mes</th>
                <th>Dia de la semana</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $currentDay = (int)date('j'); // Inicializar el día actual
            $currentMonth = (int)date('n'); // Inicializar el mes actual
            $currentYear = (int)date('Y'); // Inicializar el año actual
            for ($i = 1; $i <= $diasMes; $i++) {
                // Obtener el día de la semana para el día actual
                $diaSemana = date('w', mktime(0, 0, 0, $mes, $i, $year));
                // Comprobar si el día es hoy
                if ($currentDay == $i && $currentMonth == $mes && $currentYear == $year) {
                    echo "<tr style='background-color: yellow;'>"; // Resaltar el día actual
                } else {
                    echo "<tr>";
                }
                echo "<td>$i</td>";
                echo "<td>{$diasSemana[$diaSemana]}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
    <label for="year">Introduce año: </label>
    <input type="text" name="year" id="year">    
    <label for="mes">Introduce mes (1-12): </label>
    <input type="text" name="mes" id="mes">
    
    <input type="submit" value="Ver calendario" name="enviar">
    </form>
</body>
</html>