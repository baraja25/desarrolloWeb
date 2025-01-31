<?php

require_once 'LibreriaPDO.php';
require_once 'Familia.php';

class DaoFamilias extends DB
{
   public $familias=array(); //Creamos una array de objetos situaciones
    
   function __construct($base) 
   {
     parent::__construct($base); // Llama al constructor de la clase DB
   }
    
   // Listar todos registros    
   
   public function listar()
   {
       $consulta="SELECT * FROM familia";  
       
       $this->ConsultaDatos($consulta);
       
       foreach ($this->filas as $fila)
       {
           $familia = new Familia();    //Creamos un objeto de la entidad tienda
           
           $familia->__set("cod",$fila['cod'] );          //Le asiganamos a las propiedades del objeto los campos de esa fila
           $familia->__set("nombre",$fila['nombre'] );
           
           $this->familias[]=$familia;  //Guardamos ese objeto en el array de objetos situaciones  
           
       }
        
   }
   
   
   
}









?>