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
    <title>Ejercicio 4 v2</title>
</head>

<body>
    <form action="detalle.php" method="post" enctype="multipart/form-data">
        <table border="1">
            <tr>
                <th>Seleccionar</th>
                <th>Coches</th>
            </tr>
            <?php foreach ($dao->coches as $coche): ?>
                <tr>
                    <td>
                        <input type="checkbox" name="cocheSeleccionado[<?php echo $coche->__get('id') ?>]">
                    </td>
                    <td>
                        <img src="data:image/jpeg;base64,<?php echo $coche->__get('foto'); ?>" alt="Coche" width="100" height="100">
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <input type="submit" value="Ver Detalles">
    </form>
</body>

</html>