<?php

require "../db/db_connection.php";

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $id_tatuador = $_POST["id_tatuador"];
    $query = $db->prepare("SELECT * FROM mensajes WHERE id_tatuador = ?");
    $query->execute(array($id_tatuador));
    $mensajes = $query->fetchAll();
    echo json_encode($mensajes);
} else {
    echo json_encode([]);
}

?>