// Función para cargar contenido dinámicamente
function cargarContenido(ruta) {
    const contenedor = document.getElementById('contenido');

    fetch(ruta)
        .then(response => {
            if (!response.ok) {
                throw new Error('No se pudo cargar el contenido');
            }
            return response.text();
        })
        .then(data => {
            contenedor.innerHTML = data;

            // Limpiar estilos anteriores (inicio.css o venta.css)
            limpiarEstilos();

            // Cargar el estilo y script correspondiente
            if (ruta.includes('venta.html')) {
                cargarEstilo('venta/venta.css');
                cargarScript('venta/venta.js');
            } else if (ruta.includes('inicio.html')) {
                cargarEstilo('inicio/inicio.css');
            }

            // Actualizar el historial de navegación
            history.pushState({ ruta: ruta }, '', ruta);
        })
        .catch(error => {
            contenedor.innerHTML = `<p style="color:red;">Error: ${error.message}</p>`;
        });
}

// Función para cargar un estilo CSS dinámicamente
function cargarEstilo(ruta) {
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = ruta;
    link.type = 'text/css';
    link.onload = () => {
        console.log(`Estilo cargado: ${ruta}`);
    };
    link.onerror = (error) => {
        console.error(`Error al cargar el estilo: ${ruta}`, error);
    };
    document.head.appendChild(link);
}

// Función para cargar un script JS dinámicamente
function cargarScript(ruta) {
    const script = document.createElement('script');
    script.src = ruta;
    script.type = 'text/javascript';
    script.onload = () => {
        console.log(`Script cargado: ${ruta}`);
    };
    script.onerror = (error) => {
        console.error(`Error al cargar el script: ${ruta}`, error);
    };
    document.body.appendChild(script);
}

// Función para eliminar los estilos de inicio o venta anteriores
function limpiarEstilos() {
    const links = document.querySelectorAll('link[rel="stylesheet"]');
    links.forEach(link => {
        if (link.href.includes('inicio/') || link.href.includes('venta/')) {
            link.remove();
        }
    });
}

// Función para manejar la navegación hacia atrás
function navegar(paso) {
    history.go(paso); // Permite navegar hacia atrás o adelante en el historial
}

// Escuchar cambios en el historial para recargar la vista correcta
window.onpopstate = function (event) {
    if (event.state && event.state.ruta) {
        cargarContenido(event.state.ruta);
    }
};

// Cargar la bienvenida al iniciar
window.onload = () => {
    cargarContenido('inicio.html'); // Cambia 'inicio.html' si es necesario
};
