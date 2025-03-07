<?php

/**
 * Generates an HTML select dropdown from a given dataset.
 *
 * @param array $data The dataset to generate the options from. Each item should be an object.
 * @param string $valueField The field name to use for the option values.
 * @param string|array $displayFields The field name(s) to use for the option display text. If an array is provided, the fields will be concatenated with a space.
 * @param string $name The name attribute for the select element.
 * @param string $selectedValue The value of the option that should be selected by default. Default is an empty string.
 * @param bool $includeEmptyOption Whether to include an empty option at the beginning of the dropdown. Default is false.
 */
function selectDBObject($data, $valueField, $displayFields, $name, $selectedValue = '', $includeEmptyOption = false)
{
    echo "<select name='$name'>";
    if ($includeEmptyOption) {
        echo "<option value=''></option>";
    }
    foreach ($data as $item) {
        $value = $item->__get($valueField);
        $display = is_array($displayFields) ? implode(' ', array_map(function ($field) use ($item) {
            return $item->__get($field);
        }, $displayFields)) : $item->__get($displayFields);
        $selected = ($value == $selectedValue) ? "selected" : "";
        echo "<option value='$value' $selected>$display</option>";
    }
    echo "</select>";
}
?>
<!-- Ejemplo de uso -->
<fieldset>
    <legend>Selecciona el cliente</legend>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="f1">
        <?php
        selectDBObject($clienteDao->clientess, 'NIF', ['Nombre', 'Apellido1', 'Apellido2'], 'Cliente', $cliente, true);
        ?>
    </form>
</fieldset>

<!-- Procesar pedido -->
<?php
if (isset($_POST['Pedir'])) {
    $cantidad = $_POST['cantidad'];
    $checkbox = $_POST['checkbox'];
    $disponible = $_POST['disponible'];
    $Cliente = $_POST['Cliente'];
    foreach ($checkbox as $key => $value) {
        $row = array();
        $row[] = $key;
        $row[] = $disponible[$key];
        $_SESSION['carrito'][$key] = $row;
    }
    header('Location: carrito.php');
}
?>

