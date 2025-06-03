<?php

require_once 'DaoCoche.php';

$dao = new CochesDao();
$dao->listarCoches();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 v2</title>
</head>

<body>
    <table border="1">
        <tr>
            <th>Coches</th>
        </tr>
        <?php foreach ($dao->coches as $coche): ?>
            <tr>
                <td>
                    <a href="detalle.php?id=<?php echo $coche->__get('id') ?>"><img src="data:image/jpeg;base64,<?php echo $coche->__get('foto'); ?>" alt="Coche" width="100" height="100"></a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>