<?php

$env_file = __DIR__ . '/../.env';
if (file_exists($env_file)) {
    $env_vars = parse_ini_file($env_file);
    foreach ($env_vars as $key => $value) {
        $_ENV[$key] = $value;
    }
}

$host = $_ENV['DB_HOST'];
$username = $_ENV['DB_USER'];
$password = $_ENV['DB_PASSWORD'];
$database = $_ENV['DB_NAME'];
$port = $_ENV['DB_PORT'];

try {
    $db = new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

function get_tatuadores() {
    global $db;
    $query = $db->prepare("SELECT * FROM tatuadores");
    $query->execute();
    return $query->fetchAll();
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

function insert_tatuador($email, $clave, $nombre, $descripcion, $estilo, $instagram, $imagen) {
    global $db;
    $query = $db->prepare("INSERT INTO tatuadores (email, clave, nombre, descripcion, estilo, instagram, imagen) VALUES (?, ?, ?, ?, ?, ?, ?)");
    return $query->execute(array($email, $clave, $nombre, $descripcion, $estilo, $instagram, $imagen));
}

function update_tatuador($id, $nombre, $descripcion, $estilo, $instagram, $imagen) {
    global $db;
    $query = $db->prepare("UPDATE tatuadores SET nombre = ?, descripcion = ?, estilo = ?, instagram = ?, imagen = ? WHERE id = ?");
    return $query->execute(array($nombre, $descripcion, $estilo, $instagram, $imagen, $id));
}

function update_clave($clave, $id) {
    global $db;
    $query = $db->prepare("UPDATE tatuadores SET clave = ? WHERE id = ?");
    return $query->execute(array($clave, $id));
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

function get_tatuaje($id) {
    global $db;
    $query = $db->prepare("SELECT * FROM tatuajes WHERE id = ?");
    $query->execute(array($id));
    return $query->fetch();
}

function delete_tatuaje($id) {
    global $db;
    $query = $db->prepare("DELETE FROM tatuajes WHERE id = ?");
    return $query->execute(array($id));
}

function insert_mensaje($nombre, $email, $asunto, $mensaje, $tatuador) {
    global $db;
    $query = $db->prepare("INSERT INTO mensajes (nombre, email, asunto, mensaje, id_tatuador) VALUES (?, ?, ?, ?, ?)");
    return $query->execute(array($nombre, $email, $asunto, $mensaje, $tatuador));
}

function get_mensajes($id_tatuador) {
    global $db;
    $query = $db->prepare("SELECT * FROM mensajes WHERE id_tatuador = ?");
    $query->execute(array($id_tatuador));
    return $query->fetchAll();
}

function delete_mensaje($id) {
    global $db;
    $query = $db->prepare("DELETE FROM mensajes WHERE id = ?");
    return $query->execute(array($id));
}