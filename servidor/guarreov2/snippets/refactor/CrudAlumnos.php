<?php
/**
 * CRUD de Alumnos - Sistema refactorizado
 * 
 * Un sistema mejorado para gestionar alumnos con búsqueda y paginación
 * usando programación orientada a objetos y separación de responsabilidades
 */

require_once 'Database.php';
date_default_timezone_set('UTC');

class AlumnosManager {
    private $db;
    private $recordsPerPage = 5;
    private $currentPage = 1;
    private $searchParams = [];
    
    /**
     * Constructor de la clase
     */
    public function __construct($database) {
        $this->db = $database;
        $this->configurePagination();
    }
    
    /**
     * Configura los parámetros de paginación desde GET/POST
     */
    private function configurePagination() {
        // Establecer la página actual
        if (isset($_GET['NumPag'])) {
            $this->currentPage = (int)$_GET['NumPag'];
        }
        
        // Establecer registros por página
        if (isset($_POST['NumReg'])) {
            $this->recordsPerPage = (int)$_POST['NumReg'];
        } elseif (isset($_GET['NumReg'])) {
            $this->recordsPerPage = (int)$_GET['NumReg'];
        }
    }
    
    /**
     * Convierte una fecha en formato dd/mm/yyyy a timestamp
     */
    private function dateToTimestamp($dateString) {
        if (empty($dateString)) return null;
        
        $parts = explode("/", $dateString);
        if (count($parts) !== 3) return null;
        
        return mktime(0, 0, 0, $parts[1], $parts[0], $parts[2]);
    }
    
    /**
     * Convierte un timestamp a fecha en formato dd/mm/yyyy
     */
    private function timestampToDate($timestamp) {
        $date = getdate($timestamp);
        return $date['mday'] . "/" . $date['mon'] . "/" . $date['year'];
    }
    
    /**
     * Procesa la inserción de un nuevo alumno
     */
    public function insertAlumno() {
        if (!isset($_POST['Insertar'])) return;
        
        $params = [
            ':NIF' => $_POST['NIF'],
            ':Nombre' => $_POST['Nombre'],
            ':Apellido1' => $_POST['Apellido1'],
            ':Apellido2' => $_POST['Apellido2'],
            ':Telefono' => $_POST['Telefono'],
            ':Premios' => $_POST['Premios'],
            ':FechaNac' => $this->dateToTimestamp($_POST['FechaNac'])
        ];
        
        // Procesar la foto si existe
        if ($_FILES['Foto']['name'] != "") {
            $params[':Foto'] = base64_encode(
                file_get_contents($_FILES['Foto']['tmp_name'])
            );
        } else {
            $params[':Foto'] = "";
        }
        
        $query = "INSERT INTO Alumnos VALUES (:NIF, :Nombre, :Apellido1, :Apellido2, 
                 :Telefono, :Premios, :FechaNac, :Foto)";
                 
