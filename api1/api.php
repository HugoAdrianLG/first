<?php
require 'config/Conexion.php';

if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Procesar solicitud GET
   
    $sql = "SELECT id, campo1, campo2 FROM mi_tabla";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows > 0) {
        $data = array();
        while ($row = $resultado->fetch_assoc()) {
            $data[] = $row;
        }
        // Devolver los resultados en formato JSON
        header('Content-Type: application/json');
        echo json_encode($data);
    } else {
        echo "No se encontraron registros en la tabla.";
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesar solicitud POST
    $campo1 = $_POST['campo1'];
    $campo2 = $_POST['campo2'];
    $sql = "INSERT INTO mi_tabla (campo1, campo2) VALUES ('$campo1', '$campo2')";

    if ($conexion->query($sql) === TRUE) {
        echo "Datos insertados con éxito.";
    } else {
        echo "Error al insertar datos: " . $conexion->error;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Procesar solicitud PUT
    parse_str(file_get_contents("php://input"), $putData);
    $id = $putData['id'];
    $campo1 = $putData['campo1'];
    $campo2 = $putData['campo2'];
    $sql = "UPDATE mi_tabla SET campo1 = '$campo1', campo2 = '$campo2' WHERE id = $id";

    if ($conexion->query($sql) === TRUE) {
        echo "Datos actualizados con éxito.";
    } else {
        echo "Error al actualizar datos: " . $conexion->error;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Procesar solicitud DELETE
    $id = $_GET['id'];
    $sql = "DELETE FROM mi_tabla WHERE id = $id";

    if ($conexion->query($sql) === TRUE) {
        echo "Registro eliminado con éxito.";
    } else {
        echo "Error al eliminar registro: " . $conexion->error;
    }
} else {
    echo "Método de solicitud no válido.";
}

// Cierra la conexión a la base de datos
$conexion->close();
?>
