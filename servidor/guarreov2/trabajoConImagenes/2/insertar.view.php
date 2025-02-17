<!DOCTYPE html>
<html>

<head>
    <title>Insertar datos</title>
</head>

<body>
    <form action="insertarDatos.php" method="post" enctype="multipart/form-data">
        <select name="marca">
            <option value=" ">Selecciona una marca</option>
            <?php foreach ($marcas as $marca): ?>
                <option value="<?php echo $marca['Id'] ?>"><?php echo $marca['Nombre'] ?></option>
            <?php endforeach; ?>
        </select>
        <input type="text" name="modelo" placeholder="Modelo">
        <input type="text" name="precio" placeholder="Precio">
        <input type="text" name="matricula" placeholder="Matricula">
        <input type="text" name="fechaMatricula" placeholder="Fecha de Matricula">
        
        <select name="num_fotos" id="num_fotos" onchange="this.form.submit()">
            <option value=" ">Selecciona el número de fotos</option>
            <?php for ($i = 1; $i <= 10; $i++): ?>
                <option value="<?php echo $i ?>" <?php echo (isset($_POST['num_fotos']) && $_POST['num_fotos'] == $i) ? 'selected' : '' ?>><?php echo $i ?></option>
            <?php endfor; ?>
        </select>

        <?php
        if (isset($_POST['num_fotos']) && is_numeric($_POST['num_fotos'])) {
            $num_fotos = intval($_POST['num_fotos']);
            for ($i = 1; $i <= $num_fotos; $i++) {
                echo '<input type="file" name="foto' . $i . '"><br>';
            }
        }
        ?>
        <button type="submit" name="guardar">Guardar</button>
    </form>

</html>