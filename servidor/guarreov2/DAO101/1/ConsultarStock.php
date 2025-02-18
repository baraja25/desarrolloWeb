<?php
require_once 'DaoTiendas.php';
require_once 'DaoFamiliaProductos.php';
require_once 'DaoStock.php';

function mostrarResultados($tienda, $familia)
{
    $daoStocks = new DaoStocks();
    $daoStocks->listarFamiliaTiendas($tienda, $familia);


    echo "<table border='1'>";
    echo "<tr><th>Producto</th><th>Cantidad</th></tr>";
    foreach ($daoStocks->stocks as $stock) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($stock->__get('producto')) . "</td>";
        echo "<td>" . htmlspecialchars($stock->__get('unidades')) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}

$daoTiendas = new DaoTiendas();
$daoTiendas->listar();
$daoFamiliasProductos = new DaoFamiliasProductos();
$daoFamiliasProductos->listar();
$tienda = isset($_POST['tiendas']) ? $_POST['tiendas'] : '';
$familia = isset($_POST['familiaProductos']) ? $_POST['familiaProductos'] : '';





require_once 'ConsultarStock.view.php';
