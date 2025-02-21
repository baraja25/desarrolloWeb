<?php

/**
 * Funciones genericas
 */
//Regargar Página
/* <?php echo $_SERVER['PHP_SELF'] ?> */


/**
 * Seleccionar radio Butom
 *
 * <input type="radio" name="Opc" value="Union" 
 * <?php if ($Opc == "Union") { echo "checked"; } ?>
 * >
 */




/**
 * Se introduce un array Unidimensional y se devuelve un select con los valores pasados por el array
 * $name corresponde al nombre que tendrá el select
 * $valor tendrá el valor anterior del formulario, si no lo tiene será ''
 * $tipo: Si introduces 0 pondrá como valor la $key del array
 * ****** Si introduces 1 pondrá como valor el $value del array
 */
function selectDinamico($array, $name, $valorIni, $tipo, $envioAutomatico = false)
{
    if ($envioAutomatico) {
        echo "<select name='$name' onchange='this.form.submit();'";
    } else {
        echo "<select name='$name' ";
    }
    echo "<option value=''></option>";
    //Recorremos el array
    foreach ($array as $key => $valor) {
        //Si el tipo es 0 el value será la clave del array
        if ($tipo === 0) {
            $value = $key;
        }
        //En caso contrario el value será el valor del array
        else {
            $value = $valor;
        }

        echo "<option value='$value'" . (($valorIni == $value) ? 'selected' : '') . ">$valor</option>";
    }
    echo "</select>";
}

function selectDinamicoColumna($array, $name, $valorIni, $tipo, $columnaValor, $columnaId, $envioAutomatico = false)
{
    if ($envioAutomatico) {
        echo "<select name='$name' onchange='this.form.submit();'";
    } else {
        echo "<select name='$name' ";
    }
    echo "<option value=''></option>";
    //Recorremos el array
    foreach ($array as $key => $valor) {
        //Si el tipo es 0 el value será la clave del array
        if ($tipo === 0) {
            $value = $key;
        }
        //En caso contrario el value será el valor del array
        else {
            $value = $valor[$columnaValor];
        }

        echo "<option value='$valor[$columnaId]'" . (($valorIni == $valor[$columnaId]) ? 'selected' : '') . ">$valor[$columnaValor]</option>";
    }
    echo "</select>";
}
/**
 * Introduces el array bidimensional, el separador entre lineas y el separador entre columnas y lo convierte en un String
 */

function ArrayBidi_String($bidimensional, $separadorLineas, $separadorColumnas)
{
    $String = "";
    foreach ($bidimensional as $key => $unidimensional) {
        (($String == "") ? $String = implode($separadorColumnas, $unidimensional) . $separadorLineas : $String .= (implode($separadorColumnas, $unidimensional)) . $separadorLineas);
    }
    return $String;
}

/**
 * Introduces un string y lo convierte en un array bidimensional
 */
function String_ArrayBidi($string, $separadorLineas, $separadorColumnas)
{
    //Para evitar que se devuelva una posición vacia en el array si el estring está vacio
    if ($string != "") {
        $bidimensionalArray = array();
        //Se sacan las lineas en un array
        $lineas = explode($separadorLineas, $string);
        //ahora se recorre el array lineas
        foreach ($lineas as $key => $linea) {
            //Por cada linea se hace el explode para sacar los campos de las lineas
            $bidimensionalArray[] = explode($separadorColumnas, $linea);
        }
        //Retornamos el array
        return $bidimensionalArray;
    }
}


/**
 * Convierte un array unidimensional o bidimensional en una tabla HTML
 * @param array $array Array unidimensional o bidimensional
 * @param string|array $arrayTH Cabecera de la tabla, puede ser un string o un array
 * @param string $input Si es "c" pone un checkbox en la parte izquierda de la tabla, si es "t" pone un input de texto, si es "a" pone un enlace
 * @param string $inputName Si input es "c" o "t", este es el nombre del input
 * @return string La tabla HTML
 */
