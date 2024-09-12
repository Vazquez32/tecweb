<?php
// Función para verificar si un número es múltiplo de 5 y 7
function esMultiplo($num) {
    if ($num % 5 == 0 && $num % 7 == 0) {
        echo '<h3>R= El número ' . $num . ' SÍ es múltiplo de 5 y 7.</h3>';
    } else {
        echo '<h3>R= El número ' . $num . ' NO es múltiplo de 5 y 7.</h3>';
    }
}

// Función para generar secuencias de números aleatorios
function generarSecuencia() {
    $matriz = [];  // Matriz para almacenar las secuencias
    $iteraciones = 0;  // Contador de iteraciones

    // Bucle infinito que generará números hasta cumplir la condición
    while (true) {
        // Incrementar contador de iteraciones
        $iteraciones++;

        // Generar tres números aleatorios entre 0 y 999
        $num1 = rand(0, 999);
        $num2 = rand(0, 999);
        $num3 = rand(0, 999);

        // Almacenar la secuencia en la matriz
        $matriz[] = [$num1, $num2, $num3];

        // Comprobar la condición: impar, par, impar
        if ($num1 % 2 != 0 && $num2 % 2 == 0 && $num3 % 2 != 0) {
            // Si la secuencia cumple con la condición, salir del bucle
            break;
        }
    }

    // Mostrar la tabla
    echo '<table border="1" cellpadding="10" cellspacing="0" style="border-collapse: collapse; text-align: center;">';
    echo '<thead><th>Número 1 (Impar)</th><th>Número 2 (Par)</th><th>Número 3 (Impar)</th></tr></thead>';
    echo '<tbody>';

    // Iterar sobre la matriz para mostrar cada fila
    foreach ($matriz as $index => $fila) {
        echo '<tr>';
   
        echo '<td>' . $fila[0] . '</td>';
        echo '<td>' . $fila[1] . '</td>';
        echo '<td>' . $fila[2] . '</td>';
        echo '</tr>';
    }

    echo '</tbody></table>';

    // Calcular la cantidad total de números generados (3 números por iteración)
    $cantidad_numeros = $iteraciones * 3;

    // Mostrar la cantidad de iteraciones y números generados
    echo "<br><strong>$cantidad_numeros números obtenidos en $iteraciones iteraciones</strong>";
}

// Función con ciclo while para encontrar un múltiplo
function encontrarMultiploWhile($multiplo) {
    $numero_aleatorio = 0; // Inicializar variable para almacenar el número aleatorio
    $intentos = 0; // Contador de intentos

    // Ciclo while para encontrar un número aleatorio múltiplo del número dado
    while ($numero_aleatorio % $multiplo != 0) {
        $numero_aleatorio = rand(1, 999); // Generar número aleatorio entre 1 y 999
        $intentos++;
    }

    return "Número aleatorio múltiplo de $multiplo encontrado: $numero_aleatorio<br>Se necesitaron $intentos intentos.";
}

// Función con ciclo do-while para encontrar un múltiplo
function encontrarMultiploDoWhile($multiplo) {
    $numero_aleatorio = 0; // Inicializar variable para almacenar el número aleatorio
    $intentos = 0; // Contador de intentos

    // Ciclo do-while para encontrar un número aleatorio múltiplo del número dado
    do {
        $numero_aleatorio = rand(1, 999); // Generar número aleatorio entre 1 y 999
        $intentos++;
    } while ($numero_aleatorio % $multiplo != 0);

    return "Número aleatorio múltiplo de $multiplo encontrado: $numero_aleatorio<br>Se necesitaron $intentos intentos.";
}


//Ejercicio 4
function generarArregloAscii() {
    $arreglo = [];
    for ($i = 97; $i <= 122; $i++) {
        $arreglo[$i] = chr($i); // chr() convierte el código ASCII en un carácter
    }
    return $arreglo;
}

function verificarEdadSexo($edad, $sexo) {
    if ($sexo == 'femenino' && $edad >= 18 && $edad <= 35) {
        return '<h3>Bienvenida, usted está en el rango de edad permitido.</h3>';
    } else {
        return '<h3>Error: No cumple con los requisitos.</h3>';
    }
}

?>
