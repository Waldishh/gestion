// Cargar productos desde el backend
fetch('../backend/ventas.php')  // Subir dos niveles desde venta/ hasta llegar a backend/
  .then(response => response.json())
  .then(data => {
    console.log(data); // Verifica si llegan los productos

    const select = document.getElementById('tipo-salteña');
    select.innerHTML = '<option value="">Seleccione una salteña</option>'; // Reinicia select

    data.forEach(producto => {
      const option = document.createElement('option');
      option.value = producto.id_producto;
      option.textContent = `${producto.nombre_producto} - Bs ${producto.precio}`;
      option.dataset.precio = producto.precio;
      select.appendChild(option);
    });
  })
  .catch(error => console.error('Error al cargar los productos:', error));

// Mostrar precio y calcular total
document.getElementById('tipo-salteña').addEventListener('change', function () {
  const selected = this.options[this.selectedIndex];
  const precio = selected.dataset.precio || 0;
  document.getElementById('precio').value = precio;
  calcularTotal();
});

document.getElementById('cantidad').addEventListener('input', calcularTotal);

function calcularTotal() {
  const precio = parseFloat(document.getElementById('precio').value) || 0;
  const cantidad = parseInt(document.getElementById('cantidad').value) || 1;
  const total = precio * cantidad;
  document.getElementById('total').value = total.toFixed(2);
}
