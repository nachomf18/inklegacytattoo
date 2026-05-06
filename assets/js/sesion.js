async function comprobarSesion() {
    return await fetch("ajax/comprobar_sesion.php").then(response => response.text());
}