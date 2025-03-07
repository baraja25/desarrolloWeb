<?php
/**
 * Gestión de cambio de contraseña
 * 
 * Este script permite a los usuarios cambiar su clave PIN después de
 * autenticarse con su clave PUK tras un bloqueo.
 */

// Iniciar sesión al principio
session_start();
require_once 'Database.php';

/**
 * Clase para gestionar operaciones relacionadas con contraseñas
 */
class PasswordManager {
    private $db;
    
    /**
     * Constructor
     * @param Database $database Instancia de la clase Database
     */
    public function __construct($database) {
        $this->db = $database;
    }
    
    /**
     * Cambia la contraseña de un usuario
     * 
     * @param string $username Nombre del usuario
     * @param string $newPassword Nueva contraseña (sin hashear)
     * @return array Resultado de la operación
     */
    public function changePassword($username, $newPassword, $confirmPassword) {
        // Validar que las contraseñas coincidan
        if ($newPassword !== $confirmPassword) {
            return [
                'success' => false,
                'message' => 'Las contraseñas no coinciden'
            ];
        }
        
        // Validar requisitos de seguridad de la contraseña
        if (strlen($newPassword) < 6) {
            return [
                'success' => false,
                'message' => 'La contraseña debe tener al menos 6 caracteres'
            ];
        }
        
        // Hashear la contraseña
        $hashedPassword = sha1($newPassword);
        
        try {
            // Actualizar la contraseña en la base de datos
            $this->updateUserPassword($username, $hashedPassword);
            
            // Limpiar historial de intentos de login
            $this->clearLoginAttempts($username);
            
            return [
                'success' => true,
                'message' => 'La contraseña ha sido actualizada correctamente'
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => 'Error al actualizar la contraseña: ' . $e->getMessage()
            ];
        }
    }
    
    /**
     * Actualiza la contraseña de un usuario en la base de datos
     */
    private function updateUserPassword($username, $hashedPassword) {
        $consulta = "UPDATE usuarios SET ClavePin = ? WHERE usuario = ?";
        $this->db->query($consulta, [$hashedPassword, $username]);
    }
    
    /**
     * Elimina el historial de intentos de login de un usuario
     */
    private function clearLoginAttempts($username) {
        $consulta = "DELETE FROM login WHERE usuario = ?";
        $this->db->query($consulta, [$username]);
    }
}

/**
 * Clase para gestionar la sesión del usuario
 */
class SessionManager {
    /**
     * Verifica si el usuario está autenticado
     */
    public static function requireAuthentication() {
        if (!isset($_SESSION['Usuario'])) {
            header("Location: login.php");
            exit();
        }
    }
    
    /**
     * Obtiene el nombre del usuario actual
     */
    public static function getCurrentUser() {
        return $_SESSION['Usuario'] ?? null;
    }
}

// Comprobar si el usuario está autenticado
SessionManager::requireAuthentication();

// Crear instancias
$db = new Database();
$passwordManager = new PasswordManager($db);

// Inicializar variables
$message = '';
$messageType = '';
$redirectCounter = null;

// Procesar el formulario
if (isset($_POST['Cambiar'])) {
    $newPassword = $_POST['Clave'] ?? '';
    $confirmPassword = $_POST['RepClave'] ?? '';
    $username = SessionManager::getCurrentUser();
    
    // Cambiar la contraseña
    $result = $passwordManager->changePassword($username, $newPassword, $confirmPassword);
    
    if ($result['success']) {
        $messageType = 'success';
        $redirectCounter = 3; // Redirigir en 3 segundos
    } else {
        $messageType = 'error';
    }
    
    $message = $result['message'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <?php if ($redirectCounter): ?>
    <meta http-equiv="refresh" content="<?= $redirectCounter ?>; url=login.php">
    <?php endif; ?>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        .user-info {
            font-size: 0.9em;
            color: #6c757d;
        }
        fieldset {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
        }
        legend {
            font-weight: bold;
            padding: 0 10px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="password"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }
        input[type="submit"]:hover {
            background-color: #0069d9;
        }
        .message {
            padding: 10px;
            margin: 15px 0;
            border-radius: 4px;
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
        .requirements {
            background-color: #e9ecef;
            padding: 10px;
            border-radius: 4px;
            margin-top: 15px;
            font-size: 0.85em;
        }
        .requirements h3 {
            margin-top: 0;
            font-size: 1em;
        }
        .requirements ul {
            margin-bottom: 0;
            padding-left: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Cambiar Contraseña</h1>
            <div class="user-info">
                Usuario: <strong><?= htmlspecialchars(SessionManager::getCurrentUser()) ?></strong>
            </div>
        </header>
        
        <?php if ($message): ?>
        <div class="message <?= $messageType ?>">
            <?= $message ?>
            <?php if ($redirectCounter): ?>
            <br>Será redirigido a la página de inicio de sesión en <?= $redirectCounter ?> segundos.
            <?php endif; ?>
        </div>
        <?php endif; ?>
        
        <form name="passwordForm" method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
            <fieldset>
                <legend>Establecer nueva clave PIN</legend>
                <div class="form-group">
                    <label for="Clave">Nueva clave PIN:</label>
                    <input type="password" id="Clave" name="Clave" required>
                </div>
                <div class="form-group">
                    <label for="RepClave">Confirmar clave PIN:</label>
                    <input type="password" id="RepClave" name="RepClave" required>
                </div>
                <input type="submit" name="Cambiar" value="Cambiar clave">
                
                <div class="requirements">
                    <h3>Requisitos de seguridad:</h3>
                    <ul>
                        <li>Debe contener al menos 6 caracteres</li>
                        <li>Las claves deben coincidir exactamente</li>
                    </ul>
                </div>
            </fieldset>
        </form>
    </div>
</body>
</html>