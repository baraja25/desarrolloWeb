<?php
class DB {
    private $pdo;
    private $host="localhost";
    private $user="root";
    private $pass="";
    private $base;

    public $filas=array();

    function __construct($base) {
        $this->base=$base;
    }

    private function Conectar() {
        try {
            $this->pdo=new PDO("mysql:host=$this->host;dbname=$this->base",$this->user,$this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function ConsultaSimple($consulta,$param=array()) {
        try {
            $this->Conectar();
            $sta=$this->pdo->prepare($consulta);
            $sta->execute($param);
            $this->Cerrar();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function ConsultaDatos($consulta,$param=array()) {
        try {
            $this->Conectar();
            $sta=$this->pdo->prepare($consulta);
            $sta->execute($param);
            $this->filas=$sta->fetchAll(PDO::FETCH_ASSOC);
            $this->Cerrar();
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    private function Cerrar() {
        $this->pdo=null;
    }

    public function getFilas() {
        return $this->filas;
    }

    public function setFilas($filas) {
        $this->filas = $filas;
    }

    
}