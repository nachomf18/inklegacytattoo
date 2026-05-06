<?php

require __DIR__ . "/../db/db_connection.php";

header("Content-Type: application/json; charset=utf-8");

$id = $_GET["id"] ?? $_POST["id"] ?? null;

if (!$id) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Falta el id."], JSON_UNESCAPED_UNICODE);
    exit();
}

echo json_encode(get_tatuador_by_id($id), JSON_UNESCAPED_UNICODE);
