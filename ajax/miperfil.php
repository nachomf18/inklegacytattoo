<?php

require "../db/db_connection.php";
session_start();

if (isset($_SESSION["usuario"])) {
    $id = $_SESSION["usuario"]["id"];
} else {
    echo json_encode(["error" => "Usuario no autenticado"]);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["opcion"])) {
    $opcion = $_GET["opcion"];

    if ($opcion === "obtener_tatuador") {
        $tatuador = get_tatuador_by_id($id);
        echo json_encode($tatuador);
    } elseif ($opcion === "obtener_tatuajes") {
        $tatuajes = get_tatuajes($id);
        echo json_encode($tatuajes);
    } elseif ($opcion === "obtener_mensajes") {
        $mensajes = get_mensajes($id);
        echo json_encode($mensajes);
    }
} elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_GET["opcion"])) {
    $opcion = $_GET["opcion"];

    if ($opcion === "actualizar_perfil") {
        $nombre = $_POST["nombre"];
        $estilo = $_POST["estilo"];
        $instagram = $_POST["instagram"];
        $descripcion = $_POST["descripcion"];
        $imagen = $_FILES["imagen"]["name"];
        $ruta_imagen = "../assets/img/tatuadores/" . $imagen;

        if (!$imagen) {
            $tatuador = get_tatuador_by_id($id);
            $ruta_imagen = $tatuador["imagen"];
        }
        
        if(update_tatuador($id, $nombre, $descripcion, $estilo, $instagram, $ruta_imagen)) {
            if ($_FILES["imagen"]["tmp_name"]) {
                move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta_imagen);
            }
            echo "TRUE";
        } else {
            echo "FALSE";
        }
    } elseif ($opcion === "actualizar_clave") {
        $clave = password_hash($_POST["clave"], PASSWORD_DEFAULT);
        if(update_clave($clave, $id)) {
            echo "TRUE";
        } else {
            echo "FALSE";
        }
    } elseif ($opcion === "subir_tatuajes") {
        $errors = [];

        foreach ($_FILES["tatuajes"]["tmp_name"] as $index => $tmpName) {
            $nombre_archivo = $_FILES["tatuajes"]["name"][$index];
            $error_upload = $_FILES["tatuajes"]["error"][$index];
            
            if ($error_upload == 0) {                
                $ruta = "../assets/img/tatuajes/" . basename($nombre_archivo);

                if (!file_exists($ruta)) {
                    if (move_uploaded_file($tmpName, $ruta)) {
                        if(!insert_tatuaje($ruta, $_SESSION['usuario']['id'])) {
                            $errors[] = "Error al guardar el archivo " . $nombre_archivo . " en la base de datos.";
                        }
                    } else {
                        $errors[] = "Error al guardar el archivo " . $nombre_archivo . ".";  
                    }
                } else {
                    $errors[] = "El archivo " . $nombre_archivo . " ya existe.";
                }
            } else {
                $errors[] = "Error al subir el archivo " . $nombre_archivo . ".";
            }
        }

        if (empty($errors)) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "errors" => $errors]);
        }
    }
}