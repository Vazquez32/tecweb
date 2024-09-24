<?php
@$link = new mysqli('localhost', 'root', 'root123', 'marketzone');

/** Comprobar la conexión */
if ($link->connect_errno) {
    die('Falló la conexión: '.$link->connect_error);
}

// Recibir datos del formulario
$nombre = trim($_POST['nombre']);
$marca  = trim($_POST['marca']);
$modelo = trim($_POST['modelo']);
$precio = $_POST['precio'];
$detalles = trim($_POST['detalles']);
$unidades = $_POST['unidades'];
$imagen   = $_FILES['imagen']['name'];

// Validar que el nombre, marca y modelo no existan en la base de datos
$sql_check = "SELECT * FROM productos WHERE nombre = ? AND marca = ? AND modelo = ?";
$stmt = $link->prepare($sql_check);
$stmt->bind_param("sss", $nombre, $marca, $modelo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Si existe un producto con esos datos
    echo 'Error: El producto con el mismo nombre, marca y modelo ya existe en la base de datos.';
} else {
    // Si no existe, insertar el nuevo producto
    // Comentamos la query anterior
    // $sql_insert = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    // Nueva query usando column names
    $sql_insert = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado) VALUES (?, ?, ?, ?, ?, ?, ?, 0)";
    $stmt_insert = $link->prepare($sql_insert);
    $stmt_insert->bind_param("sssdiss", $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen);
    
    if ($stmt_insert->execute()) {
        // Resumen de datos insertados
        echo 'Producto insertado con éxito! <br>';
        echo 'Resumen de datos: <br>';
        echo 'Nombre: ' . htmlspecialchars($nombre) . '<br>';
        echo 'Marca: ' . htmlspecialchars($marca) . '<br>';
        echo 'Modelo: ' . htmlspecialchars($modelo) . '<br>';
        echo 'Precio: ' . htmlspecialchars($precio) . '<br>';
        echo 'Detalles: ' . htmlspecialchars($detalles) . '<br>';
        echo 'Unidades: ' . htmlspecialchars($unidades) . '<br>';
        echo 'Imagen: ' . htmlspecialchars($imagen) . '<br>';
    } else {
        echo 'Error: El producto no pudo ser insertado.';
    }
}

$stmt->close();
$stmt_insert->close();
$link->close();
?>
