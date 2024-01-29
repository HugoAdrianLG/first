<!DOCTYPE html>
<html>
<head>
    <title>API de Ejemplo (GET, POST, PUT, DELETE)</title>
    <script src="min.js"></script>

</head>
<body>
<h1>Eliminar Registro por ID</h1>
    
    <form id="deleteForm">
        <label for="id">ID del Registro a Eliminar:</label>
        <input type="text" id="id_usuario" name="id_usuario" required>
        <button type="button" id="deleteButton">Eliminar</button>
    </form>
    
    <div id="response"></div>
    
    <script>
        document.getElementById('deleteButton').addEventListener('click', function () {
            var id = document.getElementById('id_usuario').value;
    
            // Construir el objeto JSON con el ID
            var data = {
                id: id
            };
    
            fetch('method.php', {
                method: 'DELETE',
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(function(response) {
                return response.text();
            })
            .then(function(data) {
                document.getElementById('response').textContent = data;
            })
            .catch(function(error) {
                console.error('Error:', error);
            });
        });
    </script>
