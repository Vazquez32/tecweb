// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
};

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;

    // SE LISTAN TODOS LOS PRODUCTOS
    //listarProductos();
}

$(function() {
    //Esta funcion se ejecuta apenas carga la pagina, se hace una peticion GET al servidor para obtener la lista de productos
    listarProductos(); //Se listan los productos nuevamente, para que se muestren en la tabla incluso si se agrega un producto
    let edit = false;//Se crea una variable para saber si se esta editando un producto o no, por defecto es false, ya que al cargar la pagina no se esta editando ningun producto
    $('#product-result').hide();//Se oculta el contenedor de productos al cargar la pagina
    $('#search').keyup(function(e) { //Cuando se haga click en el boton de buscar, se ejecuta la funcion
        e.preventDefault();//Se previene el comportamiento por defecto del boton
        let search = $('#search').val();

        if(search == ""){//Si el campo de busqueda esta vacio, no se hace nada
            $('#product-result').hide();
            listarProductos();
            return;
        }

        $.ajax({ //Este es el metodo que usa JQUERY para hacer peticiones AJAX, se definen los parametros de la peticion en un objeto, en AJAX puro es lo de usar el objeto XMLHttpRequest
            url: 'backend/product-search.php',
            type: 'GET',
            data: {search: search}, //Se envia el parametro de busqueda al servidor, este se envia como un objeto, donde el nombre del parametro es search y el valor es el valor del campo de busqueda
            //al momento de recuperarlo en el lado del servidor se recupera como $_GET['search']
            success: function(response) {

                if(response == "[]"){//Si la respuesta es un JSON vacio, no se muestra nada
                    $('#product-result').hide();
                    return;
                }
                let productos = JSON.parse(response);//Se convierte la respuesta a un objeto JSON, ya que la respuesta es un string
                let template = '';//Se crea una variable para guardar el HTML que se va a generar
                productos.forEach(producto => {//Se recorre el JSON de productos obtenido de la busqueda, eso para poder trabajar con cada uno de los productos retornados
                    template += `<li>
                        ${producto.nombre}
                    </li>`;//Se genera el HTML de cada producto
                });

                
                

                $('#product-result').show();//Se muestra el contenedor de productos
                $('#container').html(template);//Se inserta el HTML generado en el contenedor de productos

                template = ''; //Se limpia el template para poder generar el HTML de los productos en la tabla
                productos.forEach(producto => {
                    template += `<tr product-id = ${producto.id}>
                            <td>${producto.id}</td>
                            <td>
                                <a href="#" class="producto-item">${producto.nombre}</a>
                            </td>
                            <td>
                                <ul>
                                    <li>Precio: ${producto.precio}</li>
                                    <li>Unidades: ${producto.unidades}</li>
                                    <li>Modelo: ${producto.modelo}</li>
                                    <li>Marca: ${producto.marca}</li>
                                    <li>Detalles: ${producto.detalles}</li>
                                </ul>
                            </td>
                            <td>
                                <button class="product-delete btn btn-danger">
                                    Delete
                                </button>
                            </td>
                    </tr>`;
            
                });
                $('#products').html(template);//Se inserta el HTML generado en la tabla de productos

            },
        });
        
    });

    // SE AGREGA UN PRODUCTO
    $('#product-form').submit(function(e) {
        e.preventDefault(); // Se previene el comportamiento por defecto del formulario
        
        // SE OBTIENE DESDE EL FORMULARIO EL JSON A ENVIAR
        let productoJsonString = $('#description').val();
        // SE CONVIERTE EL JSON DE STRING A OBJETO
        let finalJSON = JSON.parse(productoJsonString);
        // SE AGREGA AL JSON EL NOMBRE DEL PRODUCTO
        finalJSON['nombre'] = $('#name').val();
        finalJSON['id'] = $('#product-id').val();
        // SE OBTIENE EL STRING DEL JSON FINAL

        //Validaciones de los datos de los productos a ingresar, en caso de que alguno no sea correcto se muestra
        //un mensaje de alerta y se detiene la ejecución de la función
        if(nombre(finalJSON['nombre']) || marca(finalJSON['marca']) || modelo(finalJSON['modelo']) || precio(finalJSON['precio']) || detalles(finalJSON['detalles']) || unidades(finalJSON['unidades'])){
            return;
        }

        finalJSON = JSON.stringify(finalJSON);//Se convierte el JSON final a un string para poder enviarlo al servidor, ya que en el servidor se reconvierte luego a JSON

        if(edit){//Si se esta editando un producto, se hace una peticion POST al servidor para editar el producto
            $.post('backend/product-edit.php', finalJSON, function(response) {//Se hace una peticion POST al servidor con el JSON del producto a editar
                console.log(response);//Se imprime la respuesta del servidor en la consola
                listarProductos();listarProductos();
            });
            edit = false;//Se cambia la variable edit a false, para saber que ya no se esta editando un producto
            listarProductos();//Se listan los productos nuevamente, para que se muestren en la tabla, tomando en cuenta ahora al producto editado, entonces ese producto ya no se muestra
            return;
        }

        
        $.post('backend/product-add.php', finalJSON, function(response) {//Se hace una peticion POST al servidor con el JSON del producto a agregar
            console.log(response);//Se imprime la respuesta del servidor en la consola
            listarProductos();listarProductos();
        });
        listarProductos();

    });

    //Funcionamiento del boton para eliminar el producto seleccionado
    $(document).on('click', '.product-delete', function() { //Se agrega un evento de click a los botones de eliminar
        
        if( !confirm("De verdad deseas eliminar el Producto") ) {
            return; //Si el usuario no confirma la eliminacion del producto, no se hace nada
        }
        
        let element = $(this)[0];//Se obtiene el boton que se hizo click, el this hace referencia al boton que se hizo click y el [0] es para obtener el elemento del arreglo de elementos que devuelve JQUERY,
        //en este caso como solo se selecciona un elemento, se obtiene el primer elemento del arreglo que es el indice 0
        let columnaTD = element.parentElement;//Se obtiene el padre del boton, que es la columna de la tabla, esta seleccion la hago solo para que me pueda ir ubicando en el DOM, ahora
        //que estoy en la columna, puedo ir subiendo en el DOM, para obtener la fila de la tabla que es la que tiene guardada la información del producto, en este caso el ID del producto
        let filaTR = columnaTD.parentElement;//Se obtiene la fila de la tabla, que es el padre de la columna, ahora que estoy ubicado aqui, puedo obtener el ID del producto

        let productoID = $(filaTR).attr('product-id');//Se obtiene el ID del producto, el .attr() es un metodo de JQUERY que permite obtener el valor de un atributo de un elemento HTML
        //como al momento de usar mi metodo de listar productos, guarde el ID del producto en el atributo product-id de la fila de la tabla, puedo obtenerlo de esta manera
        console.log(productoID);//Se imprime el ID del producto en la consola

        $.post('backend/product-delete.php', {id: productoID}, function(response) { //Se crea una peticion POST al servidor para eliminar el producto, se envia el ID del producto a eliminar
            console.log(response);//Se imprime la respuesta del servidor en la consola
            listarProductos();listarProductos();
        });
        listarProductos();//Se listan los productos nuevamente, para que se muestren en la tabla, tomando en cuenta ahora al producto eliminado, entonces ese producto ya no se muestra
    });

    //Funcionamiento para editar un producto
    $(document).on('click', '.producto-item', function() {//Se agrega un evento de click a los elementos de la clase producto-item, que son los nombres de los productos en la tabla
        let element = $(this)[0].parentElement.parentElement;//Se obtiene el elemento que se hizo click
        let id = $(element).attr('product-id');//Se obtiene el ID del producto
        $.post('backend/product-single.php', {id: id}, function(response) {//Se hace una peticion POST al servidor para obtener la informacion del producto seleccionado
            let producto = JSON.parse(response);//Se convierte la respuesta a un objeto JSON
            
            console.log(producto);

            $('#name').val(producto.nombre);//Se inserta el nombre del producto en el campo de nombre del formulario
            delete producto.nombre;//Se elimina el nombre del producto del JSON, ya que en la descripcion del producto no se guarda el nombre, el nombre va en un campo aparte
            let idProducto = producto.id;//Se guarda el ID del producto en una variable, para poder insertarlo en el JSON del producto
            delete producto.id;//Se elimina el ID del producto del JSON, ya que en el JSON del producto no se guarda el ID, el ID se guarda en un campo aparte
            $('#description').val(JSON.stringify(producto,null,2));//Se inserta el JSON del producto en el campo de descripcion del formulario
            
            $('#product-id').val(idProducto);//Se inserta el ID del producto en un campo oculto del formulario, para poder enviarlo al servidor cuando se haga la peticion de edicion  
            edit = true;//Se cambia la variable edit a true, para saber que se esta editando un producto
        });
    });
    
});

