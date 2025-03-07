<?php
/**
 * Sistema de Autenticación Segura con PIN/PUK
 * 
 * Este sistema implementa un mecanismo de autenticación con bloqueo por intentos fallidos
 * y sistema de recuperación mediante código PUK.
 */

// Iniciar sesión al principio
session_start();
require_once 'Database.php';

/**
 * Clase para manejar la autenticación de usuarios
 */
class AuthService {
    private $db;
    private $pinAttempts = 4;      // Número máximo de intentos PIN
    private $pinTimeframe = 180;   // 3 minutos en segundos
    private $pukAttempts = 3;      // Número máximo de intentos PUK

    public function __construct($database) {
        $this->db = $database;
    }

    /**
     * Comprueba si un usuario está bloqueado
     * 
     * @param string $usuario Nombre de usuario
     * @param string $tipo Tipo de credencial (PIN o PUK)
     * @return bool True si está bloqueado
     */
    public function estaBloqueado($usuario, $tipo = "PIN") {
        if ($tipo == "PIN") {
            return $this->estaBloqueadoPorPIN($usuario);
        } else {
            return $this->estaBloqueadoPorPUK($usuario);
        }
    }
    
    /**
     * Comprueba si un usuario está bloqueado por intentos fallidos de PIN
     */
    private function estaBloqueadoPorPIN($usuario) {
        // CORREGIDO: LIMIT no puede usar marcadores de posición en MySQL/MariaDB
        $consulta = "SELECT Acceso, Hora 
                    FROM login
                    WHERE Usuario = ? AND tipo = 'PIN'
                    ORDER BY Hora DESC
                    LIMIT " . (int)$this->pinAttempts;
        
        $statement = $this->db->query($consulta, [$usuario]);
        if (!$statement) {
            // Manejar error en la consulta
            error_log("Error en la consulta SQL: " . print_r($this->db->errorInfo(), true));
            return false;
        }
        
        $intentos = $statement->fetchAll();
        
        // Verificar si tenemos suficientes intentos fallidos
        $fallos = $this->contarFallos($intentos);
        if ($fallos < $this->pinAttempts) {
            return false;
        }
        
        // Verificar si los intentos ocurrieron dentro del intervalo de bloqueo
        return $this->dentroDeIntervalo($intentos, $this->pinTimeframe);
    }
    
    /**
     * Comprueba si un usuario está bloqueado por intentos fallidos de PUK
     */
    private function estaBloqueadoPorPUK($usuario) {
        // CORREGIDO: LIMIT no puede usar marcadores de posición
        $consulta = "SELECT Acceso 
                    FROM login
                    WHERE Usuario = ? AND tipo = 'PUK' AND Acceso = 'D'
                    ORDER BY Hora DESC
                    LIMIT " . (int)$this->pukAttempts;
        
        $statement = $this->db->query($consulta, [$usuario]);
        if (!$statement) {
            return false;
        }
        return $statement->rowCount() >= $this->pukAttempts;
    }
    
    /**
     * Cuenta el número de intentos fallidos
     */
    private function contarFallos($intentos) {
        $fallos = 0;
        foreach ($intentos as $intento) {
            if ($intento['Acceso'] == 'D') {
                $fallos++;
            }
        }
        return $fallos;
    }
    
    /**
     * Verifica si los intentos ocurrieron dentro del intervalo de tiempo especificado
     */
    private function dentroDeIntervalo($intentos, $intervalo) {
        if (count($intentos) < $this->pinAttempts) {
            return false;
        }
        
        $primero = end($intentos);
        $ultimo = reset($intentos);
        
        return ($ultimo['Hora'] - $primero['Hora']) <= $intervalo;
    }
    
    /**
     * Verifica las credenciales de un usuario
     */
    public function verificarCredenciales($usuario, $clave, $tipo) {
        $campo = ($tipo == "PIN") ? "ClavePin" : "ClavePuk";
        
        $consulta = "SELECT COUNT(*) as cuenta 
                    FROM usuarios 
                    WHERE usuario = ? AND {$campo} = ?";
        
        $statement = $this->db->query($consulta, [$usuario, $clave]);
        if (!$statement) return false;
        
        $resultado = $statement->fetch();
        return $resultado['cuenta'] > 0;
    }
    
    /**
     * Registra un intento de inicio de sesión
     */
    public function registrarIntento($usuario, $clave, $acceso, $tipo) {
        $consulta = "INSERT INTO login VALUES(?, ?, ?, ?, ?)";
        
        $hora = time();
        $this->db->query($consulta, [$usuario, $clave, $tipo, $hora, $acceso]);
    }
    
    /**
     * Procesa un intento de inicio de sesión
     */
    public function procesarIntento($usuario, $clave, $tipo) {
        // Verificar si las credenciales son correctas
        if ($this->verificarCredenciales($usuario, $clave, $tipo)) {
            // Credenciales correctas
            $this->registrarIntento($usuario, $clave, 'C', $tipo);
            $_SESSION['Usuario'] = $usuario;
            
            if ($tipo == "PIN") {
                return [
                    'success' => true,
                    'redirect' => 'Menu.php'
                ];
            } else {
                return [
                    'success' => true,
                    'redirect' => 'CambiarClave.php'
                ];
            }
        } else {
            // Credenciales incorrectas
            $this->registrarIntento($usuario, $clave, 'D', $tipo);
            return [
                'success' => false,
                'message' => 'Usuario y/o clave incorrecta'
            ];
        }
    }
    
