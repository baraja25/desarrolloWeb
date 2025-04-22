<?php 
require_once("Database.php");
$db = new Database();

$primero = $db->query("SELECT id FROM coche ORDER BY id ASC LIMIT 1")->fetchColumn();
$ultimo = $db->query("SELECT id FROM coche ORDER BY id DESC LIMIT 1")->fetchColumn();

$anterior = $db->query("SELECT id FROM coche WHERE id < ? ORDER BY id DESC LIMIT 1", [$_GET['id']])->fetchColumn();
if ($anterior === false) {
    $anterior = $primero; // Si no hay anterior, volvemos al primero
}

$siguiente = $db->query("SELECT id FROM coche WHERE id > ? ORDER BY id ASC LIMIT 1", [$_GET['id']])->fetchColumn();
if ($siguiente === false) {
    $siguiente = $ultimo; // Si no hay siguiente, volvemos al último
}


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
    <title>Ejercicio 2 tema clase</title>
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
        

        <?php if(isset($cocheDetalle['nombre'])): ?>
        <p><strong>Nombre:</strong> <?php echo htmlspecialchars($cocheDetalle['nombre']); ?></p>
        <?php endif; ?>
        
        <?php if(isset($cocheDetalle['modelo'])): ?>
        <p><strong>Modelo:</strong> <?php echo htmlspecialchars($cocheDetalle['modelo']); ?></p>
        <?php endif; ?>
        
        <?php if(isset($cocheDetalle['precio'])): ?>
        <p><strong>Precio:</strong> <?php echo htmlspecialchars($cocheDetalle['precio']); ?></p>
        <?php endif; ?>
        
        <?php if(isset($cocheDetalle['matricula'])): ?>
        <p><strong>Matrícula:</strong> <?php echo htmlspecialchars($cocheDetalle['matricula']); ?></p>
        <?php endif; ?>

        <?php if(isset($cocheDetalle['anio'])): ?>
        <p><strong>Año:</strong> <?php echo htmlspecialchars($cocheDetalle['anio']); ?></p>
        <?php endif; ?>

        <?php if(isset($cocheDetalle['marca'])): ?>
        <p><strong>Marca:</strong> <?php echo htmlspecialchars($cocheDetalle['marca']); ?></p>
        <?php endif; ?>
        
        
    </div>
    <?php endif; ?>
    <a href="index.php?id=<?php echo $primero; ?>"><<</a>
    <a href="index.php?id=<?php echo $anterior; ?>"><</a>
    <a href="index.php?id=<?php echo $siguiente; ?>">></a>
    <a href="index.php?id=<?php echo $ultimo; ?>">>></a>

</body>
</html>