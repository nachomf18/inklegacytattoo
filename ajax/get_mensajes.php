<?php

require __DIR__ . "/../db/db_connection.php";

header("Content-Type: application/json; charset=utf-8");

$id_tatuador = $_GET["id_tatuador"] ?? $_POST["id_tatuador"] ?? null;

if (!$id_tatuador) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Falta el id del tatuador."], JSON_UNESCAPED_UNICODE);
    exit();
}

echo json_encode(get_mensajes($id_tatuador), JSON_UNESCAPED_UNICODE);
