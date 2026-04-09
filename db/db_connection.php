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

?>