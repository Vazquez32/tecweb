<?php
namespace Backend;

require_once './myapi/Products.php';

$product = new Products('localhost', 'root', 'root123', 'marketzone');
$product->search($term); // $term debe ser el término de búsqueda
echo $product->getData();
?>
