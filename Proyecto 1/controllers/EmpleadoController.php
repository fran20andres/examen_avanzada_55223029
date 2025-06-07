<?php
require_once 'config/database.php';
require_once 'models/Empleado.php';

class EmpleadoController {
    private $empleado;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->empleado = new Empleado($db);
    }

    public function index() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->empleado->nombre = $_POST['nombre'];
            $this->empleado->salario_base = $_POST['salario_base'];
            $this->empleado->comision_pct = $_POST['comision_pct'];
            
            if ($this->empleado->registrar()) {
                header("Location: index.php");
                exit();
            }
        }

        $stmt = $this->empleado->listar();
        
        $empleados_preparados = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $salario_base = $row['salario_base'];
            $comision_pct = $row['comision_pct'];
            $salario_total = $salario_base + ($salario_base * $comision_pct / 100);

            $empleados_preparados[] = [
                'nombre' => $row['nombre'],
                'salario_base_fmt' => "$" . number_format($salario_base, 2),
                'comision_pct_fmt' => number_format($comision_pct, 2) . "%",
                'salario_total_fmt' => "$" . number_format($salario_total, 2)
            ];
        }

        require 'views/vista_empleados.php';
    }
}
