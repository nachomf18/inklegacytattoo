<?php

require "DB/db_connection.php";

$tatuadores = get_tatuadores();

?>

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
                    <?php 
                    foreach ($tatuadores as $tatuador) { 
                        $tatuajes = get_tatuajes($tatuador['id']);
                        if (count($tatuajes) > 0) {
                    ?>
                        <a href="perfilartista.php?id=<?= $tatuador['id'] ?>"><img src="<?= $tatuajes[0]['ruta'] ?>" alt="Tatuaje de <?= $tatuador['nombre'] ?>"></a>
                    <?php 
                        } 
                    }
                    ?>
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