<?php

require "db/db_connection.php";
require "db/comprobar_sesion.php";

comprobar_sesion();

$tatuador = get_tatuador_by_id($_SESSION['user_id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"] == "" ? $tatuador["clave"] : password_hash($_POST["password"], PASSWORD_DEFAULT);
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $instagram = $_POST["instagram"];

    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
        $dir = "assets/img/tatuadores/" . basename($_FILES["imagen"]["name"]);
        move_uploaded_file($_FILES["imagen"]["tmp_name"], $dir);
    } else {
        $dir = $tatuador["imagen"];
    }

    $tatuador_existente = get_tatuador_by_email($email);

    if ($tatuador_existente && $tatuador_existente['id'] != $_SESSION['user_id']) {
        echo "El correo electrónico introducido ya está registrado.";
    } else {
        $query = update_tatuador($email, $password, $nombre, $descripcion, $instagram, $dir, $_SESSION['user_id']);

        if ($query) {
            echo "Perfil actualizado correctamente.";
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
    <title>Perfil</title>
</head>
<body>
    <?php require "header.php"; ?>

    <h1>Perfil del Tatuador</h1>    
    <form action="" method="post" enctype="multipart/form-data">
        <img src="<?= $tatuador["imagen"] ?>" alt="" width="100px" height="100px">
        <input type="file" name="imagen" id="imagen">
        <br><br>
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?= $tatuador['nombre'] ?>">
        <br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= $tatuador['email'] ?>">
        <br><br>
        <label for="instagram">Instagram:</label>
        <input type="text" id="instagram" name="instagram" value="<?= $tatuador['instagram'] ?>">
        <br><br>
        <label for="descripcion">Descripción:</label><br>
        <textarea id="descripcion" name="descripcion" rows="4" cols="50"><?= $tatuador['descripcion'] ?></textarea>
        <br><br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password">
        <br><br>
        <input type="submit" value="Actualizar Perfil">
    </form>
</body>
</html>