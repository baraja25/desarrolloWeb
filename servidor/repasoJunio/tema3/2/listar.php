<?php 
require_once 'CochesDao.php';

$cochesDao = new CochesDao();
$coches = array();
$cochesDao->listarCoches();
$coches = $cochesDao->coches;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 Dao</title>
</head>
<body>
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">
        <table border="1">
            <tr>
                <th>Foto</th>
            </tr>
            <?php foreach ($coches as $coche): ?>
            <tr>
                <td><a href="detalle.php?id=<?php echo $coche->id; ?>"><img src="data:image/jpeg;base64,<?php echo $coche->foto; ?>" alt="Coche" width="100"></a></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </form>
</body>
</html>