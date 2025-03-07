<?php
require_once 'Database.php';
require_once 'CRUDGenerico.php';

date_default_timezone_set('UTC');

$db = new Database();

// Configuración para la tabla Coches
$config = [
    'primaryKey' => 'Id',
    'dateFields' => ['FechaFund'],
    'imageFields' => ['Logo'],
    'readOnlyFields' => ['Id']
];

// Crear instancia del CRUD para la tabla coches
$crud = new CRUDGenerico($db, "equipos", $config);

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
    <title>CRUD Genérico - Concesionario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        fieldset {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
        }
        input[type="submit"] {
            margin-right: 10px;
            padding: 5px 10px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
        }
        a {
            text-decoration: none;
            padding: 3px 6px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <h1>CRUD Genérico - Concesionario</h1>
    <?php $crud->render(); ?>
</body>
</html>