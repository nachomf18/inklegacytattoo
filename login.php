<?php

require "db/db_connection.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $query = get_tatuador_by_email($email);
    $tatuador = $query;

    if ($tatuador && password_verify($password, $tatuador["clave"])) {
        $_SESSION["user_id"] = $tatuador["id"];
        header("Location: index.php");
        exit();
    } else {
        
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <form action="" method="post">
        <h2>INICIAR SESIÓN</h2>
        <br>
        <input type="text" id="email" name="email" required>
        <label for="email" class="placeholder">Correo electrónico</label>
        <br>
        <input type="password" id="password" name="password" required>
        <label for="password" class="placeholder">Contraseña</label>
        <br>
        <button type="submit" value="Iniciar Sesión">Iniciar Sesión</button>
    </form>
</body>
</html>