    /**
     * Obtiene lista de usuarios con PIN bloqueado
     */
    public function obtenerUsuariosBloqueados() {
        $consulta = "SELECT DISTINCT Usuario FROM usuarios";
        $statement = $this->db->query($consulta);
        if (!$statement) return [];
        
        $usuarios = $statement->fetchAll();
        
        $bloqueados = [];
        foreach ($usuarios as $usuario) {
            if ($this->estaBloqueado($usuario['Usuario'], "PIN")) {
                $bloqueados[] = $usuario['Usuario'];
            }
        }
        
        return $bloqueados;
    }
}

/**
 * Versión modificada de Database para propósitos de depuración
 * Eliminar si ya tienes la clase Database implementada
 */
if (!class_exists('Database')) {
    class Database {
        private $connection;
        private $lastError = null;

        public function __construct() {
            try {
                $config = [
                    'host' => 'localhost',
                    'dbname' => 'examenFeb',
                    'charset' => 'utf8mb4'
                ];

                $dsn = 'mysql:'.http_build_query($config, '', ';');
                $this->connection = new PDO($dsn, 'root', '', [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]);
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }

        public function query($query, $params = []) {
            try {
                $stmt = $this->connection->prepare($query);
                $stmt->execute($params);
                return $stmt;
            } catch (PDOException $e) {
                $this->lastError = $e->getMessage();
                error_log("Error en consulta SQL: " . $e->getMessage() . " - Query: " . $query);
                return null;
            }
        }

        public function errorInfo() {
            return $this->lastError;
        }
    }
}

// Crear instancia de conexión a la base de datos
$db = new Database();

// Crear servicio de autenticación
$authService = new AuthService($db);

// Variable para almacenar mensajes para el usuario
$messages = [];
$resultados = null;

// Procesar el formulario de inicio de sesión
if (isset($_POST['Enviar'])) {
    try {
        $usuario = $_POST['Usuario'] ?? '';
        $claveTextoPlano = $_POST['Clave'] ?? '';
        $clave = sha1($claveTextoPlano);
        
        if (empty($usuario) || empty($claveTextoPlano)) {
            $messages[] = [
                'type' => 'error',
                'text' => 'Por favor, complete todos los campos'
            ];
        } else {
            // Determinar si debemos usar PIN o PUK
            if (!$authService->estaBloqueado($usuario, "PIN")) {
                // PIN no bloqueado, intentar con PIN
                $resultados = $authService->procesarIntento($usuario, $clave, "PIN");
            } else {
                // PIN bloqueado, verificar si PUK también está bloqueado
                if (!$authService->estaBloqueado($usuario, "PUK")) {
                    // PUK no bloqueado, intentar con PUK
                    $resultados = $authService->procesarIntento($usuario, $clave, "PUK");
                } else {
                    // Ambos bloqueados
                    $messages[] = [
                        'type' => 'error',
                        'text' => 'Usuario completamente bloqueado. Contacte al administrador.'
                    ];
                }
            }
            
            // Procesar resultados
            if ($resultados) {
                if ($resultados['success']) {
                    // Redirección exitosa
                    header("Location: " . $resultados['redirect']);
                    exit;
                } else {
                    // Mensaje de error
                    $messages[] = [
                        'type' => 'error',
                        'text' => $resultados['message']
                    ];
                }
            }
        }
    } catch (Exception $e) {
        $messages[] = [
            'type' => 'error',
            'text' => 'Error del sistema: ' . $e->getMessage()
        ];
    }
}

// Obtener lista de usuarios con PIN bloqueado (con manejo de errores)
try {
    $usuariosBloqueados = $authService->obtenerUsuariosBloqueados();
} catch (Exception $e) {
    $usuariosBloqueados = [];
    $messages[] = [
        'type' => 'error',
        'text' => 'Error al verificar usuarios bloqueados: ' . $e->getMessage()
    ];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Autenticación Segura</title>
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
        fieldset {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
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
        input[type="text"],
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
        }
        input[type="submit"]:hover {
            background-color: #0069d9;
        }
        .warning {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
            border-radius: 4px;
            padding: 10px;
            margin-bottom: 15px;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
            padding: 10px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Acceso al Sistema</h1>
        
        <!-- Mostrar mensajes -->
        <?php foreach ($messages as $message): ?>
            <div class="<?= $message['type'] ?>">
                <?= $message['text'] ?>
            </div>
        <?php endforeach; ?>
        
        <form name="loginForm" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
            <fieldset>
                <legend>Introduzca sus credenciales</legend>
                
                <!-- Mostrar usuarios bloqueados -->
                <?php if (!empty($usuariosBloqueados)): ?>
                    <?php foreach ($usuariosBloqueados as $usuarioBloqueado): ?>
                        <div class="warning">
                            Usuario <strong><?= htmlspecialchars($usuarioBloqueado) ?></strong> con clave PIN bloqueada, 
                            debe introducir ahora su clave PUK.
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                
                <div class="form-group">
                    <label for="Usuario">Usuario:</label>
                    <input type="text" id="Usuario" name="Usuario" value="<?= htmlspecialchars($_POST['Usuario'] ?? '') ?>">
                </div>
                
                <div class="form-group">
                    <label for="Clave">Clave:</label>
                    <input type="password" id="Clave" name="Clave">
                </div>
                
                <div class="form-group">
                    <input type="submit" name="Enviar" value="Iniciar sesión">
                </div>
            </fieldset>
        </form>
    </div>
</body>
</html>