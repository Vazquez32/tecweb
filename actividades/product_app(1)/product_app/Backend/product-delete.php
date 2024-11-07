<?php
namespace Backend;

require_once './myapi/Products.php';

$product = new Products('localhost', 'root', 'root123', 'marketzone');

$productId = $_POST['id'] ?? null;

if ($productId) {
    $product->delete($productId);
    echo "Producto eliminado exitosamente";
} else {
    echo "Error: ID de producto no proporcionado";
}
?>
