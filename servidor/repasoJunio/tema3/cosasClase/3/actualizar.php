<?php
require_once("Cochedao.php");

$dao = new CocheDao();
$dao->listar();


$matriculas = array_map(function($coche) {
    return $coche->matricula;
}, $dao->coches);

$bandera = false;

// Variable para almacenar la matrícula seleccionada
$matriculaSeleccionada = '';

if (isset($_POST['seleccionar'])) {
    // Si se ha seleccionado una matrícula, obtenemos los datos del coche
    $matriculaSeleccionada = $_POST['matricula'];

    $cocheDetalle = $dao->coches[array_search($matriculaSeleccionada, $matriculas)];
    if ($cocheDetalle) {
        $cocheDetalle = [
            'id' => $cocheDetalle->id,
            'marca' => $cocheDetalle->marca,
            'modelo' => $cocheDetalle->modelo,
            'precio' => $cocheDetalle->precio,
            'matricula' => $cocheDetalle->matricula,
            'anio' => $cocheDetalle->anio,
            'foto' => $cocheDetalle->foto,
            'nombre' => $cocheDetalle->nombre
        ];
    } else {
        $cocheDetalle = null;
    }
    $bandera = true;
    
    // Codificamos la imagen para mostrarla
    if ($cocheDetalle && isset($cocheDetalle['foto'])) {
        $cocheDetalle['foto_base64'] = base64_encode($cocheDetalle['foto']);
    }
} elseif (isset($_POST['actualizar'])) {
    // Si se ha enviado el formulario de actualización
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $precio = $_POST['precio'];
    $matriculaEdit = $_POST['matriculaEdit'];
    $anio = $_POST['anio'];
    $matriculaSeleccionada = $_POST['matriculaOriginal']; // Obtenemos la matrícula original
    
    // Primero obtenemos el coche actual para recuperar la foto si es necesario
    $cocheArray = $dao->buscarCoche($matriculaSeleccionada); // esto es un array
    
    // Procesar la imagen
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK && $_FILES['foto']['size'] > 0) {
        $foto = file_get_contents($_FILES['foto']['tmp_name']);
    } else {
        // Si no se subió una nueva imagen, mantenemos la anterior
        $foto = $cocheDetalle['foto'];
    }

    // Actualizar los datos del coche en la base de datos
    $dao->actualizarCoche($coche);
    
    // Después de actualizar, obtenemos los datos actualizados
    $matriculaSeleccionada = $matriculaEdit; // Actualizamos a la nueva matrícula
   
    $bandera = true;
    
    if ($cocheDetalle && isset($cocheDetalle['foto'])) {
        $cocheDetalle['foto_base64'] = base64_encode($cocheDetalle['foto']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3 clase</title>
</head>
<body>
    <h1>Actualizar coche</h1>
    
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
        <label for="matricula">Seleccione una matrícula:</label>
        <select name="matricula" id="matricula">
            <option value="">-- Seleccione una matrícula --</option>
            <?php
            foreach ($matriculas as $matricula) {
                echo "<option value='$matricula'";
                if ($matriculaSeleccionada === $matricula) {
                    echo " selected";
                }
                echo ">$matricula</option>";
            }
            ?>
        </select>
        <input type="submit" value="Seleccionar" name="seleccionar">
    </form>

    <?php if ($bandera && $cocheDetalle): ?>
        <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">
            <h2>Datos del coche</h2>
            
            <!-- Campo oculto para mantener la matrícula original -->
            <input type="hidden" name="matriculaOriginal" value="<?php echo $cocheDetalle['matricula']; ?>">
            
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($cocheDetalle['nombre'] ?? ''); ?>" required>
<br>
            <label for="marca">Marca:</label>
            <input type="text" name="marca" id="marca" value="<?php echo htmlspecialchars($cocheDetalle['marca'] ?? ''); ?>" required>
<br>
            <label for="modelo">Modelo:</label>
            <input type="text" name="modelo" id="modelo" value="<?php echo htmlspecialchars($cocheDetalle['modelo'] ?? ''); ?>" required>
<br>
            <label for="precio">Precio:</label>
            <input type="number" step="0.01" name="precio" id="precio" value="<?php echo $cocheDetalle['precio'] ?? ''; ?>" required>
<br>
            <label for="matriculaEdit">Matrícula:</label>
            <input type="text" name="matriculaEdit" id="matriculaEdit" value="<?php echo htmlspecialchars($cocheDetalle['matricula'] ?? ''); ?>" required>
<br>
            <label for="anio">Año:</label>
            <input type="number" name="anio" id="anio" value="<?php echo $cocheDetalle['anio'] ?? ''; ?>" required>
<br>
            <label for="foto">Foto actual:</label>
            <?php if (isset($cocheDetalle['foto_base64'])): ?>
                <img src="data:image/jpeg;base64,<?php echo $cocheDetalle['foto_base64']; ?>" alt="Foto de coche" style="max-width:200px;height:auto;">
            <?php endif; ?>
<br>        
            <label for="foto">Cambiar foto (opcional):</label>
            <input type="file" name="foto" id="foto">
            <br><br>

            <input type="submit" value="Actualizar" name="actualizar">
        </form>
    <?php elseif (isset($_POST['seleccionar']) && empty($cocheDetalle)): ?>
        <p>No se encontró ningún coche con la matrícula seleccionada.</p>
    <?php endif; ?>
</body>
</html>