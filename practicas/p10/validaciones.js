document.getElementById('formProducto').addEventListener('submit', function(event) {
    event.preventDefault(); // Evitar envío automático del formulario
    
    // Obtener los valores de los campos
    let nombre = document.getElementById('nombre').value.trim();
    let marca = document.getElementById('marca').value;
    let modelo = document.getElementById('modelo').value.trim();
    let precio = parseFloat(document.getElementById('precio').value);
    let detalles = document.getElementById('detalles').value.trim();
    let unidades = parseInt(document.getElementById('unidades').value);
    let imagen = document.getElementById('imagen').value;

    // Validar el nombre (requerido y <= 100 caracteres)
    if (nombre === '' || nombre.length > 100) {
        mostrarError('El nombre es requerido y debe tener 100 caracteres o menos.');
        return;
    }

    // Validar la marca (requerida y seleccionada)
    if (marca === '') {
        mostrarError('Debe seleccionar una marca.');
        return;
    }

    // Validar el modelo (requerido, alfanumérico, <= 25 caracteres)
    let alfanumericoRegex = /^[a-zA-Z0-9\s]+$/;
    if (modelo === '' || modelo.length > 25 || !alfanumericoRegex.test(modelo)) {
        mostrarError('El modelo es requerido, debe ser alfanumérico y tener 25 caracteres o menos.');
        return;
    }

    // Validar el precio (requerido y mayor a 99.99)
    if (isNaN(precio) || precio <= 99.99) {
        mostrarError('El precio es requerido y debe ser mayor a 99.99.');
        return;
    }

    // Validar detalles (opcional, <= 250 caracteres)
    if (detalles.length > 250) {
        mostrarError('Los detalles no deben exceder los 250 caracteres.');
        return;
    }

    // Validar unidades (requerido y >= 0)
    if (isNaN(unidades) || unidades < 0) {
        mostrarError('Las unidades son requeridas y deben ser mayores o iguales a 0.');
        return;
    }

    // Validar imagen (opcional, establecer imagen por defecto si no se selecciona una)
    if (!imagen) {
        imagen = 'img/imagen_defecto.jpg'; // Ruta por defecto
    }

    // Si pasa todas las validaciones, limpiar el mensaje de error y proceder
    limpiarError();
    console.log('Formulario válido, procesando...', { nombre, marca, modelo, precio, detalles, unidades, imagen });

    // Aquí puedes hacer la lógica para enviar los datos, por ejemplo, con AJAX

});

function mostrarError(mensaje) {
    document.getElementById('mensajeError').innerText = mensaje;
}

function limpiarError() {
    document.getElementById('mensajeError').innerText = '';
}
