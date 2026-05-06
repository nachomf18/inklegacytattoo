document.addEventListener("DOMContentLoaded", async function() {
    await fetch("ajax/get_tatuadores.php").then(response => response.json())
    .then(tatuadores => {
        const select = document.getElementById("artist");
        tatuadores.forEach(tatuador => {
            const option = document.createElement("option");
            option.value = tatuador.id;
            option.textContent = tatuador.nombre;
            select.appendChild(option);
        });
    });

    const id = new URLSearchParams(window.location.search).get("id");
    if (id) document.querySelector("select").value = id;
    
    const form = document.querySelector("form");
    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const formData = new FormData(form);
        const response = await fetch("ajax/enviar_mensaje.php", {
            method: "POST",
            body: formData
        }).then(response => response.text())
        .then(data => {
            const mensaje = document.createElement("p");
            mensaje.style.marginTop = "20px";
            mensaje.style.fontSize = "1em";
            mensaje.textContent = data;
            form.appendChild(mensaje);
        });
    });
});