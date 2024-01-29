<?php
require "config/Conexion.php";

  //print_r($_SERVER['REQUEST_METHOD']);
  switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':
      // Consulta SQL para seleccionar datos de la tabla
$sql = "SELECT nombre, apellidos, telefono, correo FROM usuarios";

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
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Recibir los datos del formulario HTML
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
     
    
        // Insertar los datos en la tabla
        $sql = "INSERT INTO usuarios (nombre, apellidos, telefono, correo ) VALUES ('$nombre', '$apellidos','$telefono', '$correo')"; // Reemplaza con el nombre de tu tabla
    
        if ($conexion->query($sql) === TRUE) {
            echo "Datos insertados con éxito.";
        } else {
            echo "Error al insertar datos: " . $conexion->error;
        }
    } else {
        echo "Esta API solo admite solicitudes POST.";
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
        // Obtener el contenido del cuerpo de la solicitud
        $json = file_get_contents('php://input');
        
        // Decodificar el JSON en un array asociativo
        $data = json_decode($json, true);
        
        // Verificar si la solicitud es DELETE
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            // Verificar si se proporciona el parámetro id_usuario en el JSON
            if (isset($data['id'])) {
                // Procesar solicitud DELETE
                $id= $data['id'];
                $sql = "DELETE FROM usuarios WHERE id_usuario = $id";
        
                // Realizar la consulta DELETE
                if ($conexion->query($sql) === TRUE) {
                    echo "Registro eliminado con éxito.";
                } else {
                    echo "Error al eliminar registro: " . $conexion->error;
                }
            } else {
                echo "El parámetro id_usuario no se proporcionó en el JSON.";
            }
        } else {
            echo "Método de solicitud no válido.";
        }
        
        // Cerrar la conexión a la base de datos
        $conexion->close();
      break;


     default:
       echo 'undefined request type!';
  }
?>