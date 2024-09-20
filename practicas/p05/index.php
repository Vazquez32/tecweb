<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
        $var7 = "Es válida, puede llevar caracteres y números (No puede iniciar con número. Por ejemplo: \$7var está mal)";
        $_element1 = "Es válida, pues puede iniciar con guión bajo y luego un caracter o número";

        echo "<p>Variables válidas:</p>";
        echo "<ul>";
        echo "<li>\$_myvar: $_myvar</li>";
        echo "<li>\$_7var: $_7var</li>";
        echo "<li>\$myvar: $myvar</li>";
        echo "<li>\$var7: $var7</li>";
        echo "<li>\$_element1: $_element1</li>";
        echo "</ul>";

        // Para liberar a las variables se usa unset()
        unset($_myvar, $_7var, $myvar, $var7, $_element1);
    ?>

    <h2>Ejercicio 2</h2>
    <?php
        $a = "ManejadorSQL";
        $b = 'MySQL';
        $c = &$a;

        echo "<p>Valor de \$a : $a</p>";
        echo "<p>Valor de \$b : $b</p>";
        echo "<p>Valor de \$c : $c</p>";

        //2-b
        $a = "PHP server";
        $b = &$a;

        //2-c
        echo "<p>Valor de \$a : $a</p>";
        echo "<p>Valor de \$b : $b</p>";
        echo "<p>Lo que pasa es que 'b' muestra el contenido de 'a' (referencia), Ahora 'a' fue actualizado de 'ManejadorSQL' a 'PHP Server' y 'b' copió la segunda asignación.</p>";

        //Se liberan las variables
        unset($a, $b, $c);
    ?>

    <h2>Ejercicio 3</h2>
    <?php
        $a = "PHP5";
        ob_start();
        var_dump($a); // Mostrar tipo y valor de la variable
        $output = ob_get_clean();
        echo "<pre>$output</pre>";

        $z[] = &$a;
        ob_start();
        var_dump($z);
        $output = ob_get_clean();
        echo "<pre>$output</pre>";

        $b = "5a version de PHP";
        ob_start();
        var_dump($b);
        $output = ob_get_clean();
        echo "<pre>$output</pre>";

        $c = intval($b) * 10;
        ob_start();
        var_dump($c);
        $output = ob_get_clean();
        echo "<pre>$output</pre>";

        $a .= $b;
        ob_start();
        var_dump($a);
        $output = ob_get_clean();
        echo "<pre>$output</pre>";

        $b_numeric = intval($b);
        $b = $b_numeric * $c;
        ob_start();
        var_dump($b);
        $output = ob_get_clean();
        echo "<pre>$output</pre>";

        $z[0] = "MySQL";
        ob_start();
        var_dump($z);
        $output = ob_get_clean();
        echo "<pre>$output</pre>";
    ?>

    <h2>Ejercicio 4</h2>
    <?php
        echo "<pre>";
        echo "Variables con \$GLOBALS:\n";
        echo "a: " . (isset($GLOBALS['a']) ? $GLOBALS['a'] : 'undefined') . "\n";
        echo "b: " . (isset($GLOBALS['b']) ? $GLOBALS['b'] : 'undefined') . "\n";
        echo "c: " . (isset($GLOBALS['c']) ? $GLOBALS['c'] : 'undefined') . "\n";
        echo "z: ";
        if (isset($GLOBALS['z'])) {
            print_r($GLOBALS['z']);
        } else {
            echo "undefined\n";
        }
        echo "</pre>";

        //Se liberan las variables
        unset($a, $b, $c, $z);
    ?>

    <h2>Ejercicio 5</h2>
    <?php
        $a = "7 personas";
        $b = (integer) $a;
        $a = "9E3";
        $c = (double) $a;

        echo "<p>Valor de \$a: " . $a . "</p>";
        echo "<p>Valor de \$b: " . $b . "</p>";
        echo "<p>Valor de \$c: " . $c . "</p>";

        //Se liberan las variables
        unset($a, $b, $c);
    ?>

    <h2>Ejercicio 6</h2>
    <?php
        // Le damos un valor a las variables
        $a = 1;
        $b = 0;   // 0 es considerado como FALSE y 1 como TRUE
        $c = "hola";
        $d = "null";
        $e = null;
        $f = array();

        // Los mostramos
        echo "<p>Valor de \$a: ";
        var_dump((bool)$a);
        echo "</p>";

        echo "<p>Valor de \$b: ";
        var_dump((bool)$b);
        echo "</p>";

        echo "<p>Valor de \$c: ";
        var_dump((bool)$c);
        echo "</p>";

        echo "<p>Valor de \$d: ";
        var_dump((bool)$d);
        echo "</p>";

        echo "<p>Valor de \$e: ";
        var_dump((bool)$e);
        echo "</p>";

        echo "<p>Valor de \$f: ";
        var_dump((bool)$f);
        echo "</p>";

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

        echo "<p>Valor de \$a: " . $a . "</p>";
        echo "<p>Valor de \$b: " . $b . "</p>";
        echo "<p>Valor de \$c: " . ($c ? 'true' : 'false') . "</p>";
        echo "<p>Valor de \$d: " . ($d ? 'true' : 'false') . "</p>";
        echo "<p>Valor de \$e: " . ($e ? 'true' : 'false') . "</p>";
        echo "<p>Valor de \$f: " . ($f ? 'true' : 'false') . "</p>";

        //Se liberan las variables
        unset($a, $b, $c, $d, $e, $f);
    ?>

    <h2>Ejercicio 7</h2>
    <?php
        // Versión de PHP
        echo "<p>Versión de PHP: " . phpversion() . "</p>";

        // Versión de Apache
        if (isset($_SERVER['SERVER_SOFTWARE'])) {
            echo "<p>Versión de Apache: " . htmlspecialchars($_SERVER['SERVER_SOFTWARE'], ENT_QUOTES, 'UTF-8') . "</p>";
        } else {
            echo "<p>No se puede determinar la versión de Apache.</p>";
        }

        // SO del server
        echo "<p>Sistema Operativo del Servidor: " . php_uname('s') . "</p>";

        // Idioma del navegador
        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            echo "<p>Idioma del Navegador: " . htmlspecialchars($_SERVER['HTTP_ACCEPT_LANGUAGE'], ENT_QUOTES, 'UTF-8') . "</p>";
        } else {
            echo "<p>No se puede determinar el idioma del navegador.</p>";
        }
    ?>
    <p>
    <a href="https://validator.w3.org/markup/check?uri=referer"><img
      src="https://www.w3.org/Icons/valid-xhtml11" alt="Valid XHTML 1.1" height="31" width="88" /></a>
  </p>
</body>
</html>
