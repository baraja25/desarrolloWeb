<?php
session_start();  // Iniciamos sesión para poder almacenar variables de sesión

require_once 'DaoPedidos.php';
require_once 'DaoDetPedidos.php';
require_once 'DaoProductos.php';

$base = "tienda";

$daoDetPed = new DaoDetPedidos($base);
$daoPro = new DaoProductos($base);

function InsertarDetPed($IdPed, $selec, $cantidad)
{
    global $daoDetPed;     
    
    foreach ($selec as $clave => $valor)   // Iteramos sobre las claves de los productos pedidos
    {
        $detpedido = new DetPedido();
        $detpedido->__set("IdPed", $IdPed);
        $detpedido->__set("IdPro", $clave);
        $detpedido->__set("Cantidad", $cantidad[$clave]);
        $daoDetPed->insertar($detpedido); 
    }
}

function StockSuficiente($selec, $disponible, $cantidad)    // Indica si tenemos stock suficiente para el pedido realizado
{
    $suficiente = TRUE; // Suponemos por defecto que sí tenemos stock suficiente
   
    foreach ($selec as $clave => $valor)   // Iteramos sobre las claves de los productos pedidos
    {
        if ($cantidad[$clave] > $disponible[$clave])   // Si la cantidad pedida es mayor que la disponible
        {
            $suficiente = FALSE;
            break;
        }
    }
    
    return $suficiente; 
}

function MostrarCesta()     // Mostramos la cesta con los productos
{
    global $daoPro;
    
    echo "<fieldset><legend>Cesta de la compra</legend>";
    echo "<table border='2'>";
    echo "<th>Marcar</th>";
    echo "<th>Producto</th>";
    echo "<th>Cantidad Pedida</th>";
    echo "<th>PVP</th>";
    echo "<th>Subtotal</th>";
    
    $total = 0;
    
    foreach ($_SESSION['Cesta'] as $clave => $valor)
    {
        $pro = $daoPro->obtener($clave);  // Obtenemos un objeto con los datos de ese producto
        $total += ($pro->__get("PVP") * $valor);
        
        echo "<tr>";
        echo "<td><input type='checkbox' name='Marcados[$clave]'></td>";
        echo "<td>" . htmlspecialchars($pro->__get("nombre")) . "</td>";
        echo "<td><input type='number' name='CantCesta[$clave]' value='$valor'></td>";
        echo "<td>" . htmlspecialchars($pro->__get("PVP")) . "</td>";
        echo "<td>" . htmlspecialchars($pro->__get("PVP") * $valor) . "</td>";
        echo "</tr>";
    }
    
    // Añadimos una fila final con el total
    echo "<tr>";
    echo "<td colspan='5' align='right'><b>Total: $total</b></td>";
    echo "</tr>";
    
    echo "</table>";
    echo "<a href='Pedidos.php'>Continuar comprando</a>&nbsp;&nbsp;&nbsp;";
    echo "<input type='submit' name='Borrar' value='Borrar'>";
    echo "<input type='submit' name='Actualizar' value='Actualizar'>";
    echo "<input type='submit' name='Vaciar' value='Vaciar'><br>";
    echo "<input type='submit' name='Confirmar' value='Confirmar Pedido'>";
    echo "</fieldset>";
}

if (isset($_POST['Selec']))      // Si hemos recibido productos seleccionados de la página Pedidos.php   
{
    $selec = $_POST['Selec'];            // Recogemos el array con los códigos de los productos pedidos
    $disponible = $_POST['Disponible'];  // Recogemos el array con las cantidades disponibles para ese producto
    $cantidad = $_POST['Cantidad'];      // Recogemos el array con las cantidades pedidas para ese producto
    
    if (StockSuficiente($selec, $disponible, $cantidad))    // Si hay stock suficiente pasamos a tramitar el pedido
    {
        foreach ($selec as $clave => $valor)
        {
            if (!isset($_SESSION['Cesta'][$clave]))        // Si ese producto no estaba en la cesta     
            {
                $_SESSION['Cesta'][$clave] = $cantidad[$clave];   // Insertamos en la cesta el código de ese producto y la cantidad pedida
            }
            else  // Ese producto ya estaba en la cesta 
            {
                $_SESSION['Cesta'][$clave] += $cantidad[$clave];  // Incrementamos su cantidad
            }
        }
    }
    else
    {
        echo "Revise las cantidades, ha pedido más de lo que tenemos disponible.";
        echo "<meta http-equiv='refresh' content='3; url=Pedidos.php'>";
    }
}

if (isset($_POST['Borrar']))     // Hemos pulsado en borrar un producto de la cesta
{
    if (isset($_POST['Marcados']))  // Y hemos marcado algún producto
    {
        $marcados = $_POST['Marcados'];  // Recogemos los códigos de los productos marcados
        
        foreach ($marcados as $clave => $valor)
        {
            unset($_SESSION['Cesta'][$clave]); // Eliminamos ese producto de la cesta  
        }
    }
    else 
    {
        echo "<b>ERROR, Debe primero seleccionar un producto para borrar</b>";   
    }
}

if (isset($_POST['Actualizar']))     // Hemos pulsado en actualizar un producto de la cesta
{
    if (isset($_POST['Marcados']))  // Y hemos marcado algún producto
    {
        $marcados = $_POST['Marcados'];  // Recogemos los códigos de los productos marcados
        $cantcesta = $_POST['CantCesta'];  // Recogemos las cantidades de la cesta
        
        foreach ($marcados as $clave => $valor)
        {
            $_SESSION['Cesta'][$clave] = $cantcesta[$clave]; // Actualizamos el valor de la sesión con el del campo de texto
        }
    }
    else
    {
        echo "<b>ERROR, Debe primero seleccionar un producto para actualizar su cantidad</b>";
    }
}

if (isset($_POST['Vaciar']))     // Hemos pulsado en vaciar la cesta
{
    unset($_SESSION['Cesta']);
    session_destroy();
}

if (isset($_SESSION['Cesta']) && !empty($_SESSION['Cesta']))    // Ya hay creada una cesta con productos,
{
    MostrarCesta();
}
else
{
    echo "<p>No hay productos en la cesta.</p>";
}
?>
   </form>
 </body>
</html>