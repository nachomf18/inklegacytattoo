<?php

require __DIR__ . "/../db/db_connection.php";

header("Content-Type: application/json; charset=utf-8");

$clave = $_POST["clave"] ?? null;
$id = $_POST["id"] ?? null;

if (!$clave || !$id) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Faltan datos para actualizar la contraseña."], JSON_UNESCAPED_UNICODE);
    exit();
}

$success = update_clave(password_hash($clave, PASSWORD_DEFAULT), $id);

echo json_encode(["success" => $success], JSON_UNESCAPED_UNICODE);
