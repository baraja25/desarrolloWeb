<?php
//Revisar la situación del path
require_once("./libreriaPDO.php");
require_once("./stockClass.php");
class Daostock extends DB
{
    public $stocks = array();
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
        $consulta = 'SELECT * FROM stock';
        $this->consultaDatos($consulta);
        foreach ($this->filas as $fila) {
            $stoc = new Stock(); //creamos un objeto de la entidad situacion
            $stoc->__set("producto", $fila['producto']); //Le asignamos a las propiedades del objetos los campos de esa fila
            $stoc->__set("tienda", $fila['tienda']); //Le asignamos a las propiedades del objetos los campos de esa fila
            $stoc->__set("unidades", $fila['unidades']); //Le asignamos a las propiedades del objetos los campos de esa fila
            $this->stocks[] = $stoc; //Guardamos ese objeto en el array de objetos stoc
        }
    }

    /**
     * Obtiene una situacion de la base de datos por su producto y tienda.
     *
     * @param string $producto El producto de la situacion a obtener.
     * @param string $tienda La tienda de la situacion a obtener.
     * @return Stock El objeto Stock correspondiente al producto y tienda proporcionados
     * Si no se encuentra, se devuelve un objeto Stock vacío.
     */
    public function obtener($producto, $tienda)
    {
        $consulta = "SELECT * FROM stock WHERE producto= :producto AND tienda= :tienda ";
        $param = array();
        $param[":producto"] = $producto;
        $param[":tienda"] = $tienda;
        $this->consultaDatos($consulta, $param);
        $stoc = new Stock(); //creamos un objeto de la entidad Stock
        if (count($this->filas) == 1) {
            $fila = $this->filas[0];
            $stoc->__set("producto", $fila['producto']); //Le asignamos a las propiedades del objetos los campos de esa fila
            $stoc->__set("tienda", $fila['tienda']); //Le asignamos a las propiedades del objetos los campos de esa fila
            $stoc->__set("unidades", $fila['unidades']); //Le asignamos a las propiedades del objetos los campos de esa fila
        }
        return $stoc;
    }
    /**
     * Inserta una situacion en la base de datos
     * @param Situacion $stoc El objeto a insertar
     * @return void
     */
    public function insertar($stoc)
    { //Se introduce un objeto por parametro que se insertará
        $consulta = "INSERT INTO stock VALUES (:producto, :tienda, :unidades ) ";
        $param = array();
        $param[":producto"] = $stoc->__get("producto"); //Le asignamos a las propiedades del objetos los campos de esa fila
        $param[":tienda"] = $stoc->__get("tienda"); //Le asignamos a las propiedades del objetos los campos de esa fila
        $param[":unidades"] = $stoc->__get("unidades"); //Le asignamos a las propiedades del objetos los campos de esa fila
        $this->consultaSimple($consulta, $param);
    }
    /**;
     * Actualiza una situacion en la base de datos;
     * @param Stock stoc El objeto a actualizar;
     * @return void;
     */
    public function actualizar($stoc)
    { //Se introduce un objeto por parametro que se insertará
        $consulta = " UPDATE stock SET unidades= :unidades WHERE producto= :producto AND tienda= :tienda";
        $param = array();
        $param[":producto"] = $stoc->__get("producto"); //Le asignamos a las propiedades del objetos los campos de esa fila
        $param[":tienda"] = $stoc->__get("tienda"); //Le asignamos a las propiedades del objetos los campos de esa fila
        $param[":unidades"] = $stoc->__get("unidades"); //Le asignamos a las propiedades del objetos los campos de esa fila
        $this->consultaSimple($consulta, $param);
    }
    /**
     * Borra una situacion en la base de datos
     * @param int El id de la situacion a borrar
     * @return void
     */
    public function borrar($producto, $tienda)
    { //Se introduce un objeto por parametro que se insertará
        $consulta = " DELETE FROM stock WHERE producto= :producto AND tienda= :tienda";
        $param = array();
        $param[":producto"] = $producto;
        $param[":tienda"] = $tienda;
        $this->consultaSimple($consulta, $param);
    }

    public function totalProducto($producto) //Muestra el total de unidades para un codigo de producto
    {
        $consulta = "SELECT SUM(unidades) as total FROM stock WHERE producto= :producto";
        $param = array();
        $param[":producto"] = $producto;
        $this->consultaDatos($consulta, $param);
        $total = $this->filas[0]['total'];

        return $total;
    }

    // public function unidadesProductoTienda(){

    // }
}


    // -- public function listarFamiliaTienda($familia,$tienda)
    // -- {

    // --     $param[':codTienda']=$tienda;
    // --     $param[':codFamilia']=$familia;
    // --     $consulta = "SELECT tienda, producto, unidades
    // --         FROM stock
    // --         WHERE tienda=:codTienda and producto in (SELECT cod from producto where familia=:codFamilia)";

    // --     $this->consultaDatos($consulta,$param);

    // --     foreach ($this->filas as $fila) {
    // --         $stock = new Stock(); //creamos un objeto de la entidad situacion

    // --         $stock->__set("tienda", $fila['tienda']); //Le asignamos a las propiedades del objetos los campos de esa fila
    // --         $stock->__set("producto", $fila['producto']);
    // --         $stock->__set("unidades", $fila['unidades']);

    // --         $this->stocks[] = $stock; //Guardamos ese objeto en el array de objetos situaciones
    // --     }
    // -- }
