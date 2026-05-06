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

document.addEventListener("DOMContentLoaded", function() {
    comprobarSesion().then(mensaje => {
        if (mensaje === "TRUE") {
            const ul = document.querySelector('nav ul');
            ul.children[5].style.display = 'block';
            ul.children[6].style.display = 'block';
        }
    })
});