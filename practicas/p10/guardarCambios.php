<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $precio = $_POST['precio'];
    $detalles = $_POST['detalles'];
    $unidades = $_POST['unidades'];
    $imagen = '';

    /** Si se subió una nueva imagen */
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
        $imagen = 'img/' . basename($_FILES['imagen']['name']);
        move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen);
    }

    /** SE CREA EL OBJETO DE CONEXION */
    @$link = new mysqli('localhost', 'root', 'root123', 'marketzone');

    /** comprobar la conexión */
    if ($link->connect_errno) {
        die('Falló la conexión: ' . $link->connect_error . '<br/>');
    }

    /** Actualizar el producto en la base de datos */
    $query = "UPDATE productos SET nombre='$nombre', marca='$marca', modelo='$modelo', precio='$precio', detalles='$detalles', unidades='$unidades'";

    /** Solo actualizar la imagen si se subió una nueva */
    if (!empty($imagen)) {
        $query .= ", imagen='$imagen'";
    }

    $query .= " WHERE id=$id";

    if ($link->query($query) === TRUE) {
        echo "Producto actualizado con éxito.";
    } else {
        echo "Error al actualizar el producto: " . $link->error;
    }

    $link->close();
}
?>
