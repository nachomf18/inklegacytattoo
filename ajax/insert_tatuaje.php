<?php

require __DIR__ . "/../db/db_connection.php";

header("Content-Type: application/json; charset=utf-8");

$ruta = $_POST["ruta"] ?? null;
$id_tatuador = $_POST["id_tatuador"] ?? null;

if (!$ruta || !$id_tatuador) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Faltan datos para crear el tatuaje."], JSON_UNESCAPED_UNICODE);
    exit();
}

$success = insert_tatuaje($ruta, $id_tatuador);

echo json_encode(["success" => $success], JSON_UNESCAPED_UNICODE);
