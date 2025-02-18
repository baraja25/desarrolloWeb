<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock</title>
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <select name="tiendas">
        <option value="0">Seleccione una tienda</option>
        <?php foreach ($daoTiendas->tiendas as $tienda) : ?>
            <option value="<?php echo $tienda->__get('cod') ?>"><?php echo $tienda->__get('nombre') ?></option>
        <?php endforeach; ?>
    </select>
    <select name="familiaProductos">
        <option value="0">Seleccione una familia de productos</option>
        <?php foreach ($daoFamiliasProductos->familiasProductos as $familiaProducto) : ?>
            <option value="<?php echo $familiaProducto->__get('cod') ?>"><?php echo $familiaProducto->__get('nombre') ?></option>
        <?php endforeach; ?>
    </select>

    <input type="submit" value="Buscar">
    <?php mostrarResultados($tienda, $familia) ?>
    </form>
</body>

</html>