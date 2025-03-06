<?php
require_once 'Database.php';
session_start();
$db = new Database();

/**
 * Comprueba si un usuario está bloqueado por intentos fallidos
 * @param string $usuario Nombre de usuario
 * @param string $tipo Tipo de clave (PIN o PUK)
 * @return bool True si está bloqueado, False si no
 */
function estaBloqueado($usuario, $tipo = "PIN")
{
    global $db;
    
    if ($tipo == "PIN") {
        // Para PIN: bloqueado si hay 4 o más intentos fallidos en los últimos 3 minutos
        $consulta = "SELECT COUNT(*) as intentos FROM login 
                    WHERE Usuario = ? 
                    AND Tipo = 'PIN' 
                    AND Acceso = 'D' 
                    AND Hora > ?";
        
        $tiempo_limite = time() - (3 * 60); // 3 minutos atrás
        $statement = $db->query($consulta, [$usuario, $tiempo_limite]);
        $resultado = $statement->fetch();
        
        return ($resultado['intentos'] >= 4);
    } else {
        // Para PUK: bloqueado si hay 3 o más intentos fallidos en total
        $consulta = "SELECT COUNT(*) as intentos FROM login 
                    WHERE Usuario = ? 
                    AND Tipo = 'PUK' 
                    AND Acceso = 'D'";
                    
        $statement = $db->query($consulta, [$usuario]);
        $resultado = $statement->fetch();
        
        return ($resultado['intentos'] >= 3);
    }
}

/**
 * Comprueba si se debe usar PUK en lugar de PIN
 * @param string $usuario Nombre de usuario
 * @return bool True si debe usar PUK, False si debe usar PIN
 */
function debeUsarPUK($usuario)
{
    return estaBloqueado($usuario, "PIN");
}

/**
 * Comprueba si las credenciales son correctas
 * @param string $usuario Nombre de usuario
 * @param string $clave Clave (PIN o PUK)
 * @param string $tipo Tipo de clave (PIN o PUK)
 * @return bool True si la credencial es correcta
 */
function comprobarIntento($usuario, $clave, $tipo)
{
    global $db;
    
    // Verificar el largo de la clave según el tipo
    if (($tipo == "PIN" && strlen($clave) != 4) || ($tipo == "PUK" && strlen($clave) != 6)) {
        return false;
    }
    
    $consulta = "SELECT * FROM usuarios WHERE Usuario = ?";
    $statement = $db->query($consulta, [$usuario]);
    $resultado = $statement->fetch();
    
    if (!$resultado) {
        return false; // Usuario no encontrado
    }
    
    // Verificar PIN o PUK según el tipo
    if ($tipo == "PIN") {
        return $resultado['ClavePin'] == $clave;
    } else {
        return $resultado['ClavePuk'] == $clave;
    }
}

/**
 * Registra un intento de login
 * @param string $usuario Nombre de usuario
 * @param string $clave Clave utilizada
 * @param string $acceso Resultado del acceso (C=correcto, D=denegado)
 * @param string $tipo Tipo de clave (PIN o PUK)
 */
function insertarLogin($usuario, $clave, $acceso, $tipo)
{
    global $db;
    
    $consulta = "INSERT INTO login (Usuario, Clave, Acceso, Tipo, Hora) 
                VALUES (?, ?, ?, ?, ?)";
                
    $db->query($consulta, [$usuario, $clave, $acceso, $tipo, time()]);
}

/**
 * Cambia la contraseña de un usuario
 * @param string $usuario Nombre de usuario
 * @param string $nueva_clave Nueva clave PIN
 * @return bool True si se actualizó correctamente
 */
function cambiarClave($usuario, $nueva_clave)
{
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

// Procesamiento del formulario principal de login
if (isset($_POST['enviar'])) {
    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : "";
    $clave = isset($_POST['clave']) ? $_POST['clave'] : "";
    $tipo = "PIN";
    
    // Comprobar si debe usar PUK en lugar de PIN
    if (debeUsarPUK($usuario)) {
        $tipo = "PUK";
        
        // Verificar si ya está bloqueado por intentos fallidos de PUK
        if (estaBloqueado($usuario, "PUK")) {
            echo "<div class='error'>Usuario completamente bloqueado. Contacte al administrador.</div>";
            // No permitir más intentos
        } else {
            // Intentar login con PUK
            if (comprobarIntento($usuario, $clave, $tipo)) {
                // PUK correcto, establecer sesión para cambio de contraseña
                $_SESSION['Usuario'] = $usuario;
                $_SESSION['RequiereCambio'] = true;
                insertarLogin($usuario, $clave, "C", $tipo);
                header("Location: cambiar_clave.php");
                exit;
            } else {
                // PUK incorrecto
                echo "<div class='error'>Código PUK incorrecto. Intentos restantes: " . 
                    (3 - contarIntentosFallidosPUK($usuario)) . "</div>";
                insertarLogin($usuario, $clave, "D", $tipo);
            }
        }
    } else {
        // Intentar login con PIN
        if (comprobarIntento($usuario, $clave, $tipo)) {
            $_SESSION['Usuario'] = $usuario;
            insertarLogin($usuario, $clave, "C", $tipo);
            header("Location: menu.php");
            exit;
        } else {
            echo "<div class='error'>PIN incorrecto.</div>";
            insertarLogin($usuario, $clave, "D", $tipo);
            
            // Comprobar si ahora debe usar PUK
            if (debeUsarPUK($usuario)) {
                echo "<div class='warning'>Demasiados intentos fallidos. Debe usar su código PUK de 6 dígitos.</div>";
            }
        }
    }
}

/**
 * Cuenta los intentos fallidos de PUK
 * @param string $usuario Nombre de usuario
 * @return int Número de intentos fallidos
 */
function contarIntentosFallidosPUK($usuario) {
    global $db;
    
    $consulta = "SELECT COUNT(*) as intentos FROM login 
                WHERE Usuario = ? 
                AND Tipo = 'PUK' 
                AND Acceso = 'D'";
                
    $statement = $db->query($consulta, [$usuario]);
    $resultado = $statement->fetch();
    
    return $resultado['intentos'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Acceso Seguro</title>
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
        input[type="text"], input[type="password"] {
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
        .warning {
            background-color: #fff3cd;
            color: #856404;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h1>Acceso al Sistema</h1>
    
    <?php if (isset($usuario) && debeUsarPUK($usuario)): ?>
        <div class="warning">Usuario <?php echo htmlspecialchars($usuario); ?> con PIN bloqueado. Por favor, introduzca su código PUK de 6 dígitos.</div>
    <?php endif; ?>
    
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="form-group">
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" id="usuario" value="<?php echo isset($usuario) ? htmlspecialchars($usuario) : ''; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="clave">
                <?php echo (isset($usuario) && debeUsarPUK($usuario)) ? 'Código PUK (6 dígitos):' : 'Código PIN (4 dígitos):'; ?>
            </label>
            <input type="password" name="clave" id="clave" required 
                   title="<?php echo (isset($usuario) && debeUsarPUK($usuario)) ? 'Introduzca 6 dígitos numéricos' : 'Introduzca 4 dígitos numéricos'; ?>">
        </div>
        
        <div class="form-group">
            <input type="submit" name="enviar" value="Acceder">
        </div>
    </form>
</body>
</html>