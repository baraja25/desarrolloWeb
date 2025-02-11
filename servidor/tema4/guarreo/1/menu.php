<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('Location: login1.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantenimiento de Productos</title>
</head>
<body>
    <form method="post" action="">
        <label for="options">Seleccione una opción:</label>
        <select name="options" id="options">
            <option value="opcion1">Opción 1</option>
            <option value="opcion2">Opción 2</option>
            <option value="opcion3">Opción 3</option>
            <option value="opcion4">Opción 4</option>
            <option value="opcion5">Opción 5</option>
        </select>
        <input type="submit" name="submit" value="Enviar">
    </form>

    <?php
        if (isset($_POST['submit'])) {
            if ($_POST['options'] == 'opcion5') {
                session_destroy();
                header('Location: login1.php');
            } else {
                echo "Ha seleccionado: " . htmlspecialchars($_POST['options']);
            }
        }
    ?>
</body>
</html>