<?php
/**
 * Clase EquipoDao - Data Access Object para la entidad Equipo
 * 
 * Proporciona métodos para realizar operaciones CRUD (Crear, Leer, Actualizar, Eliminar)
 * sobre la tabla equipos, así como funcionalidades específicas como cambiar posiciones
 * de equipos en la clasificación.
 *
 * @author Tu Nombre
 */
require_once 'Database.php';
require_once 'Equipo.php';

class EquipoDao extends Database
{
    /**
     * Array asociativo que almacena los equipos cargados de la base de datos
     * Cada equipo se indexa por su ID para facilitar el acceso
     */
    public $equipos = array();

    /**
     * Constructor de la clase
     * Inicializa la conexión a la base de datos heredada de Database
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Carga todos los equipos de la base de datos ordenados por posición
     * y los almacena en la propiedad $equipos indexados por ID
     */
    public function listarEquipos()
    {
        $consulta = "SELECT * FROM equipos ORDER BY Puesto ASC";
        $filas = $this->query($consulta, [])->fetchAll();

        $this->equipos = []; // Reiniciar el array para evitar duplicados

        foreach ($filas as $fila) {
            $equipo = new Equipo();
            $equipo->__set('id', $fila['Id']);
            $equipo->__set('nombre', $fila['Nombre']);
            $equipo->__set('fecha_fundacion', $fila['FechaFund']);
            $equipo->__set('presupuesto', $fila['Presupuesto']);
            $equipo->__set('puesto', $fila['Puesto']);
            $equipo->__set('logo', $fila['Logo']);

            // Usar el ID como clave en el array para acceso directo
            $this->equipos[$fila['Id']] = $equipo;
        }
    }

    /**
     * Inserta un nuevo equipo en la base de datos
     * Si no se proporciona un puesto, asigna automáticamente el siguiente
     * 
     * @param Equipo $equipo Objeto equipo con los datos a insertar
     */
    public function insertar($equipo)
    {
        // Obtener el último puesto si no se proporciona uno
        if (empty($equipo->__get('puesto'))) {
            $consultaPuesto = "SELECT MAX(Puesto) as max_puesto FROM equipos";
            $resultado = $this->query($consultaPuesto, [])->fetch();
            $equipo->__set('puesto', ($resultado['max_puesto'] + 1));
        }

        $consulta = "INSERT INTO equipos (Nombre, FechaFund, Presupuesto, Puesto, Logo) VALUES (?, ?, ?, ?, ?)";
        $this->query($consulta, [
            $equipo->__get('nombre'),
            $equipo->__get('fecha_fundacion'),
            $equipo->__get('presupuesto'),
            $equipo->__get('puesto'),
            $equipo->__get('logo')
        ]);
    }

    /**
     * Actualiza los datos de un equipo existente
     * Preserva el logo actual si no se proporciona uno nuevo
     * 
     * @param Equipo $equipo Objeto equipo con los datos actualizados y el ID del equipo a actualizar
     */
    public function actualizar($equipo)
    {
        $consulta = "UPDATE equipos SET Nombre = ?, FechaFund = ?, Presupuesto = ?, Puesto = ?, Logo = ? WHERE Id = ?";

        // Si el logo está vacío, obtener el logo actual para no borrarlo
        if ($equipo->__get('logo') === "") {
            $equipoActual = new Equipo();
            $equipoActual->__set('id', $equipo->__get('id'));
            $this->buscar($equipoActual);
            $equipo->__set('logo', $equipoActual->__get('logo'));
        }

        $this->query($consulta, [
            $equipo->__get('nombre'),
            $equipo->__get('fecha_fundacion'),
            $equipo->__get('presupuesto'),
            $equipo->__get('puesto'),
            $equipo->__get('logo'),
            $equipo->__get('id')
        ]);
    }

    /**
     * Elimina un equipo de la base de datos
     * 
     * @param Equipo $equipo Objeto equipo con el ID del equipo a eliminar
     */
    public function borrar($equipo)
    {
        $consulta = "DELETE FROM equipos WHERE Id = ?";
        $this->query($consulta, [$equipo->__get('id')]);
    }

