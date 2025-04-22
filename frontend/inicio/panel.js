


// Función para actualizar el precio
function actualizarPrecio() {
    const select = document.getElementById('producto');
    const precio = select.options[select.selectedIndex].dataset.precio;

    if (precio) {
        document.getElementById('precio').value = precio;
        calcularTotal(); // Calculamos el total cada vez que el precio cambia
    }
}

// Función para calcular el total
function calcularTotal() {
    const precio = parseFloat(document.getElementById('precio').value) || 0;
    const cantidad = parseInt(document.getElementById('cantidad').value) || 0;
    const total = precio * cantidad;

    document.getElementById('total').value = total.toFixed(2); // Actualizamos el campo de total
}

// Función para mostrar el resultado de la venta
function mostrarResultado() {
    const select = document.getElementById('producto');
    const productoSeleccionado = select.options[select.selectedIndex];

    const nombreProducto = productoSeleccionado ? productoSeleccionado.textContent : 'No seleccionado';
    const precioUnitario = document.getElementById('precio').value;
    const cantidad = document.getElementById('cantidad').value;
    const total = document.getElementById('total').value;

    const resultadoDiv = document.getElementById('resultado');
    resultadoDiv.innerHTML = `
        <h3>Resultado de la Venta</h3>
        <p><strong>Tipo de Salteña:</strong> ${nombreProducto}</p>
        <p><strong>Precio Unitario:</strong> ${precioUnitario} Bs</p>
        <p><strong>Cantidad:</strong> ${cantidad}</p>
        <p><strong>Total (Bs):</strong> ${total}</p>
    `;
}

// Cargar los productos desde la base de datos
document.addEventListener('DOMContentLoaded', function () {
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
