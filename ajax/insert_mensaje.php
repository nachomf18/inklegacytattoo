<?php

require __DIR__ . "/../db/db_connection.php";

header("Content-Type: application/json; charset=utf-8");

$name = $_POST["name"] ?? null;
$email = $_POST["email"] ?? null;
$asunto = $_POST["asunto"] ?? $_POST["subject"] ?? null;
$mensaje = $_POST["mensaje"] ?? $_POST["message"] ?? null;
$tatuador = $_POST["tatuador"] ?? $_POST["artist"] ?? null;

if (!$name || !$email || !$asunto || !$mensaje || !$tatuador) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Faltan datos para crear el mensaje."], JSON_UNESCAPED_UNICODE);
    exit();
}

$success = insert_mensaje($name, $email, $asunto, $mensaje, $tatuador);

echo json_encode(["success" => $success], JSON_UNESCAPED_UNICODE);
