document.addEventListener('DOMContentLoaded', function() {
    // Comprobar sesión para mostrar u ocultar opciones del menú
    comprobarSesion().then(mensaje => {
        if (mensaje === "TRUE") {
            const ul = document.querySelector('nav ul');
            ul.children[4].style.display = 'none';
            ul.children[5].style.display = 'block';
            ul.children[6].style.display = 'block';
        }
    });

    // Manejar menú móvil
    document.getElementById('menu-icon').addEventListener('click', function() {
        const navLinks = document.querySelector('nav ul');
        const menuIcon = document.getElementById('menu-icon');
    
        if (navLinks.style.height == '0px' || navLinks.style.height === '') {
            navLinks.style.animation = 'open-menu 1s ease-in-out forwards';
            menuIcon.src = './assets/img/close.svg';    
            menuIcon.alt = 'Cerrar menú de navegación móvil';
            navLinks.style.height = '250px';
        } else {
            navLinks.style.animation = 'close-menu 1s ease-in-out forwards';
            menuIcon.src = './assets/img/menu.svg';
            menuIcon.alt = 'Menú de navegación móvil';
            navLinks.style.height = '0';
        }
    });

    document.getElementById('logout').addEventListener('click', function(e) {
        e.preventDefault();
        fetch('ajax/logout.php')
        .then(response => {
            if (response.ok) {
                const ul = document.querySelector('nav ul');
                ul.children[4].style.display = 'block';
                ul.children[5].style.display = 'none';
                ul.children[6].style.display = 'none';
                alert("Sesión cerrada correctamente");
            }
        });
    });
});