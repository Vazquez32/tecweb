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
        Número: <input type="number" name="numero" required><br>
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
    <br>
    <?php
    // Llamar a la función para generar la secuencia
    generarSecuencia(); 
    ?>
    <br>

    <h2>Ejercicio 3</h2>
    <p>Utiliza un ciclo while para encontrar el primer número entero obtenido aleatoriamente, pero que además sea múltiplo de un número dado. </p>
    <form action="index.php" method="get">
        <!-- Formulario para ingresar el número -->
        <label for="multiplo">Ingresa el número para encontrar su múltiplo: </label>
        <input type="number" name="multiplo" required>
        <br><br>
        <label for="ciclo">Elige el tipo de ciclo: </label>
        <select name="ciclo" required>
            <option value="while">While</option>
            <option value="do-while">Do-While</option>
        </select>
        <br><br>
        <input type="submit" value="Generar">
    </form>

    <?php
    // Verificar si el número y el ciclo fueron enviados por GET
    if (isset($_GET['multiplo']) && isset($_GET['ciclo'])) {
        $multiplo = $_GET['multiplo'];
        $ciclo = $_GET['ciclo'];

        // Verificar que el valor es numérico
        if (is_numeric($multiplo) && $multiplo > 0) {
            // Llamar a la función correspondiente según el ciclo seleccionado
            if ($ciclo == "while") {
                echo encontrarMultiploWhile($multiplo);
            } elseif ($ciclo == "do-while") {
                echo encontrarMultiploDoWhile($multiplo);
            }
        } else {
            echo "Por favor, ingresa un número válido.";
        }
    }
    ?>

    <h2>Ejercicio 4</h2>
    <p>Crear un arreglo cuyos índices van de 97 a 122 y cuyos valores son las letras de la ‘a’ a la ‘z’. Usa la función chr(n) para poner el valor en cada índice. Luego, mostrar el arreglo en una tabla XHTML.</p>

    <?php
    // Llamar a la función para generar el arreglo ASCII
    $arregloAscii = generarArregloAscii();

    // Mostrar el arreglo en el formato [índice] => valor
    foreach ($arregloAscii as $key => $value) {
        echo '[' . $key . '] => ' . $value . '<br>';
    }
    ?>


    <h2>Ejercicio 5</h2>
    <p>Usar las variables $edad y $sexo en una instrucción if para identificar una persona de
    sexo “femenino”, cuya edad oscile entre los 18 y 35 años y mostrar un mensaje de
     bienvenida apropiado.</p>

     <form action="" method="post">
        <label for="edad">Edad:</label>
        <input type="number" name="edad" id="edad" required>
        <br>
        <label for="sexo">Sexo:</label>
        <select name="sexo" id="sexo" required>
            <option value="femenino">Femenino</option>
            <option value="masculino">Masculino</option>
        </select>
        <br>
        <input type="submit" value="Verificar">
    </form>
    <br>

    <?php
    if (isset($_POST['edad']) && isset($_POST['sexo'])) {
        $edad = $_POST['edad'];
        $sexo = $_POST['sexo'];
        echo verificarEdadSexo($edad, $sexo);
    }
    ?>

    <h2>Ejercicio 5</h2>
    <h3>Buscar por Matrícula</h3>
    <form action="" method="post">
        <label for="matricula">Introduce la matrícula:</label>
        <input type="text" name="matricula" id="matricula">
        <br>
        <input type="submit" name="buscarMatricula" value="Buscar por Matrícula">
    </form>

    <h3>Mostrar Todos los Vehículos</h3>
    <form action="" method="post">
        <input type="submit" name="mostrarTodos" value="Mostrar Todos">
    </form>

    <br>
    <h2>Resultados:</h2>
    <?php
    // Verificar si se ha enviado el formulario de buscar por matrícula
    if (isset($_POST['buscarMatricula']) && !empty($_POST['matricula'])) {
        $matricula = $_POST['matricula'];
        echo '<pre>' . mostrarVehiculoPorMatricula($matricula, $parqueVehicular) . '</pre>';
    }

    // Verificar si se ha enviado el formulario de mostrar todos los vehículos
    if (isset($_POST['mostrarTodos'])) {
        echo '<pre>' . mostrarTodosLosVehiculos($parqueVehicular) . '</pre>';
    }
    ?>

</body>
</html>
