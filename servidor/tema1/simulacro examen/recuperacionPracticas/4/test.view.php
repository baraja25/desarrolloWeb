<!doctype html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Prueba del primer ejercicio del tema 2</title>
</head>
<body>
<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
    <table border="2">
        <tr>
            <th>Seleccionar</th>
            <th>ID</th>
            <th>Archivo</th>
        </tr>

    <?php
        foreach ($archivos as $id => $nombre) {
            $checked = isset($seleccionados[$id]) ? 'checked' : '';
            echo "<tr>";
            echo "<td><input type='checkbox' name='seleccionado[$id]' value='$nombre' $checked></td>";
            echo "<td>$id</td>";
            echo "<td>$nombre</td>";
            echo "</tr>";
        }
     ?>
    </table>

    <input type="submit" value="Mostrar repeticiones" name="mostrar">
</form>
<?php if (!empty($tablas)): ?>
    <h2>Resultados:</h2>
    <?php foreach ($tablas as $archivo => $frecuencias): ?>
        <h3>Archivo: <?= $archivo ?></h3>
        <table border="2">
            <thead>
            <tr>
                <th>
                    <a href="<?= $_SERVER['PHP_SELF'] ?>?orden=alfabetico&<?= generarParametros($seleccionados) ?>">Palabras</a>
                </th>
                <th>
                    <a href="<?= $_SERVER['PHP_SELF'] ?>?orden=repeticiones&<?= generarParametros($seleccionados) ?>">Repeticiones</a>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($frecuencias as $palabra => $repeticiones): ?>
                <tr>
                    <td><?= $palabra ?></td>
                    <td><?= $repeticiones ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endforeach; ?>
<?php endif; ?>

</body>
</html>