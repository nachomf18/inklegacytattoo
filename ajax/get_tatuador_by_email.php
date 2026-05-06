<?php

require __DIR__ . "/../db/db_connection.php";

header("Content-Type: application/json; charset=utf-8");

$email = $_GET["email"] ?? $_POST["email"] ?? null;

if (!$email) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Falta el email."], JSON_UNESCAPED_UNICODE);
    exit();
}

echo json_encode(get_tatuador_by_email($email), JSON_UNESCAPED_UNICODE);
