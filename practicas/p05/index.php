<!DOCTYPE xhtml>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 05</title>
</head>
<body>
    <h1>Práctica 05</h1>

           <!-- Ejercicio 1-->
    <h2>Ejercicio 1</h2>
    <?php
        $_myvar = "Es válida, puede iniciar con guión bajo";
        $_7var = "Es válida, si puede iniciar con guión bajo, puede llevar un número o caracter";
        $myvar = "Es válida, al ser una cadena de caracteres, no hay problema.";
        $var7 = "Es válida, puede llevar caracteres y números (No puede iniciar con número. Por ejemplo: $7var está mal)";
        $_element1 = "Es válida, pues puede iniciar con guión bajo y luego un caracter o número";

        echo "Variables válidas: ";
        echo "<br> \$_myvar: $_myvar";
        echo "<br> \$_7var: $_7var";
        echo "<br> \$myvar: $myvar";
        echo "<br> \$var7: $var7";
        echo "<br> \$_element1: $_element1 <br>";

        // Para liberar a las variables se usa unset()
        unset($_myvar, $_7var, $myvar, $var7, $_element1);
    ?>
    <h2>Ejercicio 2</h2>
    <?php
        $a = "ManejadorSQL";
        $b = 'MySQL';
        $c = &$a;
        echo "<br>Valor de \$a : $a <br>";
        echo "Valor de \$b : $b <br>";
        echo "Valor de \$c : $c <br>";
        //2-b
        $a = "PHP server";
        $b = &$a;
        //2-c
        echo "<br>Valor de \$a : $a <br>";
        echo "Valor de \$b : $b <br>";
        echo "Lo que pasa es que 'b' muestra el contenido de 'a' (referencia), <br> Ahora 'a' fue actualizado de 'ManejadorSQL' a 'PHP Server' y 'b' copió la segunda asignación. <br>";
        //Se liberan las variables
        unset($a, $b, $c);
    ?>
    <h2>Ejercicio 3</h2>
    <?php
    
    $a = "PHP5";
    var_dump($a); // Mostrar tipo y valor de la variable
    echo "<br>";

    $z[] = &$a;
    var_dump($z); 
    echo "<br>";

    $b = "5a version de PHP";
    var_dump($b); 
    echo "<br>";

    $c = intval($b)*10;
    var_dump($c); 
    echo "<br>";

    $a .= $b; 
    var_dump($a); 
    echo "<br>";

    $b_numeric = intval($b);

    $b = $b_numeric * $c;
    var_dump($b); 
    echo "<br>";

    $z[0] = "MySQL";
    var_dump($z); 
    echo "<br>";
    ?>
    <h2>Ejercicio 4</h2>
    <?php
    echo "<pre>";
    echo "Variables con \$GLOBALS:\n";
    echo "a: " . $GLOBALS['a'] . "\n";
    echo "b: " . $GLOBALS['b'] . "\n";
    echo "c: " . $GLOBALS['c'] . "\n";
    echo "z: ";
    print_r($GLOBALS['z']);
    echo "</pre>";

    //Se liberan las variables
    //No se liberan en el ejercicio anterior porque como están relacionados,
    //al entrar a la página generaría un error porque no hay variables para trabajar
    unset($a, $b, $c, $z);
    ?>
        <h2>Ejercicio 5</h2>
    <?php
        $a = "7 personas";
        $b = (integer) $a;
        $a = "9E3";
        $c = (double) $a;

        echo "Valor de \$a: " . $a . "<br>";
        echo "Valor de \$b: " . $b . "<br>";  
        echo "Valor de \$c: " . $c . "<br>";
            //Se liberan las variables
        unset($a, $b, $c);
    ?>
        <h2>Ejercicio 6</h2>
    <?php
     //LE damos un valor a las variables
     $a = 1;
     $b = 0;   //0 es considerado como FALSE y 1 como TRUE
     $c = "hola";
     $d = "null";
     $e = null;
     $f = array();

     //Los mostramos
     echo "Valor de \$a: ";
     var_dump((bool)$a);
     echo "<br>";

     echo "Valor de \$b: ";
     var_dump((bool)$b);
     echo "<br>";

     echo "Valor de \$c: ";
     var_dump((bool)$c);
     echo "<br>";

     echo "Valor de \$d: ";
     var_dump((bool)$d);
     echo "<br>";

     echo "Valor de \$e: ";
     var_dump((bool)$e);
     echo "<br>";

     echo "Valor de \$f: ";
     var_dump((bool)$f);
     echo "<br>";
    //Se liberan las variables
    unset($a, $b, $c, $d, $e, $f);
    ?>
    <h3>Ejercicio 6.1</h3>
    <?php

    $a = "0";
    $b = "TRUE";
    $c = FALSE;
    $d = ($a OR $b);
    $e = ($a AND $c);
    $f = ($a XOR $b);

    echo "Valor de \$a: " . $a . "<br>"; 
    echo "Valor de \$b: " . $b . "<br>"; 
    echo "Valor de \$c: " . ($c ? 'true' : 'false') . "<br>";
    echo "Valor de \$d: " . ($d ? 'true' : 'false') . "<br>"; 
    echo "Valor de \$e: " . ($e ? 'true' : 'false') . "<br>"; 
    echo "Valor de \$f: " . ($f ? 'true' : 'false') . "<br>";

        //Se liberan las variables
        unset($a, $b, $c, $d, $e, $f);
    ?>

    <h2>Ejercicio 7</h2>
    <?php
    
    // Versión de PHP
    echo "Versión de PHP: " . phpversion() . "<br>";
    
    // Versión de Apache
    if (isset($_SERVER['SERVER_SOFTWARE'])) {
        echo "Versión de Apache: " . $_SERVER['SERVER_SOFTWARE'] . "<br>";
    } else {
        echo "No se puede determinar la versión de Apache.<br>";
    }
    echo "<br>";
    // SO del server
    echo "Sistema Operativo del Servidor: " . php_uname('s') . "<br>";
    echo "<br>";
    // Idioma del navegador
    echo "Idioma del Navegador: " . $_SERVER['HTTP_ACCEPT_LANGUAGE'] . "<br>";
    ?>
</body>
</html>
