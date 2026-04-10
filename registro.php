<?php

require "db/db_connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $instagram = $_POST["instagram"];

    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
        $dir = "assets/img/tatuadores/" . basename($_FILES["imagen"]["name"]);
        move_uploaded_file($_FILES["imagen"]["tmp_name"], $dir);
    } else {
        echo "Error al subir la imagen.";
        exit();
    }

    $query = get_tatuador($email);

    if ($query) {
        echo "El correo electrónico introducido ya está registrado.";
    } else {
        $query = insert_tatuador($email, password_hash($password, PASSWORD_DEFAULT), $nombre, $descripcion, $instagram, $dir);

        if ($query) {
            header("Location: login.php");
            exit();
        } else {
            echo "Error al registrar. Inténtalo de nuevo.";
        }
    }
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
        <label for="nombre">Nombre completo:</label>
        <br>
        <input type="text" id="nombre" name="nombre">
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