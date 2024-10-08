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
    <form id="formProducto" action="modificarProducto.php" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Datos del Producto</legend>

            <?php
            // Conexión a la base de datos
            @$link = new mysqli('localhost', 'root', 'root123', 'marketzone');

            // Comprobar la conexión
            if ($link->connect_errno) {
                die('Falló la conexión: ' . $link->connect_error . '<br/>');
            }

            // Obtener el ID del producto a editar
            $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

            // Consultar los datos del producto
            if ($id > 0) {
                $result = $link->query("SELECT * FROM productos WHERE id = $id");
                if ($result->num_rows > 0) {
                    $producto = $result->fetch_assoc();
                } else {
                    echo "<p>Producto no encontrado.</p>";
                    exit;
                }
            } else {
                echo "<p>ID de producto no válido.</p>";
                exit;
            }
            ?>

            <input type="hidden" id="id" name="id" value="<?php echo $producto['id']; ?>">

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

            <button type="submit">Registrar Producto</button>
        </fieldset>
        <p id="mensajeError" style="color: red;"></p>
    </form>
</body>
</html>
