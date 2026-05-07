document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form');
    const pError = document.getElementById('error');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(form);

        await fetch('ajax/registro.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(mensaje => {
            if (mensaje === "TRUE") {
                pError.style.color = "var(--old-gold)";
                pError.textContent = "Tatuador registrado exitosamente.";
                form.reset();
            } else {
                pError.style.color = "var(--blood-red)";
                pError.textContent = "Ha ocurrido un error al registrar el tatuador. Por favor, inténtalo de nuevo.";
            }
        });
    });

    // Validar email
    const emailInput = document.getElementById("email");
    if (emailInput) {
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