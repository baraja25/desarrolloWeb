<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    session_start();
    // session_destroy();
    require_once "./Funciones_Genericas.php";
    require_once "./clienteDAOClass.php";
    require_once "./DAOFamilias.php";
    require_once "./ProductoPDO.php";
    require_once "./DaoStock.php";

    //buscar tienda
    $base = "tienda";

    $clienteDao = new Daoclientes($base);
    $clienteDao->listar();

    $familiaDao = new DAOFamilias($base);
    $familiaDao->listar();

    $cliente = "";
    if (isset($_POST['Cliente'])) {
        $cliente = $_POST['Cliente'];
    }
    $familia = "";
    if (isset($_POST['familia'])) {
        $familia = $_POST['familia'];
    }
    ?>
</head>

<body>

    <fieldset>
        <legend>Selecciona el cliente</legend>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" name="f1">
            <?php
            selectDBObject($clienteDao->clientess, 'NIF', ['Nombre', 'Apellido1', 'Apellido2'], 'Cliente', $cliente, true);
            ?>
    </fieldset>
    <fieldset>
        <legend>Busca Productos</legend>
        <!-- <form action='$_SERVER[PHP_SELF]' method='post' enctype='multipart/form-data' name='f2'> -->
        <?php
        selectDBObject($familiaDao->familias, 'cod', 'nombre', 'familia', $familia);
        ?>
        Nombre producto: <input type='text' name='nombreProducto'>
        <input type='submit' value='Buscar' name='Buscar'>

        </form>


        </form>
    </fieldset>


    <?php

    if (isset($_POST['Buscar'])) {
        $productoDao = new Daoproducto($base);
        $nombreProducto = $_POST['nombreProducto'];
        $familia = $_POST['familia'];

        $productoDao->buscar($nombreProducto, $familia);

        $stockDAO = new Daostock($base);
        echo "<fieldset>";
        echo "<legend>Productos encotrados</legend>";
        echo "<form action='$_SERVER[PHP_SELF]' method='post' enctype='multipart/form-data' name='f2'>";
        echo "<table border='2'>";
        echo "<th>seleccionar</th><th>Nombre</th><th>PVP</th><th>Cantidad Disponible</th><th>Cantidad Pedida</th>";
        foreach ($productoDao->productos as $key => $value) {
            $total = $stockDAO->totalProducto($value->cod);

            echo "<tr>";
            echo "<td>";
            echo "<input type='checkbox' name='checkbox[$value->cod]'>";
            echo "</td>";
            echo "<td>";
            echo $value->nombre;
            echo "</td>";
            echo "<td>";
            echo $value->PVP;
            echo "</td>";
            echo "</td>";
            echo "<td>";
            echo "<input type='number' name='cantidad[$value->cod]' value='$total' readonly>";
            echo "</td>";
            echo "</td>";
            echo "<td>";
            echo "<input type='number' name='disponible[$value->cod]'>";

            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<input type='hidden' name='Cliente' value='$cliente'>";
        echo "<input type='submit' name='Pedir' value='Pedir'>";
        echo "</form>";
        echo "</fieldset>";
    }


    if (isset($_POST['Pedir'])) {
        $cantidad = $_POST['cantidad'];
        $checkbox = $_POST['checkbox'];
        $disponible = $_POST['disponible'];
        $Cliente = $_POST['Cliente'];
        foreach ($checkbox as $key => $value) {
            $row = array();
            $row[] = $key;
            $row[] = $disponible[$key];
            $_SESSION['carrito'][$key] = $row;
        }
        header('Location: carrito.php');
    }
    ?>
</body>
</html>