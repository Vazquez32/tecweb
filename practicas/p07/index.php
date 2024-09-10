<?php
// Incluir el archivo funciones.php
include 'src/funciones.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 7</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Escribir programa para comprobar si un número es un múltiplo de 5 y 7</p>

    <!-- Formulario que envía datos por GET -->
    <form action="index.php" method="get">
        Número: <input type="number" name="numero"><br>
        <br>
        <input type="submit" value="Comprobar">
    </form>
    <br>

    <?php
    // Verificar si el número fue enviado por GET
    if (isset($_GET['numero'])) {
        $numero = $_GET['numero'];
        esMultiplo($numero); // Llamar a la función definida en funciones.php
    }
    ?>

    <h2>Ejercicio 2</h2>
    <p>Crea un programa para la generación repetitiva de 3 números aleatorios hasta obtener una secuencia compuesta por: impar, par, impar</p>

    <br>
    <form action="index.php" method="get">
    <input type="submit" value="Generar tabla">
    </form>

    <?php
        generarSecuencia(); // Llamar a la función definida en funciones.php
    ?>
</body>
</html>
