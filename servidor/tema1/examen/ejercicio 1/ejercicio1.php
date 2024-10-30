<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
        <label for="Nombre">Nombre: </label>
        <input type="text" name="Nombre" id="Nombre">
        <label for="Marca">Marca: </label>
        <input type="text" name="Marca" id="Marca">
        <label for="Modelo">Modelo: </label>
        <input type="text" name="Modelo" id="Modelo">
        <label for="Precio">Precio: </label>
        <input type="number" name="Precio" id="Precio">
        <input type="submit" value="Guardar" name="guardar">
        <br>

        <input type="radio" name="Disponibilidad" id="Disponibilidad" value="1" checked> Disponibles
        <input type="radio" name="Disponibilidad" id="Disponibilidad" value="2"> Vendidos
        <input type="submit" value="Mostrar" name="Mostrar">

        <?php

        function autoincrementarId($id)
        {
            $id += 1;
        }
        $productos = array();
        $productoString = array();


        if (isset($_GET['guardar'])) {
            $id = 0;
            $Nombre = $_GET['Nombre'];
            $Marca = $_GET['Marca'];
            $Modelo = $_GET['Modelo'];
            $Precio = $_GET['Precio'];

            if ($id == 0) {
                $linea = "$id:$Nombre:$Marca:$Modelo:$Precio";
                autoincrementarId($id);
            } else {
                $linea = "$id:$Nombre:$Marca:$Modelo:$Precio";
            }

            $productoString = explode(":", $linea);
        }
        ?>
        <br><br>
        <table>
            <th>Disponibles</th>
            <th></th>
            <th>Vendidos</th>
            <tr>
                <td><textarea name="AreaDisponibles" id="AreaDisponibles" rows="10">
                    <?php echo $linea ?>
                </textarea></td>
                <td><input type="submit" value=">" name="MoverDerecha">
                    <?php
                    if (isset($_GET['Mostrar'])) {
                        $radioSeleccion = $_GET['Disponibilidad'];


                        if ($radioSeleccion == 1) {
                            echo "<table border='2'>";
                            echo "<tr>";
                            echo "<th>id</th>";
                            echo "<th>nombre</th>";
                            echo "<th>marca</th>";
                            echo "<th>modelo</th>";
                            echo "<th>precio</th>";
                            echo "</tr>";
                            foreach ($productos as $key => $producto) {
                                echo "<tr>";
                                echo "$Nombre<td>$Marca</td><td>$Modelo</td><td>$Precio</td><td></td>";

                                echo "</tr>";
                            }
                            echo "</table>";
                        }


                        if ($radioSeleccion == 2) {
                        }
                    }


                    ?>
                    <input type="submit" value="<" name="MoverIzquierda">
                </td>
                <td><textarea name="AreaVendidos" id="AreaVendidos" rows="10"></textarea></td>
            </tr>
        </table>






    </form>
</body>

</html>