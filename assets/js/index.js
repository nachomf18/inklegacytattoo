document.addEventListener("DOMContentLoaded", function() {
    // Cargar tatuadores en la página principal
    fetch("ajax/tatuadores.php")
    .then(response => response.json())
    .then(tatuadores => {
        tatuadores.forEach(tatuador => {
            let div = document.createElement("div");
            div.classList.add("artist");

            let link = document.createElement("a");
            link.href = "perfilartista.php?id=" + tatuador.id;

            let img = document.createElement("img");
            img.src = tatuador.imagen;
            img.alt = "Retrato de " + tatuador.nombre + ", tatuador especialista en " + tatuador.estilo;
            link.appendChild(img);

            let textDiv = document.createElement("div");
            textDiv.classList.add("text");
            textDiv.innerHTML = tatuador.nombre.toUpperCase() + "<br><h4>" + tatuador.estilo.toUpperCase() + "</h4>";
            
            div.appendChild(link);
            div.appendChild(textDiv);
            document.getElementById("artist_images").appendChild(div);
        });
    });
});