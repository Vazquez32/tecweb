// JSON BASE A MOSTRAR EN FORMULARIO
// Editamos algo en el JSON base para que se vea en el formulario

var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
};
$(document).ready(function(){ 
    let edit = false;
    let JsonString = JSON.stringify(baseJSON,null,2);
    $('#description').val(JsonString);
    $('#product-result').hide();
    listarProductos();
    function listarProductos() {
        $.ajax({
            url: './backend/product-list.php',
            type: 'GET',
            success: function(response) {
                // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                const productos = JSON.parse(response);
            
                // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                if(Object.keys(productos).length > 0) {
                    // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                    let template = '';
                    productos.forEach(producto => {
                        // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                        let descripcion = '';
                        descripcion += '<li>precio: '+producto.precio+'</li>';
                        descripcion += '<li>unidades: '+producto.unidades+'</li>';
                        descripcion += '<li>modelo: '+producto.modelo+'</li>';
                        descripcion += '<li>marca: '+producto.marca+'</li>';
                        descripcion += '<li>detalles: '+producto.detalles+'</li>';
                    
                        template += `
                            <tr productId="${producto.id}">
                                <td>${producto.id}</td>
                                <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="product-delete btn btn-danger" onclick="eliminarProducto()">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                    // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                    $('#products').html(template);
                }
            }
        });
    }
    $('#search').keyup(function() {
        if($('#search').val()) {
            let search = $('#search').val();
            $.ajax({
                url: './backend/product-search.php?search='+$('#search').val(),
                data: {search},
                type: 'GET',
                success: function (response) {
                    if(!response.error) {
                        // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                        const productos = JSON.parse(response);
                        
                        // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                        if(Object.keys(productos).length > 0) {
                            // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                            let template = '';
                            let template_bar = '';
                            productos.forEach(producto => {
                                // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                                let descripcion = '';
                                descripcion += '<li>precio: '+producto.precio+'</li>';
                                descripcion += '<li>unidades: '+producto.unidades+'</li>';
                                descripcion += '<li>modelo: '+producto.modelo+'</li>';
                                descripcion += '<li>marca: '+producto.marca+'</li>';
                                descripcion += '<li>detalles: '+producto.detalles+'</li>';
                            
                                template += `
                                    <tr productId="${producto.id}">
                                        <td>${producto.id}</td>
                                        <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                        <td><ul>${descripcion}</ul></td>
                                        <td>
                                            <button class="product-delete btn btn-danger">
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                `;
                                template_bar += `
                                    <li>${producto.nombre}</il>
                                `;
                            });
                            // SE HACE VISIBLE LA BARRA DE ESTADO
                            $('#product-result').show();
                            // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
                            $('#container').html(template_bar);
                            // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                            $('#products').html(template);    
                        }
                    }
                }
            });
        }
        else {
            $('#product-result').hide();
            listarProductos();
        }
    });
    $('#product-form').submit(e => {
        e.preventDefault();
        // SE Declara el JSON que contiene los datos del formulario
        let finalJSON = {
            "id": $('#productId').val(),
            "nombre": $('#name').val(),
            "precio": $('#precio').val(),
            "unidades": $('#unidades').val(),
            "modelo": $('#modelo').val(),
            "marca": $('#marca').val(),
            "detalles": $('#detalles').val(),
            "imagen": $('#imagen').val()
        };
    
        /**
         * AQUÍ DEBES AGREGAR LAS VALIDACIONES DE LOS DATOS EN EL JSON
         * --> EN CASO DE NO HABER ERRORES, SE ENVIAR EL PRODUCTO A AGREGAR
         **/
        if(nombre(finalJSON.nombre)){ //Se valida el nombre, si es incorrecto la funcion de nombre regresa true, 
            //por lo que se muestra un mensaje de error y se sale del proceso de envio de datos, se cancela el submit
            $(this).addClass('is-invalid');
            return;
        }
        if(precio(finalJSON.precio)){ 
            $(this).addClass('is-invalid');
            return;
        }
        if(unidades(finalJSON.unidades)){
            $(this).addClass('is-invalid');
            return;
        }
        if(modelo(finalJSON.modelo)){
            $(this).addClass('is-invalid');
            return;
        }
        if(marca(finalJSON.marca)){
            $(this).addClass('is-invalid');
            return;
        }
        if(detalles(finalJSON.detalles)){
            $(this).addClass('is-invalid');
            return;
        }
        if(finalJSON.imagen == ""){ //Para el campo de la imagen, no hay una validacion como tal, pero en dado caso de que no se haya
            //ingresado una ruta a una imagen, se asigna una imagen por defecto
            finalJSON.imagen = "img/default.png";
        }
        
        const url = edit === false ? './backend/product-add.php' : './backend/product-edit.php';
        
        $.post(url, finalJSON, (response) => {
            //console.log(response);
            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let respuesta = JSON.parse(response);
            // SE CREA UNA PLANTILLA PARA CREAR INFORMACIÓN DE LA BARRA DE ESTADO
            let template_bar = '';
            template_bar += `
                        <li style="list-style: none;">status: ${respuesta.status}</li>
                        <li style="list-style: none;">message: ${respuesta.message}</li>
                    `;
            // SE REINICIA EL FORMULARIO
            $('#name').val('');
            $('#precio').val('');
            $('#unidades').val('');
            $('#modelo').val('');
            $('#marca').val('');
            $('#detalles').val('');
            $('#imagen').val('');
            $('#productId').val('');
            // SE HACE VISIBLE LA BARRA DE ESTADO
            $('#product-result').show();
            // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
            $('#container').html(template_bar);
            // SE LISTAN TODOS LOS PRODUCTOS
            listarProductos();
            // SE REGRESA LA BANDERA DE EDICIÓN A false
            edit = false;
        });
    });
    $(document).on('click', '.product-delete', (e) => {
        if(confirm('¿Realmente deseas eliminar el producto?')) {
            const element = $(this)[0].activeElement.parentElement.parentElement;
            const id = $(element).attr('productId');
            $.post('./backend/product-delete.php', {id}, (response) => {
                $('#product-result').hide();
                listarProductos();
            });
        }
    });
    $(document).on('click', '.product-item', (e) => {
        const element = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(element).attr('productId');
        $.post('./backend/product-single.php', {id}, (response) => {
            // SE CONVIERTE A OBJETO EL JSON OBTENIDO
            let product = JSON.parse(response);
            // SE INSERTAN LOS DATOS ESPECIALES EN LOS CAMPOS CORRESPONDIENTES
            $('#name').val(product.nombre);
            // EL ID SE INSERTA EN UN CAMPO OCULTO PARA USARLO DESPUÉS PARA LA ACTUALIZACIÓN
            $('#productId').val(product.id);
            
            //Se rellena el formulario con los datos del producto que se quiere editar
            $('#precio').val(product.precio);
            $('#unidades').val(product.unidades);
            $('#modelo').val(product.modelo);
            $('#marca').val(product.marca);
            $('#detalles').val(product.detalles);
            $('#imagen').val(product.imagen);
            
            // SE PONE LA BANDERA DE EDICIÓN EN true
            edit = true;
        });
        e.preventDefault();
    });    
    //Se agregan ahora los event listeners para los campos del formulario, se realizan las validaciones
    //correspondientes y se muestra un mensaje de error si es necesario.
    $('#name').on('blur', function() { //Se agrega un event listener para el campo nombre, cada vez que se pierde el foco, o sea que
        //se da click en otro lado cuando antes se le habia dado click a este campo, se ejecuta la función
        let nombreInput = $(this).val();
        if (nombre(nombreInput)) {
            $(this).addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid');
        }
    });
    $('#marca').on('blur', function() {
        let marcaInput = $(this).val();
        if (marca(marcaInput)) {
            $(this).addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid');
        }
    });
    $('#modelo').on('blur', function() {
        let modeloInput = $(this).val();
        if (modelo(modeloInput)) {
            $(this).addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid');
        }
    });
    $('#precio').on('blur', function() {
        let precioInput = $(this).val();
        if (precio(precioInput)) {
            $(this).addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid');
        }
    });
    $('#detalles').on('blur', function() {
        let detallesInput = $(this).val();
        if (detalles(detallesInput)) {
            $(this).addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid');
        }
    });
    $('#unidades').on('blur', function() {
        let unidadesInput = $(this).val();
        if (unidades(unidadesInput)) {
            $(this).addClass('is-invalid');
        } else {
            $(this).removeClass('is-invalid');
        }
    });
});
function nombre(nom){
    if(nom.length > 100 || nom.length==0){
        console.log("Error en nombre");
        return true;
    }else{
        return false;
    }
    //Se valida el nombre, si es incorrecto la funcion de nombre regresa true,
}
function marca(mar){
    let marcas = {
        "Williv":1,
        "Casio":2,
    };
    if(marcas[mar] == undefined){
        console.log("Error en marca");
        return true;
    }else{
        return false;
    }
}
function modelo(model){
    let regex = /^[a-zA-Z0-9]{1,25}$/; // Expresión regular
    if(model.length > 25 || regex.test(model) == false){
        console.log("Error en modelo");
        return true;
    }else{
        return false;
    }
}
    //Se valida el nombre, si es incorrecto la funcion de nombre regresa true,
function precio(precio){
    if(Number(precio) < 99.99){
        console.log("Error en precio");
        return true;
    }else{
        return false;
    }
}
function detalles(detalles){
    if(detalles!= ""){
        if(detalles.length > 255){
            console.log("Error en detalles");
            return true;
        }
    }
    return false;
}
//Se valida el nombre, si es incorrecto la funcion de nombre regresa true,
function unidades(unidades){
    if(Number(unidades) < 0){
        console.log("Error en unidades");
        return true;
    }else{
        return false;
    }
}