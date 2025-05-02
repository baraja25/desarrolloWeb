<?php
require_once 'Database.php';

$database = new Database();
$coches = [];
$cochesSeleccionados = isset($_POST['cochesSeleccionados']) ? $_POST['cochesSeleccionados'] : [];

// Obtener todos los coches de la base de datos
// y codificar la imagen en base64 para su visualización
$coches = $database->query("SELECT id, foto FROM coche")->fetchAll(PDO::FETCH_ASSOC);
foreach ($coches as $key => $value) {
    $coches[$key]['foto'] = base64_encode($coches[$key]['foto']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 listar imagenes</title>
</head>

<body>
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">
        <table border="1" style="width:20%;">
            <caption>Lista de vehiculos</caption>
            <thead>
                <tr>
                    <th>Seleccionar</th>
                    <th>Foto</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($coches as $coche): ?>
                    <tr>
                        <td><input type="checkbox" name="cochesSeleccionados[<?php echo $coche['id'] ?>]"></td>
                        <td><img src="data:image/jpeg;base64,<?php echo $coche['foto']; ?>" alt="Foto de coche" style="width:100px;height:auto;"></td>
                    </tr>
                <?php endforeach; ?>
        </table>
        <input type="submit" value="Enviar" name="enviar">
    </form>
    <?php
    // Si se han seleccionado coches, mostrar sus detalles
    // y la imagen correspondiente
    if (isset($_POST['enviar'])) {
        foreach ($cochesSeleccionados as $id => $valor) {
            $coche = $database->query("SELECT * FROM coche WHERE id = :id", [':id' => $id])->fetch(PDO::FETCH_ASSOC);
            if ($coche) {
                echo "<h2>Detalles del coche seleccionado:</h2>";
                echo "ID: " . $coche['id'] . "<br>";
                echo "Nombre: " . $coche['nombre'] . "<br>";
                echo "Marca: " . $coche['marca'] . "<br>";
                echo "Modelo: " . $coche['modelo'] . "<br>";
                echo "Precio: " . $coche['precio'] . "<br>";
                echo "Matricula: " . $coche['matricula'] . "<br>";
                echo "Año: " . $coche['anio'] . "<br>";
                echo '<img src="data:image/jpeg;base64,' . base64_encode($coche['foto']) . '" alt="Foto de coche" style="width:100px;height:auto;">';
            }
        }
    }


    ?>
</body>

</html>