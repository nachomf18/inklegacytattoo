<?php

require __DIR__ . "/../db/db_connection.php";

header("Content-Type: application/json; charset=utf-8");

$id = $_POST["id"] ?? $_GET["id"] ?? null;

if (!$id) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Falta el id."], JSON_UNESCAPED_UNICODE);
    exit();
}

echo json_encode(["success" => delete_mensaje($id)], JSON_UNESCAPED_UNICODE);
