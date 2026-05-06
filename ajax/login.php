<?php

require "../db/db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $tatuador = get_tatuador_by_email($email);

    if ($tatuador && password_verify($password, $tatuador["clave"])) {
        session_start();
        $_SESSION["usuario"] = $tatuador;
        echo "TRUE";
    } else {
        echo "FALSE";
    }
}

?>