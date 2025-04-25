


<?php
session_start();  // Inicia la sesión

// Elimina todas las variables de sesión
session_unset();

// Destruye la sesión
session_destroy();

// Verifica si la sesión fue destruida correctamente
if (session_status() == PHP_SESSION_NONE) {
    // Redirige al login si la sesión fue destruida
    header("Location: ../frontend/index.html");
    exit;
} else {
    // Si la sesión no se destruyó correctamente, redirige igualmente
    header("Location: ../frontend/index.html");
    exit;
}
?>
