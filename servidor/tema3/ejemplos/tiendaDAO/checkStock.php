[file name]: stock.php
[file content begin]
<?php
require_once 'DaoTiendas.php';
require_once 'DaoFamilias.php';
require_once 'DaoProductos.php'; // Nueva clase necesaria

$base = "tienda";
$daoTiendas = new DaoTiendas($base);
$daoFamilias = new DaoFamilias($base);
$daoProductos = new DaoProductos($base); // Instancia del nuevo DAO

$resultados = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["comprobar"])) {
    $codTienda = $_POST["tienda"] ?? '';
    $codFamilia = $_POST["familia"] ?? '';
    
    if (!empty($codTienda) && !empty($codFamilia)) {
        $resultados = $daoProductos->obtenerStock($codTienda, $codFamilia);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock</title>
    <style>
        table { border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 8px; border: 1px solid #ddd; }
    </style>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="tienda">Tienda </label>
        <select name='tienda' id="tienda" required>
            <option value=''></option>
            <?php
            $daoTiendas->listar();
            foreach($daoTiendas->tiendas as $tienda) {
                $selected = ($_POST['tienda'] ?? '') == $tienda->cod ? 'selected' : '';
                echo "<option value='".$tienda->cod."' $selected>".$tienda->nombre."</option>";
            }
            ?>
        </select>

        <label for="familia">Familia </label>
        <select name='familia' id="familia" required>
            <option value=''></option>
            <?php
            $daoFamilias->listar();
            foreach($daoFamilias->familias as $familia) {
                $selected = ($_POST['familia'] ?? '') == $familia->cod ? 'selected' : '';
                echo "<option value='".$familia->cod."' $selected>".$familia->nombre."</option>";
            }
            ?>
        </select>
        <input type="submit" value="Comprobar stock" name="comprobar">
    </form>

    <?php if (!empty($resultados)): ?>
        <h3>Resultados del stock:</h3>
        <table>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
            </tr>
            <?php foreach ($resultados as $producto): ?>
                <tr>
                    <td><?php echo $producto['nombre']; ?></td>
                    <td><?php echo $producto['stock']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <p>No se encontraron resultados para los criterios seleccionados.</p>
    <?php endif; ?>
</body>
</html>
[file content end]