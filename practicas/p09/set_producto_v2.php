<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Conexión a la base de datos
$link = new mysqli('localhost', 'root', 'root123', 'marketzone');

// Comprobar la conexión
if ($link->connect_errno) {
    die('<p>Error al conectar a la base de datos: ' . $link->connect_error . '</p>');
}

// Establecer el charset
$link->set_charset('utf8');

// Recibir datos del formulario
$nombre = trim($_POST['nombre']);
$marca  = trim($_POST['marca']);
$modelo = trim($_POST['modelo']);
$precio = $_POST['precio'];
$detalles = trim($_POST['detalles']);
$unidades = $_POST['unidades'];
$imagen   = $_FILES['imagen']['name'];

// Validar que los campos numéricos (precio y unidades) sean válidos
if (!is_numeric($precio) || !is_numeric($unidades)) {
    echo '<p>Error: El precio o las unidades ingresadas no son válidos.</p>';
    exit;
}

// Validar que la imagen ha sido subida correctamente
if (!is_uploaded_file($_FILES['imagen']['tmp_name']) || $_FILES['imagen']['error'] !== 0) {
    echo '<p>Error: La imagen no fue subida correctamente.</p>';
    exit;
}

// Validar que el nombre, marca y modelo no existan en la base de datos
$sql_check = "SELECT * FROM productos WHERE nombre = ? AND marca = ? AND modelo = ?";
$stmt = $link->prepare($sql_check);
$stmt->bind_param("sss", $nombre, $marca, $modelo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo '<p>Error: El producto con el mismo nombre, marca y modelo ya existe en la base de datos.</p>';
} else {
    // Mover la imagen a la carpeta 'img'
    $ruta_imagen = 'img/' . basename($imagen);
    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_imagen)) {
        // Insertar el nuevo producto en la base de datos con la ruta de la imagen
        $sql_insert = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado) 
                       VALUES (?, ?, ?, ?, ?, ?, ?, 0)";
        $stmt_insert = $link->prepare($sql_insert);
        $stmt_insert->bind_param("sssdiss", $nombre, $marca, $modelo, $precio, $detalles, $unidades, $ruta_imagen);

        if ($stmt_insert->execute()) {
            // Mostrar resumen de datos insertados
            echo '<h2>Producto insertado con éxito</h2>';
            echo '<p>Nombre: ' . htmlspecialchars($nombre) . '</p>';
            echo '<p>Marca: ' . htmlspecialchars($marca) . '</p>';
            echo '<p>Modelo: ' . htmlspecialchars($modelo) . '</p>';
            echo '<p>Precio: ' . htmlspecialchars($precio) . '</p>';
            echo '<p>Detalles: ' . htmlspecialchars($detalles) . '</p>';
            echo '<p>Unidades: ' . htmlspecialchars($unidades) . '</p>';
            echo '<p>Imagen: <img src="' . htmlspecialchars($ruta_imagen) . '" alt="Imagen del producto" width="150"></p>';
        } else {
            echo '<p>Error: El producto no pudo ser insertado en la base de datos.</p>';
        }
        $stmt_insert->close();
    } else {
        echo '<p>Error: No se pudo mover la imagen al servidor.</p>';
    }
}

$stmt->close();
$link->close();
?>
