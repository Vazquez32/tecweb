<?php
/** Obtener el ID del producto a modificar */
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    die('ID del producto no detectado...');
}

/** SE CREA EL OBJETO DE CONEXION */
@$link = new mysqli('localhost', 'root', 'root123', 'marketzone');

/** comprobar la conexión */
if ($link->connect_errno) {
    die('Falló la conexión: ' . $link->connect_error . '<br/>');
}

/** Obtener los datos del producto */
$query = "SELECT * FROM productos WHERE id = $id";
$result = $link->query($query);

if ($result->num_rows > 0) {
    $producto = $result->fetch_assoc();
} else {
    die('Producto no encontrado...');
}

$link->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Producto</title>
    <script>
        function validarFormulario(event) {
            event.preventDefault(); // Evitar envío automático del formulario

            // Obtener los valores de los campos
            let nombre = document.getElementById('nombre').value.trim();
            let marca = document.getElementById('marca').value;
            let modelo = document.getElementById('modelo').value.trim();
            let precio = parseFloat(document.getElementById('precio').value);
            let detalles = document.getElementById('detalles').value.trim();
            let unidades = parseInt(document.getElementById('unidades').value);
            let imagen = document.getElementById('imagen').value;

            // Validar el nombre (requerido y <= 100 caracteres)
            if (nombre === '' || nombre.length > 100) {
                mostrarError('El nombre es requerido y debe tener 100 caracteres o menos.');
                return;
            }

            // Validar la marca (requerida y seleccionada)
            if (marca === '') {
                mostrarError('Debe seleccionar una marca.');
                return;
            }

            // Validar el modelo (requerido, alfanumérico, <= 25 caracteres)
            let alfanumericoRegex = /^[a-zA-Z0-9\s]+$/;
            if (modelo === '' || modelo.length > 25 || !alfanumericoRegex.test(modelo)) {
                mostrarError('El modelo es requerido, debe ser alfanumérico y tener 25 caracteres o menos.');
                return;
            }

            // Validar el precio (requerido y mayor a 99.99)
            if (isNaN(precio) || precio <= 99.99) {
                mostrarError('El precio es requerido y debe ser mayor a 99.99.');
                return;
            }

            // Validar detalles (opcional, <= 250 caracteres)
            if (detalles.length > 250) {
                mostrarError('Los detalles no deben exceder los 250 caracteres.');
                return;
            }

            // Validar unidades (requerido y >= 0)
            if (isNaN(unidades) || unidades < 0) {
                mostrarError('Las unidades son requeridas y deben ser mayores o iguales a 0.');
                return;
            }

            // Validar imagen (opcional, establecer imagen por defecto si no se selecciona una)
            if (!imagen) {
                imagen = 'img/imagen_defecto.jpg'; // Ruta por defecto
            }

            // Si pasa todas las validaciones, limpiar el mensaje de error y proceder
            limpiarError();
            console.log('Formulario válido, procesando...', { nombre, marca, modelo, precio, detalles, unidades, imagen });

            // Aquí puedes hacer la lógica para enviar los datos, por ejemplo, con AJAX
            document.getElementById('formProducto').submit(); // Enviar el formulario
        }

        function mostrarError(mensaje) {
            document.getElementById('mensajeError').innerText = mensaje;
        }

        function limpiarError() {
            document.getElementById('mensajeError').innerText = '';
        }
    </script>
</head>
<body>
    <h1>Modificar Producto</h1>
    <div id="mensajeError" style="color: red;"></div>
    <form id="formProducto" action="guardarCambios.php" method="POST" enctype="multipart/form-data" onsubmit="validarFormulario(event)">
        <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">

        <label for="nombre">Nombre:</label> <br>
        <input type="text" id="nombre" name="nombre" value="<?php echo $producto['nombre']; ?>" required> <br><br>

        <label for="marca">Marca:</label> <br>
        <select id="marca" name="marca" required>
            <option value="">Seleccione una marca</option>
            <option value="Casio" <?php if ($producto['marca'] == 'Casio') echo 'selected'; ?>>Casio</option>
            <option value="Williv" <?php if ($producto['marca'] == 'Williv') echo 'selected'; ?>>Williv</option>
        </select> <br><br>

        <label for="modelo">Modelo:</label> <br>
        <input type="text" id="modelo" name="modelo" value="<?php echo $producto['modelo']; ?>" required> <br><br>

        <label for="precio">Precio:</label> <br>
        <input type="number" id="precio" name="precio" step="0.01" value="<?php echo $producto['precio']; ?>" required> <br><br>

        <label for="detalles">Detalles:</label> <br>
        <textarea id="detalles" name="detalles" rows="4"><?php echo utf8_encode($producto['detalles']); ?></textarea> <br><br>

        <label for="unidades">Unidades:</label> <br>
        <input type="number" id="unidades" name="unidades" value="<?php echo $producto['unidades']; ?>" required> <br><br>

        <label for="imagen">Imagen (png/jpg):</label> <br>
        <input type="file" id="imagen" name="imagen" accept="image/png, image/jpeg"> <br><br>

        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>
