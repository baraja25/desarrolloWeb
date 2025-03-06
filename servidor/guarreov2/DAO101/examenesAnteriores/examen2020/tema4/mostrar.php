<?php
// filepath: d:\daw2\desarrolloWeb\servidor\guarreov2\DAO101\examenesAnteriores\examen2020\tema4\mostrar.php
session_start();

// Variable para controlar si se muestra el mensaje de eliminación
$preferenciasEliminadas = false;

// Verificar si se ha pulsado el botón Borrar preferencias
if (isset($_POST['borrar'])) {
    // Eliminar las preferencias de la sesión
    unset($_SESSION['idioma']);
    unset($_SESSION['perfil']);
    unset($_SESSION['zonaHoraria']);
    // O también podríamos usar: $_SESSION = array();
    
    // Indicar que se han eliminado las preferencias
    $preferenciasEliminadas = true;
}

// Función para mostrar un valor de preferencia o un texto por defecto
function mostrarPreferencia($clave, $defecto = "No establecido") {
    return isset($_SESSION[$clave]) && !empty($_SESSION[$clave]) ? $_SESSION[$clave] : $defecto;
}

// Traducir valores de "y" y "n" a "Sí" y "No" para el perfil
function traducirPerfil($valor) {
    if ($valor === 'y') return 'Sí';
    if ($valor === 'n') return 'No';
    return $valor;
}

// Verificar si hay preferencias guardadas
$hayPreferencias = isset($_SESSION['idioma']) || isset($_SESSION['perfil']) || isset($_SESSION['zonaHoraria']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Preferencias</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            color: #444;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .mensaje {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
        }
        .no-preferencias {
            background-color: #fff3cd;
            color: #856404;
            padding: 10px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .acciones {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #ddd;
        }
        .enlace {
            display: inline-block;
            margin-left: 10px;
            padding: 8px 15px;
            background-color: #f8f9fa;
            color: #007bff;
            text-decoration: none;
            border-radius: 4px;
        }
        .enlace:hover {
            background-color: #e9ecef;
        }
        input[type="submit"] {
            padding: 8px 15px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <h1>Preferencias del Usuario</h1>
    
    <?php if ($preferenciasEliminadas): ?>
        <div class="mensaje">Información de la sesión eliminada</div>
    <?php endif; ?>
    
    <?php if ($hayPreferencias): ?>
        <table>
            <tr>
                <th>Preferencia</th>
                <th>Valor</th>
            </tr>
            <tr>
                <td>Idioma</td>
                <td><?php echo mostrarPreferencia('idioma'); ?></td>
            </tr>
            <tr>
                <td>Perfil público</td>
                <td><?php echo traducirPerfil(mostrarPreferencia('perfil')); ?></td>
            </tr>
            <tr>
                <td>Zona horaria</td>
                <td><?php echo mostrarPreferencia('zonaHoraria'); ?></td>
            </tr>
        </table>
    <?php else: ?>
        <div class="no-preferencias">
            No hay preferencias almacenadas en la sesión.
        </div>
    <?php endif; ?>
    
    <div class="acciones">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="display:inline;">
            <input type="submit" name="borrar" value="Borrar preferencias">
        </form>
        <a href="preferencias.php" class="enlace">Establecer preferencias</a>
    </div>
</body>
</html>