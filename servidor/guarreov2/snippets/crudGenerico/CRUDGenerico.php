<?php
/**
 * Clase para generar un CRUD dinámico para cualquier tabla
 */
class CRUDGenerico {
    private $db;
    private $tableName;
    private $primaryKey;
    private $columns = [];
    private $dateFields = [];
    private $imageFields = [];
    private $readOnlyFields = [];
    private $recordsPerPage = 5;
    private $currentPage = 1;
    private $whereParams = [];

    /**
     * Constructor
     *
     * @param Database $db Instancia de la clase de conexión a la base de datos
     * @param string $tableName Nombre de la tabla
     * @param array $config Configuración adicional
     */
    public function __construct($db, $tableName, $config = []) {
        $this->db = $db;
        $this->tableName = $tableName;
        
        // Configuración con valores por defecto
        $this->primaryKey = isset($config['primaryKey']) ? $config['primaryKey'] : $this->detectPrimaryKey();
        $this->dateFields = isset($config['dateFields']) ? $config['dateFields'] : [];
        $this->imageFields = isset($config['imageFields']) ? $config['imageFields'] : [];
        $this->readOnlyFields = isset($config['readOnlyFields']) ? $config['readOnlyFields'] : [$this->primaryKey];
        
        // Detectar las columnas de la tabla
        $this->detectColumns();
    }

    /**
     * Detecta la clave primaria de la tabla
     *
     * @return string Nombre de la columna que es clave primaria
     */
    private function detectPrimaryKey() {
        // Aquí se podría implementar una detección automática usando información del esquema
        // Para simplificar, asumimos que el campo ID o el nombre de la tabla con "Id" es la clave primaria
        return "Id" . $this->tableName;
    }

    /**
     * Detecta las columnas de la tabla
     */
    private function detectColumns() {
        $query = "SHOW COLUMNS FROM " . $this->tableName;
        $statement = $this->db->query($query);
        $columns = $statement->fetchAll();
        
        foreach ($columns as $column) {
            $this->columns[] = $column['Field'];
        }
    }

    /**
     * Procesa la acción de insertar
     */
    public function insert() {
        if (!isset($_POST['Insertar'])) return;

        $params = [];
        $values = [];
        $placeholders = [];

        foreach ($this->columns as $column) {
            if (isset($_POST[$column])) {
                $value = $_POST[$column];
                
                // Si es un campo de fecha, convertir a timestamp
                if (in_array($column, $this->dateFields) && !empty($value)) {
                    $value = $this->dateToTimestamp($value);
                }
                
                $params[":{$column}"] = $value;
                $values[] = $column;
                $placeholders[] = ":{$column}";
            }
        }

        // Manejar campos de imagen
        foreach ($this->imageFields as $imageField) {
            if (isset($_FILES[$imageField]) && $_FILES[$imageField]['name'] != "") {
                $fileContent = file_get_contents($_FILES[$imageField]['tmp_name']);
                $params[":{$imageField}"] = base64_encode($fileContent);
                $values[] = $imageField;
                $placeholders[] = ":{$imageField}";
            }
        }

        $query = "INSERT INTO {$this->tableName} (" . implode(", ", $values) . ") VALUES (" . implode(", ", $placeholders) . ")";
        $this->db->query($query, $params);
    }

    /**
     * Procesa la acción de borrar
     */
    public function delete() {
        if (!isset($_POST['Borrar']) || !isset($_POST['Selec'])) return;

        $selected = $_POST['Selec'];

        foreach ($selected as $key => $value) {
            $query = "DELETE FROM {$this->tableName} WHERE {$this->primaryKey} = :id";
            $params = [':id' => $key];
            $this->db->query($query, $params);
        }
    }

    /**
     * Procesa la acción de actualizar
     */
    public function update() {
        if (!isset($_POST['Actualizar']) || !isset($_POST['Selec'])) return;

        $selected = $_POST['Selec'];

        foreach ($selected as $key => $value) {
            $setClause = [];
            $params = [':id' => $key];

            foreach ($this->columns as $column) {
                $fieldName = $column . 's'; // Sufijo para diferenciar los campos de actualización
                
                if (isset($_POST[$fieldName][$key])) {
                    $value = $_POST[$fieldName][$key];
                    
                    // Si es un campo de fecha, convertir a timestamp
                    if (in_array($column, $this->dateFields) && !empty($value)) {
                        $value = $this->dateToTimestamp($value);
                    }
                    
                    $setClause[] = "{$column} = :{$column}";
                    $params[":{$column}"] = $value;
                }
            }

            // Manejar campos de imagen
            foreach ($this->imageFields as $imageField) {
                $fieldName = $imageField . 's'; // Sufijo para diferenciar los campos de actualización
                
                if (isset($_FILES[$fieldName]['name'][$key]) && $_FILES[$fieldName]['name'][$key] != "") {
                    $tempName = $_FILES[$fieldName]['tmp_name'][$key];
                    $fileContent = file_get_contents($tempName);
                    $setClause[] = "{$imageField} = :{$imageField}";
                    $params[":{$imageField}"] = base64_encode($fileContent);
                }
            }

            if (!empty($setClause)) {
                $query = "UPDATE {$this->tableName} SET " . implode(", ", $setClause) . " WHERE {$this->primaryKey} = :id";
                $this->db->query($query, $params);
            }
        }
    }

