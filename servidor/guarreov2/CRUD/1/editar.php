<?php
require_once 'equipoDao.php';
$equipoDao = new EquipoDao();
$equipoDao->listarEquipos();



if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $equipo = $equipoDao->equipos[$id];

}

if (isset($_POST['editar']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $equipo = $equipoDao->equipos[$id];
    $nombre = $_POST['Nombre'];
    $puesto = $_POST['Puesto'];
    $presupuesto = $_POST['Presupuesto'];
    $fechaFund = strtotime($_POST['FechaFund']);
    $logo = isset($_FILES['Logo']['tmp_name']) && !empty($_FILES['Logo']['tmp_name']) ? base64_encode(file_get_contents($_FILES['Logo']['tmp_name'])) : "";
    // Crear objeto Equipo con los datos actualizados
    $equipoActualizado = new Equipo();
    $equipoActualizado->__set('id', $id);
    $equipoActualizado->__set('nombre', $nombre);
    $equipoActualizado->__set('fecha_fundacion', $fechaFund); // Ya está en formato Y-m-d
    $equipoActualizado->__set('presupuesto', $presupuesto);
    $equipoActualizado->__set('puesto', $puesto);
    $equipoActualizado->__set('logo', $logo); // Si está vacío, el método actualizar() mantendrá el logo actual
    
    // Actualizar el equipo en la base de datos
    $equipoDao->actualizar($equipoActualizado);

    header('Location: editar.php?id=' . $id . '&actualizado=true');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
</head>

<body>
    <form name="f1" action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $id; ?>" method="POST" enctype="multipart/form-data">
    <?php if (isset($_GET['actualizado']) && $_GET['actualizado'] == 'true'): ?>
    <div style="background-color: #dff0d8; color: #3c763d; padding: 15px; margin-bottom: 20px; border-radius: 4px;">
        ¡El equipo se ha actualizado correctamente!
    </div>
<?php endif; ?>
    <table border="1">
        <tr>
            <td>Nombre</td>
            <td>Puesto</td>
            <td>Presupuesto</td>
            <td>Fecha Fundación</td>
            <td>Logo</td>
        </tr>
        <tr>
            <td><input type="text" name="Nombre" value="<?php echo $equipo->__get('nombre'); ?>" required></td>
            <td><input type="text" name="Puesto" value="<?php echo $equipo->__get('puesto'); ?>" required></td>
            <td><input type="text" name="Presupuesto" value="<?php echo $equipo->__get('presupuesto'); ?>" required></td>
            <td><input type="date" name="FechaFund" value="<?php echo date('Y-m-d', $equipo->__get('fecha_fundacion')); ?>" required></td>
            <td>
                <img src="data:image/png;base64,<?php echo $equipo->__get('logo'); ?>" width="100" height="100">
                <input type="file" name="Logo">
            </td>
        </tr>
    </table>
    <input type="submit" name="editar" value="Editar">
        <input type="button" value="Volver" onclick="window.location.href='crud.php'">
    </form>
</body>

</html>

