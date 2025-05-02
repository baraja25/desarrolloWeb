<?php 
require_once 'Database.php';

$database = new Database();
$coches = [];

$coches = $database->query("SELECT id, foto FROM coche")->fetchAll(PDO::FETCH_ASSOC);


foreach ($coches as $key => $value) {
    
    $coches[$key]['foto'] = base64_encode($coches[$key]['foto']);
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 listar imagenes</title>
</head>
<body>
    <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post" enctype="multipart/form-data">
        <?php foreach ($coches as $coche): ?>
            <div>
                <a href="listar.php?id=<?php echo $coche['id']; ?>">
                <img src="data:image/jpeg;base64,<?php echo $coche['foto']; ?>" alt="Foto de coche" style="width:100px;height:auto;">
                </a>
            </div>        
          
        <?php endforeach; ?>
    </form>
</body>
</html>