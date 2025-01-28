<?php

//Necesitamos incluir la libreria y la clase entidad asociada al DAO
require_once 'DB.php';
require_once 'tienda.php';

class DaoTiendas extends db 
{
   public $tiendas=array();  //Array de objetos con el resultado de las consultas
    
   public function __construct($base)  //Al instancial el dao especificamos sobre que BBDD queremos que actue 
   {
       $this->database=$base;
   }
    
   public function listar()       //Lista el contenido de la tabla
   {
     $consulta="select * from tienda ";
     $param=array();
     
     $this->tiendas=array();  //Vaciamos el array de las situaciones entre consulta y consulta
     
     $this->ConsultadeDatos($consulta);
       
     foreach($this->rows as $fila)
     {
        $tienda= new tienda();
        
        $tienda->__set("cod", $fila['cod']);
        $tienda->__set("nombre", $fila['nombre']);
        $tienda->__set("tlf", $fila['tlf']);
        
        $this->tiendas[]=$tienda;   //Insertamos el objeto con los valores de esa fila en el array de objetos
        
     }
    
   }
   



}







?>