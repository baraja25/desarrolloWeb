<?php

require_once 'DB.php';
require_once 'stock.php';

class DaoStock extends db 
{
    public $stock = array();  
    private $database;
    
    public function __construct($base)  
    {
        $this->database = $base;
        parent::__construct($this->database); // Asumiendo que la clase DB necesita el nombre de la BBDD
    }
    
    public function obtenerStock($codTienda, $codFamilia) 
    {
        $consulta = "SELECT p.nombre, s.cantidad 
                     FROM stock p
                     JOIN stock s ON p.cod = s.producto_id
                     WHERE s.tienda_id = :tienda 
                     AND p.familia_id = :familia";
        
        $parametros = array(
            ':tienda' => $codTienda,
            ':familia' => $codFamilia
        );
        
        $this->ConsultadeDatos($consulta, $parametros); // Ejecuta consulta con parámetros
        
        $resultados = array();
        foreach($this->rows as $fila) {
            $resultados[] = array(
                'nombre' => $fila['nombre'],
                'stock' => $fila['cantidad']
            );
        }
        
        return $resultados;
    }
}
?>