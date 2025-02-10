<?php

require_once 'LibreriaPDO.php';
require_once 'Stock.php';

class DaoStocks extends DB
{
   public $stocks=array(); //Creamos una array de objetos situaciones
    
   function __construct($base) 
   {
     parent::__construct($base); // Llama al constructor de la clase DB
   }
    
   // Listar todos registros    
   
   public function listarFamTien($tienda,$familia)
   {
       $consulta=" SELECT tienda,producto,unidades 
                   FROM stock s
                   where   
                   tienda=:tienda and producto in (select cod from producto where familia=:familia)";  
       
       $param=array();
       
       $param[":tienda"]=$tienda;
       $param[":familia"]=$familia;
       
       $this->ConsultaDatos($consulta,$param);
      
       foreach ($this->filas as $fila)
       {
           $stock = new Stock();    //Creamos un objeto de la entidad tienda
           
           $stock->__set("tienda",$fila['tienda'] );          //Le asiganamos a las propiedades del objeto los campos de esa fila
           $stock->__set("producto",$fila['producto'] );
           $stock->__set("unidades",$fila['unidades'] );
           
           $this->stocks[]=$stock;  //Guardamos ese objeto en el array de objetos situaciones  
           
       }
        
   }
   
   
   
}









?>