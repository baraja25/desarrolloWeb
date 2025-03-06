<?php
session_start();

// Verificar que el usuario esté autenticado
if (!isset($_SESSION['Usuario'])) {
    header("Location: login.php");
    exit;
}

$usuario = $_SESSION['Usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }
        .welcome {
            font-size: 18px;
        }
        .menu-item {
            margin: 10px 0;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        .menu-item a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }
        .logout {
            background-color: #f8f9fa;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="welcome">Bienvenido, <?php echo htmlspecialchars($usuario); ?></div>
        <a href="logout.php" class="logout">Cerrar sesión</a>
    </div>
    
    <h1>Menú Principal</h1>
    
    <div class="menu-item">
        <a href="#">Opción 1</a>
        <p>Descripción de la primera opción del menú.</p>
    </div>
    
    <div class="menu-item">
        <a href="#">Opción 2</a>
        <p>Descripción de la segunda opción del menú.</p>
    </div>
    
    <div class="menu-item">
        <a href="#">Opción 3</a>
        <p>Descripción de la tercera opción del menú.</p>
    </div>
</body>
</html>