<?php
session_start();                // Iniciar o reanudar una sesión
$_SESSION['usuario'] = 'Juan';  // Almacenar datos
unset($_SESSION['usuario']);    // Eliminar una variable específica
$_SESSION = array();            // Limpiar todas las variables de sesión
session_destroy();              // Destruir completamente la sesión
session_regenerate_id(true);    // Regenerar ID (importante para seguridad)


// Control de acceso: Verificar si existe una variable de sesión antes de permitir acceso
if (!isset($_SESSION['Usuario'])) {
    header('Location: login.php');
    exit;
}

// No llamar a session_start() antes de usar $_SESSION
// Olvidar redirigir con exit después de header()
// No limpiar adecuadamente las sesiones al cerrar sesión
// Almacenar demasiada información en sesiones (impacto en rendimiento)