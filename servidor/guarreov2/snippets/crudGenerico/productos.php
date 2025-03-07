<?php
require_once 'LibreriaPDO.php';
require_once 'CRUDGenerico.php';

date_default_timezone_set('UTC');

$db = new DB("MiBaseDeDatos");

// Configuración para la tabla Productos
$config = [
    'primaryKey' => 'IdProducto',
    'dateFields' => ['FechaCreacion', 'FechaModificacion'],
    'imageFields' => ['Imagen'],
    'readOnlyFields' => ['IdProducto', 'FechaCreacion']
];

// Crear instancia del CRUD para la tabla Productos
$crud = new CRUDGenerico($db, "Productos", $config);

// Procesar operaciones CRUD
$crud->insert();
$crud->delete();
$crud->update();
$crud->configPagination();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Gestión de Productos</title>
    <!-- Estilos CSS aquí -->
</head>
<body>
    <h1>Gestión de Productos</h1>
    <?php $crud->render(); ?>
</body>
</html>