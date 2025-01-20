<?php

class db
{
    // establece la conexión con la base de datos
    private $pdo; // esta propiedad recoge el objeto PDO
    private $host;
    private $user;
    private $password;
    private $database;

    public $rows = array(); // filas de los resultados de la consulta
    /* 
        Constructor de la clase
    */
    function __construct($database)
    {
        $this->database = $database;
    }
    /* 
        Metodo que establece los valores de las propiedades
    */
    private function connect()
    {
        try {
            $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->database", $this->user, $this->password); // crea un objeto PDO

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // establece el modo de error
        } catch (PDOException $e) {
            echo $e->getMessage(); // muestra un mensaje de error
        }
    }
    /* 
        Metodo que cierra la conexión con la base de datos
    */
    private function disconnect()
    {
        $this->pdo = null; // cierra la conexión
    }
    /* 
        Metodo que realiza una consulta a la base de datos
    */
    function consultaSimple($consulta, $param = array())
    {
        try {
            $this->connect(); // establece la conexión
            $stmt = $this->pdo->prepare($consulta); // prepara la consulta
            $stmt->execute($param); // ejecuta la consulta
            $this->disconnect(); // cierra la conexión
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    /*
     Metodo que realiza una consulta a la base de datos y guarda los resultados en la propiedad rows
    */ 
    function consultaDeDatos ($consulta, $param = array()) {
        try {
            $this->connect(); // establece la conexión
            $stmt = $this->pdo->prepare($consulta); // prepara la consulta
            $stmt->execute($param); // ejecuta la consulta
            $this->rows = $stmt->fetchAll(PDO::FETCH_ASSOC); // guarda los resultados en la propiedad rows
            $this->disconnect(); // cierra la conexión
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
