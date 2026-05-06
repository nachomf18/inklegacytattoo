document.addEventListener("DOMContentLoaded", function() {
    // Manejar envío del formulario de inicio de sesión
    const form = document.querySelector("form");
    form.addEventListener("submit", async function(e) {
        e.preventDefault();
    
        const formData = new FormData(form);
    
        await fetch("ajax/login.php", {
            method: "POST",
            body: formData
        }).then(response => response.text())
        .then(mensaje => {
            if (mensaje === "TRUE") {
                window.location.href = "index.html";
            } else {
                const p = document.getElementById("error");
                p.style.color = "red";
                p.textContent = "Correo electrónico o contraseña incorrectos";
            }
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
