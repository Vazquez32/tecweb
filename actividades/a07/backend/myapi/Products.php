<?php
namespace backend\myapi;

require_once 'DataBase.php';

class Productos extends DataBase {
    private $response = [];

    public function __construct(string $user, string $pass, string $db = 'marketzone') {
        parent::__construct($user, $pass, $db);
    }

    public function add($producto) {
        $stmt = $this->conexion->prepare("INSERT INTO productos (name, price) VALUES (?, ?)");
        $stmt->bind_param("sd", $producto->name, $producto->price);
        $stmt->execute();
        $stmt->close();
    }

    public function delete(string $id) {
        $stmt = $this->conexion->prepare("DELETE FROM productos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    public function edit($producto) {
        $stmt = $this->conexion->prepare("UPDATE productos SET name = ?, price = ? WHERE id = ?");
        $stmt->bind_param("sdi", $producto->name, $producto->price, $producto->id);
        $stmt->execute();
        $stmt->close();
    }

    public function list() {
        $sql = "SELECT * FROM productos";
        $this->response = $this->fetchResults($sql);
    }

    public function search(string $query) {
        $stmt = $this->conexion->prepare("SELECT * FROM productos WHERE name LIKE ?");
        $search = "%$query%";
        $stmt->bind_param("s", $search);
        $stmt->execute();
        $result = $stmt->get_result();
        $this->response = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
    }

    public function single(string $id) {
        $stmt = $this->conexion->prepare("SELECT * FROM productos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $this->response = $result->fetch_assoc();
        $stmt->close();
    }

    public function singleByName(string $name) {
        $stmt = $this->conexion->prepare("SELECT * FROM productos WHERE name = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $this->response = $result->fetch_assoc();
        $stmt->close();
    }

    public function getData(): string {
        if (empty($this->response)) {
            return json_encode(["message" => "No se encontraron resultados."]);
        }
        return json_encode($this->response);
    }

    protected function query(string $sql) {
        $result = $this->conexion->query($sql);
        if ($result === false) {
            throw new \Exception("Error en la consulta: " . $this->conexion->error);
        }
        return $result;
    }

    private function fetchResults(string $sql) {
        $result = $this->query($sql);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
}
