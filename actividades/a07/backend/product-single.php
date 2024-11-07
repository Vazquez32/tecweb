<?php
    use MyApi\Products; 
    
    include_once __DIR__.'/myapi/Products.php';

    // Creamos una instancia de la clase Products
    $products = New Products();
    
    // Llamamos al método find para obtener un producto por su ID
    $products->single($_GET['id']);

    // Mostramos la respuesta en formato JSON
    echo $products->getResponse();
?>