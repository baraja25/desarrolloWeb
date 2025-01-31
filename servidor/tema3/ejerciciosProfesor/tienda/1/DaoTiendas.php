<?php

require_once 'LibreriaPDO.php';
require_once 'Tienda.php';

class DaoTiendas extends DB
{
   public $tiendas=array(); //Creamos una array de objetos situaciones
    
   function __construct($base) 
   {
     parent::__construct($base); // Llama al constructor de la clase DB
   }
    
   // Listar todos registros    
   
   public function listar()
   {
       $consulta="SELECT * FROM tienda";  
       
       $this->ConsultaDatos($consulta);
       
       foreach ($this->filas as $fila)
       {
           $tienda = new Tienda();    //Creamos un objeto de la entidad tienda
           
           $tienda->__set("cod",$fila['cod'] );          //Le asiganamos a las propiedades del objeto los campos de esa fila
           $tienda->__set("nombre",$fila['nombre'] );
           $tienda->__set("tlf",$fila['tlf'] );
           
           $this->tiendas[]=$tienda;  //Guardamos ese objeto en el array de objetos situaciones  
           
       }
        
   }
   
   
   
}









?>