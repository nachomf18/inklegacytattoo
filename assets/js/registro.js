document.addEventListener('DOMContentLoaded', async function() {
    var sesion = await comprobarSesion();
    if (sesion != "1") {
        window.location.href = "login.html";
        return;
    }

    const form = document.querySelector('form');
    const pError = document.getElementById('error');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(form);

        await fetch('ajax/registro.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            pError.innerHTML = "";
            if (data.success) {
                pError.style.color = "var(--carbon-black)";
                pError.textContent = "Tatuador registrado exitosamente.";
                form.reset();
            } else {
                pError.style.color = "var(--blood-red)";
                pError.textContent = data.error;
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