<?php

require "DB/db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $tatuador_id = $_GET['id'];
    $tatuador = get_tatuador_by_id($tatuador_id);
    $tatuajes = get_tatuajes($tatuador_id);

    if (!$tatuador) {
        header("Location: artistas.php");
        exit();
    }
} else {
    header("Location: artistas.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artista</title>
    <link rel="stylesheet" href="./assets/css/perfilartista.css">
</head>
<body>
    <!--Cabecera-->
    <?php require "header.php"; ?>

    <main>
        <!--Sección Datos Artista-->
        <section>
            <div class="imagen-artista" style="background-image: url(<?= $tatuador["imagen"] ?>);"></div>

            <div class="contenido">
                <h1><?= $tatuador['nombre'] ?></h1>
                <h2><?= $tatuador['instagram'] ?></h2>
                <p><?= $tatuador['descripcion'] ?></p>
                <button onclick="window.location.href = 'contacto.php?id=<?= $tatuador['id'] ?>'">Reserva cita con <?= $tatuador['nombre'] ?></button>  
            </div>
            
            <div class="galeria-tatuajes">
                <?php foreach ($tatuajes as $tatuaje) { ?>
                    <img src="<?= $tatuaje["ruta"] ?>" alt="Tatuaje de <?= $tatuador['nombre'] ?>" class="tatuajes">
                <?php } ?>
            </div>

            <button id="backButton" onclick="window.history.back()">&#8617; ATRÁS</button>
        </section>

        <!--Sección Tatuajes Artista-->
    </main>

    <!--Pie de página-->
    <?php require "footer.php"; ?>

    <script src="./assets/js/navBar.js"></script>
</body>
</html>