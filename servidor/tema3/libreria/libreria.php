<?php

class db {
    // establece la conexión con la base de datos
    private $host;
    private $user;
    private $password;
    private $database;

    public $rows = array(); // filas de los resultados de la consulta

    function __construct($database) {
        $this->database = $database;
    }

    function connect() {
        $this->host = "localhost";
        $this->user = "root";
        $this->password = "";
        
    }

}