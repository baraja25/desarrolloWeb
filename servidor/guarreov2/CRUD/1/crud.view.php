<?php

/**
 * CRUD para gestión de equipos
 * 
 * Este archivo implementa operaciones CRUD (Crear, Leer, Actualizar, Eliminar)
 * para la entidad Equipo, además de funcionalidad para cambiar el orden (posición)
 * de los equipos en la clasificación.
 */

// Importar la clase EquipoDao necesaria para la gestión de datos
require_once 'equipoDao.php';

// Inicializar el objeto DAO y cargar todos los equipos
$equipoDao = new EquipoDao();
$equipoDao->listarEquipos();
$equipos = $equipoDao->equipos;

/**
 * SECCIÓN 1: OPERACIONES CRUD
 * 
 * Implementación de inserción, actualización y eliminación de equipos
 */

// Procesar la inserción de un nuevo equipo
if (isset($_POST['Insertar'])) {
    // Obtener datos del formulario con valores por defecto si no existen
    $nombre = isset($_POST['nombreNuevo']) ? $_POST['nombreNuevo'] : "";
    $fecha_fundacion = !empty($_POST['fecha_fundacionNuevo']) ?
        strtotime($_POST['fecha_fundacionNuevo']) : time();
    $presupuesto = isset($_POST['presupuestoNuevo']) ? $_POST['presupuestoNuevo'] : "";
    $puesto = isset($_POST['puestoNuevo']) ? $_POST['puestoNuevo'] : "";
    $logo = "";

    // Procesar imagen si se ha subido correctamente
    if (isset($_FILES['logoNuevo']) && $_FILES['logoNuevo']['error'] == UPLOAD_ERR_OK) {
        $logo = base64_encode(file_get_contents($_FILES['logoNuevo']['tmp_name']));
    }

    // Validar que al menos el campo nombre tenga contenido
    if (!empty($nombre)) {
        // Crear un nuevo objeto Equipo y establecer sus propiedades
        $equipo = new Equipo();
        $equipo->__set('nombre', $nombre);
        $equipo->__set('fecha_fundacion', date('Y-m-d', $fecha_fundacion));
        $equipo->__set('presupuesto', $presupuesto);
        $equipo->__set('puesto', $puesto);
        $equipo->__set('logo', $logo);

        // Guardar el equipo en la base de datos
        $equipoDao->insertar($equipo);

        // Recargar la página para ver los cambios
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    } else {
        echo "<p style='color: red;'>El nombre del equipo es obligatorio</p>";
    }
}

