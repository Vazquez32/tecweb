<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
require_once __DIR__ .'/operacion.php';

$suma = new suma;
$suma->setvalor1(10);
$suma->setvalor2(10);
$suma->operar();

echo 'El resultado de la suma es: '.$suma->getresultado() . '<br>';

$resta = new resta;
$resta->setvalor1(10);
$resta->setvalor2(10);
$resta->operar();

echo 'El resultado de la resta es: '.$resta->getresultado() . '<br>';

?>


    
</body>
</html>