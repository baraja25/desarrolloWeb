<?php

class Database
{

    private $connection;

    public function __construct()
    {
        $config = [
            'host' => 'localhost',
            'dbname' => 'concesionario',
            'charset' => 'utf8mb4'
        ];

        $dsn = 'mysql:'.http_build_query($config, '', ';');


        

        $this->connection = new PDO($dsn, 'root', '',[
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($query, $params = [])
    {

        try {

            $statement = $this->connection->prepare($query);

            $statement->execute($params);

            return $statement;
        
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}


