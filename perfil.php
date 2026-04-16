<?php

require "db/db_connection.php";
require "db/comprobar_sesion.php";

$tatuador = get_tatuador_by_id($_SESSION['user_id']);
$tatuajes = get_tatuajes($_SESSION['user_id']);
$num_tatuajes = count($tatuajes);
$mensajes = get_mensajes($_SESSION['user_id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["perfil"])) {
        $nombre = $_POST["nombre"];
        $email = $_POST["email"];
        $estilo = $_POST["estilo"];
        $instagram = $_POST["instagram"];
        $descripcion = $_POST["descripcion"];

        if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
            $ruta = "assets/img/tatuadores/" . basename($_FILES["imagen"]["name"]);
            move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);
        } else {
            $ruta = $tatuador["imagen"];
        }  
        
        $tatuador_existente = get_tatuador_by_email($email);

        if ($tatuador_existente && $tatuador_existente['id'] != $_SESSION['user_id']) {
            $error = "El email introducido ya está registrado.";
        } else {
            $query = update_tatuador($email, $nombre, $descripcion, $estilo, $instagram, $ruta, $_SESSION['user_id']);
            if ($query) {
                $tatuador = get_tatuador_by_id($_SESSION['user_id']);
                $ok = "Perfil actualizado correctamente.";
            } else {
                $error = "Error al actualizar el perfil.";
            }
        }
    }

    if (isset($_POST["clave"])) {
        $password = $_POST["password"];
        $confirmar_password = $_POST["confirmar_password"];

        if ($password === $confirmar_password) {
            $query = update_clave(password_hash($password, PASSWORD_DEFAULT), $_SESSION['user_id']);
            if ($query) {
                $ok = "Contraseña actualizada correctamente.";
            } else {
                $error = "Error al actualizar la contraseña.";
            }
        } else {
            $error = "Las contraseñas no coinciden.";
        }
    }

    if (isset($_POST["subir_tatuajes"])) {
        if ((count($_FILES["tatuajes"]["tmp_name"]) + $num_tatuajes) <= 9) {
            if ($_FILES["tatuajes"]["name"][0] != "") {
                foreach ($_FILES["tatuajes"]["tmp_name"] as $index => $tmpName) {
                    if ($_FILES["tatuajes"]["error"][$index] == 0) {
                        $ruta = "assets/img/tatuajes/" . basename($_FILES["tatuajes"]["name"][$index]);
                        if (!file_exists($ruta)) {
                            if (move_uploaded_file($tmpName, $ruta)) {
                                if(!insert_tatuaje($ruta, $_SESSION['user_id'])) {
                                    $errors[] = "Error al guardar el archivo " . $_FILES["tatuajes"]["name"][$index] . " en la base de datos.";
                                }
                            } else {
                                $errors[] = "Error al guardar el archivo " . $_FILES["tatuajes"]["name"][$index] . ".";
                            }
                        } else {
                            $errors[] = "El archivo " . $_FILES["tatuajes"]["name"][$index] . " ya existe.";
                        }
                    } else {
                        $errors[] = "Error al subir el archivo " . $_FILES["tatuajes"]["name"][$index] . ".";
                    }
                }

                if (empty($errors)) {
                    $ok = "Tatuajes subidos correctamente.";
                    $tatuajes = get_tatuajes($_SESSION['user_id']);
                } else {
                    $error = implode("<br>", $errors);
                }
            } else {
                $error = "No se han seleccionado archivos para subir.";
            }
        } else {
            $error = "Solo puedes tener 9 imagenes en total. Elimina algunas para subir nuevas.";
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
                <div>
                    <h1>Mensajes</h1>
                    <table>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Asunto</th>
                            <th>Mensaje</th>
                        </tr>
                        <?php foreach ($mensajes as $mensaje) { ?>
                            <tr>
                                <td><?= $mensaje['nombre'] ?></td>
                                <td><?= $mensaje['email'] ?></td>
                                <td><?= $mensaje['asunto'] ?></td>
                                <td><?= $mensaje['mensaje'] ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>

                <form action="" method="post" enctype="multipart/form-data">
                    <div class="datos">
                        <div class="datos-personales">
                            <?php if (isset($ok)) { ?>
                                <h3 style="color: var(--old-gold);"><?= $ok ?></h3>
                            <?php } elseif (isset($error)) { ?>
                                <h3 style="color: var(--blood-red);"><?= $error ?></h3>
                            <?php } ?>
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
                    <button type="submit" name="subir_tatuajes">Subir Tatuajes</button>
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
    </main>
</body>
</html>