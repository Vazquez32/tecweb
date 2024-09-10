<?php
// Función para verificar si un número es múltiplo de 5 y 7
function esMultiplo($num) {
    if ($num % 5 == 0 && $num % 7 == 0) {
        echo '<h3>R= El número ' . $num . ' SÍ es múltiplo de 5 y 7.</h3>';
    } else {
        echo '<h3>R= El número ' . $num . ' NO es múltiplo de 5 y 7.</h3>';
    }
}
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
    echo '<thead><tr><th>Iteración</th><th>Número 1 (Impar)</th><th>Número 2 (Par)</th><th>Número 3 (Impar)</th></tr></thead>';
    echo '<tbody>';

    // Iterar sobre la matriz para mostrar cada fila
    foreach ($matriz as $index => $fila) {
        echo '<tr>';
        echo '<td>' . ($index + 1) . '</td>';  // Mostrar el número de iteración
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


?>
