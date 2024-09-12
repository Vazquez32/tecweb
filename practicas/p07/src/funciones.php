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

//Ejercicio 5

function verificarEdadSexo($edad, $sexo) {
    if ($sexo == 'femenino' && $edad >= 18 && $edad <= 35) {
        return '<h3>Bienvenida, usted está en el rango de edad permitido.</h3>';
    } else {
        return '<h3>Error: No cumple con los requisitos.</h3>';
    }
}

//Ejercicio 6

//registros 
$parqueVehicular = array(
    'ABC1234' => array(
        'Auto' => array(
            'marca' => 'HONDA',
            'modelo' => 2020,
            'tipo' => 'camioneta'
        ),
        'Propietario' => array(
            'nombre' => 'Alfonzo Esparza',
            'ciudad' => 'Puebla, Pue.',
            'direccion' => 'C.U., Jardines de San Manuel'       //1
        )
    ),
    'DEF5678' => array(
        'Auto' => array(
            'marca' => 'MAZDA',
            'modelo' => 2019,
            'tipo' => 'sedan'
        ),
        'Propietario' => array(
            'nombre' => 'Ma. del Consuelo Molina',
            'ciudad' => 'Puebla, Pue.',
            'direccion' => '97 oriente'         //2
        )
    ),
    // Agrega más registros (15 en total)
    'XYZ9876' => array(
        'Auto' => array(
            'marca' => 'FORD',
            'modelo' => 2018,
            'tipo' => 'hachback'
        ),
        'Propietario' => array(
            'nombre' => 'Carlos Ruiz',
            'ciudad' => 'Ciudad de México',
            'direccion' => 'Colonia del Valle'      //3
        )
    ),
    'UBN6340' => array(
        'Auto' => array(
            'marca' => 'Nissan',
            'modelo' => 2021,
            'tipo' => 'sedan',
        ),
        'Propietario' => array(
            'nombre' => 'Carlos López',
            'ciudad' => 'Puebla, Pue.',
            'direccion' => 'Av. Juárez, Colonia La Paz',      //4
        )
    ),
    'UBN6341' => array(
        'Auto' => array(
            'marca' => 'Chevrolet',
            'modelo' => 2018,
            'tipo' => 'hatchback',
        ),
        'Propietario' => array(
            'nombre' => 'María Fernández',
            'ciudad' => 'Puebla, Pue.',
            'direccion' => 'Boulevard Xonaca, Colonia Xonaca',      //5
        )
    ),
    'UBN6342' => array(
        'Auto' => array(
            'marca' => 'Toyota',
            'modelo' => 2020,
            'tipo' => 'camioneta',
        ),
        'Propietario' => array(
            'nombre' => 'Luis Sánchez',
            'ciudad' => 'Puebla, Pue.',
            'direccion' => 'Calle 5 Sur, Colonia Centro', //6
        )
    ),
    'UBN6343' => array(
        'Auto' => array(
            'marca' => 'Ford',
            'modelo' => 2019,
            'tipo' => 'sedan',
        ),
        'Propietario' => array(
            'nombre' => 'Ana García',
            'ciudad' => 'Puebla, Pue.',
            'direccion' => 'Av. Reforma, Colonia Reforma Agua Azul', //7
        )
    ),
    'UBN6344' => array(
        'Auto' => array(
            'marca' => 'Hyundai',
            'modelo' => 2022,
            'tipo' => 'hatchback',
        ),
        'Propietario' => array(
            'nombre' => 'Jorge Martínez',
            'ciudad' => 'Puebla, Pue.',
            'direccion' => 'Calle 3 Norte, Colonia Santiago',  //8
        )
    ),    
    'UBN6345' => array(
        'Auto' => array(
            'marca' => 'Mazda',
            'modelo' => 2021,
            'tipo' => 'sedan',
        ),
        'Propietario' => array(
            'nombre' => 'Beatriz Gómez',
            'ciudad' => 'Puebla, Pue.',
            'direccion' => 'Calle 16 de Septiembre, Colonia El Carmen',  //9
        )
    ),
    'UBN6346' => array(
        'Auto' => array(
            'marca' => 'Volkswagen',
            'modelo' => 2017,
            'tipo' => 'camioneta',
        ),
        'Propietario' => array(
            'nombre' => 'Pedro Pérez',
            'ciudad' => 'Puebla, Pue.',
            'direccion' => 'Calle 43 Poniente, Colonia La Noria',  //10
        )
    ),
    'UBN6347' => array(
        'Auto' => array(
            'marca' => 'Jeep',
            'modelo' => 2020,
            'tipo' => 'camioneta',
        ),
        'Propietario' => array(
            'nombre' => 'Laura Ramírez',
            'ciudad' => 'Puebla, Pue.',
            'direccion' => 'Boulevard 5 de Mayo, Colonia Analco',//11
        )
    ),
    'UBN6348' => array(
        'Auto' => array(
            'marca' => 'Renault',
            'modelo' => 2021,
            'tipo' => 'sedan',
        ),
        'Propietario' => array(
            'nombre' => 'Fernando Gutiérrez',
            'ciudad' => 'Puebla, Pue.',
            'direccion' => 'Calle 11 Sur, Colonia El Mirador', //12
        )
    ),
    'UBN6349' => array(
        'Auto' => array(
            'marca' => 'Honda',
            'modelo' => 2018,
            'tipo' => 'hatchback',
        ),
        'Propietario' => array(
            'nombre' => 'Carmen Hernández',
            'ciudad' => 'Puebla, Pue.',
            'direccion' => 'Av. 31 Oriente, Colonia Huexotitla', //13
        )
    ),
    'UBN6350' => array(
        'Auto' => array(
            'marca' => 'Kia',
            'modelo' => 2022,
            'tipo' => 'camioneta',
        ),
        'Propietario' => array(
            'nombre' => 'Roberto Aguilar',
            'ciudad' => 'Puebla, Pue.',
            'direccion' => 'Calle 25 Poniente, Colonia Santa María',   //14
        )
    ),
    'UBN6351' => array(
        'Auto' => array(
            'marca' => 'Subaru',
            'modelo' => 2019,
            'tipo' => 'sedan',
        ),
        'Propietario' => array(
            'nombre' => 'Claudia Mendoza',
            'ciudad' => 'Puebla, Pue.',
            'direccion' => 'Av. 4 Norte, Colonia Las Fuentes',  //15
        )
    ),
);


// Función para mostrar un vehículo por matrícula
function mostrarVehiculoPorMatricula($matricula, $parqueVehicular) {
    if (isset($parqueVehicular[$matricula])) {
        return print_r($parqueVehicular[$matricula], true);
    } else {
        return "No se encontró un vehículo con esa matrícula.";
    }
}

// Función para mostrar todos los vehículos
function mostrarTodosLosVehiculos($parqueVehicular) {
    return print_r($parqueVehicular, true);
}


?>
