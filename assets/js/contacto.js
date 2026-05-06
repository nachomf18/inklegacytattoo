document.addEventListener("DOMContentLoaded", async function() {
    // Cargar tatuadores en el select
    await fetch("ajax/tatuadores.php").then(response => response.json())
    .then(tatuadores => {
        const select = document.getElementById("artist");
        tatuadores.forEach(tatuador => {
            const option = document.createElement("option");
            option.value = tatuador.id;
            option.textContent = tatuador.nombre;
            select.appendChild(option);
        });
    });

    // Si se accede desde el perfil de un artista, preseleccionar su opción en el select
    const id = new URLSearchParams(window.location.search).get("id");
    if (id) document.querySelector("select").value = id;
    
    // Manejar envío del formulario
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

    // Validar email
    function validarEmail(email) {
        const emailInput = document.getElementById("email");
        emailInput.addEventListener("input", () =>  {
            const placeholder = emailInput.nextElementSibling;
            if (emailInput.value !== "") {
                placeholder.style.transform = "translateY(-70px)";
                placeholder.style.color = "var(--old-gold)";
                placeholder.style.fontSize = "16px";
                placeholder.style.transition = "all 0.3s ease-in-out";
            } else {
                placeholder.style.transform = "translateY(-45px)";
                placeholder.style.fontSize = "18px";
                placeholder.style.color = "rgba(13, 13, 13, 0.5)";
                placeholder.style.transition = "all 0.3s ease-in-out";
            }
        });
    }
});