<?php

require "../db/db_connection.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION["id_tatuador"]) && $_SESSION["id_tatuador"] == 1) {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    
    if (get_tatuador_by_email($email)) {
        echo json_encode(["success" => false, "error" => "El correo electrónico ya está registrado"]);
        exit;
    }

    $password = $_POST["password"];
    $descripcion = $_POST["descripcion"];
    $estilo = $_POST["estilo"];
    $instagram = $_POST["instagram"];
    $imagen = $_FILES["imagen"];
    $extension = pathinfo($imagen["name"], PATHINFO_EXTENSION);
    $nombre_unico = uniqid() . '.' . $extension;
    $ruta = "/assets/img/tatuadores/" . $nombre_unico;

    if (insert_tatuador($email, password_hash($password, PASSWORD_DEFAULT), $nombre, $descripcion, $estilo, $instagram, $ruta)) {
        move_uploaded_file($imagen["tmp_name"], "../" . $ruta);
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => "Error al registrar el tatuador"]);
    }
}