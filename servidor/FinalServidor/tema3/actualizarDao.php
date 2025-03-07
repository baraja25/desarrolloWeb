<?php
require_once 'EquipoDao.php';

$equipoDao = new equipoDao();
$equipoDao->listar();



$currentIndex = isset($_GET['index']) ? (int)$_GET['index'] : 1;

$equipos = $equipoDao->equipos;


$equipo = $equipoDao->getequipo($currentIndex);



$firstIndex = 1;
$lastIndex = count($equipoDao->equipos);

$previousIndex = max($currentIndex - 1, $firstIndex);
$nextIndex = min($currentIndex + 1, $lastIndex);


// Deberia actualizar pero da error de sintaxis de sql pero literalmente he copiado y pegado de otro ejercicio que si funciona asique no se donde esta el error
if (isset($_POST['actualizar'])) {

    $nombre = $_POST['nombreInput'];
    $fechaFundacion = strtotime($_POST['fechaInput']);
    $presupuesto = $_POST['presupuestoInput'];
    $puesto = $_POST['puestoInput'];

    if (isset($_FILES['fotoInput']) && $_FILES['fotoInput']['error'] === UPLOAD_ERR_OK) {
        $foto = base64_encode(file_get_contents($_FILES['fotoInput']['tmp_name']));
    } else {
        $foto = $equipo->__get('Foto');
    }

    $equipo = new Equipo();
    //$equipo->__set('id', $equipo->__get('id'));
    $equipo->__set('nombre', $nombre);
    $equipo->__set('fecha_fundacion', $fechaFundacion);
    $equipo->__set('presupuesto', $presupuesto);
    $equipo->__set('puesto', $puesto);
    $equipo->__set('logo', $foto);

    $equipoDao->actualizar($equipo);
}

// He comentado la logica del select para no romper nada
//$equipoElegido = 0;

// if (isset($_POST['mostrar'])) {
// $equipoElegido = $_POST['mostrarEquipo'];
// $showTeams = true;
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paginar Dao</title>
</head>

<body>
    <!-- He comentado este formulario porque deja de funcionar el secundario y no soy capaz de ver el error -->
    <!-- <form action="</?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="selectForm">
    <label for="equipos">Equipo:</label>
    <select name="mostrarEquipo" id="equipos">
        <option value=""></option>
        </?php foreach ($equipos as $equipo) : ?>
            <option value="</?php echo $equipo->__get('puesto') ?>" </?php
if ($equipoElegido == $equipo->__get('puesto')) {
    echo " selected";
    }
    ?>
    ></?php echo $equipo->__get('nombre') ?></option>
        </?php endforeach; ?>
    </select>
    <input type="submit" value="Mostrar" name="mostrar">
</form> -->
    <?php if ($equipo): ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            Nombre:<br>
            <input type="text" name="nombreInput" value="<?php echo $equipo->__get('nombre') ?>"><br>
            Fecha de fundacion:<br>
            <input type="text" name="fechaInput" value="<?php echo date("Y-m-d", $equipo->__get('fecha_fundacion')) ?>"><br>
            Presupuesto:<br>
            <input type="text" name="presupuestoInput" value="<?php echo $equipo->__get('presupuesto') ?>"><br>
            Puesto:<br>
            <input type="text" name="puestoInput" value="<?php echo $equipo->__get('puesto') ?>"><br>
            Logo: <br>
            <?php $foto = $equipo->__get('logo'); ?>
            <?php if ($foto): ?>
                <img src="data:image/png;base64,<?php echo $foto; ?>" alt="equipo" width="100" height="100">
            <?php else: ?>
                No Image
            <?php endif; ?>
            <br>
            <input type="file" name="fotoInput">


            <br><br>
            <input type="submit" value="Guardar" name="actualizar">
        </form>
        <div>
            <a href="?index=<?php echo $firstIndex; ?>">
                << </a>
                    <a href="?index=<?php echo $previousIndex; ?>">
                        < </a>
                            <a href="?index=<?php echo $nextIndex; ?>">></a>
                            <a href="?index=<?php echo $lastIndex; ?>">>></a>
        </div>
    <?php else: ?>
        <p>No hay equipos disponibles.</p>
    <?php endif; ?>
</body>

</html>