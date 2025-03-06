<?php
require_once 'Database.php';
session_start();
$db = new Database();

// Verificar que el usuario esté autenticado y requiera cambio de clave
if (!isset($_SESSION['Usuario']) || !isset($_SESSION['RequiereCambio'])) {
    header("Location: login.php");
    exit;
}

$usuario = $_SESSION['Usuario'];
$mensaje = "";
$tipo_mensaje = "";

if (isset($_POST['cambiar'])) {
    $nueva_clave = $_POST['nueva_clave'];
    $confirmar_clave = $_POST['confirmar_clave'];
    
    // Validar que sean 4 dígitos
    if (!preg_match('/^[0-9]{4}$/', $nueva_clave)) {
        $mensaje = "La nueva clave debe ser de 4 dígitos numéricos.";
        $tipo_mensaje = "error";
    }
    // Validar que coincidan
    else if ($nueva_clave != $confirmar_clave) {
        $mensaje = "Las claves no coinciden.";
        $tipo_mensaje = "error";
    }
    // Intentar cambiar la clave
    else {
        if (cambiarClave($usuario, $nueva_clave)) {
            $mensaje = "Clave actualizada correctamente.";
            $tipo_mensaje = "success";
            // Redirigir después de 2 segundos
            header("refresh:2;url=menu.php");
            // Eliminar la variable de sesión de requisito de cambio
            unset($_SESSION['RequiereCambio']);
        } else {
            $mensaje = "La nueva clave no puede ser igual a la anterior.";
            $tipo_mensaje = "error";
        }
    }
}

// Función desde login.php (copiarla aquí también)
function cambiarClave($usuario, $nueva_clave) {
    global $db;
    
    // Verificar si la nueva clave es igual a la anterior
    $consulta = "SELECT PIN FROM usuarios WHERE Usuario = ?";
    $statement = $db->query($consulta, [$usuario]);
    $resultado = $statement->fetch();
    
    if ($resultado['PIN'] == $nueva_clave) {
        return false; // La nueva clave es igual a la anterior
    }
    
    // Actualizar la clave
    $consulta = "UPDATE usuarios SET PIN = ? WHERE Usuario = ?";
    $db->query($consulta, [$nueva_clave, $usuario]);
    
    // Limpiar intentos de login
    $consulta = "DELETE FROM login WHERE Usuario = ?";
    $db->query($consulta, [$usuario]);
    
    return true;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Clave</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="password"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h1>Cambiar Código PIN</h1>
    <p>Tras validarse con el código PUK, debe cambiar su código PIN.</p>
    
    <?php if (!empty($mensaje)): ?>
        <div class="<?php echo $tipo_mensaje; ?>"><?php echo $mensaje; ?></div>
    <?php endif; ?>
    
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="form-group">
            <label for="nueva_clave">Nuevo código PIN (4 dígitos):</label>
            <input type="password" name="nueva_clave" id="nueva_clave" pattern="[0-9]{4}" 
                   title="Introduzca 4 dígitos numéricos" required>
        </div>
        
        <div class="form-group">
            <label for="confirmar_clave">Confirme el nuevo código PIN:</label>
            <input type="password" name="confirmar_clave" id="confirmar_clave" pattern="[0-9]{4}" 
                   title="Introduzca 4 dígitos numéricos" required>
        </div>
        
        <div class="form-group">
            <input type="submit" name="cambiar" value="Cambiar PIN">
        </div>
    </form>
</body>
</html>