    /**
     * Procesa la acción de búsqueda
     */
    public function search() {
        if (!isset($_POST['Buscar'])) return;

        $this->whereParams = [];
        $where = [];

        foreach ($this->columns as $column) {
            if (isset($_POST[$column]) && $_POST[$column] !== '') {
                $value = $_POST[$column];
                
                // Si es un campo de fecha, convertir a timestamp
                if (in_array($column, $this->dateFields) && !empty($value)) {
                    $value = $this->dateToTimestamp($value);
                }
                
                $where[] = "{$column} = :{$column}";
                $this->whereParams[":{$column}"] = $value;
            }
        }

        return !empty($where) ? implode(" AND ", $where) : "1";
    }

    /**
     * Configura la paginación
     */
    public function configPagination() {
        // Establecer la página actual
        if (isset($_GET['NumPag'])) {
            $this->currentPage = $_GET['NumPag'];
        }

        // Establecer registros por página
        if (isset($_POST['NumReg'])) {
            $this->recordsPerPage = $_POST['NumReg'];
        } elseif (isset($_GET['NumReg'])) {
            $this->recordsPerPage = $_GET['NumReg'];
        }
    }

    /**
     * Obtiene los datos según la paginación y condiciones de búsqueda
     */
    public function getData() {
        $start = ($this->currentPage - 1) * $this->recordsPerPage;
        
        $where = "1"; // Por defecto sin condiciones
        
        if (isset($_POST['Buscar'])) {
            $where = $this->search();
        }
        
        $query = "SELECT * FROM {$this->tableName} WHERE {$where} LIMIT {$start}, {$this->recordsPerPage}";
        $statement = $this->db->query($query, $this->whereParams);
        return $statement->fetchAll();
    }

    /**
     * Renderiza la interfaz del CRUD
     */
    public function render() {
        $data = $this->getData();
        
        echo "<fieldset>";
        echo "<form name='f1' method='post' action='{$_SERVER['PHP_SELF']}' enctype='multipart/form-data'>";
        
        echo "<input type='submit' name='Actualizar' value='Actualizar'>";
        echo "<input type='submit' name='Borrar' value='Borrar'>";
        echo "<input type='submit' name='Insertar' value='Insertar'>";
        echo "<input type='submit' name='Buscar' value='Buscar'>";
        
        echo "<table border='2'>";
        echo "<thead><tr><th>Selec</th>";
        
        foreach ($this->columns as $column) {
            echo "<th>{$column}</th>";
        }
        
        echo "</tr></thead>";
        echo "<tbody>";
        
        // Fila para inserción/búsqueda
        echo "<tr><td><b>+</b></td>";
        
        foreach ($this->columns as $column) {
            echo "<td>";
            
            if (in_array($column, $this->imageFields)) {
                echo "<input type='file' name='{$column}'>";
            } 
            elseif (in_array($column, $this->dateFields)) {
                echo "<input type='text' name='{$column}' placeholder='dd/mm/yyyy' size='10'>";
            }
            else {
                echo "<input type='text' name='{$column}' size='10'>";
            }
            
            echo "</td>";
        }
        
        echo "</tr>";
        
        // Filas con datos
        foreach ($data as $row) {
            echo "<tr>";
            echo "<td><input type='checkbox' name='Selec[{$row[$this->primaryKey]}]'></td>";
            
            foreach ($this->columns as $column) {
                echo "<td>";
                
                if (in_array($column, $this->dateFields)) {
                    // Formatear fecha
                    $date = getdate($row[$column]);
                    $formattedDate = $date['mday'] . "/" . $date['mon'] . "/" . $date['year'];
                    
                    echo "<input type='text' name='{$column}s[{$row[$this->primaryKey]}]' value='{$formattedDate}' size='10'>";
                }
                elseif (in_array($column, $this->imageFields)) {
                    // Mostrar imagen y campo para actualizarla
                    echo "<img src='data:image/jpg;base64,{$row[$column]}' width='80' height='80'>";
                    echo "<input type='file' name='{$column}s[{$row[$this->primaryKey]}]'>";
                }
                else {
                    // Campos normales
                    $readonly = in_array($column, $this->readOnlyFields) ? " readonly='readonly'" : "";
                    echo "<input type='text' name='{$column}s[{$row[$this->primaryKey]}]' value='{$row[$column]}' size='10'{$readonly}>";
                }
                
                echo "</td>";
            }
            
            echo "</tr>";
        }
        
        echo "</tbody></table>";
        echo "</form>";
        
        // Paginación
        $this->renderPagination();
        
        echo "</fieldset>";
    }

    /**
     * Renderiza la paginación
     */
    private function renderPagination() {
        // Contar registros totales
        $query = "SELECT COUNT(*) as total FROM {$this->tableName}";
        $statement = $this->db->query($query);
        $result = $statement->fetch();
        $total = $result['total'];
        
        // Calcular número de páginas
        $totalPages = ceil($total / $this->recordsPerPage);
        
        // Mostrar enlaces de paginación
        for ($i = 1; $i <= $totalPages; $i++) {
            echo "<a href='{$_SERVER['PHP_SELF']}?NumReg={$this->recordsPerPage}&NumPag={$i}'>{$i}</a>&nbsp;";
        }
    }

    /**
     * Convierte una fecha en formato dd/mm/yyyy a timestamp
     */
    private function dateToTimestamp($dateString) {
        $parts = explode("/", $dateString);
        if (count($parts) !== 3) return null;
        
        return mktime(0, 0, 0, $parts[1], $parts[0], $parts[2]);
    }
}
?>