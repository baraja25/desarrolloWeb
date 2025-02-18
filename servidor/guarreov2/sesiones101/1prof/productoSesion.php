<?php
require_once 'producto.php';


function sortArray(&$array, $sortKey) {
    usort($array, function($a, $b) use ($sortKey) {
        // Verificamos si $a y $b son objetos
        if (is_object($a) && is_object($b)) {
            return strcmp($a->__get($sortKey), $b->__get($sortKey));
        }
        // Verificamos si $a y $b son arrays asociativos
        elseif (is_array($a) && is_array($b)) {
            return strcmp($a[$sortKey], $b[$sortKey]);
        }
        // Si no son del mismo tipo, puedes manejarlo como desees
        return 0; // o puedes lanzar un error
    });
}


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

// Ordenar productos
if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
    
    sortArray($_SESSION['productos'], $sort);
}

// Mostrar tabla si hay productos en la sesión o si se ha hecho clic en "Mostrar"
$mostrarTabla = isset($_POST['mostrar']) || isset($_GET['sort']);
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
        if ($mostrarTabla && isset($_SESSION['productos'])) {
            echo "<table border='1'>
            <tr>
                <th>Selecciona</th>
                <th><a href='?sort=id'>ID</a></th>
                <th><a href='?sort=nombre'>Nombre</a></th>
                <th><a href='?sort=marca'>Marca</a></th>
                <th><a href='?sort=precio'>Precio</a></th>
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
            echo "<input type='submit' value='Actualizar' name='actualizar'>";
            echo "<input type='submit' value='Vaciar' name='vaciar'>";
        }
        ?>
    </form>
</body>
</html>