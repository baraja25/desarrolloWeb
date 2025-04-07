<?php 
require_once "files.php";
$fileManager = new File();
$mensaje = "";
$tipo = "";

// Guardar nuevo contacto
if (isset($_POST['enviar'])) {
    $nombre = trim($_POST['nombre']);
    $correo = trim($_POST['correo']);
    
    if (empty($nombre) || empty($correo)) {
        $mensaje = "Por favor, completa todos los campos";
        $tipo = "error";
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $mensaje = "Por favor, introduce un correo electrónico válido";
        $tipo = "error";
    } else {
        $file = new File($nombre, $correo);
        if ($file->guardar()) {
            $mensaje = "Datos guardados correctamente";
            $tipo = "success";
        } else {
            $mensaje = "Error al guardar datos o el correo ya existe";
            $tipo = "error";
        }
    }
}

// Buscar contacto por correo
$resultadoBusqueda = null;
if (isset($_POST['buscar'])) {
    $buscarCorreo = trim($_POST['buscarCorreo']);
    
    if (empty($buscarCorreo)) {
        $mensaje = "Por favor, introduce un correo para buscar";
        $tipo = "error";
    } else {
        $resultadoBusqueda = $fileManager->buscarCorreo($buscarCorreo);
        
        if ($resultadoBusqueda === false) {
            $mensaje = "Correo no encontrado";
            $tipo = "error";
        } else {
            $mensaje = "Contacto encontrado";
            $tipo = "success";
        }
    }
}

// Eliminar contacto por correo
if (isset($_POST['eliminar'])) {
    $eliminarCorreo = trim($_POST['eliminarCorreo']);
    
    if (empty($eliminarCorreo)) {
        $mensaje = "Por favor, introduce un correo para eliminar";
        $tipo = "error";
    } else {
        if ($fileManager->eliminar($eliminarCorreo)) {
            $mensaje = "Contacto eliminado correctamente";
            $tipo = "success";
        } else {
            $mensaje = "Error al eliminar contacto o el correo no existe";
            $tipo = "error";
        }
    }
}

// Cargar lista de todos los contactos
$contactos = $fileManager->listarContactos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Contactos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1, h2 {
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .message {
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .contact-list {
            margin-top: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .sections {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .section {
            flex: 0 0 48%;
            margin-bottom: 20px;
        }
        
        @media (max-width: 768px) {
            .section {
                flex: 0 0 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gestión de Contactos</h1>
        
        <!-- Mostrar mensajes -->
        <?php if (!empty($mensaje)): ?>
            <div class="message <?php echo $tipo; ?>">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>
        
        <div class="sections">
            <!-- Formulario para añadir contactos -->
            <div class="section">
                <h2>Añadir nuevo contacto</h2>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="correo">Correo electrónico:</label>
                        <input type="email" name="correo" id="correo" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Guardar" name="enviar">
                    </div>
                </form>
            </div>
            
            <!-- Formulario para buscar contactos -->
            <div class="section">
                <h2>Buscar contacto</h2>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="form-group">
                        <label for="buscarCorreo">Correo electrónico:</label>
                        <input type="email" name="buscarCorreo" id="buscarCorreo" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Buscar" name="buscar">
                    </div>
                </form>
                
                <!-- Mostrar resultado de búsqueda -->
                <?php if ($resultadoBusqueda): ?>
                    <div style="margin-top: 15px;">
                        <strong>Nombre:</strong> <?php echo htmlspecialchars($resultadoBusqueda['nombre']); ?><br>
                        <strong>Correo:</strong> <?php echo htmlspecialchars($resultadoBusqueda['correo']); ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Formulario para eliminar contactos -->
            <div class="section">
                <h2>Eliminar contacto</h2>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="form-group">
                        <label for="eliminarCorreo">Correo electrónico:</label>
                        <input type="email" name="eliminarCorreo" id="eliminarCorreo" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Eliminar" name="eliminar">
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Lista de contactos -->
        <div class="contact-list">
            <h2>Lista de contactos</h2>
            <?php if (empty($contactos)): ?>
                <p>No hay contactos guardados.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo electrónico</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($contactos as $contacto): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($contacto['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($contacto['correo']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>