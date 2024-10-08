<?php
/** SE CREA EL OBJETO DE CONEXION */
@$link = new mysqli('localhost', 'root', 'root123', 'marketzone');
/** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */

/** comprobar la conexión */
if ($link->connect_errno) {
    die('Falló la conexión: ' . $link->connect_error . '<br/>');
}

/** Crear una tabla que no devuelve un conjunto de resultados */
if ($result = $link->query("SELECT * FROM productos WHERE eliminado = 0")) {
    echo '<table class="table">';
    echo '<thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Marca</th>
                <th scope="col">Modelo</th>
                <th scope="col">Precio</th>
                <th scope="col">Unidades</th>
                <th scope="col">Detalles</th>
                <th scope="col">Imagen</th>
                <th scope="col">Modificar</th>
            </tr>
          </thead>';
    echo '<tbody>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<th scope="row">' . $row['id'] . '</th>';
        echo '<td>' . $row['nombre'] . '</td>';
        echo '<td>' . $row['marca'] . '</td>';
        echo '<td>' . $row['modelo'] . '</td>';
        echo '<td>' . $row['precio'] . '</td>';
        echo '<td>' . $row['unidades'] . '</td>';
        echo '<td>' . utf8_encode($row['detalles']) . '</td>';
        echo '<td><img src="' . $row['imagen'] . '" alt="Imagen del producto" width="150" height="150" /></td>';
        echo '<td><a href="modificarProducto.php?id=' . $row['id'] . '" class="btn btn-primary">Modificar</a></td>';
        echo '</tr>';
    }

    echo '</tbody></table>';
    $result->free();
}

$link->close();
?>
