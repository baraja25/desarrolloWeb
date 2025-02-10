<html>
<?php

date_default_timezone_set('UTC'); // Aseguramos que use UTC

$host = "localhost";
$user = "root";
$pass = "";
$base = "tema3";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$base", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}

$consulta = "SELECT * FROM Alumnos";
$sta = $pdo->prepare($consulta);
$sta->execute();
$filas = $sta->fetchAll(PDO::FETCH_ASSOC);

?>

<body>
    <fieldset>
        <legend>Alta de Nuevo Alumno</legend>
        <form name='f1' method='post' action='Acciones.php' enctype='multipart/form-data'>
            <label for="NIF">NIF</label>
            <input type='text' name='NIF' id="NIF">
            <label for="Nombre">Nombre</label>
            <input type='text' name='Nombre' id="Nombre">
            <label for="Apellido1">Apellido1</label>
            <input type='text' name='Apellido1' id="Apellido1">
            <label for="Apellido2">Apellido2</label>
            <input type='text' name='Apellido2' id="Apellido2"><br>
            <label for="Telefono">Telefono</label>
            <input type='text' name='Telefono' id="Telefono">
            <label for="Premios">Premios</label>
            <input type='text' name='Premios' id="Premios">
            <label for="FechaNac">FechaNac</label>
            <input type='text' name='FechaNac' id="FechaNac"><br>
            <label for="Foto">Foto</label>
            <input type='file' name='Foto' id="Foto"><br>
            <input type='submit' name='Alta' value='Alta'>
        </form>
    </fieldset>

    <fieldset>
        <table border='2'>
            <thead>
                <tr>
                    <th>NIF</th>
                    <th>Nombre</th>
                    <th>Apellido1</th>
                    <th>Apellido2</th>
                    <th>Telefono</th>
                    <th>Premio</th>
                    <th>Fecha Nac</th>
                    <th>Foto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($filas as $fila): ?>
                    <tr>
                        <?php foreach ($fila as $clave => $valor): ?>
                            <?php if ($clave == "FechaNac"): ?>
                                <?php
                                $campos = getdate($valor);
                                $valor = $campos['mday'] . "/" . $campos['mon'] . "/" . $campos['year'];
                                ?>
                                <td><?= $valor ?></td>
                            <?php elseif ($clave == "Foto"): ?>
                                <?php $imagenConte = $fila['Foto']; ?>
                                <td><img src='data:image/jpg;base64,<?= $imagenConte ?>' width='80' height='80'></td>
                            <?php else: ?>
                                <td><?= $valor ?></td>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <td>
                            <form name='f<?= $fila['NIF'] ?>' method='post' action='Acciones.php' enctype='multipart/form-data'>
                                <input type='submit' name='Actualizar' value='Actualizar'>
                                <input type='submit' name='Borrar' value='Borrar'>
                                <input type='hidden' name='NIF' value='<?= $fila['NIF'] ?>'>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </fieldset>
</body>
</html>