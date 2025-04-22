<?php 
require_once("Database.php");
$db = new Database();

// Consulta para obtener id y foto
$consulta = "SELECT id, foto FROM coche";
$resultado = $db->query($consulta)->fetchAll(PDO::FETCH_ASSOC);

// Guardar los resultados codificando los datos binarios en base64
$fotos = [];
foreach ($resultado as $item) {
    $fotos[] = [
        'id' => $item['id'],
        'foto_base64' => base64_encode($item['foto']) // AQUÍ convertimos los datos binarios a base64
    ];
}

// Verificar si se está solicitando una imagen específica
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $consulta = "SELECT * FROM coche WHERE id = ?";
    $cocheDetalle = $db->query($consulta, [$id])->fetch(PDO::FETCH_ASSOC);
    
    // También codificamos la imagen en la vista detalle
    if ($cocheDetalle && isset($cocheDetalle['foto'])) {
        $cocheDetalle['foto_base64'] = base64_encode($cocheDetalle['foto']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 tema clase</title>
    <style>
        table {
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        .detalle {
            margin-top: 30px;
            padding: 15px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h1>Galería de coches</h1>
    
    <table>
        <thead>
            <tr>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($fotos as $foto): ?>
                <tr>
                    <td>
                        <a href="index.php?id=<?php echo $foto['id']; ?>">
                            <img src="data:image/jpeg;base64,<?php echo $foto['foto_base64']; ?>" 
                                alt="Foto de coche" style="width:100px;height:auto;">
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <?php if(isset($cocheDetalle)): ?>
    <div class="detalle">
        <h2>Detalles del coche #<?php echo $cocheDetalle['id']; ?></h2>
        <img src="data:image/jpeg;base64,<?php echo $cocheDetalle['foto_base64']; ?>" 
             alt="Foto de coche" style="max-width:400px;height:auto;">
        
        <?php if(isset($cocheDetalle['marca'])): ?>
        <p><strong>Marca:</strong> <?php echo htmlspecialchars($cocheDetalle['marca']); ?></p>
        <?php endif; ?>
        
        <?php if(isset($cocheDetalle['modelo'])): ?>
        <p><strong>Modelo:</strong> <?php echo htmlspecialchars($cocheDetalle['modelo']); ?></p>
        <?php endif; ?>
        
        <a href="index.php">Volver a la galería</a>
    </div>
    <?php endif; ?>
</body>
</html>