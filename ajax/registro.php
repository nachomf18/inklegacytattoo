<?php

require "../db/db_connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $descripcion = $_POST["descripcion"];
    $estilo = $_POST["estilo"];
    $instagram = $_POST["instagram"];
    $imagen = $_FILES["imagen"];

    if (insert_tatuador($email, password_hash($password, PASSWORD_DEFAULT), $nombre, $descripcion, $estilo, $instagram, $imagen["name"])) {
        move_uploaded_file($imagen["tmp_name"], "../assets/img/tatuadores/" . $imagen["name"]);
        echo "TRUE";
    } else {
        echo "FALSE";
    }
}