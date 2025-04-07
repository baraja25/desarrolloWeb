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


// if (isset($_POST['enviar'])) {
//     $mes = $_POST['mes'];
//     $year = $_POST['year'];

//     $dias = diasMes($mes, $year);
//     //$dias = cal_days_in_month(CAL_GREGORIAN, $mes, $year);
//     echo "El mes $mes del año $year tiene $dias días.";
// } else {
//     echo "Introduce un mes y un año.";
// }


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

        <table>
            <thead>
                <tr>
                    <th>Lunes</th>
                    <th>Martes</th>
                    <th>Miercoles</th>
                    <th>Jueves</th>
                    <th>Viernes</th>
                    <th>Sabado</th>
                    <th>Domingo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_POST['enviar'])) {
                    $mes = $_POST['mes'];
                    $year = $_POST['year'];

                    $dias = diasMes($mes, $year);
                    $inicio = mktime(0, 0, 0, $mes, 1, $year);
                    $campos = getdate($inicio);
                    $diaSemana = ($campos['wday'] == 0) ? 6 : $campos['wday'] - 1; // Ajustar el día de la semana para que empiece en lunes
                    $contadorDias = 1;
                    for ($i = 0; $i < 6; $i++) {
                        echo "<tr>";
                        for ($j = 0; $j < 7; $j++) {
                            if ($i == 0 && $j < $diaSemana) {
                                echo "<td></td>";
                            } elseif ($contadorDias <= $dias) {
                                echo "<td>$contadorDias</td>";
                                $contadorDias++;
                            } else {
                                echo "<td></td>";
                            }
                        }
                        echo "</tr>";
                    }
                }

                ?>
            </tbody>
        </table>
    </form>
</body>

</html>