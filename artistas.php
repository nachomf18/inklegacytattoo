<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artistas</title>
    <link rel="stylesheet" href="./assets/css/artistas.css">
</head>
<body>
    <!--Cabecera-->
    <?php require "header.php"; ?>

    <main>
        <!--Carrusel-->
        <section>
            <div class="carrusel-container">
                <div class="carrusel-images">
                    <a href="perfilartista.php?id=1"><img src="./assets/img/tatuajes/diego_espalda.webp" alt="Tatuaje Blackwork de espalda completa realizado por Diego Navarro"></a>
                    <a href="perfilartista.php?id=4"><img src="./assets/img/tatuajes/marcos_krusty.webp" alt="Tatuaje estilo New School de personaje de Los Simpson realizado por Marcos Lira"></a>
                    <a href="perfilartista.php?id=6"><img src="./assets/img/tatuajes/ruben_cuervo.webp" alt="Tatuaje estilo Realismo de cuervo realizado por Rubén Gómez"></a>
                    <a href="perfilartista.php?id=2"><img src="./assets/img/tatuajes/claudia_dragon.webp" alt="Tatuaje estilo Japonés de dragón realizado por Claudia Reyes"></a>
                    <a href="perfilartista.php?id=5"><img src="./assets/img/tatuajes/martina_flor2.webp" alt="Tatuaje estilo Acuarela de flor realizado por Martina Sánchez"></a>
                    <a href="perfilartista.php?id=3"><img src="./assets/img/tatuajes/alvaro_chica.webp" alt="Tatuaje estilo Black and Grey de chica realizado por Álvaro Mendoza"></a>  
                </div>
                <button id="left" class="carrusel-btn">
                    <img src="./assets/img/left-arrow.svg" alt="Flecha izquierda para navegar en el carrusel">
                </button>
                <button id="right" class="carrusel-btn">
                    <img src="./assets/img/right-arrow.svg" alt="Flecha derecha para navegar en el carrusel">
                </button>
            </div>
        </section>
    </main>

    <!--Pie de página-->
    <?php require "footer.php"; ?>

    <script src="./assets/js/navBar.js"></script>
    <script src="./assets/js/carrusel.js"></script>
</body>
</html>