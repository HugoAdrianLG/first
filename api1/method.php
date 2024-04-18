<?php
// Permitir solicitudes desde cualquier origen
header("Access-Control-Allow-Origin: *");

// Permitir los métodos de solicitud GET, POST, PUT, DELETE y OPTIONS
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

// Permitir los encabezados especificados
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

// Permitir cookies a través de solicitudes
header("Access-Control-Allow-Credentials: true");

// Si la solicitud es una opción, finaliza aquí y no realiza ninguna otra acción
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit();
}
require "config/Conexion.php";
$datos = json_decode(file_get_contents('php://input'), true);

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
      // Consulta SQL para seleccionar datos de la tabla
$sql = "SELECT id_articulo, articulo, imagen, descripcion FROM articulos";

$query = $conexion->query($sql);

if ($query->num_rows > 0) {
    $data = array();
    while ($row = $query->fetch_assoc()) {
        $data[] = $row;
    }
    // Devolver los resultados en formato JSON
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    echo "No se encontraron registros en la tabla.";
}

$conexion->close();
      break;


      case 'POST':
        // Decodificar el JSON en un array asociativo
        $datos = json_decode(file_get_contents('php://input'), true);
    
        // Verificar si los datos están presentes y son válidos
        if(isset($datos['articulo']) && isset($datos['imagen']) && isset($datos['descripcion'])) {
            $articulo = $datos['articulo'];
            $imagen = $datos['imagen'];
            $descripcion = $datos['descripcion'];
    
            // Insertar los datos en la tabla
            $sql = "INSERT INTO articulos (articulo, imagen, descripcion) VALUES ('$articulo', '$imagen', '$descripcion')";
    
            if ($conexion->query($sql) === TRUE) {
                echo "Datos insertados con éxito.";
            } else {
                echo "Error al insertar datos: " . $conexion->error;
            }
        } else {
            echo "Datos incorrectos o faltantes en la solicitud.";
        }
    
        $conexion->close();
        break;    

      case 'PATCH':
        $id_articulo= $datos['id_articulo'];
        $nombre = $datos['articulo']; // Cambiar al campo que corresponda
        $imagen = $datos['imagen']; // Cambiar al campo que corresponda
        $descripcion = $datos['descripcion']; // Cambiar al campo que corresponda

        $actualizaciones = array();
        if (!empty($nombre)) {
        $actualizaciones[] = "articulo = '$nombre'";
        }
        if (!empty($imagen)) {
        $actualizaciones[] = "imagen = '$imagen'";
        }
        if (!empty($descripcion)) {
        $actualizaciones[] = "descripcion = '$descripcion'";
        }

        $actualizaciones_str = implode(', ', $actualizaciones);

        $sql = "UPDATE articulos SET $actualizaciones_str WHERE id_articulo = $id_articulo";

        if ($conexion->query($sql) === TRUE) {
        echo "Registro actualizado con éxito.";
        } else {
        echo "Error al actualizar registro: " . $conexion->error;
        }
        break;
      
          if ($conexion->query($sql) === TRUE) {
              echo "Registro actualizado con éxito.";
          } else {
              echo "Error al actualizar registro: " . $conexion->error;
          }
      $conexion->close();
       break;

    case 'PUT':
        $input = json_decode(file_get_contents("php://input"), true);
        var_dump($input);

        // Asegúrate de que los datos necesarios estén presentes
        if (isset($input['articulo']) && isset($input['imagen']) && isset($input['descripcion'])) {
            $articulo = $input['articulo'];
            $imagen = $input['imagen'];
            $descripcion = $input['descripcion'];
        
            $sql = "INSERT INTO articulos (articulo, imagen, descripcion) VALUES (?, ?, ?)";
            $stmt = $conexion->prepare($sql);
        
            // Enlaza los parámetros y sus tipos
            $stmt->bind_param("ssi", $articulo, $imagen, $descripcion);
        
            if ($stmt->execute()) {
              $response = array("message" => "Artículo insertado con éxito.");
              echo json_encode($response);
            } else {
              $response = array("error" => "Error al insertar artículo: " . $stmt->error);
              echo json_encode($response);
            }
        
            $stmt->close();
          } else {
            $response = array("error" => "Faltan datos obligatorios en la solicitud.");
            echo json_encode($response);
          }
          break;
  
      case 'DELETE':
        // Obtener el ID de usuario del arreglo $datos
        $id_articulo = isset($_GET['id']) ? $_GET['id'] : null;
    
        // Verificar si se proporcionó el ID de usuario
        if ($id_articulo === null) {
            break; // Sale del switch si el ID de usuario no está presente
        }
    
        // Preparar la consulta de eliminación
        $stmt = $conexion->prepare("DELETE FROM articulos WHERE id_articulo = ?");
    
        // Verificar si la preparación de la consulta fue exitosa
        if ($stmt === false) {
            $conexion->error;
            break;
        }
    
        // Vincular el parámetro ID de usuario
        $stmt->bind_param("i", $id_articulo);
    
        // Ejecutar la consulta de eliminación
        if ($stmt->execute()) {
            
        } else {
       
        }
        break;

     default:
       echo 'undefined request type!';
  }
?>