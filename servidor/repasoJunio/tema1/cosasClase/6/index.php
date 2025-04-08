<?php

function sigDia($inicio)
{
    $sigDia = $inicio + (86400 + 1); //86400 segundos en un día
    return $sigDia;
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
        <input type="text" name="diaInicio" placeholder="dia (1-31) inicial">
        <input type="text" name="mesInicio" placeholder="mes (1-12) inicial">
        <input type="text" name="yearInicio" placeholder="yyyy inicial">
        <input type="text" name="diaFin" placeholder="dia (1-31) final">
        <input type="text" name="mesFin" placeholder="mes (1-12) final">
        <input type="text" name="yearFin" placeholder="yyyy final">
        <input type="submit" value="Enviar" name="enviar">

        <table>

            <tbody>
                <?php
                if (isset($_POST['enviar'])) {
                    $dia = $_POST['diaInicio'];
                    $mes = $_POST['mesInicio'];
                    $year = $_POST['yearInicio'];
                    $diaFin = $_POST['diaFin'];
                    $mesFin = $_POST['mesFin'];
                    $yearFin = $_POST['yearFin'];

                    if ($mes < 1 || $mes > 12) {
                        echo "El mes debe estar entre 1 y 12.";
                        exit;
                    }


                    $inicio = mktime(0, 0, 0, $mes, $dia, $year);
                    $fin = mktime(0, 0, 0, $mesFin, $diaFin, $yearFin);


                    if ($inicio > $fin) {
                        echo "La fecha de inicio no puede ser mayor que la fecha de fin.";
                        exit;
                    }

                    $diasLaborables = 0;
                    while ($inicio <= $fin) {
                        $campos = getdate($inicio);
                        $diaSemana = $campos['wday'];
                        if ($diaSemana != 0 && $diaSemana != 6) { // Si no es domingo (0) o sábado (6)
                            $diasLaborables++;
                        }
                        $inicio = sigDia($inicio);
                    }
                    echo "<br>El número de días laborables entre las fechas es: $diasLaborables.";
                }


                ?>
            </tbody>
        </table>
    </form>
</body>

</html>