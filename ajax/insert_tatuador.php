<?php

require __DIR__ . "/../db/db_connection.php";

header("Content-Type: application/json; charset=utf-8");

$email = $_POST["email"] ?? null;
$clave = $_POST["clave"] ?? null;
$nombre = $_POST["nombre"] ?? null;
$descripcion = $_POST["descripcion"] ?? null;
$estilo = $_POST["estilo"] ?? null;
$instagram = $_POST["instagram"] ?? null;
$imagen = $_POST["imagen"] ?? null;

if (!$email || !$clave || !$nombre || !$descripcion || !$estilo || !$instagram || !$imagen) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Faltan datos para crear el tatuador."], JSON_UNESCAPED_UNICODE);
    exit();
}

$success = insert_tatuador($email, password_hash($clave, PASSWORD_DEFAULT), $nombre, $descripcion, $estilo, $instagram, $imagen);

echo json_encode(["success" => $success], JSON_UNESCAPED_UNICODE);
