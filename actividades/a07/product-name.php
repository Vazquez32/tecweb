<?php
/*header('Content-Type: application/json');
include_once __DIR__.'/database.php';

$name = mysqli_real_escape_string($conn, $_GET['name']);
$id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : null;

if ($id) {
    // Validar si el nombre existe, pero excluir el ID actual
    $query = "SELECT COUNT(*) as count FROM productos WHERE nombre='$name' AND id != '$id'";
} else {
    // Si no hay ID, simplemente contar todos los nombres
    $query = "SELECT COUNT(*) as count FROM productos WHERE nombre='$name'";
}

$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

echo json_encode(['exists' => $data['count'] > 0]);
?> */

namespace backend;

require_once 'myapi/Products.php';

$products = new \backend\myapi\Productos('root', '12345678a', 'marketzone');
$products->singleByName('NombreProducto'); // Reemplaza 'NombreProducto' con el nombre del producto
echo $products->getData();
?>
