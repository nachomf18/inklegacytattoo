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
        .then(response => response.json())
        .then(mensaje => {
            if (mensaje === "TRUE") {
                window.location.href = 'login.html';
            } else {
                pError.textContent = "Ha ocurrido un error al registrar el tatuador. Por favor, inténtalo de nuevo.";
            }
        });
    });
});