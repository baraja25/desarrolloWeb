<?php
require_once 'DaoCoche.php';
$dao = new CochesDao();

$dao->listarCoches();
$selected = "";
if (isset($_POST['actualizarCoche'])) {

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $precio = $_POST['precio'];
    $anio = $_POST['anio'];
    $matricula = $_POST['matricula'];

    // Manejo de la foto
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $foto = file_get_contents($_FILES['foto']['tmp_name']);
        $foto = base64_encode($foto);
    } else {
        $foto = null; // O puedes mantener la foto actual si no se sube una nueva
    }

    // Actualizar el coche en la base de datos
    $dao->actualizarCoche($id, $nombre, $marca, $modelo, $precio, $anio, $matricula, $foto);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3 v2</title>
</head>

<body>
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">

        <select name="matriculaSeleccionada" id="matriculaSeleccionada">
            <option value="">Seleccione una matrícula</option>
            <?php
            foreach ($dao->coches as $coche) {
                echo "<option value='" . $coche->__get('matricula') . "'" . $selected . ">" . $coche->__get('matricula') . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="Seleccionar Coche" name="SeleccionarCoche">
        <br><br>
        <?php
        if (isset($_POST['SeleccionarCoche'])) {
            // Verificar si se ha seleccionado una matrícula
            $matriculaSeleccionada = $_POST['matriculaSeleccionada'] ?? '';
            foreach ($dao->coches as $coche) {
                if ($coche->__get('matricula') === $matriculaSeleccionada) {
                    $selected = "selected";
                    // Aquí podrías cargar los datos del coche seleccionado en un formulario para actualizar
                    // Por ejemplo, podrías mostrar un formulario con los datos del coche seleccionado
                    // y permitir al usuario actualizarlos.
                    echo "<h1>Actualizar coche con matrícula: " . $coche->__get('matricula') . "</h1>";
                    echo "<label for='id'>ID:</label>";
                    echo "<input type='text' name='id' id='id' value='" . $coche->__get('id') . "' readonly>";
                    echo "<br>";
                    echo "<label for='nombre'>Nombre:</label>";
                    echo "<input type='text' name='nombre' id='nombre' value='" . $coche->__get('nombre') . "'>";
                    echo "<br>";
                    echo "<label for='marca'>Marca:</label>";
                    echo "<input type='text' name='marca' id='marca' value='" . $coche->__get('marca') . "'>";
                    echo "<br>";
                    echo "<label for='modelo'>Modelo:</label>";
                    echo "<input type='text' name='modelo' id='modelo' value='" . $coche->__get('modelo') . "'>";
                    echo "<br>";
                    echo "<label for='precio'>Precio:</label>";
                    echo "<input type='number' name='precio' id='precio' value='" . $coche->__get('precio') . "'>";
                    echo "<br>";
                    echo "<label for='anio'>Año:</label>";
                    echo "<input type='number' name='anio' id='anio' value='" . $coche->__get('anio') . "'>";
                    echo "<br>";
                    echo "<label for='matricula'>Matrícula:</label>";
                    echo "<input type='text' name='matricula' id='matricula' value='" . $coche->__get('matricula') . "'>";
                    echo "<br>";
                    echo "<label for='foto'>Foto (opcional):</label>";
                    echo "<input type='file' name='foto' id='foto'>";
                    if ($coche->__get('foto')) {
                        echo "<br><img src='data:image/jpeg;base64," . $coche->__get('foto') . "' alt='Foto del coche' style='width: 100px; height: auto;'>";
                    }
                    echo "<br><br>";
                    echo "<input type='submit' value='Actualizar Coche' name='actualizarCoche'>";
                    break;
                } else {
                    $selected = "";
                }
            }
        }




        ?>

    </form>
</body>

</html>