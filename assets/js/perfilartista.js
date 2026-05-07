document.addEventListener("DOMContentLoaded", function() {
    // Obtener el ID del tatuador de la URL
    const id = new URLSearchParams(window.location.search).get('id');
    if (!id) {
        window.location.href = "artistas.html";
        return;
    }

    // Cargar información del tatuador
    fetch("ajax/tatuadores.php?id=" + id)
    .then(response => response.json())
    .then(tatuador => {
        if (tatuador) {
            const img = document.querySelector(".imagen-artista");
            img.style.backgroundImage = "url(" + tatuador.imagen + ")";

            const contenido = document.querySelector(".contenido");
            contenido.querySelector("h1").textContent = tatuador.nombre;
            contenido.querySelector("h2").textContent = tatuador.estilo;
            contenido.querySelector("p").innerText = tatuador.descripcion;
            contenido.querySelector("button").textContent = "Reservar cita con " + tatuador.nombre;
            contenido.querySelector("button").addEventListener("click", function() {
                window.location.href = "contacto.html?id=" + tatuador.id;
            });

            mostrarTatuajes(tatuador);
        } else {
            window.location.href = "artistas.html";
        }
    });

    // Función para mostrar los tatuajes del tatuador
    function mostrarTatuajes(tatuador) {
        fetch("ajax/tatuajes.php?id=" + tatuador.id)
        .then(response => response.json())
        .then(tatuajes => {
            const galeria = document.querySelector(".galeria-tatuajes");
            tatuajes.forEach(tatuaje => {
                const img = document.createElement("img");
                img.src = tatuaje.ruta;
                img.alt = "Tatuaje de " + tatuador.nombre;
                img.classList.add("tatuajes");
                galeria.appendChild(img);
            });
        });
    }

    // Botón para volver a la página de artistas
    document.getElementById("backButton").addEventListener("click", function() {
        window.location.href = "artistas.html";
    });
});