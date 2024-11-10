<?php
    
    require_once '../vendor/autoload.php';
    use myapi\Read as Read;

    $products = new Read("root", "root123", "marketzone");

    if(isset($_POST['nombre'])) {
        $products->singleSearch($_POST);
    }

    echo $products->getData();

?>