function listarProductos() {
    $.ajax({
        url: 'backend/product-list.php',
        type: 'GET',
        success: function(response) {
            let productos = JSON.parse(response);
            console.log(productos);
            let template = '';
            productos.forEach(producto => {//guardo dentro del td el id del producto, para poder eliminarlo despues, la clase es para poder seleccionar el td con JQUERY despues
                template += `<tr product-id = ${producto.id}>
                            <td>${producto.id}</td>
                            <td>
                                <a href="#" class="producto-item">${producto.nombre}</a>
                            </td>
                            <td>
                                <ul>
                                    <li>Precio: ${producto.precio}</li>
                                    <li>Unidades: ${producto.unidades}</li>
                                    <li>Modelo: ${producto.modelo}</li>
                                    <li>Marca: ${producto.marca}</li>
                                    <li>Detalles: ${producto.detalles}</li>
                                </ul>
                            </td>
                            <td>
                                <button class="product-delete btn btn-danger">
                                    Delete
                                </button>
                            </td>
                    </tr>`;
            });
            $('#products').html(template);
        }
    });
}

function nombre(nom){

    if(nom.length > 100 || nom.length==0){

        alert("El nombre debe tener de 1 a 100 caracteres")
        return true;
    }else{
        return false;
    }
}

function marca(mar){
    let marcas = {
        "Williv":1,
        "Casio":2,
    };
    if(marcas[mar] == undefined){
        alert("La marca debe ser valida");
        return true;
    }else{
        return false;
    }
}

function modelo(model){
    let regex = /^[a-zA-Z0-9]{1,25}$/; // Expresión regular
    if(model.length > 25 || regex.test(model) == false){
        alert("El modelo debe de ser de menos de 25 caracteres y tener caracteres validos");
        return true;
    }else{
        return false;
    }
}

function precio(precio){
    if(Number(precio) < 99.99){
        alert("El precio debe ser mayor a 99.99");
        return true;
    }else{
        return false;
    }
}

function detalles(detalles){
    if(detalles!= ""){
        if(detalles.length > 255){
            alert("Los detalles tienen un maximo de 255 caracteres");
            return true;
        }
    }
    return false;
}

function unidades(unidades){
    if(Number(unidades) < 0){
        alert("El numero de unidades del producto debe ser igual o mayor a cero");
        return true;
    }else{
        return false;
    }
}