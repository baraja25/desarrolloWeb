<?php
require_once 'pedidoDao.php';
require_once 'detallePedidoDao.php';

if (isset($_GET['cod'])) {
    $codPedido = $_GET['cod'];

    $detallePedidoDao = new detallePedidoDao();
    $detalles = $detallePedidoDao->listarDetallesPorPedido($codPedido);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Pedido</title>
</head>
<body>
    <?php if (isset($detalles)): ?>
        <h2>Detalles del Pedido <?php echo $codPedido; ?></h2>
        <table border="1">
            <tr>
                <th>Id Pedido</th>
                <th>Nombre Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Subtotal</th>
            </tr>
            <?php $total = 0; ?>
            <?php foreach ($detalles as $detalle): ?>
                <tr>
                    <td><?php echo $detalle->__get('IdPed'); ?></td>
                    <td><?php echo $detalle->__get('NombreProducto'); ?></td>
                    <td><?php echo $detalle->__get('Cantidad'); ?></td>
                    <td><?php echo $detalle->__get('Precio'); ?></td>
                    <td><?php echo $detalle->__get('Cantidad') * $detalle->__get('Precio'); ?></td>
                </tr>
                <?php $total += $detalle->__get('Cantidad') * $detalle->__get('Precio'); ?>
            <?php endforeach; ?>
            <tr>
                <td colspan="4">Total</td>
                <td><?php echo $total; ?></td>
            </tr>
        </table>
    <?php endif; ?>
</body>
</html>