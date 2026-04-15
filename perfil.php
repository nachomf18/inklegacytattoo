<?php

require "db/db_connection.php";
require "db/comprobar_sesion.php";

$tatuador = get_tatuador_by_id($_SESSION['user_id']);
$tatuajes = get_tatuajes($_SESSION['user_id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["perfil"])) {
        $email = $_POST["email"];
        $password = $_POST["password"] == "" ? $tatuador["clave"] : password_hash($_POST["password"], PASSWORD_DEFAULT);
        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $estilo = $_POST["estilo"];
        $instagram = $_POST["instagram"];

        if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
            $dir = "assets/img/tatuadores/" . basename($_FILES["imagen"]["name"]);
            move_uploaded_file($_FILES["imagen"]["tmp_name"], $dir);
        } else {
            $dir = $tatuador["imagen"];
        }  
        
        $tatuador_existente = get_tatuador_by_email($email);

        if ($tatuador_existente && $tatuador_existente['id'] != $_SESSION['user_id']) {
            $error_perfil = "El email introducido ya está registrado.";
        } else {
            $query = update_tatuador($email, $password, $nombre, $descripcion, $estilo, $instagram, $dir, $_SESSION['user_id']);
            if ($query) {
                $tatuador = get_tatuador_by_id($_SESSION['user_id']);
            } else {
                $error_perfil = "Error al actualizar el perfil.";
            }
        }
    }

    if (isset($_FILES["tatuajes"])) {
        foreach ($_FILES["tatuajes"]["tmp_name"] as $index => $tmpName) {
            if ($_FILES["tatuajes"]["error"][$index] == 0) {
                $rutaTatuaje = "assets/img/tatuajes/" . basename($_FILES["tatuajes"]["name"][$index]);
                move_uploaded_file($tmpName, $rutaTatuaje);
                insert_tatuaje($rutaTatuaje, $_SESSION['user_id']);
            }
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
    <link rel="stylesheet" href="assets/css/perfil.css">
</head>
<body>
    <?php require "header.php"; ?>

    <main>
        <section>
            <h1>MI PERFIL</h1> 
            <div class="container">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="datos">
                        <div class="datos-personales">
                            <h2>DATOS PERSONALES</h2>
                            <input type="text" id="nombre" name="nombre" value="<?= $tatuador['nombre'] ?>">
                            <label for="nombre" class="placeholder">Nombre</label>
                            <br>
                            <input type="email" id="email" name="email" value="<?= $tatuador['email'] ?>">
                            <label for="email" class="placeholder">Email</label>
                            <br>
                            <input type="text" id="estilo" name="estilo" value="<?= $tatuador['estilo'] ?>">
                            <label for="estilo" class="placeholder">Estilo</label>
                            <br>
                            <input type="text" id="instagram" name="instagram" value="<?= $tatuador['instagram'] ?>">
                            <label for="instagram" class="placeholder">Instagram</label>
                            <br>
                            <label for="descripcion">Descripción</label><br>
                            <textarea id="descripcion" name="descripcion" rows="4" cols="50"><?= $tatuador['descripcion'] ?></textarea>
                            <br>
                            <button type="submit" name="perfil">Actualizar Perfil</button>
                            <?php if (isset($error_perfil)) { ?>
                                <p class="error"><?= $error_perfil ?></p>
                            <?php } else { ?>
                                <p>Perfil actualizado correctamente.</p>
                            <?php } ?>
                        </div>
                        <div class="foto">
                            <img src="<?= $tatuador["imagen"] ?>" alt="">
                            <input type="file" name="imagen" id="imagen">
                        </div>
                    </div>
                    <!-- Modificar contraseña -->
                    <h2>MODIFICAR CONTRASEÑA</h2>
                    <input type="password" id="password" name="password">
                    <label for="password" class="placeholder">Contraseña</label>
                    <br>
                    <input type="password" id="confirmar_password" name="confirmar_password">
                    <label for="confirmar_password" class="placeholder">Confirmar Contraseña</label>
                    <br>
                    <button type="submit" name="clave">Actualizar Contraseña</button>
                    <!-- Subir tatuajes -->
                     <h2>SUBIR TATUAJES</h2>
                    <label for="tatuajes">Tatuajes</label>
                    <input type="file" name="tatuajes[]" id="tatuajes" multiple>
                    <br>
                    <button type="submit" name="tatuajes">Subir Tatuajes</button>
                </form>
                <div class="galeria">
                    <?php foreach ($tatuajes as $tatuaje) { ?>
                        <a href="eliminar_tatuaje.php?id=<?= $tatuaje['id'] ?>">
                            <img src="<?= $tatuaje['ruta'] ?>" alt="Tatuaje" width="100px" height="100px">
                        </a>
                    <?php } ?>
                </div>
            </div>   
        </section>

        <section>

        </section>

        <section>

        </section>
    </main>
</body>
</html>