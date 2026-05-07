document.addEventListener("DOMContentLoaded", async function() {
    const tatuador = await getTatuador();
    const tatuajes = await getTatuajes();
    const mensajes = await getMensajes();
    const numMensajes = mensajes.length;

    mostrarTatuador(tatuador);
    mostrarTatuajes(tatuajes);
    //mostrarMensajes(mensajes);
    
    async function getTatuador() {
        return await fetch("ajax/miperfil.php?opcion=obtener_tatuador").then(response => response.json());
    }

    async function getTatuajes() {
        return await fetch("ajax/miperfil.php?opcion=obtener_tatuajes").then(response => response.json());
    }

    async function getMensajes() {
        return await fetch("ajax/miperfil.php?opcion=obtener_mensajes").then(response => response.json());
    }

    function mostrarTatuador(tatuador) {
        document.getElementById("nombre").value = tatuador.nombre;
        document.getElementById("email").value = tatuador.email;
        document.getElementById("estilo").value = tatuador.estilo;
        document.getElementById("instagram").value = tatuador.instagram;
        document.getElementById("descripcion").value = tatuador.descripcion;
        document.querySelector(".foto img").src = tatuador.imagen;
        document.querySelector(".foto img").alt = tatuador.nombre;
    }

    function mostrarTatuajes(tatuajes) {
        const galeria = document.querySelector(".galeria");
        galeria.innerHTML = "";
        tatuajes.forEach(tatuaje => {
            const enlace = document.createElement("a");
            enlace.href = `eliminar_tatuaje.php?id=${tatuaje.id}`;
            const imagen = document.createElement("img");
            imagen.src = tatuaje.ruta;
            imagen.alt = "Tatuaje";
            imagen.width = 100;
            imagen.height = 100;
            enlace.appendChild(imagen);
            galeria.appendChild(enlace);
        });
    }
});