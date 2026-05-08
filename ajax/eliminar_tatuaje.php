<?php

require "../db/db_connection.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"]) && isset($_SESSION["id_tatuador"])) {
    $id = $_GET["id"];
    $tatuaje = get_tatuaje($id);
    if(delete_tatuaje($id)) {
        unlink("../" . $tatuaje["ruta"]);
        echo "TRUE";
    } else {
        echo "FALSE";
    }
}

?>