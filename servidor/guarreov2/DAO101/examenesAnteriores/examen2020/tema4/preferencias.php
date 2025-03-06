<?php
session_start();

$idiomas = ['ingles', 'spanish'];
$perfiles = ['y', 'n'];
$zonasHorarias = ['gmt-2', 'gmt-1', 'gmt', 'gmt+1', 'gmt+2'];
$preferenciasGuardadas = false;


if (isset($_POST['guardar'])) {

    if (isset($_POST['idioma'])) {
        $_SESSION['idioma'] = $_POST['idioma'];
    }
    if (isset($_POST['perfil'])) {
        $_SESSION['perfil'] = $_POST['perfil'];
    }
    if (isset($_POST['zonaHoraria'])) {
        $_SESSION['zonaHoraria'] = $_POST['zonaHoraria'];
    }


    $preferenciasGuardadas = true;
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preferencias</title>
    <style>
        .mensaje-exito {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
        }

        form {
            margin-top: 20px;
        }

        label,
        select {
            margin-bottom: 10px;
            display: inline-block;
        }

        input[type="submit"] {
            margin-top: 15px;
            padding: 5px 10px;
        }

        a {
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <?php if ($preferenciasGuardadas) : ?>
        <p class="mensaje-exito">Preferencias guardadas</p>
    <?php endif; ?>


    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">


        <label for="idioma">Idioma</label>
        <select name="idioma" id="idioma">
            <option value=""></option>
            <?php foreach ($idiomas as $idioma) : ?>
                <option value="<?php echo $idioma ?>" <?php echo (isset($_SESSION['idioma']) && $_SESSION['idioma'] == $idioma) ? 'selected' : '' ?>><?php echo $idioma ?></option>
            <?php endforeach; ?>


        </select>
        <br>
        <label for="perfil">Perfil publico</label>
        <select name="perfil" id="perfil">
            <option value=""></option>
            <?php foreach ($perfiles as $perfil) : ?>
                <option value="<?php echo $perfil ?>" <?php echo (isset($_SESSION['perfil']) && $_SESSION['perfil'] == $perfil) ? 'selected' : '' ?>><?php echo $perfil ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label for="zonaHoraria">Zona horaria</label>
        <select name="zonaHoraria" id="zonaHoraria">
            <option value=""></option>
            <?php foreach ($zonasHorarias as $zonaHoraria) : ?>
                <option value="<?php echo $zonaHoraria ?>" <?php echo (isset($_SESSION['zonaHoraria']) && $_SESSION['zonaHoraria'] == $zonaHoraria) ? 'selected' : '' ?>><?php echo $zonaHoraria ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <input type="submit" value="Guardar preferencias" name="guardar">
        <a href="mostrar.php">Mostrar preferencias</a>
    </form>
</body>

</html>