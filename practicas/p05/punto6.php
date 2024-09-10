<?php
$a = 0;               // Falso (0 es considerado false)
$b = "";              // Falso (una cadena vacía es false)
$c = "false";         // Verdadero (una cadena no vacía es true)
$d = 42;              // Verdadero (cualquier número distinto de 0 es true)
$e = NULL;            // Falso (NULL es false)
$f = array();         // Falso (un arreglo vacío es false)

var_dump((bool)$a);
echo "<br>";
var_dump((bool)$b);
echo "<br>";
var_dump((bool)$c);
echo "<br>";
var_dump((bool)$d);
echo "<br>";
var_dump((bool)$e);
echo "<br>";
var_dump((bool)$f);
?>
