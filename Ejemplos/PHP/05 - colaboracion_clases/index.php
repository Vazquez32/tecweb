<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
  require_once __DIR__ . '/pagina.php';

  $pagina = new pagina(
    
    'El rincón del programador', 'El sótano del programador');
    
    for($i=0;$i<15;$i++)
    {
        $pagina->insertar_cuerpo('Prueba N° '.($i+1). 'que debe aparecer en la página');
    }
  
    $pagina->graficar();
?>    
</body>
</html>