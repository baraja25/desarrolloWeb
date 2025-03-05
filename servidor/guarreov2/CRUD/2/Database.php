<?php
// clase a copiar
class Database
{

    private $connection;

    public function __construct()
    {
        $config = [
            'host' => 'localhost',
            'dbname' => 'examen',
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


    public function getColumns($table)
    {
        $query = "DESCRIBE $table";
        $columns = $this->query($query, [])->fetchAll();

        return array_map(function ($column) {
            return $column['Field'];
        }, $columns);
    }

    public function getColumnType($table, $column)
    {
        $query = "DESCRIBE $table";
        $columns = $this->query($query, [])->fetchAll();

        foreach ($columns as $col) {
            if ($col['Field'] === $column) {
                return $col['Type'];
            }
        }
    }
}

