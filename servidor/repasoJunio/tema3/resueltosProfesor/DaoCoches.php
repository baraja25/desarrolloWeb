<?php

//Importamos las clases que el dao va a necesitar

require_once 'libreriaPDO.php';
require_once 'Coche.php';

class DaoCoches extends DB
{
    public $coches=array(); //Array de objetos de la entidad coche
    
    public function __construct($base)   //El constructor del Dao recibe el nombre de la base de datos a la que nos vamos a conectar
    {
        $this->dbname=$base;  
    }
    
    public function listar()         //Lista todo el contenido de la tabla coche
    {
        $consulta="select * from coche";
        
        $param=array();
        
        $this->ConsultaDatos($consulta,$param);
        
        foreach($this->filas as $fila)
        {
           $coche =new Coche();
            
           $coche->__set("id", $fila["id"]);
           $coche->__set("nombre", $fila["nombre"]);
           $coche->__set("marca", $fila["marca"]);
           $coche->__set("modelo", $fila["modelo"]);
           $coche->__set("precio", $fila["precio"]);
           $coche->__set("matricula", $fila["matricula"]);
           $coche->__set("anio", $fila["anio"]);
           $coche->__set("foto", $fila["foto"]);
            
           $this->coches[]=$coche;  //Insertamos ese coche con las propiedades de su fila en el array de coches

        }
        
    }
    
    public function obtener($id)
    {
        $consulta="select * from coche where id=:id";
        
        $param=array();
        
        $param[":id"]=$id;
        
        $this->ConsultaDatos($consulta,$param);
        
        $coche= new Coche();
       
        if (count($this->filas)==1 )
        {
            $fila = $this->filas[0];   //Obtenemos los datos de esa fila
               
            $coche->__set("id", $fila["id"]);
            $coche->__set("nombre", $fila["nombre"]);
            $coche->__set("marca", $fila["marca"]);
            $coche->__set("modelo", $fila["modelo"]);
            $coche->__set("precio", $fila["precio"]);
            $coche->__set("matricula", $fila["matricula"]);
            $coche->__set("anio", $fila["anio"]);
            $coche->__set("foto", $fila["foto"]);
           
        }
        
       return $coche; 
        
    }
    
    public function Primero()
    {
        $consulta="SELECT id from coche limit 1";
        
        $param=array();
        
        $this->ConsultaDatos($consulta,$param);
       
        if (count($this->filas)==1 )
        {
            $fila=$this->filas[0];
            
            $id=$fila['id'];
            
        }
        
        return $id; 
        
    }
    
    public function Ultimo()
    {
        $consulta="SELECT id from coche order by id desc limit 1";
        
        $param=array();
        
        $this->ConsultaDatos($consulta,$param);
        
        if (count($this->filas)==1 )
        {
            $fila=$this->filas[0];
            
            $id=$fila['id'];
            
        }
        
        return $id;
        
    }
    
    public function Siguiente($id)
    {
        $consulta="SELECT id from coche where id>:id limit 1";
        
        $param=array();
        
        $param[":id"]=$id;
        
        $this->ConsultaDatos($consulta,$param);
        
        if (count($this->filas)==1 )
        {
            $fila=$this->filas[0];
            
            $id=$fila['id'];
            
        }
        
        return $id;
        
    }
    
    public function Anterior($id)
    {
        $consulta=" SELECT id from coche where id<:id order by id desc limit 1 ";
        
        $param=array();
        
        $param[":id"]=$id;
        
        $this->ConsultaDatos($consulta,$param);
        
        if (count($this->filas)==1 )
        {
            $fila=$this->filas[0];
            
            $id=$fila['id'];
            
        }
        
        return $id;
        
    }
    
    public function actualizar($coche)                       //Actualiza los datos de un coche
    {
        $consulta="update coche set nombre=:nombre,
                                    marca=:marca,
                                    modelo=:modelo,
                                    precio=:precio,
                                    matricula=:matricula,
                                    anio=:anio,
                                    foto=:foto 
                   where id=:id ";
        
        $param=array();
        
        $param[":id"]=$coche->__get('id');
        $param[":nombre"]=$coche->__get('nombre');
        $param[":marca"]=$coche->__get('marca');
        $param[":modelo"]=$coche->__get('modelo');
        $param[":precio"]=$coche->__get('precio');
        $param[":matricula"]=$coche->__get('matricula');
        $param[":anio"]=$coche->__get('anio');
        $param[":foto"]=$coche->__get('foto');
        
        $this->ConsultaSimple($consulta,$param);
       
    }
    
    public function buscar($marca,$modelo,$min,$max)         //Busca un coche por marca, modelo y rango precios
    {
        $consulta="select * from coche where 1 ";
        
        $param=array();
        
        if ($marca!='')
        {
            $consulta.=" and Marca=:marca ";
            
            $param[":marca"]=$marca;
            
        }
        if ($modelo!='')
        {
            $consulta.=" and Modelo=:modelo ";
            
            $param[":modelo"]=$modelo;
            
        }
        if ($min!='')
        {
            $consulta.=" and Precio>=:min ";
            
            $param[":min"]=$min;
        }
        if ($max!='')
        {
            $consulta.=" and Precio<=:max ";
            
            $param[":max"]=$max;
        }
        
        $this->ConsultaDatos($consulta,$param);
        
        foreach($this->filas as $fila)
        {
            $coche =new Coche();
            
            $coche->__set("id", $fila["id"]);
            $coche->__set("nombre", $fila["nombre"]);
            $coche->__set("marca", $fila["marca"]);
            $coche->__set("modelo", $fila["modelo"]);
            $coche->__set("precio", $fila["precio"]);
            $coche->__set("matricula", $fila["matricula"]);
            $coche->__set("anio", $fila["anio"]);
            $coche->__set("foto", $fila["foto"]);
            
            $this->coches[]=$coche;  //Insertamos ese coche con las propiedades de su fila en el array de coches
            
        }
        
    }
    
    
   
}

?>