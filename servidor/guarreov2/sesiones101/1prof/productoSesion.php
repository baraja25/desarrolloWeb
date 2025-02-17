<?php
require_once 'producto.php';
session_start();

if (isset($_POST['insertar'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $precio = $_POST['precio'];

    $producto = new Producto();
    $producto->__set('id', $id);
    $producto->__set('nombre', $nombre);
    $producto->__set('marca', $marca);
    $producto->__set('precio', $precio);

    $_SESSION['productos'][$id] = $producto;
}

if (isset($_POST['borrar'])) {
    if (isset($_POST['borrar_ids'])) {
        foreach ($_POST['borrar_ids'] as $clave => $valor) {
            unset($_SESSION['productos'][$clave]);
        }
    }
}

if (isset($_POST['actualizar'])) {
    if (isset($_POST['actualizar_ids'])) {
        foreach ($_POST['actualizar_ids'] as $clave => $valor) {
            if (isset($_POST['borrar_ids'][$clave]) && isset($_SESSION['productos'][$clave])) {
                $_SESSION['productos'][$clave]->__set('nombre', $valor['nombre']);
                $_SESSION['productos'][$clave]->__set('marca', $valor['marca']);
                $_SESSION['productos'][$clave]->__set('precio', $valor['precio']);
            }
        }
    }
}

if (isset($_POST['vaciar'])) {
    unset($_SESSION['productos']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Productos en Sesión</title>
</head>
<body>
    <form name="f1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <fieldset>
            <legend>Productos en Sesión</legend>
            <label for="id">ID:</label>
            <input type="text" id="id" name="id"><br><br>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre"><br><br>
            <label for="marca">Marca:</label>
            <input type="text" id="marca" name="marca"><br><br>
            <label for="precio">Precio:</label>
            <input type="text" id="precio" name="precio"><br><br>
            <input type="submit" value="Insertar" name="insertar">
            <input type="submit" value="Mostrar" name="mostrar">
            <input type="submit" value="Borrar" name="borrar">
        </fieldset>
        <?php
        if (isset($_POST['mostrar'])) {
            if (isset($_SESSION['productos'])) {
                echo "<table border='1'>
                <tr>
                    <th>Selecciona</th>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Precio</th>
                </tr>";

                foreach ($_SESSION['productos'] as $producto) {
                    echo "<tr>
                    <td><input type='checkbox' name='borrar_ids[" . $producto->__get('id') . "]'></td>
                    <td><input type='text' name='actualizar_ids[" . $producto->__get('id') . "][id]' value='" . $producto->__get('id') . "' readonly></td>
                    <td><input type='text' name='actualizar_ids[" . $producto->__get('id') . "][nombre]' value='" . $producto->__get('nombre') . "'></td>
                    <td><input type='text' name='actualizar_ids[" . $producto->__get('id') . "][marca]' value='" . $producto->__get('marca') . "'></td>
                    <td><input type='text' name='actualizar_ids[" . $producto->__get('id') . "][precio]' value='" . $producto->__get('precio') . "'></td>
                  </tr>";
                }

                echo "</table>";
            }
            echo "<input type='submit' value='Actualizar' name='actualizar'>";
            echo "<input type='submit' value='Vaciar' name='vaciar'>";
        }
        ?>
    </form>
</body>
</html>