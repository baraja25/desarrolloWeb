<?php 
require_once 'DaoCoche.php';
$dao = new CochesDao();
$dao->listarCoches();
$cochesEncontrados = [];

if (isset($_POST['buscarMarca']) || isset($_POST['buscarModelo']) || isset($_POST['buscarPrecioMaximo']) || isset($_POST['buscarPrecioMinimo'])) {
    $marca = $_POST['buscarMarca'] ?? '';
    $modelo = $_POST['buscarModelo'] ?? '';
    $precioMaximo = $_POST['buscarPrecioMaximo'] ?? PHP_INT_MAX;
    $precioMinimo = $_POST['buscarPrecioMinimo'] ?? 0;

    $cochesEncontrados = $dao->buscar($marca, $modelo, $precioMaximo, $precioMinimo);
    
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5 v2</title>
</head>
<body>
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">
        <label for="buscar">Buscar coche por marca:</label>
        <input type="text" name="buscarMarca" id="buscarMarca">
        <br>
        <label for="buscar">Buscar coche por modelo:</label>
        <input type="text" name="buscarModelo" id="buscarModelo">
        <br>
        <label for="buscar">Buscar coche por precio maximo:</label>
        <input type="number" name="buscarPrecioMaximo" id="buscarPrecioMaximo">
        <br>
        <label for="buscar">Buscar coche por precio minimo:</label>
        <input type="number" name="buscarPrecioMinimo" id="buscarPrecioMinimo">
        <br>
        <input type="submit" value="Buscar">
    </form>
    <?php if ($cochesEncontrados): ?>
        <h2>Coches encontrados:</h2>
        <table border="1">
            <tr>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Precio</th>
                <th>Año</th>
                <th>Matrícula</th>
                <th>Foto</th>
            </tr>
            <?php foreach ($cochesEncontrados as $coche): ?>
                <tr>
                    <td><?php echo $coche["nombre"] ?></td>
                    <td><?php echo $coche["marca"] ?></td>
                    <td><?php echo $coche["modelo"] ?></td>
                    <td><?php echo $coche["precio"] ?></td>
                    <td><?php echo $coche["anio"] ?></td>
                    <td><?php echo $coche["matricula"] ?></td>
                    <td><img src="data:image/jpeg;base64,<?php echo base64_encode($coche["foto"]) ?>" alt="Coche" width="100" height="100"></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>

</body>
</html>