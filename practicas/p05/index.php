<?php
$a = 'PHP5';
echo $a;
echo '<br>';

$z[] = &$a;
echo '<br>';
echo $z[0];
echo '<br>';

$b = '5a version de PHP';
echo '<br>';
echo $b;

echo '<br>';
$c = $b*10;
echo '<br>';
echo $c;
echo '<br>';

echo '<br>';


$a .= $b;

$b *= $c;
echo $b;
$z[0] = 'MySQL';
echo print_r('$z');
echo '<br>';
?>
