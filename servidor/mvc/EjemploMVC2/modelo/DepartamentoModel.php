<?php

class DepartamentoModel extends EntidadBase
{

    private $table;

    public function __construct()
    {
        $this->table = "departamentos";
        parent::__construct($this->table);
    }
    
    public function actualiza($dep, $nom, $loc)
    {
        $mensaje = "";
        $sql = "update $this->table  set dnombre=:dnom, loc=:loc where dept_no = :deptno;";
        $statement = $this->db->prepare($sql);
        
        $statement->bindParam(':deptno', $dep, PDO::PARAM_INT);
        $statement->bindParam(':dnom', $nom, PDO::PARAM_STR);
        $statement->bindParam(':loc', $loc, PDO::PARAM_STR);
        try {
            
            $save = $statement->execute();
            $mensaje = "DEPARTAMENTO ACTUALIZADO: " . $dep;
            
        } catch (PDOException $e) {
            
            // echo $e->getMessage();
            $mensaje= "DEPARTAMENTO NO CTUALIZADO. HA HABIDO ERRORES. COMPRUEBA DATOS:" . $dep;
        }
        
        return $mensaje;
    }
    

    public function save($dep, $nom, $loc)
    {
        $mensaje = "";
        $sql = "INSERT INTO $this->table  VALUES(:deptno, :dnom, :loc);";
        $statement = $this->db->prepare($sql);

        $statement->bindParam(':deptno', $dep, PDO::PARAM_INT);
        $statement->bindParam(':dnom', $nom, PDO::PARAM_STR);
        $statement->bindParam(':loc', $loc, PDO::PARAM_STR);
        try {

            $save = $statement->execute();
            $mensaje = "DEPARTAMENTO INSERTADO: " . $dep;
        
        } catch (PDOException $e) {

            // echo $e->getMessage();
            $mensaje= "DEPARTAMENTO NO INSERTADO. SEGURAMENTE SEA CLAVE DUPLICADA:" . $dep;
        }

        return $mensaje;
    }

    public function getAll()
    {
        $resultSet = array();
        try {

            $sql = "SELECT * FROM $this->table ;";
            $statement = $this->db->prepare($sql);
            $statement->execute();

            $table = $statement->fetchAll();
            foreach ($table as $row) {
                array_push($resultSet, new Departamentos($row['dept_no'], $row['dnombre'], $row['loc']));
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return $resultSet;
    }

    public function borrar($id)
    {
        $mensaje = "";
        try {
            $sql = "DELETE FROM $this->table where dept_no = :id;";
            $statement = $this->db->prepare($sql);

            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->execute();
            $mensaje = "DEPARTAMENTO BORRADO: " . $id;
        } catch (PDOException $e) {
            $mensaje = "HA OCURRIDO UN ERROR AL BORRAR. POSIBLE REGISTRO RELACIONADO: " . $id;
            // echo $e->getMessage();
        }
        return $mensaje;
    }

    public function getUnDepartamento($id)
    {
        $dep = null;
        try {
            $sql = "SELECT * FROM $this->table WHERE dept_no= :id;";
            $statement = $this->db->prepare($sql);

            $statement->bindParam(':id', $id, PDO::PARAM_INT);

            $statement->execute();

            if ($statement->rowCount() == 1) {
                $row = $statement->fetch();
                $dep = new Departamentos($row['dept_no'], $row['dnombre'], $row['loc']);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $dep;
    }
}
?>