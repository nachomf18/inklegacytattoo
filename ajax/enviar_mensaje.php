<?php

require "../db/db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["name"];
    $email = $_POST["email"];
    $asunto = $_POST["subject"];
    $mensaje = $_POST["message"];
    $tatuador = $_POST["artist"];

    if (insert_mensaje($nombre, $email, $asunto, $mensaje, $tatuador)) {
        echo "¡Gracias por escribirnos! Nos pondremos en contacto contigo lo antes posible.";
    } else {
        echo "Hubo un error al enviar tu mensaje. Por favor, inténtalo de nuevo más tarde.";
    }
}

