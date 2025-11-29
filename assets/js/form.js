const nombre = new URLSearchParams(window.location.search).get("artista");

if (nombre) {
    document.querySelector("select").value = nombre;
}

form = document.querySelector("form");
form.addEventListener("submit", (e) => {
    e.preventDefault();
    
    const p = document.createElement("p");
    p.textContent = "¡Gracias por escribirnos! Nos pondremos en contacto contigo pronto.";
    p.style.marginTop = "20px";
    p.style.fontSize = "1em";

    form.reset();
    form.appendChild(p);
});

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