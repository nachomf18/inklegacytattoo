<?php

require "db/db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $descripcion = $_POST["descripcion"];
    $instagram = $_POST["instagram"];

    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
        $dir = "assets/img/tatuadores/" . basename($_FILES["imagen"]["name"]);
        move_uploaded_file($_FILES["imagen"]["tmp_name"], $dir);
    } else {
        echo "Error al subir la imagen.";
        exit();
    }

    $query = $db->prepare("INSERT INTO tatuadores (email, clave, nombre, descripcion, instagram, imagen) VALUES (?, ?, ?, ?, ?, ?)");
    $query->execute(array($email, password_hash($password, PASSWORD_DEFAULT), $name, $descripcion, $instagram, $dir));

    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <h2>Registro</h2>
        <label for="name">Nombre completo:</label>
        <br>
        <input type="text" id="name" name="name">
        <br><br>
        <label for="email">Correo electrónico:</label>
        <br>
        <input type="email" id="email" name="email">
        <br><br>
        <label for="password">Contraseña:</label>
        <br>
        <input type="password" id="password" name="password">
        <br><br>
        <label for="descripcion">Descripción:</label>
        <br>
        <textarea name="descripcion" id="descripcion"></textarea>
        <br><br>
        <label for="instagram">Instagram:</label>
        <br>
        <input type="text" id="instagram" name="instagram">
        <br><br>
        <label for="imagen">Imagen:</label>
        <br>
        <input type="file" id="imagen" name="imagen">
        <br><br>
        <input type="submit" value="Registrarse">
    </form>
</body>
</html>