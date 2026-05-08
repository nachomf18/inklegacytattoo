<?php

require "../db/db_connection.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"]) && isset($_SESSION["id_tatuador"])) {
    $id = $_GET["id"];
    if(delete_mensaje($id)) {
        echo "TRUE";
    } else {
        echo "FALSE";
    }
}

?>