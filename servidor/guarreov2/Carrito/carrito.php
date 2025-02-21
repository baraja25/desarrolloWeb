<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <?php

    session_start();
    require_once("./ProductoPDO.php");
    $base = "tienda";
    $DAOProducto = new Daoproducto($base);


    if (isset($_POST['actualizar'])) {
        if (isset($_POST['marcado'])) {
            $marcado = $_POST['marcado'];

            foreach ($marcado as $key => $value) {
                $cantidad = $_POST['cantidad'][$key];
                // echo $cantidad;
                $_SESSION['carrito'][$key][1] = $cantidad;
            }
        } else {
            echo "Debes marcar alguna algún check para realizar esta acción";
        }
    }
    if (isset($_POST['eliminar'])) {
        if (isset($_POST['marcado'])) {
            $marcado = $_POST['marcado'];

            foreach ($marcado as $key => $value) {
                unset($_SESSION['carrito'][$key]);
            }
        } else {
            echo "Debes marcar alguna algún check para realizar esta acción";
        }
    }
    $marcado = [];
    if (isset($_POST['marcado'])) {
        $marcado = $_POST['marcado'];
    }

    function mostrarCarrito($DAOProducto, $marcado)
    {
        echo  "<table border='2'>";
        echo  "<th>Check</th><th>Nombre Porducto</th><th>Cantidad</th><th>PVP</th><th>Subtotal</th>";
        $total = 0;
        foreach ($_SESSION['carrito'] as $key => $value) {
            // echo "[DEBUG]".$value[0]."-".$value[1]."<br>";
            $producto = $DAOProducto->obtener($value[0]);
            echo  "<tr>";
            echo  "<td><input type='checkbox' name='marcado[" . $value[0] . "]' ";
            if (array_key_exists($value[0], $marcado)) {
                echo "checked";
            }
            echo "></td>";
            echo  "<td>$producto->nombre</td>";
            echo  "<td><input type='number' name='cantidad[" . $value[0] . "]' value='" . $value[1] . "'></td>";
            echo  "<td>$producto->PVP</td>";
            echo  "<td>" . ($producto->PVP * $value[1]) . "</td>";
            echo  "</tr>";
            $total += ($producto->PVP * $value[1]);
        }
        echo "<tr><td colspan='5' align='right'><b>Total: $total €</b></td></tr>";
        echo  "</table>";
    }
    ?>
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <?php
        if (isset($_SESSION['carrito'])) {
            mostrarCarrito($DAOProducto, $marcado);
        }
        ?>
        <input type="submit" name="comprar" value="Seguir comprando">
        <input type="submit" name="eliminar" value="eliminar">
        <input type="submit" name="actualizar" value="actualizar">
        <input type="submit" name="vaciar" value="vaciar">

    </form>




    <?php

    if (isset($_POST['vaciar'])) {
        session_destroy();
        header("Location: pedidos.php");
    }

    if (isset($_POST['comprar'])) {
        header("Location: pedidos.php");
    }

    ?>
</body>

</html>