    /**
     * Busca un equipo por su ID y completa el objeto con los datos encontrados
     * 
     * @param Equipo $equipo Objeto equipo con el ID a buscar, que se completará con los datos
     */
    public function buscar($equipo)
    {
        $consulta = "SELECT * FROM equipos WHERE Id = ?";
        $fila = $this->query($consulta, [$equipo->__get('id')])->fetch();

        $equipo->__set('nombre', $fila['Nombre']);
        $equipo->__set('fecha_fundacion', $fila['FechaFund']);
        $equipo->__set('presupuesto', $fila['Presupuesto']);
        $equipo->__set('puesto', $fila['Puesto']);
        $equipo->__set('logo', $fila['Logo']);
    }

    /**
     * Busca un equipo por su nombre y completa el objeto con los datos encontrados
     * 
     * @param Equipo $equipo Objeto equipo con el nombre a buscar, que se completará con los datos
     */
    public function buscarPorNombre($equipo)
    {
        $consulta = "SELECT * FROM equipos WHERE Nombre = ?";
        $fila = $this->query($consulta, [$equipo->__get('nombre')])->fetch();

        $equipo->__set('id', $fila['Id']);
        $equipo->__set('fecha_fundacion', $fila['FechaFund']);
        $equipo->__set('presupuesto', $fila['Presupuesto']);
        $equipo->__set('puesto', $fila['Puesto']);
        $equipo->__set('logo', $fila['Logo']);
    }

    /**
     * Sube un equipo una posición en la clasificación intercambiando su puesto con el anterior
     * 
     * @param int $id ID del equipo a subir
     * @param int|null $puesto Puesto actual del equipo (opcional)
     * @return bool True si se pudo subir, False si ya estaba en la primera posición
     */
    public function subirPuesto($id, $puesto = null)
    {
        // Encontrar el equipo actual y el anterior
        $consulta = "SELECT * FROM equipos ORDER BY Puesto ASC";
        $filas = $this->query($consulta, [])->fetchAll();

        $posicionActual = -1;
        $posicionAnterior = -1;

        // Buscar las posiciones actual y anterior
        for ($i = 0; $i < count($filas); $i++) {
            if ($filas[$i]['Id'] == $id) {
                $posicionActual = $filas[$i]['Puesto'];
                if ($i > 0) {
                    $posicionAnterior = $filas[$i - 1]['Puesto'];
                    $idAnterior = $filas[$i - 1]['Id'];
                }
                break;
            }
        }

        // Verificar si está en la primera posición
        if ($posicionActual <= 1 || $posicionAnterior == -1) {
            return false; // Ya está en la primera posición
        }

        // Intercambiar posiciones sin modificar IDs
        $consulta1 = "UPDATE equipos SET Puesto = ? WHERE Id = ?";
        $consulta2 = "UPDATE equipos SET Puesto = ? WHERE Id = ?";

        $this->query($consulta1, [$posicionAnterior, $id]);
        $this->query($consulta2, [$posicionActual, $idAnterior]);

        return true;
    }

    /**
     * Baja un equipo una posición en la clasificación intercambiando su puesto con el siguiente
     * 
     * @param int $id ID del equipo a bajar
     * @param int|null $puesto Puesto actual del equipo (opcional)
     * @return bool True si se pudo bajar, False si ya estaba en la última posición
     */
    public function bajarPuesto($id, $puesto = null)
    {
        // Encontrar el equipo actual y el siguiente
        $consulta = "SELECT * FROM equipos ORDER BY Puesto ASC";
        $filas = $this->query($consulta, [])->fetchAll();

        $posicionActual = -1;
        $posicionSiguiente = -1;

        // Buscar las posiciones actual y siguiente
        for ($i = 0; $i < count($filas); $i++) {
            if ($filas[$i]['Id'] == $id) {
                $posicionActual = $filas[$i]['Puesto'];
                if ($i < count($filas) - 1) {
                    $posicionSiguiente = $filas[$i + 1]['Puesto'];
                    $idSiguiente = $filas[$i + 1]['Id'];
                }
                break;
            }
        }

        // Verificar si está en la última posición
        if ($posicionSiguiente == -1) {
            return false; // Ya está en la última posición
        }

        // Intercambiar posiciones sin modificar IDs
        $consulta1 = "UPDATE equipos SET Puesto = ? WHERE Id = ?";
        $consulta2 = "UPDATE equipos SET Puesto = ? WHERE Id = ?";

        $this->query($consulta1, [$posicionSiguiente, $id]);
        $this->query($consulta2, [$posicionActual, $idSiguiente]);

        return true;
    }
}