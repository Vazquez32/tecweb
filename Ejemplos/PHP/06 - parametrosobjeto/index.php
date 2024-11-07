<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php    
    require_once __DIR__ . '/opcion.php';
    require_once __DIR__ . '/menu.php';

    $menu1 = new menu('vertical');
    $opcion1 = new opcion('Facebook', 'http://www.facebook.com', '#C3D9FF');
    $menu1->insertar_opcion($opcion1);

    $opcion2 = new opcion('Outlook', 'http://www.outlook.com', '#CDEB8B');
    $menu1->insertar_opcion($opcion2);

    $opcion3 = new opcion('Instagram', 'http://www.instagram.com', '#FFD9C3');
    $menu1->insertar_opcion($opcion3);

    $menu1->graficar();
    

    ?>
</body>
</html>