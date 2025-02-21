<?php
require_once 'pedidoDao.php';

if (isset($_POST['mostrar'])) {
    $fechaInicio = strtotime($_POST['fechaInicio']); // Convertir a formato Epoch
    $fechaFin = strtotime($_POST['fechaFin']); // Convertir a formato Epoch

    $pedidoDao = new pedidoDao();
    $pedidos = $pedidoDao->listarPedidosPorFechas($fechaInicio, $fechaFin);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rango de Fechas</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="fechaInicio">Fecha Inicio:</label>
        <input type="date" name="fechaInicio" required>
        <label for="fechaFin">Fecha Fin:</label>
        <input type="date" name="fechaFin" required>
        <input type="submit" value="Mostrar" name="mostrar">
    </form>

    <?php if (isset($pedidos)): ?>
        <h2>Pedidos en el rango de fechas</h2>
        <ul>
            <?php foreach ($pedidos as $pedido): ?>
                <li>
                    <a href="detalleDelPedido.php?cod=<?php echo $pedido->__get('Id'); ?>">
                        Pedido <?php echo $pedido->__get('Id'); ?> - Fecha: <?php echo date('d-m-Y', $pedido->__get('Fecha')); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>