function tablaString($array, $arrayTH, $input = "", $inputName = "select[]")
{
    //Si el array es unidimensional
    if (gettype($array[array_keys($array)[0]]) != "array") {
        // echo "Es unidimensional";
        echo "<table border='1'>";
        //Si es un array
        if (gettype($arrayTH) == "array") {
            //Si es un array bidimensional
            // if (gettype($arrayTH[array_keys($arrayTH)[0]]) == "array") {
            foreach ($arrayTH as $linea) {
                if (gettype($linea) == "array") {
                    foreach ($linea as $campo) {
                        echo "<tr>";
                        echo "<th>";
                        echo $campo;
                        echo "</th>";
                        echo "</tr>";
                    }
                } else {
                    // echo "<tr>";
                    echo "<th>";
                    echo $linea;
                    echo "</th>";
                    // echo "</tr>";
                }
            }
            // }

        } else {

            echo "<th>";
            echo $arrayTH;
            echo "</th>";
        }
        foreach ($array as $key => $value) {
            # code...
            echo "<tr>";
            echo "<td>";
            //Si input es a crea un enlace donde el valor es el enlace
            if ($input == "a") {
                echo "<a href='$_SERVER[PHP_SELF]?valor=$key'>";
            }
            echo $value;
            if ($input == "a") {
                echo "</a>";
            }
            echo "</td>";
            echo "</tr>";
        }

        echo "</table>";
    }
    //Si el array es bidimensional
    else {

        echo "<table border='1'>";

        if (gettype($arrayTH) == "array") {
            //Si es un array bidimensional
            // if (gettype($arrayTH[array_keys($arrayTH)[0]]) == "array") {
            foreach ($arrayTH as $linea) {
                if (gettype($linea) == "array") {
                    echo "<tr>";
                    foreach ($linea as $campo) {
                        echo "<th>";
                        echo $campo;
                        echo "</th>";
                    }
                    echo "</tr>";
                } else {
                    // echo "<tr>";
                    echo "<th>";
                    echo $linea;
                    echo "</th>";
                    // echo "</tr>";
                }
            }
            // }

        } else {

            echo "<th colspan='2'>";
            echo $arrayTH;
            echo "</th>";
        }
        foreach ($array as $key => $linea) {
            echo "<tr>";
            if ($input == "c") {
                echo "<td>";
                echo "<input type='checkbox' name='$inputName' value='$key'>";
                echo "</td>";
            }
            foreach ($linea as $key2 => $campo) {
                echo "<td>";
                echo $campo;
                echo "</td>";
            }
            if ($input == "t") {
                echo "<td>";
                echo "<input type='text' name='$key'>";
                echo "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
}

/**
 * Función para extraer un archivo y pasarlo a un array Unidimensional
 * 
 */
function fichero_Array($Archivo)
{
    //Si el archivo existe pasa
    if (file_exists($Archivo)) {
        //Abrirmos el archivo 
        $fd = fopen($Archivo, "r") or die("El archivo $Archivo no se pudo abrir");
        //Inicializamos el array
        $arrayArchivo = array();
        //Recorremos el array hasta que se acaben las lineas
        while (!feof($fd)) {
            //Introducimos la linea en el array
            $arrayArchivo[] = fgets($fd);
        }
        //Cerramos el stream
        fclose($fd);
    } else {
        //En caso contrario le decimos que no existe y devolvemos false
        echo "El archivo $Archivo No existe";
        $arrayArchivo = false;
    }
    return $arrayArchivo;
}

/**
 * Introduce la ruta a un archivo y devuelve un array bidimensional con los elementos por campos
 * Si no existe la ruta del archivo devuelve falso
 * El separador de campos es para poder separar las lienas correctamente
 * Key es para identificar cada linea con la clave deseada
 * Ten en cuenta que si la clave se repite borrará los que son iguales
 */
function fichero_arrayBidi($pathArchivo, $separadorCampos, $key)
{
    //Si la ruta existe entra
    if (file_exists($pathArchivo)) {
        $arraySalida = array();
        //Abrirmos el stream
        $fd = fopen($pathArchivo, "r") or die("No se ha podido leer el archivo $pathArchivo");
        $indiceError = false;
        //Recorremos hasta que se acaben las lineas o el inidce sea incorrecto
        while (!feof($fd) && !$indiceError) {
            //leeamos la linea
            $linea = rtrim(fgets($fd));
            if (!empty($linea)) {
                # code...
                //Realiamos el explode a un array
                $arrayLinea = explode($separadorCampos, $linea);
                //Si los indices son correctos entra
                //echo "<b>".count($arrayLinea)."</b>";
                if ($key < count($arrayLinea) && $key >= 0) {
                    //Se introduce el array el el otro array con la clave del campo pedido por el usuario
                    // if ($arrayLinea!=false) {
                    # code...
                    $arraySalida[$arrayLinea[$key]] = $arrayLinea;
                    // }
                } else {
                    //Se muestra un error 
                    echo "$key no es correcto, se sale del indice del array<br>";
                    $indiceError = true;
                }
            }
        }
        fclose($fd);
    }
    //En caso contrario devuelve falso
    else {
        $arraySalida = false;
    }
    //Retornamos valor
    return $arraySalida;
}

/**
 * Introducimos una arrray bidimensional y lo metemos en un fichero de error
 * @param $arrayBidi array para meter
 * @param $pathArchivo Path archivo
 * @param $separadorCampos (El separador que tendrán los campos al hacer el implode del array)
 * @param $modo Modo escrtura o lectura o ambos (r,w,a+)
 */
function arrayBidi_fichero($arrayBidi, $pathArchivo, $separadorCampos, $modo)
{

    $fd = fopen($pathArchivo, $modo);

    foreach ($arrayBidi as $key => $arrayUni) {
        $linea = implode($separadorCampos, $arrayUni);
        fputs($fd, $linea);
    }
    fclose($fd);
}


/**
 * Introduce un array y el nombre y te crea un radioButtom dinamico
 */
function radioDinamico($array, $name)
{
    foreach ($array as $key => $value) {
        echo "<input type='radio' name='$name' value='$value'>$value";
    }
}


/**
 * Ordena el array bidimensional, se introduce el array bidimensional y el campo por el que se va a ordenar,
 * el modo puede ser "a" para ordenar de manera ascendente, y "d" para ordenar de manera descendente.
 * A demás se puede indicar la clave que se va a tener en el array, por defecto es 0.
 * En caso de que el campo sea incorrecto se muestra un mensaje y se sale del programa.
 */
function ordenarArrayBidimensional($arrayBidi, $campo, $modo, $clave = 0)
{

    if (count($arrayBidi) >= $campo && $campo < 0) {
        echo "Se salió del indice del array";
    } else {
        $arrayKeys = array();
        foreach ($arrayBidi as $key => $lineaArray) {
            $lineaString = implode(":", $lineaArray);
            $arrayKeys[$lineaString] = $lineaArray[$campo];
        }
        if ($modo == "a") {
            asort($arrayKeys);
        } elseif ($modo == "d") {
            arsort($arrayKeys);
        }
        $arrayBidi = array();

        $arrayOrdenado = array_keys($arrayKeys);
        foreach ($arrayOrdenado as $key => $lineaArray) {
            $linea = explode(":", $lineaArray);
            $arrayBidi[$linea[$clave]] = $linea;
        }
    }
    return $arrayBidi;
}


/**
 * Conecta con una base de datos
 * @param string $database nombre de la base de datos a conectar
 * @return resource la conexi n a la base de datos
 */
function conectarBD($database)
{
    //Inicializamos los datos necesarios para conectar la base de datos
    $host = "localhost";
    $user = "root";
    $pass = "";
    // $database = "tema2";
    //Conectamos con la base de datos
    $db = mysqli_connect($host, $user, $pass, $database);
    return $db;
}



/**
 * Muestra una tabla con los datos de una consulta SQL y 
 * su correspondiente paginación numerada
 * 
 * @param string $consulta consulta SQL que se va a ejecutar
 * @param int $numeroMostrar numero de filas que se van a mostrar
 * @param array $arrayTH Array de titulos de las columnas
 * @param int $actual pagina actual
 * @param int $valor campo por el que se va a ordenar
 * @param string/int $clave que quieres usar para que los check tengan ese valor. Ejemplo NIF, ID, etc
 */
function paginacionNumerada($consulta, $numeroMostrar = 4, $arrayTH = "", $actual = 1, $valor = 1, $input = "", $inputName = "select[]", $clave = 0)
{
    //Busco el numero de entradas que tiene la tabla alumno
    $numAlumnosConsulta = "SELECT COUNT(*) as total FROM alumnos";
    $numAlu = consultaDatos($numAlumnosConsulta)[0];
    // echo "$valor";
    // echo "$actual";
    $inicio = ceil((intval($actual) - 1) * $numeroMostrar);
    // echo "Inicio: $inicio<br>";
    $consulta .= " order by $valor LIMIT $inicio, $numeroMostrar";
    // echo "<br>$consulta<br>";
    $array = consultaDatos($consulta);
    if ($arrayTH == "") {
        $arrayTH = array_keys($array[0]);
    }
    // echo $numAlu['total'];
    tablaStringEnlaces($array, $arrayTH, $input, $inputName, true, $actual, $numeroMostrar, $consulta, $clave);
    //tablaString($array, $arrayTH,"","",true);
    //Menú de selecion de pagina
    $paginas = ceil($numAlu['total'] / $numeroMostrar);
    echo "<a href='$_SERVER[PHP_SELF]?pagina=1&Numero=$numeroMostrar&valor=$valor' style='width: 500px; color: black; font-weight: bold;'  > << </a>";
    for ($i = 1; $i <= $paginas; $i++) {
        if ($i != $actual) {
            echo "<a href='$_SERVER[PHP_SELF]?pagina=$i&Numero=$numeroMostrar&valor=$valor' style='width: 500px; font-weight: bold;'> $i </a>";
        } else {
            echo "<a href='$_SERVER[PHP_SELF]?pagina=$i&Numero=$numeroMostrar&valor=$valor' style='width: 500px; font-weight: bold; font-size: large;'> $i </a>";
        }
    }
    // $paginaFinal
    echo "<a href='$_SERVER[PHP_SELF]?pagina=$paginas&Numero=$numeroMostrar&valor=$valor' style='width: 500px; color: black; font-weight: bold;'>>> </a>";
}

/**
 * Crea tabla
 * Si input es c crea checkbox en la parte izquierda de la tabla, por defecto el nombre es select[]
 * Si pones $THA en true permite enlaces en la cabecera para inplementar ordenación
 * @param array $array El array a mostrar
 * @param array $arrayTH La cabecera de la tabla
 * @param string $input Si es c crea checkbox
 * @param string $inputName El nombre del checkbox
 * @param bool $THA Si es true permite enlaces en la cabecera
 * @param int $actual La página actual
 * @param int $numeroMostrar para indicarle las filas que se mostrarán
 * @param string/int $clave que quieres usar para que los check tengan ese valor. Ejemplo NIF, ID, etc
 */
function tablaStringEnlaces($array, $arrayTH, $input = "", $inputName = "select[]", $THA = false, $actual = 1, $numeroMostrar = 1, $consulta = "", $idClave = 0)
{
    // //$consulta es para devolverla en caso de que se necesite ordenación y numeroMostrar es el numero total de filas a mostrar
    // global $consulta;
    // echo "actual: $actual<br>";
    echo "<table border='1'>";
    if ($THA) {
        // echo "<th>[DEBUG]$paginaActual</th>";
        foreach ($arrayTH as $key => $value) {
            echo "<th>";
            if ($value != "select" && $value != "input") {
                echo "<a href='$_SERVER[PHP_SELF]?valor=$value&pagina=$actual&consulta=$consulta&Numero=$numeroMostrar";
                echo "'>$value</a>";
            } else {
                echo "$value";
            }
            echo "</th>";
        }
    } else {
        foreach ($arrayTH as $key => $value) {
            echo "<th>";
            echo "$value";
            echo "</th>";
        }
    }
    foreach ($array as $key => $linea) {
        echo "<tr>";
        if ($input == "c") {
            echo "<td>";
            echo "<input type='checkbox' name='$inputName' value='$linea[$idClave]'>";
            echo "</td>";
        }
        foreach ($linea as $clave => $campo) {
            echo "<td>";
            echo $campo;
            echo "</td>";
        }
        if ($input == "t") {
            echo "<td>";
            echo "<input type='text' name='$key'>";
            echo "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}



/**
 * Crea tabla
 * Si input es c crea checkbox en la parte izquierda de la tabla, por defecto el nombre es select[]
 * Si pones $THA en true permite enlaces en la cabecera para inplementar ordenación
 * @param array $array El array a mostrar
 * @param array $arrayTH La cabecera de la tabla
 * @param string $input Si es c crea checkbox
 * @param string $inputName El nombre del checkbox
 * @param bool $THA Si es true permite enlaces en la cabecera
 * @param int $actual La página actual
 * @param int $numeroMostrar para indicarle las filas que se mostrarán
 * @param string/int $clave que quieres usar para que los check tengan ese valor. Ejemplo NIF, ID, etc
 */
function tablaStringEnlacesMultiId($array, $arrayTH, $input = "", $inputName = "select[]", $THA = false, $actual = 1, $numeroMostrar = 1, $consulta = "", $idClave = array(0))
{
    // //$consulta es para devolverla en caso de que se necesite ordenación y numeroMostrar es el numero total de filas a mostrar
    // global $consulta;
    // echo "actual: $actual<br>";
    echo "<table border='1'>";
    if ($THA) {
        // echo "<th>[DEBUG]$paginaActual</th>";
        foreach ($arrayTH as $key => $value) {
            echo "<th>";
            if ($value != "select" && $value != "input") {
                echo "<a href='$_SERVER[PHP_SELF]?valor=$value&pagina=$actual&consulta=$consulta&Numero=$numeroMostrar";
                echo "'>$value</a>";
            } else {
                echo "$value";
            }
            echo "</th>";
        }
    } else {
        foreach ($arrayTH as $key => $value) {
            echo "<th>";
            echo "$value";
            echo "</th>";
        }
    }
    foreach ($array as $key => $linea) {
        $idContru = "";
        echo "<tr>";
        if ($input == "c") {
            echo "<td>";
            /**Hacemos una id con varias ids */
            foreach ($idClave as $key => $value) {
                $idContru .= $linea[$value];
            }
            echo "<input type='checkbox' name='$inputName' value='$idContru'";
            echo "'>";
            echo "</td>";
        }
        foreach ($linea as $clave => $campo) {
            echo "<td>";
            echo $campo;
            echo "</td>";
        }
        if ($input == "t") {
            echo "<td>";
            echo "<input type='text' name='$key'>";
            echo "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

/**
 * Convierte un array bidimensional en un array unidimensional 
 * Seleccionando el campo que se quiera. Si el campo es "implode" 
 * hace un implode de todos los campos del array bidimensional
 * @param array $arrayBidi Array bidimensional
 * @param string|int $idCampo ID del campo que se quiere seleccionar
 * @param string $separador Separador para el implode
 * @return array Array unidimensional
 */
function bidi_uniArray($arrayBidi, $idCampo, $separador = ",")
{
    $nuevoArray = array();
    if ($idCampo !== "implode") {
        foreach ($arrayBidi as $key => $row) {
            // echo "-".$row[$idCampo];
            $nuevoArray[] = $row[$idCampo];
        }
    } else {
        foreach ($arrayBidi as $key => $row) {
            $nuevoArray[] = implode($separador, $row);
        }
    }
    return $nuevoArray;
}

/**
 * Calcula la diferencia entre dos fechas y la muestra por pantalla
 * 
 * @param string $fechaIni Fecha inicial en formato "d-m-Y"
 * @param string $fechaFin Fecha final en formato "d-m-Y"
 * @return fechaDiferencia
 */
function diferenciaFechas($fechaIni, $fechaFin)
{
    $fechaIni = new DateTime($fechaIni);
    $fechaFin = new DateTime($fechaFin);
    $fechaDiferencia = $fechaFin->diff($fechaIni);
    // echo "La diferencia entre ambas fechas es de $fechaDiferencia->y años, $fechaDiferencia->m meses, $fechaDiferencia->d dias";
    return $fechaDiferencia;
}






/**
 * Funcion que devuelve un array con los nombres de las columnas de una tabla
 *
 * @param string $nombreDB nombre de la base de datos
 * @param string $NombreTabla nombre de la tabla
 *
 * @return array con los nombres de las columnas
 */
function obtenerNombresTablas($nombreDB, $NombreTabla)
{
    $host = "localhost";
    $usuario = "root";
    $password = "";

    try {

        $pdo = new PDO("mysql:host=$host;dbname=$nombreDB", $usuario, $password);

        # Para que genere excepciones a la hora de reportar errores.
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {

        echo $e->getMessage();
    }

    $param[':tabla'] = $NombreTabla;
    $param[':nombreDB'] = $nombreDB;

    $consulta = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME= :tabla AND TABLE_SCHEMA= :nombreDB";
    // echo $consulta;
    $sta = $pdo->prepare($consulta);
    $sta->execute($param);

    $filas = $sta->fetchAll(PDO::FETCH_ASSOC);

    $nombresTabla = array();
    foreach ($filas as $key => $value) {
        $nombresTabla[] = $value['COLUMN_NAME'];
    }

    return $nombresTabla;
}



/**
 * Crea una clase a partir de una tabla de una base de datos. La clase tendra los mismos atributos que la tabla
 * y tendra los metodos magicos __get y __set. El constructor no est  implementado
 *
 * @param string $nombreDB nombre de la base de datos
 * @param string $nombreTabla nombre de la tabla
 */
function crearClaseTabla($nombreDB, $nombreTabla)
{

    $listaColumnas = obtenerNombresTablas($nombreDB, $nombreTabla);

    echo "<h1> Clase $nombreTabla</h1> <br>";
    $nombreTabla = ucfirst($nombreTabla);
    echo "//class $nombreTabla<br>";
    echo " class $nombreTabla{<br>";

    // echo "[debug] $listaColumnas";
    foreach ($listaColumnas as $key => $value) {
        echo      "private \$$value;<br>";
    }
    echo            "function __get(\$propiedad){<br>";
    echo          "return \$this->\$propiedad;<br>";
    echo      "}<br>";
    echo            "function __set(\$propiedad, \$valor){<br>";
    echo          "\$this->\$propiedad = \$valor;<br>";
    echo      "}<br>";
    echo "}<br>";
}



/**
 * Crea una clase que extiende de DB y tiene los metodos para operar con una tabla de la base de datos.
 * Los metodos son: __construct, listar, obtener, insertar, actualizar, borrar.
 * El constructor toma como parametro el nombre de la base de datos y crea un objeto de tipo DB.
 * La clase tiene un array de objetos de la clase $nombreClass que se llama $nombreTabla y se
 * utiliza para guardar los objetos devueltos por los metodos.
 *
 * @param string $nombreDB nombre de la base de datos
 * @param string $nombreTabla nombre de la tabla
 */
function crearClasePDO($nombreDB, $nombreTabla)
{

    $primaryKey = obtenerPrimaryKeyTabla($nombreDB, $nombreTabla);
    echo "<h1> Clase $nombreTabla\PDO</h1> <br>";
    //Nombre para la clase que se instancia
    $nombreClass = ucfirst($nombreTabla);
    //Obtenemos el nombre de las tablas
    $nombreColumnas = obtenerNombresTablas($nombreDB, $nombreTabla);

    echo  "//Revisar la situación del path<br>";
    echo 'require_once("../../libreriaPDO.php");<br>';
    echo "require_once(\"./" . $nombreClass . "Class.php\");<br>";

    echo "class Dao" . $nombreTabla . " extends DB";
    echo "<br>";
    echo "{";
    echo "<br>";

    echo "public \$" . $nombreTabla . "s = array();"; //Un array de objetos de el tipo situacioes
    echo "<br>";

    echo "/**";
    echo "<br>";
    echo  "* Constructor de la clase. Llama al constructor de la clase DB.";
    echo "<br>";
    echo  "* @param string \$base nombre de la base de datos";
    echo "<br>";
    echo  "*/";
    echo "<br>";
    echo "function __construct(\$base)";
    echo "<br>";
    echo " {parent::__construct(\$base); //Llama al constructor de la clase DB<br>";
    echo "}<br>";



    echo     "public function listar()";
    echo "<br>";

    echo    " {";
    echo "<br>";
    echo         "\$consulta = 'SELECT * FROM $nombreTabla';";
    echo "<br>";
    echo        " \$this->consultaDatos(\$consulta);";

    echo "<br>";

    echo         "foreach (\$this->filas as \$fila) {";
    echo "<br>";

    //Nombre para la variable que se instancia de la clase
    $objetoTabla = substr($nombreTabla, 0, 4);
    echo            " \$$objetoTabla = new $nombreClass(); //creamos un objeto de la entidad situacion";
    echo "<br>";

    foreach ($nombreColumnas as $key => $value) {
        echo "\$" . $objetoTabla . "->__set(\"$value\", \$fila['$value']); //Le asignamos a las propiedades del objetos los campos de esa fila<br>";
    }
    echo             "\$this->" . $nombreTabla . "s[] = \$$objetoTabla; //Guardamos ese objeto en el array de objetos $objetoTabla";
    echo "<br>";
    echo         "}";
    echo "<br>";
    echo     "}";
    echo "<br>";

    echo     "/**<br>";
    echo      "* Obtiene una situacion de la base de datos por su Id.<br>";
    echo      "*<br>";
    echo      "* @param int \$Id El id de la situacion a obtener.<br>";
    echo      "* @return Situacion El objeto Situacion correspondiente al Id proporcionado<br>";
    echo      "* Si no se encuentra, se devuelve un objeto Situacion vacío.<br>";
    echo      "*/<br>";

    echo     "public function obtener(";
    for ($i = 0; $i < count($primaryKey); $i++) {
        echo "$" . $primaryKey[$i];
        if ($i !== count($primaryKey) - 1) {
            echo ",";
        }
        echo " ";
    }
    echo ")<br>";
    echo     "{<br>";

    echo         "\$consulta = \"SELECT * FROM $nombreTabla WHERE ";
    for ($i = 0; $i < count($primaryKey); $i++) {
        echo $primaryKey[$i] . "= :$primaryKey[$i]";
        if ($i !== count($primaryKey) - 1) {
            echo " AND ";
        }
        echo " ";
    }
    echo "\";<br>";

    echo         "\$param = array();<br>";
    for ($i = 0; $i < count($primaryKey); $i++) {

        echo         "\$param[\":$primaryKey[$i]\"] = \$$primaryKey[$i];<br>";
    }

    echo         "\$this->consultaDatos(\$consulta, \$param);<br>";

    echo         "\$$objetoTabla = new $nombreClass(); //creamos un objeto de la entidad $nombreClass<br>";

    echo         "if (count(\$this->filas) == 1) {<br>";
    echo           "  \$fila = \$this->filas[0];<br>";
    foreach ($nombreColumnas as $key => $value) {
        echo "\$" . $objetoTabla . "->__set(\"$value\", \$fila['$value']); //Le asignamos a las propiedades del objetos los campos de esa fila<br>";
    }
    echo         "}<br>";
    echo         "return \$$objetoTabla;<br>";
    echo     "}<br>";




    echo     "/**<br>";
    echo      "* Inserta una situacion en la base de datos<br>";
    echo      "* @param Situacion \$$objetoTabla El objeto a insertar<br>";
    echo     " * @return void<br>";
    echo      "*/<br>";
    echo     "public function insertar(\$$objetoTabla)<br>";
    echo     "{ //Se introduce un objeto por parametro que se insertará<br>";

    echo         "\$consulta = \"INSERT INTO $nombreTabla VALUES (";

    for ($i = 0; $i < count($nombreColumnas); $i++) {
        echo ":" . $nombreColumnas[$i];
        if ($i !== count($nombreColumnas) - 1) {
            echo ",";
        }
        echo " ";
    }
    echo ") \";<br>";

    echo         "\$param = array();<br>";


    //         $param[":Id"] = $situ->__Get("Id");
    //         $param[":Nombre"] = $situ->__Get("Nombre");
    foreach ($nombreColumnas as $key => $value) {
        echo "\$param[\":$value\"] =" . "\$" . $objetoTabla . "->__get(\"$value\"); //Le asignamos a las propiedades del objetos los campos de esa fila<br>";
    }

    echo         "\$this->consultaSimple(\$consulta, \$param);<br>";
    echo     "}<br>";



    echo     "/**;<br>";
    echo      "* Actualiza una situacion en la base de datos;<br>";
    echo      "* @param $nombreClass $objetoTabla El objeto a actualizar;<br>";
    echo      "* @return void;<br>";
    echo      "*/<br>";
    echo     "public function actualizar(\$$objetoTabla)<br>";
    echo     "{ //Se introduce un objeto por parametro que se insertará<br>";

    echo         "\$consulta = \" UPDATE $nombreTabla SET ";
    //En caso de que ese producto tubiera producto en tienda, aparezca tienda y unidades en dos
    for ($i = 1; $i < count($nombreColumnas); $i++) {
        if (!in_array($nombreColumnas[$i], $primaryKey)) {

            echo "$nombreColumnas[$i]= :" . $nombreColumnas[$i];
            if ($i !== count($nombreColumnas) - 1) {
                echo ",";
            }
        }
        echo " ";
    }
    echo " WHERE ";
    for ($i = 0; $i < count($primaryKey); $i++) {


        echo "$primaryKey[$i]= :" . $primaryKey[$i];
        if ($i !== count($primaryKey) - 1) {
            echo " AND ";
        }
    }
    echo "\";<br>";

    // $primaryKey= :$primaryKey\";<br>";

    echo         "\$param = array();<br>";


    foreach ($nombreColumnas as $key => $value) {
        echo "\$param[\":$value\"] =" . "\$" . $objetoTabla . "->__get(\"$value\"); //Le asignamos a las propiedades del objetos los campos de esa fila<br>";
    }


    echo         "\$this->consultaSimple(\$consulta, \$param);<br>";
    echo     "}<br>";




    echo     "/**<br>";
    echo      "* Borra una situacion en la base de datos<br>";
    echo      "* @param int El id de la situacion a borrar<br>";
    echo      "* @return void<br>";
    echo      "*/<br>";
    echo     "public function borrar(";
    for ($i = 0; $i < count($primaryKey); $i++) {
        echo "$" . $primaryKey[$i];
        if ($i !== count($primaryKey) - 1) {
            echo ",";
        }
        echo " ";
    }
    echo ")<br>";
    echo     "{ //Se introduce un objeto por parametro que se insertará<br>";

    echo         "\$consulta = \" DELETE FROM $nombreTabla WHERE ";
    for ($i = 0; $i < count($primaryKey); $i++) {


        echo "$primaryKey[$i]= :" . $primaryKey[$i];
        if ($i !== count($primaryKey) - 1) {
            echo " AND ";
        }
    }
    echo "\";<br>";

    echo         "\$param = array();<br>";

    for ($i = 0; $i < count($primaryKey); $i++) {

        echo         "\$param[\":$primaryKey[$i]\"] = \$$primaryKey[$i];<br>";
    }

    echo         "\$this->consultaSimple(\$consulta, \$param);<br>";
    echo     "}<br>";
    echo "}<br>";
}




/**
 * Imprime un select con los valores de un array de objetos
 * @param array $arrayObjetos Array de objetos que se van a mostrar en el select
 * @param string $columnaValue nombre de la columna que se va a utilizar como value
 * @param string|array $columnaOption nombre de la columna que se va a utilizar como option, o bien un array con los nombres de las columnas que se van a utilizar
 * @param string $nombre nombre del select
 * @param string $valorInicial valor seleccionado por defecto
 * @param bool $recargable si es true el select se recargará automaticamente
 */
function selectDBObject($arrayObjetos, $columnaValue, $columnaOption, $nombre, $valorInicial, $recargable = false)
{
    echo "<select name='$nombre'";
    $retVal = ($recargable) ? "onchange='this.form.submit();'" : "";
    echo "$retVal >";
    echo "<option value=''></option>";

    foreach ($arrayObjetos as $key => $value) {
        if (gettype($columnaOption) === 'array') {
            echo "<option value='{$value->$columnaValue}'" . (($value->$columnaValue == $valorInicial) ? 'selected' : '') . ">";
            foreach ($columnaOption as $key => $parametro) {

                echo $value->$parametro . " ";
            }

            echo "</option>";
        } else {
            echo "<option value='{$value->$columnaValue}'" . (($value->$columnaValue == $valorInicial) ? 'selected' : '') . ">{$value->$columnaOption}</option>";
        }
    }
    echo "</select>";
}

/**
 * Devuelve la clave primaria de una tabla en una base de datos
 *
 * @param string $nombreDB nombre de la base de datos
 * @param string $nombreTabla nombre de la tabla
 * @return array contiene la clave primaria de la tabla
 */
function obtenerPrimaryKeyTabla($nombreDB, $nombreTabla)
{
    $host = "localhost";
    $usuario = "root";
    $password = "";

    try {

        $pdo = new PDO("mysql:host=$host;dbname=$nombreDB", $usuario, $password);

        # Para que genere excepciones a la hora de reportar errores.
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {

        echo $e->getMessage();
    }

    $param[':tabla'] = $nombreTabla;
    $param[':nombreDB'] = $nombreDB;

    $consulta = "SELECT COLUMN_NAME 
        FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE 
        WHERE TABLE_NAME = :tabla 
        AND TABLE_SCHEMA = :nombreDB
        AND CONSTRAINT_NAME = 'PRIMARY'";
    // echo $consulta;
    $sta = $pdo->prepare($consulta);
    $sta->execute($param);

    $filas = $sta->fetchAll(PDO::FETCH_ASSOC);

    $nombresTabla = array();
    foreach ($filas as $key => $value) {
        $nombresTabla[] = $value['COLUMN_NAME'];
    }

    return $nombresTabla;
}


/**
 * Ordena la lista de objetos $_SESSION['producto'] por el campo especificado
 * 
 * @param string $Campo Campo por el que se va a ordenar
 * @param string $Orden 'a' para ordenar ascendente y 'd' para ordenar descendente
 * 
 * @return void
 */
function ordenaListaObjetos($Campo, $Orden)
{
    if ($Orden == 'd') {
        uasort($_SESSION['producto'], function ($a, $b) use ($Campo) {
            if (is_numeric($a->$Campo) && is_numeric($b->$Campo)) {
                return $a->$Campo - $b->$Campo;
            } else {
                return strcmp($a->$Campo, $b->$Campo);
            }
        });
    } else {
        uasort($_SESSION['producto'], function ($a, $b) use ($Campo) {
            if (is_numeric($a->$Campo) && is_numeric($b->$Campo)) {
                return $b->$Campo - $a->$Campo;
            } else {
                return strcmp($b->$Campo, $a->$Campo);
            }
        });
    }
}
