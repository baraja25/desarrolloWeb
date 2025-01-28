<?php
require_once 'DaoTiendas.php';
require_once 'DaoFamilias.php';
$base = "tienda";
$daoTiendas=new DaoTiendas($base);
$daoFamilias = new DaoFamilias($base);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock</title>
</head>

<body>
    <form action="<?php echo $_SERVER["PHP_SELF"]?>" method="post">
    <label for="tienda">Tienda </label>
    <select name='tienda' id="tienda">
        <option value=''></option>
        <?php 
        
        $daoTiendas->listar();
        foreach($daoTiendas->tiendas as $tienda)
        {
            echo "<option value='".$tienda->cod."'>".$tienda->nombre."</option>";
        }
        
        ?>
    </select>
    <label for="familia">Familia </label>
    <select name='familia' id="familia">
        <option value=''></option>
        <?php
        $daoFamilias->listar();
        foreach($daoFamilias->familias as $familia)
        {
            echo "<option value='".$familia->cod."'>".$familia->nombre."</option>";
        }
        ?>
    </select>
    <input type="submit" value="Comprobar stock" name="comprobar">
    </form>
</body>

</html>

