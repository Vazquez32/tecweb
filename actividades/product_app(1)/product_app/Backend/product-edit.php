<?php
namespace Backend;

require_once './myapi/Products.php';

$product = new Products('localhost', 'root', 'root123', 'marketzone');
$product->edit($editedProduct); // $editedProduct debe ser el objeto con los datos editados del producto
echo $product->getData();
?>
