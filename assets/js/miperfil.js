document.addEventListener("DOMContentLoaded", async function() {
    var tatuador = await getTatuador();
    var tatuajes = await getTatuajes();
    var mensajes = await getMensajes();
    var numTatuajes = tatuajes.length;

    mostrarTatuador(tatuador);
    mostrarTatuajes(tatuajes);
    mostrarMensajes(mensajes);
    
    document.getElementById("form-perfil").addEventListener("submit", async function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        await fetch("ajax/miperfil.php?opcion=actualizar_perfil", {
            method: "POST",
            body: formData
        }).then(response => response.text())
        .then(async mensaje => {
            const p = document.getElementById("mensaje-perfil");
            p.innerHTML = "";
            if (mensaje == "TRUE") {
                this.reset();
                p.innerText = "Perfil actualizado correctamente.";
                p.style.marginBottom = "40px";
                tatuador = await getTatuador();
                mostrarTatuador(tatuador);
            } else {
                p.innerText = "Error al actualizar el perfil.";
                p.style.color = "var(--blood-red)";
                p.style.marginBottom = "40px";
            }
        });
    });

    document.getElementById("form-clave").addEventListener("submit", async function(e) {
        e.preventDefault();

        if (this.password.value !== this.confirmar_password.value) {
            const p = document.getElementById("mensaje-clave");
            p.innerText = "Las contraseñas no coinciden.";
            p.style.color = "var(--blood-red)";
            p.style.marginBottom = "40px";
            return;
        }

        const formData = new FormData(this);
        await fetch("ajax/miperfil.php?opcion=actualizar_clave", {
            method: "POST",
            body: formData
        }).then(response => response.text())
        .then(mensaje => {
            const p = document.getElementById("mensaje-clave");
            p.innerHTML = "";
            if (mensaje == "TRUE") {
                p.innerText = "Contraseña actualizada correctamente.";
                p.style.marginBottom = "40px";
            } else {
                p.innerText = "Error al actualizar la contraseña.";
                p.style.color = "var(--blood-red)";
                p.style.marginBottom = "40px";
            }
        });
    });

    document.getElementById("form-tatuajes").addEventListener("submit", async function(e) {
        e.preventDefault();

        if (this.tatuajes.files.length == 0) {
            const p = document.getElementById("mensaje-tatuajes");
            p.innerText = "Por favor, selecciona al menos un tatuaje para subir.";
            p.style.color = "var(--blood-red)";
            return;
        } else if (this.tatuajes.files.length + numTatuajes > 9) {
            const p = document.getElementById("mensaje-tatuajes");
            p.innerText = "No puedes subir más de 9 tatuajes.";
            p.style.color = "var(--blood-red)";
            return;
        }

        const formData = new FormData(this);
        await fetch("ajax/miperfil.php?opcion=subir_tatuajes", {
            method: "POST",
            body: formData
        }).then(response => response.json())
        .then(async data => {
            const div = document.getElementById("mensaje-tatuajes");
            div.innerHTML = "";
            if (data.success) {
                tatuajes = await getTatuajes();
                mostrarTatuajes(tatuajes);
                numTatuajes = tatuajes.length;
            } else {
                data.errors.forEach(error => {
                    let errorP = document.createElement("p");
                    errorP.innerText = error;
                    errorP.style.color = "var(--blood-red)";
                    div.appendChild(errorP);
                });
            }
        });
    });

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

    function mostrarMensajes(mensajes) {
        const container = document.getElementById("mensajes");
        container.innerHTML = "<h2>MENSAJES</h2>";

        if (mensajes.length == 0) {
            let parrafo = document.createElement("p");
            parrafo.innerText = "No tienes mensajes.";
            container.appendChild(parrafo);
            return;
        }

        const table = document.createElement("table");
        let tr = document.createElement("tr");

        let nombre = document.createElement("th");
        let email = document.createElement("th");
        let asunto = document.createElement("th");
        let mensaje = document.createElement("th");
        let eliminar = document.createElement("th");
        nombre.innerText = "NOMBRE";
        email.innerText = "CORREO ELECTRÓNICO";
        asunto.innerText = "ASUNTO";
        mensaje.innerText = "MENSAJE";
        eliminar.innerText = "ELIMINAR";

        tr.appendChild(nombre);
        tr.appendChild(email);
        tr.appendChild(asunto);
        tr.appendChild(mensaje);
        tr.appendChild(eliminar);
        table.appendChild(tr);

        mensajes.forEach(mensaje => {
            tr = document.createElement("tr");

            nombre = document.createElement("td");
            email = document.createElement("td");
            asunto = document.createElement("td");
            mensaje = document.createElement("td");
            eliminar = document.createElement("td");
            nombre.innerText = mensaje.nombre;
            email.innerText = mensaje.email;
            asunto.innerText = mensaje.asunto;
            mensaje.innerText = mensaje.mensaje;
            let btnEliminar = document.createElement("button");
            btnEliminar.innerText = "ELIMINAR";
            btnEliminar.addEventListener("click", function() {
                eliminarMensaje(mensaje.id);
            });
            eliminar.appendChild(btnEliminar);

            tr.appendChild(nombre);
            tr.appendChild(email);
            tr.appendChild(asunto);
            tr.appendChild(mensaje);
            tr.appendChild(eliminar);
            table.appendChild(tr);
        });

        document.getElementById("mensajes").appendChild(table);
    }
});