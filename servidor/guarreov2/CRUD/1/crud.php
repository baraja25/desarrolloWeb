<?php

require_once 'Database.php';

class Crud {
    private $db;
    private $data;

    public function __construct($query) {
        $this->db = new Database();
        $this->data = $this->db->query($query, [])->fetchAll();
    }
    
    public function generateTable() {
        $html = "<table border='1'>";
        $html .= "<tr>";
        
        foreach ($this->data[0] as $key => $value) {
            if ($key == 'Id') { // No mostrar el ID
                continue;
            }
            
            $html .= "<th>$key</th>";
        }
        $html .= "<th>Acciones</th>";
        $html .= "</tr>";
        $html .= "<tr>";
        
        foreach ($this->data[0] as $key => $value) {
            
            if ($key == 'Logo') { 
                $html .= "<td><input type='file' name='Logo'></td>";
            } elseif ($key == 'FechaFund') {
                $html .= "<td><input type='date' name='FechaFund'></td>";
            } elseif ($key == 'Id') { // No mostrar el ID
                continue;
            } elseif ($key == 'Puesto') {
                $html .= "<td><input type='text' name='Puesto'></td>";
            } elseif ($key == 'Nombre') {
                $html .= "<td><input type='text' name='Nombre'></td>";
            } elseif ($key == 'Presupuesto') {
                $html .= "<td><input type='text' name='Presupuesto'></td>";
            }
        
        }
        $html .= "<td><input type='submit' name='insertar' value='Insertar'></td>";
        $html .= "</tr>";

        foreach ($this->data as $row) {
              
            $html .= "<tr>";

            foreach ($row as $key => $value) {


                if ($key == 'Logo') {
                    $value = "<img src='data:image/png;base64,$value' width='100' height='100'>";
                } else if ($key == 'FechaFund') {
                    $value = date('d/m/Y', $value);
                } else if ($key == 'Id') { // No mostrar el ID
                    continue;
                }
                $html .= "<td>$value</td>";

                
            }
            $html .= "<td><a href='editar.php?id={$row['Id']}'>Editar </a>";
            $html .= "<input type='hidden' name='id' value='{$row['Id']}'>";
            $html .= "<input type='submit' name='borrar' value='Borrar'></td>";
            $html .= "</tr>";
        }
        $html .= "</table>";
        return $html;
    }


    public function executeQuery($query, $params) {
        return $this->db->query($query, $params);
    }

    public function delete($id) {
        $query = "DELETE FROM equipos WHERE Id = :id";
        $params = [':id' => $id];
        return $this->executeQuery($query, $params);
    }
}



$crud = new Crud("SELECT * FROM equipos ORDER BY Puesto ASC");


if (isset($_POST['insertar'])) {
    $nombre = isset($_POST['Nombre']) ? $_POST['Nombre'] : '';
    $logo = isset($_FILES['Logo']['tmp_name']) && !empty($_FILES['Logo']['tmp_name']) ? file_get_contents($_FILES['Logo']['tmp_name']) : '';
    $fechaFund = isset($_POST['FechaFund']) ? strtotime($_POST['FechaFund']) : '';
    $puesto = isset($_POST['Puesto']) ? $_POST['Puesto'] : '';
    $presupuesto = isset($_POST['Presupuesto']) ? $_POST['Presupuesto'] : '';

    $query = "INSERT INTO equipos (Nombre, Logo, FechaFund, Presupuesto, Puesto) VALUES (:nombre, :logo, :fechaFund, :Presupuesto, :puesto)";
    $params = [
        ':nombre' => $nombre,
        ':logo' => base64_encode($logo),
        ':fechaFund' => $fechaFund,
        ':puesto' => $puesto,
        ':Presupuesto' => $presupuesto
    ];

    $crud->executeQuery($query, $params);

    
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if (isset($_POST['borrar'])) {
    $id = $_POST['id'];
    $crud->delete($id);
    header("Location: " . $_SERVER['PHP_SELF']);
}


?>
<form method="POST" enctype="multipart/form-data">
    <?php echo $crud->generateTable(); ?>
</form>