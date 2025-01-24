<?php
$output = "";
$input = "";
if (isset($_POST['separar'])) {
    $input  = $_POST['input'];
    // Separar el contenido de input en palabras usando el guion como separador
    $output = explode('-', $input);
}

?>

    <!doctype html>
    <html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mover datos</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
    <textarea name="input" cols="30" rows="10" placeholder="Introduce texto separado por guiones..."><?php echo $input; ?></textarea>
    <input type="submit" value="Separar" name="separar">

    <table>
        <thead>
        <tr>
            <th>Palabras</th>
        </tr>
        </thead>
        <tbody>
        <?php if (isset($output) && is_array($output)): ?>
            <?php foreach ($output as $word): ?>
                <tr>
                    <td><?php echo trim($word); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</form>
</body>
</html>
