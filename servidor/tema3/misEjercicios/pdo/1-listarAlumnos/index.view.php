<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Alumnos</title>
</head>

<body>
    <form method="post" enctype="multipart/form-data">
    <table border="1">
        <tr>
            <th>Nombre</th>
            <th>Fecha de nacimiento</th>
            <th>Foto</th>
        </tr>
        <?php foreach ($alumnos as $alumno): ?>
            <?php 
            $epoch = $alumno['FechaNac'];
            $fecha = date('d-m-Y', $epoch); 
            $blob = $alumno['Foto'];
            $foto = '<img src="data:image/jpeg;base64,' . base64_encode($blob) . '" width="100" height="100">';

            ?>
            <tr>
                <td><?php echo $alumno['Nombre']; ?></td>
                <td><?php echo $fecha; ?></td>
                <td><?php echo $foto ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    </form>
    
</body>

</html>