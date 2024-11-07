<?php
namespace Backend;

require_once './myapi/Products.php';

$product = new Products('localhost', 'root', 'root123', 'marketzone');
$product->singleByName($_POST['name']);
$data = $product->getData();

if (!empty($data)) {
    echo "El nombre del producto ya existe.";
} else {
    echo "Nombre disponible.";
}
?>
