<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "inklegacy";

try {
    $db = new PDO("mysql:host=$host;dbname=$database", $username, $password);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

function get_tatuador_by_email($email) {
    global $db;
    $query = $db->prepare("SELECT * FROM tatuadores WHERE email = ?");
    $query->execute(array($email));
    return $query->fetch();
}

function get_tatuador_by_id($id) {
    global $db;
    $query = $db->prepare("SELECT * FROM tatuadores WHERE id = ?");
    $query->execute(array($id));
    return $query->fetch();
}

function insert_tatuador($email, $clave, $nombre, $descripcion, $instagram, $imagen) {
    global $db;
    $query = $db->prepare("INSERT INTO tatuadores (email, clave, nombre, descripcion, instagram, imagen) VALUES (?, ?, ?, ?, ?, ?)");
    return $query->execute(array($email, $clave, $nombre, $descripcion, $instagram, $imagen));
}

function update_tatuador($email, $clave, $nombre, $descripcion, $instagram, $imagen, $id) {
    global $db;
    $query = $db->prepare("UPDATE tatuadores SET email = ?, clave = ?, nombre = ?, descripcion = ?, instagram = ?, imagen = ? WHERE id = ?");
    return $query->execute(array($email, $clave, $nombre, $descripcion, $instagram, $imagen, $id));
}

function insert_tatuaje($ruta, $id_tatuador) {
    global $db;
    $query = $db->prepare("INSERT INTO tatuajes (ruta, id_tatuador) VALUES (?, ?)");
    return $query->execute(array($ruta, $id_tatuador));
}

function get_tatuajes($id_tatuador) {
    global $db;
    $query = $db->prepare("SELECT * FROM tatuajes WHERE id_tatuador = ?");
    $query->execute(array($id_tatuador));
    return $query->fetchAll();
}

function delete_tatuaje($id) {
    global $db;
    $query = $db->prepare("DELETE FROM tatuajes WHERE id = ?");
    return $query->execute(array($id));
}