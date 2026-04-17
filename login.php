<?php

require "db/db_connection.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $tatuador = get_tatuador_by_email($email);

    if ($tatuador && password_verify($password, $tatuador["clave"])) {
        $_SESSION["user_id"] = $tatuador["id"];
        header("Location: index.php");
        exit();
    } else {
        $error = "Correo electrónico o contraseña incorrectos";
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
        <?php if (isset($error)) {
            echo "<p style='color: red;'>$error</p>";
        }
        ?>
        <input type="email" id="email" name="email" value="<?= isset($_POST["email"]) ? $_POST["email"] : "" ?>" required>
        <label for="email" class="placeholder">Correo electrónico</label>
        <br>
        <input type="password" id="password" name="password" value="<?= isset($_POST["password"]) ? $_POST["password"] : "" ?>" required>
        <label for="password" class="placeholder">Contraseña</label>
        <br>
        <button type="submit" value="Iniciar Sesión">Iniciar Sesión</button>
    </form>

    <script src="assets/js/form.js"></script>
</body>
</html>