        $this->db->query($query, $params);
    }
    
    /**
     * Procesa el borrado de alumnos seleccionados
     */
    public function deleteAlumnos() {
        if (!isset($_POST['Borrar']) || !isset($_POST['Selec'])) return;
        
        foreach ($_POST['Selec'] as $nif => $value) {
            $query = "DELETE FROM Alumnos WHERE NIF = :NIF";
            $this->db->query($query, [':NIF' => $nif]);
        }
    }
    
    /**
     * Procesa la actualización de alumnos seleccionados
     */
    public function updateAlumnos() {
        if (!isset($_POST['Actualizar']) || !isset($_POST['Selec'])) return;
        
        foreach ($_POST['Selec'] as $nif => $value) {
            $params = [
                ':NIF' => $nif,
                ':Nombre' => $_POST['Nombres'][$nif],
                ':Apellido1' => $_POST['Apellido1s'][$nif],
                ':Apellido2' => $_POST['Apellido2s'][$nif],
                ':Telefono' => $_POST['Telefonos'][$nif],
                ':Premios' => $_POST['Premioss'][$nif],
                ':FechaNac' => $this->dateToTimestamp($_POST['FechaNacs'][$nif])
            ];
            
            $query = "UPDATE Alumnos SET 
                      Nombre = :Nombre,
                      Apellido1 = :Apellido1,
                      Apellido2 = :Apellido2,
                      Telefono = :Telefono,
                      Premios = :Premios,
                      FechaNac = :FechaNac";
            
            // Actualizar foto si se proporciona una nueva
            if (!empty($_FILES['Fotos']['name'][$nif])) {
                $params[':Foto'] = base64_encode(
                    file_get_contents($_FILES['Fotos']['tmp_name'][$nif])
                );
                $query .= ", Foto = :Foto";
            }
            
            $query .= " WHERE NIF = :NIF";
            $this->db->query($query, $params);
        }
    }
    
    /**
     * Procesa la búsqueda de alumnos
     */
    public function searchAlumnos() {
        if (!isset($_POST['Buscar'])) return;
        
        $searchFields = ['NIF', 'Nombre', 'Apellido1', 'Apellido2', 'Telefono', 'Premios', 'FechaNac'];
        $query = "SELECT * FROM Alumnos WHERE 1";
        $params = [];
        
        foreach ($searchFields as $field) {
            if (!empty($_POST[$field])) {
                if ($field === 'FechaNac') {
                    $query .= " AND FechaNac = :FechaNac";
                    $params[':FechaNac'] = $this->dateToTimestamp($_POST[$field]);
                } else {
                    $query .= " AND $field = :$field";
                    $params[":$field"] = $_POST[$field];
                }
            }
        }
        
        $this->searchParams = $params;
        return $query;
    }
    
    /**
     * Obtiene los alumnos según los criterios de búsqueda y paginación
     */
    public function getAlumnos() {
        $start = ($this->currentPage - 1) * $this->recordsPerPage;
        
        $query = "SELECT * FROM Alumnos WHERE 1";
        $params = [];
        
        if (isset($_POST['Buscar'])) {
            $query = $this->searchAlumnos();
            $params = $this->searchParams;
        }
        
        $query .= " LIMIT $start, {$this->recordsPerPage}";
        $statement = $this->db->query($query, $params)->fetchAll();
        
        return $statement;
    }
    
    /**
     * Obtiene el número total de páginas
     */
    public function getTotalPages() {
        $query = "SELECT COUNT(*) as total FROM Alumnos";
        $statement = $this->db->query($query)->fetchAll();
        $totalRecords = $statement[0]['total'];
        
        return ceil($totalRecords / $this->recordsPerPage);
    }
    
    /**
     * Genera el HTML para la paginación
     */
    public function renderPagination() {
        $totalPages = $this->getTotalPages();
        $html = '';
        
        for ($i = 1; $i <= $totalPages; $i++) {
            $html .= "<a href='{$_SERVER['PHP_SELF']}?NumReg={$this->recordsPerPage}&NumPag=$i'> $i </a>&nbsp;";
        }
        
        return $html;
    }
    
    /**
     * Genera el HTML para el formulario CRUD
     */
    public function renderForm() {
        $alumnos = $this->getAlumnos();
        
        ob_start(); // Inicia el buffer de salida
        ?>
        <form name="f1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <div class="button-group">
                <input type="submit" name="Actualizar" value="Actualizar">
                <input type="submit" name="Borrar" value="Borrar">
                <input type="submit" name="Insertar" value="Insertar">
                <input type="submit" name="Buscar" value="Buscar">
            </div>
            
            <table border="2" class="crud-table">
                <thead>
                    <tr>
                        <th>Selec</th>
                        <th>NIF</th>
                        <th>Nombre</th>
                        <th>Apellido1</th>
                        <th>Apellido2</th>
                        <th>Telefono</th>
                        <th>Premio</th>
                        <th>Fecha Nac</th>
                        <th>Foto</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Fila para inserción/búsqueda -->
                    <tr class="input-row">
                        <td><b>+</b></td>
                        <td><input type="text" name="NIF" size="10"></td>
                        <td><input type="text" name="Nombre" size="10"></td>
                        <td><input type="text" name="Apellido1" size="10"></td>
                        <td><input type="text" name="Apellido2" size="10"></td>
                        <td><input type="text" name="Telefono" size="10"></td>
                        <td><input type="text" name="Premios" size="10"></td>
                        <td><input type="text" name="FechaNac" placeholder="dd/mm/yyyy" size="10"></td>
                        <td><input type="file" name="Foto"></td>
                    </tr>
                    
                    <!-- Filas con datos de alumnos -->
                    <?php foreach ($alumnos as $alumno): ?>
                    <tr>
                        <td><input type="checkbox" name="Selec[<?php echo $alumno['NIF']; ?>]"></td>
                        <td>
                            <input type="text" name="NIFs[<?php echo $alumno['NIF']; ?>]" 
                                   value="<?php echo $alumno['NIF']; ?>" size="10" readonly>
                        </td>
                        <td>
                            <input type="text" name="Nombres[<?php echo $alumno['NIF']; ?>]" 
                                   value="<?php echo $alumno['Nombre']; ?>" size="10">
                        </td>
                        <td>
                            <input type="text" name="Apellido1s[<?php echo $alumno['NIF']; ?>]" 
                                   value="<?php echo $alumno['Apellido1']; ?>" size="10">
                        </td>
                        <td>
                            <input type="text" name="Apellido2s[<?php echo $alumno['NIF']; ?>]" 
                                   value="<?php echo $alumno['Apellido2']; ?>" size="10">
                        </td>
                        <td>
                            <input type="text" name="Telefonos[<?php echo $alumno['NIF']; ?>]" 
                                   value="<?php echo $alumno['Telefono']; ?>" size="10">
                        </td>
                        <td>
                            <input type="text" name="Premioss[<?php echo $alumno['NIF']; ?>]" 
                                   value="<?php echo $alumno['Premios']; ?>" size="10">
                        </td>
                        <td>
                            <input type="text" name="FechaNacs[<?php echo $alumno['NIF']; ?>]" 
                                   value="<?php echo $this->timestampToDate($alumno['FechaNac']); ?>" size="10">
                        </td>
                        <td>
                            <?php if (!empty($alumno['Foto'])): ?>
                                <img src="data:image/jpg;base64,<?php echo $alumno['Foto']; ?>" width="80" height="80">
                            <?php endif; ?>
                            <input type="file" name="Fotos[<?php echo $alumno['NIF']; ?>]">
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <div class="pagination">
                <?php echo $this->renderPagination(); ?>
            </div>
        </form>
        <?php
        return ob_get_clean(); // Devuelve el contenido del buffer y lo limpia
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Alumnos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        fieldset {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
        }
        .button-group {
            margin-bottom: 15px;
        }
        input[type="submit"] {
            margin-right: 10px;
            padding: 5px 10px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            cursor: pointer;
        }
        .crud-table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }
        .crud-table th, .crud-table td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        .crud-table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        .input-row {
            background-color: #f8f9fa;
        }
        .pagination {
            margin-top: 15px;
        }
        .pagination a {
            display: inline-block;
            padding: 3px 8px;
            margin: 0 3px;
            border: 1px solid #ddd;
            text-decoration: none;
            color: #007bff;
        }
        .pagination a:hover {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <h1>Gestión de Alumnos</h1>
    
    <fieldset>
        <?php
            // Inicializar y ejecutar el gestor de alumnos
            $db = new Database();
            $manager = new AlumnosManager($db);
            
            // Procesar acciones
            $manager->insertAlumno();
            $manager->deleteAlumnos();
            $manager->updateAlumnos();
            
            // Renderizar el formulario
            echo $manager->renderForm();
        ?>
    </fieldset>
</body>
</html>