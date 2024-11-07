<?php
namespace Backend;

class DataBase {
    protected $conexion;

    public function __construct($config) {
        // Verificar que las claves existan en el array
        if (isset($config['host'], $config['user'], $config['password'], $config['dbname'])) {
            $this->connect($config);
        } else {
            throw new Exception("Faltan parámetros en la configuración de la base de datos.");
        }
    }

    // Método para conectarse a la base de datos
    public function connect($config) {
        $this->conexion = new mysqli(
            $config['host'], 
            $config['user'], 
            $config['password'], 
            $config['dbname']
        );

        if ($this->conexion->connect_error) {
            die('Error de conexión (' . $this->conexion->connect_errno . ') ' . $this->conexion->connect_error);
        }
    }
}
?>
