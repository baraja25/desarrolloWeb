<?php
require_once 'equipoDao.php';
$daoEqui = new equipoDao();
$daoEqui->listar();


if (isset($_POST['Insertar'])) {
    $equipo = new Equipo();
    $equipo->__set('nombre', $_POST['nombreNew']);
    $equipo->__set('fecha_fundacion', strtotime($_POST['fechaNew']));
    $equipo->__set('presupuesto', $_POST['presupuestoNew']);
    $equipo->__set('puesto', $_POST['puestoNew']);
    if ($_FILES['logoNew']['name'] != "") {
        $equipo->__set('logo', file_get_contents($_FILES['logoNew']['tmp_name']));
    }

    $daoEqui->insertar($equipo);
}

if (isset($_POST['Actualizar']) && (isset($_POST['Selec']))) {
    $selec = $_POST['Selec'];

    foreach ($selec as $clave => $valor) {
        $equipo = new Equipo();
        $equipo->__set('id', $clave);
        $equipo->__set('nombre', $_POST['nombres'][$clave]);
        $equipo->__set('fecha_fundacion', strtotime($_POST['fechaFundaciones'][$clave]));
        $equipo->__set('presupuesto', $_POST['presupuestos'][$clave]);
        $equipo->__set('puesto', $daoEqui->equipos[$clave]->__get('puesto'));
        $equipo->__set('logo', file_get_contents($_FILES['logos'][$clave]['tmp_name']));

        $daoEqui->actualizar($equipo);
    }
}

if (isset($_POST['Borrar']) && (isset($_POST['Selec']))) {
    $selec = $_POST['Selec'];

    foreach ($selec as $clave => $valor) {
        $daoEqui->borrar($clave);
    }
}


if (isset($_POST['Subir']) && (isset($_POST['Selec']))) {
    $selec = $_POST['Selec'];

    if (count($selec) == 1) {
        $clave = key($selec);

        $daoEqui->subir($clave);
    } else {
        echo "<B>Debe seleccionar un único equipo para subir</B>";
    }
}  
    
if (isset($_POST['Bajar']) && (isset($_POST['Selec']))) {
    $selec = $_POST['Selec'];

    if (count($selec) == 1) {
        $clave = key($selec);

        $daoEqui->bajar($clave);
    } else {
        echo "<B>Debe seleccionar un único equipo para bajar</B>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipos</title>
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
        <input type="submit" value="Insertar" name="Insertar">
        <input type="submit" value="Actualizar" name="Actualizar">
        <input type="submit" value="Borrar" name="Borrar">
        <input type="submit" value="Subir" name="Subir">
        <input type="submit" value="Bajar" name="Bajar">
    <table border="1">
        <tr>
            <th>Seleccionar</th>
            <th>Nombre</th>
            <th>Fecha de Fundación</th>
            <th>Presupuesto</th>
            <th>Puesto</th>
            <th>Logo</th>
        </tr>
        <tr>
            <td>+</td>
            <td><input type="text" name="nombreNew"></td>
            <td><input type="date" name="fechaNew"></td>
            <td><input type="number" name="presupuestoNew"></td>
            <td><input type="number" name="puestoNew"></td>
            <td>
                <input type="file" name="logoNew">
            </td>
        </tr>
        <?php
        foreach ($daoEqui->equipos as $equipo) {
            echo "<tr>";
            echo "<td><input type='checkbox' name='Selec[" . $equipo->__get('id') . "]'></td>";
            echo "<td><input type='text' name='nombres[" . $equipo->__get('id') ."]' value='" . $equipo->__get('nombre') . "'></td>";
            echo "<td><input type='date' name='fechaFundaciones[" . $equipo->__get('id') ."]' value='" . date("Y-m-d", $equipo->__get('fecha_fundacion')) . "'></td>";
            echo "<td><input type='number' name='presupuestos[" . $equipo->__get('id') . "]' value='" . $equipo->__get('presupuesto') . "'></td>";
            echo "<td>" . $equipo->__get('puesto') . "</td>";
            echo "<td><img src='data:image/jpg;base64," . $equipo->__get('logo') . "' width='100' height='100'>
            <input type='file' name='logos[" . $equipo->__get('id') . "]'></td>";
            echo "</tr>";
        }
        ?>
    </table>


    </form>
</body>

</html>