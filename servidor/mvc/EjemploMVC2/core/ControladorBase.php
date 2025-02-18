<?php

class ControladorBase{
   
    public function __construct() {
        
        require_once 'EntidadBase.php';
       
         //Incluir todos los modelos
        foreach(glob("modelo/*.php") as $file){
            require_once $file;
        }
    }
    
     
    public function url($controlador=CONTROLADOR_DEFECTO,$accion=ACCION_DEFECTO){
        $urlString="index.php?controller=".$controlador."&action=".$accion;
        return $urlString;
    }
    
    
   public function view($vista, $datos){
    
     //Llevo el array $datos a las vistas. 
     //El array lo cargo en el DepartamentoControler, con lo que necesite llevar a la vista    
      require_once 'vista/'.$vista.'View.php';
          
 
    }
    
   
    
    
    
    
    //Métodos para los controladores
    
}
?>