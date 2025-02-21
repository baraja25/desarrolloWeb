<?php

//Revisar la situación del path
require_once("./libreriaPDO.php");
require_once("./clienteClass.php");
class Daoclientes extends DB
{
public $clientess = array();
/**
* Constructor de la clase. Llama al constructor de la clase DB.
* @param string $base nombre de la base de datos
*/
function __construct($base)
{parent::__construct($base); //Llama al constructor de la clase DB
}
public function listar()
{
$consulta = 'SELECT * FROM clientes';
$this->consultaDatos($consulta);
foreach ($this->filas as $fila) {
$clie = new Clientes(); //creamos un objeto de la entidad situacion
$clie->__set("NIF", $fila['NIF']); //Le asignamos a las propiedades del objetos los campos de esa fila
$clie->__set("Nombre", $fila['Nombre']); //Le asignamos a las propiedades del objetos los campos de esa fila
$clie->__set("Apellido1", $fila['Apellido1']); //Le asignamos a las propiedades del objetos los campos de esa fila
$clie->__set("Apellido2", $fila['Apellido2']); //Le asignamos a las propiedades del objetos los campos de esa fila
$clie->__set("FechaNac", $fila['FechaNac']); //Le asignamos a las propiedades del objetos los campos de esa fila
$clie->__set("Sexo", $fila['Sexo']); //Le asignamos a las propiedades del objetos los campos de esa fila
$clie->__set("Direccion", $fila['Direccion']); //Le asignamos a las propiedades del objetos los campos de esa fila
$clie->__set("Estado", $fila['Estado']); //Le asignamos a las propiedades del objetos los campos de esa fila
$clie->__set("Telefono", $fila['Telefono']); //Le asignamos a las propiedades del objetos los campos de esa fila
$clie->__set("CP", $fila['CP']); //Le asignamos a las propiedades del objetos los campos de esa fila
$clie->__set("Foto", $fila['Foto']); //Le asignamos a las propiedades del objetos los campos de esa fila
$this->clientess[] = $clie; //Guardamos ese objeto en el array de objetos clie
}
}
/**
* Obtiene una situacion de la base de datos por su Id.
*
* @param int $Id El id de la situacion a obtener.
* @return Situacion El objeto Situacion correspondiente al Id proporcionado
* Si no se encuentra, se devuelve un objeto Situacion vacío.
*/
public function obtener($NIF )
{
$consulta = "SELECT * FROM clientes WHERE NIF= :NIF ";
$param = array();
$param[":NIF"] = $NIF;
$this->consultaDatos($consulta, $param);
$clie = new Clientes(); //creamos un objeto de la entidad Clientes
if (count($this->filas) == 1) {
$fila = $this->filas[0];
$clie->__set("NIF", $fila['NIF']); //Le asignamos a las propiedades del objetos los campos de esa fila
$clie->__set("Nombre", $fila['Nombre']); //Le asignamos a las propiedades del objetos los campos de esa fila
$clie->__set("Apellido1", $fila['Apellido1']); //Le asignamos a las propiedades del objetos los campos de esa fila
$clie->__set("Apellido2", $fila['Apellido2']); //Le asignamos a las propiedades del objetos los campos de esa fila
$clie->__set("FechaNac", $fila['FechaNac']); //Le asignamos a las propiedades del objetos los campos de esa fila
$clie->__set("Sexo", $fila['Sexo']); //Le asignamos a las propiedades del objetos los campos de esa fila
$clie->__set("Direccion", $fila['Direccion']); //Le asignamos a las propiedades del objetos los campos de esa fila
$clie->__set("Estado", $fila['Estado']); //Le asignamos a las propiedades del objetos los campos de esa fila
$clie->__set("Telefono", $fila['Telefono']); //Le asignamos a las propiedades del objetos los campos de esa fila
$clie->__set("CP", $fila['CP']); //Le asignamos a las propiedades del objetos los campos de esa fila
$clie->__set("Foto", $fila['Foto']); //Le asignamos a las propiedades del objetos los campos de esa fila
}
return $clie;
}
/**
* Inserta una situacion en la base de datos
* @param Situacion $clie El objeto a insertar
* @return void
*/
public function insertar($clie)
{ //Se introduce un objeto por parametro que se insertará
$consulta = "INSERT INTO clientes VALUES (:NIF, :Nombre, :Apellido1, :Apellido2, :FechaNac, :Sexo, :Direccion, :Estado, :Telefono, :CP, :Foto ) ";
$param = array();
$param[":NIF"] =$clie->__get("NIF"); //Le asignamos a las propiedades del objetos los campos de esa fila
$param[":Nombre"] =$clie->__get("Nombre"); //Le asignamos a las propiedades del objetos los campos de esa fila
$param[":Apellido1"] =$clie->__get("Apellido1"); //Le asignamos a las propiedades del objetos los campos de esa fila
$param[":Apellido2"] =$clie->__get("Apellido2"); //Le asignamos a las propiedades del objetos los campos de esa fila
$param[":FechaNac"] =$clie->__get("FechaNac"); //Le asignamos a las propiedades del objetos los campos de esa fila
$param[":Sexo"] =$clie->__get("Sexo"); //Le asignamos a las propiedades del objetos los campos de esa fila
$param[":Direccion"] =$clie->__get("Direccion"); //Le asignamos a las propiedades del objetos los campos de esa fila
$param[":Estado"] =$clie->__get("Estado"); //Le asignamos a las propiedades del objetos los campos de esa fila
$param[":Telefono"] =$clie->__get("Telefono"); //Le asignamos a las propiedades del objetos los campos de esa fila
$param[":CP"] =$clie->__get("CP"); //Le asignamos a las propiedades del objetos los campos de esa fila
$param[":Foto"] =$clie->__get("Foto"); //Le asignamos a las propiedades del objetos los campos de esa fila
$this->consultaSimple($consulta, $param);
}
/**;
* Actualiza una situacion en la base de datos;
* @param Clientes clie El objeto a actualizar;
* @return void;
*/
public function actualizar($clie)
{ //Se introduce un objeto por parametro que se insertará
$consulta = " UPDATE clientes SET Nombre= :Nombre, Apellido1= :Apellido1, Apellido2= :Apellido2, FechaNac= :FechaNac, Sexo= :Sexo, Direccion= :Direccion, Estado= :Estado, Telefono= :Telefono, CP= :CP, Foto= :Foto WHERE NIF= :NIF";
$param = array();
$param[":NIF"] =$clie->__get("NIF"); //Le asignamos a las propiedades del objetos los campos de esa fila
$param[":Nombre"] =$clie->__get("Nombre"); //Le asignamos a las propiedades del objetos los campos de esa fila
$param[":Apellido1"] =$clie->__get("Apellido1"); //Le asignamos a las propiedades del objetos los campos de esa fila
$param[":Apellido2"] =$clie->__get("Apellido2"); //Le asignamos a las propiedades del objetos los campos de esa fila
$param[":FechaNac"] =$clie->__get("FechaNac"); //Le asignamos a las propiedades del objetos los campos de esa fila
$param[":Sexo"] =$clie->__get("Sexo"); //Le asignamos a las propiedades del objetos los campos de esa fila
$param[":Direccion"] =$clie->__get("Direccion"); //Le asignamos a las propiedades del objetos los campos de esa fila
$param[":Estado"] =$clie->__get("Estado"); //Le asignamos a las propiedades del objetos los campos de esa fila
$param[":Telefono"] =$clie->__get("Telefono"); //Le asignamos a las propiedades del objetos los campos de esa fila
$param[":CP"] =$clie->__get("CP"); //Le asignamos a las propiedades del objetos los campos de esa fila
$param[":Foto"] =$clie->__get("Foto"); //Le asignamos a las propiedades del objetos los campos de esa fila
$this->consultaSimple($consulta, $param);
}
/**
* Borra una situacion en la base de datos
* @param int El id de la situacion a borrar
* @return void
*/
public function borrar($NIF )
{ //Se introduce un objeto por parametro que se insertará
$consulta = " DELETE FROM clientes WHERE NIF= :NIF";
$param = array();
$param[":NIF"] = $NIF;
$this->consultaSimple($consulta, $param);
}
}
?>