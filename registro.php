<?php

require "db/db_connection.php";
require "db/comprobar_sesion.php";

// Comenta estas líneas para crear el primer usuario, que sería el "administrador".
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
        if (!move_uploaded_file($_FILES["imagen"]["tmp_name"], $dir)) {
            $error = "Error al guardar la imagen.";
        } else {
            $query = get_tatuador_by_email($email);

            if ($query) {
                $error = "El correo electrónico introducido ya está registrado.";
            } else {
                $query = insert_tatuador($email, password_hash($password, PASSWORD_DEFAULT), $nombre, $descripcion, $estilo, $instagram, $dir);
                if ($query) {
                    header("Location: login.php");
                    exit();
                } else {
                    $error = "Error al registrar el tatuador.";
                }
            }
        }
    } else {
        $error = "Error al subir la imagen.";
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
        <?php if (isset($error)) { ?>
            <p style="color: red;"><?= $error ?></p>
        <?php } ?>
        <input type="text" id="nombre" name="nombre" value="<?= isset($_POST["nombre"]) ? $_POST["nombre"] : "" ?>" required>
        <label for="nombre" class="placeholder">Nombre completo *</label>
        <br>
        <input type="email" id="email" name="email" value="<?= isset($_POST["email"]) ? $_POST["email"] : "" ?>" required>
        <label for="email" class="placeholder">Correo electrónico *</label>
        <br>
        <input type="password" id="password" name="password" value="<?= isset($_POST["password"]) ? $_POST["password"] : "" ?>" required>
        <label for="password" class="placeholder">Contraseña *</label>
        <br>
        <label for="descripcion">Descripción *</label>
        <textarea name="descripcion" id="descripcion" required><?= isset($_POST["descripcion"]) ? $_POST["descripcion"] : "" ?></textarea>
        <br>
        <input type="text" id="estilo" name="estilo" value="<?= isset($_POST["estilo"]) ? $_POST["estilo"] : "" ?>" required>
        <label for="estilo" class="placeholder">Estilo *</label>
        <br>
        <input type="text" id="instagram" name="instagram" value="<?= isset($_POST["instagram"]) ? $_POST["instagram"] : "" ?>" required>
        <label for="instagram" class="placeholder">Instagram *</label>
        <br>
        <label for="imagen">Imagen *</label>
        <input type="file" id="imagen" name="imagen" accept="image/*" required>
        <br>
        <button type="submit">Registrar</button>
    </form>

    <script src="assets/js/form.js"></script>
</body>
</html>