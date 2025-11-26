const nombre = new URLSearchParams(window.location.search).get("artista");

if (nombre) {
    document.querySelector("select").value = nombre;
}

form = document.querySelector("form");
form.addEventListener("submit", (e) => {
    const p = document.createElement("p");
    p.textContent = "¡Gracias por contactarnos! Nos pondremos en contacto contigo pronto.";
    p.style.marginTop = "20px";
    p.style.fontSize = "1em";

    form.appendChild(p);
    form.reset();
});