<!-- Mostrar productos encontrados -->
<?php
if (isset($_POST['Buscar'])) {
    $productoDao = new Daoproducto($base);
    $nombreProducto = $_POST['nombreProducto'];
    $familia = $_POST['familia'];

    $productoDao->buscar($nombreProducto, $familia);

    $stockDAO = new Daostock($base);
    echo "<fieldset>";
    echo "<legend>Productos encontrados</legend>";
    echo "<form action='$_SERVER[PHP_SELF]' method='post' enctype='multipart/form-data' name='f2'>";
    echo "<table border='2'>";
    echo "<th>Seleccionar</th><th>Nombre</th><th>PVP</th><th>Cantidad Disponible</th><th>Cantidad Pedida</th>";
    foreach ($productoDao->productos as $key => $value) {
        $total = $stockDAO->totalProducto($value->cod);

        echo "<tr>";
        echo "<td><input type='checkbox' name='checkbox[$value->cod]'></td>";
        echo "<td>" . htmlspecialchars($value->nombre) . "</td>";
        echo "<td>" . htmlspecialchars($value->PVP) . "</td>";
        echo "<td><input type='number' name='cantidad[$value->cod]' value='$total' readonly></td>";
        echo "<td><input type='number' name='disponible[$value->cod]'></td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<input type='hidden' name='Cliente' value='$cliente'>";
    echo "<input type='submit' name='Pedir' value='Pedir'>";
    echo "</form>";
    echo "</fieldset>";
}
?>


<?php
function Bloqueado($usu)
{
    global $db;

    $bloqueado = FALSE;  // Suponemos por defecto que no está bloqueado

    $consulta = "SELECT Hora, Acceso 
                 FROM login
                 WHERE Usuario = :Usuario
                 ORDER BY Hora DESC
                 LIMIT 3";

    $param = array();
    $param[":Usuario"] = $usu;

    $db->ConsultaDatos($consulta, $param);

    $filas = $db->filas; // Guardamos en un array local las filas

    $bloqueado = -1;  // Suponemos por defecto que no está bloqueado

    $tiempoBloqueoBase = 300; // Tiempo base de bloqueo en segundos

    if (TresDeneg($filas)) { // Si tiene tres denegaciones podría estar bloqueado
        $intervalo = 300;  // Fijamos el intervalo de tiempo en 300 segundos

        if (MenorInterv($filas, $intervalo)) { // Si las ha cometido dentro de ese intervalo de tiempo
            $intentosFallidos = isset($_SESSION['intentosFallidos'][$usu]) ? $_SESSION['intentosFallidos'][$usu] : 0;
            $tiempoBloqueo = $tiempoBloqueoBase * pow(2, $intentosFallidos); // Incrementamos el tiempo de bloqueo exponencialmente
            $bloqueado = $filas[0]['Hora'] + $tiempoBloqueo;  // Almacenamos la hora hasta la que se encuentra bloqueado
        }
    }

    return $bloqueado;
}
?>

<?php
function InsertarLogin($usu, $cla, $acceso)
{
    global $db;

    // Incrementar el contador de intentos fallidos si el acceso es denegado
    if ($acceso == "D") {
        if (!isset($_SESSION['intentosFallidos'][$usu])) {
            $_SESSION['intentosFallidos'][$usu] = 1;
        } else {
            $_SESSION['intentosFallidos'][$usu]++;
        }
    } else {
        // Resetear el contador de intentos fallidos si el acceso es correcto
        $_SESSION['intentosFallidos'][$usu] = 0;
    }

    $consulta = "INSERT INTO login (Usuario, Clave, Hora, Acceso) VALUES (:Usuario, :Clave, :Hora, :Acceso)";

    $param = array(
        ":Usuario" => $usu,
        ":Clave" => $cla,
        ":Hora" => time(),  // Cogemos la hora actual Epoch
        ":Acceso" => $acceso
    );

    $db->ConsultaSimple($consulta, $param);
}
?>

<?php
if (isset($_POST['Enviar'])) {
    $usu = $_POST['Usuario'];
    $cla = sha1($_POST['Clave']); // Cogemos la clave pero aplicándole el cifrado correspondiente

    $bloqueado = Bloqueado($usu); // Comprobamos si está bloqueado

    if ($bloqueado == -1) { // Si no está bloqueado le dejamos hacer un intento de login
        $fila = IntentoLogin($usu, $cla);

        if ($fila['cuenta'] == 1) { // Hay coincidencia para ese usuario y esa clave
            echo "<b> Login correcto!!!</b>";
            InsertarLogin($usu, $cla, "C");
            $_SESSION['usuario'] = $usu;  // Creamos la variable de sesión para ese usuario
            header('Location: Menu.php');
        } else {
            echo "<b> Usuario/Clave incorrecto </b>";
            InsertarLogin($usu, $cla, "D");
        }
    } else { // Está bloqueado hasta una hora concreta 
        $campos = getdate($bloqueado); // Convertimos la hora de bloqueo a formato legible
        $hora = $campos['hours'] . ":" . $campos['minutes'] . ":" . $campos['seconds'];
        $dia = $campos['mday'] . "/" . $campos['mon'] . "/" . $campos['year'];
        echo "<b>El usuario $usu está bloqueado hasta las $hora del día $dia</b>";
    }
}

/**
 * Verifica si el usuario está autenticado
 * @return bool True si está autenticado, False si no
 */
function isAuthenticated() {
    return isset($_SESSION['Usuario']);
}

/**
 * Redirige a la página de login si el usuario no está autenticado
 */
function requireAuthentication() {
    if (!isAuthenticated()) {
        header("Location: login1.php");
        exit(); // Importante para detener la ejecución después de redireccionar
    }
}

/**
 * Cierra la sesión actual del usuario
 */
function logout() {
    // Eliminar todas las variables de sesión
    $_SESSION = array();
    
    // Eliminar la cookie de sesión si existe
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    // Destruir la sesión
    session_destroy();
    
    // Redirigir al login
    header("Location: login1.php");
    exit();
}