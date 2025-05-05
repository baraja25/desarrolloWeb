<?php 
require_once 'CochesDao.php';

$cochesDao = new CochesDao();
$cochesDao->listarCoches();
$primero = $cochesDao->primerCoche();
$ultimo = $cochesDao->ultimoCoche();
$siguiente = $cochesDao->siguienteCoche($_GET['id']);
$anterior = $cochesDao->anteriorCoche($_GET['id']);

if ($siguiente == null) {
    $siguiente = $cochesDao->primerCoche();
}
if ($anterior == null) {
    $anterior = $cochesDao->ultimoCoche();
}




if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $coches = $cochesDao->coches;
    
    foreach ($coches as $coche) {
        if ($coche->id == $id) {
            $selectedCoche = $coche;
            break;
        }
    }
} else {
    echo "No se ha proporcionado un ID de coche.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 dao</title>
</head>
<body>
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">
        <table border="1">
            <tr>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Precio</th>
                <th>Matrícula</th>
                <th>Año</th>
            </tr>
            <tr>
                <td><img src="data:image/jpeg;base64,<?php echo $selectedCoche->foto; ?>" alt="Coche" width="100"></td>
                <td><?php echo $selectedCoche->nombre; ?></td>
                <td><?php echo $selectedCoche->marca; ?></td>
                <td><?php echo $selectedCoche->modelo; ?></td>
                <td><?php echo $selectedCoche->precio; ?></td>
                <td><?php echo $selectedCoche->matricula; ?></td>
                <td><?php echo $selectedCoche->anio; ?></td>
            </tr>
        </table>
        <br>
        <a href="detalle.php?id=<?php echo $primero ?>"><<</a>
        <a href="detalle.php?id=<?php echo $anterior?>"><</a>
        <a href="detalle.php?id=<?php echo $siguiente?>">></a>
        <a href="detalle.php?id=<?php echo $ultimo?>">>></a>
    </form>
</body>
</html>