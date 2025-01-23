<?php
$menuHTML = '';
$jsonOutput = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y validar los datos del formulario
    $titulo = trim($_POST['titulo']);
    $elementos = trim($_POST['elementos']);
    $tipoLista = $_POST['tipo_lista'];

    // Validar que el título no esté vacío
    if (empty($titulo)) {
        $error = "El título del menú es obligatorio.";
    } elseif (empty($elementos)) {
        $error = "Los elementos del menú son obligatorios.";
    } else {
        // Crear el array de elementos
        $elementosArray = array_map('trim', explode(',', $elementos));

        // Construir el menú HTML
        $menuHTML = '<' . $tipoLista . '>';
        foreach ($elementosArray as $elemento) {
            $menuHTML .= '<li>' . htmlspecialchars($elemento) . '</li>';
        }
        $menuHTML .= '</' . $tipoLista . '>';

        // Crear el array asociativo
        $menuArray = [
            'titulo' => $titulo,
            'elementos' => $elementosArray
        ];

        // Convertir el array a formato JSON
        $jsonOutput = json_encode($menuArray, JSON_PRETTY_PRINT);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de Menú</title>
</head>
<body>
<h1>Generador de Menú</h1>
<form method="post" action="">
    <label for="titulo">Título del Menú:</label><br>
    <input type="text" id="titulo" name="titulo" ><br><br>

    <label for="elementos">Elementos del Menú (separados por comas):</label><br>
    <textarea id="elementos" name="elementos" ></textarea><br><br>

    <label for="tipo_lista">Tipo de Lista:</label><br>
    <select id="tipo_lista" name="tipo_lista">
        <option value="ul">No Ordenada (&lt;ul&gt;)</option>
        <option value="ol">Ordenada (&lt;ol&gt;)</option>
    </select><br><br>

    <input type="submit" value="Generar Menú">
</form>

<?php if (isset($error)): ?>
    <p style="color: red;"><?php echo $error; ?></p>
<?php endif; ?>

<?php if (!empty($menuHTML)): ?>
    <h2><?php echo htmlspecialchars($titulo); ?></h2>
    <?php echo $menuHTML; ?>
<?php endif; ?>

<?php if (!empty($jsonOutput)): ?>
    <h3>Array Asociativo en formato JSON:</h3>
    <pre><?php echo $jsonOutput; ?></pre>
<?php endif; ?>
</body>
</html>