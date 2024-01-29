<!DOCTYPE html>
<html>
<head>
    <title>Actualizar Registro</title>
</head>
<body>
    <h1>Actualizar Registro</h1>
    
    <form id="updateForm">
        <label for="id">ID del Registro a Actualizar:</label>
        <input type="text" id="id_usuario" name="id" required><br>

        <label for="Nombre">Nuevo Nombre:</label>
        <input type="text" id="nombre" name="nombre"><br>

        <label for="Apellido">Nuevo Apellido:</label>
        <input type="text" id="apellidos" name="apellidos"><br>

        <label for="telefono">Nuevo Número:</label>
        <input type="text" id="telefono" name="telefono"><br>

        <label for="telefono">Nuevo Correo:</label>
        <input type="text" id="correo" name="correo"><br>

        <button type="button" id="putButton">Actualizar con PUT</button>
        <button type="button" id="patchButton">Actualizar con PATCH</button>
    </form>

    <div id="response"></div>

    <script>
        document.getElementById('putButton').addEventListener('click', function () {
            actualizarRegistro('PUT');
        });

        document.getElementById('patchButton').addEventListener('click', function () {
            actualizarRegistro('PATCH');
        });

        function actualizarRegistro(metodo) {
            var id = document.getElementById('id_usuario').value;
            var nombre = document.getElementById('nombre').value;
            var apellidos = document.getElementById('apellidos').value;
            var telefono = document.getElementById('telefono').value;
            var correo = document.getElementById('correo').value;

            var data = new URLSearchParams();
            data.append('id_usuario', id);
            data.append('nombre', nombre);
            data.append('apellidos', apellidos);
            data.append('telefono', telefono);
            data.append('correo', correo);

            fetch('method.php', {
                method: metodo,
                body: data
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
        }
    </script>
</body>
</html>
