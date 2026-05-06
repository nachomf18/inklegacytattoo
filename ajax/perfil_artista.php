<?php

require "../db/db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET["id"];

    $tatuador = get_tatuador_by_id($id);

    if ($tatuador) {
        echo json_encode($tatuador);
    } else {
        echo json_encode([]);
    }
}

?>