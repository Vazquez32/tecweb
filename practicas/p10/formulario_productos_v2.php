<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Productos</title>
    <script defer src="validaciones.js"></script>
</head>
<body>
    <h1 style="text-align: center;">Registro de Nuevos Relojes</h1>
    <form id="formProducto" method="POST" action="set_producto_v2.php" enctype="multipart/form-data">
        <fieldset>
            <legend>Datos del Producto</legend>

            <label for="nombre">Nombre:</label> <br>
            <input type="text" id="nombre" name="nombre" required> <br><br>

            <label for="marca">Marca:</label> <br>
            <input type="text" id="marca" name="marca" required> <br><br>

            <label for="modelo">Modelo:</label> <br>
            <input type="text" id="modelo" name="modelo" required> <br><br>

            <label for="precio">Precio:</label> <br>
            <input type="number" id="precio" name="precio" step="0.01" required> <br><br>

            <label for="detalles">Detalles:</label> <br>
            <textarea id="detalles" name="detalles" rows="4" required></textarea> <br><br>

            <label for="unidades">Unidades:</label> <br>
            <input type="number" id="unidades" name="unidades" required> <br><br>

            <label for="imagen">Imagen (png/jpg):</label> <br>
            <input type="file" id="imagen" name="imagen" accept="image/png, image/jpeg"> <br><br>

            <button type="submit">Registrar Producto</button>
        </fieldset>
        <p id="mensajeError" style="color: red;"></p>
    </form>
</body>
</html>
