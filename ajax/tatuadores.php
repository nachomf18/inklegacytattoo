<?php

require "../db/db_connection.php";

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];
    $tatuador = get_tatuador_by_id($id);
    if ($tatuador) {
        echo json_encode($tatuador);
    } else {
        echo json_encode([]);
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["email"])) {
    $email = $_GET["email"];
    $tatuador = get_tatuador_by_email($email);
    if ($tatuador) {
        echo json_encode($tatuador);
    } else {
        echo json_encode([]);
    }
} else {
    $tatuadores = get_tatuadores();
    
    if ($tatuadores) {
        echo json_encode($tatuadores);
    } else {
        echo json_encode([]);
    }
}

?>