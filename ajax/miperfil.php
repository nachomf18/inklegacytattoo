<?php

require "../db/db_connection.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["opcion"])) {
    $opcion = $_GET["opcion"];
    if (isset($_SESSION["usuario"])) {
        $id = $_SESSION["usuario"]["id"];
    } else {
        echo json_encode(["error" => "Usuario no autenticado"]);
        exit;
    }

    if ($opcion === "obtener_tatuador") {
        $tatuador = get_tatuador_by_id($id);
        echo json_encode($tatuador);
    } elseif ($opcion === "obtener_tatuajes") {
        $tatuajes = get_tatuajes($id);
        echo json_encode($tatuajes);
    } elseif ($opcion === "obtener_mensajes") {
        $mensajes = get_mensajes($id);
        echo json_encode($mensajes);
    }
}