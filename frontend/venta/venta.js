// frontend/venta/venta.js

// venta.js
// Función para actualizar el precio
// Función para actualizar el precio
function actualizarPrecio() {
    const select = document.getElementById('producto'); // Obtenemos el selector
    const precio = select.options[select.selectedIndex].dataset.precio; // Obtenemos el precio de la opción seleccionada

    if (precio) {
        document.getElementById('precio').value = precio; // Llenamos el campo de precio con el valor correspondiente
        calcularTotal(); // Actualizamos el total automáticamente
    }
}

// Función para calcular el total
function calcularTotal() {
    const precio = parseFloat(document.getElementById('precio').value) || 0; // Obtenemos el precio
    const cantidad = parseInt(document.getElementById('cantidad').value) || 0; // Obtenemos la cantidad
    const total = precio * cantidad; // Calculamos el total

    document.getElementById('total').value = total.toFixed(2); // Mostramos el total en el campo correspondiente
}

// Cargar los productos desde la base de datos
document.addEventListener('DOMContentLoaded', function() {
    fetch('../backend/cargar_productos.php')
        .then(res => res.json())
        .then(productos => {
            const select = document.getElementById('producto');
            productos.forEach(producto => {
                const option = document.createElement('option');
                option.value = producto.id_producto;
                option.dataset.precio = producto.precio;
                option.textContent = `${producto.nombre} - ${producto.precio} Bs`;
                select.appendChild(option);
            });
        })
        .catch(error => console.log('Error al cargar productos:', error));
});
// Función para actualizar el precio
function actualizarPrecio() {
    const select = document.getElementById('producto'); // Obtenemos el selector
    const precio = select.options[select.selectedIndex].dataset.precio; // Obtenemos el precio de la opción seleccionada

    if (precio) {
        document.getElementById('precio').value = precio; // Llenamos el campo de precio con el valor correspondiente
        calcularTotal(); // Actualizamos el total automáticamente
    }
}

// Función para calcular el total
function calcularTotal() {
    const precio = parseFloat(document.getElementById('precio').value) || 0; // Obtenemos el precio
    const cantidad = parseInt(document.getElementById('cantidad').value) || 0; // Obtenemos la cantidad
    const total = precio * cantidad; // Calculamos el total

    document.getElementById('total').value = total.toFixed(2); // Mostramos el total en el campo correspondiente
}

// Cargar los productos desde la base de datos
document.addEventListener('DOMContentLoaded', function() {
    fetch('../backend/cargar_productos.php')
        .then(res => res.json())
        .then(productos => {
            const select = document.getElementById('producto');
            productos.forEach(producto => {
                const option = document.createElement('option');
                option.value = producto.id_producto;
                option.dataset.precio = producto.precio;
                option.textContent = `${producto.nombre} - ${producto.precio} Bs`;
                select.appendChild(option);
            });
        })
        .catch(error => console.log('Error al cargar productos:', error));
});
