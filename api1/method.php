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

// users //
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
        if ($_SERVER['REQUEST_METHOD'] === 'PATCH') {
          parse_str(file_get_contents("php://input"), $datos);
      
          $id_usuario = $datos['id_usuario'];
          $nombre = $datos['nombre'];
          $apellidos = $datos['apellidos'];
          $correo = $datos['correo'];
          $telefono = $datos['telefono'];
      
          if ($_SERVER['REQUEST_METHOD'] === 'PATCH') { // Método PATCH
            $actualizaciones = array();
              if (!empty($nombre)) {
                    $actualizaciones[] = "nombre = '$nombre'";
              }
              if (!empty($apellidos)) {
                  $actualizaciones[] = "apellidos = '$apellidos'";
              }
              if (!empty($correo)) {
                  $actualizaciones[] = "telefono = '$telefono'";
              }
              if (!empty($telefono)) {
                  $actualizaciones[] = "correo = '$correo'";
              }
              
              $actualizaciones_str = implode(', ', $actualizaciones);

              $sql = "UPDATE usuarios SET $actualizaciones_str WHERE id_usuario = $id_usuario";
          }
      
          if ($conexion->query($sql) === TRUE) {
              echo "Registro actualizado con éxito.";
          } else {
              echo "Error al actualizar registro: " . $conexion->error;
          }
      } else {
          echo "Método de solicitud no válido.";
      }
      
      $conexion->close();
       break;

    case 'PUT':
        $input = json_decode(file_get_contents("php://input"), true);
        var_dump($input);

        // Asegúrate de que los datos necesarios estén presentes
        if (isset($input['nombre']) && isset($input['apellidos']) && isset($input['telefono']) && isset($input['correo'])) {
            $nombre = $input['nombre'];
            $apellidos = $input['apellidos'];
            $telefono = $input['telefono'];
            $correo = $input['correo'];

            $sql = "INSERT INTO usuarios (nombre, apellidos, telefono, correo) VALUES (?, ?, ?, ?)";
            $stmt = $conexion->prepare($sql);

            // Enlaza los parámetros y sus tipos
            $stmt->bind_param("sssi", $nombre, $apellidos, $telefono, $correo);

            if ($stmt->execute()) {
                $response = array("message" => "Registro insertado con éxito.");
                echo json_encode($response);
            } else {
                $response = array("error" => "Error al insertar registro: " . $stmt->error);
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