<?php
// Incluir el archivo de paginación
require_once 'paginacion.php';

// Parámetros de conexión a la base de datos
$host = 'localhost';
$user = 'root';
$pass = '';
$base = 'tema2';
$tabla = 'Alumnos';

// Obtener el número de registros por página y la página actual desde la URL
$num = isset($_POST['Numero']) ? (int)$_POST['Numero'] : (isset($_GET['Numero']) ? (int)$_GET['Numero'] : 5);
$pagina = isset($_GET['Pag']) ? (int)$_GET['Pag'] : 1;


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Mostrar boton</title>
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" name="f1">
        <select name="Numero" onchange="f1.submit();">
            <option value=""></option>
            <?php
            for ($i = 1; $i <= 10; $i++) {
                echo "<option value='$i' ";
                if ($num == $i) {
                    echo " checked";
                }
                echo ">$i</option>";
            }

            ?>
        </select>
        <?php // Llamar a la función de paginación
        paginacion($host, $user, $pass, $base, $tabla, $num, $pagina); ?>
    </form>
</body>

</html>