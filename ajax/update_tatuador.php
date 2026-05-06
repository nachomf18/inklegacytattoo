<?php

require __DIR__ . "/../db/db_connection.php";

header("Content-Type: application/json; charset=utf-8");

$email = $_POST["email"] ?? null;
$nombre = $_POST["nombre"] ?? null;
$descripcion = $_POST["descripcion"] ?? null;
$estilo = $_POST["estilo"] ?? null;
$instagram = $_POST["instagram"] ?? null;
$imagen = $_POST["imagen"] ?? null;
$id = $_POST["id"] ?? null;

if (!$email || !$nombre || !$descripcion || !$estilo || !$instagram || !$imagen || !$id) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Faltan datos para actualizar el tatuador."], JSON_UNESCAPED_UNICODE);
    exit();
}

$success = update_tatuador($email, $nombre, $descripcion, $estilo, $instagram, $imagen, $id);

echo json_encode(["success" => $success], JSON_UNESCAPED_UNICODE);
