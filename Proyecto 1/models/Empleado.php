<?php
class Empleado {
    private $conn;
    private $table_name = "empleados";

    public $nombre;
    public $salario_base;
    public $comision_pct;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function listar() {
        $query = "SELECT nombre, salario_base, comision_pct FROM " . $this->table_name . " ORDER BY nombre ASC";
        $result = $this->conn->query($query);
    }

    public function registrar() {
        $query = "INSERT INTO " . $this->table_name . " (nombre, salario_base, comision_pct) VALUES (?, ?, ?)";
        
        $stmt = $this->conn->prepare($query);

        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->salario_base = htmlspecialchars(strip_tags($this->salario_base));
        $this->comision_pct = htmlspecialchars(strip_tags($this->comision_pct));

        $stmt->bind_param("sdd", $this->nombre, $this->salario_base, $this->comision_pct);

        if ($stmt->execute()) {
            $stmt->close();
            return true;
        }
        
        $stmt->close();
        return false;
    }
}