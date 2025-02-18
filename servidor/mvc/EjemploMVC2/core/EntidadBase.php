<?php

class EntidadBase{
    
    private $table;
    public $db;

    
    public function __construct($table) {
       
        $this->table=(string) $table;
        
        require_once 'Conectar.php';
        
        $database = new Conectar();
        $this->db = $database->getConnection();
        
    }
    

}
?>
    
    
