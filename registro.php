<?php

require "db/db_connection.php";
require "db/comprobar_sesion.php";

if ($_SESSION["user_id"] != 1) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $estilo = $_POST["estilo"];
    $instagram = $_POST["instagram"];

    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
        $dir = "assets/img/tatuadores/" . basename($_FILES["imagen"]["name"]);
        move_uploaded_file($_FILES["imagen"]["tmp_name"], $dir);
    } else {
        echo "Error al subir la imagen.";
        exit();
    }

    $query = get_tatuador_by_email($email);

    if ($query) {
        echo "El correo electrónico introducido ya está registrado.";
    } else {
        $query = insert_tatuador($email, password_hash($password, PASSWORD_DEFAULT), $nombre, $descripcion, $estilo, $instagram, $dir);

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
    <link rel="stylesheet" href="assets/css/registro.css">
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <h2>REGISTRAR TATUADOR</h2>
        <input type="text" id="nombre" name="nombre" required>
        <label for="nombre" class="placeholder">Nombre completo *</label>
        <br>
        <input type="text" id="email" name="email" required>
        <label for="email" class="placeholder">Correo electrónico *</label>
        <br>
        <input type="password" id="password" name="password" required>
        <label for="password" class="placeholder">Contraseña *</label>
        <br>
        <label for="descripcion">Descripción *</label>
        <textarea name="descripcion" id="descripcion" required></textarea>
        <br>
        <input type="text" id="estilo" name="estilo" required>
        <label for="estilo" class="placeholder">Estilo *</label>
        <br>
        <input type="text" id="instagram" name="instagram" required>
        <label for="instagram" class="placeholder">Instagram *</label>
        <br>
        <label for="imagen">Imagen *</label>
        <input type="file" id="imagen" name="imagen" accept="image/*" required>
        <br>
        <button type="submit">Registrar</button>
    </form>
</body>
</html>