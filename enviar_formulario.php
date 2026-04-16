<?php

require "db/db_connection.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $asunto = $_POST["subject"];
    $mensaje = $_POST["message"];
    $tatuador = $_POST["artist"];

    if(insert_mensaje($name, $email, $asunto, $mensaje, $tatuador)) {
        $_SESSION["mensaje"] = "Tu mensaje ha sido enviado correctamente. Nos pondremos en contacto contigo lo antes posible.";
    } else {
        $_SESSION["mensaje"] = "Ha ocurrido un error al enviar tu mensaje. Por favor, inténtalo de nuevo más tarde.";
    }

    header("Location: contacto.php");
    exit();
} else {
    header("Location: contacto.php");
    exit();
}

?>