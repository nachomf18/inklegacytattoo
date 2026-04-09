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
            <div class="imagen-artista"></div>

            <div class="contenido">
                <h1>RUBÉN GÓMEZ</h1>
                <h2>@rubeng_tattoo</h2>
                <p>Rubén Gómez es el corazón y el alma de Ink Legacy. Con más de quince años de dedicación a la tinta, su nombre es sinónimo de maestría y versatilidad. Rubén ha perfeccionado su arte hasta dominar dos de los estilos más influyentes y técnicamente exigentes del tatuaje: el Old School y el Realismo.
                    <br><br>
                    Esta dualidad le permite moverse con una soltura excepcional entre la audacia de las líneas gruesas y los colores vibrantes del tatuaje tradicional y la precisión milimétrica y los matices sutiles del realismo fotográfico. Su profundo conocimiento de la historia del tatuaje le permite crear piezas de Old School auténticas y llenas de carácter, mientras que su técnica depurada da vida a retratos y escenas que parecen saltar de la piel.
                    <br><br>
                    Para Rubén, cada tatuaje es una colaboración y un compromiso con la excelencia. Su experiencia no solo garantiza una obra de arte impecable, sino también una guía experta para cada cliente que busca plasmar una idea duradera.
                    <br><br>
                    Ponerse en manos de Rubén es confiar en años de experiencia, una técnica impecable y una visión artística que transforma cualquier idea en una pieza de arte atemporal.
                </p>
                <button>Reserva cita con Rubén</button>  
            </div>
            
            <div class="galeria-tatuajes"></div>

            <button id="backButton" onclick="window.history.back()">&#8617; ATRÁS</button>
        </section>

        <!--Sección Tatuajes Artista-->
    </main>

    <!--Pie de página-->
    <?php require "footer.php"; ?>

    <script src="./assets/js/navBar.js"></script>
    <script src="./assets/js/perfilArtista.js"></script>
</body>
</html>