// Función para comprobar si el usuario tiene una sesión activa
async function comprobarSesion() {
    return await fetch("ajax/comprobar_sesion.php").then(response => response.text());
}