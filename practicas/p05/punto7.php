<?php
// a. La versión de Apache y PHP
echo "Versión de PHP: " . phpversion() . "\n";

// La versión de Apache no está directamente disponible a través de $_SERVER en todas las configuraciones,
// pero se puede obtener a través de la variable 'SERVER_SOFTWARE' en algunas configuraciones.
if (isset($_SERVER['SERVER_SOFTWARE'])) {
    echo "Versión de Apache (o software del servidor): " . $_SERVER['SERVER_SOFTWARE'] . "\n";
} else {
    echo "No se puede determinar la versión de Apache.\n";
}

// b. El nombre del sistema operativo (servidor)
echo "Sistema operativo del servidor: " . PHP_OS . "\n";

// c. El idioma del navegador (cliente)
if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
    echo "Idioma del navegador: " . $_SERVER['HTTP_ACCEPT_LANGUAGE'] . "\n";
} else {
    echo "No se puede determinar el idioma del navegador.\n";
}
?>