// Procesar la actualización de uno o más equipos
if (isset($_POST['Actualizar'])) {
    // Verificar que se han seleccionado equipos para actualizar
    if (isset($_POST['selec']) && is_array($_POST['selec'])) {
        $selec = $_POST['selec'];


        // Procesar cada equipo seleccionado
        foreach ($selec as $id => $valor) {
            // Obtener datos del formulario para este equipo
            $nombre = $_POST['nombre'][$id] ?? '';
            $fecha_fundacion = strtotime($_POST['fecha_fundacion'][$id] ?? '');
            $presupuesto = $_POST['presupuesto'][$id] ?? '';
            $puesto = $_POST['puesto'][$id] ?? '';
            $logo = "";

            // Procesar imagen si se ha subido una nueva
            if (isset($_FILES['logo']['error'][$id]) && $_FILES['logo']['error'][$id] == UPLOAD_ERR_OK) {
                $logo = base64_encode(file_get_contents($_FILES['logo']['tmp_name'][$id]));
            }

            // Crear objeto Equipo con los datos actualizados
            $equipo = new Equipo();
            $equipo->__set('id', $id);
            $equipo->__set('nombre', $nombre);
            $equipo->__set('fecha_fundacion', date('Y-m-d', $fecha_fundacion));
            $equipo->__set('presupuesto', $presupuesto);
            $equipo->__set('puesto', $puesto);
            $equipo->__set('logo', $logo); // Si está vacío, se mantendrá el actual en el método actualizar()

            // Actualizar el equipo en la base de datos
            $equipoDao->actualizar($equipo);
        }

        // Recargar la página para ver los cambios
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
}

// Procesar la eliminación de uno o más equipos
if (isset($_POST['Borrar'])) {
    // Verificar que se han seleccionado equipos para eliminar
    if (isset($_POST['selec']) && is_array($_POST['selec'])) {
        $selec = $_POST['selec'];

        // Eliminar cada equipo seleccionado
        foreach ($selec as $id => $valor) {
            $equipo = new Equipo();
            $equipo->__set('id', $id);
            $equipoDao->borrar($equipo);
        }

        // Recargar la página para ver los cambios
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
}

/**
 * SECCIÓN 2: OPERACIONES DE POSICIONAMIENTO
 * 
 * Implementación para subir o bajar equipos en la clasificación
 */

// Procesar la subida de posición de un equipo
if (isset($_POST['Subir'])) {
    // Verificar que se ha seleccionado exactamente un equipo
    if (isset($_POST['selec']) && count($_POST['selec']) == 1) {
        $selec = $_POST['selec'];
        $id = array_key_first($selec);

        // Buscar el equipo seleccionado
        $equipo = null;
        foreach ($equipoDao->equipos as $equipoItem) {
            if ($equipoItem->__get('id') == $id) {
                $equipo = $equipoItem;
                break;
            }
        }

        if ($equipo) {
            // Intentar subir el equipo de posición
            $resultado = $equipoDao->subirPuesto($equipo->__get('id'), $equipo->__get('puesto'));

            // Mostrar mensaje si no se pudo subir
            if (!$resultado) {
                echo "<script>alert('El equipo ya está en la primera posición. No se puede subir más.');</script>";
            }

            // Recargar la página para ver los cambios
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        }
    }
}

// Procesar la bajada de posición de un equipo
if (isset($_POST['Bajar'])) {
    // Verificar que se ha seleccionado exactamente un equipo
    if (isset($_POST['selec']) && count($_POST['selec']) == 1) {
        $selec = $_POST['selec'];
        $id = array_key_first($selec);

        // Buscar el equipo seleccionado
        $equipo = null;
        foreach ($equipoDao->equipos as $equipoItem) {
            if ($equipoItem->__get('id') == $id) {
                $equipo = $equipoItem;
                break;
            }
        }

        if ($equipo) {
            // Intentar bajar el equipo de posición
            $resultado = $equipoDao->bajarPuesto($equipo->__get('id'), $equipo->__get('puesto'));

            // Mostrar mensaje si no se pudo bajar
            if (!$resultado) {
                echo "<script>alert('El equipo ya está en la última posición. No se puede bajar más.');</script>";
            }

            // Recargar la página para ver los cambios
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Equipos</title>
    <style>
        /* Estilos básicos para mejorar la apariencia */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        input[type="text"],
        input[type="date"],
        input[type="number"] {
            width: 90%;
            padding: 5px;
        }

        input[type="submit"] {
            margin: 5px;
            padding: 8px 12px;
            cursor: pointer;
        }

        img {
            max-width: 100px;
            max-height: 100px;
            object-fit: contain;
        }
    </style>
</head>

<body>
    <!-- Formulario principal para todas las operaciones CRUD -->
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
        <!-- Botones de acción -->
        <div class="actions">
            <input type="submit" name="Actualizar" value="Actualizar" title="Actualizar equipos seleccionados">
            <input type="submit" name="Borrar" value="Borrar" title="Eliminar equipos seleccionados">
            <input type="submit" name="Insertar" value="Insertar" title="Insertar nuevo equipo">
            <input type="submit" name="Subir" value="Subir" title="Subir equipo seleccionado en la clasificación">
            <input type="submit" name="Bajar" value="Bajar" title="Bajar equipo seleccionado en la clasificación">
        </div>

        <!-- Tabla de equipos -->
        <table border="2">
            <thead>
                <tr>
                    <th>Selección</th>
                    <th>Nombre</th>
                    <th>Fecha de Fundación</th>
                    <th>Presupuesto</th>
                    <th>Puesto</th>
                    <th>Logo</th>
                </tr>
            </thead>
            <tbody>
                <!-- Fila para insertar nuevo equipo -->
                <tr>
                    <td><b>+</b></td>
                    <td><input type="text" name="nombreNuevo" placeholder="Nombre del equipo"></td>
                    <td><input type="date" name="fecha_fundacionNuevo"></td>
                    <td><input type="text" name="presupuestoNuevo" placeholder="Presupuesto en €"></td>
                    <td><input type="text" name="puestoNuevo" placeholder="Puesto (opcional)"></td>
                    <td><input type="file" name="logoNuevo" accept="image/*"></td>
                </tr>

                <!-- Filas con equipos existentes -->
                <?php foreach ($equipos as $equipo): ?>
                    <tr>
                        <td>
                            <input type="checkbox" name="selec[<?php echo $equipo->__get('id') ?>]">
                        </td>
                        <td>
                            <input type="text" name="nombre[<?php echo $equipo->__get('id') ?>]"
                                value="<?php echo $equipo->__get('nombre') ?>">
                        </td>
                        <td>
                            <input type="date" name="fecha_fundacion[<?php echo $equipo->__get('id') ?>]"
                                value="<?php echo date('Y-m-d', $equipo->__get('fecha_fundacion')) ?>">
                        </td>
                        <td>
                            <input type="text" name="presupuesto[<?php echo $equipo->__get('id') ?>]"
                                value="<?php echo $equipo->__get('presupuesto') ?>">
                        </td>
                        <td>
                            <input type="number" name="puesto[<?php echo $equipo->__get('id') ?>]"
                                value="<?php echo $equipo->__get('puesto') ?>">
                        </td>
                        <td>
                            <?php if ($equipo->__get('logo')): ?>
                                <img src="data:image/png;base64,<?php echo $equipo->__get('logo'); ?>"
                                    alt="Logo de <?php echo $equipo->__get('nombre'); ?>">
                            <?php endif; ?>
                            <input type="file" name="logo[<?php echo $equipo->__get('id') ?>]" accept="image/*">
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </form>
</body>

</html>