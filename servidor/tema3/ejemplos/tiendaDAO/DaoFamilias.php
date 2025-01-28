<?php

//Necesitamos incluir la libreria y la clase entidad asociada al DAO
require_once 'DB.php';
require_once 'familia.php';


class DaoFamilias extends db 
{
   public $familias=array();  //Array de objetos con el resultado de las consultas
    
   public function __construct($base)  //Al instancial el dao especificamos sobre que BBDD queremos que actue 
   {
       $this->database=$base;
   }
    
   public function listar()       //Lista el contenido de la tabla
   {
     $consulta="select * from familia ";
     $param=array();
     
     $this->familias=array();  //Vaciamos el array de las situaciones entre consulta y consulta
     
     $this->ConsultadeDatos($consulta);
       
     foreach($this->rows as $fila)
     {
        $familia= new familia();
        
        $familia->__set("cod", $fila['cod']);
        $familia->__set("nombre", $fila['nombre']);
        
        $this->familias[]=$familia;   //Insertamos el objeto con los valores de esa fila en el array de objetos
        
     }
    
   }
   



}







?>