<?php

require "db/db_connection.php";

$tatuadores = get_tatuadores();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <link rel="stylesheet" href="./assets/css/contacto.css">
</head>
<body>
    <!--Cabecera-->
    <?php require "header.php"; ?>

    <main>
        <!--Formulario de Contacto-->
        <section>
            <div class="container">
                <div class="info">
                    <div>
                        <h3>Ink Legacy Tattoo Studio</h3>
                        <a href="https://maps.app.goo.gl/Qi53svSpk2oMX4r38">Calle de Pizarro, 3 28004, Madrid</a>
                        <br>
                        <a href="tel:+34654412700">654 41 27 00</a>
                        <br>
                        <a href="mailto:inklegacytattoo@gmail.com">inklegacytattoo@gmail.com</a>
                    </div>
    
                    <div>
                        <h3>Instrucciones</h3>
                        <p>Para pedir tu cita puedes pasar por el estudio o contactar con nosotros a través de este formulario.
                            <br><br>
                            Cuéntanos qué has pensado tatuarte, el estilo, la zona y el tamaño; también nos puedes indicar el tatuador que deseas. 
                            <br><br>
                            Así podremos ayudarte mejor con cualquier duda que tengas.
                        </p>
                    </div>
    
                    <div>
                        <h3>Horario</h3>
                        <p>LUNES A SÁBADO<br>11:30-14:00/16:00-20:00
                            <br><br>
                            FESTIVOS<br>11:00-14:00/16:00-19:00
                        </p>
                    </div>
                </div>
    
                <div class="form">
                    <form action="enviar_formulario.php" method="POST">
                        <input type="text" id="name" name="name" required>
                        <label for="name" class="placeholder">Nombre y apellidos *</label>
                        <br>
                        <input type="email" id="email" name="email" required>
                        <label for="email" class="placeholder">Correo electrónico *</label>
                        <br>
                        <input type="text" id="subject" name="subject" required>
                        <label for="subject" class="placeholder">Asunto *</label>
                        <br>
                        <label for="message">Mensaje *</label>
                        <textarea id="message" name="message" required></textarea>
                        <br>
                        <label for="artist">Artista</label>
                        <br>
                        <select name="artist" id="artist">
                        <?php
                            foreach ($tatuadores as $tatuador) {
                                echo "<option value='" . $tatuador['id'] . "'>" . $tatuador['nombre'] . "</option>";
                            }
                        ?>
                        </select>
                        <br><br>
                        <button type="submit">Enviar</button>
                        <?php
                            if (isset($_SESSION["mensaje"])) {
                                echo "<p style='margin-top: 20px; font-size: 1em'>" . $_SESSION["mensaje"] . "</p>";
                                unset($_SESSION["mensaje"]);
                            }
                        ?>
                    </form>
                </div>
            </div>
        </section>

        <!--Mapa Interactivo-->
        <section>
            <div class="mapa">
                <iframe title="Ubicación de Ink Legacy Tattoo Studio en Google Maps - Calle de Pizarro, 3, Madrid" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3037.3723420530146!2d-3.7063445!3d40.42275339999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd42286331f2caeb%3A0x3c08a4973a842c96!2sC.%20de%20Pizarro%2C%203%2C%20Centro%2C%2028004%20Madrid!5e0!3m2!1ses!2ses!4v1764420100742!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </section>
    </main>

    <!--Pie de página-->
    <?php require "footer.php"; ?>

    <script src="./assets/js/navBar.js"></script>
    <script src="./assets/js/form.js"></script>
</body>
</html>