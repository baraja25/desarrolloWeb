<html>

<?php
date_default_timezone_set('UTC'); // Aseguramos que use UTC
require_once "EquipoDao.php";
$equipoDao = new EquipoDao();
$equipoDao->listar();

$selec = array();


//Inserta nuevos datos a la db
if (isset($_POST['Insertar'])) {
    $Nombre = $_POST['Nombre'] ? $_POST['Nombre'] : "";
    $fechaFund = strtotime($_POST['fechafund']);
    $presupuesto = $_POST['presupuesto'] ? $_POST['presupuesto'] : "";
    $puesto = $_POST['puesto'] ? $_POST['puesto'] : "";


    $equipo = new Equipo();
    $equipo->__set('Nombre', $Nombre);
    $equipo->__set('FechaFund', $fechaFund);
    $equipo->__set('Puesto', $puesto);


    $equipoDao->insertar($equipo);
}

if (isset($_POST['Actualizar']) && (isset($_POST['Selec']))) {

    $selec = $_POST['Selec'];

    $Nombre = $_POST['Nombre'] ? $_POST['Nombre'] : $equipo->__get('Nombre');
    $fechaFund = strtotime($_POST['FechaFund']);
    $presupuesto = $_POST['Presupuesto'];
    $puesto = $_POST['Puesto'];
    $Logo = $_POST['Logo'];

    if (isset($_FILES['fotoInput']) && $_FILES['fotoInput']['error'] === UPLOAD_ERR_OK) {
        $foto = file_get_contents($_FILES['fotoInput']['tmp_name']);
    } else {
        //$foto = $equipo->__get('Logo');
    }
}

if (isset($_POST['Borrar']) && (isset($_POST['Selec']))) {
    $selec = $_POST['Selec'];

    foreach ($selec as $clave->$valor) {
        $equipoDao->borrar($clave);
    }
}

if (isset($_POST['Subir']) && (isset($_POST['Selec']))) {
    $selec = $_POST['Selec'];
    $primeraClave = array_key_first($selec);
    $equipo = $equipoDao->equipos[$primeraClave];
    $equipoDao->subir($equipo->__get('Id'), $equipo->__get('Puesto'));
}




?>

<body>
    <fieldset>
        <form name="f1" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <input type='submit' name='Actualizar' value='Actualizar'>
            <input type='submit' name='Borrar' value='Borrar'>
            <input type='submit' name='Insertar' value='Insertar'>
            <input type="submit" name="Subir" value="Subir">
            <input type="submit" name="Bajar" value="Bajar">
            <table border='2'>
                <thead>
                    <tr>
                        <th>Selec</th>
                        <th>Nombre</th>
                        <th>FechaFund</th>
                        <th>Presupuesto</th>
                        <th>Puesto</th>
                        <th>Logo</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($equipoDao->equipos as $equipo) : ?>
                        <tr>
                            <td><input type='checkbox' name='Selec[<?php echo $equipo->__get('Id') ?>]'></td>
                            <td><input type='text' name='Nombre' value="<?php echo $equipo->__get('Nombre') ?>"></td>
                            <td><input type="text" name="fechafund" value="<?php echo date('d-m-Y', $equipo->__get('FechaFund'))  ?>"></td>
                            <td><input type="number" name="presupuesto" value="<?php echo $equipo->__get('Presupuesto') ?>"></td>
                            <td><input type="number" name="puesto" value="<?php echo $equipo->__get('Puesto') ?>"></td>
                            <td>
                                <img src="data:image/png;base64,<?php echo $equipo->__get('Logo'); ?>" alt="Logo" width="100" height="100">
                                <input type='file' name='fotoInput' value="Seleecionar">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td><b>+</b></td>
                        <td><input type='text' name='Nombre'></td>
                        <td><input type="text" name="fechafund"></td>
                        <td><input type="number" name="presupuesto"></td>
                        <td><input type="number" name="puesto"></td>
                        <td><input type='file' name='Logo'></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </fieldset>
</body>

</html>