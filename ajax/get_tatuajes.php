<?php

require "../db/db_connection.php";

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $id = $_GET["id"];
    
    $tatuadores = get_tatuajes($id);
    if ($tatuadores) {
        echo json_encode($tatuadores);
    } else {
        echo json_encode([]);
    }
}

?>