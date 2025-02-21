
<?php

require_once("./libreriaPDO.php");
require_once("./FamiliaClass.php");

class DAOFamilias extends DB
{

    public $familias = array();


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

        $consulta = "SELECT * FROM familia ";

        $this->consultaDatos($consulta);

        foreach ($this->filas as $fila) {
            $familia = new Familia(); //creamos un objeto de la entidad situacion

            $familia->__set("cod", $fila['cod']); //Le asignamos a las propiedades del objetos los campos de esa fila
            $familia->__set("nombre", $fila['nombre']);

            $this->familias[] = $familia; //Guardamos ese objeto en el array de objetos situaciones
        }
    }





    /**
     * Obtiene una situacion de la base de datos por su Id.
     * 
     * @param int $Id El id de la situacion a obtener.
     * @return Situacion El objeto Situacion correspondiente al Id proporcionado.
     *                    Si no se encuentra, se devuelve un objeto Situacion vacío.
     */

    //  public function obtener($Id)
    //  {

    //      $consulta = "SELECT * FROM situaciones WHERE Id=:Id ";

    //      $param = array();
    //      $param[":Id"] = $Id;

    //      $this->consultaDatos($consulta, $param);

    //      $situ = new Situacion(); //creamos un objeto de la entidad situacion

    //      if (count($this->filas) == 1) {
    //          $fila = $this->filas[0];


    //          $situ->__set("Id", $fila['Id']); //Le asignamos a las propiedades del objetos los campos de esa fila
    //          $situ->__set("Nombre", $fila['Nombre']);


    //      }
    //      return $situ;
    //  }




    //  /**
    //   * Inserta una situacion en la base de datos
    //   * @param Situacion $situ El objeto a insertar
    //   * @return void
    //   */
    //  public function insertar($situ){ //Se introduce un objeto por parametro que se insertará

    //      $consulta = "INSERT INTO situaciones VALUES (:Id, :Nombre) ";

    //      $param=array();


    //      $param[":Id"]=$situ->__Get("Id");
    //      $param[":Nombre"]=$situ->__Get("Nombre");


    //      $this->consultaSimple($consulta,$param);

    //  }



    //  /**
    //   * Actualiza una situacion en la base de datos
    //   * @param Situacion $situ El objeto a actualizar
    //   * @return void
    //   */
    //  public function actualizar($situ){ //Se introduce un objeto por parametro que se insertará

    //      $consulta = " UPDATE situaciones SET Nombre=:Nombre WHERE Id=:Id";

    //      $param=array();


    //      $param[":Id"]=$situ->__get('Id');
    //      $param[":Nombre"]=$situ->__get('Nombre');


    //      $this->consultaSimple($consulta,$param);

    //  }




    //  /**
    //   * Borra una situacion en la base de datos
    //   * @param int $id El id de la situacion a borrar
    //   * @return void
    //   */
    //  public function borrar($id){ //Se introduce un objeto por parametro que se insertará

    //      $consulta = " DELETE FROM situaciones WHERE Id=:Id";

    //      $param=array();


    //      $param[":Id"]=$id;
    //      // $param[":Nombre"]=$situ->__get('Nombre');


    //      $this->consultaSimple($consulta,$param);

    //  }
}



?>