<?php
//Revisar la situación del path
require_once("./libreriaPDO.php");
require_once("./productoClass.php");
class Daoproducto extends DB
{
    public $productos = array();
    /**
     * Constructor de la clase. Llama al constructor de la clase DB.
     * @param string $base nombre de la base de datos
     */
    function __construct($base)
    {
        parent::__construct($base); //Llama al constructor de la clase DB
    }
    public function listar()
    {
        $consulta = 'SELECT * FROM producto';
        $this->consultaDatos($consulta);
        foreach ($this->filas as $fila) {
            $prod = new Producto(); //creamos un objeto de la entidad situacion
            $prod->__set("cod", $fila['cod']); //Le asignamos a las propiedades del objetos los campos de esa fila
            $prod->__set("nombre", $fila['nombre']); //Le asignamos a las propiedades del objetos los campos de esa fila
            $prod->__set("descripcion", $fila['descripcion']); //Le asignamos a las propiedades del objetos los campos de esa fila
            $prod->__set("PVP", $fila['PVP']); //Le asignamos a las propiedades del objetos los campos de esa fila
            $prod->__set("familia", $fila['familia']); //Le asignamos a las propiedades del objetos los campos de esa fila
            $prod->__set("Foto", $fila['Foto']); //Le asignamos a las propiedades del objetos los campos de esa fila
            $this->productos[] = $prod; //Guardamos ese objeto en el array de objetos prod
        }
    }
    /**
     * Obtiene una situacion de la base de datos por su Id.
     *
     * @param int $Id El id de la situacion a obtener.
     * @return Situacion El objeto Situacion correspondiente al Id proporcionado
     * Si no se encuentra, se devuelve un objeto Situacion vacío.
     */
    public function obtener($cod)
    {
        $consulta = "SELECT * FROM producto WHERE cod=:Id ";
        $param = array();
        $param[":Id"] = $cod;
        $this->consultaDatos($consulta, $param);
        $prod = new Producto(); //creamos un objeto de la entidad Producto
        if (count($this->filas) == 1) {
            $fila = $this->filas[0];
            $prod->__set("cod", $fila['cod']); //Le asignamos a las propiedades del objetos los campos de esa fila
            $prod->__set("nombre", $fila['nombre']); //Le asignamos a las propiedades del objetos los campos de esa fila
            $prod->__set("descripcion", $fila['descripcion']); //Le asignamos a las propiedades del objetos los campos de esa fila
            $prod->__set("PVP", $fila['PVP']); //Le asignamos a las propiedades del objetos los campos de esa fila
            $prod->__set("familia", $fila['familia']); //Le asignamos a las propiedades del objetos los campos de esa fila
            $prod->__set("Foto", $fila['Foto']); //Le asignamos a las propiedades del objetos los campos de esa fila
        }
        return $prod;
    }
    /**
     * Inserta una situacion en la base de datos
     * @param Situacion $prod El objeto a insertar
     * @return void
     */
    public function insertar($prod)
    { //Se introduce un objeto por parametro que se insertará
        $consulta = "INSERT INTO producto VALUES (:cod, :nombre, :descripcion, :PVP, :familia, :Foto ) ";
        $param = array();
        $param[":cod"] = $prod->__get("cod"); //Le asignamos a las propiedades del objetos los campos de esa fila
        $param[":nombre"] = $prod->__get("nombre"); //Le asignamos a las propiedades del objetos los campos de esa fila
        $param[":descripcion"] = $prod->__get("descripcion"); //Le asignamos a las propiedades del objetos los campos de esa fila
        $param[":PVP"] = $prod->__get("PVP"); //Le asignamos a las propiedades del objetos los campos de esa fila
        $param[":familia"] = $prod->__get("familia"); //Le asignamos a las propiedades del objetos los campos de esa fila
        $param[":Foto"] = $prod->__get("Foto"); //Le asignamos a las propiedades del objetos los campos de esa fila
        $this->consultaSimple($consulta, $param);
    }
    /**;
     * Actualiza una situacion en la base de datos;
     * @param Producto prod El objeto a actualizar;
     * @return void;
     */
    public function actualizar($prod)
    { //Se introduce un objeto por parametro que se insertará
        $consulta = " UPDATE producto SET nombre= :nombre, descripcion= :descripcion, PVP= :PVP, familia= :familia, Foto= :Foto WHERE cod= :cod";
        $param = array();
        $param[":cod"] = $prod->__get("cod"); //Le asignamos a las propiedades del objetos los campos de esa fila
        $param[":nombre"] = $prod->__get("nombre"); //Le asignamos a las propiedades del objetos los campos de esa fila
        $param[":descripcion"] = $prod->__get("descripcion"); //Le asignamos a las propiedades del objetos los campos de esa fila
        $param[":PVP"] = $prod->__get("PVP"); //Le asignamos a las propiedades del objetos los campos de esa fila
        $param[":familia"] = $prod->__get("familia"); //Le asignamos a las propiedades del objetos los campos de esa fila
        $param[":Foto"] = $prod->__get("Foto"); //Le asignamos a las propiedades del objetos los campos de esa fila
        $this->consultaSimple($consulta, $param);
    }
    /**
     * Borra una situacion en la base de datos
     * @param int $cod El id de la situacion a borrar
     * @return void
     */
    public function borrar($cod)
    { //Se introduce un objeto por parametro que se insertará
        $consulta = " DELETE FROM producto WHERE cod=:cod";
        $param = array();
        $param[":cod"] = $cod;
        $this->consultaSimple($consulta, $param);
    }

    public function buscar($nombre, $familia)
    {
        $consulta = "SELECT * FROM producto WHERE 1 ";

        if ($familia !== "") {
            $consulta .= " AND familia = :familia ";
            $param[":familia"] = $familia;
        }
        if ($nombre !== "") {
            $consulta .= " AND nombre like :nombre ";
            $param[":nombre"] = "%" . $nombre . "%";
        }
        // echo $consulta."<br> ".$param[':familia']."<br>".$param[':nombre']."<br>";
        $this->consultaDatos($consulta,$param);

        foreach ($this->filas as $fila) {
            $prod = new Producto(); //creamos un objeto de la entidad situacion
            $prod->__set("cod", $fila['cod']); //Le asignamos a las propiedades del objetos los campos de esa fila
            $prod->__set("nombre", $fila['nombre']); //Le asignamos a las propiedades del objetos los campos de esa fila
            $prod->__set("descripcion", $fila['descripcion']); //Le asignamos a las propiedades del objetos los campos de esa fila
            $prod->__set("PVP", $fila['PVP']); //Le asignamos a las propiedades del objetos los campos de esa fila
            $prod->__set("familia", $fila['familia']); //Le asignamos a las propiedades del objetos los campos de esa fila
            $prod->__set("Foto", $fila['Foto']); //Le asignamos a las propiedades del objetos los campos de esa fila
            $this->productos[] = $prod; //Guardamos ese objeto en el array de objetos prod
        }
    }
}
