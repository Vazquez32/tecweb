<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo 3</title>
</head>
<body>
    <?php
    use Ejemplos\POO\cabecera as cabecera;
    require_once __DIR__ .'/cabecera.php';
    $cab = new cabecera('El rincon del programador', 'center');
    $cab->graficar();
    ?>
    
</body>
</html>