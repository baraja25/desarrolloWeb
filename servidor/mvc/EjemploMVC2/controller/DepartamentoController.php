<?php

class DepartamentoController extends ControladorBase
{
    public $dep;

    public function __construct()
    {
        parent::__construct();
        $this->dep = new DepartamentoModel();
    }

    public function index()
    {
        // Cargamos la vista index y le pasamos una variable que no se va a usar. Array vacio
        $this->view("index", array() );
    }

    
    public function modificar()
    {   
        $depar =null;
        $dat = array();  
        if (isset($_GET["dept_no"])) {
            $id = (int) $_GET["dept_no"];
            $depar = $this->dep->getUnDepartamento($id);
   
            $mensaje = "DEPARTAMENTO ENCONTRADO";
        } else
            $mensaje = "NO HAS ESCRITO EL DEPARTAMENTO";
            
            $dat['depar'] = $depar;
            $dat['mensaje'] = $mensaje;
            $this->view("modificardepart", $dat);
    
    }
    
    public function actualizar()
    {
        $dat = array();
        if (isset($_POST["dept_no"]) && !empty($_POST['dept_no'])) {
            $mensaje = $this->dep->actualiza($_POST["dept_no"], $_POST["loc"], $_POST["dnombre"]);
        } else
            $mensaje = "NO HAS TECLEADO EL DEPARTAMENTO.";
            
            //Cargo el array, que luego se llevará a la vista
            $dat['mensaje'] = $mensaje;
            $this->view("mensajes", $dat);
    }
    
    public function crear()
    {
        $dat = array();  
        if (isset($_POST["dept_no"]) && !empty($_POST['dept_no'])) {  
             $mensaje = $this->dep->save($_POST["dept_no"], $_POST["loc"], $_POST["dnombre"]);      
        } else
            $mensaje = "NO HAS TECLEADO EL DEPARTAMENTO.";
        
        //Cargo el array, que luego se llevará a la vista
        $dat['mensaje'] = $mensaje;
        $this->view("mensajes", $dat);
    }

    public function borrar()
    {
        $dat = array(); //array para luego la vista
        if (isset($_GET["dept_no"])) {
            $id = (int) $_GET["dept_no"];
            $mensaje = $this->dep->borrar($id);
        } else
            $mensaje = "NO HAS ESCRITO EL DEPARTAMENTO";

        $dat['mensaje'] = $mensaje;
        $this->view("mensajes", $dat);
    }

    public function insertar()
    {
        $this->view("insertardepart", array(
            "datos" => "Hay que llevar algo"
        ));
    }

    public function listar()
    {
        // Conseguimos todos los objetos dep
        $alludeps = $this->dep->getAll();
        $data = array();
        $data['alldeps'] = $alludeps;
        // print_r( $data);
        // Cargamos la vista y  pasamos el array con los obj
        $this->view("listardepartamentos", $data);
    }
}
?>