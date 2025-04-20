

// Mostrar el mensaje de error
function mostrarError(mensaje) {
    const errorDiv = document.getElementById('error-message');
    errorDiv.innerHTML = mensaje;
}

// Evitar el envío del formulario hasta que se valide
const form = document.getElementById('login-form');
form.addEventListener('submit', function (e) {
    const loader = document.getElementById('loader');
    loader.style.display = 'block'; // Mostrar el spinner de carga

    // Validación simple
    const usuario = document.getElementById('usuario').value;
    const clave = document.getElementById('clave').value;

    if (usuario === "" || clave === "") {
        e.preventDefault();
        mostrarError("Por favor, rellene todos los campos.");
        loader.style.display = 'none'; // Ocultar el spinner
    }
});
