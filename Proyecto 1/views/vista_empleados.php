<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nómina de Empleados</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Nómina de Empleados</h1>

    <h2>Registrar Empleado</h2>
    <form action="index.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="salario_base">Salario Base:</label>
        <input type="number" step="0.01" id="salario_base" name="salario_base" required>

        <label for="comision_pct">Comisión (%):</label>
        <input type="number" step="0.01" id="comision_pct" name="comision_pct" required>

        <input type="submit" value="Guardar Empleado">
    </form>

    <hr>

    <h2>Listado de Empleados</h2>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Salario Base</th>
                <th>Comisión</th>
                <th>Salario Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($empleados_preparados as $empleado) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($empleado['nombre']) . "</td>";
                echo "<td>" . $empleado['salario_base_fmt'] . "</td>";
                echo "<td>" . $empleado['comision_pct_fmt'] . "</td>";
                echo "<td><b>" . $empleado['salario_total_fmt'] . "</b></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>