document.addEventListener("DOMContentLoaded", async function() {
    const contenedorImg = document.querySelector('.carrusel-images');
    const tatuadores = await fetch("ajax/get_tatuadores.php").then(response => response.json());

    await Promise.all(tatuadores.map(async tatuador => {
        const tatuajes = await getTatuajes(tatuador.id);
        if (tatuajes && tatuajes.length !== 0) {
            const link = document.createElement("a");
            link.href = "perfilartista.php?id=" + tatuador.id;

            const img = document.createElement("img");
            img.src = tatuajes[0].ruta;
            img.alt = "Tatuaje de " + tatuador.nombre;

            link.appendChild(img);
            contenedorImg.appendChild(link);
        }
    }));

    async function getTatuajes(id) {
        const tatuajes = await fetch("ajax/get_tatuajes.php?id=" + id).then(response => response.json());
        return tatuajes;
    }

    const listaImg = contenedorImg.querySelectorAll('a');
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

    document.addEventListener('keydown', (e) => {
        let visibleImages;
        if (window.innerWidth > 1024) {
            visibleImages = 3;
        } else if (window.innerWidth > 767) {
            visibleImages = 2;
        } else {
            visibleImages = 1;
        }
        const maxIndex = listaImg.length - visibleImages;

        if (e.key === 'ArrowLeft' && index > 0) {
            index -= 1;
            update();
        } else if (e.key === 'ArrowRight' && index < maxIndex) {
            index += 1;
            update();
        }
    });

    window.addEventListener('resize', () => {
        index = 0;
        update();
    });

    update();
});