const contenedorImg = document.querySelector('.carrusel-images');
const listaImg = Array.from(contenedorImg.querySelectorAll('a'));
const btnIzq = document.getElementById('left');
const btnDer = document.getElementById('right');

let index = 0;

function update() {
    let visibleImages;
    if (window.innerWidth > 1024) {
        visibleImages = 3;
    } else if (window.innerWidth > 767) {
        visibleImages = 2;
    } else {
        visibleImages = 1;
    }

    const maxIndex = listaImg.length - visibleImages;

    const mover = -(index * (100 / visibleImages));
    contenedorImg.style.transform = `translateX(${mover}%)`;

    btnIzq.disabled = (index == 0);
    btnDer.disabled = (index == maxIndex);
}

btnIzq.addEventListener('click', () => {
    index -= 1;
    update();
});

btnDer.addEventListener('click', () => {
    index += 1;
    update();
});

window.addEventListener('resize', () => {
    index = 0;
    update();
});

update();