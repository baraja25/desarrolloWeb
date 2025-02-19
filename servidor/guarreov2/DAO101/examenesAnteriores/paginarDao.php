<?php 
require_once 'ProductoDao.php';

$productoDao = new ProductoDao();
$productoDao->listar();

$currentIndex = isset($_GET['index']) ? (int)$_GET['index'] : 0;
$producto = $productoDao->getProducto($currentIndex);

$firstIndex = 0;
$lastIndex = count($productoDao->productos) - 1;
$previousIndex = max($currentIndex - 1, $firstIndex);
$nextIndex = min($currentIndex + 1, $lastIndex);
?>#f96900
#e06c75

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paginar Dao</title>
</head>
<body>
    <?php if ($producto): ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            <table border="1">
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>PVP</th>
                    <th>Familia</th>
                    <th>Foto</th>
                </tr>
                <tr>
                    <td><?php echo htmlspecialchars($producto->__get('cod')); ?></td>
                    <td><?php echo htmlspecialchars($producto->__get('nombre')); ?></td>
                    <td><?php echo htmlspecialchars($producto->__get('PVP')); ?></td>
                    <td><?php echo htmlspecialchars($producto->__get('familia')); ?></td>
                    <td>
                        <?php $foto = $producto->__get('Foto'); ?>
                        <?php if ($foto): ?>
                            <img src="data:image/png;base64,<?php echo $foto; ?>" alt="Producto" width="100" height="100">
                        <?php else: ?>
                            No Image
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </form>
        <div>
            <a href="?index=<?php echo $firstIndex; ?>"><<</a>
            <a href="?index=<?php echo $previousIndex; ?>"><</a>
            <a href="?index=<?php echo $nextIndex; ?>">></a>
            <a href="?index=<?php echo $lastIndex; ?>">>></a>
        </div>
    <?php else: ?>
        <p>No hay productos disponibles.</p>
    <?php endif; ?>
</body>
</html>