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
</head>
<body>
    <h1>Modificar Producto</h1>
    <form action="guardarCambios.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">

        <label for="nombre">Nombre:</label> <br>
        <input type="text" id="nombre" name="nombre" value="<?php echo $producto['nombre']; ?>" required> <br><br>

        <label for="marca">Marca:</label> <br>
        <input type="text" id="marca" name="marca" value="<?php echo $producto['marca']; ?>" required> <br><br>

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
