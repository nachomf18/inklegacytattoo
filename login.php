<?php

require "db/db_connection.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = $db->prepare("SELECT * FROM tatuadores WHERE email = ?");
    $query->execute(array($email));
    $tatuador = $query->fetch();

    if ($tatuador && password_verify($password, $tatuador["clave"])) {
        $_SESSION["user_id"] = $tatuador["id"];
        header("Location: index.php");
        exit();
    } else {
        echo "Usuario o contraseña incorrectos.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
</head>
<body>
    <form action="" method="post">
        <h2>Iniciar Sesión</h2>
        <label for="email">Correo electrónico:</label>
        <br>
        <input type="email" id="email" name="email">
        <br><br>
        <label for="password">Contraseña:</label>
        <br>
        <input type="password" id="password" name="password">
        <br><br>
        <input type="submit" value="Iniciar Sesión">
    </form>
</body>
</html>